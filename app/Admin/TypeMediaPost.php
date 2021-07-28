<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class TypeMediaPost extends Model
{
    //
    protected $table = 'type_media_posts';
    protected $fillable = [
        'type_id',
        'type_content_id',
        'category',
        'post_date',
        'is_active',
        'created_at',
        'updated_at',
        'note'
    ];
    public function mediaPosts(){
        return $this->belongsToMany(
            MediaPost::class,
            'media_post_has_types',
            'type_media_post_id',
            'media_posts'
        );
    }

    public function updatePostDate($id, $date)
    {
        $query = DB::table('type_media_posts')
            ->where('id', $id)
            ->update($date);
        dd($query);
    }

}
