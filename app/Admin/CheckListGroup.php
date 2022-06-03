<?php

namespace App\Admin;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class CheckListGroup extends Model
{
    //
    protected $table='check_list_groups';
    protected $fillable = [
        'group_name',
        'created_by',
        'assign_by',
        'assign_by_group'
    ];
    public function getCreateBy(){
        $created_by = $this->created_by;
        if(!empty($created_by)){
            $admin = Admin::find($created_by);
            return (!empty($admin))?$admin->username:'';
        }
        return '';
    }
    public function checkLists(){
        return $this->hasMany(CheckList::class,'group_id');
    }
}
