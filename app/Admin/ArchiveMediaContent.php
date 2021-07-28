<?php

namespace App\Admin;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class ArchiveMediaContent extends Model
{
    //
    protected $table = 'archive_media_contents';
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'status',
        'link',
        'date',
        'note',
        'created_by',
        'website_id'
    ];
    public static $STATUS = [
        1=>'Uploaded',
        2=>'Pending'
    ];
    public function getWebsiteName($webMedia){
        $website_id = $this->website_id;
        if(!empty($website_id)){
            $website = $webMedia->where('id',$website_id)->pluck('name')->first();
            return $website;
        }
        return '';
    }
    public function getWebsiteValue($webMedia){
        $website_id = $this->website_id;
        if(!empty($website_id)){
            $website = $webMedia->where('id',$website_id)->pluck('value')->first();
            return !empty($website)?json_decode($website):'';
        }
        return '';
    }
    public function getCategoryName($webMedia){
        $category_id = $this->category_id;
        if(!empty($category_id)){
            $websiteValue = $this->getWebsiteValue($webMedia);
            $arrCategory = (!empty($websiteValue))?$websiteValue:[];
            return !empty($arrCategory[$category_id-1])?$arrCategory[$category_id-1]:'';
        }
        return '';
    }
    public function getStatus(){
        $status_id = $this->status;
        if(!empty($status_id)){
            $status = !empty(static::$STATUS[$status_id])?static::$STATUS[$status_id]:'';
            return $status;
        }
    }
    public function getCreateBy($admins){
        $created_by = $this->created_by;
        if(!empty($created_by)){
            $admin = !empty($admins[$created_by])?$admins[$created_by]:'';
            return $admin;
        }
        return '';
    }
//    public function getWebsiteValue(){
//        $website_id = $this->website_id;
//        if(!empty($website_id)){
//            $website = Status::where('id',$website_id)->first();
//            return (!empty($website))?json_decode($website->value,true):[];
//        }
//        return [];
//    }
}
