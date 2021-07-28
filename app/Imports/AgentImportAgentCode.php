<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class AgentImportAgentCode implements ToCollection
{
    public function collection(Collection $rows)
    {
        // TODO: Implement collection() method.
        foreach ($rows as $row)
        {
            User::importAgentCode($row[0], $row[2]);
        }
    }
}
