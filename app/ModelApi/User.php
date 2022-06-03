<?php

namespace App\ModelApi;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'status',
        'password',
        'created_by',
        'staff_id',
        'shares',
        'is_default',
        'had_case',
        'first_case_date',
        'note1',
        'note2',
        'potential_service',
        'registered_date',
        'agent_code',
        'rating',
        'country',
        'city',
        'office',
        'department',
        'type_id',
        'market_id',
        'tel_1',
        'tel_2',
        'fb',
        'website',
        'person_in_charge',
        'contact_person',
        'note',
        'type',
        'type_agent'
    ];
}
