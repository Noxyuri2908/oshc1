<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class EmployeeAccessList extends Model
{
    //
    protected $fillable = [
        'role_id',
        'permission_type',
        'action_id'
    ];
}
