<script>

    var pageFollowUp = 1;
    var lastPageFollowUp;
    var agent_follow_ups_filter = '';
    var processing_date_follow_ups_start = '';
    var processing_date_follow_ups_end = '';
    var status_follow_ups_filter = '';
    var rating_follow_ups_filter = '';
    var contact_by_follow_ups_filter = '';
    var person_in_charge_follow_ups_filter = '';
    var potential_service_follow_ups_filter_filter;
    var potential_service_follow_ups_filter = '';
    var filter_date_option = '';
    var readyFollowUps = true;
    var due_date_follow_ups_start = '';
    var due_date_follow_ups_end = '';
    var assign_follow_ups = '';
    var follow_ups_status = '';
    var create_by_follow_ups = '';
    var hot_issue_follow_ups = '';
    var arrData = [];

    function getAutoCommment()
    {
        const evtSource = new EventSource("{{route('crm.autoUdpateFormNotifications')}}", { withCredentials: true } );
        evtSource.addEventListener('open', function(event) {
            console.log('Connection was opened');
        }, false);

        evtSource.addEventListener('error', function(event) {
            if (event.eventPhase == EventSource.CLOSED) {
                console.log('> Connection was closed');
            }
        }, false);

        evtSource.addEventListener('ping', function(event) {
            var data = JSON.parse(event.data).view; // or JSON.parse(event.data) if json
            var count = JSON.parse(event.data).count; // or JSON.parse(event.data) if json
            $('#noti_append').html(data);
            $('#event-noti').html(count);

        }, false);
    }

    {{--function getDataCommment()--}}
    {{--{--}}
    {{--    $.ajax({--}}
    {{--        url : "{{route('crm.formNotifications')}}",--}}
    {{--        type : 'get',--}}
    {{--        success: function (data) {--}}
    {{--            $('#noti_append').html(data);--}}
    {{--        },--}}

    {{--    })--}}
    {{--}--}}

    // getDataCommment();
    getAutoCommment();


    function getFollowUps(page) {
        if (!page) {
            page = 1;
        }
        $.ajax({
            url: "{{route('tasks.getFollowUps')}}",
            type: 'get',
            data: {
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page: page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_follow_ups_start: "{{request()->get('report_start_date')}}",
                processing_date_follow_ups_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option:"{{request()->get('filter_date_option')}}",
                @endif
            },
            success: function (data) {
                $('#follow-ups-data-sale').html(data.view);
                lastPageFollowUp = data.last_page;
            }, complete: function () {
                elementDataTime = $('.data_time_color');
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    }

    getFollowUps(1);

    function callAjaxFollowUps(){
        pageFollowUp = 1;
        agent_follow_ups_filter = $('#agent_follow_ups_filter').val();
        processing_date_follow_ups_start = $('#processing_date_follow_ups_start').val();
        processing_date_follow_ups_end = $('#processing_date_follow_ups_end').val();
        status_follow_ups_filter = $('#status_follow_ups_filter').val();
        rating_follow_ups_filter = $('#rating_follow_ups_filter').val();
        contact_by_follow_ups_filter = $('#contact_by_follow_ups_filter').val();
        person_in_charge_follow_ups_filter = $('#person_in_charge_follow_ups_filter').val();
        filter_date_option = $('#filter_date_option').val();
        potential_service_follow_ups_filter_filter = $('#potential_service_follow_ups_filter').val();
        due_date_follow_ups_start = $('#due_date_follow_ups_start').val();
        due_date_follow_ups_end = $('#due_date_follow_ups_end').val();
        assign_follow_ups = $('#assign_follow_ups_filter').val();
        follow_ups_status = $('#follow_ups_status_filter').val();
        create_by_follow_ups = $('#create_by_follow_ups_filter').val();
        hot_issue_follow_ups = $('#hot_issue_follow_ups_filter').val();

        potential_service_follow_ups_filter = (potential_service_follow_ups_filter_filter != "") ? JSON.stringify(potential_service_follow_ups_filter_filter.filter(function (e) {
            return e != '';
        })) : null;
        readyFollowUps = false;
        getFollowUpsFilter(
            pageFollowUp,
            agent_follow_ups_filter,
            processing_date_follow_ups_start,
            processing_date_follow_ups_end,
            status_follow_ups_filter,
            rating_follow_ups_filter,
            contact_by_follow_ups_filter,
            person_in_charge_follow_ups_filter,
            potential_service_follow_ups_filter,
            filter_date_option,
            due_date_follow_ups_start,
            due_date_follow_ups_end,
            assign_follow_ups,
            follow_ups_status,
            create_by_follow_ups,
            hot_issue_follow_ups,
            0);
        $('#follow-ups-data-sale').scrollTop(0);
    }

    function ajaxFollowUps(data){
        if (readyFollowUps) {
            callAjaxFollowUps();
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

    const debounceAjaxFollowUps = debounce(ajaxFollowUps, 300)

    $(document).on('keyup','.table-follow-ups .last-row input',function(e){
        debounceAjaxFollowUps(e.target.value);
    });
    $(document).on('change','.table-follow-ups .last-row select',function(e){
        debounceAjaxFollowUps(e.target.value);
    });
    $(document).on('keypress', function (e) {
        if (e.keyCode == 13 && readyFollowUps) {
            callAjaxFollowUps();
        }
    });

    function getFollowUpsFilter(
        page,
        agent_follow_ups_filter,
        processing_date_follow_ups_start,
        processing_date_follow_ups_end,
        status_follow_ups_filter,
        rating_follow_ups_filter,
        contact_by_follow_ups_filter,
        person_in_charge_follow_ups_filter,
        potential_service_follow_ups_filter,
        filter_date_option,
        due_date_follow_ups_start,
        due_date_follow_ups_end,
        assign_follow_ups,
        follow_ups_status,
        create_by_follow_ups,
        hot_issue_follow_ups,
        isAppend
    ) {

        $.ajax({
            url: "{{route('tasks.getFollowUps')}}",
            type: 'get',
            data: {
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page: page,
                agent_follow_ups_filter: agent_follow_ups_filter,
                processing_date_follow_ups_start: processing_date_follow_ups_start,
                processing_date_follow_ups_end: processing_date_follow_ups_end,
                status_follow_ups_filter: status_follow_ups_filter,
                rating_follow_ups_filter: rating_follow_ups_filter,
                contact_by_follow_ups_filter: contact_by_follow_ups_filter,
                person_in_charge_follow_ups_filter: person_in_charge_follow_ups_filter,
                potential_service_follow_ups_filter: potential_service_follow_ups_filter,
                filter_date_option: filter_date_option,
                due_date_follow_ups_start :due_date_follow_ups_start,
                due_date_follow_ups_end : due_date_follow_ups_end,
                assign_follow_ups : assign_follow_ups,
                follow_ups_status : follow_ups_status,
                create_by_follow_ups : create_by_follow_ups,
                hot_issue_follow_ups : hot_issue_follow_ups
            },
            success: function (data) {
                if (isAppend == 0) {
                    $('#follow-ups-data-sale').html(data.view);
                } else if (isAppend == 1) {
                    $('#follow-ups-data-sale').append(data.view);
                }
                lastPageFollowUp = data.last_page;
            },
            complete: function () {
                readyFollowUps = true;
                console.log($('.data_time_color'));
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    }

    $('.table-follow-ups').scroll(function (e) {
        console.log(pageFollowUp);
        if (readyFollowUps && Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
            readyFollowUps = false;
            if (pageFollowUp < lastPageFollowUp) {
                pageFollowUp++;
                getFollowUpsFilter(
                    pageFollowUp,
                    agent_follow_ups_filter,
                    processing_date_follow_ups_start,
                    processing_date_follow_ups_end,
                    status_follow_ups_filter,
                    rating_follow_ups_filter,
                    contact_by_follow_ups_filter,
                    person_in_charge_follow_ups_filter,
                    potential_service_follow_ups_filter,
                    filter_date_option,
                    due_date_follow_ups_start,
                    due_date_follow_ups_end,
                    assign_follow_ups,
                    follow_ups_status,
                    create_by_follow_ups,
                    hot_issue_follow_ups,
                    1);
            } else {
                readyFollowUps = true;
            }
        }
    });

    function deleteAllFilterFollowUps() {
        getFollowUps(1);
        $('#agent_follow_ups_filter').val('');
        $('#processing_date_follow_ups_start').val('');
        $('#processing_date_follow_ups_end').val('');
        $('#status_follow_ups_filter').val('');
        $('#rating_follow_ups_filter').val('');
        $('#contact_by_follow_ups_filter').val('');
        $('#person_in_charge_follow_ups_filter').val('');
        $('#potential_service_follow_ups_filter').val('');
        $('#filter_date_option').val('');
        $('#due_date_follow_ups_start').val('');
        $('#due_date_follow_ups_end').val('');
        $('#assign_follow_ups_filter').val('');
        $('#follow_ups_status_filter').val('');
        $('#follow-ups-data-sale').scrollTop(0);
        pageFollowUp = 1;
    }

    $('#delete_all_follow_ups_fillter').on('click', function (e) {
        e.preventDefault();
        deleteAllFilterFollowUps();
    })
    //create
    $(document).on('click', '#btn_add_new_follow', function (e) {
        e.preventDefault();
        // var id = $(this).attr('data-id');
        $.ajax({
            url: "{{route('crm.addNewFollow')}}",
            type: 'get',
            data: {
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
            },
            success: function (data) {
                $('#modal_follow_ups_form').html(data);
                $('#modal_follow_up').modal('toggle');
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })

    })
    //end create
    //edit

    $(document).on('click', '.edit-follow-ups-agent', function (e) {
        e.preventDefault();
        let follow_id = $(this).attr('data-id');
        // let _url = $(this).attr('data-url');
        // let
        if (readyFollowUps) {
            readyFollowUps = false
            $.ajax({
                url: "{{route('crm.editFollow')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    follow_id: follow_id,
                },
                type: 'get',
                success: function (data) {
                    $('#modal_follow_ups_form').html(data);
                    $('#modal_follow_up').modal('toggle');
                },
                complete: function () {
                    readyFollowUps = true;
                },
                error: function(xhr){
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                }
            })
        }

    })

    //edit end
    //submit-form
    $(document).on('click', '.btn-submit-follow-up-form', function (e) {
        if ($('#title_task').val() !== '' && $('#task_description_task').val() === '')
        {
            $('#task_description_task_alert').text('Task description is require');
            return;
        }
        e.preventDefault();
        let _url = $(this).attr('data-url');
        let _process_date = $('#process_date_follow_up').val();
        let _status = $('#status_follow_up').val();
        let _rating = $('#rating_follow_up').val();
        let _contact_by = $('#contact_by_follow_up').val();
        let _person_in_charge = $('#person_in_charge_follow_up').val();
        let _potential_service = JSON.stringify($('#potential_service_follow_up').val());
        let _des = $('#des_follow_up').val();
        let _agent_id = $('#agent_follow_up').val();
        let _create_person_follow_up = $('#create_person_follow_up').val();
        let _hotissue = $('#hotissue:checked').val();
        let _title_task = $('#title_task').val();
        let _assigned_person_task = $('#assigned_person_task').val();
        let _follow_up_status_task = $('#follow_up_status_task').val();
        let _due_date_task = $('#due_date_task').val();
        let _time_estitmate_task = $('#time_estitmate_task').val();
        let _task_description_task = $('#task_description_task').val();
        let _staff_create_cm = $('#staff_create_cm').text();
        let _comment = $('#modalComment').text();
        let _send_to_staff_id =  (_create_person_follow_up === _staff_create_cm) ? _assigned_person_task : _create_person_follow_up;
        let _date_comment = $('#dateComment').text();
        if (readyFollowUps) {
            readyFollowUps = false
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                    _token: "{{csrf_token()}}",
                    process_date: _process_date,
                    status: _status,
                    rating: _rating,
                    contact_by: _contact_by,
                    potential_service: _potential_service,
                    des: _des,
                    person_in_charge: _person_in_charge,
                    user_id: _agent_id,
                    submit_from: 'task_sale',
                    create_person: _create_person_follow_up,
                    hot_issue: _hotissue,
                    title_task: _title_task,
                    assigned_person: _assigned_person_task,
                    follow_up_status: _follow_up_status_task,
                    due_date: _due_date_task,
                    estimate: _time_estitmate_task,
                    task_description: _task_description_task,
                    comment : _comment,
                    send_to_staff_id : _send_to_staff_id,
                    date_comment : _date_comment,
                    staff_create_cm : _staff_create_cm
                },
                success: function (data) {
                    if (data.type == 'create') {
                        pageFollowUp = 1;
                        $('#follow-ups-data-sale').html(data.view);
                        lastPageFollowUp = data.last_page;
                    } else if (data.type == 'update') {
                        $('#follow-ups-' + data.id).replaceWith(data.view);
                    }
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                    $('#modal_follow_up').modal('hide');
                },
                complete: function () {
                    readyFollowUps = true;
                },
                error: function(err){
                    if (err.status == 422) {
                        if ('process_date' in err.responseJSON.errors) {
                            $('#process_date_alert').text(err.responseJSON.errors.process_date[0]);
                        }
                        if ('status' in err.responseJSON.errors) {
                            $('#status_alert').text(err.responseJSON.errors.status[0]);
                        }
                        if ('rating' in err.responseJSON.errors) {
                            $('#rating_alert').text(err.responseJSON.errors.rating[0]);
                        }
                        if ('contact_by' in err.responseJSON.errors) {
                            $('#contact_by_alert').text(err.responseJSON.errors.contact_by[0]);
                        }
                        if ('potential_service' in err.responseJSON.errors) {
                            $('#potential_service_alert').text(err.responseJSON.errors.potential_service[0]);
                        }
                        if ('des' in err.responseJSON.errors) {
                            $('#des_alert').text(err.responseJSON.errors.des[0]);
                        }
                        if ('person_in_charge' in err.responseJSON.errors) {
                            $('#person_in_charge_alert').text(err.responseJSON.errors.person_in_charge[0]);
                        }
                        if ('user_id' in err.responseJSON.errors) {
                            $('#user_id_alert').text(err.responseJSON.errors.user_id[0]);
                        }
                        if ('submit_from' in err.responseJSON.errors) {
                            $('#submit_from_alert').text(err.responseJSON.errors.submit_from[0]);
                        }
                        if ('task_description' in err.responseJSON.errors) {
                            $('#task_description_task_alert').text(err.responseJSON.errors.task_description[0]);
                        }
                    }
                }
            })
        }
    })
    //endsubmit
    //delete
    $(document).on('click', '.delete-follow-ups-agent', function (e) {
        e.preventDefault();
        let follow_id = $(this).attr('data-id');
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
            if (result.isConfirmed && readyFollowUps) {
                readyFollowUps = false
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#follow-ups-' + data.id).remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    },
                    complete: function () {
                        readyFollowUps = true;
                    },
                    error: function(xhr){
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    }
                })
            }
        })
    })
    //delete end

    //export to excel
    $('#export_to_excel_follow_up').on('click', function (e) {
        e.preventDefault();
        var urlDefault = "{{route('crm.follow-up.export-to-excel',[
                'agent_follow_ups_filter'=>'agent_follow_ups_filter_data',
                'processing_date_follow_ups_start'=> 'processing_date_follow_ups_start_data',
                'processing_date_follow_ups_end'=> 'processing_date_follow_ups_end_data',
                'status_follow_ups_filter'=> 'status_follow_ups_filter_data',
                'rating_follow_ups_filter'=> 'rating_follow_ups_filter_data',
                'contact_by_follow_ups_filter'=> 'contact_by_follow_ups_filter_data',
                'person_in_charge_follow_ups_filter'=> 'person_in_charge_follow_ups_filter_data',
                'potential_service_follow_ups_filter'=> 'potential_service_follow_ups_filter_data',
                'filter_date_option'=> 'filter_date_option_data'
            ])}}";
        var url = urlDefault.replace('agent_follow_ups_filter_data',agent_follow_ups_filter);
        url = url.replace('processing_date_follow_ups_start_data',processing_date_follow_ups_start);
        url = url.replace('processing_date_follow_ups_end_data',processing_date_follow_ups_end);
        url = url.replace('status_follow_ups_filter_data',status_follow_ups_filter);
        url = url.replace('rating_follow_ups_filter_data',rating_follow_ups_filter);
        url = url.replace('contact_by_follow_ups_filter_data',contact_by_follow_ups_filter);
        url = url.replace('person_in_charge_follow_ups_filter_data',person_in_charge_follow_ups_filter);
        url = url.replace('potential_service_follow_ups_filter_data',potential_service_follow_ups_filter);
        url = url.replace('filter_date_option_data',filter_date_option);
        url = url.replace(/amp;/g,'');
        console.log(url);
        $.ajax({
            url:url,
            type: 'get',
            data: {
                agent_follow_ups_filter: agent_follow_ups_filter,
                processing_date_follow_ups_start: processing_date_follow_ups_start,
                processing_date_follow_ups_end: processing_date_follow_ups_end,
                status_follow_ups_filter: status_follow_ups_filter,
                rating_follow_ups_filter: rating_follow_ups_filter,
                contact_by_follow_ups_filter: contact_by_follow_ups_filter,
                person_in_charge_follow_ups_filter: person_in_charge_follow_ups_filter,
                potential_service_follow_ups_filter: potential_service_follow_ups_filter,
                filter_date_option: filter_date_option,
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                window.location = url;
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    })
    //end excel

    //pdf
    $('#export_to_pdf_follow_up').on('click',function(e){
        e.preventDefault();
        var urlDefault = "{{route('crm.follow-up.export-to-pdf',[
                'agent_follow_ups_filter'=>'agent_follow_ups_filter_data',
                'processing_date_follow_ups_start'=> 'processing_date_follow_ups_start_data',
                'processing_date_follow_ups_end'=> 'processing_date_follow_ups_end_data',
                'status_follow_ups_filter'=> 'status_follow_ups_filter_data',
                'rating_follow_ups_filter'=> 'rating_follow_ups_filter_data',
                'contact_by_follow_ups_filter'=> 'contact_by_follow_ups_filter_data',
                'person_in_charge_follow_ups_filter'=> 'person_in_charge_follow_ups_filter_data',
                'potential_service_follow_ups_filter'=> 'potential_service_follow_ups_filter_data',
                'filter_date_option'=> 'filter_date_option_data'
            ])}}";
        var url = urlDefault.replace('agent_follow_ups_filter_data',agent_follow_ups_filter);
        url = url.replace('processing_date_follow_ups_start_data',processing_date_follow_ups_start);
        url = url.replace('processing_date_follow_ups_end_data',processing_date_follow_ups_end);
        url = url.replace('status_follow_ups_filter_data',status_follow_ups_filter);
        url = url.replace('rating_follow_ups_filter_data',rating_follow_ups_filter);
        url = url.replace('contact_by_follow_ups_filter_data',contact_by_follow_ups_filter);
        url = url.replace('person_in_charge_follow_ups_filter_data',person_in_charge_follow_ups_filter);
        url = url.replace('potential_service_follow_ups_filter_data',potential_service_follow_ups_filter);
        url = url.replace('filter_date_option_data',filter_date_option);
        url = url.replace(/amp;/g,'');
        console.log(url);
        $.ajax({
            url:url,
            type: 'get',
            data: {
                agent_follow_ups_filter: agent_follow_ups_filter,
                processing_date_follow_ups_start: processing_date_follow_ups_start,
                processing_date_follow_ups_end: processing_date_follow_ups_end,
                status_follow_ups_filter: status_follow_ups_filter,
                rating_follow_ups_filter: rating_follow_ups_filter,
                contact_by_follow_ups_filter: contact_by_follow_ups_filter,
                person_in_charge_follow_ups_filter: person_in_charge_follow_ups_filter,
                potential_service_follow_ups_filter: potential_service_follow_ups_filter,
                filter_date_option: filter_date_option,
                _token: "{{csrf_token()}}"
            },
            success: function (data) {
                window.location = url;
            },
            error: function(xhr){
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    })
    //end pdf
</script>
