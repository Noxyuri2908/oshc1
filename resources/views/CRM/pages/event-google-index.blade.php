@extends('CRM.layouts.default')

@section('title')
    GOOGLE CALENDAR
    @parent
@stop

@section('css')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css"  rel="stylesheet"/>
<style>
    .popper,
    .tooltip {
    position: absolute;
    z-index: 9999;
    background: #FFC107;
    color: black;
    width: 150px;
    border-radius: 3px;
    box-shadow: 0 0 2px rgba(0,0,0,0.5);
    padding: 10px;
    text-align: center;
    }
    .style5 .tooltip {
    background: #1E252B;
    color: #FFFFFF;
    max-width: 200px;
    width: auto;
    font-size: .8rem;
    padding: .5em 1em;
    }
    .popper .popper__arrow,
    .tooltip .tooltip-arrow {
    width: 0;
    height: 0;
    border-style: solid;
    position: absolute;
    margin: 5px;
    }

    .tooltip .tooltip-arrow,
    .popper .popper__arrow {
    border-color: #FFC107;
    }
    .style5 .tooltip .tooltip-arrow {
    border-color: #1E252B;
    }
    .popper[x-placement^="top"],
    .tooltip[x-placement^="top"] {
    margin-bottom: 5px;
    }
    .popper[x-placement^="top"] .popper__arrow,
    .tooltip[x-placement^="top"] .tooltip-arrow {
    border-width: 5px 5px 0 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    bottom: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
    }
    .popper[x-placement^="bottom"],
    .tooltip[x-placement^="bottom"] {
    margin-top: 5px;
    }
    .tooltip[x-placement^="bottom"] .tooltip-arrow,
    .popper[x-placement^="bottom"] .popper__arrow {
    border-width: 0 5px 5px 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    top: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
    }
    .tooltip[x-placement^="right"],
    .popper[x-placement^="right"] {
    margin-left: 5px;
    }
    .popper[x-placement^="right"] .popper__arrow,
    .tooltip[x-placement^="right"] .tooltip-arrow {
    border-width: 5px 5px 5px 0;
    border-left-color: transparent;
    border-top-color: transparent;
    border-bottom-color: transparent;
    left: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
    }
    .popper[x-placement^="left"],
    .tooltip[x-placement^="left"] {
    margin-right: 5px;
    }
    .popper[x-placement^="left"] .popper__arrow,
    .tooltip[x-placement^="left"] .tooltip-arrow {
    border-width: 5px 0 5px 5px;
    border-top-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    right: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
    }
    .fc-theme-standard td, .fc-theme-standard th{
        display: table-cell;
        width: 14.28%;
    }
    #modal_event_title_color{
        width:20px;
        height:20px;
    }
    #calendar .fc-list-event-time {
        width: 12%;
    }
    #calendar .fc-list-event-graphic {
        width: 3%;
    }
    #calendar .fc-list-event-title {
        width: 80%;
    }
</style>
@stop
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            {{-- <form action="">
                <div class="form-group">
                    <label for="">Select Calendar List</label>
                    <select class="form-control" name="calendar_id" id="" onchange="this.form.submit()">
                        <option value="">Select</option>
                        @foreach($calendarList as $calendar)
                            <option value="{{$calendar->id}}" {{request()->get("calendar_id") == $calendar->id?'selected':''}}>
                                {{$calendar->summary}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form> --}}
            <div>
                <a href="{{route('event.create')}}" class="btn btn-primary">Create</a>
                <a href="#" class="btn btn-danger btn-logout-google">Log out</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-1">
                    <div id="modal_event_title_color" class="mr-2 rounded" style=""></div>
                    <p class="h2 mb-0" id="modal_event_title">Title</p>
                </div>
                <p id="modal_event_time" class=" mb-1">Time</p>
                <p id="modal_event_time_zone" class=" mb-1">Timezone</p>
                <br>
                <div class="d-flex align-items-center mb-1">
                    <p class=" mb-0">Google meet :</p>
                    <a id="modal_event_google_meet" href="#">Join with Google Meet</a>
                </div>
                <div class="d-flex align-items-center mb-1" id="modal_event_location">

                </div>
                <div class="d-flex flex-column mb-1">
                    <p><i class="fas fa-user mr-2"></i>Attendees :</p>
                    <div class="d-flex" id="attendees_list">

                    </div>
                </div>
                <div class="d-flex align-items-center mb-1" id="modal_event_note">

                </div>
                <div class="d-flex align-items-center mb-1">
                    <i class="fas fa-bell mr-2"></i>
                    <div class="d-flex" id="modal_event_alert_list">

                    </div>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <i class="far fa-calendar-minus mr-2"></i>
                    <p id="modal_event_creater" class="mb-0">Created By</p>
                </div>
            </div>
            <div class="modal-footer">
                <a id="modal_event_button_edit" class="btn btn-primary text-light">Edit</a>
                <a id="modal_event_button_delete" class="btn btn-danger text-light">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <div id='calendar'></div>
</div>
@stop
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function formatDateTime(dateTime)
        {
            var date = new Date(dateTime);
            var year = date.getFullYear();

            var month = (date.getMonth() + 1 < 10) ? '0'+ (date.getMonth() + 1) : date.getMonth() + 1;
            var day = (date.getDate() < 10) ? '0'+date.getDate() : date.getDate();
            var hour = (date.getHours() < 10) ? '0'+date.getHours() : date.getHours();
            var minute = (date.getMinutes() < 10) ? '0'+date.getMinutes() : date.getMinutes();
            var second = (date.getSeconds() < 10) ? '0'+date.getSeconds() : date.getSeconds();

            var time = year+'/'+month+'/'+day+ ' ' +hour+':'+minute+':'+second;
            return time;
        }
    var calendarEl = document.getElementById('calendar');
    var arrElement = [];
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listYear'
        },
        defaultView: 'month',
			editable: true,
			events: [
                @foreach($events as $event)
                {
                    title: '{{$event->summary}}',
                    start: '{{(!empty($event->start))?$event->start->dateTime:""}}',
                    end: '{{(!empty($event->end))?$event->end->dateTime:""}}',
                    creator:'{{(!empty($event->creator))?$event->creator->email:""}}',
                    organizer:'{{(!empty($event->organizer))?$event->organizer->email:""}}',
                    location:'{{(!empty($event->location))?$event->location:""}}',
                    id:'{{(!empty($event->id))?$event->id:""}}',
                    status:'{{(!empty($event->status))?$event->status:""}}',
                    description: ('{{(!empty($event->description))?htmlspecialchars_decode(str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ),$event->description)):""}}').replace(/&gt;/g, ">").replace(/&lt;/g,"<" ),
                    hangoutLink:'{{(!empty($event->hangoutLink))?$event->hangoutLink:""}}',
                    start_date: {
                        'date': '{{(!empty($event->start))?\Carbon::parse($event->start->dateTime)->setTimezone('UTC')->format('d/m/Y h:i:s'):""}}',
                        'timeZone':'{{(!empty($event->start))?$event->start->timeZone:""}}'
                    },
                    end_date: {
                        'date': '{{(!empty($event->end))?\Carbon::parse($event->end->dateTime)->setTimezone('UTC')->format('d/m/Y h:i:s'):""}}',
                        'timeZone':'{{(!empty($event->end))?$event->end->timeZone:""}}'
                    },
                    attendees:[
                        @if(!empty($event->attendees))
                            @foreach($event->attendees as $attendee)
                            {
                                email:'{{$attendee->email}}',
                                responseStatus:'{{$attendee->responseStatus}}'
                            },
                            @endforeach
                        @endif
                    ],
                    entryPoints:[
                        @if(!empty($event->conferenceData) && !empty($event->conferenceData->entryPoints))
                            @foreach($event->conferenceData->entryPoints as $entryPoint)
                            {
                                uri:"{{$entryPoint->uri}}",
                            },
                            @endforeach
                        @endif
                    ],
                    reminders:[
                        @if(!empty($event->reminders) && !empty($event->reminders->overrides))
                            @foreach($event->reminders->overrides as $override)
                            {
                                method:"{{$override->method}}",
                                minutes:"{{$override->minutes}}",
                            },
                            @endforeach
                        @endif
                    ],
                    backgroundColor: '{{!empty($colorEvents[$event->colorId])?$colorEvents[$event->colorId]->background:$colorEvents[1]->background}}'
                },
                @endforeach
			],
        eventDidMount: function(info) {
            var tooltip = new Tooltip(info.el, {
                title: JSON.stringify(info.event.title),
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        },
        eventClick: function(event, jsEvent, view) {
            $('#modal_event_title_color').attr('style','background-color:'+event.event.backgroundColor);
            $('#modal_event_title').text(event.event.title);
            if(!jQuery.isEmptyObject(event.event._def.extendedProps.location)){
                $('#modal_event_location').html('<i class="fas fa-map-marker-alt mr-2"></i><p class="mb-0">'+event.event._def.extendedProps.location+'</p>');
            }
            $('#modal_event_google_meet').attr('href',event.event._def.extendedProps.hangoutLink);
            if(!jQuery.isEmptyObject(event.event._def.extendedProps.description)) {
                var text_description = event.event._def.extendedProps.description.split(',');
                $.ajax({
                    url:"{{route('agent.getAgentById')}}",
                    type:'get',
                    data:{
                        agent_id : text_description[0]
                    },
                    success:function(data){
                        var class_html = document.getElementsByClassName('mb-1');
                        var content = class_html[class_html.length - 1];
                        var html = `<div class="d-flex align-items-center mb-1"><p id="modal_event_creater" class="mb-0">Agent : ${data.agent}</p></div>`;
                        content.insertAdjacentHTML( 'afterend', html );
                    }
                });
                $('#modal_event_note').html('<i class="fas fa-bars mr-2"></i><p class="mb-0 w-100">' + text_description[1] + '</p>');
            }else{
                $('#modal_event_note').html('');
            }
                $('#modal_event_time').text(formatDateTime(`${event.event.start}`) +' to '+ formatDateTime(`${event.event.end}`));
            if(!jQuery.isEmptyObject(event.event._def.extendedProps.start_date.timeZone) || !jQuery.isEmptyObject(event.event._def.extendedProps.end_date.timeZone)) {
                $('#modal_event_time_zone').text('Timezone: ' + event.event._def.extendedProps.start_date.timeZone + ' to ' + event.event._def.extendedProps.end_date.timeZone);
            }else{
                $('#modal_event_time_zone').text('');
            }
            $('#modal_event_button_edit').attr('data-id',event.event.id);
            $('#modal_event_button_delete').attr('data-id',event.event.id);
            $('#modal_event_creater').text(event.event._def.extendedProps.creator);
            // $('#').text(data.event.reminders.overrides);
            html_attendees = '';
            html_attendees += '<ul>';
            if(jQuery.isEmptyObject(event.event._def.extendedProps.attendees)){

            }else{
                for(let i = 0;i<Object.keys(event.event._def.extendedProps.attendees).length;i++){
                    html_attendees += '<li>'+event.event._def.extendedProps.attendees[i].email+'</li>';
                }
            }
            html_attendees += '</ul>';
            $('#attendees_list').html(html_attendees);

            html_reminders = '';
            html_reminders += '<ul class="mb-0">';
            if(jQuery.isEmptyObject(event.event._def.extendedProps.reminders)){

            }else{
                for(let i = 0;i<Object.keys(event.event._def.extendedProps.reminders).length;i++){
                    html_reminders += '<li>'+event.event._def.extendedProps.reminders[i].method+' '+event.event._def.extendedProps.reminders[i].minutes +' minutes'+'</li>';
                }
            }
            html_reminders += '</ul>';
            $('#modal_event_alert_list').html(html_reminders);
            $('#exampleModal').modal('show');

            // event.jsEvent.cancelBubble = true;
            // event.jsEvent.preventDefault();
            // $.ajax({
            //     url:"{{route('event.show')}}",
            //     type:'post',
            //     data:{
            //         event_id:event.event._def.publicId,
            //         _token:"{{csrf_token()}}"
            //     },
            //     success:function(data){
            //         // console.log(data);

            //     }
            // })

        }
    });
    // console.log(arrElement);
    // for(var indexElement = 0; indexElement < arrElement.length; indexElement++){
    //     $(arrElement[indexElement]).
    // }
        calendar.render();
    });
    // document.addEventListener('DOMContentLoaded', function() {
    // var calendarEl = document.getElementById('calendar');
    // var arrElement = [];
    // var calendar = new FullCalendar.Calendar(calendarEl, {
    //     headerToolbar: {
    //         left: 'prev,next today',
    //         center: 'title',
    //         right: 'dayGridMonth,listYear'
    //     },
    //     displayEventTime: false, // don't show the time column in list view
    //     googleCalendarApiKey: 'AIzaSyBpLwAKfQWLmvAcsZad8SEUcEYJNn3Auhc',

    //     // US Holidays
    //     events: '{{request()->get("calendar_id")}}',

    //     eventDidMount: function(info) {
    //         var tooltip = new Tooltip(info.el, {
    //             title: JSON.stringify(info.event.title),
    //             placement: 'top',
    //             trigger: 'hover',
    //             container: 'body'
    //         });
    //     },
    //     eventClick: function(event, jsEvent, view) {
    //         event.jsEvent.cancelBubble = true;
    //         event.jsEvent.preventDefault();
    //         // console.log(event);

    //         $.ajax({
    //             url:"{{route('event.show')}}",
    //             type:'post',
    //             data:{
    //                 event_id:event.event._def.publicId,
    //                 _token:"{{csrf_token()}}"
    //             },
    //             success:function(data){
    //                 // console.log(data);
    //                 $('#modal_event_title_color').attr('style','background-color:'+data.color);
    //                 $('#modal_event_title').text(data.event.summary);
    //                 if(jQuery.isEmptyObject(data.event.location)){

    //                 }else{
    //                     $('#modal_event_location').html('<i class="fas fa-map-marker-alt mr-2"></i><p class="mb-0">'+data.event.location+'</p>');
    //                 }
    //                 $('#modal_event_note').text(data.event.description);
    //                 $('#modal_event_time').text(data.event.start.dateTime +' to '+ data.event.end.dateTime);
    //                 $('#modal_event_button_edit').attr('data-id',data.event.id);
    //                 $('#modal_event_button_delete').attr('data-id',data.event.id);
    //                 $('#modal_event_creater').text(data.event.creator.email);
    //                 // $('#').text(data.event.reminders.overrides);
    //                 html_attendees = '';
    //                 html_attendees += '<ul>';
    //                 if(jQuery.isEmptyObject(data.event.attendees)){

    //                 }else{
    //                     for(let i = 0;i<Object.keys(data.event.attendees).length;i++){
    //                         html_attendees += '<li>'+data.event.attendees[i].email+'</li>';
    //                     }
    //                 }
    //                 html_attendees += '</ul>';
    //                 $('#attendees_list').html(html_attendees);

    //                 html_reminders = '';
    //                 html_reminders += '<ul>';
    //                 if(jQuery.isEmptyObject(data.event.reminders.overrides)){

    //                 }else{
    //                     for(let i = 0;i<Object.keys(data.event.reminders.overrides).length;i++){
    //                         html_reminders += '<li>'+data.event.reminders.overrides[i].method+' '+data.event.reminders.overrides[i].minutes +' minutes'+'</li>';
    //                     }
    //                 }
    //                 html_reminders += '</ul>';
    //                 $('#modal_event_alert_list').html(html_reminders);
    //                 $('#exampleModal').modal('show');
    //             }
    //         })

    //     }
    // });
    // // console.log(arrElement);
    // // for(var indexElement = 0; indexElement < arrElement.length; indexElement++){
    // //     $(arrElement[indexElement]).
    // // }
    // calendar.render();
    // });



</script>
<script>
    $(document).on('click','#modal_event_button_edit',function(e){
        let _eventId = $(this).attr('data-id');
        let _urlDefault = "{{route('event.edit',['event_id'=>'event_id_value'])}}";
        let urlReal = _urlDefault.replace('event_id_value', _eventId);
        window.location.href= urlReal;
    })
    $(document).on('click','#modal_event_button_delete',function(e){
        let _eventId = $(this).attr('data-id');
        let _urlDefault = "{{route('event.delete',['event_id'=>'event_id_value'])}}";
        let urlReal = _urlDefault.replace('event_id_value', _eventId);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            $.ajax({
                url:urlReal,
                type:'post',
                data:{
                    _token:"{{csrf_token()}}"
                },
                success:function(data){
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                    window.location.reload();
                }
            })

        })

    })
    $(document).on('click','.btn-logout-google',function(e){
        $.ajax({
            url:"{{route('logout.google')}}",
            data:{
                _token:"{{csrf_token()}}"
            },
            type:'post',
            success:function(data){
                window.location.href=data;
            }
        })
    })

</script>
@endpush
