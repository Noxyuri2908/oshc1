<?php

namespace App\Exports;

use App\Apply;
use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplyExport implements WithHeadings, FromCollection, WithMapping, WithStyles
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
        return \App\Admin\Apply::getFlywireList($this->request, 0);
    }

    public function headings(): array
    {
        return [
            'Payment ID',
            'Agent Name',
            'School Name',
            'Full name',
            'Amount',
            'Email',
            'status',
            'Delivered date',
            'Initiated date',
            'Payment Type'
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

    public function map($items): array
    {
        return [
            $items->ref_no,
            User::getAgentName($items->agent_id),
            ApplyExport::getSchoolFlywire($items->registerCus()),
            $items->getFullNameCus(),
            convert_price_float($items->amount_to).' '.getCurrency($items->amount_to_unit),
            $items->getEmailCus(),
            ApplyExport::mappingStatus($items->status),
            convert_date_form_db($items->delivered_date),
            convert_date_form_db($items->initiated_date),
            ApplyExport::mappingPaymentType($items->payment_type)
        ];
    }

    public static function mappingStatus($status_id)
    {
        $value = '';
        $type_agent = config('myconfig.flywire_status');
        if ($status_id)
        {
            $value = array_get($type_agent, $status_id);
        }
        return $value;
    }

    public static function mappingPaymentType($type_id)
    {
        $value = '';
        $type_agent = config('myconfig.payment_type');
        if ($type_id)
        {
            $value = array_get($type_agent, $type_id);
        }
        return $value;
    }

    public static function getSchoolFlywire($school_id){
        $schools = getSchoolFlywire();

        return !empty($school_id) && !empty($schools[$school_id->place_study]) ? $schools[$school_id->place_study]:'';
    }
}
