<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UsersExport implements WithHeadings, FromCollection, WithMapping, WithStyles
{
    use Exportable;
    public $request;

    public function request($request)
    {
        $this->request = $request;
        return $this;
    }

    public function collection()
    {
        return User::queryExportAgent($this->request);
    }

//    public function query()
//    {
//        return User::queryExportAgent($this->request);
//    }

    public function headings(): array
    {
        return [
            'Name',
            'Agent Code',
            'Type Of Agent',
            'Status',
            'Market',
            'Email',
            'Rating',
            'Potential service',
            'Tel 1',
            'Tel 2',
            'Website',
            'Country',
            'City',
            'Office',
            'Department',
            'Person in charge',
            'Registered date',
            'Date of input',
            'Note 1',
            'Note 2'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true]],
            'B1' => ['font' => ['bold' => true]],
            'C1' => ['font' => ['bold' => true]],
            'D1' => ['font' => ['bold' => true]],
            'E1' => ['font' => ['bold' => true]],
            'F1' => ['font' => ['bold' => true]],
            'G1' => ['font' => ['bold' => true]],
            'H1' => ['font' => ['bold' => true]],
            'I1' => ['font' => ['bold' => true]],
            'J1' => ['font' => ['bold' => true]],
            'K1' => ['font' => ['bold' => true]],
            'L1' => ['font' => ['bold' => true]],
            'M1' => ['font' => ['bold' => true]],
            'N1' => ['font' => ['bold' => true]],
            'O1' => ['font' => ['bold' => true]],
            'P1' => ['font' => ['bold' => true]],
            'Q1' => ['font' => ['bold' => true]],
            'R1' => ['font' => ['bold' => true]],
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->agent_code,
            UsersExport::mappingTypeAgent($user->type_id),
            UsersExport::mappingStatus($user->status),
            UsersExport::mappingMarketId($user->market_id),
            $user->email,
            $user->rating,
            UsersExport::mappingPotentialService($user->potential_service),
            $user->tel_1,
            $user->tel_2,
            $user->website,
            UsersExport::mappingCountry($user->country),
            $user->city,
            $user->office,
            UsersExport::mappingDepartment($user->department),
            $user->admin_id,
            $user->registered_date,
            date_format(date_create($user->created_at),"Y/m/d H:i:s"),
            $user->note1,
            $user->note2
        ];
    }


    public static function mappingStatus($numberST)
    {
        $value = '';
        $userStatus = config('admin.status');
        if (!empty($numberST))
        {
            $value = array_get($userStatus, $numberST);
        }
        return $value;
    }

    public static function mappingDepartment($numberDM)
    {
        $userDM = config('myconfig.department');
        $value = array_get($userDM, $numberDM);
        return $value;
    }

    public static function mappingTypeAgent($type_id)
    {
        $value = '';
        $type_agent = config('admin.type_agent');
        if ($type_id)
        {
            $value = array_get($type_agent, $type_id);
        }
        return $value;
    }

    public static function mappingCountry($country)
    {
        $value = '';
        $type_agent = config('country.list');
        if ($country)
        {
            $value = array_get($type_agent, $country);
        }
        return $value;
    }

    public static function mappingMarketId($numberMK)
    {
        $data_market = '';
        $market = array();
        $userMK = config('myconfig.market');

        if (!is_null($numberMK))
        {
            if (UsersExport::isJSON($numberMK))
            {
                $market_id = json_decode($numberMK);
                if (!is_null($market_id))
                {
                    foreach ($market_id as $tmp)
                    {
                        array_push($market, array_get($userMK, $tmp));
                    }
                    $data_market = join(', ', $market);

                    return $data_market;
                }
            }else{
                if (!is_null($numberMK))
                {
                    foreach ($numberMK as $tmp)
                    {
                        array_push($market, array_get($userMK, (int)$tmp));
                    }
                    $data_market = join(', ', $market);

                    return $data_market;
                }
            }
        }

        return null;
    }

    public static function mappingDate($date)
    {
        $date = new DateTime($date);
        $result = $date->format('Y-m-d H:i:s');

        if ($result) {
            return $result;
        }
    }

    public static function mappingPotentialService($service_id)
    {
        $data_sv = '';
        $potential_service = array();
        $sv = config('myconfig.potential_service');
        if (!is_null($service_id))
        {
            foreach ($service_id as $tmp)
            {
                array_push($potential_service, array_get($sv, $tmp));
            }
            $data_sv = join(', ', $potential_service);

            return $data_sv;
        }
        return null;
    }

    public static function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

}
