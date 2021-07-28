<?php

namespace App\Imports;

use App\Apply;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FlywireImport implements ToCollection
{
    public function collection(Collection $rows)
    {
            foreach ($rows as $row)
            {
                \App\Admin\Apply::importByPaymentId($row[0], $row[1]);
            }
    }
}
