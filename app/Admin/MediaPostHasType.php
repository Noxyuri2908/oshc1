<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MediaPostHasType extends Model
{
    //

    protected $table = 'media_post_has_types';
    protected $fillable = [
      'media_post_id',
      'type_media_post_id'
    ];

}
