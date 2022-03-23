<?php

namespace App\Imports;

use App\Admin\Apply;
use App\Admin\Customer;
use App\Admin\Promotion;
use Dompdf\Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportInvoice implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        try {
            foreach ($collection as $item)
            {
                if ($item['ref_no'] != null)
                {
                    $promotion_id = Promotion::getPromotionId($item['promotion_code']);
                    $id = Apply::importDataByExcelFile($item, $promotion_id);
                    Customer::importDataByExcelFile($item, $id);
                }
            }
        }catch(\Exception $e)
        {
            echo $e->getMessage();die;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
