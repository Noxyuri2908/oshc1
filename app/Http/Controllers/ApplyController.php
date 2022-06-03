<?php

namespace App\Http\Controllers;

use App\Admin\CustomerDatabaseManager;
use App\Http\Requests\ApplyRegisterPostRequest;
use Illuminate\Http\Request;
use App\Admin\Webinfo;
use App\Admin\Service;
use App\Admin\Apply;
use App\Info;
use App\Admin\Customer;
use App\User;
use Session;
use Illuminate\Support\Facades\Mail;


class ApplyController extends Controller
{
    public function applyService(Request $request, $id, $price)
    {
        $step = \Session::get('step', 0);
        $apply_id = \Session::get('apply', 0);
        if ($step == 0) {
            return redirect()->route('get-a-quote.get');
        } elseif ($step == 1 || $apply_id == 0) {
            $service = Service::find($id);
            if ($service == null) return redirect()->back();
            $start_date = \Session::get('start_date', '');
            $end_date = \Session::get('end_date', '');
            $childs = \Session::get('childs', 0);
            $adults = \Session::get('adults', 0);
            if ($childs == 0 && $adults == 1) {
                $policy = 1;
            } else if ($childs > 0) {
                $policy = 3;
            } else {
                $policy = 2;
            }
            $price = \Session::get($service->slug, '');
            if ($start_date == '' || $end_date == '' || $adults == 0 || $price == 0) {
                return redirect()->route('get-a-quote.get');
            }
            \Session::put('provider_id', $service->id);
            \Session::put('price', $price);
            \Session::put('policy', $policy);

            set_step(2);
        } elseif ($step == 2 || $apply_id == 0) {
            $service = Service::find($id);
            if ($service == null) return redirect()->back();
            $start_date = \Session::get('start_date', '');
            $end_date = \Session::get('end_date', '');
            $childs = \Session::get('childs', 0);
            $adults = \Session::get('adults', 0);
            if ($childs == 0 && $adults == 1) {
                $policy = 1;
            } else if ($childs > 0) {
                $policy = 3;
            } else {
                $policy = 2;
            }
            $price = \Session::get($service->slug, '');
            if ($start_date == '' || $end_date == '' || $adults == 0 || $price == 0) {
                return redirect()->route('get-a-quote.get');
            }
            \Session::put('provider_id', $service->id);
            \Session::put('price', $price);
            \Session::put('policy', $policy);
            set_step(2);
        } elseif ($step == 3 || $apply_id != 0) {
            $service = Service::find($id);
            if ($service == null) return redirect()->back();
            $start_date = \Session::get('start_date', '');
            $end_date = \Session::get('end_date', '');
            $childs = \Session::get('childs', 0);
            $adults = \Session::get('adults', 0);
            if ($childs == 0 && $adults == 1) {
                $policy = 1;
            } else if ($childs > 0) {
                $policy = 3;
            } else {
                $policy = 2;
            }
            $price = \Session::get($service->slug, '');
            if ($start_date == '' || $end_date == '' || $adults == 0 || $price == 0) {
                return redirect()->route('get-a-quote.get');
            }
            \Session::put('price', $price);

            $apply = Apply::findOrFail($apply_id);
            $apply->update([
                'provider_id' => $service->id,
                'policy' => $policy,
                'start_date' => convert_date_to_db($start_date),
                'end_date' => convert_date_to_db($end_date),
                'no_of_adults' => $adults,
                'no_of_children' => $childs,
                'net_amount' => $price,
                'type_service' => $service->dichvu_id
            ]);
            set_step(2);
        } else {
            return redirect()->route('get-a-quote.get');
        }


//
//
//
//
//            //START create Apply
//            $data = [];
//            $data['provider_id'] = $service->id;
//            $data['policy'] = $policy;
//            $data['start_date'] = convert_date_to_db($start_date);
//            $data['end_date'] = convert_date_to_db($end_date);
//            $data['no_of_adults'] = $adults;
//            $data['no_of_children'] = $childs;
//            $data['net_amount'] = $price;
//            $data['type_service'] = $service->dichvu_id;
//
//
//            if (\Auth::check()) {
//                $user = \Auth::user();
//                if ($user->role != "agent") return back();
//            }
//            if (isset($user)) {
//                $data['type'] = 1;
//                $data['user_id'] = $user->id;
//                $data['status'] = 0;
//            } else {
//                $data['type'] = 0;
//                $data['status'] = 0;
//            }
//            $tmp = Apply::orderby('id', 'desc')->first();
//            if ($tmp == null) $num = 1;
//            else $num = $tmp->id + 1;
//            $code = "SIA" . date("y") . str_pad($num, 6, '0', STR_PAD_LEFT);
//            $data['ref_no'] = $code;
//            $data['type_get_data_payment'] = 1;
//            //            dd($data);
//            $apply = Apply::create($data);
//            //END create Apply
//            \Session::put('apply', $apply->id);
//            $apply_id = $apply->id;
//            set_step(2);
//        } else {
//            $childs = \Session::get('childs', 0);
//            $adults = \Session::get('adults', 0);
//
//            if ($childs == 0 && $adults == 1) {
//                $policy = 1;
//            } else if ($childs > 0) {
//                $policy = 3;
//            } else {
//                $policy = 2;
//            }
//
//            $apply = Apply::find($apply_id);
//            if ($apply == null) {
//                reset_data();
//                return redirect()->route('home');
//            }
//            $apply->net_amount = $price;
//            $apply->policy = $policy;
//            $apply->provider_id = $id;
//            $apply->start_date = \Session::get('start_date', '');
//            $apply->end_date = \Session::get('end_date', '');
//            $apply->no_of_adults = \Session::get('adults', '');
//            $apply->no_of_children = \Session::get('childs', '');
//            $apply->update();
//        }
        return route('apply.register');
    }

    public function register(Request $request)
    {
        $info = Webinfo::whereIN('code', [
            'apply_section_1',
            'apply_section_2',
            'apply_section_3',
            'apply_section_4',
            'apply_section_5',
            'apply_section_6'
        ])
            ->where('status', 1)->get();

        $apply_section_1 = $info->where('code', 'apply_section_1')->first();
        $apply_section_2 = $info->where('code', 'apply_section_2')->first();
        $apply_section_3 = $info->where('code', 'apply_section_3')->first();
        $apply_section_4 = $info->where('code', 'apply_section_4')->first();
        $apply_section_5 = $info->where('code', 'apply_section_5')->first();
        $apply_section_6 = $info->where('code', 'apply_section_6')->first();
        $service_id = session()->get('provider_id');

        if (empty($service_id)) {
            return redirect()->route('get-a-quote.get');
        } else {
            $service = Service::find($service_id);
            $start_date = session()->get('start_date');
            $end_date = session()->get('end_date');
            $childs = session()->get('childs');
            $adults = session()->get('adults');
            $price = session()->get('price');
            return view('fontend.page.apply', [
                'apply_section_1' => $apply_section_1,
                'apply_section_2' => $apply_section_2,
                'apply_section_3' => $apply_section_3,
                'apply_section_4' => $apply_section_4,
                'apply_section_5' => $apply_section_5,
                'apply_section_6' => $apply_section_6
            ], compact(
                'service',
                'start_date',
                'end_date',
                'childs',
                'adults',
                'price'
            ));
        }

    }

    public function apply($id)
    {
        $apply = Apply::find($id);
        if ($apply == null) {
            \Session::put('step', 1);
            return redirect()->route('get-a-quote.get');
        }
        $info = Webinfo::whereIN('code', [
            'apply_section_1', 'apply_section_2',
            'apply_section_3', 'apply_section_4',
            'apply_section_5', 'apply_section_6'
        ])
            ->where('status', 1)->get();

        $apply_section_1 = $info->where('code', 'apply_section_1')->first();
        $apply_section_2 = $info->where('code', 'apply_section_2')->first();
        $apply_section_3 = $info->where('code', 'apply_section_3')->first();
        $apply_section_4 = $info->where('code', 'apply_section_4')->first();
        $apply_section_5 = $info->where('code', 'apply_section_5')->first();
        $apply_section_6 = $info->where('code', 'apply_section_6')->first();

        return view('fontend.page.apply', [
            'apply_section_1' => $apply_section_1,
            'apply_section_2' => $apply_section_2,
            'apply_section_3' => $apply_section_3,
            'apply_section_4' => $apply_section_4,
            'apply_section_5' => $apply_section_5,
            'apply_section_6' => $apply_section_6,
            'apply' => $apply
        ]);
    }

    public function applyPost(ApplyRegisterPostRequest $request)
    {
        $statuses = cache()->remember('customer.statuses.store',60,function(){
            return \App\Admin\Status::whereIn('type',[
                'customer_database_manager_type_of_customer',
                'customer_database_manager_resource',
                'customer_database_manager_english_center',
                'customer_database_manager_event',
                'customer_database_manager_study_tour'
            ])->get();
        });
        $idStatusCRMOshc = $statuses->where('name','CRM OSHC')->first()->id;

        $step = \Session::get('step', 0);
        if($step == 2){
            $service = Service::findOrFail(session()->get('provider_id'));
            $data['provider_id'] = session()->get('provider_id');
            $data['policy'] = session()->get('policy');
            $data['start_date'] = session()->get('start_date');
            $data['end_date'] = session()->get('end_date');
            $data['no_of_adults'] = session()->get('adults');
            $data['no_of_children'] = session()->get('childs');
            $data['net_amount'] = session()->get('price');
            $data['type_service'] = $service->dichvu_id;
            $tmp = Apply::orderby('id', 'desc')->first();
            if ($tmp == null) $num = 1;
            else $num = $tmp->id + 1;
            $code = "SIA" . date("y") . str_pad($num, 6, '0', STR_PAD_LEFT);
            $data['ref_no'] = $code;
            $data['type_get_data_payment'] = 1;
            $data['location_australia'] = $request->get('location_australia');
            $getAgentDefault = User::where('is_default', 1)->first()->id;
            $data['agent_id'] = $getAgentDefault;
            $dataCustomerManager['full_name'] = $request->get('main_first_name').$request->get('main_last_name');
            $dataCustomerManager['source_id'] = $idStatusCRMOshc;
            $dataCustomerManager['agent_id'] = $getAgentDefault;
            $dataCustomerManager['gender']= $request->get('main_gender');
            $dataCustomerManager['date_of_birth']= $request->main_year.'-'.$request->main_month.'-'.$request->main_date ;
            $dataCustomerManager['mail']= $request->get('main_email');
            $dataCustomerManager['phone_number']= $request->get('main_phone');
            $dataCustomerManager['country_id'] = $request->get('main_country');
            $dataCustomerManager['potential_service'] = session()->get('provider_id');
            $customerDatabaseManager = CustomerDatabaseManager::create($dataCustomerManager);
            $data['customer_manager_id']=$customerDatabaseManager->id;

            $apply = Apply::create($data);
            \Session::put('apply', $apply->id);
            $apply_id = $apply->id;
            $applyServiceName = $service->name;
            $applyStartDate = $apply->start_date;
            $applyEndDate = $apply->end_date;
            $applyNumAdults = $apply->no_of_adults;
            $applyNumChilds = $apply->no_of_children;
            $getPriceProvider = $apply->net_amount;
            $getInvoiceCode = $apply->ref_no;
            $email = $request->main_email;
            $r_email = $request->main_email_confirm;
            $location_australia = $apply->location_australia;
        }else{
            $apply_id = session()->get('apply');
            $apply = Apply::with('provider')->find($apply_id);
            $applyServiceName = '';
            $applyStartDate = '';
            $applyEndDate = '';
            $applyNumAdults = '';
            $applyNumChilds = '';
            $getPriceProvider = '';
            $getInvoiceCode = '';
            $location_australia = '';
            if (!empty($apply))
            {
                $applyServiceName = $apply->provider->name;
                $applyStartDate = $apply->start_date;
                $applyEndDate = $apply->end_date;
                $applyNumAdults = $apply->no_of_adults;
                $applyNumChilds = $apply->no_of_children;
                $getPriceProvider = $apply->net_amount;
                $getInvoiceCode = $apply->ref_no;
                $location_australia = $apply->location_australia;
            }
            $email = $request->main_email;
            $r_email = $request->main_email_confirm;
        }
        $data_email['main'] = [];
        $data_email['adults'] = [];
        $data_email['child'] = [];
        $data_email['service'] =
            [
                'name' => $applyServiceName,
                'start_date' => $applyStartDate,
                'end_date' => $applyEndDate,
                'no_of_adults' => $applyNumAdults,
                'no_of_children' => $applyNumChilds,
                'amount' => $getPriceProvider,
                'location_australia' => $location_australia
            ];
        if ($step == 2 || $step == 3) {
            $main_data = [];
            $main_data['apply_id'] = $apply->id;
            $main_data['prefix_name'] = $request->main_title;
            $main_data['first_name'] = $request->main_first_name;
            $main_data['last_name'] = $request->main_last_name;
            $main_data['gender'] = $request->main_gender;
            $main_data['birth_of_date'] = $request->main_date . '/' . $request->main_month . '/' . $request->main_year;
            $main_data['passport'] = $request->main_passport_number;
            $main_data['country'] = $request->main_country;
            $main_data['place_study'] = $request->main_education;
            $main_data['student_id'] = $request->main_student_id;
            $main_data['phone'] = $request->main_phone;
            $main_data['email'] = $request->main_email;
            $main_data['is_locate'] = $request->main_is_locate;
            $main_data['education_agent'] = $request->main_edu_agent;
            $main_data['agent_code'] = $request->main_edu_code;
            $main_data['type'] = 1;
            array_push($data_email['main'], $main_data);
            if ($step == 2) $main = Customer::create($main_data);
            else {
                $main = $apply->customers()->where('type', 1)->first();
                if ($main != null) $main->update($main_data);
                else $main = Customer::create($main_data);
            }
            $arr_data = $request->all();


            if ($apply->no_of_adults > 1) {
                if ($step == 2) {
                    for ($i = 2; $i <= $apply->no_of_adults; $i++) {
                        $adults_data = [];
                        $adults_data['apply_id'] = $apply->id;
                        $adults_data['prefix_name'] = $arr_data[$i . "_title"];
                        $adults_data['first_name'] = $arr_data[$i . "_first_name"];
                        $adults_data['last_name'] = $arr_data[$i . "_last_name"];
                        $adults_data['birth_of_date'] = $arr_data[$i . "_date"] . '/' . $arr_data[$i . "_month"] . '/' . $arr_data[$i . "_year"];
                        $adults_data['gender'] = $arr_data[$i . "_gender"];
                        $adults_data['passport'] = $arr_data[$i . "_pass"];
                        $adults_data['country'] = $arr_data[$i . "_country"];
                        $adults_data['type'] = 2;
                        array_push($data_email['adults'], $adults_data);
                        $adult = Customer::create($adults_data);
                    }
                } else {
                    foreach ($apply->customers()->where('type', 1)->get() as $tmp_adult) {
                        $i = $tmp_adult->id;
                        $adults_data = [];
                        $adults_data['apply_id'] = $apply->id;
                        $adults_data['prefix_name'] = $arr_data[$i . "_title"];
                        $adults_data['first_name'] = $arr_data[$i . "_first_name"];
                        $adults_data['last_name'] = $arr_data[$i . "_last_name"];
                        $adults_data['birth_of_date'] = $arr_data[$i . "_date"] . '/' . $arr_data[$i . "_month"] . '/' . $arr_data[$i . "_year"];
                        $adults_data['gender'] = $arr_data[$i . "_gender"];
                        $adults_data['passport'] = $arr_data[$i . "_pass"];
                        $adults_data['country'] = $arr_data[$i . "_country"];
                        $adults_data['type'] = 2;
                        array_push($data_email['adults'], $adults_data);
                        $tmp_adult->update($adults_data);
                    }
                }
            }
            if ($apply->no_of_children >= 1) {
                if ($step == 2) {
                    for ($i = 1; $i <= $apply->no_of_children; $i++) {
                        $child_data = [];
                        $child_data['apply_id'] = $apply->id;
                        $child_data['prefix_name'] = $arr_data[$i . "_child_title"];
                        $child_data['first_name'] = $arr_data[$i . "_child_first_name"];
                        $child_data['last_name'] = $arr_data[$i . "_child_last_name"];
                        $child_data['birth_of_date'] = $arr_data[$i . "_child_date"] . '/' . $arr_data[$i . "_child_month"] . '/' . $arr_data[$i . "_child_year"];
                        $child_data['gender'] = $arr_data[$i . "_child_gender"];
                        $child_data['passport'] = $arr_data[$i . "_child_pass"];
                        $child_data['country'] = $arr_data[$i . "_child_country"];
                        $child_data['type'] = 3;
                        array_push($data_email['child'], $child_data);
                        $child = Customer::create($child_data);
                    }
                } else {
                    foreach ($apply->customers()->where('type', 2)->get() as $tmp_child) {
                        $i = $tmp_child->id;
                        $child_data = [];
                        $child_data['apply_id'] = $apply->id;
                        $child_data['prefix_name'] = $arr_data[$i . "_child_title"];
                        $child_data['first_name'] = $arr_data[$i . "_child_first_name"];
                        $child_data['last_name'] = $arr_data[$i . "_child_last_name"];
                        $child_data['birth_of_date'] = $arr_data[$i . "_child_date"] . '/' . $arr_data[$i . "_child_month"] . '/' . $arr_data[$i . "_child_year"];
                        $child_data['gender'] = $arr_data[$i . "_child_gender"];
                        $child_data['passport'] = $arr_data[$i . "_child_pass"];
                        $child_data['country'] = $arr_data[$i . "_child_country"];
                        $child_data['type'] = 3;
                        array_push($data_email['child'], $child_data);
                        $tmp_child->update($child_data);
                    }
                }
            }
            $data_email_customer = [
                'name' => ucfirst($request->main_first_name) . ' ' . ucfirst($request->main_last_name),
                'service' => $applyServiceName
            ];
            Mail::to($request->main_email)->later(3, new \App\Mail\ApplyMailCustomer($data_email_customer));
            Mail::to(\Config::get('mail.mail_oshc'))->later(5, new \App\Mail\AppliMail($data_email, $getInvoiceCode));
            set_step(3);
        } else {
            return redirect()->route('apply.register');
        }
        return redirect()->route('payment', ['id' => $apply->id]);
    }
}
