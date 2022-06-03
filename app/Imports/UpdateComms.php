<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class UpdateComms implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row)
        {
            if (empty($row[0]))
            {
                return 'Done!';
            }

            $apply_id = DB::table('applies')->select('id')->where('ref_no', $row[0])->first()->id ?? '';
            DB::table('hoahongs')
                ->where('apply_id', $apply_id)
                ->update([
                        'visa_status' => getKeyConfigByValue(config('myconfig.status_visa'), $row[1])
                    ]);
        }
    }
}
