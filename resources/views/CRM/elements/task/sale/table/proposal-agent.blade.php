
<div class="table-proposal table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">
                <th class="width-80">Action</th>
                <th class="width-200">Agent</th>
                <th class="width-220">Processing date</th>
                <th class="width-200">Issue</th>
                <th class="width-200">Person in charge</th>
                <th class="width-200">Created by</th>
                <th class="width-500">Proposal Feedback</th>
            </tr>
            <tr class="last-row">
                <th></th>
                <th>
                    <input type="text" class="form-control" id="agent_proposal_filter" placeholder="Agent">
                </th>
                <th class="d-flex">
                    <input type="text" class="form-control mr-2" id="processing_date_proposal_start" placeholder="Date start">
                    <input type="text" class="form-control" id="processing_date_proposal_end" placeholder="Date end">
                </th>
                <th>
                    <select name="" id="issue_proposal_filter" class="form-control">
                        <option value="">Status</option>
                        @foreach(config('myconfig.issue_proposal_agent') as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select name="" id="person_in_charge_proposal_filter" class="form-control">
                        <option value="">Person in charge</option>
                        @foreach($admins as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select name="" id="create_person_proposal_filter" class="form-control">
                        <option value=""></option>
                        @foreach($admins as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="proposal-data-sale">

        </tbody>
    </table>

</div>
<div id="modal_proposal_form"></div>

@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
    'processing_date_proposal'
]])
<script>
    var pageproposal = 1;
    var lastPageproposal ;
    var agent_proposal_filter = '';
    var processing_date_proposal_start = '';
    var processing_date_proposal_end = '';
    var issue_proposal_filter = '';
    var person_in_charge_proposal_filter = '';
    var proposal_proposal_filter = '';
    var readyproposal = true;
    var arrData = [];
    function getproposals(page){
        if(!page){
            page = 1;
        }
        $.ajax({
            url:"{{route('tasks.getProposals')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_proposal_start: "{{request()->get('report_start_date')}}",
                processing_date_proposal_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option:"{{request()->get('filter_date_option')}}",
                @endif
            },
            success:function(data){
                // html = '';
                // $.each(data.data, function( index, value ) {
                //     // agentNameproposal = value.agent != null?value.agent.name:'';
                //     html += '<tr>'
                //     html += '<th>'+value.agent_name+'</th>'
                //     html += '<td>'+value.processing_date+'</td>'
                //     html += '<td>'+value.issue+'</td>'
                //     html += '<td>'+value.person_in_charge+'</td>'
                //     html += '<td class="white-space-break-spaces">'+value.proposal+'</td>'
                //     html += '</tr>'
                // });
                $('#proposal-data-sale').html(data.view);
                lastPageproposal = data.last_page;
                // white-space-break-spaces
            }
        })
    }
    getproposals();

    function callAjaxProposal(){
        readyproposal = false;
        pageproposal = 1;
        agent_proposal_filter = $('#agent_proposal_filter').val();
        processing_date_proposal_start = $('#processing_date_proposal_start').val();
        processing_date_proposal_end = $('#processing_date_proposal_end').val();
        issue_proposal_filter = $('#issue_proposal_filter').val();
        person_in_charge_proposal_filter = $('#person_in_charge_proposal_filter').val();
        proposal_proposal_filter = $('#proposal_proposal_filter').val();
        create_person_proposal_filter = $('#create_person_proposal_filter').val();
        getproposalsFilter(
            pageproposal,
            agent_proposal_filter,
            processing_date_proposal_start,
            processing_date_proposal_end,
            issue_proposal_filter,
            person_in_charge_proposal_filter,
            proposal_proposal_filter,
            create_person_proposal_filter
            ,0);
        $('#box_data_customer').scrollTop(0);
    }
    function ajaxProposal(data) {
        if (readyproposal) {
            callAjaxProposal()
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

    const debounceAjaxProposal = debounce(ajaxProposal, 300)

    $(document).on('keyup', '.table-proposal .last-row input', function (e) {
        debounceAjaxProposal(e.target.value);
    })
    $(document).on('change', '.table-proposal .last-row select', function (e) {
        debounceAjaxProposal(e.target.value);
    })

    //$(document).on('keypress',function(e){
    //    if(e.keyCode == 13 && readyproposal && hoverTable == 'proposal'){
    //        callAjaxProposal();
    //    }
    //});
    function getproposalsFilter(
        page,
        agent_proposal_filter,
        processing_date_proposal_start,
        processing_date_proposal_end,
        issue_proposal_filter,
        person_in_charge_proposal_filter,
        proposal_proposal_filter,
        create_person_proposal_filter,
        isAppend
        ){

        $.ajax({
            url:"{{route('tasks.getProposals')}}",
            type:'get',
            data:{
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page:page,
                agent_proposal_filter:agent_proposal_filter,
                processing_date_proposal_start:processing_date_proposal_start,
                processing_date_proposal_end:processing_date_proposal_end,
                issue_proposal_filter:issue_proposal_filter,
                person_in_charge_proposal_filter:person_in_charge_proposal_filter,
                proposal_proposal_filter:proposal_proposal_filter,
                create_person_proposal_filter:create_person_proposal_filter
            },
            success:function(data){
                console.log(data);
                //html = '';
                //$.each(data.data, function( index, value ) {
                //    // agentNameproposal = value.agent != null?value.agent.name:'';
                //    html += '<tr>'
                //    html += '<th>'+value.agent_name+'</th>'
                //    html += '<td>'+value.processing_date+'</td>'
                //    html += '<td>'+value.issue+'</td>'
                //    html += '<td>'+value.person_in_charge+'</td>'
                //    html += '<td class="white-space-break-spaces">'+value.proposal+'</td>'
                //    html += '</tr>'
                //});
                if(isAppend == 0){
                    $('#proposal-data-sale').html(data.view);
                }else if(isAppend == 1){
                    $('#proposal-data-sale').append(data.view);
                }
                lastPageproposal = data.last_page;
            },
            complete: function() {
                readyproposal = true;
            }
        })
    }

    $('.table-proposal').scroll(function(e) {
        if(readyproposal && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
            readyproposal = false;
            if(pageproposal < lastPageproposal){
                pageproposal++;
                getproposalsFilter(
                    pageproposal,
                    agent_proposal_filter,
                    processing_date_proposal_start,
                    processing_date_proposal_end,
                    issue_proposal_filter,
                    person_in_charge_proposal_filter,
                    proposal_proposal_filter,
                    1);
            }else{
                readyproposal = true;
            }
        }
    });
    function deleteAllFilterproposals(){
        getproposals(1);
        $('#agent_proposal_filter').val('');
        $('#processing_date_proposal_start').val('');
        $('#processing_date_proposal_end').val('');
        $('#issue_proposal_filter').val('');
        $('#person_in_charge_proposal_filter').val('');
        $('#proposal_proposal_filter').val('');
        $('#box_data_customer').scrollTop(0);
    }
    $('#delete_all_proposal_fillter').on('click',function(e){
        e.preventDefault();
        deleteAllFilterproposals();
    })

    //crud
    $(document).on('click','.delete-proposal-agent',function(e){
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

                if (result.isConfirmed && readyproposal) {
                    readyproposal = false;
                    $.ajax({
                        url:_url,
                        type:'post',
                        data:{
                            _token:"{{csrf_token()}}",
                        },
                        success:function(data){
                            $('#proposals-'+id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $('#modal_proposal').modal('hide');
                        },complete:function(){
                            readyproposal = true;
                        }
                    })
                }
                })
        })
        $(document).on('click','#btn_add_new_proposal',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            if(readyproposal){
                readyproposal = false;
                $.ajax({
                    url:"{{route('crm.ajax.addNewProposal')}}",
                    type:'get',
                    data:{
                        @if(!empty($agent_id))
                        id: "{{$agent_id}}",
                        @endif
                    },
                    success:function(data){
                        $('#modal_proposal_form').html(data);
                        $('#modal_proposal').modal('toggle');
                    },complete:function(){
                        readyproposal = true;
                    }
                })
            }
            // }else{
            //     alert('No data selected !');
            // }
        })

        $(document).on('click','.btn-submit-proposal-form',function(e){
            e.preventDefault();
            let _url = $(this).attr('data-url');
            let _processing_date = $('#processing_date_proposal').val();
            let _issue = $('#issue_proposal').val();
            let _person_in_charge = $('#person_in_charge_proposal').val();
            let _proposal = $('#des_proposal').val();
            let _agent_id = $('#agent_follow_up').val();
            let _create_person_proposal = $('#create_person_proposal').val();
            if(readyproposal){
                readyproposal=false;
                $.ajax({
                    url:_url,
                    type:'post',
                    data:{
                        _token:"{{csrf_token()}}",
                        processing_date:_processing_date,
                        issue:_issue,
                        person_in_charge:_person_in_charge,
                        proposal:_proposal,
                        user_id:_agent_id,
                        create_person:_create_person_proposal,
                        submit_from:'task_sale'
                    },
                    success:function(data){
                        // console.log(data);
                        if(data.type == 'create'){
                            pageproposal = 1;
                            $('#proposal-data-sale').html(data.view);
                            lastPageproposal = data.last_page;
                        }else if(data.type == 'update'){
                            $('#proposals-'+data.id).replaceWith(data.view);
                        }
                        // $('#proposal-table').html(data);
                        toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                        $('#modal_proposal').modal('hide');
                    },complete:function(){
                        readyproposal = true;
                    }
                })
            }
        })
        $(document).on('click','.edit-proposal-agent',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var agent_id = $(this).attr('data-agent_id');
            if(readyproposal){
                readyproposal = false;

                $.ajax({
                    url:"{{route('crm.ajax.editProposal')}}",
                    type:'get',
                    data:{
                        id:id,
                        agent_id:agent_id
                    },
                    success:function(data){
                        $('#modal_proposal_form').html(data);
                        $('#modal_proposal').modal('toggle');
                    },complete:function(){
                        readyproposal = true;
                    }
                })
            }
        })
    //end curd
</script>
@include('CRM.partials.choose_date_onchange_call_function',[
'idElementInputFlatpick'=>[
    'processing_date_proposal_start',
    'processing_date_proposal_end'
],
'functionNameCall'=>'debounceAjaxProposal'
])
@endpush
