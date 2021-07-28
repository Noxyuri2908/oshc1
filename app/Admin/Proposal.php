<?php

namespace App\Admin;

use App\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Proposal extends Model
{
    //
    protected $table = 'proposals';
    protected $fillable = [
        'user_id',
        'processing_date',
        'issue',
        'person_in_charge',
        'proposal',
        'create_person'
    ];
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getAgentName()
    {
        $agent_id = $this->user_id;
        if (!empty($agent_id)) {
            $user = (!empty($this->agent))?$this->agent->name:'';
            return $user;
        }
        return '';
    }
    public function getIssue()
    {
        $issue_id = $this->issue;
        if (!empty($issue_id)) {
            return (!empty(config('myconfig.issue_proposal_agent')[$issue_id])) ? config('myconfig.issue_proposal_agent')[$issue_id] : '';
        }
        return '';
    }
    public function getPersonName()
    {
        $person_id = $this->person_in_charge;
        if (!empty($person_id)) {
            return (!empty($this->admin))?$this->admin->username:'';
        }
        return '';
    }
    public function admin(){
         return $this->belongsTo(Admin::class,'person_in_charge');
    }
    public static function getSaleTaskExport($request){
        $getChildUser = getChildUser('proposal');

        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_end_date)) ? convert_date_to_db($request->report_end_date) . ' 23:59:59' : date('Y-m-d 23:59:59');
        if (!empty($request->get('filter_date_option'))) {
            if ($request->get('filter_date_option') == 'week') {
                $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'month') {
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'year') {
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            }
            $endDate = date('Y-m-d 23:59:59');
        }
        $proposals = Proposal::when($request->get('agent_proposal_filter'), function ($query) use ($request) {
            $query->whereHas('agent', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('agent_proposal_filter') . '%');
            });
        })->when($startDate && $endDate, function ($query) use ($request,$startDate,$endDate) {
            $query->whereBetween('processing_date', [$startDate, $endDate]);
        })->when(($request->get('issue_proposal_filter')), function ($query) use ($request) {
            $query->where('issue', $request->get('issue_proposal_filter'));
        })->when($request->get('person_in_charge_proposal_filter'), function ($query) use ($request) {
            $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_proposal_filter') . '%');
        })
            ->with(['agent','admin'])
            ->orderBy('processing_date', 'desc');
        if($getChildUser['permissionSee']->contains(3)){
            $proposals->where('person_in_charge',$getChildUser['admin']->id);
        }elseif($getChildUser['permissionSee']->contains(2)){
            $proposals->whereIn('person_in_charge',$getChildUser['getAllAdminDepartment']);
        }
        return $proposals;
    }
}
