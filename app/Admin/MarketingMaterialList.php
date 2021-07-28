<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class MarketingMaterialList extends Model
{
    //
    protected $table = 'marketing_material_lists';
    protected $fillable = [
        'category_id',
        'content',
        'use_for',
        'target',
        'file_attachment',
        'created_by',
        'sub_target'
    ];

    public function link_download()
    {
        return config('admin.base_url') . 'tailieus/' . $this->file_attachment;
    }

    public function getCategory()
    {
        $category_id = $this->category_id;
        if (!empty($category_id)) {
            $category_id = Status::where('id', $category_id)->first();
            return (!empty($category_id)) ? $category_id->name : '';
        }
        return '';
    }

    public function getUseFor()
    {
        $use_for = $this->use_for;
        if (!empty($use_for)) {
            $use_for = Status::where('id', $use_for)->first();
            return (!empty($use_for)) ? $use_for->name : '';
        }
        return '';
    }

    public function getTarget()
    {
        $target = $this->target;
        if (!empty($target)) {
            $target = Status::where('id', $target)->first();
            return (!empty($target)) ? $target->name : '';
        }
        return '';
    }

    public function getSubTargetName()
    {
        $target = $this->target;
        $sub_target = $this->sub_target;
        if (!empty($target)) {
            $target = Status::where('id', $target)->first()->value;
            $arrSubTarget = (!empty($target)) ? json_decode($target, true) : [];
            return !empty($arrSubTarget[$sub_target - 1]) ? $arrSubTarget[$sub_target - 1] : '';
        }
        return '';
    }

    public function getSubTarget()
    {
        $target = $this->target;
        $sub_target = $this->sub_target;
        if (!empty($target)) {
            $target = Status::where('id', $target)->first()->value;
            return \GuzzleHttp\json_decode($target,true);
        }
        return '';
    }
}
