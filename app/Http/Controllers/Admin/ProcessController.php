<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FollowUpStoreRequest;
use App\Http\Requests\FollowUpUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use App\Admin\Support;
use App\Admin\Follow;
use App\Admin\Apply;
use App\Admin\CompetitionFeedback;
use App\Admin\Dichvu;
use App\Admin\MarketFeedback;
use App\Admin\MarketingSupport;
use App\Admin\Proposal;
use phpseclib\System\SSH\Agent;
use Session;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (!$request->user()->can('agent.process')) {
            abort(403);
        }
        $obj = User::find($id);
        $fields = \Config::get('myconfig.fields_table_agent');
        return view('CRM.pages.process', [
            'flag' => "",
            "process" => "1",
            'obj' => $obj,
            'agent_id'=>$id,
            'fields' =>$fields
        ]);
    }



    public function addNewTask(Request $request)
    {
        $id = $request->input('id');
        $obj = User::find($id);
        if ($obj == null) abort(404);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        return view('CRM.elements.process.modal-task', ['obj' => $obj, 'admins' => $admins]);
    }
    public function addNewFollow(Request $request)
    {
        if (!$request->user()->can('followUp.store')) {
            abort(403);
        }
        $id = $request->input('agent_id');
        $obj = User::find($id);
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');
        return view('CRM.elements.process.modal-follow-up', [
            'obj' => $obj,
            'fl_up_status' => $fl_up_status
        ]);
    }
    public function editFollow(Request $request)
    {
        if (!$request->user()->can('followUp.edit')) {
            abort(403);
        }
        $follow_id = $request->get('follow_id');
        $follow = Follow::with(['agent', 'commentsTask'])->find($follow_id);

        if(empty($follow)){
            return response()->json(['error'=>'Follow up not found !']);
        }
//        dd(\Illuminate\Support\Facades\Auth::user()->id);
        $agent_id = $follow->user_id;
        $obj = User::find($agent_id);
        if(empty($obj)){
            return response()->json(['error'=>'User not found !']);
        }
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');
        return view('CRM.elements.process.modal-follow-up', compact(
            'follow',
            'obj',
            'fl_up_status'
        ));

    }

    public function storeFollow(FollowUpStoreRequest $request, $id)
    {
        if (!$request->user()->can('followUp.store')) {
            abort(403);
        }
        $data = $request->validated();
        if ($id == 0) {
            $id = $request->get('user_id');
        }
        $data['user_id'] = $id;
        $data['process_date'] = convert_date_to_db($data['process_date']);
        $data['due_date'] = convert_date_to_db($data['due_date']);
        $data['hot_issue'] = (isset($data['hot_issue']) && $data['hot_issue'] == 'on') ? true : false;
        $data['follow_up_status'] = ($data['follow_up_status'] != null) ? (int)$data['follow_up_status'] : -1;
        $data['estimate'] = ($data['estimate'] != '') ? $data['estimate'] : 0;

        \DB::transaction(function () use ($id,$data){
            $agent = User::find($id);
            if (empty($agent)) {
                return response()->json(['error' => 'User not found !']);
            }
            $agent->follows()->update(['condition_follow'=>0]);
            $agent->update(['status' => $data['status']]);
            $data['condition_follow'] = 1;
            $idFL = Follow::create($data);

            $commentTask = [
                'follow_id' => $idFL->id,
                'agent_id'	=> $id,
                'staff_create_fl'	=> !empty($data['create_person']) ? $data['create_person'] : '',
                'staff_assign_fl' => !empty($data['assigned_person']) ? $data['assigned_person'] : '',
                'staff_create_cm' => !empty($data['staff_create_cm']) ? $data['staff_create_cm'] : '',
                'comment' => !empty($data['comment']) ? $data['comment'] : '',
                'see' => 0,
                'send_to_staff_id' => !empty($data['send_to_staff_id']) ? $data['send_to_staff_id'] : '',
                'date' => !empty($data['date_comment']) ? convert_date_to_db($data['date_comment']) : ''
            ];

            Admin\CommentsTask::create($commentTask); // store commment
        });
        $fl_up_status = config('myconfig.task_follow_up_status');
        if ($request->get('submit_from') == 'task_sale') {
            $startDate = (!empty($request->processing_date_follow_ups_start)) ? convert_date_to_db($request->processing_date_follow_ups_start) : date('Y-01-01');
            $endDate = (!empty($request->processing_date_follow_ups_end)) ? convert_date_to_db($request->processing_date_follow_ups_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
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
            //        dd($startDate,$endDate);
            $potential_service_follow_ups_filter = (!empty($request->get('potential_service_follow_ups_filter'))) ? json_decode($request->get('potential_service_follow_ups_filter')) : [];
            $arrayPotential = collect($potential_service_follow_ups_filter)->pluck('id')->toArray();
            $followUps = Follow::when($request->get('agent_follow_ups_filter'), function ($query) use ($request) {
                $query->whereHas('agent', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->get('agent_follow_ups_filter') . '%');
                });
            })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('process_date', [$startDate, $endDate]);
            })->when($request->get('status_follow_ups_filter'), function ($query) use ($request) {
                $query->where('status', $request->get('status_follow_ups_filter'));
            })->when($request->get('rating_follow_ups_filter'), function ($query) use ($request) {
                $query->where('rating', 'LIKE', '%' . $request->get('rating_follow_ups_filter') . '%');
            })->when($request->get('contact_by_follow_ups_filter'), function ($query) use ($request) {
                $query->where('contact_by', $request->get('contact_by_follow_ups_filter'));
            })->when($request->get('person_in_charge_follow_ups_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_follow_ups_filter') . '%');
            })->when($request->get('potential_service_follow_ups_filter') && $request->get('potential_service_follow_ups_filter') != '[]', function ($query) use ($request, $arrayPotential, $potential_service_follow_ups_filter) {
                $query->whereJsonContains('potential_service', $potential_service_follow_ups_filter);
            })->when($request->get('filter_date_option'), function ($query) use ($request) {
                if ($request->get('filter_date_option') == 'week') {
                    $query->whereBetween('process_date', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
                } else if ($request->get('filter_date_option') == 'month') {
                    $query->whereBetween('process_date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
                } else if ($request->get('filter_date_option') == 'year') {
                    $query->whereBetween('process_date', [Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
                }
            })->when($request->get('agent_id'),function ($query) use ($request){
                $query->where('user_id',$request->get('agent_id'));
            })
                ->with([
                    'agent',
                    'staff'
                ])
                ->orderBy('process_date', 'desc')
                ->orderBy('id','desc')
                ->paginate(8);
            $lastPage = $followUps->lastPage();
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.follow_up_agent.data', compact(
                    'followUps',
                    'fl_up_status'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create'
            ]);
        } else {
            $follows = Follow::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.follow-ups-table', compact('follows', 'fl_up_status'));
        }
    }

    public function updateFollow(FollowUpUpdateRequest $request, $agent_id, $follow_id)
    {
        if (!$request->user()->can('followUp.update')) {
            abort(403);
        }
        $follow = Follow::with(['agent'])->find($follow_id);
        $data = $request->validated();
        $data['process_date'] = convert_date_to_db($data['process_date']);
        $data['due_date'] = convert_date_to_db($data['due_date']);
        $data['hot_issue'] = (isset($data['hot_issue']) && $data['hot_issue'] == 'on') ? true : false;
        $data['follow_up_status'] = ($data['follow_up_status'] != null) ? (int)$data['follow_up_status'] : -1;
        $data['estimate'] = ($data['estimate'] != '') ? $data['estimate'] : 0;
        \DB::transaction(function () use ($follow,$data,$agent_id){
            $follow->update($data);
            $agent = User::find($agent_id);
            if (empty($agent)) {
                return response()->json(['error' => 'User not found !']);
            }
            $agent->update(['status' => $data['status']]);

            if ($data['comment'] != '')
            {
                $commentTask = [
                    'follow_id' => $follow->id,
                    'agent_id'	=> $agent_id,
                    'staff_create_fl'	=> !empty($data['create_person']) ? $data['create_person'] : '',
                    'staff_assign_fl' => !empty($data['assigned_person']) ? $data['assigned_person'] : '',
                    'staff_create_cm' => !empty($data['staff_create_cm']) ? $data['staff_create_cm'] : '',
                    'comment' => !empty($data['comment']) ? $data['comment'] : '',
                    'see' => 0,
                    'send_to_staff_id' => !empty($data['send_to_staff_id']) ? $data['send_to_staff_id'] : '',
                    'date' => !empty($data['date_comment']) ? convert_date_to_db($data['date_comment']) : ''
                ];
                Admin\CommentsTask::create($commentTask);
            }

        });
        $fl_up_status = config('myconfig.task_follow_up_status');

        if ($request->get('submit_from') == 'task_sale') {
            $followUps = [$follow];
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.follow_up_agent.data', compact(
                    'followUps',
                    'fl_up_status'
                ))->render(),
                'type' => 'update',
                'id' => $follow->id
            ]);
        } else {
            $follows = Follow::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.follow-ups-table', compact('follows', 'fl_up_status'));
        }
    }
    public function destroyFollow(Request $request, $agent_id, $follow_id)
    {
        if (!$request->user()->can('followUp.delete')) {
            abort(403);
        }
        $follow = Follow::findOrFail($follow_id);
        $follow->delete();
        return response()->json([
            'id'=>$follow_id
        ]);
    }

    public function addNewMarketFeedback(Request $request)
    {
        if (!$request->user()->can('agentFeedback.store')) return abort(403);

        $id = $request->input('id');

        if(!empty($id)){
            $obj = User::find($id);
            if(empty($obj)){
                return response()->json(['error'=>'User not found']);
            }
        }else{
            $obj = [];
        }
        return view('CRM.elements.agents.process.modal-market-feedback', [
            'obj' => $obj
        ]);
    }
    public function storeMarketFeedback(Request $request, $id)
    {
        if (!$request->user()->can('agentFeedback.store')) return abort(403);
        $data = $request->all();
        if ($id == 0) {
            $id = $request->get('user_id');
        }
        $data['user_id'] = $id;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        MarketFeedback::create($data);
        if ($request->get('submit_from') == 'task_sale') {
            $startDate = (!empty($request->processing_date_market_feedback_start)) ? convert_date_to_db($request->processing_date_market_feedback_start) : date('Y-01-01');
            $endDate = (!empty($request->processing_date_market_feedback_end)) ? convert_date_to_db($request->processing_date_market_feedback_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
            if($request->get('agent_market_feedback_filter')){
                $agent_ids = User::when($request->get('agent_market_feedback_filter'),function($query) use ($request){
                    $query->where('name', 'LIKE', '%' . $request->get('agent_market_feedback_filter') . '%');
                })->pluck('id');
            }else{
                $agent_ids=[];
            }


            $marketFeedbacks = MarketFeedback::when($request->get('agent_market_feedback_filter'), function ($query) use ($agent_ids) {
                $query->whereIn('user_id',$agent_ids);
            })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('processing_date', [$startDate, $endDate]);
            })->when(($request->get('issue_market_feedback_filter')), function ($query) use ($request) {
                $query->where('issue', $request->get('issue_market_feedback_filter'));
            })->when($request->get('person_in_charge_market_feedback_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_market_feedback_filter') . '%');
            })->when($request->get('agent_id'),function ($query) use ($request){
                $query->where('user_id',$request->get('agent_id'));
            })
                ->with([
                    'agent',
                    'admin'
                ])
                ->orderBy('processing_date', 'desc')
                ->paginate(8);
            $lastPage = $marketFeedbacks->lastPage();
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.market_feedback_agent.data', compact(
                    'marketFeedbacks'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create'
            ]);
        } else {
            $marketFeedbacks = MarketFeedback::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.market-feedback-table', compact(
                'marketFeedbacks'
            ));
        }
    }
    public function editMarketFeedback(Request $request)
    {
        if (!$request->user()->can('agentFeedback.edit')) return abort(403);

        $agent_id = $request->get('agent_id');
        $marketFeedbackId = $request->get('id');
        $obj = User::findOrFail($agent_id);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $marketFeedback = MarketFeedback::findOrFail($marketFeedbackId);
        return view('CRM.elements.agents.process.modal-market-feedback', [
            'obj' => $obj,
            'admins' => $admins,
            'services' => $services,
            'marketFeedback' => $marketFeedback
        ]);
    }
    public function updateMarketFeedback(Request $request, $agent_id, $market_feedback_id)
    {
        if (!$request->user()->can('agentFeedback.update')) return abort(403);

        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $marketFeedback = MarketFeedback::findOrFail($market_feedback_id);
        $marketFeedback->update($data);
        if ($request->get('submit_from') == 'task_sale') {
            $marketFeedbacks = [$marketFeedback];
            return response()->json([
                'view' => view('CRM.elements.task.table.market_feedback_agent.data', compact(
                    'marketFeedbacks'
                ))->render(),
                'type' => 'update',
                'id' => $marketFeedback->id
            ]);
        } else {
            $marketFeedbacks = MarketFeedback::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.market-feedback-table', compact(
                'marketFeedbacks'
            ));
        }
    }
    public function destroyMarketFeedback(Request $request, $agent_id, $market_feedback_id)
    {
        if (!$request->user()->can('agentFeedback.delete')) return abort(403);
        $marketFeedback = MarketFeedback::findOrFail($market_feedback_id);
        $marketFeedback->delete();
        $marketFeedbacks = MarketFeedback::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.market-feedback-table', compact('marketFeedbacks'));
    }
    public function addNewCompetitionFeedback(Request $request)
    {
        if (!$request->user()->can('competitorUpdate.store')) return abort(403);
        $id = $request->input('id');
        $obj = User::find($id);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $agents = User::pluck('name', 'id');

        return view('CRM.elements.agents.process.modal-competition-feedback', [
            'obj' => $obj,
            'admins' => $admins,
            'services' => $services,
            'agents' => $agents
        ]);
    }
    public function storeCompetitionFeedback(Request $request, $id)
    {
        if (!$request->user()->can('competitorUpdate.store')) return abort(403);
        $data = $request->all();
        if ($id == 0) {
            $id = $request->get('user_id');
        }
        $data['user_id'] = $id;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        CompetitionFeedback::create($data);
        if ($request->get('submit_from') == 'task_sale') {
            $startDate = (!empty($request->processing_date_competitor_feedback_start)) ? convert_date_to_db($request->processing_date_competitor_feedback_start) : date('Y-01-01');
            $endDate = (!empty($request->processing_date_competitor_feedback_end)) ? convert_date_to_db($request->processing_date_competitor_feedback_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
            $competitionFeedbacks = CompetitionFeedback::when($request->get('agent_competitor_feedback_filter'), function ($query) use ($request) {
                $query->whereHas('agent', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->get('agent_competitor_feedback_filter') . '%');
                });
            })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('processing_date', [$startDate, $endDate]);
            })->when(($request->get('issue_competitor_feedback_filter')), function ($query) use ($request) {
                $query->where('issue', $request->get('issue_competitor_feedback_filter'));
            })->when($request->get('person_in_charge_competitor_feedback_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_competitor_feedback_filter') . '%');
            })
                ->with(['agent'])
                ->orderBy('processing_date', 'desc')
                ->paginate(8);
            $lastPage = $competitionFeedbacks->lastPage();
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.competition_feedback_agent.data', compact(
                    'competitionFeedbacks'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create'
            ]);
        } else {
            $competitionFeedbacks = CompetitionFeedback::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.competition-feedback-table', compact(
                'competitionFeedbacks'
            ));
        }
    }
    public function editCompetitionFeedback(Request $request)
    {
        if (!$request->user()->can('competitorUpdate.edit')) return abort(403);
        $agent_id = $request->get('agent_id');
        $competitionFeedbackId = $request->get('id');
        $obj = User::find($agent_id);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $agents = User::pluck('name', 'id');
        $competitionFeedback = CompetitionFeedback::findOrFail($competitionFeedbackId);
        return view('CRM.elements.agents.process.modal-competition-feedback', [
            'obj' => $obj,
            'admins' => $admins,
            'services' => $services,
            'competitionFeedback' => $competitionFeedback,
            'agents' => $agents
        ]);
    }
    public function updateCompetitionFeedback(Request $request, $agent_id, $competition_feedback_id)
    {
        if (!$request->user()->can('competitorUpdate.update')) return abort(403);
        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $competitionFeedback = CompetitionFeedback::findOrFail($competition_feedback_id);
        $competitionFeedback->update($data);
        if ($request->get('submit_from') == 'task_sale') {
            $competitionFeedbacks = CompetitionFeedback::orderBy('id', 'desc')->get();
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.competition_feedback_agent.data', compact(
                    'competitionFeedbacks'
                ))->render(),
                'type' => 'update',
                'id' => $competitionFeedback->id
            ]);
        } else {
            $competitionFeedbacks = CompetitionFeedback::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.competition-feedback-table', compact(
                'competitionFeedbacks'
            ));
        }
    }
    public function destroyCompetitionFeedback(Request $request, $agent_id, $competition_feedback_id)
    {
        if (!$request->user()->can('competitorUpdate.delete')) return abort(403);
        $competitionFeedback = CompetitionFeedback::findOrFail($competition_feedback_id);
        $competitionFeedback->delete();
        $competitionFeedbacks = CompetitionFeedback::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.competition-feedback-table', compact(
            'competitionFeedbacks'
        ));
    }



    public function addNewMarketingSupport(Request $request)
    {
        $id = $request->input('id');
        $obj = User::findOrFail($id);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $agents = User::pluck('name', 'id');

        return view('CRM.elements.agents.process.modal-marketing-support', [
            'obj' => $obj,
            'admins' => $admins,
            'services' => $services,
            'agents' => $agents
        ]);
    }
    public function storeMarketingSupport(Request $request, $id)
    {
        $data = $request->all();
        if ($id == 0) {
            $id = $request->get('user_id');
        }
        $data['user_id'] = $id;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        MarketingSupport::create($data);
        if ($request->get('submit_from') == 'task_sale') {
            $marketingSupports = MarketingSupport::with('agent')
                ->orderBy('processing_date', 'desc')
                ->paginate(8);
            $lastPage = $marketingSupports->lastPage();
            return response()->json([
                'view' => view('CRM.elements.task.table.competition_feedback_agent.data', compact(
                    'marketingSupports'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create'
            ]);
        } else {
            $marketingSupports = MarketingSupport::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.marketing-support-table', compact(
                'marketingSupports'
            ));
        }
    }
    public function editMarketingSupport(Request $request)
    {
        $agent_id = $request->get('agent_id');
        $marketingSupportId = $request->get('id');
        $obj = User::findOrFail($agent_id);
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $marketingSupport = MarketingSupport::findOrFail($marketingSupportId);
        return view('CRM.elements.agents.process.modal-marketing-support', [
            'obj' => $obj,
            'admins' => $admins,
            'services' => $services,
            'marketingSupport' => $marketingSupport
        ]);
    }
    public function updateMarketingSupport(Request $request, $agent_id, $marketing_support_id)
    {
        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $marketingSupport = MarketingSupport::findOrFail($marketing_support_id);
        $marketingSupport->update($data);
        $marketingSupports = MarketingSupport::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.marketing-support-table', compact(
            'marketingSupports'
        ));
    }
    public function destroyMarketingSupport(Request $request, $agent_id, $marketing_support_id)
    {
        $marketingSupport = MarketingSupport::findOrFail($marketing_support_id);
        $marketingSupport->delete();
        $marketingSupports = MarketingSupport::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.marketing-support-table', compact(
            'marketingSupports'
        ));
    }

    public function addNewProposal(Request $request)
    {
        if (!$request->user()->can('proposal.store')) return abort(403);
        if ($request->input('id'))
        {
            $id = $request->input('id');
            $obj = User::find($id);
        }

        $admins = Admin::orderby('username')->where('status', 1)->get();
        $services = Dichvu::pluck('name', 'id');
        $agents = User::pluck('name', 'id');

        return view('CRM.elements.agents.process.modal-proposal', [
            'obj' => !empty($obj) ? $obj : '',
            'admins' => $admins,
            'services' => $services,
            'agents' => $agents
        ]);
    }

    public function storeProposal(Request $request, $id)
    {
        if (!$request->user()->can('proposal.store')) return abort(403);
        $data = $request->all();
        if ($id == 0) {
            $id = $request->get('user_id');
        }
        $data['user_id'] = $id;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);

        Proposal::create($data);

        if ($request->get('submit_from') == 'task_sale') {
            $startDate = (!empty($request->processing_date_proposal_start)) ? convert_date_to_db($request->processing_date_proposal_start) : date('Y-01-01');
            $endDate = (!empty($request->processing_date_proposal_end)) ? convert_date_to_db($request->processing_date_proposal_end) . ' 23:59:59' : date('Y-m-d 23:59:59');

            $proposals = Proposal::when($request->get('agent_proposal_filter'), function ($query) use ($request) {
                $query->whereHas('agent', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->get('agent_proposal_filter') . '%');
                });
            })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('processing_date', [$startDate, $endDate]);
            })->when(($request->get('issue_proposal_filter')), function ($query) use ($request) {
                $query->where('issue', $request->get('issue_proposal_filter'));
            })->when($request->get('person_in_charge_proposal_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_proposal_filter') . '%');
            })->when($request->get('agent_id'),function($query) use ($request) {
                $query->where('user_id',$request->get('agent_id'));
            })
                ->with([
                    'agent',
                    'admin'
                ])
                ->orderBy('processing_date', 'desc')
                ->paginate(10);
            $lastPage = $proposals->lastPage();
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.proposal_agent.data', compact(
                    'proposals'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create'
            ]);
        } else {
            $proposals = Proposal::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.proposal-table', compact(
                'proposals'
            ));
        }
    }
    public function editProposal(Request $request)
    {
        if (!$request->user()->can('proposal.edit')) return abort(403);

        $agent_id = $request->get('agent_id');
        $proposalId = $request->get('id');
        $obj = User::find($agent_id);
        if(empty($obj)){
            return response()->json(['error'=>'User not found']);
        }
        $proposal = Proposal::find($proposalId);
        if(empty($proposal)){
            return response()->json(['error'=>'Proposal not found']);
        }
        return view('CRM.elements.agents.process.modal-proposal', [
            'obj' => $obj,
            'proposal' => $proposal
        ]);
    }
    public function updateProposal(Request $request, $agent_id, $proposal_id)
    {
        if (!$request->user()->can('proposal.update')) return abort(403);

        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $proposal = Proposal::findOrFail($proposal_id);
        $proposal->update($data);
        if ($request->get('submit_from') == 'task_sale') {
            $proposals = [$proposal];
            return response()->json([
                'view' => view('CRM.elements.task.sale.table.proposal_agent.data', compact(
                    'proposals'
                ))->render(),
                'type' => 'update',
                'id' => $proposal->id
            ]);
        } else {
            $proposals = Proposal::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
            return view('CRM.elements.agents.partials.proposal-table', compact(
                'proposals'
            ));
        }
    }
    public function destroyProposal(Request $request, $agent_id, $proposal_id)
    {
        if (!$request->user()->can('proposal.delete')) return abort(403);

        $proposal = Proposal::findOrFail($proposal_id);
        $proposal->delete();
        $proposals = Proposal::where('user_id', $agent_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.proposal-table', compact(
            'proposals'
        ));
    }



    public function changeStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('value');
        $obj = User::find($id);
        if ($obj == null) {
            $code = "danger";
            $msg = "Can not find User data to update status!";
        } else {
            $old_status = $obj->status;
            $obj->update(['status' => $status]);
            $t_old = isset(config('admin.status')[$old_status]) ? config('admin.status')[$old_status] : '';
            $n_old = isset(config('admin.status')[$status]) ? config('admin.status')[$status] : '';
            $code = "primary";
            $msg = "Change status agent from (" . $t_old . ') to (' . $n_old . ') successful !';
        }
        return view('CRM.elements.process.alert', ['msg' => $msg, 'code' => $code]);
    }

    public function storeTask(Request $request)
    {
        if ($request->page_id == 1) {
            $name_session = 'agent-process';
            session()->put('agent_process_tab', 5);
        } else if ($request->page_id == 2) {
            $name_session = 'apply-process';
            session()->put('apply_process_tab', 5);
        } else {
            $name_session = "task";
        }
        $data = $request->all();
        if (isset($data['person_in_charge']) && sizeof($data['person_in_charge']) > 0) {
            $data['person_in_charge'] = implode(";", $data['person_in_charge']);
        }
        $start_date = $request->from_date;
        $to_date = $request->to_date;
        $arr_start = explode(" ", $start_date);
        $arr_to = explode(" ", $to_date);
        $date_start = date_format(date_create_from_format('d/m/Y', $arr_start[0]), 'Y-m-d');
        $date_to = date_format(date_create_from_format('d/m/Y', $arr_to[0]), 'Y-m-d');
        if ($date_start . $arr_start[1] >= $date_to . $arr_to[1]) {
            Session::flash('error-' . $name_session, 'Date from must smaller date to !');
            return redirect()->back();
        }
        $task = Support::find($request->task_id);
        if ($task == null && $request->action_type == 0) {
            Support::create($data);
            Session::flash('success-' . $name_session, 'Create new task successful !');
        } elseif ($task != null) {
            if ($request->action_type == 0) {
                $task->update($data);
                Session::flash('success-' . $name_session, 'Update task successful !');
            } else {
                $task->delete();
                Session::flash('success-' . $name_session, 'Delete task successful !');
            }
        }

        return redirect()->back();
    }

    public function editTask(Request $request)
    {
        $task_id = $request->input('task_id');
        $task = Support::where('id', $task_id)->first();
        $msg_code = 1;
        if ($task == null) $msg_code = 0;
        if ($msg_code == 0) return ['status' => 0];
        $data =  $task->toArray();
        $opt = "";
        if (isset(config('myconfig.type_system')[$task->service])) {
            foreach (config('myconfig.type_system')[$task->service] as $key => $value) {
                if ($value == $task->type_service) {
                    $opt .= "<option value='" . $value . "' selected >" . $value . "</option>";
                } else $opt .= "<option value='" . $value . "'>" . $value . "</option>";
            }
        }
        $data['opt'] = $opt;
        return ['status' => $msg_code, 'content' => $data];
    }
    public function getFollowAgent(Request $request)
    {
        $user_id = $request->get('user_id');
        $follows = Follow::with(['agent','staff'])->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.follow-ups-table', compact('follows'));
    }
    public function getMarketFeedback(Request $request)
    {
        $user_id = $request->get('user_id');
        $marketFeedbacks = MarketFeedback::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.market-feedback-table', compact('marketFeedbacks'));
    }
    public function getCompetitionFeedback(Request $request)
    {
        $user_id = $request->get('user_id');
        $competitionFeedbacks = CompetitionFeedback::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.competition-feedback-table', compact('competitionFeedbacks'));
    }
    public function getMarketingSupport(Request $request)
    {
        $user_id = $request->get('user_id');
        $marketingSupports = MarketingSupport::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('CRM.elements.agents.partials.marketing-support-table', compact('marketingSupports'));
    }
    public function getProposal(Request $request)
    {
        $user_id = $request->get('user_id');
        $proposals = Proposal::where('user_id', $user_id)
            ->with([
                'agent'
            ])
            ->orderBy('id', 'desc')
            ->get();
        return view('CRM.elements.agents.partials.proposal-table', compact('proposals'));
    }
}
