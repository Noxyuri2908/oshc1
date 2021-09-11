<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Appointments;
use App\Components\GoogleClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //
    protected $client;
    //
    public function __construct(GoogleClient $client)
    {
        $this->middleware(function ($request, $next) use ($client) {
            $token = \Session::get('google_token');
            if(!empty(Auth::user()->google_token)){
                $token = Auth::user()->google_token;
                $this->client = $client->getClient($token);
                return $next($request);
            }else{
                return redirect()->route('crm.dashboard');
            }
        });
    }
    public function indexEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.index')) return abort(403);
        $flag = 'google_calendar';
        $calendarService = new Google_Service_Calendar($this->client);
        $calendarList = $calendarService->calendarList->listCalendarList();
        $colorEvents = $calendarService->colors->get()->getEvent();
        $startDate = (!empty($request->get('processing_date_appointment_start'))) ? Carbon::parse(convert_date_to_db($request->get('processing_date_appointment_start')))->toIso8601String() : Carbon::parse(date('Y-m-01'))->toIso8601String();
        $endDate = (!empty($request->get('processing_date_appointment_end'))) ? Carbon::parse(convert_date_to_db($request->get('processing_date_appointment_end')))->toIso8601String() : Carbon::parse(date('Y-m-d'))->toIso8601String();

        if ($request->get('submit_form') == 'task_sale') {
            $optParams = [
                // 'maxResults' => 10,
                'singleEvents' => true,
                'orderBy' => 'startTime',
                'pageToken' => $request->get('nextToken'),
                "timeMin" => $startDate,
                "timeMax" => $endDate,
                'q' => $request->get('q_filter'),
            ];
            if (!empty($request->get('agent_id'))){
                $optParams['privateExtendedProperty'] = 'agent_id=' . $request->get('agent_id');
            }elseif(!empty($request->get('agent_appointment_filter'))){
                $optParams['privateExtendedProperty'] = 'agent_id=' . $request->get('agent_appointment_filter');
            }
            $events = $calendarService->events->listEvents('primary', $optParams);
            $nextPageToken = $events->getNextPageToken();
            return response()->json([
                'nextToken' => $nextPageToken,
                'view' => view('CRM.elements.task.sale.table.appointment.data', compact('events'))->render()
            ]);
        } else {
            $optParams = [
                // 'maxResults' => 10,
                // 'singleEvents' => true,
                // 'orderBy' => 'startTime',
                // 'pageToken' => $request->get('nextToken')
            ];
            $events = $calendarService->events->listEvents('primary', $optParams);
            return view('CRM.pages.event-google-index', compact(
                'flag',
                'calendarList',
                'events',
                'colorEvents'
            ));
        }
    }
    public function createEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.store')) return abort(403);
        $calendarService = new Google_Service_Calendar($this->client);
        $colors = $calendarService->colors->get()->getEvent();
        $flag = 'google_calendar';
        return view('CRM.pages.event-google-form', compact('flag', 'colors'));
    }
    public function showEvent(Request $request)
    {
        $calendarService = new Google_Service_Calendar($this->client);
        $eventId = $request->get('event_id');
        $event = $calendarService->events->get('primary', $eventId);
        $color_id = $event->colorId;
        $color = !empty($calendarService->colors->get()->getEvent()[$color_id]) ? $calendarService->colors->get()->getEvent()[$color_id]->background : '#039BE5';
        return response()->json([
            'event' => $event,
            'color' => $color
        ]);
    }
    public function storeEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.store')) return abort(403);
        $calendarService = new Google_Service_Calendar($this->client);
        $arrAttendees = [];
        if (!empty($request->get('email_attendees'))) {
            foreach ($request->get('email_attendees') as $email) {
                array_push($arrAttendees, ['email' => $email]);
            }
        }
        $arrAlert = [];
        if (!empty($request->get('alert_type'))) {
            foreach ($request->get('alert_type') as $key => $alertType) {
                array_push($arrAlert, ['method' => $alertType, 'minutes' => intval($request->get('alert_number')[$key]) * intval($request->get('alert_time_type')[$key])]);
            }
        }

        $start_date = new \DateTime($request->get('start'), new \DateTimeZone($request->get('utc_start_time')));
        $end_date = new \DateTime($request->get('end'), new \DateTimeZone($request->get('utc_end_time')));

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $request->get('summary'),
            'location' => $request->get('location'),
            'description' => $request->get('agent_id').','.$request->get('description'),
            'start' => array(
                'dateTime' => $start_date->format(\DateTime::RFC3339),
                'timeZone' => $request->get('utc_start_time'),
            ),
            'end' => array(
                'dateTime' => $end_date->format(\DateTime::RFC3339),
                'timeZone' => $request->get('utc_end_time'),
            ),
            'colorId' => $request->get('color_id'),
            'attendees' => $arrAttendees,
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => $arrAlert,
            ),
            'extendedProperties' => [
                "private" => [
                    'agent_id' => $request->get('agent_id'),

                ],
            ]
        ));

        $calendarId = 'primary';
        $optParam = [];
        if($request->get('send_email_notification') == 'on'){
            $optParam['sendNotifications']=true;
        }
        $calendarService->events->insert($calendarId, $event,$optParam);
        if ($request->get('submit_form') == 'task_sale') {
            return redirect()->route('tasks.sale.index');
        } else {
            return redirect()->route('event.index');
        }
    }
    public function editEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.edit')) return abort(403);
        $calendarService = new Google_Service_Calendar($this->client);
        $eventId = $request->get('event_id');
        $event = $calendarService->events->get('primary', $eventId);
        $flag = 'google_calendar';
        $colors = $calendarService->colors->get()->getEvent();
        return view('CRM.pages.event-google-form', compact('event', 'flag', 'colors'));
    }
    public function updateEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.update')) return abort(403);
        $eventId = $request->get('event_id');
        $calendarService = new Google_Service_Calendar($this->client);

        // First retrieve the event from the API.
        $event = $calendarService->events->get('primary', $eventId);

        $arrAttendees = [];
        if (!empty($request->get('email_attendees'))) {
            foreach ($request->get('email_attendees') as $email) {
                array_push($arrAttendees, ['email' => $email]);
            }
        }
        $arrAlert = [];
        if (!empty($request->get('alert_type'))) {
            foreach ($request->get('alert_type') as $key => $alertType) {
                array_push($arrAlert, ['method' => $alertType, 'minutes' => intval($request->get('alert_number')[$key]) * intval($request->get('alert_time_type')[$key])]);
            }
        }
        $eventData = new Google_Service_Calendar_Event(array(
            'summary' => $request->get('summary'),
            'location' => $request->get('location'),
            'description' => $request->get('agent_id').','.$request->get('description'),
            'start' => array(
                'dateTime' => Carbon::parse($request->get('start'))->toIso8601String(),
                'timeZone' => $request->get('utc_start_time'),
            ),
            'end' => array(
                'dateTime' => Carbon::parse($request->get('end'))->toIso8601String(),
                'timeZone' => $request->get('utc_end_time'),
            ),
            // 'recurrence' => array(
            //     'RRULE:FREQ=DAILY;COUNT=2'
            // ),
            'colorId' => $request->get('color_id'),
            'attendees' => $arrAttendees,
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => $arrAlert,
            ),
            'extendedProperties' => [
                "private" => [
                    'agent_id' => $request->get('agent_id'),
                ],
            ]
        ));

        $updatedEvent = $calendarService->events->update('primary', $event->getId(), $eventData);
        // Print the updated date.
        // echo $updatedEvent->getUpdated();
        if ($request->get('submit_form') == 'task_sale') {
            return redirect()->route('tasks.sale.index');
        } else {
            return redirect()->route('event.index');
        }
    }
    public function deleteEvent(Request $request)
    {
        if (!$request->user()->can('google_calendar.delete')) return abort(403);
        $eventId = $request->get('event_id');
        $calendarService = new Google_Service_Calendar($this->client);
        $calendarService->events->delete('primary', $eventId);
        if ($request->get('submit_form') == 'task_sale') {
            return redirect()->route('tasks.sale');
        } else {
            return redirect()->route('event.index');
        }
    }
}
