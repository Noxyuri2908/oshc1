<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class SeoKeyword extends Model
{
    //
    protected $table = 'seo_keywords';
    protected $fillable = [
        'destination_target',
        'keyword',
        'relevant_info',
        'gg_ad',
        'ranking',
        'link',
        'title',
        'description',
        'note'
    ];
}
