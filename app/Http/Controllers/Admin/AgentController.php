<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin\Commission;
use App\Admin\Person;
use App\Admin\Service;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\AgentImport;
use App\Imports\AgentImportAgentCode;
use App\Imports\UsersImportTypeOfAgent;
use App\Info;
use App\Jobs\NotifyUserOfCompleteFileExport;
use App\Mail\InvoiceMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use League\Flysystem\Config;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Facades\Excel;
use phpseclib3\Crypt\EC\BaseCurves\Base;
use Rap2hpoutre\FastExcel\FastExcel;
use Session;

use function foo\func;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->can('agent.index')) {
            abort(403);
        }
        session()->forget('new_contact');
        $flag = 'agent.index';
        $fields = \Config::get('myconfig.fields_table_agent');
        $fl_up_status = \Config::get('myconfig.task_follow_up_status');

        return view('CRM.pages.agent')->with(compact(
                'flag',
                'fl_up_status',
                'fields'
            )
        );
    }

    public function getData(Request $request)
    {
        if (!$request->user()->can('agent.index')) {
            abort(403);
        }
        $roleCountriesUser = Auth::user()->role_countries;
        $roleDepartment = Auth::user()->role_department;
        if (!empty($roleCountriesUser)) {
            $roleCountriesUser = \GuzzleHttp\json_decode($roleCountriesUser);
        }

        if (!empty($roleDepartment)) {
            $roleDepartment = \GuzzleHttp\json_decode($roleDepartment);
        }

        session()->forget('new_contact');
        $getChildUser = getChildUser('agent');
        $potential_service_filter = (!empty($request->get('potential_service'))) ? $request->get('potential_service') : [];
        $roleCountriesUser = !empty($request->get('country')) ? $request->get('country') : $roleCountriesUser;
        $roleDepartment = !empty($request->get('department')) ? $request->get('department') : $roleDepartment;

        $users = User::when($request->get('name'), function ($query) use ($request) {

            if (strlen($request->get('name')) > 5) {
                $query->where('name', 'LIKE', '%' . $request->get('name') . '%');
            } else if (strlen($request->get('name')) == 4) {
                $query->where('name', 'LIKE', $request->get('name') . '__%');
            } else {
                $query->where('name', 'LIKE', '%' . $request->get('name') . '%');
            }

        })
            ->when($request->get('agent_code'), function ($query) use ($request) {
                $query->where('agent_code', 'LIKE', '%' . $request->get('agent_code') . '%');
            })
            ->when($request->get('market_id'), function ($query) use ($request) {
                if ($request->get('market_id')[0] == 'null') {
                    $query->whereNull('market_id');
                } else {
                    $query->whereJsonContains('market_id', $request->get('market_id'));
                }
            })->when($request->get('tel_1'), function ($query) use ($request) {
                $query->where('tel_1', 'LIKE', '%' . $request->get('tel_1') . '%');
            })->when($request->get('tel_2'), function ($query) use ($request) {
                $query->where('tel_2', 'LIKE', '%' . $request->get('tel_2') . '%');
            })->when($request->get('website'), function ($query) use ($request) {
                $query->where('website', 'LIKE', '%' . $request->get('website') . '%');
            })->when($roleCountriesUser, function ($query) use ($request, $roleCountriesUser) {
                if (empty($roleCountriesUser)) {
                    $query->whereNull('country');
                } else if (is_array($roleCountriesUser)) {
                    $query->whereIn('country', $roleCountriesUser);
                } else {
                    $query->where('country', $roleCountriesUser);
                }
            })->when($request->get('rating'), function ($query) use ($request) {
                if ($request->get('rating') == 'null') {
                    $query->whereNull('rating');
                } else {
                    $query->where('rating', $request->get('rating'));
                }
            })->when($request->get('city'), function ($query) use ($request) {
                $query->where('city', 'LIKE', '%' . $request->get('city') . '%');
            })->when($request->get('office'), function ($query) use ($request) {
                $query->where('office', 'LIKE', '%' . $request->get('office') . '%');
            })->when($roleDepartment, function ($query) use ($request, $roleDepartment) {
                if (empty($roleDepartment)) {
                    $query->whereNull('department');
                } else if (is_array($roleDepartment)) {
                    $query->whereIn('department', $roleDepartment);
                } else {
                    $query->where('department', $roleDepartment);
                }
            })->when($request->get('registered_date'), function ($query) use ($request) {
                $query->where('registered_date', $request->get('registered_date'));
            })->when($request->get('info_type_id'), function ($query) use ($request) {
                if ($request->get('info_type_id') == 'null') {
                    $query->whereNull('type_id');
                } else {
                    $query->where('type_id', $request->get('info_type_id'));
                }
            })
            ->when($request->get('user_status') || $request->get('f_status'), function ($query) use ($request) {
                if (!empty($request->get('f_status'))) {
                    if ($request->get('f_status') != 'all') {
                        $query->where('status', $request->get('f_status'));
                    }
                } elseif (!empty($request->get('user_status'))) {
                    if ($request->get('user_status') == 'null') {
                        $query->whereNull('status');
                    } else {
                        $query->where('status', $request->get('user_status'));
                    }
                }
            })->when($request->get('email'), function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->get('email') . '%');
            })
            ->when($request->get('staff_id'), function ($query) use ($request) {
                if ($request->get('staff_id') == 'null') {
                    $query->whereNull('staff_id');
                } else {
                    $query->where('staff_id', $request->get('staff_id'));
                }
            })
            ->when($request->get('created_at'), function ($query) use ($request) {
                $query->whereDate('created_at', convert_date_to_db($request->get('created_at')));
            })
            ->when($request->get('note1'), function ($query) use ($request) {
                $query->where('note1', 'LIKE', '%' . $request->get('note1') . '%');
            })
            ->when($request->get('note2'), function ($query) use ($request) {
                $query->where('note2', 'LIKE', '%' . $request->get('note2') . '%');
            })
            ->when($request->get('potential_service') && $request->get('potential_service') != [], function ($query) use ($request, $potential_service_filter) {
                $query->whereJsonContains('potential_service', $potential_service_filter);
            })
            ->when($request->get('f_period') || ($request->get('f_time_start') && $request->get('f_time_end')), function ($query) use ($request) {
                if ($request->get('f_time_start') && $request->get('f_time_end')) {
                    $query->whereBetween('created_at', [
                        convert_date_to_db($request->get('f_time_start') . ' 00:00:00'),
                        convert_date_to_db($request->get('f_time_end') . ' 23:59:59'),
                    ]);
                } elseif ($request->get('f_period')) {
                    if ($request->get('f_period') == 1) {
                        $query->where('created_at', Carbon::now()->format('Y-m-d'));
                    } else {
                        if ($request->get('f_period') == 2) {
                            $query->whereBetween('created_at', [
                                Carbon::now()->subWeek(1)->format('Y-m-d h:i:s'),
                                Carbon::now()->format('Y-m-d h:i:s'),
                            ]);
                        } else {
                            if ($request->get('f_period') == 3) {
                                $query->whereBetween('created_at', [
                                    Carbon::now()
                                        ->subMonth(1)
                                        ->format('Y-m-d h:i:s'),
                                    Carbon::now()->format('Y-m-d h:i:s'),
                                ]);
                            } else {
                                if ($request->get('f_period') == 4) {
                                    $query->whereBetween('created_at', [
                                        Carbon::now()
                                            ->subYear(1)
                                            ->format('Y-m-d h:i:s'),
                                        Carbon::now()->format('Y-m-d h:i:s'),
                                    ]);
                                } else {
                                    if ($request->get('f_period') == 't01') {
                                        $query->whereBetween('created_at', [
                                            date('Y-01-01 h:i:s'),
                                            Carbon::parse(date('Y-01-01 h:i:s'))->endOfMonth(),
                                        ]);
                                    } else {
                                        if ($request->get('f_period') == 't02') {
                                            $query->whereBetween('created_at', [
                                                date('Y-02-01 h:i:s'),
                                                Carbon::parse(date('Y-02-01 h:i:s'))->endOfMonth(),
                                            ]);
                                        } else {
                                            if ($request->get('f_period') == 't03') {
                                                $query->whereBetween('created_at', [
                                                    date('Y-03-01 h:i:s'),
                                                    Carbon::parse(date('Y-03-01 h:i:s'))->endOfMonth(),
                                                ]);
                                            } else {
                                                if ($request->get('f_period') == 't04') {
                                                    $query->whereBetween('created_at', [
                                                        date('Y-04-01 h:i:s'),
                                                        Carbon::parse(date('Y-04-01 h:i:s'))->endOfMonth(),
                                                    ]);
                                                } else {
                                                    if ($request->get('f_period') == 't05') {
                                                        $query->whereBetween('created_at', [
                                                            date('Y-05-01 h:i:s'),
                                                            Carbon::parse(date('Y-05-01 h:i:s'))->endOfMonth(),
                                                        ]);
                                                    } else {
                                                        if ($request->get('f_period') == 't06') {
                                                            $query->whereBetween('created_at', [
                                                                date('Y-06-01 h:i:s'),
                                                                Carbon::parse(date('Y-06-01 h:i:s'))->endOfMonth(),
                                                            ]);
                                                        } else {
                                                            if ($request->get('f_period') == 't07') {
                                                                $query->whereBetween('created_at', [
                                                                    date('Y-07-01 h:i:s'),
                                                                    Carbon::parse(date('Y-07-01 h:i:s'))
                                                                        ->endOfMonth(),
                                                                ]);
                                                            } else {
                                                                if ($request->get('f_period') == 't08') {
                                                                    $query->whereBetween('created_at', [
                                                                        date('Y-08-01 h:i:s'),
                                                                        Carbon::parse(date('Y-08-01 h:i:s'))
                                                                            ->endOfMonth(),
                                                                    ]);
                                                                } else {
                                                                    if ($request->get('f_period') == 't09') {
                                                                        $query->whereBetween('created_at', [
                                                                            date('Y-09-01 h:i:s'),
                                                                            Carbon::parse(date('Y-09-01 h:i:s'))
                                                                                ->endOfMonth(),
                                                                        ]);
                                                                    } else {
                                                                        if ($request->get('f_period') == 't10') {
                                                                            $query->whereBetween('created_at', [
                                                                                date('Y-10-01 h:i:s'),
                                                                                Carbon::parse(date('Y-10-01 h:i:s'))
                                                                                    ->endOfMonth(),
                                                                            ]);
                                                                        } else {
                                                                            if ($request->get('f_period') == 't11') {
                                                                                $query->whereBetween('created_at', [
                                                                                    date('Y-11-01 h:i:s'),
                                                                                    Carbon::parse(date('Y-11-01 h:i:s'))
                                                                                        ->endOfMonth(),
                                                                                ]);
                                                                            } else {
                                                                                if ($request->get('f_period') == 't12') {
                                                                                    $query->whereBetween('created_at', [
                                                                                        date('Y-12-01 h:i:s'),
                                                                                        Carbon::parse(date('Y-12-01 h:i:s'))
                                                                                            ->endOfMonth(),
                                                                                    ]);
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            })
            ->when(
                $request->get('user_status') ||
                $request->get('agent_code') ||
                $request->get('market_id') ||
                $request->get('tel_1') ||
                $request->get('tel_2') ||
                $request->get('website') ||
                $request->get('city') ||
                $request->get('office') ||
                $request->get('registered_date') ||
                $request->get('staff_id') ||
                $request->get('department') ||
                $request->get('potential_service')
                , function ($query) {
                $query->orderBy('name');
            })
            ->orderBy('id', 'desc');

        if ($getChildUser['permissionSee']->contains(3)) {
            $users->where('staff_id', $getChildUser['admin']->id);
        } elseif ($getChildUser['permissionSee']->contains(2)) {
            $users->whereIn('staff_id', $getChildUser['getAllAdminDepartment']);
        }
        $users = $users->paginate(20);
        $lastPage = $users->lastPage();
        $totalRow = $users->total();
        return response()->json([
            'view' => view('CRM.elements.agents.data', compact('users'))->render(),
            'last_page' => $lastPage,
            'total_row_data' => $totalRow
        ]);
    }

    public function getAgentSelect(Request $request)
    {
        $agents = User::when($request->get('name'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->get('name') . '%');
        })->get(['id', 'name', 'country'])->take(5)->map(function ($agent) {
            $agent['country'] = $agent->country();
            return $agent;
        });
        if (!$request->get('name')) {
            $blankObj = new User();
            $blankObj->id = 0;
            $blankObj->name = 'Blank';
            $blankObj->country = '';
            $agents->push($blankObj);
        }
        return $agents;
    }

    public function getAgentFilterAndAgentDefault(Request $request)
    {
        $totalStatus = [];
        $agentDefault = '';
        $getCountUser = User::get(['id', 'is_default', 'status', 'name']);
        foreach (config('admin.status') as $keyStatus => $valueStatus) {
            $totalStatus[$valueStatus] = [
                'count' => $getCountUser->where('status', $keyStatus)->count(),
                'id' => $keyStatus
            ];
        }
        $agentDefault = $getCountUser->where('is_default', 1)->first();
        return response()->json([
            'total_row_data_status' => $totalStatus,
            'agent_default' => $agentDefault
        ]);
    }

    public function showData(Request $request, $id)
    {
        $user = User::with(['info'])->findOrFail($id);
        $users = $user;
        return response()->json([
            'view' => view('CRM.elements.agents.data', compact(
                'users'
            ))->render(),
            'id' => $user->id,
            'type' => 'update',
        ]);
    }

    public function create(Request $request)
    {
        $request->session()->forget('new_contact');
        $flag = 'agent.index';
        return view('CRM.pages.create-agent')->with(compact(
            'flag'
        ));
    }

    public function store(Request $request)
    {
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }
        $flag = 'agent.index';
        $data = $request->all();
        $data = $request->except(
            'contact_name',
            'contact_position',
            'contact_phone',
            'contact_birthday',
            'contact_email',
            'contact_skype',
            'contact_facebook',
            'contact_note',
            'contact_is_receive_comm',
            'contact_acc_name',
            'contact_bank',
            'contact_currency',
            'contact_bank_address',
            'contact_receiver_address',
            'contact_swift_code',
            'contact_is_counsellor',
            'contact_com_counsellor',
            'type_service',
            'type',
            'comm',
            'date',
            'donvi',
            'gst',
            'type_payment'
        );
        $validator = Validator::make($data, [
            "email" => 'sometimes|required|email|unique:users,email'
        ]);
        if ($validator->fails()) {
            Session::flash('error-create-agent', $validator->errors());
            return redirect()->back();
        }
        $data['created_by'] = auth()->guard('admin')->user()->id;
        $count = User::orWhere('name', $data['name'])->orWhere('email', $data['email'])->count();
        $exist = $count > 0 ? true : false;
        if ($exist) {
            Session::flash('error-create-agent', 'Username or Email is exist. Please check again. Thanks you!');
            return redirect()->back();
        }
        $data['password'] = bcrypt($data['password']);
        $data['country'] = $data['country_id'];
        $data['registered_date'] = date('Y-m-d');
        $data['date_of_contract'] = convert_date_to_db($data['date_of_contract']);
        if (!empty($data['gst1'])) {
            $data['gst'] = 1;
        } elseif (!empty($data['gst2'])) {
            $data['gst'] = 2;
        }
        try {
            $new_account = User::create($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo $e->getLine();
            die();
        }

        //Create contact person
        $data_contact = $request->only(
            'contact_name',
            'contact_position',
            'contact_phone',
            'contact_birthday',
            'contact_email',
            'contact_skype',
            'contact_facebook',
            'contact_note',
            'contact_is_receive_comm',
            'contact_acc_name',
            'contact_bank',
            'contact_currency',
            'contact_bank_address',
            'contact_receiver_address',
            'contact_swift_code',
            'contact_is_counsellor',
            'contact_com_counsellor'
        );
        if (!empty($data_contact['contact_name'])) {
            try {
                foreach ($data_contact['contact_name'] as $keyContact => $value) {
                    $_arr_contact = [];
                    $_arr_contact['user_id'] = $new_account->id;
                    $_arr_contact['name'] = $data_contact['contact_name'][$keyContact];
                    $_arr_contact['position'] = $data_contact['contact_position'][$keyContact];
                    $_arr_contact['phone'] = $data_contact['contact_phone'][$keyContact];
                    $_arr_contact['birthday'] = $data_contact['contact_birthday'][$keyContact];
                    $_arr_contact['email'] = $data_contact['contact_email'][$keyContact];
                    $_arr_contact['skype'] = $data_contact['contact_skype'][$keyContact];
                    $_arr_contact['facebook'] = $data_contact['contact_facebook'][$keyContact];
                    $_arr_contact['note'] = $data_contact['contact_note'][$keyContact];
                    $_arr_contact['is_receive_comm'] = $data_contact['contact_is_receive_comm'][$keyContact];
                    $_arr_contact['acc_name'] = $data_contact['contact_acc_name'][$keyContact];
                    $_arr_contact['bank'] = $data_contact['contact_bank'][$keyContact];
                    $_arr_contact['currency'] = $data_contact['contact_currency'][$keyContact];
                    $_arr_contact['bank_address'] = $data_contact['contact_bank_address'][$keyContact];
                    $_arr_contact['receiver_address'] = $data_contact['contact_receiver_address'][$keyContact];
                    $_arr_contact['swift_code'] = $data_contact['contact_swift_code'][$keyContact];
                    $_arr_contact['is_counsellor'] = $data_contact['contact_is_counsellor'][$keyContact];
                    $_arr_contact['com_counsellor'] = $data_contact['contact_com_counsellor'][$keyContact];
                    Person::create($_arr_contact);
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo $e->getLine();
                die();
            }
        }

        //Create agent commission
        $data_comm = $request->only('type_service', 'type', 'comm', 'date', 'donvi', 'gst', 'type_payment');
        if (isset($data_comm['type_service'])) {
            try {
                foreach ($data_comm['type_service'] as $key => $value) {
                    $_data = [];
//                    $_data['service_id'] = $value;
                    $_data['provider_id'] = $data_comm['type_service'][$key];
                    $_data['policy'] = $data_comm['type'][$key];
                    $_data['comm'] = $data_comm['comm'][$key];
                    $_data['validity_start_date'] = convert_date_to_db($data_comm['date'][$key]);
                    $_data['donvi'] = $data_comm['donvi'][$key];
                    $_data['gst'] = $data_comm['gst'][$key];
                    $_data['type_payment'] = $data_comm['type_payment'][$key];
                    $_data['user_id'] = $new_account->id;
                    $_data['status'] = 1;
                    $data = Commission::create($_data)->id;
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
                echo $e->getLine();
                die();
            }
        }
        cache()->forget('getAllAgentComm');
        Session::flash('success-create-agent', 'Create new agent successful!');
        return redirect()->back();
    }

    public function show($id)
    {
        $obj = User::with([
            'commission' => function ($query) {
                $query->orderBy('id', 'desc')
                    ->with('service');
            },
        ])->findOrFail($id);
        $comms = $obj->commission;
        $staffs = Admin::where('status', 1)->get();
        $status = config('admin.status');
        $services = Service::where('status', 1)->get();
        $flag = 'agent.index';
        $is_show = true;
        $action = 'show';
        return view('CRM.pages.edit-agent')->with(compact(
            'flag',
            'staffs',
            'status',
            'services',
            'obj',
            'comms',
            'is_show',
            'action'
        ));
    }

    public function edit(Request $request, $id)
    {
        if (!$request->user()->can('agent.edit')) {
            abort(403);
        }
        $obj = User::with([
            'commission' => function ($query) {
                $query->orderBy('id', 'desc')
                    ->with('service');
            },
        ])->findOrFail($id);

        $comms = $obj->commission;
        $staffs = Admin::where('status', 1)->get();
        $status = config('admin.status');
        $services = Service::where('status', 1)->get();
        $flag = 'agent.index';
        $action = 'edit';
        return view('CRM.pages.edit-agent')->with(compact(
            'flag',
            'staffs',
            'status',
            'services',
            'obj',
            'comms',
            'action'
        ));
    }

    public function update(Request $request, $id)
    {
        if (!$request->user()->can('agent.update')) {
            abort(403);
        }
        $obj = User::findOrFail($id);
        $flag = 'agent';

        $data_login = $request->only([
            "name",
            "email",
            "password",
            "status",
            "market_id",
            "department",
            "commission_offer",
            "note1",
            "note2",
            "end_date",
            "agent_code",
            "country",
            "city",
            "office",
            "tel_1",
            "tel_2",
            "fb",
            "website",
            "rating",
            "potential_service",
            "type_id",
            "staff_id",
            "gst1",
            "gst2"
        ]);
        if (!empty($data_login['gst1'])) {
            $data_login['gst'] = 1;
        } elseif (!empty($data_login['gst2'])) {
            $data_login['gst'] = 2;
        }
        $validator = Validator::make($data_login, [
            "email" => 'sometimes|required|email|unique:users,email,' . $id
        ]);
        if ($validator->fails()) {
            Session::flash('error-edit-agent', $validator->errors());
            return redirect()->back();
        }
        $data_login['created_by'] = auth()->guard('admin')->user()->id;
        if ($data_login['password'] != null && $data_login['password'] != '') {
            $data_login['password'] = bcrypt($data_login['password']);
        } else {
            unset($data_login['password']);
        }
        $obj->update($data_login);

        //Create contact person

        $data_contact = $request->only(
            'contact_name',
            'contact_position',
            'contact_phone',
            'contact_birthday',
            'contact_email',
            'contact_skype',
            'contact_facebook',
            'contact_note',
            'contact_is_receive_comm',
            'contact_acc_name',
            'contact_bank',
            'contact_currency',
            'contact_bank_address',
            'contact_receiver_address',
            'contact_swift_code',
            'contact_is_counsellor',
            'contact_com_counsellor'
        );
        DB::beginTransaction();
        try {
            if (!empty($data_contact['contact_name'])) {
                $obj->contacts()->delete();
                foreach ($data_contact['contact_name'] as $keyContact => $value) {
                    $_arr_contact = [];
                    $_arr_contact['user_id'] = $obj->id;
                    $_arr_contact['name'] = $data_contact['contact_name'][$keyContact];
                    $_arr_contact['position'] = $data_contact['contact_position'][$keyContact];
                    $_arr_contact['phone'] = $data_contact['contact_phone'][$keyContact];
                    $_arr_contact['birthday'] = $data_contact['contact_birthday'][$keyContact];
                    $_arr_contact['email'] = $data_contact['contact_email'][$keyContact];
                    $_arr_contact['skype'] = $data_contact['contact_skype'][$keyContact];
                    $_arr_contact['facebook'] = $data_contact['contact_facebook'][$keyContact];
                    $_arr_contact['note'] = $data_contact['contact_note'][$keyContact];
                    $_arr_contact['is_receive_comm'] = $data_contact['contact_is_receive_comm'][$keyContact];
                    $_arr_contact['acc_name'] = $data_contact['contact_acc_name'][$keyContact];
                    $_arr_contact['bank'] = $data_contact['contact_bank'][$keyContact];
                    $_arr_contact['currency'] = $data_contact['contact_currency'][$keyContact];
                    $_arr_contact['bank_address'] = $data_contact['contact_bank_address'][$keyContact];
                    $_arr_contact['receiver_address'] = $data_contact['contact_receiver_address'][$keyContact];
                    $_arr_contact['swift_code'] = $data_contact['contact_swift_code'][$keyContact];
                    $_arr_contact['is_counsellor'] = $data_contact['contact_is_counsellor'][$keyContact];
                    $_arr_contact['com_counsellor'] = $data_contact['contact_com_counsellor'][$keyContact];
                    Person::create($_arr_contact);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        //        $data_contact = $request->only('c_name', 'c_email', 'c_position', 'c_phone', 'c_birthday', 'c_skype', 'c_status');
        //        if (!empty($data_contact) && $data_contact['c_name'] != null  && $data_contact['c_email'] != null && $data_contact['c_name'] != ''  && $data_contact['c_email'] != '') {
        //            foreach ($data_contact as $key => $value) {
        //                $new_key = str_replace("c_", "", $key);
        //                $data_contact[$new_key] = $value;
        //            }
        //            if ($obj->info != null) {
        //                $person = $obj->info->person;
        //                if ($person != null) {
        //                    $person->update($data_contact);
        //                } else $person = Person::create($data_contact);
        //            }
        //        }

        //Create agent info


        //Create agent commission
        // $data_comm = $request->only('service_id', 'type', 'comm', 'date');
        // if (isset($data_comm['service_id'])) {
        //     foreach ($data_comm['service_id'] as $key => $value) {
        //         $data['service_id'] = $value;
        //         $data['type'] = $data_comm['type'][$key];
        //         $data['comm'] = $data_comm['comm'][$key];
        //         $data['date'] = $data_comm['date'][$key];
        //         $data['user_id'] = $id;
        //         $data['status'] = 1;
        //         $tmp = Commission::where('user_id', $data['user_id'])->where('service_id', $data['service_id'])->where('type', $data['type'])->first();
        //         if ($tmp != null) $tmp->update($data);
        //         else Commission::create($data);
        //     }
        // }
        cache()->forget('getAllAgentComm');
        Session::flash('success-edit-agent', 'Update agent successful!');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->user()->can('agent.delete')) {
            abort(403);
        }
        $obj = User::findOrFail($id);
        $obj->info()->delete();
        $obj->delete();
        cache()->forget('getAllAgentComm');
        return response()->json([
            'id' => $id,
        ]);
    }

    public function getProfile()
    {
        $obj = Info::where('user_id', \Auth::user()->id)->first();
        return view('back-end.agent.profile', ['obj' => $obj]);
    }

    public function postProfile(Request $request, $id)
    {
        $info = Info::find($id);
        $user = \Auth::user();
        if (!isset($info) || !isset($user)) {
            Session::flash('error-info', 'Không tìm thấy agent cần sửa.');
            return redirect(route('info.index'));
        }
        $tmp_u = $request->all();
        if (isset($tmp_u['password_new']) && $tmp_u['password_new'] != "") {
            $tmp_u['password'] = bcrypt($tmp_u['password_new']);
        }
        $tmp_u['status'] = $user->status;
        $tmp_i = $request->all();
        $user->update($tmp_u);
        $info->update($tmp_i);
        cache()->forget('getAllAgentComm');
        Session::flash('success-profile', 'Thay đổi thông tin thành công.');
        return redirect()->route('agent-profile.get');
    }

    public function getCommission()
    {
        $user = \Auth::user();
        $comms = Commission::where('user_id', $user->id)->get();
        return view('back-end.agent.commission', ['data' => $comms]);
    }

    public function getReg()
    {
        $user = \Auth::user();
        $regs = $user->applies()->get();
        return view('back-end.agent.reg', ['data' => $regs]);
    }

    public function sendEmailAgent(Request $request)
    {
        if (!$request->user()->can('agent.sendEmail')) {
            abort(403);
        }
        $content = $request->get('content_mail');
        $mails = (!empty($request->get('send_email_invoice'))) ? $request->get('send_email_invoice') : [];
        $names = (!empty($request->get('send_name_invoice'))) ? $request->get('send_name_invoice') : [];
        $filesSendMail = (!empty($request->files_send_mail)) ? $request->files_send_mail : [];
        $fileLists = [];

        foreach ($filesSendMail as $one) {
            $newNameAttr = rand() . '.' . $one->getClientOriginalExtension();
            $one->move(public_path('/storage/attr'), $newNameAttr);
            array_push($fileLists, $newNameAttr);
        }
        foreach ($mails as $key => $mail) {
            $customerName = $names[$key];
            try {
                Mail::to($mail)->later(20, new InvoiceMail($content, $customerName, $fileLists));
            } catch (\Exception $e) {
                report($e);
            }
        }
        return response()->json(['success' => 1]);
    }

    public function multiDelete(Request $request)
    {
        if (!$request->user()->can('agent.delete')) {
            abort(403);
        }
        $ids = $request->get('ids');
        //        $dataType = $request->get('type');
        //        if ($dataType == 'cus' || $dataType == 'extend') {
        try {
            $agents = User::with(['info'])->whereIn('id', $ids)->get()->each(function ($agent, $key) {
                $agent->delete();
                $agent->info()->delete();
            });
            return response()->json(['success' => 1, 'ids' => $ids]);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
        //        }
    }

    public function updatePersonInCharge(Request $request)
    {
        if (!$request->user()->can('agent.update')) {
            abort(403);
        }
        $data = $request->only(['staff_id', 'agent_ids']);
        $agent_ids = $request->get('agent_ids');
        $staff_id = $request->get('staff_id');
        $users = User::whereIn('id', $agent_ids)->update([
            'staff_id' => $staff_id,
        ]);
        cache()->forget('getAllAgentComm');
        return response()->json([
            'agent_ids' => $agent_ids,
        ]);
    }

    public function importExcel(Request $request)
    {
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $excel = App::make('excel');
            $import = new AgentImport;
            $excel->import($import, $file);
            $validation = [];
        } else {
            $validation = [];
        }
        ini_set('memory_limit', '-1');
        return back()->with('validation_errors', $validation);
    }

    public function getDataContactList(Request $request, $id)
    {
        $personContact = Person::where('user_id', $id)->orderByRaw("FIELD(is_receive_comm , 'on') DESC")->get();
        return view('CRM.elements.agents.table-contact', ['data' => $personContact]);
    }

    public function storeContactAgent(Request $request, $id)
    {
        $data = $request->only([
            'user_id',
            'name',
            'position',
            'phone',
            'birthday',
            'email',
            'skype',
            'status',
            'facebook',
            'note',
            'is_receive_comm',
            'acc_name',
            'bank',
            'currency',
            'bank_address',
            'receiver_address',
            'swift_code',
            'is_counsellor',
            'com_counsellor'
        ]);
        $data['user_id'] = $id;
        $personContactAgent = Person::where('user_id', $id)->whereNotNull('is_receive_comm')->get();
        if ($personContactAgent->count() > 0 && $data['is_receive_comm'] == 'on') {
            Person::where('user_id', $id)->whereNotNull('is_receive_comm')->update(['is_receive_comm' => null]);
        }
        Person::create($data);
        $personContact = Person::where('user_id', $id)->orderByRaw("FIELD(is_receive_comm , 'on') DESC")->get();
        return response()->json([
            'view' => view('CRM.elements.agents.table-contact', ['data' => $personContact])->render(),
            'type' => 'create',
        ]);
    }

    public function editContactAgent(Request $request, $id)
    {
        $person = Person::find($id);
        return view('CRM.elements.agents.modal-create-contact', ['data' => $person]);
    }

    public function updateContactAgent(Request $request, $id)
    {
        $person = Person::find($id);
        $data = $request->only([
            'user_id',
            'name',
            'position',
            'phone',
            'birthday',
            'email',
            'skype',
            'status',
            'facebook',
            'note',
            'is_receive_comm',
            'acc_name',
            'bank',
            'currency',
            'bank_address',
            'receiver_address',
            'swift_code',
            'is_counsellor',
            'com_counsellor'
        ]);
        $personContactAgent = Person::where('user_id', $person->user_id)->whereNotNull('is_receive_comm')->get();
        if ($personContactAgent->count() > 0 && $data['is_receive_comm'] == 'on') {
            Person::where('user_id', $person->user_id)
                ->whereNotNull('is_receive_comm')
                ->update(['is_receive_comm' => null]);
        }
        $person->update($data);
        $persons = [$person];
        return response()->json([
            'view' => view('CRM.elements.agents.table-contact', ['data' => $persons])->render(),
            'id' => $person->id,
            'type' => 'update',
        ]);
    }

    public function destroyContactAgent($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        return response()->json([
            'success' => 1,
            'id' => $id,
        ]);
    }

    public function getModalFormContact(Request $request)
    {
        $tmp = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'email' => $request->input('email'),
            'skype' => $request->input('skype'),
            'facebook' => $request->input('facebook'),
            'note' => $request->input('note'),
            'is_receive_comm' => $request->input('is_receive_comm'),
            'acc_name' => $request->input('acc_name'),
            'bank' => $request->input('bank'),
            'currency' => $request->input('currency'),
            'bank_address' => $request->input('bank_address'),
            'receiver_address' => $request->input('receiver_address'),
            'swift_code' => $request->input('swift_code'),
            'is_counsellor' => $request->input('is_counsellor'),
            'com_counsellor' => $request->input('com_counsellor'),
        ];
        return view('CRM.elements.agents.modal-create-contact', ['data' => $tmp]);
    }

    public function getContactAgent($id)
    {
        $datas = Person::where('user_id', $id)->orderByRaw("FIELD(is_receive_comm , 'on') DESC")->get();
        return view('CRM.elements.agents.elements.agent_contact.modal_agent_contact', compact('datas'));
    }

    public function exportExcel(Request $request)
    {
        try {
            return (new UsersExport())->request($request)->download('Agent.xlsx');

            $var_msg = "This is an exception example";
            throw new Exception($var_msg);

        } catch (\Exception $e) {
            echo "Message: " . $e->getMessage();
            echo "";
            echo "getCode(): " . $e->getCode();
            echo "";
            echo "__toString(): " . $e->__toString();
        }

    }

    public function importAgentCode(Request $request)
    {
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new AgentImportAgentCode(), $file);

        }
        ini_set('memory_limit', '-1');
        return back()->with(['msg', 'The Message Error']);

    }

    public function importTypeOfAgent(Request $request)
    {
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new UsersImportTypeOfAgent(), $file);
        }
        ini_set('memory_limit', '-1');
        return back()->with(['msg', 'The Message Error']);
    }

    public function getAgentById(Request $request)
    {
        $agentName = User::where('id', $request->get('agent_id'))->select('name', 'staff_id')->get();


        if ($request->get('staff')) {
            return response()->json(['staff_id' => $agentName[0]->staff_id, 'staff_name' => getStaffNameById($agentName[0]->staff_id)]);
        }

        if (!empty($agentName)) {
            return response()->json(['agent' => $agentName[0]->name]);
        }

        return response()->json(['agent' => ""]);

    }

//    public function UpdateAgent(Request $request)
//    {
//        if (!$request->user()->can('agent.store')) {
//            abort(403);
//        }
//        ini_set('max_execution_time', 3600);
//        ini_set('memory_limit', '2048M');
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//            Excel::import(new UsersImportTypeOfAgent(), $file);
//
//        }
//        ini_set('memory_limit', '-1');
//        return back()->with(['msg', 'The Message Error']);
//    }

}
