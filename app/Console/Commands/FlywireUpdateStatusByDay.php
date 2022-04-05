<?php

namespace App\Console\Commands;

use App\Admin\Apply;
use App\Admin\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FlywireUpdateStatusByDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flywire:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status flywire';

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
        //
        // login
        $cookies = getLoginFlywire();
        $scCookie = $cookies['sc'];
        $peer_session_id = $cookies['peer_session_id'];
        $XSRF_TOKEN = $cookies['XSRF_TOKEN'];
        var_dump('Done login!');

        $cookie = [
            'sc' => $scCookie,
            'peer_session_id' => $peer_session_id,
            'XSRF_TOKEN' => $XSRF_TOKEN,
        ];
        $startDate = \Carbon\Carbon::now()->subDay(30)->format('Y-m-d');
        $endDate = \Carbon\Carbon::now()->format('Y-m-d');
        //end login
        //start crawl
        var_dump('Start crawl!');
        $paymentIds = $this->getAllIdFlywireOnRange($startDate, $endDate);
        if ($paymentIds->count() > 0) {
            foreach ($paymentIds as $paymentId) {
                $datas = $this->updateApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $paymentId)->getData()->data;
                $unitConfig = config('myconfig.currency');
                $statusConfig = config('myconfig.flywire_status');
                $schoolConfig = getSchoolFlywire();
                if(!empty($datas)){
                    foreach ($datas as $data) {
                        $status = collect($statusConfig)->filter(function ($item) use ($data) {
                            if (!empty($data->status)) {
                                return \Str::ascii($item) == ucfirst(strtolower(\Str::ascii($data->status)));
                            }
                        })->toArray();
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
                        $invoiceData = [
                            'status' => !empty($status) ? array_keys($status)[0] : null,
                            'delivered_date' => !empty($data->history) && !empty($data->history->deliveredAt) ? \Carbon\Carbon::parse($data->history->deliveredAt)
                                ->format('Y-m-d') : null
                        ];
                        $invoice = \App\Admin\Apply::where('ref_no', $paymentId)->update($invoiceData);
                    }
                }
            }
        }
    }

    public function updateApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $paymentId)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://agents.flywire.com/rest/payment-requests/fulfilments?_s=fullText=='.$paymentId.':*',
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

    public function getAllIdFlywireOnRange($startDate, $endDate)
    {
        $paymentIds = Apply::where('type_get_data_payment', 2)
            ->whereBetween('initiated_date', [$startDate, $endDate])
            ->pluck('ref_no');
        return $paymentIds;
    }
}
