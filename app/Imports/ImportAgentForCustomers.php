<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportAgentForCustomers implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row){
            if (empty($row[1]))
            {
                return 'Done!';
            }

            $agent = DB::table('users')->where('name', $row[1])->first()->id ?? '';
            if (empty($agent)){
                echo $row[1];
                die();
            }
            DB::table('applies')
                ->where('ref_no', $row[0])
                ->update(
                    ['agent_id' => $agent]
                );

        }

    }
}
