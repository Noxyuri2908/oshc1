<script>
    var page{{$type}} = 1
    var lastpage{{$type}};



    @foreach($valueNameField as $name)
    var {{$name.$type}} = ''
    @endforeach

    var ready{{$type}} = true
    var arrData = []

    function get{{$type}}(page) {
        $('.loading-fixed-top').css('display','block');
        if (!page) {
            page = 1
        }
        $.ajax({
            url: "{{route('tasks.media.getMediaPost.post',['type_media_post'=>$keyType])}}",
            type: 'get',
            data: {
                page: page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processingDateWebTaskStart: "{{request()->get('report_start_date')}}",
                processingDateWebTaskEnd: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option: "{{request()->get('filter_date_option')}}",
                @endif
            },
            success: function (data) {
                page{{$type}} = 1;
                $('#{{$type}}_data_body').html(data.view);
                lastpage{{$type}} = data.last_page;
                $('#total_page_{{$type}}').text(data.total_page);
                $('.loading-fixed-top').css('display','none');
            },
        })
    }

    get{{$type}}()
    $(document).on('click', '#{{$type}}-tab-nav', function (e) {
        e.preventDefault()
        get{{$type}}();
        deleteAllFilter{{$type}}()
    })

    function callAjax{{$type}}() {
        ready{{$type}} = false
        page{{$type}} = 1;
        @foreach($valueNameField as $name)
            {{$name.$type}}= $('#{{$name}}_filter{{$type}}').val();
        @endforeach
        console.log(schedule_post_date_startweb_task);

        get{{$type}}Filter(
            page{{$type}},
            @foreach($valueNameField as $name)
            {{$name.$type}},
            @endforeach

                0)
        $('#box_data_customer').scrollTop(0)
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

    $(document).on('keyup', '.card_table_{{$type}} .last-row input', function (e) {
        debounceAjax{{$type}}(e.target.value)
    })
    $(document).on('change', '.card_table_{{$type}} .last-row select', function (e) {
        debounceAjax{{$type}}(e.target.value)
    })

    {{--$(document).on('keypress', function (e) {--}}
    {{--    if (e.keyCode == 13 && ready{{$type}} && hoverTable == '{{$type}}_table_hover') {--}}
    {{--        callAjax{{$type}}()--}}
    {{--    }--}}
    {{--})--}}

    function get{{$type}}Filter(
        page,
        @foreach($valueNameField as $name)
        {{$name.$type}},
        @endforeach
            isAppend,
    ) {
        $('.loading-fixed-top').css('display','block');
        $.ajax({
            url: "{{route('tasks.media.getMediaPost.post',['type_media_post'=>$keyType])}}",
            type: 'get',
            data: {
                page: page,
        @foreach($valueNameField as $name)
        {{$name}}:{{$name.$type}},
        @endforeach
    },
        success: function (data) {
            if (isAppend == 0) {
                $('#{{$type}}_data_body').html(data.view)
                $('#total_page_email_marketing').html(data.total_page)
            } else if (isAppend == 1) {
                $('#{{$type}}_data_body').append(data.view)
            }
            $('#total_page_{{$type}}').text(data.total_page);
            lastpage{{$type}} = data.last_page
            $('.loading-fixed-top').css('display','none');

        }
    ,
        complete: function () {
            ready{{$type}} = true
        }
    ,
    })
    }

    $('.table-{{$type}}').scroll(function (e) {
        console.log('currentPage:'+page{{$type}})
        console.log('lastPage:'+lastpage{{$type}})

        if (ready{{$type}} && Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
            ready{{$type}} = false;
            if (page{{$type}} < lastpage{{$type}}) {
                page{{$type}}++;
                get{{$type}}Filter(
                    page{{$type}},
                    @foreach($valueNameField as $name)
                    {{$name.$type}},
                    @endforeach
                        1,
                )
            } else {
                ready{{$type}} = true;
            }
        }
    });

    function deleteAllFilter{{$type}}() {
        get{{$type}}(1)
        @foreach($valueNameField as $name)
        $('#{{$name}}_filter{{$type}}').val('').change();
        @endforeach
        $('#table-{{$type}}').scrollTop(0)
    }

    $('#delete_all{{$type}}_fillter').on('click', function (e) {
        e.preventDefault()
        deleteAllFilter{{$type}}()
    })
    //create
    $(document).on('click', '#btn_add_new_{{$type}}', function (e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        if (ready{{$type}}) {
            ready{{$type}} = false
            $.ajax({
                url: "{{route('tasks.media.createMediaPost.post',['type_media_post'=>$keyType])}}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function (data) {
                    $('#modal_{{$type}}_form').html(data)
                    $('#modal_{{$type}}').modal('toggle')
                }, complete: function () {
                    ready{{$type}} = true
                },
            })
        }
    })

    //end create
    //update
    $(document).on('click', '.edit_media_{{$type}}', function (e) {
        e.preventDefault()
        var isClick = $(this).attr('is-click')
        var element = $(this)
        var id = $(this).attr('data-id')
        var url = $(this).attr('data-url')
        if (ready{{$type}}) {
            ready{{$type}} = false
            $.ajax({
                url: url,
                type: 'get',
                data: {},
                success: function (data) {
                    $('#modal_{{$type}}_form').html(data)
                    $('#modal_{{$type}}').modal('toggle')
                }, complete: function () {
                    ready{{$type}} = true
                },
            })
        }
    })

    //end update
    function submitFormModal{{$type}}(
        _url,
        typeSubmit,
        @foreach($valueNameField as $name)
        {{$name.$type}},
        @endforeach
    ) {
        $.ajax({
            url: _url,
            type: 'post',
            data: {
                _token: "{{csrf_token()}}",
        @foreach($valueNameField as $name)
        {{$name}}: {{$name.$type}},
        @endforeach
    },
        success: function (data) {
            console.log(data)
            if (data.type == 'create') {
                page{{$type}} = 1
                $('#{{$type}}_data_body').html(data.view)
                lastpage{{$type}} = data.last_page
            } else if (data.type == 'update') {
                $('#{{$type}}_' + data.id + '_data').replaceWith(data.view)
                {{--console.log('#{{$type}}_' + data.id+'_data');--}}
            }
            // $('#proposal-table').html(data);
            toastr.success('Cập nhật dữ liệu thành công', 'Success', { timeOut: 5000 })
            $('#modal_{{$type}}').modal('hide')
        }
    ,
        complete: function () {
            ready{{$type}} = true
        }
    ,
    })
    }

    //submit
    $(document).on('click', '.btn_submit_{{$type}}_form', function (e) {
        e.preventDefault()
        let _url = $(this).attr('data-url')
        let typeSubmit = $(this).attr('data-type')
        @foreach($valueNameField as $name)
        let {{$name.$type}} = $('#{{$name.$type}}').val()
        @endforeach
        if (typeSubmit == 1 || typeSubmit == 2) {
            if (
                category{{$type}} &&
                post_title{{$type}} &&
                source_post{{$type}} &&
                type_source{{$type}}
            ) {
                if (ready{{$type}}) {
                    ready{{$type}} = false
                    submitFormModal{{$type}}(
                        _url,
                        typeSubmit,
                        @foreach($valueNameField as $name)
                        {{$name.$type}},
                        @endforeach
                    )
                }
            } else {
                if (!category{{$type}}) {
                    $('#category_help').text('Chuyên mục không được để trống')
                } else {
                    $('#category_help').text('')
                }
                if (!post_title{{$type}}) {
                    $('#post_title_help').text('Bài post không được để trống')
                } else {
                    $('#post_title_help').text('')
                }
                if (!source_post{{$type}}) {
                    $('#source_post_help').text('Nguồn bài không được để trống')
                } else {
                    $('#source_post_help').text('')
                }
                if (!type_source{{$type}}) {
                    $('#type_source_help').text('Loại tin bài không được để trống')
                } else {
                    $('#type_source_help').text('')
                }
            }
        } else if (typeSubmit == 3 || typeSubmit == 4) {
            submitFormModal{{$type}}(
                _url,
                typeSubmit,
                @foreach($valueNameField as $name)
                {{$name.$type}},
                @endforeach

            )
        }
    })
    //end submit
    //delete
    $(document).on('click', '.delete_media_{{$type}}', function (e) {
        e.preventDefault()
        let id = $(this).attr('data-id')
        let _url = $(this).attr('data-url')
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed && ready{{$type}}) {
                ready{{$type}} = false
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#{{$type}}_' + data.id + '_data').remove()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                        )
                        $('#modal_{{$type}}').modal('hide')
                    }, complete: function () {
                        ready{{$type}} = true
                    },
                })
            }
        })
    })

    function base64(s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    }

    function get{{$type}}Excel(
        @foreach($valueNameField as $name)
        {{$name.$type}},
        @endforeach
            isAppend,
    ) {
        $.ajax({
            url: "{{route('tasks.media.exportMediaWebsite',['type_media_post'=>$keyType])}}",
            type: 'get',
            data: {
        @foreach($valueNameField as $name)
        {{$name}}:{{$name.$type}},
        @endforeach
    },
        success: function (data) {
            window.open(this.url,'_blank');
        }
    ,
        complete: function () {
            ready{{$type}} = true
        }
    ,
    })
    }

    $(document).on('click', '.export-plan{{$type}}', function (e) {
        e.preventDefault();
        @foreach($valueNameField as $name)
            {{$name.$type}}= $('#{{$name}}_filter{{$type}}').val()
        @endforeach
        get{{$type}}Excel(
            @foreach($valueNameField as $name)
            {{$name.$type}},
            @endforeach
                'isAppend',
        )
    })
    //end delete


</script>
