<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\Dichvu;
use App\Admin\ExchangRate;
use App\Admin\Profit;
use App\Admin\Promotion;
use App\Admin\ProviderCom;
use App\Admin\School;
use App\Admin\Service;
use App\Exports\ApplyExport;
use App\Exports\UsersExport;
use App\Imports\AgentImportAgentCode;
use App\Imports\FlywireImport;
use App\Imports\FlywireImportAgent;
use App\Imports\FlywireImportComStatus;
use App\Imports\FlywireImportPromotionCode;
use App\Jobs\FlywireCrawlData;
use App\Jobs\ImportExcelContactAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FlywireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->can('flywire.index')) {
            return abort(403);
        }
        $flag = 'flywire';
        return view('CRM.pages.flywire', compact(
            'flag'
        ));
    }

    public function getData(Request $request)
    {
        $idProfit = array();
        if (!$request->user()->can('flywire.index')) {
            return abort(403);
        }
        $invoices = Apply::getFlywireList($request, 15);
        foreach ($invoices as $invoice)
        {
            if (!empty($invoice->profit->first()))
            {
                array_push($idProfit, $invoice->profit->first()->id);
            }
        }
        $profit = Profit::whereIn('id', $idProfit)
                        ->sum('com_for_agent_vnd_cp');
        $lastPage = $invoices->lastPage();
        $totalRow = $invoices->total();
        return response()->json([
            'view' => view('CRM.elements.flywire.data', compact('invoices'))->render(),
            'last_page' => $lastPage,
            'total_row' => $totalRow,
            'totalComForAgent' => !empty($profit) ? convert_price_float($profit, 0) : 0
        ]);
    }

    public function getTotalData(Request $request)
    {
        $totalStatus = [];
        $getCountData = Apply::where('type_get_data_payment', 2)->where('payment_method', 4)
            ->get(['id', 'type_get_data_payment', 'payment_method', 'status']);
        foreach (config('myconfig.flywire_status') as $keyStatus => $valueStatus) {
            $totalStatus[$valueStatus] = [
                'count' => $getCountData->where('status', $keyStatus)->count(),
                'id' => $keyStatus,
            ];
        }
        return $totalStatus;
    }

    public function showData(Request $request, $id)
    {
        if (!$request->user()->can('flywire.index')) {
            return abort(403);
        }
        $obj = Apply::with([
            'profit',
            'customers',
            'provider_com',
        ])
            ->where('payment_method', 4)
            ->where('type_get_data_payment', 2)
            ->findOrFail($id);
        $invoices = [$obj];
        return response()->json([
            'view' => view('CRM.elements.flywire.data', compact(
                'invoices'
            ))->render(),
            'id' => $obj->id,
            'type' => 'update',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->user()->can('flywire.store')) {
            return abort(403);
        }
        $flag = 'flywire-create';
        return view('CRM.elements.flywire.form', compact(
            'flag'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (!$request->user()->can('flywire.store')) {
            return abort(403);
        }
        $validationData = $request->validate([
            'provider_id' => 'required',
            'type_service' => 'required',
        ]);
        $data = $request->all();

        $data['birth_of_date'] = convert_date_to_db($data['birth_of_date']);
        $data['initiated_date'] = convert_date_to_db($data['initiated_date']);
        $data['delivered_date'] = convert_date_to_db($data['delivered_date']);
        $data['amount_from'] = convert_number_currency_to_db($data['amount_from']);
        $data['amount_to'] = convert_number_currency_to_db($data['amount_to']);
        $invoiceData = [
            'agent_id' => (!empty($data['agent_id'])) ? $data['agent_id'] : null,
            'amount_from' => (!empty($data['amount_from'])) ? $data['amount_from'] : null,
            'amount_from_unit' => (!empty($data['amount_from_unit'])) ? $data['amount_from_unit'] : null,
            'payment_come_from' => (!empty($data['payment_come_from'])) ? $data['payment_come_from'] : null,
            'amount_to' => (!empty($data['amount_to'])) ? $data['amount_to'] : null,
            'amount_to_unit' => (!empty($data['amount_to_unit'])) ? $data['amount_to_unit'] : null,
            'payment_type' => (!empty($data['payment_type'])) ? $data['payment_type'] : null,
            'initiated_date' => (!empty($data['initiated_date'])) ? $data['initiated_date'] : null,
            'std_id' => (!empty($data['std_id'])) ? $data['std_id'] : null,
            'payment_method' => (!empty($data['payment_method'])) ? $data['payment_method'] : null,
            'staff_id' => (!empty($data['staff_id'])) ? $data['staff_id'] : null,
            'note' => (!empty($data['note'])) ? $data['note'] : null,
            'status' => (!empty($data['status'])) ? $data['status'] : null,
            'policy' => 1,
            'provider_id' => (!empty($data['provider_id'])) ? $data['provider_id'] : null,
            'type_service' => (!empty($data['type_service'])) ? $data['type_service'] : null,
            'type_of_payment_fw' => (!empty($data['type_of_payment_fw'])) ? $data['type_of_payment_fw'] : null,
            'invoice_code' => (!empty($data['invoice_code'])) ? $data['invoice_code'] : null,
            'type_get_data_payment' => 2,
            'invoice_code_link' => (!empty($data['invoice_code_link'])) ? $data['invoice_code_link'] : null,
            'delivered_date' => (!empty($data['delivered_date'])) ? $data['delivered_date'] : null,
            'promotion_id' => (!empty($data['promotion_id'])) ? $data['promotion_id'] : null,
        ];

        DB::transaction(function () use ($invoiceData, $data) {
            $invoice = Apply::create($invoiceData);
            $cusData = [
                'apply_id' => $invoice->id,
                'full_name' => $data['full_name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'birth_of_date' => $data['birth_of_date'],
                'place_study' => $data['school_id'],
                'country' => $data['country'],
                'email' => $data['email'],
                'type' => 1,
            ];
            $customer = Customer::create($cusData);
        });

        return redirect()->back();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if (!$request->user()->can('flywire.edit')) {
            return abort(403);
        }
        $obj = Apply::with(['profit', 'customers','promotion'])->findOrFail($id);
        $cus = $obj->registerCus();
        $page = 1;
        $flag = 'flywire-edit';
        return view('CRM.elements.flywire.form', compact(
            'flag',
            'obj',
            'page',
            'cus'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (!$request->user()->can('flywire.update')) {
            return abort(403);
        }
        $validationData = $request->validate([
            'provider_id' => 'required',
            'type_service' => 'required',
        ]);
        $data = $request->all();
        //dd($data);
        $data['birth_of_date'] = convert_date_to_db($data['birth_of_date']);
        $data['initiated_date'] = convert_date_to_db($data['initiated_date']);
        $data['delivered_date'] = convert_date_to_db($data['delivered_date']);
        $data['amount_from'] = convert_number_currency_to_db($data['amount_from']);
        $data['amount_to'] = convert_number_currency_to_db($data['amount_to']);
        $invoiceData = [
            'agent_id' => (!empty($data['agent_id'])) ? $data['agent_id'] : null,
            'amount_from' => (!empty($data['amount_from'])) ? $data['amount_from'] : null,
            'amount_from_unit' => (!empty($data['amount_from_unit'])) ? $data['amount_from_unit'] : null,
            'payment_come_from' => (!empty($data['payment_come_from'])) ? $data['payment_come_from'] : null,
            'amount_to' => (!empty($data['amount_to'])) ? $data['amount_to'] : null,
            'amount_to_unit' => (!empty($data['amount_to_unit'])) ? $data['amount_to_unit'] : null,
            'payment_type' => (!empty($data['payment_type'])) ? $data['payment_type'] : null,
            'initiated_date' => (!empty($data['initiated_date'])) ? $data['initiated_date'] : null,
            'std_id' => (!empty($data['std_id'])) ? $data['std_id'] : null,
            'payment_method' => (!empty($data['payment_method'])) ? $data['payment_method'] : null,
            'staff_id' => (!empty($data['staff_id'])) ? $data['staff_id'] : null,
            'note' => (!empty($data['note'])) ? $data['note'] : null,
            'status' => (!empty($data['status'])) ? $data['status'] : null,
            'policy' => 1,
            'provider_id' => (!empty($data['provider_id'])) ? $data['provider_id'] : null,
            'type_service' => (!empty($data['type_service'])) ? $data['type_service'] : null,
            'type_of_payment_fw' => (!empty($data['type_of_payment_fw'])) ? $data['type_of_payment_fw'] : null,
            'invoice_code' => (!empty($data['invoice_code'])) ? $data['invoice_code'] : null,
            'type_get_data_payment' => 2,
            'invoice_code_link' => (!empty($data['invoice_code_link'])) ? $data['invoice_code_link'] : null,
            'delivered_date' => (!empty($data['delivered_date'])) ? $data['delivered_date'] : null,
            'promotion_id' => (!empty($data['promotion_id'])) ? $data['promotion_id'] : null,
        ];
        //dd($invoiceData);

        DB::transaction(function () use ($invoiceData, $data, $id) {
            $invoice = Apply::findOrFail($id);
            $invoice->update($invoiceData);
            $cusData = [
                'apply_id' => $invoice->id,
                'full_name' => $data['full_name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'birth_of_date' => $data['birth_of_date'],
                'place_study' => $data['school_id'],
                'country' => $data['country'],
                'email' => $data['email'],
                'type' => 1,
            ];
            $invoice->registerCus()->update($cusData);
        });
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->user()->can('flywire.delete')) {
            return abort(403);
        }
        $invoice = Apply::findOrFail($id);
        $invoice->registerCus()->delete();
        $invoice->delete();
        return response()->json([
            'id' => $id,
        ]);
    }

    public function process(Request $request)
    {
        if (!$request->user()->can('flywire.commissionAndProfit.show')) {
            return abort(403);
        }
        $id = $request->get('id');
        $obj = Apply::with(['comms', 'provider_com','promotion', 'customers'])->findOrFail($id);
        $profit = Profit::where('apply_id', $id)->first();
        $getInitiatedDate = (!empty($obj)) ? $obj->delivered_date : '';
        $getQuarterId = Carbon::parse($getInitiatedDate)->quarter;
        $getYearQuarter = Carbon::parse($getInitiatedDate)->format('Y');
        $getUnitProviderId = (!empty($obj)) ? $obj->amount_to_unit : '';
        $flywireComProvider = 8;
        $flywireComAgent = 9;
        $audUnit = 8;
        if ($getUnitProviderId == $audUnit) {
            $exchangeRateFlywireComProvider = new ExchangRate();
            $exchangeRateFlywireComProvider->unit_to_aud = 1;
        } else {
            $exchangeRateFlywireComProvider = ExchangRate::where('quarter_id', $getQuarterId)
                ->where('year', $getYearQuarter)
                ->where('unit', $getUnitProviderId)
                ->where('type', $flywireComProvider)
                ->first();
        }

        $unitEquals = false;
        if ($obj->amount_from_unit == $obj->amount_to_unit)
        {
            $unitEquals = true;
        }

        //dd($flywireComProvider);
        $exchangeRateFlywireComAgent = ExchangRate::where('quarter_id', $getQuarterId)
            ->where('year', $getYearQuarter)
            ->where('type', $flywireComAgent)
            ->first();
        $staffs = Admin::orderby('admin_id')->where('status', 1)->get(['id', 'status', 'admin_id']);
        $typeFlywire = 8;
        return view('CRM.pages.flywire-process', compact(
            'obj',
            'profit',
            'staffs',
            'exchangeRateFlywireComProvider',
            'exchangeRateFlywireComAgent',
            'unitEquals'
        ));
    }

    public function processComAndProfit(Request $request)
    {
        if (!$request->user()->can('flywire.commissionAndProfit.store')) {
            return abort(403);
        }
        $data = $request->all();
        $data['provider_paid_date_cp'] = (!empty($data['provider_paid_date_cp'])) ? convert_date_to_db($data['provider_paid_date_cp']) : null;
        $data['paid_com_date_agent_cp'] = (!empty($data['paid_com_date_agent_cp'])) ? convert_date_to_db($data['paid_com_date_agent_cp']) : null;
        if ($data['type_request'] == 'create') {
            $profit = Profit::create($data);
            return response()->json(['success' => 1]);
        } elseif ($data['type_request'] == 'update') {
            $profit_id = $data['profit_id'];
            $profit = Profit::with('invoice')->findOrFail($profit_id);
            $profit->update($data);
            $profit->invoice()->update([
                'status' => $data['status'],
            ]);
            return response()->json(['success' => 2]);
        }
    }

    public function getExchangeProvider(Request $request)
    {
        $date = convert_date_to_db($request->get('date'));
        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');
        $exchange_rate = ExchangRate::where('unit', 1)->where('month', $month)->where('year', $year)->first();
        $getRate = !empty($exchange_rate) ? $exchange_rate->rate : 0;
        return $getRate;
    }

    public function storeFlywireApi(Request $request)
    {
        $data = $request->only([
            'school',
            'amount',
            'type-payment',
            'your-email',
            'first-name',
            'last-name',
            'Nationality',
            'agent-education',
            'email-agent',
        ]);
        $typePayment = config('myconfig.payment_type');
        $schools = getSchoolFlywire();
        $typePaymentData = collect($typePayment)->filter(function ($item) use ($data) {
            return false !== stristr(\Str::ascii($item), \Str::ascii($data['type-payment']));
        })->toArray();
        $schoolData = collect($schools)->filter(function ($item) use ($data) {
            return false !== stristr(\Str::ascii($item), \Str::ascii($data['school']));
        })->toArray();
        $countries = collect(config('country.list'))->filter(function ($item) use ($data) {
            return false !== stristr(\Str::ascii($item), \Str::ascii($data['Nationality']));
        })->toArray();
        $dataRequest = [
            'type_get_data_payment' => 2,
            'payment_method' => 4,
            'amount_from' => $data['amount'],
            'type_of_payment_fw' => !empty($typePaymentData) ? array_keys($typePaymentData)[0] : null,
            'note' => json_encode([
                'school' => $data['school'],
                'type-payment' => $data['type-payment'],
                'your-email' => $data['your-email'],
                'Nationality' => $data['Nationality'],
                'agent-education' => $data['agent-education'],
                'email-agent' => $data['email-agent'],
            ]),
        ];
        try {
            //$apply = Apply::create($dataRequest);
            //$dataCustomer = [
            //    'apply_id' => $apply->id,
            //    'full_name' => $data['first-name'].' '.$data['last-name'],
            //    'email' => $data['your-email'],
            //    'type' => 1,
            //    'education_agent' => $data['agent-education'],
            //    'place_study' => !empty($schoolData) ? array_keys($schoolData)[0] : null,
            //    'country' => !empty($countries) ? array_keys($countries)[0] : null,
            //];
            //$customer = Customer::create($dataCustomer);
            return response()->json(['success', 1]);
        } catch (Exception $e) {
            return response()->json(['error', $e]);
        }
    }

    public function showDocsAndRemindForm(Request $request)
    {
        $obj = Apply::with(['applyLink.tailieus', 'tailieus'])->findOrFail($request->get('apply_id'));
        $docs = $obj->tailieus;
        $linkDocs = (!empty($obj->applyLink)) ? $obj->applyLink->tailieus : collect([]);
        $totalDocs = $docs->merge($linkDocs);
        $register = $obj->registerCus();
        $partner = json_encode($obj->partners());
        $childs = json_encode($obj->childrens());
        $remindApply = $obj->remind_status;
        if (!empty($remindApply)) {
            $remindApply = json_decode($remindApply, true);
        }
        $result['view'] = view('CRM.elements.flywire-process.table-doc', compact('totalDocs'))->render();
        $result['remind_form'] = view('CRM.partials.remind_modal', compact('remindApply', 'obj'))->render();
        $result['urlExtend'] =
            route(
                'customer.create',
                [
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
                    'partner' => (!empty($partner)) ? $partner : '',
                ]
            );
        return $result;
    }

    public function loginFlywire()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/authentication/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'authority: agents.flywire.com',
                'pragma: no-cache',
                'cache-control: no-cache',
                'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
                'accept: application/json, text/plain, */*',
                'authorization: Basic aW5mb0Bvc2hjc3R1ZGVudHMuY29tOjEyM0BBbm5hbGluaw==',
                'sec-ch-ua-mobile: ?0',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                'content-type: application/json',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode: cors',
                'sec-fetch-dest: empty',
                'referer: https://agents.flywire.com/',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=dd49fa4f-a2fb-494b-b937-df8aeda1cc57; loggedIn=true; sc=AFGFyij4d2mp6F20Cm9sHrkkjQtnmYAbXVM6p9UgxqaONC8QiCbpnzZxYwYN5csUj545Qs55Z6IS40QLyjq1eX59nN9zMbhD0ReQ; XSRF-TOKEN=C7r5nZER2Mpb0fCz2frzw9t4YBrYUoigIOB3WXTyWXwKPXin28qEtXwMZpJCIKnnc9CNbWLXD9GkB0aeH8Knuj6S7KDB9tCIYEpl; peer_session_id=4610209f-986c-4c8a-87f9-75ac10bdb085',
            ],
            CURLOPT_HEADER => 1,
        ]);

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        if ($info['http_code'] == '200') {
            preg_match_all('/^Set-Cookie:\s*([^\r\n]*)/mi', $response, $ms);
            $cookies = [];
            foreach ($ms[1] as $m) {
                [$name, $value] = explode('=', $m, 2);
                $cookies[$name] = explode(';', $value);
            }
            $scCookie = $cookies['sc'][0];
            $peer_session_id = $cookies['peer_session_id'][0];
            $XSRF_TOKEN = $cookies['XSRF-TOKEN'][0];
            $cookie = [
                'sc' => $scCookie,
                'peer_session_id' => $peer_session_id,
                'XSRF_TOKEN' => $XSRF_TOKEN,
            ];
            session()->put('flywire_cookie', $cookie);
        } else {
            return response()->json('Username or password not match', 401);
        }
    }

    public function getApiFlywire()
    {
        //$login = $this->loginFlywire();
        //dd(session()->all());
        if (session()->has('flywire_cookie')) {
            $dataCookie = session()->get('flywire_cookie');
            //dd($dataCookie);
            $scCookie = $dataCookie['sc'];
            $peer_session_id = $dataCookie['peer_session_id'];
            $XSRF_TOKEN = $dataCookie['XSRF_TOKEN'];
            $datas = $this->crawlApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id);
            $totalData = $this->getTotalFlywire($scCookie, $XSRF_TOKEN, $peer_session_id);
            $totalLocal = Apply::where('type_get_data_payment', 2)->count();
            if ($datas->getData()->status == '200') {
                $unitConfig = config('myconfig.currency');
                $statusConfig = config('myconfig.flywire_status');
                $schoolConfig = getSchoolFlywire();
                foreach ($datas->getData()->data as $data) {
                    //dd($data);
                    $amount_from_unit = collect($unitConfig)->filter(function ($item) use ($data) {
                        if (!empty($data->amountFrom->currency->code)) {
                            return $data->amountFrom->currency->code == $item;
                        }
                    })->toArray();
                    $amount_to_unit = collect($unitConfig)->filter(function ($item) use ($data) {
                        if (!empty($data->amountTo->currency->code)) {
                            return $data->amountTo->currency->code == $item;
                        }
                    })->toArray();
                    $status = collect($statusConfig)->filter(function ($item) use ($data) {
                        if (!empty($data->status)) {
                            return \Str::ascii($item) == ucfirst(strtolower(\Str::ascii($data->status)));
                        }
                    })->toArray();
                    $invoiceData = [
                        'agent_id' => null,
                        'ref_no' => $data->externalTransactionId,
                        'amount_from' => $data->amountFrom->value,
                        'amount_from_unit' => !empty($amount_from_unit) ? array_keys($amount_from_unit)[0] : null,
                        'payment_come_from' => $data->sender->address->country,
                        'amount_to' => $data->amountTo->value,
                        'amount_to_unit' => !empty($amount_to_unit) ? array_keys($amount_to_unit)[0] : null,
                        'payment_type' => null,
                        'initiated_date' => \Carbon\Carbon::parse($data->date)->format('Y-m-d'),
                        'std_id' => $data->paymentRequestContact->accountNumber,
                        'payment_method' => 4,
                        'staff_id' => 1,
                        'note' => null,
                        'status' => !empty($status) ? array_keys($status)[0] : null,
                        'policy' => 1,
                        'provider_id' => 10,
                        'type_service' => 5,
                        'type_of_payment_fw' => 5,
                        'invoice_code' => null,
                        'type_get_data_payment' => 2,
                        'invoice_code_link' => null,
                    ];
                    $invoice = \App\Admin\Apply::create($invoiceData);
                    $place_study = collect($schoolConfig)->filter(function ($item, $key) use ($data) {
                        if (!empty($data->code)) {
                            return \Str::ascii($key) == \Str::ascii($data->code);
                        }
                    })->toArray();
                    //dd(array_keys($place_study)[0]);
                    $cusData = [
                        'apply_id' => $invoice->id,
                        'full_name' => $data->paymentRequestContact->displayName,
                        'gender' => null,
                        'phone' => null,
                        'birth_of_date' => null,
                        'place_study' => !empty($place_study) ? array_keys($place_study)[0] : '',
                        'country' => $data->paymentRequestContact->address->country,
                        'email' => $data->paymentRequestContact->displayEmail,
                        'type' => 1,
                    ];
                    $customer = Customer::create($cusData);
                }
            } else {
                return redirect()->route('api-login-flywire');
            }
        } else {
            return redirect()->route('api-login-flywire');
        }
    }

    public function crawlApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-request/payment/search',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'authority: agents.flywire.com',
                'pragma: no-cache',
                'cache-control: no-cache',
                'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
                'accept: application/json, text/plain, */*',
                'x-xsrf-token: TI0Sy983LCzaQitDknUnl6IGIOiE4P7vVX5l7Xqd6R7fk2wWYzGPm2WFS24UCMTifDSbpvwfl3PsH69GtIjDNCYY6H8NtmnqojZz',
                'sec-ch-ua-mobile: ?0',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                'range: entities=0-100',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode: cors',
                'sec-fetch-dest: empty',
                'referer: https://agents.flywire.com/',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc='.$scCookie.'; XSRF-TOKEN='.$XSRF_TOKEN.'; loggedIn=true; peer_session_id='.$peer_session_id.'; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
            ],
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);
        //dd(json_decode($response));
        return response()->json([
            'data' => json_decode($response),
            'status' => $info['http_code'],
        ]);

        //if($info['http_code'] == '200'){
        //    return json_decode($response);
        //}else{
        //    return redirect()->route('api-login-flywire');
        //}
    }

    public function getTotalFlywire($scCookie, $XSRF_TOKEN, $peer_session_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-request/payment/search',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'authority: agents.flywire.com',
                'pragma: no-cache',
                'cache-control: no-cache',
                'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
                'accept: application/json, text/plain, */*',
                'x-xsrf-token: TI0Sy983LCzaQitDknUnl6IGIOiE4P7vVX5l7Xqd6R7fk2wWYzGPm2WFS24UCMTifDSbpvwfl3PsH69GtIjDNCYY6H8NtmnqojZz',
                'sec-ch-ua-mobile: ?0',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                'range: entities=0-1',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode: cors',
                'sec-fetch-dest: empty',
                'referer: https://agents.flywire.com/',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc='.$scCookie.'; XSRF-TOKEN='.$XSRF_TOKEN.'; loggedIn=true; peer_session_id='.$peer_session_id.'; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
            ],
            CURLOPT_HEADER => 1,
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);
        $headers = [];
        $responseHeader = rtrim($response);
        $data = explode("\n", $responseHeader);
        $headers['status'] = $data[0];
        array_shift($data);

        foreach ($data as $part) {
            //some headers will contain ":" character (Location for example), and the part after ":" will be lost, Thanks to @Emanuele
            $middle = explode(":", $part, 2);

            //Supress warning message if $middle[1] does not exist, Thanks to @crayons
            if (!isset($middle[1])) {
                $middle[1] = null;
            }

            $headers[trim($middle[0])] = trim($middle[1]);
        }

        // Print all headers as array
        $totalData = explode('/', $headers['Content-Range'])[1];
        return $totalData;
    }

    public function storeFlywireByPaymentId(Request $request)
    {

        //if (session()->has('flywire_cookie')) {
        //    $dataCookie = session()->get('flywire_cookie');
        //    //dd($dataCookie);
        //    $scCookie = $dataCookie['sc'];
        //    $peer_session_id = $dataCookie['peer_session_id'];
        //    $XSRF_TOKEN = $dataCookie['XSRF_TOKEN'];
        //    foreach ($arr as $paymentId) {
        //        $datas = $this->updateApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $paymentId);
        //        if ($datas->getData()->status == '200' && count($datas->getData()->data) > 0) {
        //            $unitConfig = config('myconfig.currency');
        //            $statusConfig = config('myconfig.flywire_status');
        //            $schoolConfig = getSchoolFlywire();
        //            foreach ($datas->getData()->data as $data) {
        //                $amount_from_unit = collect($unitConfig)->filter(function ($item) use ($data) {
        //                    if (!empty($data->amountFrom->currency->code)) {
        //                        return $data->amountFrom->currency->code == $item;
        //                    }
        //                })->toArray();
        //                $amount_to_unit = collect($unitConfig)->filter(function ($item) use ($data) {
        //                    if (!empty($data->amountTo->currency->code)) {
        //                        return $data->amountTo->currency->code == $item;
        //                    }
        //                })->toArray();
        //                $status = collect($statusConfig)->filter(function ($item) use ($data) {
        //                    if (!empty($data->status)) {
        //                        return \Str::ascii($item) == ucfirst(strtolower(\Str::ascii($data->status)));
        //                    }
        //                })->toArray();
        //                $invoiceData = [
        //                    'agent_id' => null,
        //                    'ref_no' => $data->externalTransactionId,
        //                    'amount_from' => $data->amountFrom->value / $data->amountFrom->currency->subunitToUnit,
        //                    'amount_from_unit' => !empty($amount_from_unit) ? array_keys($amount_from_unit)[0] : null,
        //                    'payment_come_from' => $data->sender->address->country,
        //                    'amount_to' => $data->amountTo->value / $data->amountTo->currency->subunitToUnit,
        //                    'amount_to_unit' => !empty($amount_to_unit) ? array_keys($amount_to_unit)[0] : null,
        //                    'payment_type' => null,
        //                    'initiated_date' => \Carbon\Carbon::parse($data->date)->format('Y-m-d'),
        //                    'std_id' => $data->paymentRequestContact->accountNumber,
        //                    'payment_method' => 4,
        //                    'staff_id' => 1,
        //                    'note' => null,
        //                    'status' => !empty($status) ? array_keys($status)[0] : null,
        //                    'policy' => 1,
        //                    'provider_id' => 10,
        //                    'type_service' => 5,
        //                    'type_of_payment_fw' => 5,
        //                    'invoice_code' => null,
        //                    'type_get_data_payment' => 2,
        //                    'invoice_code_link' => null,
        //                    'delivered_date' => !empty($data->history) && !empty($data->history->deliveredAt) ? \Carbon\Carbon::parse($data->history->deliveredAt)
        //                        ->format('Y-m-d') : null,
        //                ];
        //                $check = Apply::where('ref_no', $invoiceData['ref_no'])
        //                    ->where('type_get_data_payment', 2)
        //                    ->count();
        //                if ($check == 0) {
        //                    $invoice = \App\Admin\Apply::create($invoiceData);
        //                    $place_study = collect($schoolConfig)->filter(function ($item, $key) use ($data) {
        //                        if (!empty($data->code)) {
        //                            return \Str::ascii($key) == \Str::ascii($data->code);
        //                        }
        //                    })->toArray();
        //                    //dd(array_keys($place_study)[0]);
        //                    $cusData = [
        //                        'apply_id' => $invoice->id,
        //                        'full_name' => $data->paymentRequestContact->displayName,
        //                        'gender' => null,
        //                        'phone' => null,
        //                        'birth_of_date' => null,
        //                        'place_study' => !empty($place_study) ? array_keys($place_study)[0] : '',
        //                        'country' => $data->paymentRequestContact->address->country,
        //                        'email' => $data->paymentRequestContact->displayEmail,
        //                        'type' => 1,
        //                    ];
        //                    $customer = Customer::create($cusData);
        //                }
        //            }
        //        } else {
        //            return redirect()->route('api-login-flywire');
        //        }
        //    }
        //} else {
        //    return redirect()->route('api-login-flywire');
        //}
        $paymentId = $request->get('payment_ids');
        $text = trim($paymentId);
        $arr = explode("\r\n", $text);
        if(count($arr)>0){
            dispatch(new FlywireCrawlData($arr));
        }
        return redirect()->back();
    }

    public function updateApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $paymentId)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-request/payment/search?_s=fullText=='.$paymentId.':*',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'authority: agents.flywire.com',
                'pragma: no-cache',
                'cache-control: no-cache',
                'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
                'accept: application/json, text/plain, */*',
                'x-xsrf-token: EO3vXMzjU3WjqRvWz0n06FC2zi7sYk80N74u6Vfrm2YdQSBwWllmKN6j0IZlGM5ozliDHNI0DxEJ4DxoAMt17ZzL0ztYMHW9I736',
                'sec-ch-ua-mobile: ?0',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
                'range: entities=0-10',
                'sec-fetch-site: same-origin',
                'sec-fetch-mode: cors',
                'sec-fetch-dest: empty',
                'referer: https://agents.flywire.com/',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc='.$scCookie.'; XSRF-TOKEN='.$XSRF_TOKEN.'; loggedIn=true; peer_session_id='.$peer_session_id.'; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
            ],
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        return response()->json([
            'data' => json_decode($response),
            'status' => $info['http_code'],
        ]);
    }

    function importFlywirebyPaymentId(Request $request)
    {

        if (!$request->user()->can('agent.store')) {
            abort(403);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new FlywireImport(), $file);

        }
        return back()->with(['msg', 'The Message Error']);
    }

    function exportFlywire(Request $request)
    {
        try {
            return (new ApplyExport())->request($request)->download('Flywire.xlsx');

            $var_msg = "This is an exception example";
            throw new \League\Flysystem\Exception($var_msg);

        }catch (\Exception $e)
        {
            echo "Message: " . $e->getMessage();
            echo "";
            echo "getCode(): " . $e->getCode();
            echo "";
            echo "__toString(): " . $e->__toString();
        }
    }

    function importComStatus(Request $request)
    {
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }

        if ($request->hasFile('fileImportCom')) {
            $file = $request->file('fileImportCom');
            Excel::import(new FlywireImportComStatus(), $file);

        }
        return back()->with(['msg', 'The Message Error']);
    }

    function importPromotionCode(Request $request){
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }

        if ($request->hasFile('fileImportPromotionCode')) {
            $file = $request->file('fileImportPromotionCode');
            Excel::import(new FlywireImportPromotionCode(), $file);

        }
        return back()->with(['msg', 'The Message Error']);
    }

    function importAgent(Request $request){
        if (!$request->user()->can('agent.store')) {
            abort(403);
        }

        if ($request->hasFile('importAgent')) {
            $file = $request->file('importAgent');
            Excel::import(new FlywireImportAgent(), $file);

        }
        return back()->with(['msg', 'The Message Error']);
    }

}
