<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ComReport extends Model
{
    protected $table = 'com_reports';
    protected $fillable = [
        'id',
        'from_date',
        'to_date',
        'agent_id',
        'approved_com_id',
        'counsellor_id',
        'report_type',
        'report_name',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}
