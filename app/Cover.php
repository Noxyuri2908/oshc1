<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cover extends Model
{
    //
    use Filterable;
    protected $fillable = [
      'service_id',
      'policy',
      'cover'
    ];

    public static function getCover($service, $policy)
    {
        $cover = DB::table('covers')->select('cover', 'id')->where([
            ['service_id', '=', $service],
            ['policy', '=', $policy]
        ])->get();

        return $cover;
    }

}
