<div class="table-{{$typeTask}} table-div">
    <table class="">
        <thead class="">
            <tr class="first-row">
                <th class="width-80">Action</th>
                <th class="width-220">Processing date</th>
                <th class="width-200">Item</th>
                <th class="width-200">Type</th>
                <th class="width-200">Agent</th>
                <th class="width-200">Assignee</th>
                <th class="width-220">Deadline</th>
                <th class="width-500">Note</th>
            </tr>
            <tr class="last-row">
                <th>
                </th>
                <th>
                    <div class="d-flex">
                        <input type="text" class="form-control mr-2" id="processing_date_{{$typeTask}}_start" placeholder="Date start">
                        <input type="text" class="form-control" id="processing_date_{{$typeTask}}_end" placeholder="Date end">
                    </div>
                </th>
                <th>
                    {{-- <input type="text" class="form-control" id="item_{{$typeTask}}_filter" placeholder="Item"> --}}
                </th>
                <th>
                    <select name="" id="type_{{$typeTask}}_filter" class="form-control">
                        <option value="">Type</option>
                        @foreach($saleTaskAssignType as $key=>$status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select name="" id="user_id_{{$typeTask}}_filter" class="form-control">
                        <option value=""></option>
                        @if(!empty($agents))
                            @foreach($agents as $keyStatus=>$valueStatus)
                                <option value="{{$keyStatus}}">{{$valueStatus}}</option>
                            @endforeach
                        @endif
                    </select>
                </th>
                <th>
                    <select name="" id="asigned_{{$typeTask}}_filter" class="form-control">
                        <option value="">Asigned by</option>
                        @foreach($admins as $key=>$status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <div class="d-flex">
                        <input type="text" class="form-control mr-2" id="deadline_{{$typeTask}}_start" placeholder="Date start">
                        <input type="text" class="form-control" id="deadline_{{$typeTask}}_end" placeholder="Date end">
                    </div>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="{{$typeTask}}-data-sale">

        </tbody>
    </table>
</div>
<div id="{{$typeTask}}-sale-modal"></div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'processing_date_'.$typeTask.'_start',
        'processing_date_'.$typeTask.'_end',
        'deadline_'.$typeTask.'_start',
        'deadline_'.$typeTask.'_end',
        'processing_date_'.$typeTask.'',
        'deadline_'.$typeTask.''
    ]]);
    <script>
        //load
        var page{{$typeTask}} = 1
        var lastPage{{$typeTask}} ;
        var item_{{$typeTask}}_filter = ''
        var processing_date_{{$typeTask}}_start = ''
        var processing_date_{{$typeTask}}_end = ''
        var type_{{$typeTask}}_filter = ''
        var deadline_{{$typeTask}}_start = ''
        var deadline_{{$typeTask}}_end = ''
        var asigned_{{$typeTask}}_filter = ''
        var user_id_{{$typeTask}}_filter = ''
        var ready{{$typeTask}} = true
        var arrData = []

        function get{{$typeTask}}s(page) {
            if (!page) {
                page = 1
            }
            $.ajax({
                url: "{{route('tasks.getSaleTaskAssign')}}",
                type: 'get',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                    @if(!empty($dataOnly))
                        data_type:'agent',
                    @endif
                    page: page,
                    type_table: '{{$typeTask_id}}',
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    processing_date_sale_task_assign_start: "{{request()->get('report_start_date')}}",
                    processing_date_sale_task_assign_end: "{{request()->get('report_end_date')}}",
                    @endif
                        @if(request()->get('filter_date_option'))
                    filter_date_option: "{{request()->get('filter_date_option')}}",
                    @endif
                },
                success: function (data) {
                    $('#{{$typeTask}}-data-sale').html(data.view)
                    lastPage{{$typeTask}} = data.last_page
                },
                complete: function () {
                    ready{{$typeTask}} = true
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }

        get{{$typeTask}}s()

        function callAjaxTaskAsigned() {
            ready{{$typeTask}} = false
            pageCustomer = 1
            page{{$typeTask}} = 1
            item_{{$typeTask}}_filter = $('#item_{{$typeTask}}_filter').val()
            processing_date_{{$typeTask}}_start = $('#processing_date_{{$typeTask}}_start').val()
            processing_date_{{$typeTask}}_end = $('#processing_date_{{$typeTask}}_end').val()
            type_{{$typeTask}}_filter = $('#type_{{$typeTask}}_filter').val()
            deadline_{{$typeTask}}_start = $('#deadline_{{$typeTask}}_start').val()
            deadline_{{$typeTask}}_end = $('#deadline_{{$typeTask}}_end').val()
            asigned_{{$typeTask}}_filter = $('#asigned_{{$typeTask}}_filter').val()
            user_id_{{$typeTask}}_filter = $('#user_id_{{$typeTask}}_filter').val()
            get{{$typeTask}}sFilter(
                pageCustomer,
                item_{{$typeTask}}_filter,
                processing_date_{{$typeTask}}_start,
                processing_date_{{$typeTask}}_end,
                type_{{$typeTask}}_filter,
                deadline_{{$typeTask}}_start,
                deadline_{{$typeTask}}_end,
                asigned_{{$typeTask}}_filter,
                user_id_{{$typeTask}}_filter,
                0)
            $('#box_data_customer').scrollTop(0)
        }

        function ajaxTaskAsigned(data) {
            if (ready{{$typeTask}}) {
                callAjaxTaskAsigned()
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

        const debounceAjaxTaskAsigned = debounce(ajaxTaskAsigned, 300)

        $(document).on('keyup', '.table-{{$typeTask}} .last-row input', function (e) {
            debounceAjaxTaskAsigned(e.target.value)
        })
        $(document).on('change', '.table-{{$typeTask}} .last-row select', function (e) {
            debounceAjaxTaskAsigned(e.target.value)
        })

        $(document).on('keypress', function (e) {
            if (e.keyCode == 13 && ready{{$typeTask}} && hoverTable == '{{$typeTask}}') {
                ready{{$typeTask}} = false
                pageCustomer = 1
                page{{$typeTask}} = 1
                item_{{$typeTask}}_filter = $('#item_{{$typeTask}}_filter').val()
                processing_date_{{$typeTask}}_start = $('#processing_date_{{$typeTask}}_start').val()
                processing_date_{{$typeTask}}_end = $('#processing_date_{{$typeTask}}_end').val()
                type_{{$typeTask}}_filter = $('#type_{{$typeTask}}_filter').val()
                deadline_{{$typeTask}}_start = $('#deadline_{{$typeTask}}_start').val()
                deadline_{{$typeTask}}_end = $('#deadline_{{$typeTask}}_end').val()
                asigned_{{$typeTask}}_filter = $('#asigned_{{$typeTask}}_filter').val()
                get{{$typeTask}}sFilter(
                    pageCustomer,
                    item_{{$typeTask}}_filter,
                    processing_date_{{$typeTask}}_start,
                    processing_date_{{$typeTask}}_end,
                    type_{{$typeTask}}_filter,
                    deadline_{{$typeTask}}_start,
                    deadline_{{$typeTask}}_end,
                    asigned_{{$typeTask}}_filter,
                    0)
                $('#box_data_customer').scrollTop(0)
            }
        })

        function get{{$typeTask}}sFilter(
            page,
            item_{{$typeTask}}_filter,
            processing_date_{{$typeTask}}_start,
            processing_date_{{$typeTask}}_end,
            type_{{$typeTask}}_filter,
            deadline_{{$typeTask}}_start,
            deadline_{{$typeTask}}_end,
            asigned_{{$typeTask}}_filter,
            user_id_{{$typeTask}}_filter,
            isAppend,
        ) {

            $.ajax({
                url: "{{route('tasks.getSaleTaskAssign')}}",
                type: 'get',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                        @if(!empty($dataOnly))
                    data_type:'agent',
                    @endif
                    page: page,
                    item_sale_task_assign_filter: item_{{$typeTask}}_filter,
                    processing_date_sale_task_assign_start: processing_date_{{$typeTask}}_start,
                    processing_date_sale_task_assign_end: processing_date_{{$typeTask}}_end,
                    type_sale_task_assign_filter: type_{{$typeTask}}_filter,
                    deadline_sale_task_assign_start: deadline_{{$typeTask}}_start,
                    deadline_sale_task_assign_end: deadline_{{$typeTask}}_end,
                    asigned_sale_task_assign_filter: asigned_{{$typeTask}}_filter,
                    type_table: '{{$typeTask_id}}',
                    user_id_filter:user_id_{{$typeTask}}_filter
                },
                success: function (data) {
                    if (isAppend == 0) {
                        $('#{{$typeTask}}-data-sale').html(data.view)
                    } else if (isAppend == 1) {
                        $('#{{$typeTask}}-data-sale').append(data.view)
                    }
                    lastPage{{$typeTask}} = data.last_page
                },
                complete: function () {
                    ready{{$typeTask}} = true
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }

        $('.table-{{$typeTask}}').scroll(function (e) {
            if (ready{{$typeTask}} && Math.round($(this).scrollTop() + $(this)
                .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
                ready{{$typeTask}} = false
                if (page{{$typeTask}} < lastPage{{$typeTask}}) {
                    page{{$typeTask}}++
                    get{{$typeTask}}sFilter(
                        page{{$typeTask}},
                        item_{{$typeTask}}_filter,
                        processing_date_{{$typeTask}}_start,
                        processing_date_{{$typeTask}}_end,
                        type_{{$typeTask}}_filter,
                        deadline_{{$typeTask}}_start,
                        deadline_{{$typeTask}}_end,
                        asigned_{{$typeTask}}_filter,
                        user_id_{{$typeTask}}_filter,
                        1)
                } else {
                    ready{{$typeTask}} = true
                }
            }
        })

        function deleteAllFilter{{$typeTask}}s() {
            get{{$typeTask}}s(1)
            $('#item_{{$typeTask}}_filter').val('')
            $('#processing_date_{{$typeTask}}_start').val('')
            $('#processing_date_{{$typeTask}}_end').val('')
            $('#type_{{$typeTask}}_filter').val('')
            $('#deadline_{{$typeTask}}_start').val('')
            $('#deadline_{{$typeTask}}_end').val('')
            $('#asigned_{{$typeTask}}_filter').val('')
            $('#user_id_{{$typeTask}}_filter').val('')
            $('#box_data_customer').scrollTop(0)
        }

        $('#delete_all_{{$typeTask}}_fillter').on('click', function (e) {
            e.preventDefault()
            deleteAllFilter{{$typeTask}}s()
        })

        //end load
        //create
        $(document).on('click', '#create_{{$typeTask}}_sale', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            if (isClick == 'false') {
                $(this).attr('is-click', true)
                $.ajax({
                    url: '{{route("tasks.createSaleTaskAssign")}}',
                    type: 'get',
                    data: {
                        type_table: '{{$typeTask_id}}',
                        @if(!empty($agent_id))
                        agent_id: "{{$agent_id}}",
                        @endif
                            @if(!empty($dataOnly))
                        data_type:'agent',
                        @endif
                    },
                    success: function (data) {
                        $('#{{$typeTask}}-sale-modal').html(data)
                        $('#modal_{{$typeTask}}').modal('toggle')
                    },
                    complete: function () {
                        element.attr('is-click', false)
                    },
                    error: function(xhr){
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    }
                })
            }

        })
        //end create
        //update
        $(document).on('click', '.edit-{{$typeTask}}-agent', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            var id = $(this).attr('data-id')
            var urlEdit = '{{route("tasks.editSaleTaskAssign",["id"=>"sale_task_assign_id"])}}'
            url = urlEdit.replace('sale_task_assign_id', id)
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    type_table: '{{$typeTask_id}}',
                    agent_id: "{{(!empty($agent_id) ? $agent_id : '')}}",
                },
                success: function (data) {
                    $('#{{$typeTask}}-sale-modal').html(data)
                    $('#modal_{{$typeTask}}').modal('toggle')
                },
                complete: function () {
                    element.attr('is-click', false)
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        })
        //end update
        //submit form
        $(document).on('click', '.btn-submit-{{$typeTask}}-form', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            var url = $(this).attr('data-url')
            var processing_date_{{$typeTask}} = $('#processing_date_{{$typeTask}}').val()
            var type_{{$typeTask}} = $('#type_{{$typeTask}}').val()
            var deadline_{{$typeTask}} = $('#deadline_{{$typeTask}}').val()
            var asigned_{{$typeTask}} = $('#asigned_{{$typeTask}}').val()
            var des_item_{{$typeTask}} = $('#des_item_{{$typeTask}}').val()
            var des_note_{{$typeTask}} = $('#des_note_{{$typeTask}}').val()
            var user_id_{{$typeTask}} = $('#user_id_{{$typeTask}}').val()
            var user_id_{{$typeTask}} = $('#user_id_{{$typeTask}}').val()
            var person_in_charge = $('#person_in_charge').val()
            var hotissue = $('#hotissue:checked').val();
            var assigned_person = $('#assigned_person_task').val();
            var follow_up_status = $('#follow_up_status_task').val();
            var time_estitmate = $('#time_estitmate_task').val();
            var id = $(this).attr('data-id');
            var type_of_status_choose_agent_id = {{$saleTaskAssignType->where('is_success',1)->pluck('id')->first()}};
            var validationForm = false
            if (type_{{$typeTask}} == type_of_status_choose_agent_id) {
                if (user_id_{{$typeTask}}) {
                    validationForm = true
                    $('#user_id_{{$typeTask}}_alert_message').text('')
                } else {
                    validationForm = false
                    $('#user_id_{{$typeTask}}_alert_message').text('User id is required')
                }
            } else {
                validationForm = true
            }
            if (isClick == 'false' && validationForm) {
                element.attr('is-click', true)
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        @if(!empty($agent_id))
                        agent_id: "{{$agent_id}}",
                        @endif
                            @if(!empty($dataOnly))
                        data_type:'agent',
                        @endif
                        processing_date: processing_date_{{$typeTask}},
                        type: type_{{$typeTask}},
                        deadline: deadline_{{$typeTask}},
                        assigned_by: asigned_{{$typeTask}},
                        item: des_item_{{$typeTask}},
                        note: des_note_{{$typeTask}},
                        _token: '{{csrf_token()}}',
                        type_table: "{{$typeTask_id}}",
                        user_id:user_id_{{$typeTask}},
                        person_in_charge:person_in_charge,
                        hot_issue:hotissue,
                        assigned_person:assigned_person,
                        follow_up_status:follow_up_status,
                        estimate:time_estitmate
                    },
                    success: function (data) {
                        if (data.id) {
                            $('#{{$typeTask}}_' + data.id).replaceWith(data.view)
                        } else {
                            $('#{{$typeTask}}-data-sale').html(data.view)
                        }
                        $('#modal_{{$typeTask}}').modal('hide')
                    },
                    complete: function () {
                        element.attr('is-click', false)
                    },
                    error: function(xhr){
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    }
                })
            }
        })
        //end submit form
        //delete
        $(document).on('click', '.delete-{{$typeTask}}-agent', function (e) {
            e.preventDefault()
            var id = $(this).attr('data-id')
            var url = $(this).attr('data-url')
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        data: {
                            _token: '{{csrf_token()}}',
                            type_table: "{{$typeTask_id}}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            )
                            $('#{{$typeTask}}_' + data.id).remove()
                        },
                        error: function(xhr){
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                        }
                    })

                }
            })

        })
        //end delete
        $(document).on('change', '#type_{{$typeTask}}', function (e) {
            e.preventDefault()
            status = $('option:selected', this).attr('data-status')
            if (status == 1) {
                $('#agent_selected_by_type_{{$typeTask}}').removeClass('d-none').addClass('d-block');
            } else {
                $('#agent_selected_by_type_{{$typeTask}}').removeClass('d-block').addClass('d-none');
            }
            $('#user_id_{{$typeTask}}').val('');
        })
    </script>
    @include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'processing_date_'.$typeTask.'_start',
        'processing_date_'.$typeTask.'_end',
        'deadline_'.$typeTask.'_start',
        'deadline_'.$typeTask.'_end',
    ],
    'functionNameCall'=>'debounceAjaxTaskAsigned'
    ])
@endpush
