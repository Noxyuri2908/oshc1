<script>
    var page{{$nameAction}} = 1;
    var lastPage{{$nameAction}};
    var ready{{$nameAction}} = true;
    var arrData = [];
    //filter
    @foreach($valueNameField as $name)
    var {{$name}}_filter = '';
    @endforeach

    function get{{$nameAction}}s(page) {
        $('.loading-fixed-top').css('display','block');
        if (!page) {
            page = 1;
        }
        $.ajax({
            url: "{{$urlGetData}}",
            type: 'get',
            data: {
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page: page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_{{$nameAction}}_start: "{{request()->get('report_start_date')}}",
                processing_date_{{$nameAction}}_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option: "{{request()->get('filter_date_option')}}",
                @endif
            },
            success: function (data) {
                $('#{{$elementIdTableData}}').html(data.view);
                lastPage{{$nameAction}} = data.last_page;
                $('#total-row-data').text(data.total_row_data);
                $('.loading-fixed-top').css('display','none');
            }
        })
    }

    get{{$nameAction}}s();

    function ajax(data) {
        if (ready{{$nameAction}}) {
            ready{{$nameAction}} = false;
            page{{$nameAction}} = 1;
            @foreach($valueNameField as $name)
                {{$name}}_filter = $('#{{$name}}_filter').val();
            @endforeach
            get{{$nameAction}}Filter(
                page{{$nameAction}},
                @foreach($valueNameField as $name)
                    {{$name}}_filter,
                @endforeach
                    0);
            $('#box_data_customer').scrollTop(0);
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

    const debounceAjax = debounce(ajax, 300)

    $(document).on('keyup', '.last-row input', function (e) {
        debounceAjax(e.target.value);
    });
    $(document).on('change', '.last-row select', function (e) {
        debounceAjax(e.target.value);
    });
    $(document).on('keypress', function (e) {
        if (e.keyCode == 13 && ready{{$nameAction}}) {
            ajax();
        }
    });

    function get{{$nameAction}}Filter(
        page{{$nameAction}},
        @foreach($valueNameField as $name)
            {{$name}}_filter,
        @endforeach
            isAppend) {
        $('.loading-fixed-top').css('display','block');

        $.ajax({
            url: "{{$urlGetData}}",
            type: 'get',
            data: {
                @if(!empty($agent_id))
                agent_id: "{{$agent_id}}",
                @endif
                page: page{{$nameAction}},
        @foreach($valueNameField as $name)
        {{$name}}:
        {{$name}}_filter ,
        @endforeach
    },
        success: function (data) {
            if (isAppend == 0) {
                $('#{{$elementIdTableData}}').html(data.view);
            } else if (isAppend == 1) {
                $('#{{$elementIdTableData}}').append(data.view);
            }
            lastPage{{$nameAction}} = data.last_page;
            $('.loading-fixed-top').css('display','none');
        }
    ,
        complete: function () {
            ready{{$nameAction}} = true;
        }
    })

    }

    $('.{{$table_element_class_scroll}}').scroll(function (e) {
        if (ready{{$nameAction}} && Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
            ready{{$nameAction}} = false;
            if (page{{$nameAction}} < lastPage{{$nameAction}}) {
                page{{$nameAction}}++;
                get{{$nameAction}}Filter(
                    page{{$nameAction}},
                    @foreach($valueNameField as $name)
                        {{$name}}_filter,
                    @endforeach
                        1);
            } else {
                ready{{$nameAction}} = true;
            }
        }
    });

    $(document).on('click', '.{{$elementClassSubmitForm}}', function (e) {
        e.preventDefault();
        let _url = $(this).attr('data-url');
        @foreach($valueNameField as $name)
        let _{{$name}} = $('#{{$name}}').val();
        @endforeach

        if (ready{{$nameAction}}) {
            ready{{$nameAction}} = false;
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    @if(!empty($agent_id))
                    agent_id: "{{$agent_id}}",
                    @endif
                    _token: "{{csrf_token()}}",
            @foreach($valueNameField as $name)
            {{$name}}:
            _{{$name}},
            @endforeach
        },
            success: function (data) {
                if (data.type == 'create') {
                    page{{$nameAction}} = 1;
                    $('#{{$elementIdTableData}}').html(data.view);
                    lastPage{{$nameAction}} = data.last_page;
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                    $('#{{$elementIdModalForm}}').modal('hide');
                } else if (data.type == 'update') {
                    $('#{{$elementIdEachData}}_' + data.id).replaceWith(data.view);
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                    $('#{{$elementIdModalForm}}').modal('hide');
                }
            }
        ,
            complete: function () {
                ready{{$nameAction}} = true;
            }
        ,
            error: function (err) {
                console.log(err);
                if (err.status == 422) {
                    @foreach($valueNameField as $name)
                    if ('{{$name}}' in err.responseJSON.errors) {
                        $('#{{$name}}_div_alert').text(err.responseJSON.errors.{{$name}}[0]);
                    }
                    @endforeach
                }
            }
        })
        }
    })

    $(document).on('click', '#{{$elementIdCreateForm}}', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if (ready{{$nameAction}}) {
            ready{{$nameAction}} = false;
            $.ajax({
                url: "{{$urlCreateForm}}",
                type: 'get',
                data: {
                    @if(!empty($agent_id))
                    id: "{{$agent_id}}",
                    @else
                    id: id
                    @endif
                },
                success: function (data) {
                    $('#{{$elementIdRenderModalForm}}').html(data);
                    $('#{{$elementIdModalForm}}').modal('toggle');
                }, complete: function () {
                    ready{{$nameAction}} = true;
                }
            })
        }
    })

    $(document).on('click', '.{{$elementClassEditForm}}', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var agent_id = $(this).attr('data-agent_id');
        var url = $(this).attr('data-url');
        if (ready{{$nameAction}}) {
            ready{{$nameAction}} = false;
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#{{$elementIdRenderModalForm}}').html(data);
                    $('#{{$elementIdModalForm}}').modal('toggle');
                }, complete: function () {
                    ready{{$nameAction}} = true;
                }
            })
        }
    })
    $(document).on('click', '.{{$elementClassDeleteForm}}', function (e) {
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
            if (result.isConfirmed && ready{{$nameAction}}) {
                ready{{$nameAction}} = false;
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#{{$elementIdEachData}}_' + data.id).remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        $('#{{$elementIdModalForm}}').modal('hide');
                    }, complete: function () {
                        ready{{$nameAction}} = true;
                    }
                })
            }
        })
    })
    $(document).on('click', '.delete-filter', function (e) {
        e.preventDefault();
        @foreach($valueNameField as $element)
        $('#{{$element}}_filter').val('');
        $("#{{$element}}_filter").val('').change();
        @endforeach
        get{{$nameAction}}s();
    })
</script>
