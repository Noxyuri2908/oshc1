<?php

namespace App\Admin;

use App\Admin;
use App\User;

use Illuminate\Database\Eloquent\Model;

class MarketingSupport extends Model
{
    protected $table = 'marketing_supports';
    protected $fillable = [
        'user_id',
        'processing_date',
        'issue',
        'person_in_charge',
        'marketing_support'
    ];
    public function getAgentName()
    {
        $agent_id = $this->user_id;
        if (!empty($agent_id)) {
            return User::findOrFail($agent_id)->name;
        }
        return '';
    }
    public function getIssue()
    {
        $issue = $this->issue;
        if (!empty($issue)) {
            return Dichvu::findOrFail($issue)->name;
        }
        return '';
    }
    public function getPersonName()
    {
        $person_id = $this->person_in_charge;
        if (!empty($person_id)) {
            return Admin::findOrFail($person_id)->username;
        }
        return '';
    }
}
