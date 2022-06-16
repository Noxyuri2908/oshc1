<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ComReportDetails extends Model
{
    protected $table = 'com_report_details';
    protected $fillable = [
        'id',
        'com_report_id',
        'fullname',
        'service',
        'provider',
        'policy',
        'date_of_policy',
        'no_of_adults',
        'no_of_children',
        'amount',
        'com_percent',
        'com',
        'total',
        'total_AUD',
        'extra',
        'exchange_rate',
        'gst',
        'comm_inc_gst',
        'comm_exc_gst',
        'recall_com',
        'com_status',
        'visa_status',
        'note',
        'date_of_payment',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
