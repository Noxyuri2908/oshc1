<?php

namespace App\Admin;

use App\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompetitionFeedback extends Model
{
    //
    protected $table = 'competition_feedbacks';
    protected $fillable = [
        'user_id',
        'processing_date',
        'issue',
        'person_in_charge',
        'competition_feedback',
    ];

    public static function getTaskSale($request)
    {
        $getChildUser = getChildUser('competitorUpdate');
        $startDate = (!empty($request->processing_date_competitor_feedback_start)) ? convert_date_to_db($request->processing_date_competitor_feedback_start) : date('Y-01-01');
        $endDate = (!empty($request->processing_date_competitor_feedback_end)) ? convert_date_to_db($request->processing_date_competitor_feedback_end).' 23:59:59' : date('Y-m-d 23:59:59');
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
        $competitionFeedbacks = CompetitionFeedback::when($request->get('agent_competitor_feedback_filter'), function ($query) use ($request) {
            $query->whereHas('agent', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->get('agent_competitor_feedback_filter').'%');
            });
        })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
            $query->whereBetween('processing_date', [$startDate, $endDate]);
        })->when(($request->get('issue_competitor_feedback_filter')), function ($query) use ($request) {
            $query->where('issue', $request->get('issue_competitor_feedback_filter'));
        })->when($request->get('person_in_charge_competitor_feedback_filter'), function ($query) use ($request) {
            $query->where('person_in_charge', 'LIKE', '%'.$request->get('person_in_charge_competitor_feedback_filter').'%');
        },function ($query) use ($request){
            $query->where('person_in_charge',$request->user()->id);
        })
            ->with('agent')
            ->orderBy('processing_date', 'desc');
        if($getChildUser['permissionSee']->contains(3)){
            $competitionFeedbacks->where('person_in_charge',$getChildUser['admin']->id);
        }elseif($getChildUser['permissionSee']->contains(2)){
            $competitionFeedbacks->whereIn('person_in_charge',$getChildUser['getAllAdminDepartment']);
        }
        return $competitionFeedbacks;
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAgentName()
    {
        $agent_id = $this->user_id;
        if (!empty($agent_id)) {
            return (!empty($this->agent)) ? $this->agent->name : '';
        }
        return '';
    }

    public function getIssue()
    {
        $issue_id = $this->issue;
        if (!empty($issue_id)) {
            return (!empty(config('myconfig.issue_competition_feedback_agent')[$issue_id])) ? config('myconfig.issue_competition_feedback_agent')[$issue_id] : '';
        }
        return '';
    }

    public function getPersonName()
    {
        $person_id = $this->person_in_charge;
        if (!empty($person_id)) {
            $user = Admin::find($person_id);
            return (!empty($user)) ? $user->username : '';
        }
        return '';
    }
}
