<?php

namespace App\Imports;

use App\Admin\Phieuthu;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportReceipt implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $item)
        {
            if ($item['invoice_no'] != null)
            {
                Phieuthu::importReceipt($item);
            }
            return;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
