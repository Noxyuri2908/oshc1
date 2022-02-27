<script>
    var page = 1;
    var lastPage;
    var ready = true;
    //filter
    @foreach($elementFilterIds as $element)
    var {{$element}}_filter = '';
    @endforeach
    //
    var _department = '';
    var _period = '';
    var _time = '';
    var _country = '';
    var _type = '';
    var _status = '';
    var _time_end = '';
    var _time_start = '';

    function searchHotIssue() {
        $('.loading-fixed-top').css('display', 'block');

        $.ajax({
            url: "{{route('tasks.getFollowUps')}}",
            type: 'get',
            data: {
                hot_issue_follow_ups : 1
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

    function getCustomerTab(page) {
        if (!page) {
            page = 1;
        }
        $('.loading-fixed-top').css('display','block');
        html = '';
        $.ajax({
            url: "{{route('agent.getData')}}",
            type: 'get',
            data: {
                page: page
            },
            success: function (data) {
                $('#table_agent_body').html(data.view);
                lastPage = data.last_page;
                $('#total-row-data').html(data.total_row_data);
                $('#count_all_agent_filter').text('('+data.total_row_data+')');

            },
            complete:function () {
                $('.loading-fixed-top').css('display','none');
                $('.multi_action').css('display','none');
                $('#count-checked').html('0');
            }
        })
    }
    getCustomerTab();
    function getFilterAndAgentDefault() {
        $.get('{{route('agent.getAgentFilterAndAgentDefault')}}',{},function(data){
            if(data.total_row_data_status){
                $.each(data.total_row_data_status,function(key,value){
                    html += '<a class="btn btn-falcon-info btn-sm btn_status mr-3 font-size-12px" data-value="'+value.id+'" href="#!">'+key+'<sup style="color: red">('+value.count+')</sup></a>';
                })
                $('.agent-header-filter').append(html);
            }
            if(data.agent_default){
                var option = new Option(data.agent_default.name, data.agent_default.id, true, true)
                $('#agent_default_id').append(option).trigger('change')
            }
        }).fail(function(fail) {
            console.log(fail)
        })
    }
    getFilterAndAgentDefault();
    function ajax(data){
        if (ready) {
            ready = false;
            page = 1;
            @foreach($elementFilterIds as $element)
                {{$element}}_filter = $('#{{$element}}_filter').val();
            @endforeach
                _department = $('#f_department option:selected').attr('value');
                _period = $('#f_period').val();
                _time = $('#f_time').val();
                _time_end = $('#f_time_end').val();
                _time_start = $('#f_time_start').val();
                _country = $('#f_country').val();
                _type = $('#f_type').val();
                _status = $('#f_status').val();
            getCustomerTabFilter(
                page,
                @foreach($elementFilterIds as $element)
                    {{$element}}_filter,
                @endforeach
                    0,
                _department,
                _period,
                _time,
                _time_end,
                _time_start,
                _country,
                _type,
                _status
            );
            $('.table-div').scrollTop(0);
            $('.loading-fixed-top').css('display','none');
            $('#multi_action').css('display','none');
            $('#count-checked').html('0');
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

    const debounceAjax = debounce(ajax, 300)

    $(document).on('keyup','.table-main-agent .last-row input',function(e){
        debounceAjax(e.target.value);
    });
    $(document).on('change','.table-main-agent .last-row select',function(e){
        debounceAjax(e.target.value);
    });
    $(document).on('change','#market_id_filter ,#potential_service_filter', function (e) {
        debounceAjax(e.target.value);
    });
    {{--$(document).on('keypress', function (e) {--}}
    {{--    if (e.keyCode == 13 && ready) {--}}
    {{--        ready = false;--}}
    {{--        page = 1;--}}
    {{--        @foreach($elementFilterIds as $element)--}}
    {{--            {{$element}}_filter = $('#{{$element}}_filter').val();--}}
    {{--        @endforeach--}}
    {{--            _department = $('#f_department').val();--}}
    {{--        _period = $('#f_period').val();--}}
    {{--        _time = $('#f_time').val();--}}
    {{--        _time_end = $('#f_time_end').val();--}}
    {{--        _time_start = $('#f_time_start').val();--}}
    {{--        _country = $('#f_country').val();--}}
    {{--        _type = $('#f_type').val();--}}
    {{--        _status = $('#f_status').val();--}}
    {{--        getCustomerTabFilter(--}}
    {{--            page,--}}
    {{--            @foreach($elementFilterIds as $element)--}}
    {{--                {{$element}}_filter,--}}
    {{--            @endforeach--}}
    {{--                0,--}}
    {{--            _department,--}}
    {{--            _period,--}}
    {{--            _time,--}}
    {{--            _time_end,--}}
    {{--            _time_start,--}}
    {{--            _country,--}}
    {{--            _type,--}}
    {{--            _status--}}
    {{--        );--}}
    {{--        $('.table-div').scrollTop(0);--}}
    {{--    }--}}
    {{--});--}}

    function getCustomerTabFilter(
        pageCustomerTab,
        @foreach($elementFilterIds as $element)
            {{$element}}_filter,
        @endforeach
            isAppend,
        f_department_filter,
        f_period_filter,
        f_time_filter,
        f_time_end_filter,
        f_time_start_filter,
        f_country_filter,
        f_type_filter,
        f_status_filter
    ) {
        $('.loading-fixed-top').css('display','block');
        $.ajax({
            url: "{{route('agent.getData')}}",
            type: 'get',
            // processData: false,
            // contentType: false,
            data: {
                page: pageCustomerTab,
                f_department: f_department_filter,
                f_period: f_period_filter,
                f_time: f_time_filter,
                f_time_end:f_time_end_filter,
                f_time_start:f_time_start_filter,
                f_country: f_country_filter,
                f_type: f_type_filter,
                f_status: f_status_filter,
        @foreach($elementFilterIds as $element)
        {{$element}}:
        {{$element}}_filter,
        @endforeach

    },
        success: function (data) {
            if (isAppend == 0) {
                $('#table_agent_body').html(data.view);

            } else if (isAppend == 1) {
                $('#table_agent_body').append(data.view);
            }
            lastPage = data.last_page;
            $('#total-row-data').html(data.total_row_data);
        }
    ,
        complete: function () {
            ready = true;
            $('.loading-fixed-top').css('display','none');
            $('.multi_action').css('display','none');
            $('#count-checked').html('0');
        },
        error: function(xhr){
            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
    }

    function fillter() {
        _department = $('#f_department option:selected').attr('value');
        _period = $('#f_period').val();
        _time = $('#f_time').val();
        _time_end = $('#f_time_end').val();
        _time_start = $('#f_time_start').val();
        _country = $('#f_country').val();
        _type = $('#f_type').val();
        _status = $('#f_status').val();
        getCustomerTabFilter(
            1,
            @foreach($elementFilterIds as $element)
                {{$element}}_filter,
            @endforeach
                0,
            _department,
            _period,
            _time,
            _time_end,
            _time_start,
            _country,
            _type,
            _status
        );
        $('.table-div').scrollTop(0);

    }

    $(document).on('change', '#f_time_start,#f_time_end,#f_department, #f_period, #f_time, #f_country, #f_status', function () {
        fillter();
    })
    $(document).on('click','.btn_status',function(){
        _department = $('#f_department option:selected').attr('value');
        _period = $('#f_period').val();
        _time = $('#f_time').val();
        _time_end = $('#f_time_end').val();
        _time_start = $('#f_time_start').val();
        _country = $('#f_country').val();
        _type = $('#f_type').val();
        _status = $(this).data('value');
        getCustomerTabFilter(
            1,
            @foreach($elementFilterIds as $element)
                {{$element}}_filter,
            @endforeach
                0,
            _department,
            _period,
            _time,
            _time_end,
            _time_start,
            _country,
            _type,
            _status
        );
        $('.table-div').scrollTop(0);
    });
    $('.table-main-agent').scroll(function (e) {
        if (ready && Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 320) {
            ready = false;
            if (page < lastPage) {
                page++;
                getCustomerTabFilter(
                    page,
                    @foreach($elementFilterIds as $element)
                        {{$element}}_filter,
                    @endforeach
                        1,
                    _department,
                    _period,
                    _time,
                    _time_end,
                    _time_start,
                    _country,
                    _type,
                    _status);
            } else {
                ready = true;
            }
        }
    });
    $(document).on('click', '.delete-filter', function (e) {
        e.preventDefault();
        @foreach($elementFilterIds as $element)
        $('#{{$element}}_filter').val('');
        $("#{{$element}}_filter").val('').change();
        @endforeach
        getCustomerTab();
    })

    $(document).on('mouseover','.{{$element_class_btn_row_edit}}',function (e){
        e.preventDefault();
        var element = this;
        $(element).fancybox({
            'width': '90%',
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
                var id = $(element).attr('data-id');
                var url = $(element).attr('data-url_edit');
                $.ajax({
                    url:url,
                    type:'get',
                    success:function (data){
                        $('#{{$element_id_row_edit}}_' + data.id).replaceWith(data.view);
                    }
                })
            }
        });
    })
    $(document).on('click', '.agent_data_delete', function (e) {
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
            if (result.isConfirmed && ready) {
                ready = false
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#data-agent_' + data.id).remove()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                        )
                    }, complete: function () {
                        ready = true
                    },error: function(xhr){
                        alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                    }
                })
            }
        })
    })
    $(document).on('click','.get_agent_contact',function(e) {
        e.preventDefault();
        var _url = $(this).attr('data-url');
        if(ready == true){
            ready = false;

            $.get(_url,{},function(data){
                $('#modal-show-contact-agent').html(data);
                $('#modalShowContactAgent').modal('show');
                ready = true;
            });
        }

    })

    $('#agentExportExcel').on('click', function (){
        var query = {
            name : $('#name_filter').val(),
            agent_code : $('#agent_code_filter').val(),
            info_type_id : $('#info_type_id_filter').val(),
            user_status : $('#user_status_filter').val(),
            market_id : $('#market_id_filter').val(),
            email : $('#email_filter').val(),
            tel_1 : $('#tel_1_filter').val(),
            tel_2 : $('#tel_2_filter').val(),
            website : $('#website_filter').val(),
            country : $('#country_filter').val(),
            city : $('#city_filter').val(),
            office : $('#office_filter').val(),
            department : $('#department_filter').val(),
            staff_id : $('#staff_id_filter').val(),
            registered_date : $('#registered_date_filter').val(),
            created_at : $('#created_at_filter').val(),
            note1 : $('#note1_filter').val(),
            note2 : $('#note2_filter').val(),
            potential_service : $('#potential_service_filter').val(),
            rating : $('#rating_filter').val(),
            f_department : $('#f_department option:selected').attr('value'),
            f_period : $('#f_period').val(),
            f_time : $('#f_time').val(),
            f_time_end : $('#f_time_end').val(),
            f_time_start : $('#f_time_start').val(),
            f_country : $('#f_country').val(),
            f_type : $('#f_type').val(),
            f_status : $('#f_status').val(),
        }

        var url = "{{route('agent.exportExcel')}}?" + $.param(query)

        window.location = url;
    })
</script>
