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
            $user_id = DB::table('users')->select('id')->where('name', $row[0])->first()->id ?? '';
            DB::table('commissions')
                ->where('user_id', $user_id)
                ->update([
                        'visa_status' => getKeyConfigByValue(config('myconfig.status_visa'), $row[1])
                    ]);
        }
    }
}
