<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class UpdateStatusCus implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            if (empty($row[0]))
            {
                return 'Done!';
            }

            DB::table('applies')
                ->where('ref_no', $row[0])
                ->update([
                    'status' => getKeyConfigByValue(config('myconfig.status_invoice'), $row[1])
                ]);
        }
    }
}
