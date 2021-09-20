<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProfitImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        try {
            foreach ($rows as $row)
            {

                DB::table('profits')->insert([
                    'apply_id' => DB::table('applies')->select('id')->where('ref_no', $row[0])->first()->id ?? '',
                    'profit_money' => convert_number_currency_to_db($row[16]),
                    'profit_extra_money' => convert_number_currency_to_db($row[17]),
                    'profit_total' => convert_number_currency_to_db($row[18]),
                    'profit_exchange_rate' => convert_number_currency_to_db($row[19]),
                    'profit_money_VND' => convert_number_currency_to_db($row[20]),
                    'profit_bankfee_VND' => convert_number_currency_to_db($row[21]),
                    'gst' => convert_number_currency_to_db($row[22]),
                    'profit_status' => ( $row[22] == "Done" ) ? 1 : ( $row[22] == "Refund"  ? 2 : ''),
                    'comm_status' => ( $row[23] == "Done" ) ? 1 : ( $row[23] == "Refund"  ? 2 : '') ,
                    'pay_agent_bonus' => $row[35],
                    'pay_agent_deduction' => convert_number_currency_to_db($row[37]),
                    'pay_agent_total_amount' => convert_number_currency_to_db($row[38]),
                    'pay_agent_exchange_rate' => convert_number_currency_to_db($row[39]),
                    'vnd' => convert_number_currency_to_db($row[40]),
                    'pay_agent_amount_VN' => convert_number_currency_to_db($row[41]),
                    'pay_agent_date' => !empty($row[42]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[42]))->format('d/m/Y')) : null,
                    'gst_status_agent_profit' => ($row[43] == 'Included') ? 1 : ($row[43] == 'Not included' ? 2 : ''),
                    'issue_date_com_agent' => !empty($row[44]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[44]))->format('d/m/Y')) : null,
                    'note_cp' => $row[45],
                    're_total_amount' => convert_number_currency_to_db($row[47]),
                    'exchange_rate_re_provider' => convert_number_currency_to_db($row[48]),
                    're_total_amount_vn' => convert_number_currency_to_db($row[49]),
                    'date_of_receipt' => !empty($row[50]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[50]))->format('d/m/Y')) : null,
                    'note_of_receipt' => $row[51],
                    'pay_provider_paid' => convert_number_currency_to_db($row[52]),
                    'pay_provider_amount' => convert_number_currency_to_db($row[53]),
                    'pay_provider_bank_fee' => getKeyConfigByValue(config('myconfig.bank_fee'), $row[55]),
                    'pay_provider_total_amount' => convert_number_currency_to_db($row[56]),
                    'pay_provider_exchange_rate' => convert_number_currency_to_db($row[57]),
                    'pay_provider_total_VN' => convert_number_currency_to_db($row[57]),
                    'pay_provider_date' => !empty($row[60]) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($row[60]))->format('d/m/Y')) : null,
                    'pay_provider_bank_account' => DB::table('banks')->select('id')->where('account', $row[61])->first()->id ?? '',
                ]);
            }
        }catch (\Exception $e)
        {
            // do something
            echo $e->getMessage() . ' ===== ';
            echo $e->getLine() . ' ===== ';
            echo $e->getTrace() . ' ===== ';
            return;
        }
    }
}
