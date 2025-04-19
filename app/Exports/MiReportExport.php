<?php

namespace App\Exports;

use App\Models\MiReport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;


class MiReportExport
{
    // public function streamCSV()
    // {
    //     $response = new StreamedResponse(function () {
    //         // Disable Laravel query logging to reduce memory usage
    //         \DB::connection()->unsetEventDispatcher();
    //         \DB::connection()->disableQueryLog();

    //         $handle = fopen('php://output', 'w');
    //         if ($handle === false) {
    //             throw new \Exception("Failed to open output stream.");
    //         }

    //         // Write the CSV headers
    //         fputcsv($handle, [
    //             'Mi Id', 'Discom Code', 'DISCOME_NAME', 'Circle Code', 'CIRCLE_NAME',
    //             'Division Code', 'DIVISION_NAME', 'Subdivision Code', 'SUBDIVISION_NAME',
    //             'Lt Loc Code', 'Meter Number', 'Initial Reading', 'Final Reading',
    //             'Latitude', 'Longitude', 'Created At', 'ISK_APPROVE', 'Created By', 'Contractor Name'
    //         ]);

    //         // Efficient data chunking using cursor() for minimal memory use
    //         foreach (MiReport::cursor() as $item) {
    //             fputcsv($handle, [
    //                 $item->mi_id,
    //                 $item->discom_code,
    //                 $item->discome_name,
    //                 $item->circle_code,
    //                 $item->circle_name,
    //                 $item->division_code,
    //                 $item->division_name,
    //                 $item->subdivision_code,
    //                 $item->subdivision_name,
    //                 $item->lt_loc_code,
    //                 $item->meter_number,
    //                 $item->initial_reading,
    //                 $item->final_reading,
    //                 $item->latitude,
    //                 $item->longitude,
    //                 $item->created_at,
    //                 $item->isk_approve,
    //                 $item->created_by,
    //                 $item->contractor_name,
    //             ]);
    //         }

    //         fclose($handle);
    //     });

    //     $response->headers->set('Content-Type', 'text/csv');
    //     $response->headers->set('Content-Disposition', 'attachment; filename="mi_reports.csv"');
    //     $response->headers->set('Cache-Control', 'no-store, no-cache');

    //     return $response;
    // }
    public function streamCSV()
    {
        // Disable query logging to save memory
        DB::connection()->disableQueryLog();
        DB::connection()->unsetEventDispatcher();

        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');

            // Prevent buffering for real-time streaming
            ob_start();

            // CSV header
            fputcsv($handle, [
                'Mi Id', 'Discom Code', 'DISCOME_NAME', 'Circle Code', 'CIRCLE_NAME',
                'Division Code', 'DIVISION_NAME', 'Subdivision Code', 'SUBDIVISION_NAME',
                'Lt Loc Code', 'Meter Number', 'Initial Reading', 'Final Reading',
                'Latitude', 'Longitude', 'Created At', 'ISK_APPROVE', 'Created By', 'Contractor Name'
            ]);

            // Stream using select() and cursor()
            MiReport::select([
                'mi_id', 'discom_code', 'discome_name', 'circle_code', 'circle_name',
                'division_code', 'division_name', 'subdivision_code', 'subdivision_name',
                'lt_loc_code', 'meter_number', 'initial_reading', 'final_reading',
                'latitude', 'longitude', 'created_at', 'isk_approve', 'created_by', 'contractor_name'
            ])->cursor()->each(function ($item) use ($handle) {
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
                // Flush buffer after each row for faster streaming
                ob_flush();
                flush();
            });

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="mi_reports.csv"');

        return $response;
    }

}
