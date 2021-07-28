<?php

namespace App\Http\Controllers\Admin;

use App\Admin\CustomerDatabaseManager;
use App\Admin\Person;
use App\Http\Requests\CommissionStoreRequest;
use App\Http\Requests\CommissionUpdateRequest;
use App\Imports\CommissionImport;
use App\Imports\CustomerDatabaseManagersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Commission;
use App\Admin\Dichvu;
use App\Admin\Hoahong;
use App\Admin\Service;
use App\User;
use Exception;
use Illuminate\Support\Facades\App;
use Session;

use function foo\func;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('commissionAgent.index')) {
            abort(403);
        }
        $flag = "partner_agent_com";
        return view('CRM.pages.agent-commission.index')->with(compact('flag'));
    }

    public function getData(Request $request)
    {
        if (!$request->user()->can('commissionAgent.index')) {
            abort(403);
        }
        $commDatas = Commission::with([
            'user' => function ($query) {
                $query->select('id', 'country', 'name');
            },
            'service' => function ($query) {
                $query->select('id', 'name', 'currency_id');
            },
            'dichvus' => function ($query) {
                $query->select('id', 'name');
            },
        ])->when($request->get('user_id'), function ($query) use ($request) {
            $query->where('user_id', $request->get('user_id'));
        })->when($request->get('service_id'), function ($query) use ($request) {
            $query->where('service_id', $request->get('service_id'));
        })->when($request->get('provider_id'), function ($query) use ($request) {
            $query->where('provider_id', $request->get('provider_id'));
        })->when($request->get('policy'), function ($query) use ($request) {
            $query->where('policy', $request->get('policy'));
        })->when($request->get('type_payment'), function ($query) use ($request) {
            $query->where('type_payment', $request->get('type_payment'));
        })->when($request->get('gst'), function ($query) use ($request) {
            $query->where('gst', $request->get('gst'));
        })->when($request->get('status'), function ($query) use ($request) {
            $query->where('status', $request->get('status'));
        })
            ->orderby('id', 'desc')
            ->select([
                'id',
                'user_id',
                'service_id',
                'provider_id',
                'comm',
                'unit',
                'donvi',
                'type_payment',
                'validity_start_date',
                'gst',
                'status',
                'policy',
            ])
            ->paginate(30);
        $lastPage = $commDatas->lastPage();
        $totalRow = $commDatas->total();
        return response()->json([
            'view' => view('CRM.pages.agent-commission.data', compact('commDatas'))->render(),
            'last_page' => $lastPage,
            'total_row_data' => $totalRow,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->user()->can('commissionAgent.store')) {
            abort(403);
        }
        return view('CRM.pages.agent-commission.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionStoreRequest $request)
    {
        if (!$request->user()->can('commissionAgent.store')) {
            abort(403);
        }
        //$check = Commission::where('user_id', $request->user_id)
        //    ->where('service_id', $request->service_id)
        //    ->where('policy', $request->policy)->count();
        $check = 0;
        if ($request->type_store == 'ajax') {
            $error = '';
            if ($check > 0) {
                $error = 'Commission is exists!';
                return response()->json([
                    'error' => $error,
                ]);
            } else {
                $data = $request->all();
                $data['validity_start_date'] = !empty($data['validity_start_date']) ? convert_date_to_db($data['validity_start_date']) : null;
                Commission::create($data);
                Session::flash('success-list-com', 'Create service successful!');
                $comms = Commission::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
                return view('CRM.partials.com-agent', compact('comms'));
            }
        } else {
            if ($check > 0) {
                $error = 'Commission is exists!';
                return response()->json([
                    'error' => $error,
                ], 422);
            }
            $data = $request->validated();
            $arrDate = [
                'validity_start_date',
            ];
            foreach ($arrDate as $key) {
                $data[$key] = (!empty($data[$key])) ? convert_date_to_db($data[$key]) : null;
            }
            Commission::create($data);
            $commDatas = Commission::with([
                'user.info',
                'service.dichvu',
            ])->orderby('id', 'desc')->paginate(30);
            $lastPage = $commDatas->lastPage();
            return response()->json([
                'view' => view('CRM.pages.agent-commission.data', compact(
                    'commDatas'
                ))->render(),
                'last_page' => $lastPage,
                'type' => 'create',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        if (!$request->user()->can('commissionAgent.edit')) {
            abort(403);
        }
        $commData = Commission::with(['user'])->findOrFail($id);
        return view('CRM.pages.agent-commission.form', compact(
            'commData'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function editComAgent(Request $request)
    {
        $id_comm = $request->get('id');
        $comm = Commission::findOrFail($id_comm);
        return response()->json([
            'comm' => $comm,
        ]);
    }

    public function updateAll(Request $request)
    {
        if (!$request->user()->can('commissionAgent.update')) {
            abort(403);
        }
        $arr_data = $request->arr_data;
        $arr_data = explode(",", $arr_data);
        $data = $request->all();
        foreach ($arr_data as $key => $value) {
            $comm = Commission::find($value);
            if ($comm != null) {
                $comm->update($data);
            }
        }
        Session::flash('success-list-com', 'Multiple update successful!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if (!$request->user()->can('commissionAgent.delete')) {
            abort(403);
        }
        $arr_data = $request->com_id;
        $arr_data = explode(",", $arr_data);
        if (sizeof($arr_data) > 1) {
            Session::flash('success-list-com', 'Multiple delete successful!');
        } else {
            Session::flash('success-list-com', 'Delete successful!');
        }
        foreach ($arr_data as $key => $value) {
            $comm = Commission::find($value);
            if ($comm != null) {
                $comm->delete();
            }
        }
        return redirect()->back();
    }

    public function editCom(Request $request)
    {
        $id = $request->input('id');
        $users = User::all();
        $obj = Commission::find($id);
        $_dichvu_id = 0;

        if ($obj->service != null && $obj->service->dichvu != null) {
            $_dichvu_id = $obj->service->dichvu->id;
        }
        $providers = Service::where('dichvu_id', $_dichvu_id)->where('status', 1)->get();
        $dichvus = Dichvu::orderby('name')->where('status', 1)->get();
        return view('CRM.elements.com.modal-update', [
            'users' => $users,
            'obj' => $obj,
            'providers' => $providers,
            'dichvus' => $dichvus,
            '_dichvu_id' => $_dichvu_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CommissionUpdateRequest $request, $id)
    {
        if (!$request->user()->can('commissionAgent.update')) {
            abort(403);
        }
        $data = $request->validated();
        $arrDate = [
            'validity_start_date',
        ];
        foreach ($arrDate as $key) {
            $data[$key] = (!empty($data[$key])) ? convert_date_to_db($data[$key]) : null;
        }
        $obj = Commission::find($id);
        if ($request->get('type_store') == 'ajax') {
            if ($obj == null) {
                Session::flash('error-list-com', 'Can not found commission data!');
            } else {
                //$check = Commission::where('id', '<>', $id)
                //    ->where('user_id', $request->user_id)
                //    ->where('service_id', $request->service_id)
                //    ->where('provider_id', $request->provider_id)
                //    ->count();
                $check = 0;
                if ($check > 0) {
                    Session::flash('error-list-com', 'Data is exist!');
                    return redirect()->back();
                }
                $obj->update($data);
                Session::flash('success-list-com', 'Update commission successful!');
            }
            return redirect()->back();
        } else {
            $obj->update($data);
            $commDatas = [$obj];
            return response()->json([
                'view' => view('CRM.pages.agent-commission.data', compact(
                    'commDatas'
                ))->render(),
                'id' => $obj->id,
                'type' => 'update',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commData = Commission::findOrFail($id);
        $commData->delete();
        return response()->json([
            'id' => $id,
        ]);
    }

    //AJAX
    public function getProvider(Request $request)
    {
        $id = $request->input('id');
        $providers = [];
        if ($id != 'all') {
            $providers = Service::orderby('name')->where('status', 1)->where('dichvu_id', $id)->get();
        }
        return view('CRM.elements.com.provider', ['providers' => $providers]);
    }

    public function getCom(Request $request)
    {
        $agent = $request->input('agent');
        $service = $request->input('service');
        $country = $request->input('country');
        $provider = $request->input('provider');
        $time = $request->input('time');
        $status = $request->input('status');
        $comm = $request->input('comm');
        $unit = $request->input('unit');
        $request->session()->put('comm_fillter', [
            'agent' => $agent,
            'service' => $service,
            'country' => $country,
            'provider' => $provider,
            'time' => $time,
            'status' => $status,
            'comm' => $comm,
            'unit' => $unit,
        ]);
        $type_form = 0;
        $query = Commission::join('users', 'users.id', '=', 'commissions.user_id')
            ->join('services', 'services.id', '=', 'commissions.type_service')
            ->join('dichvus', 'dichvus.id', '=', 'services.dichvu_id');
        if ($agent != 'all') {
            $query = $query->where('commissions.user_id', $agent);
        }
        if (isset($provider) && ($provider != null && $provider != 'all')) {
            $query = $query->where('commissions.type_service', $provider);
        }
        if ($country != 'all') {
            $query = $query->where('commissions.country_id', $country);
        }
        if ($status != 'all') {
            $query = $query->where('commissions.status', $status);
        }
        if ($service != 'all') {
            $dichvu = Dichvu::find($service);
            if ($dichvu != null) {
                $type_form = $dichvu->type_form;
            }
            $query = $query->where('dichvus.id', $service);
        }
        if ($unit != 'all') {
            $query = $query->where('commissions.id', $unit);
        }
        if (isset($comm) && $comm != null && $comm != '') {
            $query = $query->where('commissions.comm', $comm);
        }

        if ($time != null && $time != "") {
            $tmp = explode('to', $time);
            if (sizeof($tmp) != 2) {
                $start = trim($tmp[0], ' ');
                $query = $query->whereRaw("STR_TO_DATE(commissions.date,'%Y-%m-%d') >= '".$start."'");
            } else {
                $start = trim($tmp[0], ' ');
                $end = trim($tmp[1], ' ');
                $query = $query->whereRaw("STR_TO_DATE(commissions.date,'%Y-%m-%d') >= '".$start."' AND STR_TO_DATE(commissions.date,'%Y-%m-%d') <= '".$end."'");
            }
        }
        $query = $query->select('commissions.*')->get();

        return view('CRM.elements.com.table', ['objs' => $query, 'type_form' => $type_form]);
    }

    public function ajaxUpdateCommAgent(Request $request)
    {
        $id = $request->get('id');
        $obj = Commission::find($id);

        if ($obj == null) {
            return response()->json([
                'error' => 'Can not found commission data!',
            ]);
        } else {
            //$check = Commission::where('id', '<>', $id)
            //    ->where('user_id', $request->user_id)
            //    ->where('type_service', $request->type_service)
            //    ->where('type', $request->type)
            //    ->count();
            $check = 0;
            if ($check > 0) {
                return response()->json([
                    'error' => 'Data is exist!',
                ]);
            }
            $obj->update($request->all());
            $comms = Commission::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
            return view('CRM.partials.com-agent', compact('comms'));
        }
    }

    public function ajaxDeleteCommAgent(Request $request)
    {
        $id = $request->get('id');
        $comm = Commission::findOrFail($id);
        $user_id = $comm->user_id;
        $comm->delete();
        $comms = Commission::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('CRM.partials.com-agent', compact('comms'));
    }

    public function importExcel(Request $request)
    {
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '2048M');
        $excel = App::make('excel');
        if ($request->hasFile('file')) {
            $import = new CommissionImport;
            $excel->import($import, $request->file('file'));
            $validation = [];
        } else {
            $validation = [];
        }
        ini_set('memory_limit', '-1');
        return back()->with('validation_errors', $validation);
    }
}
