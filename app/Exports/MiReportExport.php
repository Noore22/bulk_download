<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use App\Models\MiReport;

class MiReportExport 
{
    public function exportLargeCSV()
{
    $filePath = 'export/mi_reports.csv';
    $fullPath = storage_path("app/public/{$filePath}");

    if (!file_exists(dirname($fullPath))) {
        mkdir(dirname($fullPath), 0777, true);
    }

    $handle = fopen($fullPath, 'w');

    // Write header
    fputcsv($handle, [
        'Mi Id', 'Discom Code', 'DISCOME_NAME', 'Circle Code', 'CIRCLE_NAME',
        'Division Code', 'DIVISION_NAME', 'Subdivision Code', 'SUBDIVISION_NAME',
        'Lt Loc Code', 'Meter Number', 'Initial Reading', 'Final Reading',
        'Latitude', 'Longitude', 'Created At', 'ISK_APPROVE', 'Created By', 'Contractor Name'
    ]);

    // Lazy load and write data
    MiReport::query()->lazyById(10000, 'mi_id')->each(function ($item) use ($handle) {
        fputcsv($handle, [
            $item->mi_id,
            $item->discom_code,
            $item->discome_name,
            $item->circle_code,
            $item->circle_name,
            $item->division_code,
            $item->division_name,
            $item->subdivision_code,
            $item->subdivision_name,
            $item->lt_loc_code,
            $item->meter_number,
            $item->initial_reading,
            $item->final_reading,
            $item->latitude,
            $item->longitude,
            $item->created_at,
            $item->isk_approve,
            $item->created_by,
            $item->contractor_name,
        ]);
    });
    

    fclose($handle);

    return response()->download($fullPath)->deleteFileAfterSend(true);
}

}
