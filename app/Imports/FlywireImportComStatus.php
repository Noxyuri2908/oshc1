<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FlywireImportComStatus implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $cl)
        {
            try {
                if (!empty($cl['payment_id']))
                {
                    $id = DB::table('applies')->select('id')->where('ref_no', $cl['payment_id'])->first();
                    $conditions = [
                        'apply_id' => $id->id
                    ];

                    $value = [
                        'com_status_cp' => getKeyConfigByValue(config('myconfig.com_status'), $cl['com_status']),
                        'paid_com_date_agent_cp' => !empty($cl['paid_com_date_agent']) ? convert_date_to_db(Carbon::parse(Date::excelToDateTimeObject($cl['paid_com_date_agent']))->format('d/m/Y')) : null
                    ];

                    DB::table('profits')->updateOrInsert($conditions, $value);
                }
            }catch (\Exception $er)
            {
                var_dump($cl['payment_id']);die;
                var_dump($er);die;
            }
        }
    }

    public function headingRow(){
        return 1;
    }


}
