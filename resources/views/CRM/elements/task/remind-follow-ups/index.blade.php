<div class="table-remind-follow-ups table-div">
    <table class="">
        <thead class="">
        <tr class="first-row">
            <th class="width-50 text-center">Action</th>
            @foreach($configRemindFollowUpByOrder as $key)
                <th class="{{$key['class']}}">{{$key['value']}}</th>
            @endforeach {{--View Composer agent--}}
        </tr>

        @include('CRM.elements.task.remind-follow-ups.filter')

        </thead>
        <tbody id="remind-follow-ups-data">

        </tbody>
    </table>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {

            $('#lastest_date_remind_follow_ups_filter_start, #lastest_date_remind_follow_ups_filter_end ').flatpickr({
                dateFormat: "d/m/Y",
                allowInput: true
            });

            $(document).on('keyup', '.table-remind-follow-ups input', function (e) {
                console.log(1)
                handleEventFilter();
            })

            $(document).on('change', '.table-remind-follow-ups select, .table-remind-follow-ups input', function (e) {
                console.log(2)
                handleEventFilter();
            })
        })

        function handleEventFilter() {
            var branch_remind_follow_ups_filter = $('#branch_remind_follow_ups_filter').val() || null;
            var agent_remind_follow_ups_filter = $('#agent_remind_follow_ups_filter').val() || null;
            var company_email_remind_follow_ups_filter = $('#company_email_remind_follow_ups_filter').val() || null;
            var country_remind_follow_ups_filter = $('#country_remind_follow_ups_filter').val() || null;
            var lastest_date_remind_follow_ups_filter_start = $('#lastest_date_remind_follow_ups_filter_start').val();
            var lastest_date_remind_follow_ups_filter_end = $('#lastest_date_remind_follow_ups_filter_end').val();
            var pc_remind_follow_ups_filter = $('#pc_remind_follow_ups_filter').val() || null;
            var rating_remind_follow_ups_filter = $('#rating_remind_follow_ups_filter').val() || null;
            var status_remind_follow_ups_filter = $('#status_remind_follow_ups_filter').val() || null;
            var time_no_remind_follow_ups_filter = $('#time_no_remind_follow_ups_filter').val() || null;
            var type_of_agent_remind_follow_ups_filter = $('#type_of_agent_remind_follow_ups_filter').val() || null;

            $.ajax({
                url: "{{route('crm.remind-follow-ups-filter')}}",
                type: 'post',
                data: {
                    _token: "{{csrf_token()}}",
                    branch_remind_follow_ups_filter,
                    agent_remind_follow_ups_filter,
                    company_email_remind_follow_ups_filter,
                    country_remind_follow_ups_filter,
                    lastest_date_remind_follow_ups_filter_start,
                    lastest_date_remind_follow_ups_filter_end,
                    pc_remind_follow_ups_filter,
                    rating_remind_follow_ups_filter,
                    status_remind_follow_ups_filter,
                    time_no_remind_follow_ups_filter,
                    type_of_agent_remind_follow_ups_filter
                },
                success: function (data) {
                    $('#remind-follow-ups-data').html(data.view);

                }, complete: function () {
                    // ready = true
                }, error: function (xhr) {
                    // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }
    </script>
@endpush
