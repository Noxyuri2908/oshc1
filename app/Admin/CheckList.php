<?php

namespace App\Admin;

use App\Admin;
use Illuminate\Database\Eloquent\Model;


class CheckList extends Model
{

    //
    protected $table = 'check_lists';
    protected $fillable = [
        'group_id',
        'website_id',
        'category_id',
        'person_id',
        'problem',
        'date_of_suggestion',
        'detail',
        'solution_text',
        'level_of_process',
        'result_id',
        'processing_time',
        'budget',
        'checklist_created_at',
        'assigned_by',
        'type_id',
        'proposer',
        'file'
    ];
    public static $RESULT = [
        1=>'Processing',
        2=>'Done',
        3=>'Cancel',
        4=>'pending'
    ];
    public static $TYPE = [
        1=>'Web',
        2=>'CRM',
        3=>'Email'
    ];
    public static $LVPROCESSOR = [
        0 => 'A',
        1 => 'B',
        2 => 'C'
    ];
    public function getWebsiteName()
    {
        $website_id = $this->website_id;
        if (!empty($website_id)) {
            $website = Status::where('id', $website_id)->first();
            return (!empty($website)) ? $website->name : '';
        }
        return '';
    }
    public function getWebsiteValue(){
        $website_id = $this->website_id;
        if(!empty($website_id)){
            $website = Status::where('id',$website_id)->first();
            return (!empty($website)&& !empty($website->value))?json_decode($website->value,true):[];
        }
        return [];
    }
    public function getCategoryName($websiteStatus){
        $category_id = $this->category_id;
        $website_id = $this->website_id;
        if(!empty($category_id)){
            $websiteValue = $websiteStatus->where('id',$website_id)->first()->value;
            $arrCategory = (!empty($websiteValue))?json_decode($websiteValue,true):[];
            return !empty($arrCategory[$category_id-1])?$arrCategory[$category_id-1]:'';
        }
        return '';
    }
    public function getPerson(){
        $person_id = $this->person_id;
        if(!empty($person_id)){
            $admins = Admin::find($person_id);
            return (!empty($admins))?$admins->username:'';
        }
        return '';
    }
    public function getResult(){
        $result_id = $this->result_id;
        if(!empty($result_id)){
            $results = static::$RESULT;
            return (!empty($results[$result_id]))?$results[$result_id]:'';
        }
        return '';
    }
    public function getType(){
        $type_id = $this->type_id;
        if(!empty($type_id)){
            $types = static::$TYPE;
            return (!empty($types[$type_id]))?$types[$type_id]:'';
        }
        return '';
    }

    public function checkListSettings()
    {
        $this->belongsTo(CheckListSetting::class);
    }

}
