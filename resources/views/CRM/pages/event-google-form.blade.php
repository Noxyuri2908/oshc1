@extends('CRM.layouts.default')

@section('title')
    GOOGLE CALENDAR
    @parent
@stop

@section('css')
    <style>

    </style>
@stop
@section('content')
    <div class="">
        <div class="card px-3 py-3 mb-5 pb-5">
            <div class="row">
                <div class="col-md-6">
                    <form
                        action="{{!empty($event)?route('event.update',['event_id'=>request()->get('event_id')]):route('event.store')}}"
                        method="POST">
                        @csrf
                        @if(request()->get('submit_form') == 'task_sale')
                            <input type="hidden" name="submit_form" value="task_sale">
                        @endif
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Title" name="summary"
                                       value="{{!empty($event)?$event->summary:''}}">
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-row">
                                    @if(!empty($event))
                                        @can('google_calendar.update')
                                            <button type="submit"
                                                    class="btn btn-primary mr-3">Update</button>
                                        @endcan
                                    @else
                                        @can('google_calendar.store')
                                            <button type="submit"
                                                    class="btn btn-primary mr-3">Create</button>
                                        @endcan
                                    @endif
                                    <a href="{{(request()->get('submit_form') == 'task_sale')?route('tasks.sale.index'):route('event.index')}}"
                                       class="btn btn-danger">Back</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Color</label>
                                    <select name="color_id" id="get_color_google" class="form-control">
                                        @foreach($colors as $key=>$color)
                                            <option data-color="{{$color->background}}"
                                                    value="{{$key}}" {{(!empty($event) && $event->colorId == $key)?'selected':''}}>{{(!empty(\Config::get('myconfig.color_event_google')[$key]))?\Config::get('myconfig.color_event_google')[$key]:''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group agent_id_select2" onmouseover="callAgent()">
                                    <label for="">Agent Id</label>
                                    <select name="agent_id" id="agent_id" class="form-control">
{{--                                        @foreach($agents as $key=>$agent)--}}
{{--                                            <option value="{{$key}}" {{!empty($event) && $event->extendedProperties->private['agent_id'] == $key ? 'selected':''}}>{{$agent}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start date</label>
                                    <input type="text" class="form-control choose-input-time" name="start"
                                           value="{{!empty($event)?\Carbon::parse($event->start->dateTime)->format('Y-m-d H:i'):''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End date</label>
                                    <input type="text" class="form-control choose-input-time" name="end"
                                           value="{{!empty($event)?\Carbon::parse($event->end->dateTime)->format('Y-m-d H:i'):''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>UTC Start time</label>
                                    <select name="utc_start_time" id="utc_start_time"
                                            class="form-control">
                                        <option value="">Select</option>
                                        @foreach(config('list_timezone') as $key=>$one)
                                            <option
                                                value="{{$key}}" {{!empty($event) && $event->start->timeZone == $key?'selected':''}}>
                                                {{$one}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>UTC End time</label>

                                    <select name="utc_end_time" id="utc_end_time"
                                            class="form-control">
                                        <option value="">Select</option>
                                        @foreach(config('list_timezone') as $key=>$one)
                                            <option
                                                value="{{$key}}" {{!empty($event) && $event->start->timeZone == $key?'selected':''}}>
                                                {{$one}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="location"
                                           value="{{!empty($event)?$event->location:''}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="link-attendees-group" class="form-group">
                                    @if(!empty($event))
                                        @if(!empty($event->attendees))
                                            @foreach($event->attendees as $key=>$link)
                                                @if($key > 0)
                                                    <div class="fieldwrapper row mb-1 " id="field{{$key}}">
                                                        <div class="col-md-11"><input type="email"
                                                                                      class="form-control input-link-attendees"
                                                                                      value="{{$link->email}}"
                                                                                      name="email_attendees[]"
                                                                                      placeholder="Email" required="">
                                                        </div>
                                                        <div class="col-md-1"><input type="button"
                                                                                     class="remove btn btn-default "
                                                                                     value="-"></div>
                                                    </div>
                                                @else
                                                    <div class="mb-1">
                                                        <label>Attendees</label>
                                                        <input type="email" class="form-control input-link-attendees"
                                                               value="{{(!empty($link) && !empty($link->email))?$link->email:''}}" name="email_attendees[]"
                                                               placeholder="Email" required="">
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="mb-1">
                                                <label>Attendees</label>
                                                <input type="email" class="form-control input-link-attendees" value=""
                                                       name="email_attendees[]" placeholder="Email" required="">
                                            </div>
                                        @endif
                                    @else
                                        <div class="mb-1">
                                            <label>Attendees</label>
                                            <input type="email" class="form-control input-link-attendees" value=""
                                                   name="email_attendees[]" placeholder="Email" required="">
                                        </div>
                                    @endif
                                </div>
                                <a class="plus-attendees" href="#">Add email +</a>
                            </div>
                            <div class="col-md-12">
                                <div id="link-alert-group" class="form-group">
                                    @if(!empty($event))
                                        @if(!empty($event->reminders) && !empty($event->reminders->overrides))
                                            @foreach($event->reminders->overrides as $key=>$link)
                                                @if($key > 0)
                                                    <div class="fieldwrapper row mb-1 " id="field{{$key}}">
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select name="alert_type[]" id=""
                                                                            class="form-control">
                                                                        <option
                                                                            value="email" {{$link->method == 'email'?'selected':''}}>
                                                                            Email
                                                                        </option>
                                                                        <option
                                                                            value="popup" {{$link->method == 'popup'?'selected':''}}>
                                                                            Pop Up
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="number"
                                                                           class="form-control input-link-alert"
                                                                           value="{{$link->minutes}}"
                                                                           name="alert_number[]" placeholder="">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select name="alert_time_type[]" id=""
                                                                            class="form-control">
                                                                        <option value="60">Hour</option>
                                                                        <option value="1" selected>Minute</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="button" class="remove btn btn-default "
                                                                   value="-">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="mb-1">
                                                        <label>Alert</label>
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <select name="alert_type[]" id=""
                                                                                class="form-control">
                                                                            <option
                                                                                value="email"{{$link->method == 'email'?'selected':''}}>
                                                                                Email
                                                                            </option>
                                                                            <option
                                                                                value="popup"{{$link->method == 'popup'?'selected':''}}>
                                                                                Pop Up
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="number"
                                                                               class="form-control input-link-alert"
                                                                               value="{{$link->minutes}}"
                                                                               name="alert_number[]" placeholder="">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select name="alert_time_type[]" id=""
                                                                                class="form-control">
                                                                            <option value="60">Hour</option>
                                                                            <option value="1" selected>Minute</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="mb-1">
                                                <label>Alert</label>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <select name="alert_type[]" id="" class="form-control">
                                                                    <option value="email">Email</option>
                                                                    <option value="popup">Pop Up</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number"
                                                                       class="form-control input-link-alert"
                                                                       value="{{(!empty($link))?$link->email:''}}" name="alert_number[]"
                                                                       placeholder="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="alert_time_type[]" id=""
                                                                        class="form-control">
                                                                    <option value="60">Hour</option>
                                                                    <option value="1">Minute</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="mb-1">
                                            <label>Alert</label>
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <select name="alert_type[]" id="" class="form-control">
                                                                <option value="email">Email</option>
                                                                <option value="popup">Pop Up</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" class="form-control input-link-alert"
                                                                   value="" name="alert_number[]" placeholder="">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="alert_time_type[]" id="" class="form-control">
                                                                <option value="60">Hour</option>
                                                                <option value="1">Minute</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <a class="plus-alert" href="#">Add alert +</a>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea type="text" class="form-control"
                                              name="description">{{!empty($event)?htmlspecialchars_decode($event->description):''}}</textarea>
                                </div>
                            </div>
                            @if(empty($event))
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" name="send_email_notification" class="form-check-input"
                                               id="send_notification">
                                        <label class="form-check-label" for="send_notification">Send invitation emails
                                            to Google Calendar guests</label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="offset-md-6">
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')

{{--    @include('CRM.partials.script-call-agent',[--}}
{{--    'nameFunction'=>'callAgent',--}}
{{--    'elementIdSelect2'=>'agent_id',--}}
{{--    'elementParentIdSelect2'=>'agent_id_select2',--}}
{{--    'data'=>!empty($event)?$event:[],--}}
{{--    'dataId'=>!empty($event) && !empty($event->extendedProperties) && !empty($event->extendedProperties->private)?$event->extendedProperties->private['agent_id']:'',--}}
{{--    'dataName'=>'abc'--}}
{{--])--}}
    <script>
        $('#agent_id').select2({
            dropdownParent: $('.agent_id_select2'),
            ajax: {
                url: '{{route('agent.getAgentSelect')}}',
                type: 'GET',
                quietMillis: 10000,
                dataType: 'json',
                data: function (term) {
                    var query = {
                        name: term.term,
                    }
                    return query
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'

                    var results = []
                    data.forEach(e => {
                        results.push({
                            id: e.id,
                            text: e.name,
                        })
                    })
                    return {
                        results: results,
                    }
                },
            },
        })

        $('#utc_end_time').select2()
        $('#utc_start_time').select2()
        $('.choose-input-time').flatpickr({
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
        })
        $('.plus-attendees').click(function (e) {
            e.preventDefault()
            var lastField = $('#link-attendees-group div:last')
            var intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1

            var fieldWrapper = $('<div class="fieldwrapper row mb-1 " id="field' + intId + '"/>')
            fieldWrapper.data('idx', intId)
            var fName = $('<div class="col-md-11"><input type="email" class="form-control input-link-attendees" value="" name="email_attendees[]" placeholder="Email" required></div>')
            var removeButton = $('<div class="col-md-1"><input type="button" class="remove btn btn-default " value="-" /></div>')
            removeButton.click(function () {
                $(this).parent().remove()
            })
            fieldWrapper.append(fName)
            fieldWrapper.append(removeButton)
            $('#link-attendees-group').append(fieldWrapper)
        })
        $('.plus-alert').click(function (e) {
            e.preventDefault()
            var lastField = $('#link-alert-group div:last')
            var intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1

            var fieldWrapper = $('<div class="fieldwrapper row mb-1 " id="field' + intId + '"/>')
            fieldWrapper.data('idx', intId)
            var fName = $('<div class="col-md-11"><div class="row"> <div class="col-md-4"> <select name="alert_type[]" class="form-control"> <option value="email">Email</option> <option value="popup">Pop Up</option> </select> </div><div class="col-md-4"> <input type="number" class="form-control input-link-alert" value="" name="alert_number[]"> </div><div class="col-md-4"> <select name="alert_time_type[]" class="form-control"> <option value="60">Hour</option> <option value="1">Minute</option> </select> </div></div></div>')
            var removeButton = $('<div class="col-md-1"><input type="button" class="remove btn btn-default " value="-" /></div>')
            removeButton.click(function () {
                $(this).parent().remove()
            })
            fieldWrapper.append(fName)
            fieldWrapper.append(removeButton)
            $('#link-alert-group').append(fieldWrapper)
        })
        $(document).on('click', '.remove', function (e) {
            e.preventDefault()
            $(this).parent().parent().remove()
        })

        function formatOutput(item) {
            var color = $(item.element).data('color')
            var $span = $('<div style=\'display:flex\'><span  style=\'width: 28px;height:26px;background-color:' + color + '\'></span><span>' + item.text + '</span></div>')
            return $span
        }

        $('#get_color_google').select2({
            templateResult: formatOutput,
            templateSelection: formatOutput,
        })

    </script>
@endpush
