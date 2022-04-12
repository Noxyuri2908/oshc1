<?php

namespace App\Http\Controllers;

use App\Admin\HospitalAccess;
use App\Admin\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CustomerAPIController extends Controller
{
    //

    function registerCustomer(Request $request){
        try {
            $input = Input::all();
            $applies = $this->processDataApply($input);
            $idApply = DB::table('applies')->insertGetId($applies);

            $customers = $this->processCustomer($input, $idApply);
            DB::table('customers')->insert($customers);
            $customers['created_date'] = convert_date_to_db(date('d-m-Y'));

            $return = array(
                'messenger' => 'Customer created successfully',
                'data' => $customers
            );
            return response()->json($return, 200);

        }catch (\Exception $e)
        {
            $return = array(
                'messenger' => 'Error when create customer',
                'error' => $e->getMessage(),
                'line' => $e->getTraceAsString()
            );
            return response()->json($return, 500);
        }
    }

    public function processDataApply($input)
    {
        $endDate = '';
        if (!empty($input['end_date'])){
            if ($input['end_date'] == 'Monthly'){
                $endDate = Carbon::parse(convert_date_to_db($input['start_date']))->addMonth(1)->subDay(1);
            }elseif ($input['end_date'] == 'Quartely'){
                $endDate = Carbon::parse(convert_date_to_db($input['start_date']))->addMonth(3)->subDay(1);
            }
            elseif ($input['end_date'] == 'Half yearly'){
                $endDate = Carbon::parse(convert_date_to_db($input['start_date']))->addMonth(6)->subDay(1);
            }else{
                $endDate = convert_date_to_db($input['end_date']);
            }
        }
        $applies = array(
            'agent_id' => User::getAgentIdByAgentCode(isset($input['agent_code']) ? $input['agent_code'] : ""),
            'provider_id' => Service::getProviderIDByName($input['provider']),
            'policy' => $input['policy'],
            'start_date' =>  !empty($input['start_date']) ? convert_date_to_db($input['start_date']) : null,
            'end_date' =>  $endDate,
            'no_of_adults' =>  $input['no_of_adults'],
            'no_of_children' =>  $input['no_of_children'],
            'net_amount' =>  $input['price'],
            'ref_no' =>  $input['ref_no'],
        );

        if ($input['type'] == 'oshc')
        {
            $applies['type_visa'] = 1;
            $applies['type_service'] = 2;
            $applies['service_country'] = 'A';
            $applies['note'] =
                'Where is the student studying (instituation)* : ' .$input['witss'] .PHP_EOL .
                'My current or future location in Australia (campus)* : ' .$input['my']. PHP_EOL .
                'Street address : ' .$input['sa']. PHP_EOL .
                'City / Suburb : ' .$input['cs']. PHP_EOL .
                'State : ' .$input['s']. PHP_EOL .
                'Postcode : ' .$input['p']. PHP_EOL;

        }else if ($input['type'] == 'ovhc'){
            $applies['type_service'] = 3;
            $applies['type_visa'] = $input['type_visa'];
            $applies['service_country'] = 'A';
            $applies['note'] =
                'Street address : ' .$input['sa']. ' \r\n   ' .
                'City / Suburb : ' .$input['cs']. PHP_EOL .
                'State : ' .$input['s']. PHP_EOL .
                'Postcode : ' .$input['p']. PHP_EOL;

        }else if ($input['type'] == 'usa_si'){
            $applies['type_service'] = 4;
            $applies['service_country'] = 'U';
            $applies['note'] =
                'Student/Scholar Status : ' .$input['sss']. PHP_EOL .
                'Name of school or organization : ' .$input['nosoo']. PHP_EOL .
                'Beneficiary : ' .$input['b']. PHP_EOL;

        }else if ($input['type'] == 'usa_vi'){
            $applies['type_service'] = 6;
            $applies['service_country'] = 'U';
            $applies['note'] =
                'Coverage area : ' .$input['ca']. PHP_EOL .
                'Overall maximum coverage : ' .$input['omc']. PHP_EOL .
                'Deductible choices : ' .$input['dc']. PHP_EOL .
                'Beneficiary : ' .$input['b']. PHP_EOL;

        }else if ($input['type'] == 'nz_si' || $input['type'] == 'nz_vi'){
            $applies['service_country'] = 'N';
            $applies['type_service'] = 4;
            $applies['type_invoice'] = 1;
            $applies['status'] = 8;
        }

        // param default
        $applies['type_get_data_payment'] = 1;
        $applies['type_invoice'] = 1;
        $applies['status'] = 8;
        $applies['hospital_id'] = !empty($input['hospital_access']) ? HospitalAccess::getIdByName($input['hospital_access']) : '';
        $applies['created_at'] = convert_date_to_db(date('d-m-Y'));

        return $applies;
    }

    public function processCustomer($input, $idApply)
    {
        $customers = array(

            'apply_id' => $idApply,
            'prefix_name' => $input['title'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'birth_of_date' => !empty($input['birth_of_date']) ? convert_date_to_db($input['birth_of_date']) : null,
            'passport' => $input['passport'],
            'country' => $input['country'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'student_id' => $input['student_id'],
            's_live_in_AS' =>  !empty($input['s_live_in_AS']) ? getKeyConfigByValue(config('myconfig.live_in_AS'), $input['s_live_in_AS']) : ''
    );
        $customers['destination'] = 'AU';
        if ($input['type'] == 'ovhc' || $input['type'] == 'si' || $input['type'] == 'vi' || $input['type'] == 'nz_si' || $input['type'] == 'nz_vi'){
            $cover_id = DB::table('covers')->select('id')->where('cover', $input['cover'])->first();
            $customers['cover_id'] = !empty($cover_id) ? $cover_id->id : '';
        }
        return $customers;
    }
}
