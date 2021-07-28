<?php

namespace App\Exports;

use App\Person;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PersonExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;
    public $request;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return \App\Admin\Person::personExport($this->request);
    }

    public function request($request)
    {
        $this->request = $request;
        return $this;
    }

    public function headings(): array
    {
        return [
            'Branch',
            'Agent Name',
            'Country',
            'Status',
            'Type of agent',
            'Name',
            'Email',
            'Position',
            'PC',
            'Receive commission'
        ];
    }

    public function map($person): array
    {
        $countries = config('country.list');
        $status = config('admin.status');
        $typeAgent = config('admin.type_agent');
        return [
            getDepartmentById(!empty($person->department) ? $person->department : ''),
            !empty($person->name) ? $person->agent_name :'',
            ($person->country) ? $countries[$person->country] : '',
            getValueByIndexConfig($status, $person->status),
            getValueByIndexConfig($typeAgent, $person->type_id),
            $person->name,
            $person->email,
            $person->position,
            getStaffNameById(!empty($person->staff_id) ? $person->staff_id : ''),
            ($person->is_receive_comm == 'on') ? 'true' : 'false'
        ];
    }

}
