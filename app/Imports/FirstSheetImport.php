<?php

namespace App\Imports;

use App\Admin\Price;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FirstSheetImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $cl)
        {
            Price::where('service_id', '8')
                ->where('type', '1')
                ->where('num_month', $cl[0])
                ->update(['price' => $cl[1]]);
        }
    }
}
