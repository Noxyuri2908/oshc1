<?php

namespace App\Exports;

use App\Admin;
use App\Admin\Apply;
use App\Admin\CompetitionFeedback;
use App\Admin\Dichvu;
use App\Admin\Follow;
use App\Admin\MarketFeedback;
use App\Admin\Proposal;
use App\Admin\SaleTaskAssign;
use App\Admin\Trainings;
use App\Components\GoogleClient;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use App\User;
use DateInterval;
use DatePeriod;

class TaskSaleCollectionExport implements FromCollection, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use RegistersEventListeners;

    protected $client;
    protected $sheet;

    public function __construct($request, $client)
    {

        $this->request = $request;
        $token = \Session::get('google_token');
        if (!empty($token)) {
            $this->client = $client->getClient($token);
        }else{
            $credentialsPath = config('google-api.token_path');
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
            $this->client = $client->getClient($accessToken);
            \Session::put('google_token',$accessToken);
        }

    }

    public function collection()
    {
        $taskSale = [];
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
        $startDate = (!empty($request->report_start_date)) ? convert_date_to_db($request->report_start_date) : date('Y-01-01');
        $endDate = (!empty($request->report_end_date)) ? convert_date_to_db($request->report_end_date) . ' 23:59:59' : date('Y-m-d 23:59:59');
        if (!empty($request->get('filter_date_option'))) {
            if ($request->get('filter_date_option') == 'week') {
                $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'month') {
                $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            } elseif ($request->get('filter_date_option') == 'year') {
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            }
            $endDate = date('Y-m-d 23:59:59');
        }
        $arrChecked = $request->get('arrChecked');
        $arrChecked = explode(",", $arrChecked);
        $dichvu = \App\Admin\Dichvu::get();
        foreach ($arrChecked as $tableExport) {
            switch ($tableExport) {
                case "follow-up":
                    $taskSale[]=[
                        'FOLLOW UP AGENT '
                    ];
                    $taskSale[] = [
                        'User',
                        'Processing date',
                        'Status',
                        'Rating',
                        'Contact by',
                        'Person in charge',
                        'Potential Service',
                        'Description'
                    ];
                    $admins = Admin::pluck('admin_id', 'id');
                    $follows = Follow::getDataExportExcel($request);
                    foreach ($follows as $item) {
                        $taskSale[] = array(
                            '0' => $item->getAgentName(),
                            '1' => getColorByDate(Carbon::parse($item->process_date)->dayOfWeek) . ' ' . convert_date_form_db($item->process_date),
                            '2' => $item->getStatus(),
                            '3' => !empty($item->agent)?$item->agent->rating:'',
                            '4' => $item->getContact(),
                            '5' => !empty($admins[$item->person_in_charge])?$admins[$item->person_in_charge]:'',
                            '6' => $item->getPotentialService($dichvu),
                            '7' => $item->des
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "appointment":
                    $taskSale[]=[
                        'APPOINTMENT & VISIT AGENT 	'
                    ];
                    $taskSale[] = [
                        'User',
                        'Time',
                        'Partner',
                        'Location',
                        'Attendees',
                        'Note'
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
                            '4' => !empty($valueAttendees)?$valueAttendees:'',
                            '5' => $item->description,
                        ];
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "market-feedback":
                    $taskSale[]= [
                        'MARKET FEEDBACK '
                    ];
                    $taskSale[] = [
                        'User',
                        'Processing date',
                        'Issue',
                        'Person in charge',
                        'Market Feedback'
                    ];
                    $marketFeedbacks = MarketFeedback::getMarketFeedbackSale($request)->get();
                    foreach ($marketFeedbacks as $item) {
                        $taskSale[] = array(
                            '0' => $item->getAgentName(),
                            '1' => convert_date_form_db($item->processing_date),
                            '2' => $item->getIssue(),
                            '3' => $item->getPersonName(),
                            '4' => $item->market_feedback,
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "competitor-feedback":
                    $taskSale[]= [
                        'COMPETITOR FEEDBACK'
                    ];
                    $taskSale[] = [
                        'User',
                        'Processing date',
                        'Issue',
                        'Competitor Feedback'
                    ];
                    $competitionFeedbacks = CompetitionFeedback::getTaskSale($request)->get();
                    foreach ($competitionFeedbacks as $item) {
                        $taskSale[] = array(
                            '0' => $item->getAgentName(),
                            '1' => convert_date_form_db($item->processing_date),
                            '2' => $item->getIssue(),
                            '3' => $item->competition_feedback,
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "tasks-asigned":
                    $taskSale[]= [
                        ' TASKS ASIGNED		'
                    ];
                    $taskSale[] = [
                        'Processing date',
                        'Item',
                        'Type',
                        'Asigned by',
                        'Deadline',
                        'Note'
                    ];

                    $saleTaskAssigns = SaleTaskAssign::getSaleTaskExport($request)->get();
                    foreach ($saleTaskAssigns as $one) {
                        $taskSale[] = array(
                            '0' => \Carbon::parse($one->processing_date)->format('d/m/Y'),
                            '1' => $one->item,
                            '2' => $one->getType(),
                            '3' => $one->getPersonName(),
                            '4' => \Carbon::parse($one->deadline)->format('d/m/Y'),
                            '5' => $one->note
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "training":
                    $taskSale[]= [
                        'TRAINING 	'
                    ];
                    $taskSale[] = [
                        'Processing date',
                        'Item',
                        'Type',
                        'Deadline',
                        'Result',
                        'Note'
                    ];

                    $trainings = Trainings::getSaleTaskExport($request)->get();
                    foreach ($trainings as $one) {
                        $taskSale[] = array(
                            '0' => \Carbon::parse($one->processing_date)->format('d/m/Y'),
                            '1' => $one->item,
                            '2' => $one->getType(),
                            '3' => \Carbon::parse($one->deadline)->format('d/m/Y'),
                            '4' => $one->getResult(),
                            '5' => $one->note
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "proposal":
                    $taskSale[]= [
                        'PROPOSAL 	'
                    ];
                    $taskSale[] = [
                        'User',
                        'Processing date',
                        'Issue',
                        'Person in charge',
                        'Proposal Feedback',
                    ];

                    $proposals = Proposal::getSaleTaskExport($request)->get();
                    foreach ($proposals as $item) {
                        $taskSale[] = array(
                            '0' => $item->getAgentName(),
                            '1' => convert_date_form_db($item->processing_date),
                            '2' => $item->getIssue(),
                            '3' => $item->getPersonName(),
                            '4' => $item->proposal,
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "agent-report":
                    $taskSale[]= [
                        'AGENT REPORT '
                    ];
                    $taskSale[] = [
                        'Processing date',
                        'Have signed contract',
                        'New agent- 1st case done',
                        'New Agents have been found',
                        'Note- New User',
                    ];
                    $cooperating = 4;
                    $signedContract = 3;
                    $pendingStatus = 6;
                    $remindStatusExtend = 2;
                    $remindStatusPending = 1;
                    $typeFromOshcOvhc = 1;
                    $typeFromFlywire = 3;
                    $getIdOshcOvhc = Dichvu::where('type_form',$typeFromOshcOvhc)->pluck('id','name');
                    $getIdFlywire = Dichvu::where('type_form',$typeFromFlywire)->pluck('id','name');
                    //table1
                    $getUserSignedContractByDate = User::whereBetween('created_at', [$startDate, $endDate])
                        ->where('status', $signedContract)
                        ->get([
                            'id',
                            'name',
                            'created_at'
                        ])
                        ->groupBy(function ($query) {
                            return Carbon::parse($query->created_at)->format('Y-m-d');
                        });
                    $getUserHasCaseByDate = User::whereBetween('first_case_date', [$startDate, $endDate])
                        ->whereNotNull('had_case')
                        ->get([
                            'id',
                            'name',
                            'created_at'
                        ])
                        ->groupBy(function ($query) {
                            return Carbon::parse($query->first_case_date)->format('Y-m-d');
                        });
                    $getUserCooperatingByDate = User::with('info')->whereBetween('created_at', [$startDate, $endDate])
                        ->where('status', $cooperating)
                        ->get([
                            'id',
                            'name',
                            'created_at'
                        ])
                        ->groupBy(function ($query) {
                            return Carbon::parse($query->created_at)->format('Y-m-d');
                        });
                    $interval = new DateInterval('P1D');
                    $periods = new DatePeriod(Carbon::parse($startDate), $interval,
                        Carbon::parse($endDate));

                    $graphGetCustomerDay = array_map(function ($periods) use ($getUserSignedContractByDate, $getUserHasCaseByDate,$getUserCooperatingByDate) {
                        $day = $periods->format('Y-m-d');
                        if ($getUserSignedContractByDate->has($day) || $getUserHasCaseByDate->has($day) || $getUserCooperatingByDate->has($day)) {
                            return [
                                'date' => $periods->format('d/m/Y'),
                                'new_contract' => $getUserSignedContractByDate->has($day) ? $getUserSignedContractByDate->get($day)->pluck('name')->join(',') : '',
                                'first_case' => $getUserHasCaseByDate->has($day) ? $getUserHasCaseByDate->get($day)->pluck('name')->join(',') : '',
                                'new_agent'=>$getUserCooperatingByDate->has($day)?$getUserCooperatingByDate->get($day)->pluck('name')->join(','):'',
                                'note_new_agent'=>$getUserCooperatingByDate->has($day)?$getUserCooperatingByDate->get($day)->pluck('note','name'):''
                            ];

                        }
                    }, iterator_to_array($periods));
                    $getAgentReport = array_filter($graphGetCustomerDay);
                    $noteAgentReport = '';
                    foreach ($getAgentReport as $report) {
                        if(!empty($report['note_new_agent'])){
                            foreach($report['note_new_agent'] as $user=>$note){
                               $noteAgentReport .= $user.':'.$note;
                            }
                        }
                        $taskSale[] = array(
                            '0' => $report['date'],
                            '1' => $report['new_contract'],
                            '2' => $report['first_case'],
                            '3' => $report['new_agent'],
                            '4' => $noteAgentReport,
                        );
                        $noteAgentReport = '';
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                case "invoice-report":
                    $taskSale[]= [
                        'PENDING INVOICE/ CERTIFICATE/ /EXTEND FOLLOW UP'
                    ];
                    $taskSale[] = [
                        'Service',
                        'Pending invoice ',
                        'CERTIFICATE/CASE',
                        'EXTEND REMIND',
                        'Extend successfully',
                    ];
                    $cooperating = 4;
                    $signedContract = 3;
                    $pendingStatus = 6;
                    $remindStatusExtend = 2;
                    $remindStatusPending = 1;
                    $typeFromOshcOvhc = 1;
                    $typeFromFlywire = 3;
                    $getIdOshcOvhc = Dichvu::where('type_form',$typeFromOshcOvhc)->pluck('id','name');
                    $getIdFlywire = Dichvu::where('type_form',$typeFromFlywire)->pluck('id','name');
                    $getTaskPending = Apply::where('status',$pendingStatus)
                        ->whereIn('type_service',$getIdOshcOvhc)
                        ->get()
                        ->groupBy('type_service')->map(function($pending){
                            return $pending->count();
                        });
                    $getComAu = Apply::with(['hoahongs'])
                        ->whereHas('hoahongs',function($query) use ($startDate,$endDate){
                            $query->whereBetween('issue_date',[$startDate,$endDate]);
                        })
                        ->whereIn('type_service',$getIdOshcOvhc)
                        ->where('service_country','A')
                        ->get()
                        ->groupBy('type_service')->map(function($pending){
                            return $pending->count();
                        });
                    $getRemindExtendPendingAu = Apply::where('service_country','A')
                        ->whereBetween('processing_date_remind',[$startDate,$endDate])
                        ->whereIn('type_service',$getIdOshcOvhc)
                        ->where('remind_status',$remindStatusPending)
                        ->get()
                        ->groupBy('type_service')->map(function($pending){
                            return $pending->count();
                        });
                    $getRemindExtendAu = Apply::where('service_country','A')
                        ->whereBetween('processing_date_remind',[$startDate,$endDate])
                        ->where('remind_status',$remindStatusExtend)
                        ->whereIn('type_service',$getIdOshcOvhc)
                        ->get()
                        ->groupBy('type_service')->map(function($pending){
                            return $pending->count();
                        });
                    $getDataOshcOvhcHcc =  array_map(function($service) use ($getTaskPending,$getComAu,$getRemindExtendPendingAu,$getRemindExtendAu){
                        return [
                            'pendingInvoice'=>($getTaskPending->has($service))?$getTaskPending->get($service):0,
                            'certificase'=>($getComAu->has($service))?$getComAu->get($service):0,
                            'extendRemind'=>($getRemindExtendPendingAu->has($service))?$getRemindExtendPendingAu->get($service):0,
                            'extendSuccessfully'=>($getRemindExtendAu->has($service))?$getRemindExtendAu->get($service):0,
                        ];
                    },$getIdOshcOvhc->toArray());

                    $getCertificaseFlywire = Apply::whereBetween('initiated_date',[$startDate,$endDate])
                        ->whereIn('type_service',$getIdFlywire)
                        ->get()
                        ->groupBy('type_service')->map(function($query){
                            return $query->count();
                        });
                    $getDataFlywire =  array_map(function($service) use ($getCertificaseFlywire){
                        return [
                            'pendingInvoice'=>0,
                            'certificase'=>($getCertificaseFlywire->has($service))?$getCertificaseFlywire->get($service):0,
                            'extendRemind'=>0,
                            'extendSuccessfully'=>0,
                        ];
                    },$getIdFlywire->toArray());
                    foreach ($getDataOshcOvhcHcc as $keyOshcOvhcHcc=>$dataOshcOvhcHcc) {
                        $taskSale[] = array(
                            '0' => $keyOshcOvhcHcc,
                            '1' => $dataOshcOvhcHcc['pendingInvoice'],
                            '2' => $dataOshcOvhcHcc['certificase'],
                            '3' => $dataOshcOvhcHcc['extendRemind'],
                            '4' => $dataOshcOvhcHcc['extendSuccessfully'],
                        );
                    }
                    foreach ($getDataFlywire as $keyFlywire=>$dataFlywire) {
                        $taskSale[] = array(
                            '0' => $keyFlywire,
                            '1' => $dataFlywire['pendingInvoice'],
                            '2' => $dataFlywire['certificase'],
                            '3' => $dataFlywire['extendRemind'],
                            '4' => $dataFlywire['extendSuccessfully'],
                        );
                    }
                    $taskSale[] = $emptyArr;
                    $taskSale[] = $emptyArr;
                    break;
                default:
                    break;
            }
        }

        return (collect($taskSale));
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
