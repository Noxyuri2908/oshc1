<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImportTypeOfAgent implements ToCollection
{
    public function collection(Collection $rows)
    {
        // TODO: Implement collection() method.
        foreach ($rows as $row)
        {
//            User::importTypeOfAgent($row[0]);
                if (!empty($row))
                {
                    User::updateEmailAgent($row[0], $row[1]);
                }
        }
    }
}
