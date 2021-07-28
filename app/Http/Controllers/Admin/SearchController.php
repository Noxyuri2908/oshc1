<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Admin\Person;
use App\Admin;
use App\Info;
use App\Admin\Apply;
use App\Admin\Support;
use App\Admin\Service;
use App\Admin\Commission;
use App\Admin\Customer;

class SearchController extends Controller
{
    public function fillterAgent(Request $request){
        $department = $request->input('department');
        $period = $request->input('period');
        $time = $request->input('time');
        $country = $request->input('country');
        $type = $request->input('type');
        $status = $request->input('status');
        $request->session()->put('data_fillter', [
            'department' => $department,
            'period' => $period,
            'time' => $time,
            'country' => $country,
            'type' => $type,
            'status' => $status,
        ]);

        $query = User::join('infos', 'users.id', '=', 'infos.user_id');
        if($department != 'all'){
            $query = $query->where('infos.department', $department);
        }
        if($country != 'all'){
            $query = $query->where('infos.country', $country);
        }
        if($type != 'all'){
            $query = $query->where('infos.type_id', $type);
        }
        if($status != 'all'){
            $query = $query->where('users.status', $status);
        }
        if($time == null || $time == ""){
            if($period != 'all'){
                switch ($period) {
                    case '1':
                        $today = date("Y-m-d");
                        $query = $query->whereRaw("STR_TO_DATE(users.created_at,'%Y-%m-%d') = '".$today."'");
                        break;
                    case '2':
                        $week = get_week(0);
                        $query = $query->whereRaw("STR_TO_DATE(users.created_at,'%Y-%m-%d') >= '".$week['start']."' AND STR_TO_DATE(users.created_at,'%Y-%m-%d') <= '".$week['end']."'");
                        break;
                    case '3':
                        $month = date('m');
                        $query->whereRaw("EXTRACT(MONTH FROM STR_TO_DATE(users.created_at,'%Y-%m-%d')) =".$month);
                        break;
                    case '4':
                        $year = date('Y');
                        $query->whereRaw("EXTRACT(YEAR FROM STR_TO_DATE(users.created_at,'%Y-%m-%d')) =".$year);

                        break;
                    default:
                        $month = intval(trim(str_replace('t', '', $period), ' '));
                        $query->whereRaw("EXTRACT(MONTH FROM STR_TO_DATE(users.created_at,'%Y-%m-%d')) =".$month);
                        break;
                }
            }
        }else{
            $tmp = explode('to', $time);
            if (sizeof($tmp) != 2){
                $start = trim($tmp[0], ' ');
                $query = $query->whereRaw("STR_TO_DATE(users.created_at,'%Y-%m-%d') >= '".$start."'");
            }else{
                $start = trim($tmp[0], ' ');
                $end = trim($tmp[1], ' ');
                $query = $query->whereRaw("STR_TO_DATE(users.created_at,'%Y-%m-%d') >= '".$start."' AND STR_TO_DATE(users.created_at,'%Y-%m-%d') <= '".$end."'");
            }
        }
        $query = $query->select('users.*')->paginate(50);
        return view('CRM.elements.agents.table', ['users'=>$query]);
    }

    public function searchAgent(Request $request){
        $name = $request->input('name');
        $type = $request->input('type');
        $city = $request->input('city');
        $skype = $request->input('skype');
        $contact_1 = $request->input('contact_1');
        $contact_2 = $request->input('contact_2');
        $person = $request->input('person');
        $status = $request->input('status');
        $makert = $request->input('makert');
        $office = $request->input('office');
        $website = $request->input('website');
        $tel_1 = $request->input('tel_1');
        $tel_2 = $request->input('tel_2');
        $agent_code = $request->input('agent_code');
        $email = $request->input('email');
        $country = $request->input('country');
        $request->session()->put('data_search', [
            'name' => $name,
            'type' => $type,
            'city' => $city,
            'skype' => $skype,
            'contact_1' => $contact_1,//
            'contact_2' => $contact_2,//
            'person' => $person,//
            'status' => $status,
            'makert' => $makert,
            'office' => $office,
            'website' => $website,
            'tel_1' => $tel_1,
            'tel_2' => $tel_2,
            'agent_code' => $agent_code,
            'email' => $email,
            'country' => $country,
        ]);

        $query = User::join('infos', 'users.id', '=', 'infos.user_id');
        if($name != null && $name != ""){
                $_tmp = mb_strtolower($name, 'UTF-8');
                $query = $query->whereRaw('lower(users.name) like (?)', ["%{$_tmp}%"]);
        }
        if($type != 'all'){
            $query = $query->where('infos.type_id', $type);
        }
        if($city != null && $city != ""){
                $_tmp = mb_strtolower($city, 'UTF-8');
                $query = $query->whereRaw('lower(infos.city) like (?)', ["%{$_tmp}%"]);
        }
        if($office != null && $office != ""){
                $_tmp = mb_strtolower($office, 'UTF-8');
                $query = $query->whereRaw('lower(infos.office) like (?)', ["%{$_tmp}%"]);
        }
        if($office != null && $office != ""){
                $_tmp = mb_strtolower($office, 'UTF-8');
                $query = $query->whereRaw('lower(infos.office) like (?)', ["%{$_tmp}%"]);
        }
        if($website != null && $website != ""){
                $_tmp = mb_strtolower($website, 'UTF-8');
                $query = $query->whereRaw('lower(infos.website) like (?)', ["%{$_tmp}%"]);
        }
        if($tel_1 != null && $tel_1 != ""){
                $_tmp = mb_strtolower($tel_1, 'UTF-8');
                $query = $query->whereRaw('lower(infos.tel_1) like (?)', ["%{$_tmp}%"]);
        }
        if($tel_2 != null && $tel_2 != ""){
                $_tmp = mb_strtolower($tel_2, 'UTF-8');
                $query = $query->whereRaw('lower(infos.tel_2) like (?)', ["%{$_tmp}%"]);
        }
        if($agent_code != null && $agent_code != ""){
                $_tmp = mb_strtolower($agent_code, 'UTF-8');
                $query = $query->whereRaw('lower(infos.agent_code) like (?)', ["%{$_tmp}%"]);
        }
        if($email != null && $email != ""){
                $_tmp = mb_strtolower($email, 'UTF-8');
                $query = $query->whereRaw('lower(users.email) like (?)', ["%{$_tmp}%"]);
        }
        if($skype != null && $skype != ""){
                $_tmp = mb_strtolower($skype, 'UTF-8');
                $query = $query->whereRaw('lower(infos.skype) like (?)', ["%{$_tmp}%"]);
        }
        if($status != 'all'){
            $query = $query->where('users.status', $status);
        }
        if($makert != 'all'){
            $query = $query->where('infos.makert_id', $makert);
        }
        if($country != 'all'){
            $query = $query->where('infos.country', $country);
        }
        $query = $query->select('users.*')->paginate(50);
        return view('CRM.elements.agents.table', ['users'=>$query]);
    }

    public function statusAgent(Request $request){
        $status = $request->input('id');
        $request->session()->put('data_status', $status);
        $query = User::join('infos', 'users.id', '=', 'infos.user_id');
        if($status != 'all'){
            $query = $query->where('users.status', $status);
        }
        $query = $query->select('users.*')->paginate(50);
        return view('CRM.elements.agents.table', ['users'=>$query]);
    }
}