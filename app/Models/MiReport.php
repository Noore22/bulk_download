<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiReport extends Model
{
    protected $table = 'mi_reports'; // make sure this matches your actual table name

    protected $fillable = [
        'mi_id',
        'discom_code',
        'discome_name',
        'circle_code',
        'circle_name',
        'division_code',
        'division_name',
        'subdivision_code',
        'subdivision_name',
        'lt_loc_code',
        'meter_number',
        'initial_reading',
        'final_reading',
        'latitude',
        'longitude',
        'created_at',
        'isk_approve',
        'created_by',
        'contractor_name',
    ];

    public $timestamps = false; // if your table doesn’t use created_at/updated_at
}
