<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class MailSkypeList extends Model
{
    //
    protected $table = 'mail_skype_lists';
    protected $fillable = [
        'domain_id',
        'email',
        'person_in_charge',
        'password',
        'skype',
        'crm',
        'dropbox',
        'note'
    ];
    public function getDomain(){
        $domain_id = $this->domain_id;
        if(!empty($domain_id)){
            $status = Status::where('type','domain_mail_skype')->where('id',$domain_id)->first();
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
