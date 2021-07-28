<?php

namespace App\Http\Controllers;

use App\Admin\Price;
use App\Admin\ProviderCom;
use Illuminate\Http\Request;
use App\Admin\Section;
use App\Admin\Content;
use App\Admin\Service;
use App\Admin\CatBenefit;
use App\Admin\Conf;
use App\Admin\Dichvu;
use App\Admin\Page;
use App\Admin\Webinfo;
use Session;

class GetAQuoteController extends Controller
{

    public function getFormQuote(Request $request)
    {
        set_step(1);
        $oshcStatusId = \Config::get('admin.service_id.oshc');
        $sc = Section::where('status', 1)->where('page_id', 1)->first();
        $ct = Content::where('status', 1)->where('section_id', 1)->get();
        $start_date = \Session::get('start_date', '');
        $end_date = \Session::get('end_date', '');
        $childs = \Session::get('childs', '');
        $adults = \Session::get('adults', '');
        $price = \Session::get('price', '');
        $serviceProviders = Dichvu::where('service_id', $oshcStatusId)
            ->get()
            ->pluck('id')
            ->toArray();
        $services = Service::with([
            'docs'=>function($query){
                $query->orderby('pos', 'asc')
                    ->where('status', 1);
            }
        ])
        ->orderby('pos', 'asc')
            ->whereIn('dichvu_id', $serviceProviders)
            ->where('status', 1)
            ->whereNotNull('link')
            ->get()
            ->transform(function ($serviceData) {
                $serviceData->docs = $serviceData->docs;
                return $serviceData;
            });
        $num_doc = 0;
//        $prices = get_price($start_date, $end_date, $adults, $childs);
        $prices = [];
        foreach ($services as $service) {
            \Session::put($service->slug, isset($prices[$service->slug]) ? $prices[$service->slug] : 0);
            $tmp = $service->docs->where('status', 1)->count();
            if ($tmp > $num_doc) $num_doc = $tmp;
        }
        $cat_benefits = CatBenefit::with([
            'benefits'=>function($query){
                $query->orderby('pos','asc')->where('status',1);
            }
        ])->orderby('pos', 'asc')->where('status', 1)->get();
        $confs = Conf::where('status', 1)->get();


        return view('fontend.page.get-a-quote', [
            'scs' => $sc,
            'cts' => $ct,
            'services' => $services,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'num_doc' => $num_doc,
            'cat_benefits' => $cat_benefits,
            'adults' => $adults,
            'childs' => $childs,
            'confs' => $confs,
            'cat_benefits' => $cat_benefits,
            'prices' => $prices
        ]);
    }

    public function getQuoteAjax(Request $request)
    {
        set_step(1);
        $start_date_from = $request->input('start_date');
        $end_date_from = $request->input('end_date');
        $adults = $request->input('adults');
        $childs = $request->input('childs');
//        $prices = get_price_insurrance($start_date_from, $end_date_from, $adults, $childs);
        $prices = get_price($start_date_from, $end_date_from, $adults, $childs);

        $oshcStatusId = \Config::get('admin.service_id.oshc');
        $serviceProviders = Dichvu::where('service_id', $oshcStatusId)->get()->pluck('id')->toArray();
        $services = Service::with([
            'docs'=>function($query){
                $query->orderby('pos', 'asc')
                    ->where('status', 1);
            }
        ])
            ->orderby('pos', 'asc')
            ->whereIn('dichvu_id', $serviceProviders)
            ->where('status', 1)
            ->whereNotNull('link')
            ->get()
            ->transform(function ($serviceData) {
                $serviceData->docs = $serviceData->docs;
                return $serviceData;
            });
        $getImageQuote = Webinfo::where('code', 'get-a-quote-image-quote-now')->first();
        $start_date = convert_date_to_db($start_date_from);
        $end_date = convert_date_to_db($end_date_from);
        \Session::put('start_date', $start_date);
        \Session::put('end_date', $end_date);
        \Session::put('adults', $adults);
        \Session::put('childs', $childs);
        $num_doc = 0;
        foreach ($services as $service) {
            \Session::put($service->slug, isset($prices[$service->slug]) ? $prices[$service->slug] : 0);
            $tmp = $service->docs->where('status', 1)->count();
            if ($tmp > $num_doc) $num_doc = $tmp;
        }
        $docs = $service
            ->docs
            ->sortBy(['pos', 'asc'])
            ->where('status', 1);
        if (!empty($request->type) && $request->type == 'mobile') {
            $cat_benefits = CatBenefit::orderby('pos', 'asc')
                ->where('status', 1)->get();
            $confs = Conf::where('status', 1)->get();
            return view('fontend.partials.mobile-get-quote', [
                'confs' => $confs,
                'cat_benefits' => $cat_benefits,
                'services' => $services,
                'prices' => $prices,
                'num_doc' => $num_doc
            ]);
        } else {
            return view('fontend.partials.get-a-quote.table-bank', [
                'services' => $services,
                'prices' => $prices,
                'num_doc' => $num_doc,
                'getImageQuote' => $getImageQuote
            ], compact('docs'));
        }
    }

    public function getQuote(Request $request)
    {
        set_step(1);
        $start_date_from = $request->input('start_date');
        $end_date_from = $request->input('end_date');
        $adults = $request->input('adults');
        $childs = $request->input('childs');
        $prices = get_price($start_date_from, $end_date_from, $adults, $childs);
//        $prices = get_price_insurrance($start_date_from, $end_date_from, $adults, $childs);

        $sc = Section::where('status', 1)->where('page_id', 1)->first();
        $ct = Content::where('status', 1)->where('section_id', 1)->get();
        $oshcStatusId = \Config::get('admin.service_id.oshc');
        $serviceProviders = Dichvu::where('service_id', $oshcStatusId)->get()->pluck('id')->toArray();
        $services = Service::with([
            'docs'=>function($query){
                $query->orderby('pos', 'asc')
                    ->where('status', 1);
            }
        ])
            ->orderby('pos', 'asc')
            ->whereIn('dichvu_id', $serviceProviders)
            ->where('status', 1)
            ->whereNotNull('link')
            ->get()
            ->transform(function ($serviceData) {
                $serviceData->docs = $serviceData->docs;
                return $serviceData;
            });
        $num_doc = 0;
        $pageHomePage = Page::where('type', 2)->first()->content;
        $serviceHome = json_decode($pageHomePage, true);
        $start_date = convert_date_to_db($start_date_from);
        $end_date = convert_date_to_db($end_date_from);
        \Session::put('start_date', $start_date);
        \Session::put('end_date', $end_date);
        \Session::put('adults', $adults);
        \Session::put('childs', $childs);
        foreach ($services as $service) {
            \Session::put($service->slug, isset($prices[$service->slug]) ? $prices[$service->slug] : 0);
            $tmp = $service->docs->where('status', 1)->count();
            if ($tmp > $num_doc) $num_doc = $tmp;
        }
        $cat_benefits = CatBenefit::with([
            'benefits'
        ])->orderby('pos', 'asc')
            ->where('status', 1)->get();
        $confs = Conf::where('status', 1)->get();
        return view('fontend.page.get-a-quote', [
            'scs' => $sc,
            'cts' => $ct,
            'services' => $services,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'num_doc' => $num_doc,
            'cat_benefits' => $cat_benefits,
            'adults' => $adults,
            'childs' => $childs,
            'confs' => $confs,
            'cat_benefits' => $cat_benefits,
            'prices' => $prices,
            'serviceHome' => $serviceHome
        ]);
    }

    public function getNib(Request $request)
    {
        $startDate = '';
        $endDate = '';
        $type = '';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.nib.com.au/overseas-students/join/api/price?startDate=04-Dec-2020&endDate=12-Jul-2024&scale=Family',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'authority: www.nib.com.au',
                'Cookie: __cfduid=dfec2cc2241b265bf8c6378d45110d1091607053677; __cf_bm=6015b141918c9667e555351b6e85adc41f445d6e-1607053678-1800-AYomLtDleh8EP+TB1tnwCNQO/J503c+mADv9lR/HYObRisPJlpaQuHnWoyT+FKV7TwVjg9W3d1XZlwLB8XnOeyE='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function getAhm(Request $request)
    {

        $startDate = '';
        $endDate = '';
        $type = '';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.members.ahmoshc.com.au/api/quotes/new?startDate=04/12/2020&visaEndDate=12/07/2024&fundId=16&scope=F&courseCompletionDate=12/07/2024',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: WeDmY4YdhyhLxvVrKEiO6OvLod7kiin5HaOBTjxe'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return \GuzzleHttp\json_decode($response,true)['amount'];
        return $response;
    }

    public function getMedibank(Request $request)
    {

        $startDate = '';
        $endDate = '';
        $type = '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.members.medibankoshc.com.au/api/quotes/new?startDate=04/12/2020&visaEndDate=12/07/2024&fundId=17&scope=F&courseCompletionDate=12/07/2024',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: WeDmY4YdhyhLxvVrKEiO6OvLod7kiin5HaOBTjxe'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function getAllian(Request $request)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.allianz.com/gateway/contracts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"classId":"com.allianz.cisl.core.contract.Contract","contractHolder":null,"contractInterval":{"classId":"com.allianz.cisl.base.types.Interval","startDateTime":"2020-12-11T00:00","endDateTime":"2021-02-04T00:00"},"contractNumber":null,"extEntity":{"classId":"com.allianz.cisl.ext.extcontract.ExtContract","applicationNumber":1,"businessPartnerId":49161,"numberOfAdults":1,"numberOfDependents":0},"externalContractNumber":"","language":"US","parties":[{"classId":"com.allianz.cisl.core.person.Person","identificationDocuments":[{"classId":"com.allianz.cisl.core.document.IdentityDocument"}],"roles":[{"classId":"com.allianz.cisl.core.person.InsuredPerson","roleName":"PH"}]}],"premiums":[]}',
            CURLOPT_HTTPHEADER => array(
                'Connection: keep-alive',
                'sec-ch-ua: "Chromium";v="86", ""NotA;Brand";v="99", "Google Chrome";v="86"',
                'Accept: application/json, text/plain, */*',
                'contractState: Quotation',
                'sec-ch-ua-mobile: ?0',
                'ContractVerification: ',
                'User-User: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36',
                'Content-Type: application/json',
                'Origin: https://api.allianz.com',
                'Sec-Fetch-Site: same-origin',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Dest: empty',
                'Referer: https://api.allianz.com/myquote/1?fbclid=IwAR3JY_scAJPGOX3fcqME2kBLEVrHzauCSoPzhfVlvaK6eryFZys6TnVXEJc',
                'Accept-Language: en,vi;q=0.9',
                'Cookie: WebSessionID=123.24.212.24.1605521796384209'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function getBupa(Request $request)
    {
        $price = Price::where('status', 1)->where('type', 2)->where('service_id', 8)->where('num_month', 10)->first();
        return $price;
    }

}
