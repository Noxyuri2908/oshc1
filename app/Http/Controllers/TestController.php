<?php

namespace App\Http\Controllers;

use App\Admin\Customer;
use App\Admin\Doc;
use App\Admin\Profit;
use App\Ahm;
use App\Exports\ReportExport;
use App\Test;
use App\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use FontLib\Table\Type\head;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Sunra\PhpSimple\HtmlDomParser;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function index(Request $request)
    {
        // $client = new Google_Client();
        // $client->setAuthConfig(storage_path('credentials.json'));
        // $client->setScopes(\Google_Service_Calendar::CALENDAR);
        // $client->setRedirectUri(route('calendar.callback'));
        // $client->setAccessType('offline');        // offline access
        // $client->setIncludeGrantedScopes(true);   // incremental auth
        // $auth_url = $client->createAuthUrl();
        // header('Location: ' . $auth_url);
        // die();
//        $startDate = date('Y-m-16');
//        $endDate = date('Y-m-20');
//        $curl = curl_init();
//        $params = "{\"classId\":\"com.allianz.cisl.core.contract.Contract\",\"contractHolder\":null,\"contractInterval\":{\"classId\":\"com.allianz.cisl.base.types.Interval\",\"startDateTime\":\"".$startDate."T00:00\",\"endDateTime\":\"".$endDate."T00:00\"},\"contractNumber\":null,\"extEntity\":{\"classId\":\"com.allianz.cisl.ext.extcontract.ExtContract\",\"applicationNumber\":1,\"businessPartnerId\":49161,\"numberOfAdults\":1,\"numberOfDependents\":0},\"externalContractNumber\":\"\",\"language\":\"US\",\"parties\":[{\"classId\":\"com.allianz.cisl.core.person.Person\",\"identificationDocuments\":[{\"classId\":\"com.allianz.cisl.core.document.IdentityDocument\"}],\"roles\":[{\"classId\":\"com.allianz.cisl.core.person.InsuredPerson\",\"roleName\":\"PH\"}]}],\"premiums\":[]}";
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.allianz.com/gateway/contracts",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => "",
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS =>$params,
//            CURLOPT_HTTPHEADER => array(
//                "Connection: keep-alive",
//                "sec-ch-ua: \"Chromium\";v=\"86\", \"\"NotA;Brand\";v=\"99\", \"Google Chrome\";v=\"86\"",
//                "Accept: application/json, text/plain, */*",
//                "contractState: Quotation",
//                "sec-ch-ua-mobile: ?0",
//                "ContractVerification: ",
//                "User-User: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36",
//                "Content-Type: application/json",
//                "Origin: https://api.allianz.com",
//                "Sec-Fetch-Site: same-origin",
//                "Sec-Fetch-Mode: cors",
//                "Sec-Fetch-Dest: empty",
//                "Referer: https://api.allianz.com/myquote/1?fbclid=IwAR3JY_scAJPGOX3fcqME2kBLEVrHzauCSoPzhfVlvaK6eryFZys6TnVXEJc",
//                "Accept-Language: en,vi;q=0.9",
//                "Cookie: WebSessionID=123.24.212.24.1605521796384209"
//            ),
//        ));
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        echo $response;
//        echo 'price:'.json_decode($response)->premiums[0];
//        $interval = new \DateInterval('P1D');
//        $startDate = Carbon::now()->addDays(1);
//        $endDate = Carbon::parse('2030-12-31')->endOfYear();
//        $periods = new \DatePeriod($startDate, $interval,
//            $endDate);
//        $arrDate = iterator_to_array($periods);
//        $startDateDMY = \Carbon\Carbon::now()->format('d-M-Y');
//        $adult=1;
//        $child=0;
//        foreach($arrDate as $key=>$date) {
//            $curl = curl_init();
//            $params = "{\"classId\":\"com.allianz.cisl.core.contract.Contract\",\"contractHolder\":null,\"contractInterval\":{\"classId\":\"com.allianz.cisl.base.types.Interval\",\"startDateTime\":\"".$startDateDMY."T00:00\",\"endDateTime\":\"".$date->format('Y-m-d')."T00:00\"},\"contractNumber\":null,\"extEntity\":{\"classId\":\"com.allianz.cisl.ext.extcontract.ExtContract\",\"applicationNumber\":1,\"businessPartnerId\":49161,\"numberOfAdults\":".$adult.",\"numberOfDependents\":".$child."},\"externalContractNumber\":\"\",\"language\":\"US\",\"parties\":[{\"classId\":\"com.allianz.cisl.core.person.Person\",\"identificationDocuments\":[{\"classId\":\"com.allianz.cisl.core.document.IdentityDocument\"}],\"roles\":[{\"classId\":\"com.allianz.cisl.core.person.InsuredPerson\",\"roleName\":\"PH\"}]}],\"premiums\":[]}";
//            dd($params);
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => 'https://api.allianz.com/gateway/contracts',
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => '',
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => 'POST',
//                CURLOPT_POSTFIELDS => $params,
//                CURLOPT_HTTPHEADER => array(
//                    'Connection: keep-alive',
//                    'sec-ch-ua: "Chromium";v="86", ""NotA;Brand";v="99", "Google Chrome";v="86"',
//                    'Accept: application/json, text/plain, */*',
//                    'contractState: Quotation',
//                    'sec-ch-ua-mobile: ?0',
//                    'ContractVerification: ',
//                    'User-User: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36',
//                    'Content-Type: application/json',
//                    'Origin: https://api.allianz.com',
//                    'Sec-Fetch-Site: same-origin',
//                    'Sec-Fetch-Mode: cors',
//                    'Sec-Fetch-Dest: empty',
//                    'Referer: https://api.allianz.com/myquote/1?fbclid=IwAR3JY_scAJPGOX3fcqME2kBLEVrHzauCSoPzhfVlvaK6eryFZys6TnVXEJc',
//                    'Accept-Language: en,vi;q=0.9',
//                    'Cookie: WebSessionID=123.24.212.24.1605521796384209'
//                ),
//            ));
//
//            $response = curl_exec($curl);
//
//            curl_close($curl);
//            dd($response);
//        }
//
//        dd($arrDate);

        $url = 'https://www.flywire.com/select-institution';
//
//        $crawler = $client->request('GET', $url);
//
//        $crawler->filter('.institutions__dropdown option')->each(
//            function (Crawler $node) {
//                dd($node);
//            }
//        );
//        dd(config('school'));
//
        $schools = cache()->rememberForever('school_api_flywire',function(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.flywire.com/select-institution",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authority: www.flywire.com",
                    "cache-control: max-age=0",
                    "upgrade-insecure-requests: 1",
                    "user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36",
                    "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: navigate",
                    "sec-fetch-user: ?1",
                    "sec-fetch-dest: document",
                    "accept-language: en-US,en;q=0.9,vi;q=0.8",
                    "cookie: _cfduid=d0fc8f7be867734a6b3bb81bbff43f7901588566379; ga=GA1.2.903401277.1588566388; gid=GA1.2.5220922.1588566388; _zlcmid=y2j6l8YfdsR2Gp; CookieConsent={stamp:'ng2DOXww+MxFnZou+OQpjfi0MY7apH7rqY6I+uuJBENgIO+vrOVusA=='%2Cnecessary:true%2Cpreferences:true%2Cstatistics:true%2Cmarketing:true%2Cver:1%2Cutc:1588567020203%2Cregion:'cz'}; flywire-lang=en; gcl_au=1.1.1551917086.1588567022; driftt_aid=ff701212-7705-4bce-bccc-ee8271e6bdba; mkto_trk=id:372-QSQ-649&token:_mch-flywire.com-1588567025564-17697; hjid=a8823e54-fd04-4459-9035-eb9001f92794; hjIncludedInSample=1; driftt_sid=206086c4-ad25-4247-bd8c-9ecc36d795a7; _d_mkto=true; DFTT_END_USER_PREV_BOOTSTRAPPED=true; fingerprint=55dc47a1f8e464f1903d72a4560f757d; flywire-lang=en; _ssid=8756472a1ef354737d2989207bb3f39; _uetsid=_uetf5819727-ed22-7397-019d-29ad756fc823"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $data_result = str_get_html($response);
            $list_school = [];
            foreach ($data_result->find('.institutions__dropdown option') as $key => $item) {
                if ($key != 0) {
                    $list_school[] = $item->innertext;
                }
            }
            return $list_school;
        });
//        dd($schools);


//        dd(\GuzzleHttp\json_encode($list_school));
        return view('test');
    }

    public function getCustomer(Request $request)
    {
        $customers = Test::when($request->get('first_name'), function ($query) use ($request) {
            $query->where('first_name', 'LIKE', '%' . $request->get('first_name') . '%');
        })->when($request->get('last_name'), function ($query) use ($request) {
            $query->where('last_name', 'LIKE', '%' . $request->get('last_name') . '%');
        })->paginate(30, ['first_name', 'last_name', 'id']);
        return response()->json($customers);
    }

    public function googleCallBack(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials.json'));
        $client->setScopes(\Google_Service_Calendar::CALENDAR);
        $client->setRedirectUri(route('calendar.callback'));
        $client->setAccessType('offline');        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        if ($request->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
            dd($token);
        }
    }

    public function getData(Request $request)
    {
        $data = $request->only(['name', 'age']);
        return response()->json($data);
    }

    public function postData(Request $request)
    {
        $data = $request->only(['name', 'age']);
        return response()->json($data);
    }
}
