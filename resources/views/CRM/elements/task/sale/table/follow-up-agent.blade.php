@can('followUp.index')
<div class="table-follow-ups table-div">
    <table class="">
        <thead class="">
        <tr class="first-row">
            <th class="width-50 text-center">Action</th>
            @foreach($configFollowsUpByOrder as $key)
                <th class="{{$key['class']}}">{{$key['value']}}</th>
            @endforeach {{--View Composer agent--}}
        </tr>

        @include('CRM.elements.task.sale.table.follow_up_agent.filter')

        </thead>
        <tbody id="follow-ups-data-sale">

        </tbody>
    </table>
</div>
<div id="modal_follow_ups_form">

</div>
@endcan

@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'process_date_follow_up',
        'due_date_task'
    ]]);
    @if(!empty($agent_id))
    @include('CRM.elements.task.sale.table.follow_up_agent.elements.script',['agent_id'=>$agent_id])
    @else
        @include('CRM.elements.task.sale.table.follow_up_agent.elements.script')
    @endif
    @include('CRM.partials.choose_date_onchange_call_function',[
            'idElementInputFlatpick'=>[
                'processing_date_follow_ups_start',
                'processing_date_follow_ups_end',
                'due_date_follow_ups_end',
                'due_date_follow_ups_start'
                ],
            'functionNameCall'=>'debounceAjaxFollowUps'
        ])
    <script>
        $('#potential_service_follow_ups_filter').select2({
            closeOnSelect:false
        })

        function showModelDes(elm)
        {
            var content = elm.innerText;
            var html = '';
            html += '<div class="modal fade show" role="dialog" id="modelFL" style="display: block" onclick="hideModel()">'
            html += '<div class="modal-dialog">'
            html += '<div class="modal-content">'
            html += '<div class="modal-header">'
            html += '<button type="button" class="close" data-dismiss="modal">&times;</button>'
            html += '</div>'
            html += '<div class="modal-body">'
            html += `<div><p style="white-space: pre-wrap;">${content}</p></div>`
            html += '</div>'
            html += '<div class="modal-footer">'
            html += '<button type="button" class="btn btn-default " id="close-model-attendees" onclick="hideModelAttendees()">Close</button>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            $('#modelsFL').append(html);
            $('body').append('<div class="modal-backdrop fade show"></div>')
            $('body').addClass('modal-open')
        }

        function hideModel()
        {
            $('#modelFL').remove();
            $('.modal-backdrop').remove()
            $('body').removeClass('modal-open')
        }
    </script>
@endpush
