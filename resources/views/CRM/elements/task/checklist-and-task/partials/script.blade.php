@include('CRM.partials.choose_date',['ids'=>[
    'date_of_suggestion'.$type,
    'checklist_created_at'.$type,
    'processing_time'.$type,
    'date_of_suggestion_filter'.$type,
    'checklist_created_at_filter'.$type,
    'processing_time_filter'.$type
]])
<script>
    $(document).on('click', '.show-view-detail', function(e) {
        $.fancybox({
            'type':'inline',
            'href' : `${e.target.getAttribute('href')}`,
            'width': 800, //or whatever you want
            'height': 300
        });
    });
    $(document).on('change', '#type_id{{$type}}', function (e) {
        var selectValue = $(this).val();
        $('#website_id{{$type}}').html('');
        $('#category_id{{$type}}').html('');
        $.ajax({
            url:'{{route('check-list.getValueByType')}}',
            data:{
                type:selectValue,
                _token:'{{csrf_token()}}'
            },
            type:'get',
            success:function(data){
                $('#website_id{{$type}}').html(data);
            }
        })
    })
    $(document).on('change', '#website_id{{$type}}', function (e) {
        var selectValue = $(this).val();
        $.ajax({
            url:'{{route('check-list.getValueByType')}}',
            data:{
                type:selectValue,
                _token:'{{csrf_token()}}'
            },
            type:'get',
            success:function(data){
                $('#category_id{{$type}}').html(data);
            }
        })

        {{--var value = $(this).find(":selected").attr('data-value');--}}
        {{--var arrValue;--}}
        {{--if (value) {--}}
        {{--    arrValue = JSON.parse(value);--}}
        {{--} else {--}}
        {{--    arrValue = [];--}}
        {{--}--}}
        {{--html = '';--}}
        {{--$.each(arrValue, function (index, value) {--}}
        {{--    html += '<option value="' + parseInt(index + 1) + '">' + value + '</option>';--}}
        {{--});--}}
        {{--$('#category_id{{$type}}').html(html);--}}
    })
    $(document).on('change', '#type_id_filter{{$type}}', function (e) {
        var selectValue = $(this).val();
        $('#website_id_filter{{$type}}').html('');
        $('#category_id_filter{{$type}}').html('');
        $.ajax({
            url:'{{route('check-list.getValueByType')}}',
            data:{
                type:selectValue,
                _token:'{{csrf_token()}}'
            },
            type:'get',
            success:function(data){
                $('#website_id_filter{{$type}}').html(data);
            }
        })
    })
    $(document).on('change', '#website_id_filter{{$type}}', function (e) {
        var selectValue = $(this).val();
        $.ajax({
            url:'{{route('check-list.getValueByType')}}',
            data:{
                type:selectValue,
                _token:'{{csrf_token()}}'
            },
            type:'get',
            success:function(data){
                $('#category_id_filter{{$type}}').html(data);
            }
        })
    })




    //curd
    var page{{$type}} = 1;
    var lastPage{{$type}};
    var ready{{$type}} = true;
    var arrData = [];
    var groupId;
    var hoverTableCheckListAndTask;
    //filter
    var group_id_filter{{$type}};
    var type_id_filter{{$type}};
    var detail_filter{{$type}};
    var website_id_filter{{$type}};
    var category_id_filter{{$type}};
    var person_id_filter{{$type}};
    var problem_filter{{$type}};
    var date_of_suggestion_filter{{$type}};
    var solution_text_filter{{$type}};
    var level_of_process_filter{{$type}};
    var result_id_filter{{$type}};
    var processing_time_filter{{$type}};
    var budget_filter{{$type}};
    var checklist_created_at_filter{{$type}};
    var assigned_by_filter{{$type}};
    $(document).on('mouseover','#check-list-tab-content',function(e){
        hoverTableCheckListAndTask = 'checklist';
    });
    $(document).on('mouseover','#task-tab-content',function(e){
        hoverTableCheckListAndTask = 'task';
    });
    function get{{$type}}(page, groupId) {
        if (!page) {
            page = 1;
        }
        if (!groupId) {
            groupId = $('#myGroupList{{$type}} .nav-item .active').attr('data-id');
        }
        $.ajax({
            url: "{{route('check-list.getData')}}",
            type: 'get',
            data: {
                page: page,
                group_id: groupId,
                type:"{{$type}}"
            },
            success: function (data) {
                $('#{{$type}}-table-tbody').html(data.view);
                lastPage{{$type}} = data.last_page;
            }
        })
    }

    get{{$type}}();
    function callAjax{{$type}}(){
        ready{{$type}} = false;
        page{{$type}} = 1;
        group_id_filter{{$type}} = $('#myGroupList{{$type}} .nav-item .active').attr('data-id');
        type_id_filter{{$type}} = $('#type_id_filter{{$type}}').val();
        detail_filter{{$type}} = $('#detail_filter{{$type}}').val();
        website_id_filter{{$type}} = $('#website_id_filter{{$type}}').val();
        category_id_filter{{$type}} = $('#category_id_filter{{$type}}').val();
        person_id_filter{{$type}} = $('#person_id_filter{{$type}}').val();
        problem_filter{{$type}} = $('#problem_filter{{$type}}').val();
        date_of_suggestion_filter{{$type}} = $('#date_of_suggestion_filter{{$type}}').val();
        solution_text_filter{{$type}} = $('#solution_text_filter{{$type}}').val();
        level_of_process_filter{{$type}} = $('#level_of_process_filter{{$type}}').val();
        result_id_filter{{$type}} = $('#result_id_filter{{$type}}').val();
        processing_time_filter{{$type}} = $('#processing_time_filter{{$type}}').val();
        budget_filter{{$type}} = $('#budget_filter{{$type}}').val();
        checklist_created_at_filter{{$type}} = $('#checklist_created_at_filter{{$type}}').val();
        assigned_by_filter{{$type}} = $('#assigned_by_filter{{$type}}').val();
        get{{$type}}Filter(
            page{{$type}},
            group_id_filter{{$type}},
            type_id_filter{{$type}} = $('#type_id_filter{{$type}}').val(),
            detail_filter{{$type}} = $('#detail_filter{{$type}}').val(),
            website_id_filter{{$type}},
            category_id_filter{{$type}},
            person_id_filter{{$type}},
            problem_filter{{$type}},
            date_of_suggestion_filter{{$type}},
            solution_text_filter{{$type}},
            level_of_process_filter{{$type}},
            result_id_filter{{$type}},
            processing_time_filter{{$type}},
            budget_filter{{$type}},
            checklist_created_at_filter{{$type}},
            assigned_by_filter{{$type}},
            0,
            hoverTableCheckListAndTask
        );
        $('#box_data_customer').scrollTop(0);
    }

    function ajax{{$type}}(data) {
        if (ready{{$type}}) {
            callAjax{{$type}}()
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

    const debounceAjax{{$type}} = debounce(ajax{{$type}}, 300)

    $(document).on('keyup', '.card{{$type}} .last-row input', function (e) {
        debounceAjax{{$type}}(e.target.value)
    })
    $(document).on('change', '.card{{$type}} .last-row select', function (e) {
        debounceAjax{{$type}}(e.target.value)
    })

    function deleteAllFilter{{$type}}() {
        get{{$type}}(1);
        $('#website_id_filter{{$type}}').val('');
        $('#category_id_filter{{$type}}').val('');
        $('#person_id_filter{{$type}}').val('');
        $('#problem_filter{{$type}}').val('');
        $('#date_of_suggestion_filter{{$type}}').val('');
        $('#solution_text_filter{{$type}}').val('');
        $('#level_of_process_filter{{$type}}').val('');
        $('#result_id_filter{{$type}}').val('');
        $('#processing_time_filter{{$type}}').val('');
        $('#budget_filter{{$type}}').val('');
        $('#checklist_created_at_filter{{$type}}').val('');
        $('#assigned_by_filter{{$type}}').val('');
        $('#box_data_customer').scrollTop(0);
    }

    $('#delete_all_filter_{{$type}}').on('click', function (e) {
        e.preventDefault();
        deleteAllFilter{{$type}}();
    })

    $(document).on('keypress', function (e) {
        if (e.keyCode == 13 && ready{{$type}} && hoverTableCheckListAndTask == "{{$type}}") {
            callAjax{{$type}}();
        }
    });

    function get{{$type}}Filter(
        page{{$type}},
        group_id_filter{{$type}},
        type_id_filter{{$type}},
        detail_filter{{$type}},
        website_id_filter{{$type}},
        category_id_filter{{$type}},
        person_id_filter{{$type}},
        problem_filter{{$type}},
        date_of_suggestion_filter{{$type}},
        solution_text_filter{{$type}},
        level_of_process_filter{{$type}},
        result_id_filter{{$type}},
        processing_time_filter{{$type}},
        budget_filter{{$type}},
        checklist_created_at_filter{{$type}},
        assigned_by_filter{{$type}},
        isAppend,
        type
    ) {
        $.ajax({
            url: "{{route('check-list.getData')}}",
            type: 'get',
            data: {
                page: page{{$type}},
                group_id: group_id_filter{{$type}},
                type_id: type_id_filter{{$type}},
                detail: detail_filter{{$type}},
                website_id: website_id_filter{{$type}},
                category_id: category_id_filter{{$type}},
                person_id: person_id_filter{{$type}},
                problem: problem_filter{{$type}},
                date_of_suggestion: date_of_suggestion_filter{{$type}},
                solution_text: solution_text_filter{{$type}},
                level_of_process: level_of_process_filter{{$type}},
                result_id: result_id_filter{{$type}},
                processing_time: processing_time_filter{{$type}},
                budget: budget_filter{{$type}},
                checklist_created_at: checklist_created_at_filter{{$type}},
                assigned_by: assigned_by_filter{{$type}},
                type:type,
                proposer : $('#proposer').val()
            },
            success: function (data) {
                if (isAppend == 0) {
                    $('#{{$type}}-table-tbody').html(data.view);
                } else if (isAppend == 1) {
                    $('#{{$type}}-table-tbody').append(data.view);
                }
                lastPage{{$type}} = data.last_page;
            },
            complete: function () {
                ready{{$type}} = true;
            }
        })

    }

    $('.table-check-list').scroll(function (e) {
        if (ready{{$type}} && Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
            ready{{$type}} = false;
            if (page{{$type}} < lastPage{{$type}}) {
                page{{$type}}++;
                get{{$type}}Filter(
                    page{{$type}},
                    group_id_filter{{$type}},
                    website_id_filter{{$type}},
                    category_id_filter{{$type}},
                    person_id_filter{{$type}},
                    problem_filter{{$type}},
                    date_of_suggestion_filter{{$type}},
                    solution_text_filter{{$type}},
                    level_of_process_filter{{$type}},
                    result_id_filter{{$type}},
                    processing_time_filter{{$type}},
                    budget_filter{{$type}},
                    checklist_created_at_filter{{$type}},
                    assigned_by_filter{{$type}},
                    1);
            } else {
                ready{{$type}} = true;
            }
        }
    });

    $("#show-group-check-list{{$type}}").fancybox({
        'width': 900,
        'height': 900,
        'type': 'iframe',
        'autoScale': false,
        'autoSize': false,
        helpers: {
            title: {
                type: 'float'
            }
        },
        afterClose: function () {
            console.log('a');
            $.ajax({
                url: '{{route('check-list-group.getGroup',['type'=>$type])}}',
                type: 'get',
                success: function (data) {

                    $('.myGroupList').html(data.view);
                    get{{$type}}(1, data.first_group);
                }
            })
        }
    });
    $(document).on('click', '.group-content{{$type}}', function (e) {
        groupId = $(this).attr('data-id');
        if (!($(this).hasClass('has-active'))) {
            get{{$type}}(1, groupId);
            $('.group-content{{$type}}').removeClass('has-active');
            $(this).addClass('has-active');
        }
    })
    $(document).on('click', '#btn_add_new_{{$type}}', function (e) {
        e.preventDefault();
        groupId = $('#myGroupList{{$type}} .nav-item .active').attr('data-id');
        var id = $(this).attr('data-id');
        if (ready{{$type}}) {
            ready{{$type}} = false;
            $.ajax({
                url: "{{route('check-list.create')}}",
                type: 'get',
                data: {
                    id: id,
                    groupId: groupId,
                    type:"{{$type}}"
                },
                success: function (data) {
                    $('#modal_checklist_task_form').html(data);
                    $('#modal_checklist_task').modal('toggle');
                }, complete: function () {
                    ready{{$type}} = true;
                }
            })
        }
    })
    $(document).on('click', '.edit_check_list{{$type}}', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var agent_id = $(this).attr('data-agent_id');
        var url = $(this).attr('data-url');
        groupId = $('#myGroupList{{$type}} .nav-item .active').attr('data-id');

        if (ready{{$type}}) {
            ready{{$type}} = false;
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    id: id,
                    groupId: groupId,
                    type:'{{$type}}'
                },
                success: function (data) {
                    $('#modal_checklist_task_form').html(data);
                    $('#modal_checklist_task').modal('toggle');
                }, complete: function () {
                    ready{{$type}} = true;
                }
            })
        }
    })
    $(document).on('submit', '.btn_submit_{{$type}}_form', function (e) {
        e.preventDefault();
        let _url = $(this).attr('action');
        var formData = new FormData($(this)[0]);
        console.log()
        $.ajax({
            url: _url,
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success: function (data) {
                if (data.type == 'create') {
                    page{{$type}} = 1;
                    $('#checklist-table-tbody').html(data.view_checklist);
                    $('#task-table-tbody').html(data.view_task);

                    lastPagechecklist = data.last_page;
                    lastPagetask = data.last_page;

                } else if (data.type == 'update') {
                    console.log(data);
                    $('#check_list_data_' + data.id).replaceWith(data.view_checklist);
                    $('#task_data_' + data.id).replaceWith(data.view_task);
                }
                toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                $('#modal_checklist_task').modal('hide');
            }, complete: function () {
                ready{{$type}} = true;
            }
        })

    })
    $(document).on('click', '.delete_check_list{{$type}}', function (e) {
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
            if (result.isConfirmed && ready{{$type}}) {
                ready{{$type}} = false;
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#check_list_data_' + data.id).remove();
                        $('#task_data_' + data.id).remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $('#modal_checklist_task').modal('hide');
                    }, complete: function () {
                        ready{{$type}} = true;
                    }
                })
            }
        })
    })
</script>
