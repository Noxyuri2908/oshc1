<?php

namespace App\Exports;

use App\Admin\Follow;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class AppointmentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents,WithTitle
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
        $startDateGoogle = (!empty($request->report_start_date)) ? Carbon::parse(convert_date_to_db($request->report_start_date))->toIso8601String() : Carbon::parse(date('Y-m-01'))->toIso8601String();
        $endDateGoogle = (!empty($request->report_end_date)) ? Carbon::parse(convert_date_to_db($request->report_end_date))->toIso8601String() : Carbon::parse(date('Y-m-d'))->toIso8601String();
        $calendarService = new \Google_Service_Calendar($this->client);
        $optParams = [
            // 'maxResults' => 10,
            'singleEvents' => true,
            'orderBy' => 'startTime',
            'pageToken' => $request->get('nextToken'),
            "timeMin" => $startDateGoogle,
            "timeMax" => $endDateGoogle,
            'q' => $request->get('q_filter'),
        ];
        $events = $calendarService->events->listEvents('primary', $optParams);
        foreach ($events as $item) {
            if (!empty($item->attendees)) {
                foreach ($item->attendees as $attendees) {
                    $valueAttendees = $attendees->email . ',';
                }
            }
            $startDateGoogleExport = (!empty($item->start)) ? Carbon::parse($item->start->dateTime)->setTimezone('UTC') : '';
            $endDateGoogleExport = (!empty($item->end)) ? Carbon::parse($item->end->dateTime)->setTimezone('UTC') : '';
            $taskSale[] = [
                '0' => (!empty($item->extendedProperties) && !empty($item->extendedProperties->private) && !empty($item->extendedProperties->private['agent_id'])) ? getAgentName($item->extendedProperties->private['agent_id']) : '',
                '1' => $startDateGoogleExport . ' ' . $endDateGoogleExport,
                '2' => getColorGoogle($item->colorId),
                '3' => $item->location,
                '4' => $valueAttendees,
                '5' => $item->description,
            ];
        }
        $taskSale[] = $emptyArr;
        $taskSale[] = $emptyArr;
        return (collect($taskSale));
    }
    public function title(): string
    {
        return 'APPOINTMENT & VISIT AGENT';
    }
    public function headings(): array
    {
        return [
            'User',
            'Time',
            'Partner',
            'Location',
            'Attendees',
            'Note'
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
