<?php

namespace App\Http\Controllers\Admin;

use App\Imports\AgentImportAgentCode;
use App\Imports\ImportInvoice;
use App\Imports\ImportReceipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Apply;
use App\User;
use App\Admin;
use App\Admin\Service;
use App\Admin\Customer;
use App\Admin\Dichvu;
use App\Admin\Phieuthu;
use App\Admin\Hoahong;
use App\Admin\Promotion;
use App\Admin\Commission;
use App\Admin\ExchangRate;
use App\Admin\ProviderCom;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class CustomerProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $tab)
    {
        $obj = Apply::with([
            'agent',
            'customers',
            'hoahong',
            'provider_com',
            'task',
            'provider',
            'service',
            'phieuthus'=>function($phieuthu){
                $phieuthu->with([
                    'updater',
                    'creater'
                ]);
            },
            'comms',
            'tailieus',
            'staff',
            'profit',
            'refund'
        ])->find($id);
        $agent = $obj->agent;
        $resCus = $obj->registerCus();
        $providerCom = $obj->getProviderCom();
        $tasks = $obj->task;
        $admins = Admin::orderby('username')->where('status', 1)->get();
        $paymentNote = !empty($obj->hoahong)?$obj->hoahong->payment_note_provider:null;
        $issueDate = !empty($obj->hoahong)?$obj->hoahong->issue_date:null;
        $currencyProvider = !empty($obj->hoahong)?$obj->provider->currency_id:null;
        $configTypeOfRefund = config('myconfig.type_of_refund_profit');
        $exchangeRateProvider = 0;
        $exchangeRateAgent = 0;

        if(!empty($paymentNote) && !empty($issueDate) && !empty($currencyProvider)){
            $month = Carbon::parse($issueDate)->format('m');
            $year = Carbon::parse($issueDate)->format('Y');
            if($paymentNote == 1){
                $exchangeRateProvider = ExchangRate::where('month',$month)
                    ->where('year',$year)
                    ->where('unit',$currencyProvider)
                    ->where('type',5)
                    ->orderBy('created_at','desc')
                    ->first();
                $exchangeRateProvider = !empty($exchangeRateProvider)?$exchangeRateProvider->rate:0;
            }elseif($paymentNote == 2){
                $exchangeRateProvider = 1;
            }
            $exchangeRateAgent = ExchangRate::where('month',$month)
                ->where('year',$year)
                ->where('unit',$currencyProvider)
                ->where('type',6)
                ->orderBy('created_at','desc')
                ->first();
            $exchangeRateAgent = !empty($exchangeRateAgent)?$exchangeRateAgent->rate:0;
        }
        if (session()->get('apply_process_tab', 1) == 1)
            session()->put('apply_process_tab', $tab);
        return view('CRM.pages.customer-process', [
            'obj' => $obj,
            'flag' => 'customer_process',
            'tab' => $tab,
            'providerCom' => $providerCom,
            'tasks' => $tasks,
            'admins' => $admins,
            'exchangeRateProvider'=>$exchangeRateProvider,
            'exchangeRateAgent'=>$exchangeRateAgent,
            'issueDate'=>$issueDate,
            'configTypeOfRefund'=>$configTypeOfRefund
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function changeInvoiceStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('value');
        $obj = Apply::find($id);
        if ($obj == null) {
            $code = "danger";
            $msg = "Can not find Invoice data to update status!";
        } else {
            $old_status = $obj->status;
            $obj->update(['status' => $status]);
            $t_old = isset(config('myconfig.status_invoice')[$old_status]) ? config('myconfig.status_invoice')[$old_status] : '';
            $n_old = isset(config('myconfig.status_invoice')[$status]) ? config('myconfig.status_invoice')[$status] : '';
            $code = "primary";
            $msg = "Change status invoice from (" . $t_old . ') to (' . $n_old . ') successful !';
        }
        return view('CRM.elements.customer-process.alert', ['msg' => $msg, 'code' => $code]);
    }

    public function getBtnReceipt(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $obj = Apply::find($id);
        $count = Phieuthu::where('apply_id', $obj->id)->count();
        return view('CRM.elements.customer-process.btn-receipt', ['type' => $type, 'obj' => $obj, 'stt' => $count + 1]);
    }

    public function getBtnHH(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $obj = Apply::find($id);
        $count = Hoahong::where('apply_id', $obj->id)->count();
        return view('CRM.elements.customer-process.btn-hh', ['type' => $type, 'obj' => $obj, 'stt' => $count + 1]);
    }

    public function getBtnProfit(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $obj = Apply::find($id);
        //$count = Hoahong::where('apply_id', $obj->id)->count();
        return view('CRM.elements.customer-process.btn-profit', ['type' => $type, 'obj' => $obj, 'stt' => 1, 'profit' => $obj->profit]);
    }

    public function getBtnRefund(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');
        $obj = Apply::find($id);
        //$count = Hoahong::where('apply_id', $obj->id)->count();
        return view('CRM.elements.customer-process.btn-refund', ['type' => $type, 'obj' => $obj, 'stt' => 1, 'refund' => $obj->refund]);
    }
    public function getReceipt(Request $request)
    {
        $getApply = Apply::with([
            'phieuthus'=>function($query){
                $query->with(['invoice']);
            },
            'provider_com'
        ])->find($request->apply_id);
        $total = $getApply->total;
        $phieuthus = $getApply->phieuthus->sortByDesc('created_at');
        $providerCom = $getApply->getProviderCom();

        $result['view'] = view('CRM.elements.customer-process.table-receipt', compact(
            'phieuthus',
            'getApply',
            'providerCom'
        ))->render();
        $result['sum_amount_receipt'] = $phieuthus->sum('amount');
        $result['sum_exchange_rate_receipt'] = $phieuthus->sum('exchange_rate');
        $result['total'] = $total;
        return $result;
    }

    public function createReceipt(Request $request)
    {
        $getApply = Apply::with([
            'phieuthus',
            'agent',
            'customers',
            'provider_com'
        ])->find($request->apply_id);
        $resCus = (!empty($getApply)) ? $getApply->registerCus() : '';
        $agent = $getApply->agent;
        $providerCom = $getApply->getProviderCom();
        $stt = Phieuthu::where('apply_id', $getApply->id)->count();
        $currencyAudId = array_search('AUD',config('myconfig.currency'));
        $action = 'create';
        return view('CRM.partials.receipt_form', compact(
            'getApply',
            'resCus',
            'agent',
            'stt',
            'providerCom',
            'action',
            'currencyAudId'
        ));
    }
    public function showReceipt(Request $request)
    {
        $receipt = Phieuthu::find($request->get('id'));
        $apply_id = $receipt->apply_id;
        $getApply = Apply::with('phieuthus', 'agent')->findOrFail($apply_id);
        $resCus = (!empty($getApply)) ? $getApply->registerCus() : '';
        $providerCom = $getApply->getProviderCom();
        if ($getApply == null ||  $resCus == null ||  $providerCom == null) abort(404);
        return view('CRM.partials.receipt_form', compact(
            'getApply',
            'resCus',
            'providerCom',
            'receipt'
        ));
    }
    public function deleteReceipt(Request $request)
    {
        if ($request->get('type') == 'receipt_all') {
            $receipt = Phieuthu::find($request->get('id'));
            $apply_id = $receipt->apply_id;
            $receipt->delete();
            $phieuthus = Phieuthu::paginate(10);
            $getApply = '';
            $providerCom = '';
            $totalAmount = 0;
        } else {
            $receipt = Phieuthu::find($request->get('id'));
            $apply_id = $receipt->apply_id;
            $receipt->delete();
            $getApply = Apply::with('phieuthus')->findOrFail($apply_id);
            $phieuthus = $getApply->phieuthus->sortByDesc('created_at');
            $providerCom = $getApply->getProviderCom();
            $totalAmount = $phieuthus->sum('amount');
            $totalExchangeRate = $phieuthus->sum('amount');
        }
        return response()->json([
            'view'=>view('CRM.elements.customer-process.table-receipt', compact(
                'phieuthus',
                'getApply',
                'providerCom'
            ))->render(),
            'total'=>$totalAmount,
            'totalExchangeRate'=>$totalExchangeRate
        ]);
    }
    public function showDocs(Request $request)
    {
        $obj = Apply::findOrFail($request->get('apply_id'));
        return view('CRM.elements.customer-process.table-doc', compact('obj'));
    }
    public function showDocsAndRemindForm(Request $request)
    {
        $obj = Apply::findOrFail($request->get('apply_id'));
        $nameAgent = User::getAgentName($request->get('apply_id'));
        $register = $obj->registerCus();
        $destination = $register->destination ?? "";
        $partner = json_encode($obj->partners());
        $childs = json_encode($obj->childrens());
        $remindApply = $obj->remind_status;
        if (!empty($remindApply)) {
            $remindApply = json_decode($remindApply, true);
        }
        $result['view'] = view('CRM.elements.customer-process.table-doc', compact('obj'))->render();
        $result['remind_form'] = view('CRM.partials.remind_modal', compact('remindApply','obj'))->render();
        $result['urlExtend'] =
            route(
                'customer.create',
                [
                    'apply_id' => $request->get('apply_id'),
                    'name_agent' => $nameAgent,
                    'destination' => $destination,
                    'service_country' => (!empty($obj)) ? $obj->service_country : '',
                    'type_service' => (!empty($obj)) ? $obj->type_service : '',
                    'type_invoice' => (!empty($obj)) ? $obj->type_invoice : '',
                    'provider_id' => (!empty($obj)) ? $obj->provider_id : '',
                    'policy' => (!empty($obj)) ? $obj->policy : '',
                    'no_of_adults' => (!empty($obj)) ? $obj->no_of_adults : '',
                    'no_of_children' => (!empty($obj)) ? $obj->no_of_children : '',
                    'type_visa' => (!empty($obj)) ? $obj->type_visa : '',
                    'prefix_name' => (!empty($obj)) ? $obj->prefix_name : '',
                    'first_name' => (!empty($register)) ? $register->first_name : '',
                    'last_name' => (!empty($register)) ? $register->last_name : '',
                    'gender' => (!empty($register)) ? $register->gender : '',
                    'birth_of_date' => (!empty($register)) ? $register->birth_of_date : '',
                    'passport' => (!empty($register)) ? $register->passport : '',
                    'country' => (!empty($register)) ? $register->country : '',
                    'email' => (!empty($register)) ? $register->email : '',
                    'place_study' => (!empty($register)) ? $register->place_study : '',
                    'student_id' => (!empty($register)) ? $register->student_id : '',
                    'phone' => (!empty($register)) ? $register->phone : '',
                    'fb' => (!empty($register)) ? $register->fb : '',
                    'location_australia' => (!empty($obj)) ? $obj->location_australia : '',
                    'childs' => (!empty($childs)) ? $childs : '',
                    'partner' => (!empty($partner)) ? $partner : ''
                ]
            );
        return $result;
    }
    public function storeRemind(Request $request, $id)
    {
        $apply = Apply::findOrFail($id);
        $data['remind_status'] = $request->get('remind_status_id');
        $data['remind_note'] = $request->get('remind_status_note');
        $data['processing_date_remind'] = convert_date_to_db($request->get('remind_processing_date'));
        $apply->update($data);
        return response()->json(['success' => 1]);
    }
    public function getExchangeRateByDate(Request $request)
    {
        $type = $request->get('type');
        $date = convert_date_to_db($request->get('date'));

        if (!empty($date)) {
            $getMonth = Carbon::parse($date)->format('m');
            $getYear = Carbon::parse($date)->format('Y');
        } else {
            $getMonth = '';
            $getYear = '';
        }

        $getExchangeRate = ExchangRate::where('type', $type)
            ->where('month', $getMonth)
            ->where('year', $getYear)
            ->orderBy('id')
            ->first();
        $getExchangeRateNum = (!empty($getExchangeRate)) ? $getExchangeRate->rate : 0;
        return $getExchangeRateNum;
    }
    public function getComByIssueDate(Request $request, $id = null, $date = null){
        $idApply = null;
        $issueDate = null;
        if ($id != null && $date != null)
        {
            $idApply = $id;
            $issueDate = $date;
        }else{
            $idApply = $request->get('id');
            $issueDate = $request->get('date');
        }

        if(!empty($issueDate) && !empty($idApply)){
            $apply = Apply::with(['comms'])->find($idApply);
            $com = (!empty($apply->comms)) ? $apply->comms
                ->where('policy', $apply->policy)
                ->where('provider_id', $apply->provider_id)
                ->where('validity_start_date', '<', convert_date_to_db($issueDate))
                ->sortByDesc('validity_start_date')
                ->first() : [];
            if(!empty($com)){
                $com->display = $com->getCom();
            }
            return $com;
        }
    }
     public function getHH(Request $request)
     {
         $obj = $obj = Apply::with([
             'agent',
             'customers',
             'hoahong',
             'provider_com',
             'task',
             'provider',
             'service',
             'phieuthus'=>function($phieuthu){
                 $phieuthu->with([
                     'updater',
                     'creater'
                 ]);
             },
             'comms',
             'tailieus',
             'staff',
             'profit',
             'refund'
         ])->find($request->apply_id);

         $agent = $obj->agent;

         $issueDate = !empty($obj->hoahong)?$obj->hoahong->issue_date:null;
         $comm = $this->getComByIssueDate($request, $request->apply_id, $issueDate);
         $creater = !empty($obj->hoahong->admin_create) ? getStaffNameById($obj->hoahong->admin_create) : '';

         $result = [
             'view' => view('CRM.elements.customer-process.table-comm', ['obj' => $obj, 'agent' => $agent, 'comm' => $comm, 'issueDate' => $issueDate, 'creater' => $creater])->render(),
         ];

         return response()->json($result);
     }

     function importReceipt(Request $request)
     {
         ini_set('max_execution_time', 3600);
         ini_set('memory_limit', '2048M');
         if ($request->hasFile('file_name')) {
             $file = $request->file('file_name');
             Excel::import(new ImportReceipt(), $file);

         }
         ini_set('memory_limit', '-1');
         return back()->with(['msg', 'The Message Error']);
     }

     function importInvoice(Request $request){
         ini_set('max_execution_time', 3600);
         ini_set('memory_limit', '2048M');
         if ($request->hasFile('file_name')) {
             $file = $request->file('file_name');
             Excel::import(new ImportInvoice(), $file);

         }
         ini_set('memory_limit', '-1');
         return back()->with(['msg', 'The Message Error']);
     }
}
