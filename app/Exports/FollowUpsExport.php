<?php

namespace App\Exports;

use App\Admin\Follow;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class FollowUpsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use RegistersEventListeners;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $follow = [];
        $emptyArr = [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ];
        $request = $this->request;
        $follows = Follow::getDataExportExcel($request);
        foreach ($follows as $item) {
            $follow[] = array(
                '0' => $item->getAgentName(),
                '1' => getColorByDate(Carbon::parse($item->process_date)->dayOfWeek) . ' ' . convert_date_form_db($item->process_date),
                '2' => $item->getStatus(),
                '3' => $item->rating,
                '4' => $item->getContact(),
                '5' => $item->getPersonName(),
                '6' => $item->getPotentialService(),
                '7' => $item->des
            );
        }

        return (collect($follow));
    }

    public function headings(): array
    {
        return [
            'User',
            'Processing date',
            'Status',
            'Rating',
            'Contact by',
            'Person in charge',
            'Potential Service',
            'Description'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function (BeforeExport $event) {
                // Macro
                $event->writer->setCreator('Patrick');

                // Or via magic __call
                $event->writer
                    ->getProperties()
                    ->setCreator('Patrick');
            },
            AfterSheet::class => function (AfterSheet $event) {
                // Macro
                $event->sheet
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $styleArray = array(
                    'font' => array(
                        'bold' => true,
//                        'color' => array('rgb' => 'FF0000'),
                        'size' => 15,
                        'name' => 'Verdana'
                    ));

//                $event->sheet->styleCells('A1:G1',$styleArray);
            },
        ];
    }
}
