<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ArchiveMediaLink extends Model
{
    //
    protected $table='archive_media_links';
    protected $fillable = [
        'category_id',
        'form_id',
        'country_id',
        'source_id',
        'link',
        'type_id',
        'is_hot_new',
        'information_focused_id',
        'note',
        'name',
        'admin',
        'email_admin',
        'telephone'
    ];
    public static $HOTNEWS = [
        1=>'A*',
        2=>'A',
        3=>'B',
        4=>'C'
    ];
    public function getCategoriesName(){
        $category_id = $this->category_id;
        if(!empty($category_id)){
            $category = Status::where('id',$category_id)->first();
            return (!empty($category))?$category->name:'';
        }
        return '';
    }
    public function getFromName(){
        $from_id = $this->form_id;
        if(!empty($from_id)){
            $from = Status::where('id',$from_id)->first();
            return (!empty($from))?$from->name:'';
        }
        return '';
    }
    public function getCountryName(){
        $country_id = $this->country_id;
        if(!empty($country_id)){
            $country = !empty(config('country.list')[$country_id])?config('country.list')[$country_id]:'';
            return (!empty($country))?$country:'';
        }
        return '';
    }
    public function getTypeName(){
        $type_id = $this->type_id;
        if(!empty($type_id)){
            $type = Status::where('id',$type_id)->first();
            return (!empty($type))?$type->name:'';
        }
        return '';
    }
    public function getHotNewName(){
        $is_hot_new = $this->is_hot_new;
        if(!empty($is_hot_new)){
            $hot_new = static::$HOTNEWS;
            return (!empty($hot_new[$is_hot_new]))?$hot_new[$is_hot_new]:'';
        }
        return '';
    }
    public function getInformationFocusName(){
        $information_focused_id = $this->information_focused_id;
        if(!empty($information_focused_id)){
            $information_focused = Status::where('id',$information_focused_id)->first();
            return (!empty($information_focused))?$information_focused->name:'';
        }
        return '';
    }
}
