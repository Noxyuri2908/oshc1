<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ApprovedComReport extends Model
{
    protected $table = 'approved_com_report';
    protected $fillable = [
        'id',
        'agent_id',
        'report_type',
        'month',
        'year',
        'from_date',
        'to_date',
        'report_file',
        'amount',
        'checked_by',
        'checked_date',
        'status',
        'approved_by',
        'emailed_date',
        'agent_request',
        'final_approve',
        'paid_date',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
