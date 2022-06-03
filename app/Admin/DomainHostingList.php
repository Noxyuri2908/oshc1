<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class DomainHostingList extends Model
{
    //
    protected $table = 'domain-hosting-lists';
    protected $fillable = [
        'type',
        'name',
        'link',
        'user',
        'password',
        'provider',
        'person_in_charge',
        'email_in_charge',
        'expiry_date',
        'fee',
        'note'
    ];
    public function getType(){
        $type = $this->type;
        if(!empty($type)){
            $status = Status::where('type','type_domain_hosting')->where('id',$type)->first();
            return (!empty($status))?$status->name:'';
        }
        return '';
    }
    public function getPersonInCharge(){
        $person_in_charge = $this->person_in_charge;
        if(!empty($person_in_charge)){
            $admins = \App\Admin::where('id',$person_in_charge)->first();
            return (!empty($admins))?$admins->username:'';
        }
        return '';
    }
}
