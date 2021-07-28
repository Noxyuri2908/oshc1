
<div class="table-competitor-feedback table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">

                <th class="width-80">Action</th>
                <th class="width-200">Agent</th>
                <th class="width-220">Processing date</th>
                <th class="width-200">Issue</th>
                {{-- <th class="width-200">Person in charge</th> --}}
                <th class="width-500">Competitor Feedback</th>
            </tr>
            <tr class="last-row">
                <th></th>
                <th>
                    <input type="text" class="form-control" id="agent_competitor_feedback_filter" placeholder="Agent">
                </th>
                <th>
                    <div class="d-flex">
                        <input type="text" class="form-control mr-2" id="processing_date_competitor_feedback_start" placeholder="Date start">
                        <input type="text" class="form-control" id="processing_date_competitor_feedback_end" placeholder="Date end">
                    </div>
                </th>
                <th>
                    <select name="" id="issue_competitor_feedback_filter" class="form-control">
                        <option value="">Status</option>
                        @foreach(config('myconfig.issue_competition_feedback_agent') as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                {{-- <th>
                    <select name="" id="person_in_charge_competitor_feedback_filter" class="form-control">
                        <option value="">Person in charge</option>
                        @foreach($admins as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th> --}}
                <th></th>
            </tr>
        </thead>
        <tbody id="competitor-feedback-data-sale">

        </tbody>
    </table>
</div>
<div id="modal_competition_feedback_form"></div>

@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
    'processing_date_competition_feedback'
]])
<script>
    var pagecompetitorFeedback = 1;
    var lastPagecompetitorFeedback ;
    var agent_competitor_feedback_filter = '';
    var processing_date_competitor_feedback_start = '';
    var processing_date_competitor_feedback_end = '';
    var issue_competitor_feedback_filter = '';
    var person_in_charge_competitor_feedback_filter = '';
    var competitor_feedback_competitor_feedback_filter = '';
    var readycompetitorFeedback = true;
    var arrData = [];
    function getcompetitorFeedbacks(page){
        if(!page){
            page = 1;
        }
        $.ajax({
            url:"{{route('tasks.getCompetitorFeedbacks')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_competitor_feedback_start: "{{request()->get('report_start_date')}}",
                processing_date_competitor_feedback_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option:"{{request()->get('filter_date_option')}}",
                @endif
            },
            success:function(data){
                // html = '';
                // $.each(data.data, function( index, value ) {
                //     // agentNamecompetitorFeedback = value.agent != null?value.agent.name:'';
                //     html += '<tr>'
                //     html += '<th>'+value.agent_name+'</th>'
                //     html += '<td>'+value.processing_date+'</td>'
                //     html += '<td>'+value.issue+'</td>'
                //     html += '<td>'+value.person_in_charge+'</td>'
                //     html += '<td class="white-space-break-spaces">'+value.competitor_feedback+'</td>'
                //     html += '</tr>'
                // });
                $('#competitor-feedback-data-sale').html(data.view);
                lastPagecompetitorFeedback = data.last_page;
                // white-space-break-spaces
            }
        })
    }
    getcompetitorFeedbacks();

    function callAjaxCompetitorFeedback(){
        readycompetitorFeedback = false;
        pagecompetitorFeedback = 1;
        agent_competitor_feedback_filter = $('#agent_competitor_feedback_filter').val();
        processing_date_competitor_feedback_start = $('#processing_date_competitor_feedback_start').val();
        processing_date_competitor_feedback_end = $('#processing_date_competitor_feedback_end').val();
        issue_competitor_feedback_filter = $('#issue_competitor_feedback_filter').val();
        person_in_charge_competitor_feedback_filter = $('#person_in_charge_competitor_feedback_filter').val();
        competitor_feedback_competitor_feedback_filter = $('#competitor_feedback_competitor_feedback_filter').val();
        getcompetitorFeedbacksFilter(
            pagecompetitorFeedback,
            agent_competitor_feedback_filter,
            processing_date_competitor_feedback_start,
            processing_date_competitor_feedback_end,
            issue_competitor_feedback_filter,
            person_in_charge_competitor_feedback_filter,
            competitor_feedback_competitor_feedback_filter
            ,0);
        $('#box_data_customer').scrollTop(0);
    }
    function ajaxCompetitorFeedback(data) {
        if (readycompetitorFeedback) {
            callAjaxCompetitorFeedback();
        }
    }

    function debounce(fn, delay) {
        return args => {
            clearTimeout(fn.id)

            fn.id = setTimeout(() => {
                fn.call(this, args)
            }, delay)
        }
    }

    const debounceAjaxCompetitorFeedback = debounce(ajaxCompetitorFeedback, 300)

    $(document).on('keyup', '.table-competitor-feedback .last-row input', function (e) {
        debounceAjaxCompetitorFeedback(e.target.value)
    })
    $(document).on('change', '.table-competitor-feedback .last-row select', function (e) {
        debounceAjaxCompetitorFeedback(e.target.value)
    })

    //$(document).on('keypress',function(e){
    //    if(e.keyCode == 13 && readycompetitorFeedback && hoverTable == 'competitor-feedback'){
    //        callAjaxCompetitorFeedback();
    //    }
    //});
    function getcompetitorFeedbacksFilter(
        page,
        agent_competitor_feedback_filter,
        processing_date_competitor_feedback_start,
        processing_date_competitor_feedback_end,
        issue_competitor_feedback_filter,
        person_in_charge_competitor_feedback_filter,
        competitor_feedback_competitor_feedback_filter,
        isAppend
        ){

        $.ajax({
            url:"{{route('tasks.getCompetitorFeedbacks')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                agent_competitor_feedback_filter:agent_competitor_feedback_filter,
                processing_date_competitor_feedback_start:processing_date_competitor_feedback_start,
                processing_date_competitor_feedback_end:processing_date_competitor_feedback_end,
                issue_competitor_feedback_filter:issue_competitor_feedback_filter,
                person_in_charge_competitor_feedback_filter:person_in_charge_competitor_feedback_filter,
                competitor_feedback_competitor_feedback_filter:competitor_feedback_competitor_feedback_filter
            },
            success:function(data){
                // console.log(data);
                // html = '';
                // $.each(data.data, function( index, value ) {
                //     // agentNamecompetitorFeedback = value.agent != null?value.agent.name:'';
                //     html += '<tr>'
                //     html += '<th>'+value.agent_name+'</th>'
                //     html += '<td>'+value.processing_date+'</td>'
                //     html += '<td>'+value.issue+'</td>'
                //     html += '<td>'+value.person_in_charge+'</td>'
                //     html += '<td class="white-space-break-spaces">'+value.competitor_feedback+'</td>'
                //     html += '</tr>'
                // });
                if(isAppend == 0){
                    $('#competitor-feedback-data-sale').html(data.view);
                }else if(isAppend == 1){
                    $('#competitor-feedback-data-sale').append(data.view);
                }
                lastPagecompetitorFeedback = data.last_page;
            },
            complete: function() {
                readycompetitorFeedback = true;
            }
        })
    }

    $('.table-competitor-feedback').scroll(function(e) {
        if(readycompetitorFeedback && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
            readycompetitorFeedback = false;
            if(pagecompetitorFeedback < lastPagecompetitorFeedback){
                pagecompetitorFeedback++;
                getcompetitorFeedbacksFilter(
                    pagecompetitorFeedback,
                    agent_competitor_feedback_filter,
                    processing_date_competitor_feedback_start,
                    processing_date_competitor_feedback_end,
                    issue_competitor_feedback_filter,
                    person_in_charge_competitor_feedback_filter,
                    competitor_feedback_competitor_feedback_filter,
                    1);
            }
        }
    });
    function deleteAllFiltercompetitorFeedbacks(){
        getcompetitorFeedbacks(1);
        $('#agent_competitor_feedback_filter').val('');
        $('#processing_date_competitor_feedback_start').val('');
        $('#processing_date_competitor_feedback_end').val('');
        $('#issue_competitor_feedback_filter').val('');
        $('#person_in_charge_competitor_feedback_filter').val('');
        $('#competitor_feedback_competitor_feedback_filter').val('');
        $('#box_data_customer').scrollTop(0);
    }
    $('#delete_all_competitor_feedback_fillter').on('click',function(e){
        e.preventDefault();
        deleteAllFiltercompetitorFeedbacks();
    })

    //crud
    $(document).on('click','.delete-competition-feedback-agent',function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let _url = $(this).attr('data-url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                if (result.isConfirmed && readycompetitorFeedback) {
                    readycompetitorFeedback = false;
                    $.ajax({
                        url:_url,
                        type:'post',
                        data:{
                            _token:"{{csrf_token()}}",
                        },
                        success:function(data){
                            $('#competitor-feedback-'+id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('#modal_competition_feedback').modal('hide');
                        },
                        complete:function(){
                            readycompetitorFeedback = true;
                        }
                    })
                }
                })
        })
        $(document).on('click','#btn_add_new_competition_feedback',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            if(readycompetitorFeedback){
                readycompetitorFeedback = false;
                $.ajax({
                    url:"{{route('crm.ajax.addNewCompetitionFeedback')}}",
                    type:'get',
                    data:{
                        @if(!empty($agent_id))
                        id: "{{$agent_id}}",
                        @endif
                    },
                    success:function(data){
                        $('#modal_competition_feedback_form').html(data);
                        $('#modal_competition_feedback').modal('toggle');
                    },complete:function(){
                        readycompetitorFeedback = true;
                    }
                })
            }
            // }else{
            //     alert('No data selected !');
            // }
        })

        $(document).on('click','.btn-submit-competition-feedback-form',function(e){
            e.preventDefault();
            let _url = $(this).attr('data-url');
            let _processing_date = $('#processing_date_competition_feedback').val();
            let _issue = $('#issue_competition_feedback').val();
            let _person_in_charge = $('#person_in_charge_competition_feedback').val();
            let _competition_feedback = $('#des_competition_feedback').val();
            let _agent_id = $('#agent_competition_feedback').val();
            if(readycompetitorFeedback){
                readycompetitorFeedback = false
                $.ajax({
                    url:_url,
                    type:'post',
                    data:{
                        _token:"{{csrf_token()}}",
                        processing_date:_processing_date,
                        issue:_issue,
                        person_in_charge:_person_in_charge,
                        competition_feedback:_competition_feedback,
                        user_id:_agent_id,
                        submit_from:'task_sale'
                    },
                    success:function(data){
                        // console.log(data);
                        if(data.type == 'create'){
                            pagecompetitorFeedback = 1;
                            $('#competitor-feedback-data-sale').html(data.view);
                            lastPagecompetitorFeedback = data.last_page;
                        }else if(data.type == 'update'){
                            $('#competitor-feedback-'+data.id).replaceWith(data.view);
                        }
                        // $('#competition-feedback-table').html(data);
                        toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                        $('#modal_competition_feedback').modal('hide');
                    },
                    complete:function(){
                        readycompetitorFeedback = true;
                    }
                })
            }

        })
        $(document).on('click','.edit-competition-feedback-agent',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var agent_id = $(this).attr('data-agent_id');
            if(readycompetitorFeedback){
                readycompetitorFeedback = false;
                $.ajax({
                    url:"{{route('crm.ajax.editCompetitionFeedback')}}",
                    type:'get',
                    data:{
                        id:id,
                        agent_id:agent_id
                    },
                    success:function(data){
                        $('#modal_competition_feedback_form').html(data);
                        $('#modal_competition_feedback').modal('toggle');
                    },complete:function(){
                        readycompetitorFeedback = true;
                    }
                })
            }

        })
    //end crud
</script>
@include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'processing_date_competitor_feedback_start',
        'processing_date_competitor_feedback_end'
    ],
    'functionNameCall'=>'debounceAjaxCompetitorFeedback'
])
@endpush
