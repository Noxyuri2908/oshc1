<?php

namespace App\Imports;

use App\Admin\Apply;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FlywireImportPromotionCode implements ToCollection, WithHeadingRow
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
                    $promotion = DB::table('promotions')->select('id')->where('name', $cl['promotion_code'])->first();
                    if (!empty($promotion->id)){
                        DB::table('applies')->where('ref_no', $cl['payment_id'])->update(['promotion_id' => $promotion->id]);
                    }

                }
            }catch (Exception $er)
            {
                var_dump($er);die;
            }
        }
    }

    function headingRow(){
        return 1;
    }
}
