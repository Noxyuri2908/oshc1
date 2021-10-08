<?php

namespace App\Imports;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
            try {
                $idApply = DB::table('applies')->insertGetId([
                    'ref_no' => $row[0],
                    'created_at' =>  !empty($row[1]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[1]))->format('d/m/Y')) : null,
                    'agent_id' => DB::table('users')->select('id')->where('name', $row[2])->first()->id ?? '',
                    'master_agent' => DB::table('users')->select('id')->where('name', $row[3])->first()->id ?? '',
                    'service_country' => getKeyConfigByValue(config('myconfig.service_country'), $row[4]),
                    'type_service' => DB::table('dichvus')->select('id')->where('name', $row[5])->first()->id ?? '',
                    'type_invoice' => getKeyConfigByValue(config('myconfig.type_invoice'), $row[6]),
                    'provider_id' => DB::table('services')->select('id')->where('name', $row[7])->first()->id ?? '',
                    'policy' => getKeyConfigByValue(config('myconfig.policy'), $row[8]),
                    'no_of_adults' => $row[9],
                    'no_of_children' => $row[10],
                    'type_visa' => getKeyConfigByValue(config('myconfig.type_visa'), $row[11]),
                    'start_date' => !empty($row[12]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[12]))->format('d/m/Y')) : null,
                    'end_date' => !empty($row[13]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[13]))->format('d/m/Y')) : null,
                    'net_amount' => convert_number_currency_to_db($row[14]),
                    'status' => getKeyConfigByValue(config('myconfig.status_invoice'), $row[15]),
                    'note' => $row[16],
                    'staff_id' => DB::table('admins')->select('id')->where('admin_id', $row[17])->first()->id ?? '',
                    'location_australia' => getKeyConfigByValue(config('location_australia'), $row[32]),
                    'promotion_id' => DB::table('promotions')->select('id')->where('code', $row[33])->first()->id ?? '',
                    'promotion_amount' => $row[34],
                    'bank_fee' => $row[36],
                    'bank_fee_number' => $row[37],
                    'payment_method' => getKeyConfigByValue(config('myconfig.payment_method'), $row[38]),
                    'gst' => $row[39],
                    'extra' => $row[40],
                    'comm' => $row[41],
                    'total' => $row[42],
                    'type_get_data_payment' => 1
                ]);


                DB::table('customers')->insert([
                    'apply_id' => $idApply,
                    'prefix_name' => getKeyConfigByValue(config('myconfig.title'), $row[18]),
                    'first_name' => $row[19],
                    'last_name' => $row[20],
                    'gender' => getKeyConfigByValue(config('myconfig.gender'), $row[21]),
                    'birth_of_date' => !empty($row[22]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[22]))->format('d/m/Y')) : null,
                    'passport' => $row[23],
                    'country' => getKeyConfigByValue(config('country.list'), $row[24]),
                    'destination' => getKeyConfigByValue(config('country.list'), $row[25]),
                    'provider_of_school' => $row[26],
                    'email' => $row[27],
                    'place_study' => DB::table('schools')->select('id')->where('name', $row[28])->first()->id ?? '',
                    'student_id' => $row[29],
                    'phone' => $row[30],
                    'fb' => $row[31],
                    'extend_fee' => 0,
//                    'extend_fee' => $row[35],
                    'exchange_rate' => $row[43] ?? 0,
                ]);

            }catch (\Exception $e)
            {
                // do something
//                echo $e->getMessage() . ' ===== ';
//                echo $e->getLine() . ' ===== ';
//                echo $e->getTrace() . ' ===== ';
                echo count($row);
                return;
            }
        }
        return 'Done!';

    }
}
