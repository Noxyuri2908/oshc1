<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin\Apply;
use App\Admin\CompetitionFeedback;
use App\Admin\Dichvu;
use App\Admin\Follow;
use App\Admin\MarketFeedback;
use App\Admin\Proposal;
use App\Admin\SaleTaskAssign;
use App\Admin\Trainings;
use App\Components\GoogleClient;
use App\Exports\FollowUpsExport;
use App\Exports\MediaWebsiteExport;
use App\Exports\TaskSaleCollectionExport;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Doctrine\Instantiator\Exception\ExceptionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Session;
use function GuzzleHttp\Psr7\str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $client;

    public function index(Request $request)
    {
        return view('CRM.elements.task.index', [
            'flag' => "task",
        ]);
    }

    public function sale(Request $request)
    {
        $admins = Admin::pluck('username', 'id');
        $dichvus = Dichvu::pluck('name', 'id');
        $typeSaleTask = SaleTaskAssign::$TYPE;
        $agents = User::pluck('name', 'id');

        $configFollowUp = config('settings.follows_up.keys');
        $configFollowsUpByOrder = sortSettingsByOrder($configFollowUp);

        $tableSale = [
            [
                'id' => 'follow-up',
                'name' => 'FOLLOW UP AGENT',
            ],
            [
                'id' => 'appointment',
                'name' => 'APPOINTMENT & VISIT AGENT',
            ],
            [
                'id' => 'market-feedback',
                'name' => 'MARKET FEEDBACK',
            ],
            [
                'id' => 'competitor-feedback',
                'name' => 'COMPETITOR FEEDBACK',
            ],
            [
                'id' => 'tasks-asigned',
                'name' => 'TASKS ASIGNED',
            ],
            [
                'id' => 'training',
                'name' => 'TRAINING',
            ],
            [
                'id' => 'proposal',
                'name' => 'PROPOSAL',
            ],
            [
                'id' => 'agent-report',
                'name' => 'AGENT REPORT',
            ],
            [
                'id' => 'invoice-report',
                'name' => 'PENDING INVOICE/ CERTIFICATE/EXTEND FOLLOW UP',
            ],
        ];
        // dd(trans('lang'));
        return view('CRM.elements.task.sale.sale', [
            'flag' => 'tasks.sale',
            'admins' => $admins,
            'dichvus' => $dichvus,
            'typeSaleTask' => $typeSaleTask,
            'agents' => $agents,
            'configFollowsUpByOrder' => $configFollowsUpByOrder
        ], compact('tableSale'));
    }

    public function getFollowUps(Request $request)
    {
        if (!$request->user()->can('followUp.index')) return abort(403);
        $getChildUser = getChildUser('followUp');
        $startDate = (!empty($request->processing_date_follow_ups_start)) ? convert_date_to_db($request->processing_date_follow_ups_start) : null;
        $endDate = (!empty($request->processing_date_follow_ups_end)) ? convert_date_to_db($request->processing_date_follow_ups_end) : null;
        $startDate_duedate = convert_date_to_db($request->get('due_date_follow_ups_start'));
        $endDate_duedate = convert_date_to_db($request->get('due_date_follow_ups_end'));
        $hotIssue = null;
        if ($request->get('hot_issue_follow_ups') == 'not')
        {
            $hotIssue = false;
        }elseif($request->get('hot_issue_follow_ups') == 1)
        {
            $hotIssue = true;
        }

        if (!empty($request->get('filter_date_option'))) {
            if ($request->get('filter_date_option') == 'week') {
                $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'month') {
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'year') {
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            }
            $endDate = date('Y-m-d');
        }
        $potential_service_follow_ups_filter = (!empty($request->get('potential_service_follow_ups_filter'))) ? json_decode($request->get('potential_service_follow_ups_filter')) : [];
        $arrayPotential = collect($potential_service_follow_ups_filter)->pluck('id')->toArray();
        if (!empty($request->get('potential_service_follow_ups_filter')) || $request->get('rating_follow_ups_filter')) {
            $user_ids = User::when($request->get('potential_service_follow_ups_filter') && $request->get('potential_service_follow_ups_filter') != '[]', function ($query) use ($request, $arrayPotential, $potential_service_follow_ups_filter) {
                $query->whereJsonContains('potential_service', $potential_service_follow_ups_filter);
            })->when($request->get('rating_follow_ups_filter'), function ($query) use ($request) {
                $query->where('rating', $request->get('rating_follow_ups_filter'));
            })->pluck('id');
        } else {
            $user_ids = [];
        }

        $flagStatus =  !empty($request->get('follow_ups_status')) || $request->get('follow_ups_status') == '0' ? true : false;
        $followUpsStatus = (int)$request->get('follow_ups_status');

        $followUps = Follow::when($request->get('agent_follow_ups_filter'), function ($query) use ($request, $startDate, $endDate, $hotIssue) {
            $query->whereHas('agent', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('agent_follow_ups_filter') . '%');
            });
        })
            ->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
                $query->whereBetween('process_date', [$startDate, $endDate]);
            })
            ->when($request->get('status_follow_ups_filter'), function ($query) use ($request) {
                $query->where('status', $request->get('status_follow_ups_filter'));
            })
            ->when($request->get('contact_by_follow_ups_filter'), function ($query) use ($request) {
                $query->where('contact_by', $request->get('contact_by_follow_ups_filter'));
            })
            ->when($request->get('person_in_charge_follow_ups_filter'), function ($query) use ($request) {
                $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_follow_ups_filter') . '%');
            })
            ->when($request->get('filter_date_option'), function ($query) use ($request) {
                if ($request->get('filter_date_option') == 'week') {
                    $query->whereBetween('process_date', [
                        Carbon::now()->startOfWeek()->format('Y-m-d'),
                        Carbon::now()->format('Y-m-d'),
                    ]);
                } else {
                    if ($request->get('filter_date_option') == 'month') {
                        $query->whereBetween('process_date', [
                            Carbon::now()->startOfMonth()->format('Y-m-d'),
                            Carbon::now()->format('Y-m-d'),
                        ]);
                    } else {
                        if ($request->get('filter_date_option') == 'year') {
                            $query->whereBetween('process_date', [
                                Carbon::now()->startOfYear()->format('Y-m-d'),
                                Carbon::now()->format('Y-m-d'),
                            ]);
                        }
                    }
                }
            })
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('user_id', $request->get('agent_id'));
            })
            ->when($request->get('potential_service_follow_ups_filter') || $request->get('rating_follow_ups_filter'), function ($query) use ($user_ids) {
                $query->whereIn('user_id', $user_ids);
            })
            ->when($request->get('due_date_follow_ups_start') && $request->get('due_date_follow_ups_end'), function ($query) use ($request, $startDate_duedate, $endDate_duedate) {
                $query->whereBetween('due_date', [$startDate_duedate, $endDate_duedate]);
            })
            ->when($request->get('assign_follow_ups'), function ($query) use ($request) {
                $query->where('assigned_person', $request->get('assign_follow_ups'));
            })
            ->when($flagStatus, function ($query) use ($request, $followUpsStatus) {
                $query->where('follow_up_status', $followUpsStatus);
            })
            ->when($request->get('create_by_follow_ups'), function ($query) use ($request) {
                $query->where('create_person', $request->get('create_by_follow_ups'));
            })
            ->when($hotIssue, function ($query) use ($request, $hotIssue) {
                $query->where('hot_issue', $hotIssue);
            })
            ->when($request->get('hot_issue_follow_ups'), function ($query) use ($request) {
                $query->where('hot_issue', $request->get('hot_issue_follow_ups'));
            })
            ->with([
                'agent.follows' => function ($follow) {
                    $follow->orderBy('process_date', 'desc');
                },
                'staff',
            ])
            ->orderBy('process_date', 'desc')
            ->orderBy('id', 'desc');
        if ($getChildUser['permissionSee']->contains(3)) {
            $followUps->where('person_in_charge', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $followUps->whereIn('person_in_charge', $getChildUser['getAllAdminDepartment']);
        }

        $fl_up_status = config('myconfig.task_follow_up_status');

        if ($startDate && $endDate) {
            $followUps = $followUps->get();
            $lastPage = 0;

            return response()->json([
                'view' => view('CRM.elements.task.sale.table.follow_up_agent.data', compact(
                    'followUps',
                    'fl_up_status'

                ))->render(),
                'last_page' => $lastPage,
            ]);
        }

        $followUps = $followUps->paginate(20);
        $lastPage = $followUps->lastPage();

        return response()->json([
            'view' => view('CRM.elements.task.sale.table.follow_up_agent.data', compact(
                'followUps',
                'fl_up_status'
            ))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function exportToExcelFollowUp(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new FollowUpsExport($request), 'Followup.xlsx');
    }

    public function exportToPdfFollowUp(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new FollowUpsExport($request), 'Followup.pdf', Excel::DOMPDF);
    }

    public function getMarketFeedbacks(Request $request)
    {
        if (!$request->user()->can('agentFeedback.index')) return abort(403);
        $getChildUser = getChildUser('agentFeedback');
        $startDate = (!empty($request->processing_date_market_feedback_start)) ? convert_date_to_db($request->processing_date_market_feedback_start) : date('Y-01-01');
        $endDate = (!empty($request->processing_date_market_feedback_end)) ? convert_date_to_db($request->processing_date_market_feedback_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
        if ($request->get('agent_market_feedback_filter')) {
            $agent_ids = User::when($request->get('agent_market_feedback_filter'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->get('agent_market_feedback_filter') . '%');
            })->pluck('id');
        } else {
            $agent_ids = [];
        }

        $marketFeedbacks = MarketFeedback::when($request->get('agent_market_feedback_filter'), function ($query) use ($agent_ids) {
            $query->whereIn('user_id', $agent_ids);
        })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
            $query->whereBetween('processing_date', [$startDate, $endDate]);
        })->when(($request->get('issue_market_feedback_filter')), function ($query) use ($request) {
            $query->where('issue', $request->get('issue_market_feedback_filter'));
        })->when($request->get('person_in_charge_market_feedback_filter'), function ($query) use ($request) {
            $query->where('person_in_charge', 'LIKE', '%' . $request->get('person_in_charge_market_feedback_filter') . '%');
        })->when($request->get('agent_id'), function ($query) use ($request) {
            $query->where('user_id', $request->get('agent_id'));
        })
            ->with([
                'agent',
                'admin',
            ])
            ->orderBy('processing_date', 'desc');
        if ($getChildUser['permissionSee']->contains(3)) {
            $marketFeedbacks->where('person_in_charge', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $marketFeedbacks->whereIn('person_in_charge', $getChildUser['getAllAdminDepartment']);
        }
        $marketFeedbacks = $marketFeedbacks->paginate(20);
        $lastPage = $marketFeedbacks->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.market_feedback_agent.data', compact(
                'marketFeedbacks'
            ))->render(),
            'last_page' => $lastPage,
        ]);
        // return new MarketFeedbackCollection($marketFeedbacks);
    }

    public function getCompetitorFeedbacks(Request $request)
    {
        if (!$request->user()->can('competitorUpdate.index')) return abort(403);
        $getChildUser = getChildUser('competitorUpdate');
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
        })->when($request->get('agent_id'), function ($query) use ($request) {
            $query->where('user_id', $request->get('agent_id'));
        })
            ->with(['agent'])
            ->orderBy('processing_date', 'desc');
        if ($getChildUser['permissionSee']->contains(3)) {
            $competitionFeedbacks->where('person_in_charge', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $competitionFeedbacks->whereIn('person_in_charge', $getChildUser['getAllAdminDepartment']);
        }
        $competitionFeedbacks = $competitionFeedbacks->paginate(20);
        $lastPage = $competitionFeedbacks->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.competition_feedback_agent.data', compact(
                'competitionFeedbacks'
            ))->render(),
            'last_page' => $lastPage,
        ]);
        // return new CompetitorFeedbackCollection($competitorFeedbacks);
    }

    public function getProposals(Request $request)
    {
        if (!$request->user()->can('proposal.index')) return abort(403);
        $getChildUser = getChildUser('proposal');
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
        })->when($request->get('agent_id'), function ($query) use ($request) {
            $query->where('user_id', $request->get('agent_id'));
        })
        ->when($request->get('create_person_proposal_filter'), function ($query) use ($request) {
            $query->where('create_person', $request->get('create_person_proposal_filter'));
        })
        ->with([
            'agent',
            'admin',
        ])
        ->orderBy('processing_date', 'desc');

        if ($getChildUser['permissionSee']->contains(3)) {
            $proposals->where('person_in_charge', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $proposals->whereIn('person_in_charge', $getChildUser['getAllAdminDepartment']);
        }
        $proposals = $proposals->paginate(20);
        $lastPage = $proposals->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.proposal_agent.data', compact(
                'proposals'
            ))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function getTrainings(Request $request)
    {
        if (!$request->user()->can('training.index')) return abort(403);
        $startDate = (!empty($request->deadline_training_start)) ? convert_date_to_db($request->deadline_training_start) : date('Y-01-01');
        $endDate = (!empty($request->deadline_training_end)) ? convert_date_to_db($request->deadline_training_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
        $trainings = Trainings::when($request->get('processing_date_training_start') && $request->get('processing_date_training_end'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [
                convert_date_to_db($request->get('processing_date_training_start')),
                convert_date_to_db($request->get('processing_date_training_end')),
            ]);
        })->when($startDate && $endDate, function ($query) use ($request, $startDate, $endDate) {
            $query->whereBetween('deadline', [$startDate, $endDate]);
        })->when(($request->get('type_training_filter')), function ($query) use ($request) {
            $query->where('type', $request->get('type_training_filter'));
        })->when(($request->get('result_training_filter')), function ($query) use ($request) {
            $query->where('result', $request->get('result_training_filter'));
        })->when(($request->get('item_training_filter')), function ($query) use ($request) {
            $query->where('item', 'LIKE', '%' . $request->get('item_training_filter') . '%');
        })->orderBy('id', 'desc');
        $trainings = $trainings->paginate(20);
        $lastPage = $trainings->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.training-agent.data', compact(
                'trainings'
            ))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function createTraining(Request $request)
    {
        if (!$request->user()->can('training.store')) return abort(403);
        return view('CRM.elements.task.sale.table.training-agent.form-modal');
    }

    public function storeTraining(Request $request)
    {
        if (!$request->user()->can('training.store')) return abort(403);

        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $data['deadline'] = convert_date_to_db($data['deadline']);
        Trainings::create($data);
        $trainings = Trainings::orderBy('id', 'desc')->paginate(7);
        $lastPage = $trainings->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.training-agent.data', compact('trainings'))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function editTraining(Request $request, $id)
    {
        if (!$request->user()->can('training.edit')) return abort(403);

        $training = Trainings::findOrFail($id);
        return view('CRM.elements.task.sale.table.training-agent.form-modal', compact('training'));
    }

    public function updateTraining(Request $request, $id)
    {
        if (!$request->user()->can('training.update')) return abort(403);

        $data = $request->all();
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $data['deadline'] = convert_date_to_db($data['deadline']);
        $training = Trainings::findOrFail($id);
        $training->update($data);
        $trainings = Trainings::orderBy('id', 'desc')->paginate(7);
        $lastPage = $trainings->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.training-agent.data', compact('trainings'))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function destroyTraining(Request $request, $id)
    {
        if (!$request->user()->can('training.delete')) return abort(403);
        $training = Trainings::findOrFail($id);
        $training->delete();
        $trainings = Trainings::orderBy('id', 'desc')->paginate(7);
        $lastPage = $trainings->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.training-agent.data', compact('trainings'))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function getSaleTaskAssign(Request $request)
    {
        if (!$request->user()->can('tasksAsigned.index')) return abort(403);
        $getChildUser = getChildUser('tasksAsigned');
        $typeTableId = $request->get('type_table');
        $typeTask = (!empty($typeTableId)) ? SaleTaskAssign::$TYPE[$typeTableId] : '';
        $dataSaleTaskAssign = SaleTaskAssign::when($request->get('processing_date_sale_task_assign_start') && $request->get('processing_date_sale_task_assign_end'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [
                convert_date_to_db($request->get('processing_date_sale_task_assign_start')),
                convert_date_to_db($request->get('processing_date_sale_task_assign_end')),
            ]);
        })
            ->when($request->get('deadline_sale_task_assign_start') && $request->get('deadline_sale_task_assign_end'), function ($query) use ($request) {
                $query->whereBetween('deadline', [
                    convert_date_to_db($request->get('deadline_sale_task_assign_start')),
                    convert_date_to_db($request->get('deadline_sale_task_assign_end')),
                ]);
            })
            ->when(($request->get('type_sale_task_assign_filter')), function ($query) use ($request) {
                $query->where('type', $request->get('type_sale_task_assign_filter'));
            })
            ->when(($request->get('asigned_sale_task_assign_filter')), function ($query) use ($request) {
                $query->where('assigned_by', $request->get('asigned_sale_task_assign_filter'));
            })
            ->when($request->get('user_id_filter'), function ($query) use ($request) {
                $query->where('user_id', $request->get('user_id_filter'));
            })
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('user_id', $request->get('agent_id'));
            })
            ->when($request->get('data_type'), function ($query) use ($request) {
                $query->whereNotNull('user_id');
            })
            ->where('type_table', $typeTableId)
            ->with(['admin'])
            ->orderBy('id', 'desc');
        if ($getChildUser['permissionSee']->contains(3)) {
            $dataSaleTaskAssign->where('assigned_by', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $dataSaleTaskAssign->whereIn('assigned_by', $getChildUser['getAllAdminDepartment']);
        }
        $dataSaleTaskAssign = $dataSaleTaskAssign->paginate(20);
        $lastPage = $dataSaleTaskAssign->lastPage();
        return response()->json([
            'view' => view('CRM.elements.task.sale.table.sale_task_assign.data', compact('dataSaleTaskAssign', 'typeTask'))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function createSaleTaskAssign(Request $request)
    {
        if (!$request->user()->can('tasksAsigned.store')) return abort(403);
        $typeTableId = $request->get('type_table');
        $typeTask = (!empty($typeTableId)) ? SaleTaskAssign::$TYPE[$typeTableId] : '';
        $admins = Admin::pluck('username', 'id');
        $agent_id = $request->get('agent_id');
        $obj = User::find($agent_id);
        $data_type = $request->get('data_type');
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');
        return view('CRM.elements.task.sale.table.sale_task_assign.form-modal', compact(
            'typeTask',
            'admins',
            'typeTableId',
            'agent_id',
            'obj',
            'data_type',
            'fl_up_status'
        ));
    }

    public function storeSaleTaskAssign(Request $request)
    {
        if (!$request->user()->can('tasksAsigned.store')) return abort(403);
        $typeTable = $request->get('type_table');
        $typeTask = (!empty($typeTable)) ? SaleTaskAssign::$TYPE[$typeTable] : '';
        $data = $request->only([
            'processing_date',
            'item',
            'type',
            'deadline',
            'assigned_by',
            'note',
            'type_table',
            'user_id',
            'person_in_charge',
            'hot_issue',
            'assigned_person',
            'follow_up_status',
            'estimate'
        ]);

        $data['hot_issue'] = (isset($data['hot_issue']) && $data['hot_issue'] == 'on') ? true : false;
        $data['follow_up_status'] = (int)$data['follow_up_status'];
        $data['estimate'] = ($data['estimate'] != '') ? $data['estimate'] : 0;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $data['deadline'] = convert_date_to_db($data['deadline']);
        SaleTaskAssign::create($data);
        $dataSaleTaskAssign = SaleTaskAssign::when($request->get('processing_date_sale_task_assign_start') && $request->get('processing_date_sale_task_assign_end'), function ($query) use ($request) {
            $query->whereBetween('processing_date', [
                convert_date_to_db($request->get('processing_date_sale_task_assign_start')),
                convert_date_to_db($request->get('processing_date_sale_task_assign_end')),
            ]);
        })
            ->when($request->get('deadline_sale_task_assign_start') && $request->get('deadline_sale_task_assign_end'), function ($query) use ($request) {
                $query->whereBetween('deadline', [
                    convert_date_to_db($request->get('deadline_sale_task_assign_start')),
                    convert_date_to_db($request->get('deadline_sale_task_assign_end')),
                ]);
            })
            ->when(($request->get('type_sale_task_assign_filter')), function ($query) use ($request) {
                $query->where('type', $request->get('type_sale_task_assign_filter'));
            })
            ->when(($request->get('asigned_sale_task_assign_filter')), function ($query) use ($request) {
                $query->where('assigned_by', $request->get('asigned_sale_task_assign_filter'));
            })
            ->when($request->get('user_id_filter'), function ($query) use ($request) {
                $query->where('user_id', $request->get('user_id_filter'));
            })
            ->when($request->get('agent_id'), function ($query) use ($request) {
                $query->where('user_id', $request->get('agent_id'));
            })
            ->when($request->get('data_type'), function ($query) use ($request) {
                $query->whereNotNull('user_id');
            })
            ->where('type_table', $typeTable)
            ->with(['admin'])
            ->orderBy('id', 'desc')
            ->paginate(20);
        $lastPage = $dataSaleTaskAssign->lastPage();
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');

        return response()->json([
            'view' => view('CRM.elements.task.sale.table.sale_task_assign.data', compact(
                'dataSaleTaskAssign',
                'typeTask',
                'fl_up_status'
            ))->render(),
            'last_page' => $lastPage,
        ]);
    }

    public function editSaleTaskAssign(Request $request)
    {
        if (!$request->user()->can('tasksAsigned.edit')) return abort(403);
        $typeTableId = $request->get('type_table');
        $typeTask = (!empty($typeTableId)) ? SaleTaskAssign::$TYPE[$typeTableId] : '';
        $id = $request->get('id');
        $admins = Admin::pluck('username', 'id');
        $saleTaskAssign = SaleTaskAssign::findOrFail($id);
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');
        $agent_id = $request->get('agent_id');

        return view('CRM.elements.task.sale.table.sale_task_assign.form-modal', compact(
            'typeTask',
            'admins',
            'typeTableId',
            'saleTaskAssign',
            'admins',
            'fl_up_status',
            'agent_id'
        ));
    }

    public function updateSaleTaskAssign(Request $request)
    {
        if (!$request->user()->can('tasksAsigned.update')) return abort(403);
        $typeTableId = $request->get('type_table');
        $typeTask = (!empty($typeTableId)) ? SaleTaskAssign::$TYPE[$typeTableId] : '';
        $id = $request->get('id');
        $data = $request->only([
            'processing_date',
            'item',
            'type',
            'deadline',
            'assigned_by',
            'note',
            'type_table',
            'user_id',
            'person_in_charge',
            'hot_issue',
            'assigned_person',
            'follow_up_status',
            'estimate'
        ]);

        $data['hot_issue'] = (isset($data['hot_issue']) && $data['hot_issue'] == 'on') ? true : false;
        $data['follow_up_status'] = (int)$data['follow_up_status'];
        $data['estimate'] = ($data['estimate'] != '') ? $data['estimate'] : 0;
        $data['processing_date'] = convert_date_to_db($data['processing_date']);
        $data['deadline'] = convert_date_to_db($data['deadline']);
        $saleTaskAssign = SaleTaskAssign::findOrFail($id);
        $saleTaskAssign->update($data);
        $dataSaleTaskAssign = [$saleTaskAssign];
        // $dataSaleTaskAssign = SaleTaskAssign::where('type_table', $typeTableId)->orderBy('id', 'desc')->paginate(8);
        // $lastPage = $dataSaleTaskAssign->lastPage();
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');

        return response()->json([
            'view' => view('CRM.elements.task.sale.table.sale_task_assign.data', compact(
                'dataSaleTaskAssign',
                'typeTask',
                'fl_up_status'
            ))->render(),
            'id' => $saleTaskAssign->id,
        ]);
    }

    public function destroySaleTaskAssign(Request $request, $id)
    {
        if (!$request->user()->can('tasksAsigned.delete')) return abort(403);
        $typeTableId = $request->get('type_table');
        $typeTask = (!empty($typeTableId)) ? SaleTaskAssign::$TYPE[$typeTableId] : '';
        $saleTaskAssign = SaleTaskAssign::findOrFail($id);
        $saleTaskAssign->delete();
        $dataSaleTaskAssign = SaleTaskAssign::where('type_table', $typeTableId)->orderBy('id', 'desc')->paginate(8);
        $lastPage = $dataSaleTaskAssign->lastPage();
        return response()->json([
            'id' => $saleTaskAssign->id,
        ]);
    }

    public function saleReportIndex(Request $request)
    {
        $typeSaleTask = SaleTaskAssign::$TYPE;
        $flag = 'task.sale.report.index';
        $cooperating = 4;
        $signedContract = 3;
        $pendingStatus = 6;
        $remindStatusExtend = 2;
        $remindStatusPending = 1;
        $typeFromOshcOvhc = 1;
        $typeFromFlywire = 3;
        $getIdOshcOvhc = Dichvu::where('type_form', $typeFromOshcOvhc)->pluck('id', 'name');
        $getIdFlywire = Dichvu::where('type_form', $typeFromFlywire)->pluck('id', 'name');
        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_start_end)) ? convert_date_to_db($request->report_start_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
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
        //table1
        $getUserSignedContractByDate = User::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', $signedContract)
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format('Y-m-d');
            });
        $getUserHasCaseByDate = User::whereBetween('first_case_date', [$startDate, $endDate])
            ->whereNotNull('had_case')
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->first_case_date)->format('Y-m-d');
            });
        $interval = new DateInterval('P1D');
        $periods = new DatePeriod(
            Carbon::parse($startDate),
            $interval,
            Carbon::parse($endDate)
        );

        $graphGetCustomerDay = array_map(function ($periods) use ($getUserSignedContractByDate, $getUserHasCaseByDate) {
            $day = $periods->format('Y-m-d');
            if ($getUserSignedContractByDate->has($day) || $getUserHasCaseByDate->has($day)) {
                return [
                    'date' => $periods->format('d/m/Y'),
                    'new_contract' => $getUserSignedContractByDate->has($day) ? $getUserSignedContractByDate->get($day)
                        ->pluck('name')
                        ->join(',') : '',
                    'first_case' => $getUserHasCaseByDate->has($day) ? $getUserHasCaseByDate->get($day)
                        ->pluck('name')
                        ->join(',') : '',
                ];
            }
        }, iterator_to_array($periods));
        $getAgentReport = array_filter($graphGetCustomerDay);

        $getUserCooperatingByDate = User::with('info')->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', $cooperating)
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format('Y-m-d');
            });
        //end table 1
        $getTaskPending = Apply::where('status', $pendingStatus)
            ->whereIn('type_service', $getIdOshcOvhc)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getComAu = Apply::with(['hoahongs'])
            ->whereHas('hoahongs', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('issue_date', [$startDate, $endDate]);
            })
            ->whereIn('type_service', $getIdOshcOvhc)
            ->where('service_country', 'A')
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getRemindExtendPendingAu = Apply::where('service_country', 'A')
            ->whereBetween('processing_date_remind', [$startDate, $endDate])
            ->whereIn('type_service', $getIdOshcOvhc)
            ->where('remind_status', $remindStatusPending)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getRemindExtendAu = Apply::where('service_country', 'A')
            ->whereBetween('processing_date_remind', [$startDate, $endDate])
            ->where('remind_status', $remindStatusExtend)
            ->whereIn('type_service', $getIdOshcOvhc)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getDataOshcOvhcHcc = array_map(function ($service) use ($getTaskPending, $getComAu, $getRemindExtendPendingAu, $getRemindExtendAu) {
            return [
                'pendingInvoice' => ($getTaskPending->has($service)) ? $getTaskPending->get($service) : 0,
                'certificase' => ($getComAu->has($service)) ? $getComAu->get($service) : 0,
                'extendRemind' => ($getRemindExtendPendingAu->has($service)) ? $getRemindExtendPendingAu->get($service) : 0,
                'extendSuccessfully' => ($getRemindExtendAu->has($service)) ? $getRemindExtendAu->get($service) : 0,
            ];
        }, $getIdOshcOvhc->toArray());
        $getCertificaseFlywire = Apply::whereBetween('initiated_date', [$startDate, $endDate])
            ->whereIn('type_service', $getIdFlywire)
            ->get()
            ->groupBy('type_service')->map(function ($query) {
                return $query->count();
            });
        $getDataFlywire = array_map(function ($service) use ($getCertificaseFlywire) {
            return [
                'pendingInvoice' => 0,
                'certificase' => ($getCertificaseFlywire->has($service)) ? $getCertificaseFlywire->get($service) : 0,
                'extendRemind' => 0,
                'extendSuccessfully' => 0,
            ];
        }, $getIdFlywire->toArray());
        return view('CRM.elements.task.sale.report.index', compact(
            'flag',
            'getAgentReport',
            'getUserCooperatingByDate',
            'getDataOshcOvhcHcc',
            'getDataFlywire',
            'typeSaleTask'
        ));
    }

    public function getAgentReports(Request $request)
    {
        if (!$request->user()->can('agentReport.index')) return abort(403);
        $cooperating = 4;
        $signedContract = 3;
        $pendingStatus = 6;
        $remindStatusExtend = 2;
        $remindStatusPending = 1;
        $typeFromOshcOvhc = 1;
        $typeFromFlywire = 3;
        $getIdOshcOvhc = Dichvu::where('type_form', $typeFromOshcOvhc)->pluck('id', 'name');
        $getIdFlywire = Dichvu::where('type_form', $typeFromFlywire)->pluck('id', 'name');
        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_start_end)) ? convert_date_to_db($request->report_start_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
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
        //table1
        $getUserSignedContractByDate = User::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', $signedContract)
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format('Y-m-d');
            });
        $getUserHasCaseByDate = User::whereBetween('first_case_date', [$startDate, $endDate])
            ->whereNotNull('had_case')
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->first_case_date)->format('Y-m-d');
            });
        $getUserCooperatingByDate = User::with('info')->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', $cooperating)
            ->get([
                'id',
                'name',
                'created_at',
            ])
            ->groupBy(function ($query) {
                return Carbon::parse($query->created_at)->format('Y-m-d');
            });
        $interval = new DateInterval('P1D');
        $periods = new DatePeriod(
            Carbon::parse($startDate),
            $interval,
            Carbon::parse($endDate)
        );

        $graphGetCustomerDay = array_map(function ($periods) use ($getUserSignedContractByDate, $getUserHasCaseByDate, $getUserCooperatingByDate) {
            $day = $periods->format('Y-m-d');
            if ($getUserSignedContractByDate->has($day) || $getUserHasCaseByDate->has($day) || $getUserCooperatingByDate->has($day)) {
                return [
                    'date' => $periods->format('Y-m-d'),
                    'new_contract' => $getUserSignedContractByDate->has($day) ? $getUserSignedContractByDate->get($day)
                        ->pluck('name') : '',
                    'first_case' => $getUserHasCaseByDate->has($day) ? $getUserHasCaseByDate->get($day)
                        ->pluck('name') : '',
                    'new_agent' => $getUserCooperatingByDate->has($day) ? $getUserCooperatingByDate->get($day)
                        ->pluck('name') : '',
                    'note_new_agent' => $getUserCooperatingByDate->has($day) ? $getUserCooperatingByDate->get($day)
                        ->pluck('note', 'name') : '',
                ];
            }
        }, iterator_to_array($periods));
        $getAgentReport = collect(array_filter($graphGetCustomerDay))->sortByDesc(function ($case) {
            return $case['date'];
        });
        return view('CRM.elements.task.sale.table.agent-report.data', compact('getAgentReport'));
    }

    public function getInvoiceReports(Request $request)
    {
        $cooperating = 4;
        $signedContract = 3;
        $pendingStatus = 6;
        $remindStatusExtend = 2;
        $remindStatusPending = 1;
        $typeFromOshcOvhc = 1;
        $typeFromFlywire = 3;
        $getIdOshcOvhc = Dichvu::where('type_form', $typeFromOshcOvhc)->pluck('id', 'name');
        $getIdFlywire = Dichvu::where('type_form', $typeFromFlywire)->pluck('id', 'name');
        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_start_end)) ? convert_date_to_db($request->report_start_end) . ' 23:59:59' : date('Y-m-d 23:59:59');
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
        $getTaskPending = Apply::where('status', $pendingStatus)
            ->whereIn('type_service', $getIdOshcOvhc)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getComAu = Apply::with(['hoahongs'])
            ->whereHas('hoahongs', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('issue_date', [$startDate, $endDate]);
            })
            ->whereIn('type_service', $getIdOshcOvhc)
            ->where('service_country', 'A')
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getRemindExtendPendingAu = Apply::where('service_country', 'A')
            ->whereBetween('processing_date_remind', [$startDate, $endDate])
            ->whereIn('type_service', $getIdOshcOvhc)
            ->where('remind_status', $remindStatusPending)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getRemindExtendAu = Apply::where('service_country', 'A')
            ->whereBetween('processing_date_remind', [$startDate, $endDate])
            ->where('remind_status', $remindStatusExtend)
            ->whereIn('type_service', $getIdOshcOvhc)
            ->get()
            ->groupBy('type_service')->map(function ($pending) {
                return $pending->count();
            });
        $getDataOshcOvhcHcc = array_map(function ($service) use ($getTaskPending, $getComAu, $getRemindExtendPendingAu, $getRemindExtendAu) {
            return [
                'pendingInvoice' => ($getTaskPending->has($service)) ? $getTaskPending->get($service) : 0,
                'certificase' => ($getComAu->has($service)) ? $getComAu->get($service) : 0,
                'extendRemind' => ($getRemindExtendPendingAu->has($service)) ? $getRemindExtendPendingAu->get($service) : 0,
                'extendSuccessfully' => ($getRemindExtendAu->has($service)) ? $getRemindExtendAu->get($service) : 0,
            ];
        }, $getIdOshcOvhc->toArray());

        $getCertificaseFlywire = Apply::whereBetween('initiated_date', [$startDate, $endDate])
            ->whereIn('type_service', $getIdFlywire)
            ->get()
            ->groupBy('type_service')->map(function ($query) {
                return $query->count();
            });
        $getDataFlywire = array_map(function ($service) use ($getCertificaseFlywire) {
            return [
                'pendingInvoice' => 0,
                'certificase' => ($getCertificaseFlywire->has($service)) ? $getCertificaseFlywire->get($service) : 0,
                'extendRemind' => 0,
                'extendSuccessfully' => 0,
            ];
        }, $getIdFlywire->toArray());

        return view('CRM.elements.task.sale.table.invoice-report.data', compact(
            'getDataFlywire',
            'getDataOshcOvhcHcc'
        ));
    }

    public function exportExcelTaskSale(Request $request, GoogleClient $client)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new TaskSaleCollectionExport($request, $client), 'Export.xlsx');
    }

    public function media(Request $request)
    {
        //        if(!$request->user()->can('mediaTask.index'))abort(403);
        $flag = 'tasks.media';
        return view('CRM.elements.task.media.media', compact('flag'));
    }

    public function getMediaPost(Request $request, $getMediaPost)
    {
        $startDateSchedule = convert_date_to_db($request->get('schedule_post_date_start'));
        $endDateSchedule = convert_date_to_db($request->get('schedule_post_date_end'));
        $startDateCreatedPost = convert_date_to_db($request->get('created_post_start'));
        $endDateCreatedPost = convert_date_to_db($request->get('created_post_end'));
        $startDateFanpagePost = convert_date_to_db($request->get('post_date_fanpage_start'));
        $endDateFanpagePost = convert_date_to_db($request->get('post_date_fanpage_end'));
        $startDateNewsletter = convert_date_to_db($request->get('post_date_newletter_start'));
        $endDateNewsletter = convert_date_to_db($request->get('post_date_newletter_end'));

        $startSelectedEmailMKT = $request->get('start_number_of_selected_email_marketing');
        $endSelectedEmailMKT = $request->get('end_number_of_selected_email_marketing');
        $startNumberClickEmailMKT = $request->get('start_number_of_clicked_link_email_marketing');
        $endNumberClickEmailMKT = $request->get('end_number_of_clicked_link_email_marketing');
        $startNumberAgentOnEmailMKT = $request->get('start_number_of_agent_onshore_email_marketing');
        $endNumberAgentOnEmailMKT = $request->get('end_number_of_agent_onshore_email_marketing');
        $startNumberAgentOffEmailMKT = $request->get('start_number_of_agent_offshore_email_marketing');
        $endNumberAgentOffEmailMKT = $request->get('end_number_of_agent_offshore_email_marketing');
        $startNumberPromoEmailMKT = $request->get('start_number_of_promotion_email_marketing');
        $endNumberPromoEmailMKT = $request->get('end_number_of_promotion_email_marketing');
        $startMoneyAUDEmailMKT = $request->get('start_amount_of_money_aud_email_marketing');
        $endMoneyAUDEmailMKT = $request->get('end_amount_of_money_aud_email_marketing');
        $startMoneyVNDEmailMKT = $request->get('start_amount_of_money_vnd_email_marketing');
        $endMoneyVNDEmailMKT = $request->get('end_amount_of_money_vnd_email_marketing');
        $startToTalMoneyEmailMKT = $request->get('start_total_amount_of_money_email_marketing');
        $endToTalMoneyEmailMKT = $request->get('end_total_amount_of_money_email_marketing');
        $startPostDateEmailMKT = convert_date_to_db($request->get('start_post_date_send'));
        $endPostDateEmailMKT = convert_date_to_db($request->get('end_post_date_send'));

        $mediaPosts = Admin\MediaPost::when($request->get('group_id'), function ($query) use ($request) {
            $query->where('group_id', $request->get('group_id'));
        })
            ->when($startDateSchedule && $endDateSchedule, function ($query) use ($request, $startDateSchedule, $endDateSchedule) {
                $query->whereBetween('schedule_post_date', [$startDateSchedule, $endDateSchedule]);
            })
            ->when($request->get('post_title'), function ($query) use ($request) {
                $query->where('post_title', 'LIKE', '%' . $request->get('post_title') . '%');
            })
            ->when($request->get('post_link'), function ($query) use ($request) {
                $query->where('post_link', 'LIKE', '%' . $request->get('post_link') . '%');
            })
            ->when($request->get('service_id'), function ($query) use ($request) {
                $query->where('service_id', $request->get('service_id'));
            })
            ->when($request->get('type_source'), function ($query) use ($request) {
                $query->where('type_source', $request->get('type_source'));
            })
            ->when($request->get('source_pr'), function ($query) use ($request) {
                $query->where('source_pr', 'LIKE', '%' . $request->get('source_pr') . '%');
            })
            ->when($request->get('source_pr'), function ($query) use ($request) {
                $query->where('source_pr', 'LIKE', '%' . $request->get('source_pr') . '%');
            })
            ->when($request->get('rate'), function ($query) use ($request) {
                $query->where('rate', $request->get('rate'));
            })
            ->when($startDateFanpagePost && $endDateFanpagePost, function ($query) use ($request, $startDateFanpagePost, $endDateFanpagePost) {
                $query->whereBetween('post_date_fanpage', [$startDateFanpagePost, $endDateFanpagePost]);
            })
            ->when($startDateNewsletter && $endDateNewsletter, function ($query) use ($request, $startDateNewsletter, $endDateNewsletter) {
                $query->whereBetween('post_date_newletter', [$startDateNewsletter, $endDateNewsletter]);
            })
            ->when($request->get('created_by'), function ($query) use ($request) {
                $query->where('created_by', $request->get('created_by'));
            })
            ->when($request->get('note'), function ($query) use ($request) {
                $query->where('note', 'LIKE', '%' . $request->get('note') . '%');
            })
            ->when($request->get('budget_qc'), function ($query) use ($request) {
                $query->where('budget_qc', 'LIKE', '%' . $request->get('budget_qc') . '%');
            })
            ->when($request->get('tag'), function ($query) use ($request) {
                $query->where('tag', 'LIKE', '%' . $request->get('tag') . '%');
            })
            ->when($request->get('start_date_qc'), function ($query) use ($request) {
                $query->whereDate('start_date_qc', convert_date_to_db($request->get('start_date_qc')));
            })
            ->when($request->get('total_budget'), function ($query) use ($request) {
                $query->where('total_budget', 'LIKE', '%' . $request->get('total_budget') . '%');
            })
            ->when($request->get('credit_card'), function ($query) use ($request) {
                $query->where('credit_card', 'LIKE', '%' . $request->get('credit_card') . '%');
            })
            ->when($request->get('source_post'), function ($query) use ($request) {
                $query->where('source_post', $request->get('source_post'));
            })
            ->when($request->get('source_detail'), function ($query) use ($request) {
                $query->where('source_detail', $request->get('source_detail'));
            })
            ->when($request->get('translated_by'), function ($query) use ($request) {
                $query->where('translated_by', $request->get('translated_by'));
            })
            ->when($request->get('promotion_for'), function ($query) use ($request) {
                $query->where('promotion_for', $request->get('promotion_for'));
            })
            ->when($request->get('promotion_for_agent_id'), function ($query) use ($request) {
                $query->where('promotion_for_agent_id', $request->get('promotion_for_agent_id'));
            })
            ->when($request->get('category_email_marketing'), function ($query) use ($request) {
                $query->where('category_email_marketing', $request->get('category_email_marketing')); // query email  mkt
            })
            ->when($request->get('object_email_marketing'), function ($query) use ($request) {
                $query->where('object_email_marketing', $request->get('object_email_marketing')); // // query email  mkt
            })
            ->when($startSelectedEmailMKT && $endSelectedEmailMKT, function ($query) use ($request, $startSelectedEmailMKT, $endSelectedEmailMKT) {
                $query->whereBetween('number_of_selected_email_marketing', [$startSelectedEmailMKT, $endSelectedEmailMKT]); // // query email  mkt
            })
            ->when($startNumberClickEmailMKT && $endNumberClickEmailMKT, function ($query) use ($request, $startNumberClickEmailMKT, $endNumberClickEmailMKT) {
                $query->whereBetween('number_of_clicked_link_email_marketing', [$startNumberClickEmailMKT, $endNumberClickEmailMKT]); // // query email  mkt
            })
            ->when($request->get('type_of_promotion_email_marketing'), function ($query) use ($request) {
                $query->where('type_of_promotion_email_marketing', $request->get('type_of_promotion_email_marketing')); // // query email  mkt
            })
            ->when($startNumberAgentOnEmailMKT && $endNumberAgentOnEmailMKT, function ($query) use ($request, $startNumberAgentOnEmailMKT, $endNumberAgentOnEmailMKT) {
                $query->whereBetween('number_of_agent_onshore_email_marketing', [$startNumberAgentOnEmailMKT, $endNumberAgentOnEmailMKT]); // // query email  mkt
            })
            ->when($startNumberAgentOffEmailMKT && $endNumberAgentOffEmailMKT, function ($query) use ($request, $startNumberAgentOffEmailMKT, $endNumberAgentOffEmailMKT) {
                $query->whereBetween('number_of_agent_offshore_email_marketing', [$startNumberAgentOffEmailMKT, $endNumberAgentOffEmailMKT]); // // query email  mkt
            })
            ->when($startNumberPromoEmailMKT && $endNumberPromoEmailMKT, function ($query) use ($request, $startNumberPromoEmailMKT, $endNumberPromoEmailMKT) {
                $query->whereBetween('number_of_promotion_email_marketing', [$startNumberPromoEmailMKT, $endNumberPromoEmailMKT]); // // query email  mkt
            })
            ->when($startMoneyAUDEmailMKT && $endMoneyAUDEmailMKT, function ($query) use ($request, $startMoneyAUDEmailMKT, $endMoneyAUDEmailMKT) {
                $query->whereBetween('amount_of_money_aud_email_marketing', [$startMoneyAUDEmailMKT, $endMoneyAUDEmailMKT]); // // query email  mkt
            })
            ->when($startMoneyVNDEmailMKT && $endMoneyVNDEmailMKT, function ($query) use ($request, $startMoneyVNDEmailMKT, $endMoneyVNDEmailMKT) {
                $query->whereBetween('amount_of_money_vnd_email_marketing', [$startMoneyVNDEmailMKT, $endMoneyVNDEmailMKT]); // // query email  mkt
            })
            ->when($startToTalMoneyEmailMKT && $endToTalMoneyEmailMKT, function ($query) use ($request, $startToTalMoneyEmailMKT, $endToTalMoneyEmailMKT) {
                $query->whereBetween('total_amount_of_money_email_marketing', [$startToTalMoneyEmailMKT, $endToTalMoneyEmailMKT]); // // query email  mkt
            })
            ->when($request->get('note_email_marketing'), function ($query) use ($request) {
                $query->where('note_email_marketing', 'LIKE', '%' . $request->get('note_email_marketing') . '%');
            })
            ->when($request->get('post_place_id') || $request->get('category'), function ($query) use ($request, $startDateSchedule, $endDateSchedule, $startPostDateEmailMKT, $endPostDateEmailMKT) {
                $query->whereHas('typeMediaPosts', function ($query) use ($request, $startDateSchedule, $endDateSchedule, $startPostDateEmailMKT, $endPostDateEmailMKT) {
                    $query->when($request->get('post_place_id'), function ($query) use ($request) {
                        $query->where('type_content_id', $request->get('post_place_id'));
                    })
                        ->when($request->get('category'), function ($query) use ($request) {
                            $query->where('category', $request->get('category'));
                        })
                        ->when($startPostDateEmailMKT && $endPostDateEmailMKT, function ($query) use ($request, $startPostDateEmailMKT, $endPostDateEmailMKT) {
                            $query->whereBetween('post_date', [$startPostDateEmailMKT, $endPostDateEmailMKT]);
                        });
                });
            })
            ->with(['typeMediaPosts', 'user']);

        $mediaPostName = Admin\MediaPost::$TYPE[$getMediaPost];

        if (!empty($getMediaPost)) {
            if ($getMediaPost == 1) {
                if (!$request->user()->can('mediaManagerWebsite.index')) {
                    abort(403);
                }
                //$mediaPosts = $mediaPosts->where('type_media_post', '!=', 3)->orderBy('id', 'desc')->paginate(10);
                $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($q) use ($getMediaPost, $startDateCreatedPost, $endDateCreatedPost) {
                    $q->where('type_id', $getMediaPost)
                        ->when($startDateCreatedPost && $endDateCreatedPost, function ($query) use ($startDateCreatedPost, $endDateCreatedPost) {
                            $query->whereBetween('post_date', [$startDateCreatedPost, $endDateCreatedPost]); // query filter post_date
                        });
                })->orderBy('id', 'desc')->paginate(10);
                $lastPage = $mediaPosts->lastPage();
                $totalPage = $mediaPosts->total();
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.web.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'total_page' => $totalPage,
                ]);
            } elseif ($getMediaPost == 2) {
                if (!$request->user()->can('mediaManagerFanpage.index')) {
                    abort(403);
                }
                $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($q) use ($getMediaPost, $startDateCreatedPost, $endDateCreatedPost) {
                    $q->where('type_id', $getMediaPost)
                        ->when($startDateCreatedPost && $endDateCreatedPost, function ($query) use ($startDateCreatedPost, $endDateCreatedPost) {
                            $query->whereBetween('post_date', [$startDateCreatedPost, $endDateCreatedPost]); // query filter post_date
                        });
                })->orderBy('id', 'desc')->paginate(10);

                //$mediaPosts = $mediaPosts->where('type_media_post', '!=', 3)->whereNotNull('post_date_fanpage')->orderBy('id', 'desc')->paginate(10);
                $lastPage = $mediaPosts->lastPage();
                $totalPage = $mediaPosts->total();
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.fanpage.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'total_page' => $totalPage,
                ]);
            } elseif ($getMediaPost == 3) {
                if (!$request->user()->can('mediaManagerGroup.index')) {
                    abort(403);
                }
                $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($q) use ($getMediaPost) {
                    $q->where('type_id', $getMediaPost);
                })->orderBy('id', 'desc')->paginate(10);
                //$mediaPosts = $mediaPosts->where('type_media_post', 3)->orderBy('id', 'desc')->paginate(10);
                $lastPage = $mediaPosts->lastPage();
                $totalPage = $mediaPosts->total();
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.group.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'total_page' => $totalPage,
                ]);
            } elseif ($getMediaPost == 4) {
                if (!$request->user()->can('mediaManagerWebsite.index')) {
                    abort(403);
                }
                $mediaPosts = $mediaPosts->whereHas('typeMediaPosts', function ($q) use ($getMediaPost, $startPostDateEmailMKT, $endPostDateEmailMKT) {
                    $q->where('type_id', $getMediaPost)
                        ->when($startPostDateEmailMKT && $endPostDateEmailMKT, function ($query) use ($startPostDateEmailMKT, $endPostDateEmailMKT) {
                            $query->whereBetween('post_date', [$startPostDateEmailMKT, $endPostDateEmailMKT]); // query filter post_date
                        });
                })
                    ->orderBy('id', 'desc')->paginate(10);
                //$mediaPosts = $mediaPosts->whereNotNull('post_date_newletter')->where('type_media_post', '!=', 3)->orderBy('id', 'desc')->paginate(10);
                $lastPage = $mediaPosts->lastPage();
                $totalPage = $mediaPosts->total();
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.email-marketing.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'total_page' => $totalPage,
                ]);
            }
        }
    }

    public function exportMediaWebsite(Request $request, $getMediaPost)
    {
        if ($getMediaPost == 1) {
            return (new MediaWebsiteExport($request, $getMediaPost))->download('mediaWebsiteExport.xlsx');
        } elseif ($getMediaPost == 2) {
            return (new MediaWebsiteExport($request, $getMediaPost))->download('mediaFanpageExport.xlsx');
        } elseif ($getMediaPost == 3) {
            return (new MediaWebsiteExport($request, $getMediaPost))->download('mediaGroupExport.xlsx');
        } elseif ($getMediaPost == 4) {
            return (new MediaWebsiteExport($request, $getMediaPost))->download('mediaEmailMarketingExport.xlsx');
        }
    }

    public function createMediaPost(Request $request, $typeMediaPost)
    {
        $mediaPostName = Admin\MediaPost::$TYPE[$typeMediaPost];
        if ($typeMediaPost == 1) {
            if (!$request->user()->can('mediaManagerWebsite.store')) {
                abort(403);
            }
        } elseif ($typeMediaPost == 2) {
            if (!$request->user()->can('mediaManagerFanpage.store')) {
                abort(403);
            }
        } elseif ($typeMediaPost == 3) {
            if (!$request->user()->can('mediaManagerGroup.store')) {
                abort(403);
            }
        }
        if (
            $typeMediaPost == 1 ||
            $typeMediaPost == 2 ||
            $typeMediaPost == 3
        ) {
            return view('CRM.elements.task.media.table.web.form', compact(
                'typeMediaPost',
                'mediaPostName'
            ));
        }
        if ($typeMediaPost == 4) {
            return view('CRM.elements.task.media.table.email-marketing.form', compact(
                'typeMediaPost',
                'mediaPostName'
            ));
        }
    }

    public function storeMediaPost(Request $request, $getMediaPost)
    {
        if ($getMediaPost == 1) {
            if (!$request->user()->can('mediaManagerWebsite.store')) {
                abort(403);
            }
            $data = $request->only([
                'post_place_id',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'service_id',
                'type_source',
                'view',
                'source_pr',
                'rate',
                'seo',
                'created_by',
                'note',
                'post_date_newletter',
                'post_date',
                'schedule_post_date',
                'post_date_fanpage',
                'is_hotnew',
                'transfer_staff_date',
                'translated_by',
                'processing_date',
                'promote_date',
                'promotion_for',
                'promotion_for_agent_id',
            ]);
            $data['post_website'] = 1;
        } elseif ($getMediaPost == 2) {
            if (!$request->user()->can('mediaManagerFanpage.store')) {
                abort(403);
            }
            $data = $request->only([
                'post_place_id',
                'schedule_post_date_start',
                'schedule_post_date_end',
                'created_post_start',
                'created_post_end',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'post_date',
                'service_id',
                'type_source',
                'source_pr',
                'rate',
                'created_by',
                'note',
                'created_post',
                'schedule_post_date',
                'tag',
                'react',
                'like',
                'share',
                'inbox',
                'budget_qc',
                'start_date_qc',
                'number_days',
                'total_budget',
                'credit_card',
                'is_hotnew'
            ]);
            $data['post_fanpage'] = 1;
        } elseif ($getMediaPost == 3) {
            if (!$request->user()->can('mediaManagerGroup.store')) {
                abort(403);
            }
            $data = $request->only([
                'group_id',
                'created_post_start',
                'created_post_end',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'type_source',
                'rate',
                'created_by',
                'note',
                'created_post',
                'react',
                'like',
                'share',
                'is_hotnew'
            ]);
            $data['post_group'] = 1;
        } elseif ($getMediaPost == 4) {
            if (!$request->user()->can('mediaManagerGroup.store')) {
                abort(403);
            }
            $data = $request->only([
                'service_id',
                'category_email_marketing',
                'object_email_marketing',
                'number_of_selected_email_marketing',
                'number_of_clicked_link_email_marketing',
                'type_of_promotion_email_marketing',
                'number_of_agent_onshore_email_marketing',
                'number_of_agent_offshore_email_marketing',
                'number_of_promotion_email_marketing',
                'amount_of_money_aud_email_marketing',
                'amount_of_money_vnd_email_marketing',
                'total_amount_of_money_email_marketing',
                'note_email_marketing',
                'post_date_newletter',
                'post_title',
                'post_date',
                'is_hotnew',
                'schedule_post_date'
            ]);
            $data['post_email_marketing'] = 1;
        }
        $mediaPostName = Admin\MediaPost::$TYPE[$getMediaPost];
        $getTypeMediaPostList = Admin\MediaPost::$TYPE;
        $arrDateData = [
            'schedule_post_date',
            'post_date',
            'post_date_fanpage',
            'post_date_newletter',
            'transfer_staff_date',
            'processing_date',
            'promote_date',
        ];
        foreach ($arrDateData as $key) {
            if (!empty($data[$key])) {
                $data[$key] = convert_date_to_db($data[$key]);
            } else {
                unset($data[$key]);
            }
        }
        $arrNumberDefault = [
            'view',
            'react',
            'like',
            'share',
            'inbox',
            'number_days',
        ];
        foreach ($arrNumberDefault as $key) {
            $data[$key] = (!empty($data[$key])) ? $data[$key] : 0;
        }
        $data['type_media_post'] = $getMediaPost;

        $mediaPost = Admin\MediaPost::create($data);
        $dataTypeMediaPost = [
            'type_id' => $getMediaPost,
            'type_content_id' => !empty($data['post_place_id']) ? $data['post_place_id'] : null,
            'category' => !empty($data['category']) ? $data['category'] : null,
            'post_date' => !empty($data['post_date']) ? convert_date_to_db($data['post_date']) : null,
            'is_active' => 1,
        ];
        $typeMediaPost = \App\Admin\TypeMediaPost::create($dataTypeMediaPost);
        $mediaPost->typeMediaPosts()->attach($typeMediaPost->id);

        foreach ($getTypeMediaPostList as $idTypeMediaPostList => $typeMediaPostConfig) {
            if ($request->has('post_date' . $typeMediaPostConfig) && !empty($request->input('post_date' . $typeMediaPostConfig))) {
                $dataTypeMediaPost = [
                    'type_id' => $idTypeMediaPostList,
                    'type_content_id' => null,
                    'category' => null,
                    'post_date' => convert_date_to_db($request->get('post_date' . $typeMediaPostConfig)),
                    'is_active' => 1,
                ];
                $typeMediaPost = \App\Admin\TypeMediaPost::create($dataTypeMediaPost);
                $mediaPost->typeMediaPosts()->attach($typeMediaPost->id);
            }
        }
        $mediaPosts = Admin\MediaPost::whereHas('typeMediaPosts', function ($q) use ($getMediaPost) {
            $q->where('type_id', $getMediaPost);
        })->orderBy('id', 'desc')->paginate(20);
        $lastPage = $mediaPosts->lastPage();

        if (!empty($getMediaPost)) {
            if ($getMediaPost == 1) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.web.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'type' => 'create',
                ]);
            } elseif ($getMediaPost == 2) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.fanpage.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'type' => 'create',
                ]);
            } elseif ($getMediaPost == 3) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.group.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'type' => 'create',
                ]);
            } elseif ($getMediaPost == 4) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.email-marketing.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'last_page' => $lastPage,
                    'type' => 'create',
                ]);
            }
        }
    }

    public function editMediaPost(Request $request, $typeMediaPost, $id)
    {
        $mediaPost = Admin\MediaPost::with('typeMediaPosts')->findOrFail($id);
        $mediaPostName = Admin\MediaPost::$TYPE[$typeMediaPost];
        if ($typeMediaPost == 1) {
            if (!$request->user()->can('mediaManagerWebsite.edit')) {
                abort(403);
            }
            return view('CRM.elements.task.media.table.web.form', compact(
                'mediaPost',
                'typeMediaPost',
                'mediaPostName'
            ));
        } elseif ($typeMediaPost == 2) {
            if (!$request->user()->can('mediaManagerFanpage.edit')) {
                abort(403);
            }

            return view('CRM.elements.task.media.table.web.form', compact(
                'mediaPost',
                'typeMediaPost',
                'mediaPostName'
            ));
        } elseif ($typeMediaPost == 3) {
            if (!$request->user()->can('mediaManagerGroup.edit')) {
                abort(403);
            }

            return view('CRM.elements.task.media.table.web.form', compact(
                'mediaPost',
                'typeMediaPost',
                'mediaPostName'
            ));
        } elseif ($typeMediaPost == 4) {
            if (!$request->user()->can('mediaManagerGroup.edit')) {
                abort(403);
            }
            return view('CRM.elements.task.media.table.email-marketing.form', compact(
                'mediaPost',
                'typeMediaPost',
                'mediaPostName'
            ));
        }
    }

    public function updateMediaPost(Request $request, $getMediaPost, $id)
    {
        if ($getMediaPost == 1) {
            if (!$request->user()->can('mediaManagerWebsite.update')) {
                abort(403);
            }
            $data = $request->only([
                'post_place_id',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'service_id',
                'type_source',
                'view',
                'source_pr',
                'rate',
                'seo',
                'created_by',
                'note',
                'post_date_newletter',
                'created_post',
                'schedule_post_date',
                'post_date_fanpage_task',
                'is_hotnew',
                'transfer_staff_date',
                'translated_by',
                'processing_date',
                'promote_date',
                'promotion_for',
                'promotion_for_agent_id',
                'post_date'
            ]);
            $data['post_website'] = 1;
            $data['post_date_fanpage'] = $data['post_date_fanpage_task'];
        } elseif ($getMediaPost == 2) {
            if (!$request->user()->can('mediaManagerFanpage.update')) {
                abort(403);
            }
            $data = $request->only([
                'post_place_id',
                'schedule_post_date_start',
                'schedule_post_date_end',
                'created_post_start',
                'created_post_end',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'post_date',
                'service_id',
                'type_source',
                'source_pr',
                'rate',
                'created_by',
                'note',
                'created_post',
                'schedule_post_date',
                'tag',
                'react',
                'like',
                'share',
                'inbox',
                'budget_qc',
                'start_date_qc',
                'number_days',
                'total_budget',
                'credit_card',
            ]);
            $data['post_fanpage'] = 1;
        } elseif ($getMediaPost == 3) {
            if (!$request->user()->can('mediaManagerGroup.update')) {
                abort(403);
            }
            $data = $request->only([
                'post_place_id',
                'created_post_start',
                'created_post_end',
                'category',
                'source_post',
                'source_detail',
                'post_title',
                'post_link',
                'type_source',
                'rate',
                'created_by',
                'note',
                'created_post',
                'react',
                'like',
                'share',
            ]);
            $data['post_group'] = 1;
        } elseif ($getMediaPost == 4) {
            if (!$request->user()->can('mediaManagerGroup.update')) {
                abort(403);
            }
            $data = $request->only([
                'service_id',
                'category_email_marketing',
                'object_email_marketing',
                'number_of_selected_email_marketing',
                'number_of_clicked_link_email_marketing',
                'type_of_promotion_email_marketing',
                'number_of_agent_onshore_email_marketing',
                'number_of_agent_offshore_email_marketing',
                'number_of_promotion_email_marketing',
                'amount_of_money_aud_email_marketing',
                'amount_of_money_vnd_email_marketing',
                'total_amount_of_money_email_marketing',
                'note_email_marketing',
                'post_date_newletter',
                'post_title',
                'post_date',
                'schedule_post_date'
            ]);
            $data['post_email_marketing'] = 1;
        }


        $mediaPostName = Admin\MediaPost::$TYPE[$getMediaPost];
        $typePromotion = \App\Admin\MediaPost::$TypePromotion;

        if (!empty($data['promotion_for']) && $typePromotion[$data['promotion_for']]['type'] != 'show') {
            $data['promotion_for_agent_id'] = null;
        }

        //$arrDateData = [
        //    'schedule_post_date',
        //    'created_post',
        //    'post_date_fanpage',
        //    'post_date_newletter',
        //    'start_date_qc',
        //];
        //foreach ($arrDateData as $key) {
        //    $data[$key] = (!empty($data[$key])) ? convert_date_to_db($data[$key]) : null;
        //}

        $arrDateData = [
            'schedule_post_date',
            'created_post',
            'post_date_fanpage',
            'post_date_newletter',
            'transfer_staff_date',
            'processing_date',
            'promote_date',
            'post_date'
        ];
        $data['schedule_post_date'] = empty($data['schedule_post_date']) ? '0000-00-00' : $data['schedule_post_date'];
        foreach ($arrDateData as $key) {
            if (!empty($data[$key])) {
                $data[$key] = convert_date_to_db($data[$key]);
            } else {
                unset($data[$key]);
            }
        }
        if ($getMediaPost == 1) {
            $data['post_fanpage'] = !empty($data['post_date_fanpage']) ? 1 : null;
            $data['post_email_marketing'] = !empty($data['post_date_newletter']) ? 1 : null;
        }
        $mediaPost = Admin\MediaPost::findOrFail($id);
        $mediaPost->update($data);
        $dataTypeMediaPost = [
            'type_id' => $getMediaPost,
            'type_content_id' => !empty($data['post_place_id']) ? $data['post_place_id'] : null,
            'category' => !empty($data['category']) ? $data['category'] : null,
            'post_date' => !empty($data['post_date']) ? convert_date_to_db($data['post_date']) : null,
            'is_active' => 1,
        ];
        $mediaPost->typeMediaPosts()->where('type_id', $getMediaPost)->first()->update($dataTypeMediaPost);
        $getTypeMediaPostList = Admin\MediaPost::$TYPE;

        foreach ($getTypeMediaPostList as $idTypeMediaPostList => $typeMediaPostConfig) {
            if ($request->has('post_date_' . $typeMediaPostConfig) && !empty($request->input('post_date_' . $typeMediaPostConfig))) {
                $dataTypeMediaPost = [
                    'post_date' => convert_date_to_db($request->get('post_date_' . $typeMediaPostConfig)),
                ];
                if ($mediaPost->typeMediaPosts()->where('type_id', $idTypeMediaPostList)->count() > 0) {
                    $typeMediaPost = $mediaPost->typeMediaPosts()->where('type_id', $idTypeMediaPostList)->update($dataTypeMediaPost);
                } else {
                    $dataTypeMediaPost = [
                        'type_id' => $idTypeMediaPostList,
                        'type_content_id' => null,
                        'category' => null,
                        'post_date' => convert_date_to_db($request->get('post_date_' . $typeMediaPostConfig)),
                        'is_active' => 1,
                    ];
                    $typeMediaPost = \App\Admin\TypeMediaPost::create($dataTypeMediaPost);
                    $mediaPost->typeMediaPosts()->attach($typeMediaPost->id);
                }
            }
        }
        $mediaPosts = [$mediaPost];

        if (!empty($getMediaPost)) {
            if ($getMediaPost == 1) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.web.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'id' => $mediaPost->id,
                    'type' => 'update',
                ]);
            } elseif ($getMediaPost == 2) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.fanpage.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'id' => $mediaPost->id,
                    'type' => 'update',
                ]);
            } elseif ($getMediaPost == 3) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.group.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'id' => $mediaPost->id,
                    'type' => 'update',
                ]);
            } elseif ($getMediaPost == 4) {
                return response()->json([
                    'view' => view('CRM.elements.task.media.table.email-marketing.data', compact(
                        'mediaPosts',
                        'mediaPostName',
                        'getMediaPost'
                    ))->render(),
                    'id' => $mediaPost->id,
                    'type' => 'update',
                ]);
            }
        }
    }

    public function destroyMediaPost(Request $request, $typeMediaPost, $id)
    {
        $mediaPost = Admin\MediaPost::findOrFail($id);
        $mediaPost->typeMediaPosts()->where('type_id', $typeMediaPost)->delete();
        return response()->json([
            'success' => 1,
            'id' => $id,
        ]);
    }
}
