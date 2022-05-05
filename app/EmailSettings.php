<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    //

    protected $fillable = [
        'email_from',
        'email_password',
        'email_description',
    ];
}
