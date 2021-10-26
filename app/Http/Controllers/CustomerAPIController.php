<?php

namespace App\Http\Controllers;

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

    function registerCustomer(){
        try {
            $input = Input::all();

            $applies = array(
                'agent_id' => User::getAgentIdByAgentCode($input['agent_code']),
                'provider_id' => Service::getProviderIDByName($input['provider']),
                'policy' => $input['policy'],
                'start_date' =>  !empty($input['start_date']) ? convert_date_to_db($input['start_date']) : null,
                'end_date' =>  !empty($input['end_date']) ? convert_date_to_db($input['end_date']) : null,
                'no_of_adults' =>  $input['no_of_adults'],
                'no_of_children' =>  $input['no_of_children'],
                'net_amount' =>  (int) $input['price'],
                'ref_no' =>  $input['ref_no'],
            );

            $applies['note'] = 'Where is the student studying (instituation)* : ' .$input['witss']. '<br>' .
                ' My current or future location in Australia (campus)* : ' .$input['my']. '<br>' .
                'Street address : ' .$input['sa']. '<br>' .
                'City / Suburb : ' .$input['cs']. '<br>' .
                'State : ' .$input['s']. '<br>' .
                'Postcode : ' .$input['p']. '<br>';

            // param default
            $applies['service_country'] = 'AU';
            $applies['type_service'] = 2;
            $applies['type_invoice'] = 1;
            $applies['type_visa'] = 1;
            $applies['status'] = 8;
            $applies['type_get_data_payment'] = 1;

            $idApply = DB::table('applies')->insertGetId($applies);

            $customers = array(
                'apply_id' => $idApply,
                'prefix_name' => $input['title'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'gender' => $input['gender'],
                'birth_of_date' => !empty($input['birth_of_date']) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject((int) $input['birth_of_date']))->format('d/m/Y')) : null,
                'passport' => $input['passport'],
                'country' => $input['country'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'student_id' => $input['student_id'],
            );
            $customers['destination'] = 'AU';
            DB::table('customers')->insert($customers);

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
}
