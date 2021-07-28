<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Apply;

class Promotion extends Model
{
    protected $fillable = [
        'name', 'start_date','end_date','code', 'amount','status','unit'
    ];

    public function applies(){
        return $this->hasMany('App\Admin\Apply', 'promotion');
    }

    public function active(){
       $used = Apply::all()->pluck('promotion_id')->all();
       return $this::whereNotIn('id', $used)->orderby('name')->get();
    }
    public function getUnit(){
        if(!empty($this->unit) && !empty(config('myconfig.currency')) && !empty(config('myconfig.currency')[$this->unit])){
            return config('myconfig.currency')[$this->unit];
        }
        return ;
    }
}
