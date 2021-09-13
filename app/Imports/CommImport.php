<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CommImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row)
        {
            try {
                DB::table('hoahongs')->insert([
                    'apply_id' => DB::table('applies')->select('id')->where('ref_no', $row[0])->first()->id ?? '',
                    'visa_status' => getKeyConfigByValue(config('myconfig.status_visa'), $row[14]),
                    'hoahong_month' => $row[15],
                    'hoahong_year' => $row[16],
                    'date_payment_provider' => !empty($row[17]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[17]))->format('d/m/Y')) : null,
                    'account_bank' => DB::table('banks')->select('id')->where('account', $row[18])->first()->id ?? '',
                    'date_payment_agent' => !empty($row[19]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[19]))->format('d/m/Y')) : null,
                    'policy_no' => $row[20],
                    'issue_date' => !empty($row[22]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[22]))->format('d/m/Y')) : null,
                    'policy_status' => getKeyConfigByValue(config('myconfig.policy_status'), $row[23]),
                    'payment_note_provider' => getKeyConfigByValue(config('myconfig.payment_note_provider'), $row[24]),
                    'note' => $row[26],
                    'admin_create' => DB::table('admins')->select('id')->where('admin_id', $row[27])->first()->id ?? '',
                    'created_at' => !empty($row[28]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[28]))->format('d/m/Y')) : null
                ]);
            }catch(\Exception $e)
            {
                echo $e->getMessage() . ' ===== ';
                echo $e->getLine() . ' ===== ';
                echo $e->getTrace() . ' ===== ';
                return;
            }
        }

        return 'Done!';
    }
}
