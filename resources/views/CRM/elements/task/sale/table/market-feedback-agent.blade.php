
<div class="table-market-feedback table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">
                <th class="width-80">Action</th>
                <th class="width-200">Agent</th>
                <th class="width-220">Processing date</th>
                <th class="width-200">Issue</th>
                <th class="width-200">Person in charge</th>
                <th class="width-500">Market Feedback</th>
            </tr>
            <tr class="last-row">
                <th></th>
                <th>
                    <input type="text" class="form-control" id="agent_market_feedback_filter" placeholder="Agent">
                </th>
                <th>
                    <div class="d-flex">
                        <input type="text" autocomplete="off" class="form-control mr-2" id="processing_date_market_feedback_start" placeholder="Date start">
                        <input type="text" autocomplete="off" class="form-control" id="processing_date_market_feedback_end" placeholder="Date end">
                    </div>
                </th>
                <th>
                    <select name="" id="issue_market_feedback_filter" class="form-control">
                        <option value="">Issue</option>
                        @foreach(config('myconfig.issue_market_feedback_agent') as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select name="" id="person_in_charge_market_feedback_filter" class="form-control">
                        <option value="">Person in charge</option>
                        @foreach($admins as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="market-feedback-data-sale">

        </tbody>
    </table>
</div>
<div id="modal_market_feedback_form">

</div>
@push('scripts')
@include('CRM.partials.choose_date',['ids'=>[
    'processing_date_market_feedback'
]]);
<script>

    var pagemarketFeedback = 1;
    var lastPagemarketFeedback ;
    var agent_market_feedback_filter = '';
    var processing_date_market_feedback_start = '';
    var processing_date_market_feedback_end = '';
    var issue_market_feedback_filter = '';
    var person_in_charge_market_feedback_filter = '';
    var market_feedback_market_feedback_filter = '';
    var readyMarketFeedback = true;
    var arrData = [];
    function getmarketFeedbacks(page){
        if(!page){
            page = 1;
        }
        $.ajax({
            url:"{{route('tasks.getMarketFeedbacks')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_market_feedback_start: "{{request()->get('report_start_date')}}",
                processing_date_market_feedback_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option:"{{request()->get('filter_date_option')}}",
                @endif
            },
            success:function(data){
                $('#market-feedback-data-sale').html(data.view);
                lastPagemarketFeedback = data.last_page;
            }
        })
    }
    getmarketFeedbacks();

    function callAjaxMarketFeedback(){
        readyMarketFeedback = false;
        pageCustomer = 1;
        agent_market_feedback_filter = $('#agent_market_feedback_filter').val();
        processing_date_market_feedback_start = $('#processing_date_market_feedback_start').val();
        processing_date_market_feedback_end = $('#processing_date_market_feedback_end').val();
        issue_market_feedback_filter = $('#issue_market_feedback_filter').val();
        person_in_charge_market_feedback_filter = $('#person_in_charge_market_feedback_filter').val();
        market_feedback_market_feedback_filter = $('#market_feedback_market_feedback_filter').val();
        getmarketFeedbacksFilter(
            pageCustomer,
            agent_market_feedback_filter,
            processing_date_market_feedback_start,
            processing_date_market_feedback_end,
            issue_market_feedback_filter,
            person_in_charge_market_feedback_filter,
            market_feedback_market_feedback_filter
            ,0);
        $('#box_data_customer').scrollTop(0);
    }
    function ajaxMarketFeedback(data){
        if (readyMarketFeedback) {
            callAjaxMarketFeedback();
        }
    }

    function debounce (fn, delay) {
        return args => {
            clearTimeout(fn.id)

            fn.id = setTimeout(() => {
                fn.call(this, args)
            }, delay)
        }
    }

    const debounceAjaxMarketFeedback = debounce(ajaxMarketFeedback, 300)

    $(document).on('keyup','.table-market-feedback .last-row input',function(e){
        debounceAjaxMarketFeedback(e.target.value);
    });
    $(document).on('change','.table-market-feedback .last-row select',function(e){
        debounceAjaxMarketFeedback(e.target.value);
    });

    //$(document).on('keypress',function(e){
    //    if(e.keyCode == 13 && readyMarketFeedback && hoverTable == 'market-feedback'){
    //        callAjaxMarketFeedback();
    //    }
    //});
    function getmarketFeedbacksFilter(
        page,
        agent_market_feedback_filter,
        processing_date_market_feedback_start,
        processing_date_market_feedback_end,
        issue_market_feedback_filter,
        person_in_charge_market_feedback_filter,
        market_feedback_market_feedback_filter,
        isAppend
        ){

        $.ajax({
            url:"{{route('tasks.getMarketFeedbacks')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                agent_market_feedback_filter:agent_market_feedback_filter,
                processing_date_market_feedback_start:processing_date_market_feedback_start,
                processing_date_market_feedback_end:processing_date_market_feedback_end,
                issue_market_feedback_filter:issue_market_feedback_filter,
                person_in_charge_market_feedback_filter:person_in_charge_market_feedback_filter,
                market_feedback_market_feedback_filter:market_feedback_market_feedback_filter
            },
            success:function(data){
                if(isAppend == 0){
                    $('#market-feedback-data-sale').html(data.view);
                }else if(isAppend == 1){
                    $('#market-feedback-data-sale').append(data.view);
                }
                lastPagemarketFeedback = data.last_page;
            },
            complete: function() {
                readyMarketFeedback = true;
            }
        })
    }

    $('.table-market-feedback').scroll(function(e) {
        if(readyMarketFeedback && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
            readyMarketFeedback = false;
            if(pagemarketFeedback < lastPagemarketFeedback){
                pagemarketFeedback++;
                getmarketFeedbacksFilter(
                    pagemarketFeedback,
                    agent_market_feedback_filter,
                    processing_date_market_feedback_start,
                    processing_date_market_feedback_end,
                    issue_market_feedback_filter,
                    person_in_charge_market_feedback_filter,
                    market_feedback_market_feedback_filter,
                    1);
            }else{
                readyMarketFeedback = true;
            }
        }
    });
    function deleteAllFiltermarketFeedbacks(){
        getmarketFeedbacks(1);
        $('#agent_market_feedback_filter').val('');
        $('#processing_date_market_feedback_start').val('');
        $('#processing_date_market_feedback_end').val('');
        $('#issue_market_feedback_filter').val('');
        $('#person_in_charge_market_feedback_filter').val('');
        $('#market_feedback_market_feedback_filter').val('');
        $('#box_data_customer').scrollTop(0);
    }
    $('#delete_all_market_feedback_fillter').on('click',function(e){
        e.preventDefault();
        deleteAllFiltermarketFeedbacks();
    })


    //curd
    $(document).on('click','.delete-market-feedback-agent',function(e){
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

            if (result.isConfirmed && readyMarketFeedback) {
                readyMarketFeedback =false;
                $.ajax({
                    url:_url,
                    type:'post',
                    data:{
                        _token:"{{csrf_token()}}",
                    },
                    success:function(data){
                        $('#market-feedback-'+id).remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $('#modal_market_feedback').modal('hide');
                    },complete:function(){
                        readyMarketFeedback = true;
                    }
                })
            }
            })
    })
    $(document).on('click','#btn_add_new_market_feedback',function(e){
            e.preventDefault();
            if(readyMarketFeedback){
                readyMarketFeedback = false;

                $.ajax({
                    url:"{{route('crm.ajax.addNewMarketFeedback')}}",
                    type:'get',
                    data:{
                     @if(!empty($agent_id))
                        id: "{{$agent_id}}",
                        @endif
                    },
                    success:function(data){
                        $('#modal_market_feedback_form').html(data);
                        $('#modal_market_feedback').modal('toggle');
                    },
                    complete:function(){
                        readyMarketFeedback = true;
                    }
                })
            }
        })

        $(document).on('click','.btn-submit-market-feedback-form',function(e){
            e.preventDefault();
            let _url = $(this).attr('data-url');
            let _processing_date = $('#processing_date_market_feedback').val();
            let _issue = $('#issue_market_feedback').val();
            let _person_in_charge = $('#person_in_charge_market_feedback').val();
            let _market_feedback = $('#des_market_feedback').val();
            let _agent_id = $('#agent_market_feedback').val();
            if(readyMarketFeedback){
                readyMarketFeedback = false;
                $.ajax({
                    url:_url,
                    type:'post',
                    data:{
                        @if(!empty($agent_id))
                        agent_id: "{{$agent_id}}",
                        @endif
                        _token:"{{csrf_token()}}",
                        processing_date:_processing_date,
                        issue:_issue,
                        person_in_charge:_person_in_charge,
                        market_feedback:_market_feedback,
                        user_id:_agent_id,
                        submit_from:'task_sale'
                    },
                    success:function(data){
                        // console.log(data);
                        // $('#market-feedback-table').html(data);
                        if(data.type == 'create'){
                            pagemarketFeedback = 1;
                            $('#market-feedback-data-sale').html(data.view);
                            lastPagemarketFeedback = data.last_page;
                        }else if(data.type == 'update'){
                            $('#market-feedback-'+data.id).replaceWith(data.view);
                        }
                        toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                        $('#modal_market_feedback').modal('hide');
                    },complete:function(){
                        readyMarketFeedback = true;
                    }
                })
            }
        })
        $(document).on('click','.edit-market-feedback-agent',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var agent_id = $(this).attr('data-agent_id');
            if(readyMarketFeedback){
                readyMarketFeedback = false;
                $.ajax({
                    url:"{{route('crm.ajax.editMarketFeedback')}}",
                    type:'get',
                    data:{
                        id:id,
                        agent_id:agent_id
                    },
                    success:function(data){
                        $('#modal_market_feedback_form').html(data);
                        $('#modal_market_feedback').modal('toggle');
                    },complete:function(){
                        readyMarketFeedback = true;
                    }
                })
            }
        })
        //endcurd
</script>
    @include('CRM.partials.choose_date_onchange_call_function',[
        'idElementInputFlatpick'=>[
            'processing_date_market_feedback_start',
            'processing_date_market_feedback_end'
            ],
        'functionNameCall'=>'debounceAjaxMarketFeedback'
    ])
@endpush
