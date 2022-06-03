<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FlywireImportAgent implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $cl) {
            try {
                if (!empty($cl['payment_id'])) {
                    $agent = DB::table('users')->select('id')->where('name', $cl['agent'])->first();
                    if (!empty($agent->id)) {
                        DB::table('applies')->where('ref_no', $cl['payment_id'])->update(['agent_id' => $agent->id]);
                    }

                }
            } catch (Exception $er) {
                var_dump($er);
                die;
            }
        }
    }

    function headingRow()
    {
        return 1;
    }
}
