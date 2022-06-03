<?php

namespace App\Console\Commands;

use App\Admin\Apply;
use App\Admin\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Str;

class FlywireStoreData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flywire:get-new-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl new data flywire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // login
        $cookies = getLoginFlywire();
        $scCookie = $cookies['sc'];
        $peer_session_id = $cookies['peer_session_id'];
        $XSRF_TOKEN = $cookies['XSRF_TOKEN'];
        $cookie = [
            'sc' => $scCookie,
            'peer_session_id' => $peer_session_id,
            'XSRF_TOKEN' => $XSRF_TOKEN
        ];


        //end login
        //start crawl
        $totalData = $this->getTotalFlywire($scCookie, $XSRF_TOKEN, $peer_session_id);
        $totalLocal = Apply::where('type_get_data_payment', 2)->whereDate('initiated_date', Carbon::now()->format('Y-m-d'))->count();
        $getNumberDataCrawl = $totalData - $totalLocal;

        if ($getNumberDataCrawl > 0) {
            $datas = $this->crawlApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $getNumberDataCrawl)->getData()->data;
            $unitConfig = config('myconfig.currency');
            $statusConfig = config('myconfig.flywire_status');
            $schoolConfig = getSchoolFlywire();
            foreach ($datas as $data) {
                if ($getNumberDataCrawl > 0) {
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
                            return Str::ascii($item) == ucfirst(strtolower(Str::ascii($data->status)));
                        }
                    })->toArray();
                    $invoiceData = [
                        'agent_id' => null,
                        'ref_no' => $data->externalTransactionId,
                        'amount_from' => $data->amountFrom->value / $data->amountFrom->currency->subunitToUnit,
                        'amount_from_unit' => !empty($amount_from_unit) ? array_keys($amount_from_unit)[0] : null,
                        'payment_come_from' => $data->sender->address->country,
                        'amount_to' => $data->amountTo->value / $data->amountTo->currency->subunitToUnit,
                        'amount_to_unit' => !empty($amount_to_unit) ? array_keys($amount_to_unit)[0] : null,
                        'payment_type' => null,
                        'initiated_date' => Carbon::parse($data->date)->format('Y-m-d'),
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
                        'delivered_date' => !empty($data->history) && !empty($data->history->deliveredAt) ? Carbon::parse($data->history->deliveredAt)->format('Y-m-d') : null
                    ];
                    $check = Apply::where('ref_no', $invoiceData['ref_no'])->where('type_get_data_payment', 2)->count();
                    if ($check == 0) {
                        $invoice = Apply::create($invoiceData);
                        $place_study = collect($schoolConfig)->filter(function ($item, $key) use ($data) {
                            if (!empty($data->code)) {
                                return Str::ascii($key) == Str::ascii($data->code);
                            }
                        })->toArray();
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
                        Customer::create($cusData);
                        $getNumberDataCrawl--;
                    }
                } elseif ($getNumberDataCrawl == 0) {
                    break;
                }
            }
        }
    }

    public function crawlApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $numberData)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-requests/fulfilments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
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
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc=' . $scCookie . '; XSRF-TOKEN=' . $XSRF_TOKEN . '; loggedIn=true; peer_session_id=' . $peer_session_id . '; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
            )
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        return response()->json([
            'data' => json_decode($response),
            'status' => $info['http_code']
        ]);
    }

    public function getTotalFlywire($scCookie, $XSRF_TOKEN, $peer_session_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-requests/fulfilments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
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
                'cookie: __cfduid=dbdb33779919488513fdbaf89df45358f1614941332; __zlcmid=12xjrCOI6mpqFFb; fingerprint=252e3c3d-ef15-4819-9fe6-e80be1d0a804; sc=' . $scCookie . '; XSRF-TOKEN=' . $XSRF_TOKEN . '; loggedIn=true; peer_session_id=' . $peer_session_id . '; sc=fJpxOiG6lEn0QF4oXvJ5Mi9TnkRhPXRW7Isfnk57T4wS14MLLMWJbWbSEe8Wk8IsOzj0llCSYcJs8LXELNLSE5cLLahBptTj88jd; XSRF-TOKEN=3GHHuaPxQCRc2YR1p2HyuuCpaEGvk8L132TiKDesNazUkeM3GPn8wK7NlZIpxFC6CAJxnfmShS2B4fEHPjFze7gDLVSfFFWSQASB; loggedIn=true; peer_session_id=880d6658-713c-4185-8b36-357b179e37ca',
            ),
            CURLOPT_HEADER => 1
        ));
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
}
