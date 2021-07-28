<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Admin\Apply;
use App\Admin\Customer;

include('admin.php');
include('crm.php');
include('agent.php');
include('front-end.php');
Route::get('lucky-draw', 'TestController@index');
Route::get('/oauth2callback', 'TestController@googleCallBack')->name('calendar.callback');
Route::post('/flywire/store',[\App\Http\Controllers\Admin\FlywireController::class,'storeFlywireApi'])->middleware('corstest');

Route::get('test', function () {

    dd($paymentIds);
});
Route::get('/getCustomer', 'TestController@getCustomer')->name('getCustomerTest');
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared.<a href='".route('homepage')."'>Back to homepage</a>";
});
Route::get('quote-hcc', function (Illuminate\Http\Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'start_date' => 'required|date_format:d/m/Y',
        'end_date' => 'required|date_format:d/m/Y',
        'birth_day' => 'required|date_format:d/m/Y',
        'coverage_area' => 'required|min:1|in:E,I',
    ], [
        'coverage_area.in' => 'Choose E or I',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors());
    }
    $startDate = date("m/d/Y", strtotime(str_replace('/', '-', $request->get('start_date'))));
    $endDate = date("m/d/Y", strtotime(str_replace('/', '-', $request->get('end_date'))));
    $birthDay = date("m/d/Y", strtotime(str_replace('/', '-', $request->get('birth_day'))));
    $coverageArea = $request->get('coverage_area');
    $data = [
        'usCitizenOrResident' => '0',
        'CoverageArea' => $coverageArea,
        'CoverageStartDate' => $startDate,
        'CoverageEndDate' => $endDate,
        'PrimaryDob' => $birthDay,
        'Language' => 'en-US',
        'DisplayLanguage' => '',
        'ReferId' => '9800',
        'AdminOverride' => '',
        'AppName' => 'StudentSecure',
        'UUID' => '',
        'SaveDate' => '',
        'TravelerBirthdatesError' => 'Applicant+Date+of+Birth+is+required',
        'IsDisplayWidgetMode' => 'False',
        '_ga' => '',
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://quote.hccmis.com/StudentSecure/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Connection: keep-alive',
            'Pragma: no-cache',
            'Cache-Control: no-cache',
            'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
            'sec-ch-ua-mobile: ?0',
            'Upgrade-Insecure-Requests: 1',
            'Origin: https://quote.hccmis.com',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-User: ?1',
            'Sec-Fetch-Dest: document',
            'Referer: https://quote.hccmis.com/StudentSecure',
            'Accept-Language: en-US,en;q=0.9,vi;q=0.8',
            'Cookie: _ga=GA1.2.647803051.1612499506; _ga=GA1.3.647803051.1612499506; ASP.NET_SessionId=3xdxxrwiczlhpauxv1nraszt; _gid=GA1.2.1639738806.1612596232; _gid=GA1.3.1639738806.1612596232; IR_gbd=hccmis.com; _gat_UA-34093849-1=1; _gat_UA-34080282-1=1; IR_10844=1612597118373%7C0%7C1612596231594%7C%7C; OptanonConsent=landingPath=NotLandingPage&datestamp=Sat+Feb+06+2021+14%3A38%3A38+GMT%2B0700+(Indochina+Time)&version=3.6.24&groups=1%3A1%2C2%3A0%2C3%3A0%2C4%3A0%2C0_119801%3A0%2C0_120313%3A0%2C0_120214%3A0%2C0_120321%3A0%2C0_120317%3A0%2C0_144006%3A0%2C0_120300%3A0%2C0_120312%3A0%2C0_120320%3A0%2C0_119899%3A0%2C0_120250%3A0%2C0_120233%3A1%2C0_120299%3A0%2C0_120216%3A0%2C0_120311%3A0%2C0_120319%3A0%2C0_120315%3A0%2C0_119819%3A0%2C0_120215%3A1%2C0_120310%3A0%2C0_144005%3A1%2C0_120318%3A0%2C0_120314%3A0%2C0_120301%3A0%2C101%3A0%2C102%3A0%2C103%3A0%2C104%3A0%2C105%3A0%2C106%3A0%2C107%3A0%2C108%3A0%2C109%3A0%2C110%3A0%2C111%3A0%2C112%3A0%2C113%3A0%2C114%3A0%2C115%3A0%2C116%3A0%2C117%3A0%2C118%3A0%2C119%3A0%2C120%3A0%2C122%3A0%2C123%3A0%2C124%3A0%2C125%3A0%2C126%3A0%2C127%3A0%2C128%3A0%2C129%3A0%2C130%3A0&AwaitingReconsent=false',
            'Content-Type: application/x-www-form-urlencoded',
        ],

    ]);
    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    $error = curl_error($curl);
    curl_close($curl);
    $html = str_get_html(file_get_contents($info['redirect_url']));
    $arrayData = [];
    $htmlArr = $html->find('#frmChoosePlan .plan-row .plan-label');
    for ($i = 0; $i < 4; $i++) {
        $arrayData[$htmlArr[$i]->innertext] = str_replace('$', '', $html->find('#frmChoosePlan .plan-row #fullprice_'.$i)[0]->attr['value']);
    }
    return $arrayData;
});

Route::get('/flywire-portal', function () {
    //dd($info);


    if($info['http_code'] == '200'){
        preg_match_all('/^Set-Cookie:\s*([^\r\n]*)/mi', $response, $ms);
        $cookies = array();
        foreach ($ms[1] as $m) {
            [$name, $value] = explode('=', $m, 2);
            $cookies[$name] = explode(';',$value);
        }
        $scCookie = $cookies['sc'][0];
        $peer_session_id = $cookies['peer_session_id'][0];
        $XSRF_TOKEN = $cookies['XSRF-TOKEN'][0];

        $datas = cache()->remember('test', 10, function () use ($scCookie,$peer_session_id,$XSRF_TOKEN) {
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
                    'range: entities=0-20',
                    'sec-fetch-site: same-origin',
                    'sec-fetch-mode: cors',
                    'sec-fetch-dest: empty',
                    'referer: https://agents.flywire.com/',
                    'accept-language: en-US,en;q=0.9,vi;q=0.8',
                    'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc='.$scCookie.'; XSRF-TOKEN='.$XSRF_TOKEN.'; loggedIn=true; peer_session_id='.$peer_session_id.'; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
                ],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response);
        });
        $unitConfig = config('myconfig.currency');
        $statusConfig = config('myconfig.flywire_status');
        $schoolConfig = getSchoolFlywire();
        foreach ($datas as $data) {
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
                'status' => !empty($status)?array_keys($status)[0]:null,
                'policy' => 1,
                'provider_id' => 10,
                'type_service' => 5,
                'type_of_payment_fw' => 5,
                'invoice_code' => null,
                'type_get_data_payment' => 2,
                'invoice_code_link' => null,
            ];
            $invoice = \App\Admin\Apply::create($invoiceData);
            $place_study = collect($schoolConfig)->filter(function ($item,$key) use ($data) {
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
                'place_study' => !empty($place_study)?array_keys($place_study)[0]:'',
                'country' => $data->paymentRequestContact->address->country,
                'email' => $data->paymentRequestContact->displayEmail,
                'type' => 1,
            ];
            //dd($cusData);
            $customer = Customer::create($cusData);
        }
    }


});
Route::get('login-flywire',[\App\Http\Controllers\Admin\FlywireController::class,'loginFlywire'])->name('api-login-flywire');
Route::get('get-api-flywire',[\App\Http\Controllers\Admin\FlywireController::class,'getApiFlywire']);
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
