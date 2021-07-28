<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ApplyDoc extends Model
{
    protected $fillable = [
    	'apply_id', 'name', 'link','admin_create', 
        'admin_update', 'note'
    ]; 
}
