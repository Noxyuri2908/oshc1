<?php

namespace App\Jobs;

use App\Admin\Apply;
use App\Admin\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FlywireCrawlData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $arr;
    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $arr = $this->arr;
        $dataCookie = getLoginFlywire();
        $scCookie = $dataCookie['sc'];
        $peer_session_id = $dataCookie['peer_session_id'];
        $XSRF_TOKEN = $dataCookie['XSRF_TOKEN'];
        foreach ($arr as $paymentId) {
            $datas = $this->updateApiFlywire($scCookie, $XSRF_TOKEN, $peer_session_id, $paymentId);
            if ($datas->getData()->status == '200' && count($datas->getData()->data) > 0) {
                $unitConfig = config('myconfig.currency');
                $statusConfig = config('myconfig.flywire_status');
                $schoolConfig = getSchoolFlywire();
                foreach ($datas->getData()->data as $data) {
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
                        'amount_from' => $data->amountFrom->value / $data->amountFrom->currency->subunitToUnit,
                        'amount_from_unit' => !empty($amount_from_unit) ? array_keys($amount_from_unit)[0] : null,
                        'payment_come_from' => $data->sender->address->country,
                        'amount_to' => $data->amountTo->value / $data->amountTo->currency->subunitToUnit,
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
                        'delivered_date' => !empty($data->history) && !empty($data->history->deliveredAt) ? \Carbon\Carbon::parse($data->history->deliveredAt)
                            ->format('Y-m-d') : null,
                    ];
                    $check = Apply::where('ref_no', $invoiceData['ref_no'])
                        ->where('type_get_data_payment', 2)
                        ->count();
                    if ($check == 0) {
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
                }
            } else {
                return redirect()->route('api-login-flywire');
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

}
