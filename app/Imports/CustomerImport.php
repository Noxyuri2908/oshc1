<?php

namespace App\Imports;

use App\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomerImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $idApply = DB::table('applies')->insertGetId([
               'ref_no' => $row[0],
               'created_at' => convert_date_to_db($row[1]),
                'agent_id' => DB::table('users')->select('id')->where('id', $row[2])->first()->id ?? '',
                'master_agent' => DB::table('users')->select('id')->where('id', $row[3])->first()->id ?? '',
                'service_country' => array_keys(config('myconfig.service_country'), $row[4]),
                'type_service' => DB::table('dichvus')->select('id')->where('name', $row[5])->first()->id ?? '',
                'type_invoice' => array_keys(config('myconfig.type_invoice'), $row[6]),
                'provider_id' => DB::table('services')->select('id')->where('name', $row[6])->first()->id ?? '',
                'policy' => array_keys(config('myconfig.policy'), $row[7]),
                'no_of_adults' => $row[8],
                'no_of_children' => $row[9],
                'type_visa' => array_keys(config('myconfig.type_visa'), $row[10]),
                'start_date' => convert_date_to_db($row[11]),
                'end_date' => convert_date_to_db($row[12]),
                'net_amount' => convert_number_currency_to_db($row[13]),
                'status' => array_keys(config('myconfig.status_invoice'), $row[14]),
                'note' => $row[15],
                'staff_id' => DB::table('admins')->select('id')->where('admin_id', $row[6])->first()->id ?? '',
                'location_australia' => array_keys(config('location_australia'), $row[32]),
                'promotion_id' => DB::table('promotions')->select('id')->where('code', $row[33])->first()->id ?? '',
                'promotion_amount' => $row[34],
                'bank_fee' => $row[36],
                'bank_fee_number' => $row[37],
                'payment_method' => array_keys(config('myconfig.payment_method'), $row[38]),
                'gst' => $row[39],
                'extra' => $row[40],
                'comm' => $row[41],
                'total' => $row[42]
            ]);

            DB::table('customers')->insert([
                'apply_id' => $idApply,
                'prefix_name' => array_keys(config('myconfig.title'), $row[18]),
                'first_name' => $row[19],
                'last_name' => $row[20],
                'gender' => array_keys(config('myconfig.gender'), $row[21]),
                'birth_of_date' => convert_date_to_db($row[22]),
                'passport' => $row[23],
                'country' => array_keys(config('country.list'), $row[24]),
                'destination' => array_keys(config('country.list'), $row[25]),
                'provider_of_school' => $row[26],
                'email' => $row[27],
                'place_study' => DB::select('schools')->select('id')->where('name', $row[28])->first()->id ?? '',
                'student_id' => $row[29],
                'phone' => $row[30],
                'fb' => $row[31],
                'extend_fee' => $row[35],
                'exchange_rate' => $row[43]
            ]);
        }
    }
}
