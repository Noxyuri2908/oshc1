<script>
    var page = 1
    var lastPage
    var ready = true
    //filter
        @foreach($elementFilterIds as $element)
    var {{$element}}_filter = ''
    @endforeach
    //
    var _department = ''
    var _period = ''
    var _time = ''
    var _country = ''
    var _type = ''
    var _status = ''
    var _time_end = ''
    var _time_start = ''

    function getCustomerTab(page) {
        if (!page) {
            page = 1
        }
        $('.loading-fixed-top').css('display', 'block')
        $.ajax({
            url: "{{route('ajax.flywire.getData')}}",
            type: 'get',
            data: {
                page: page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_archiveMediaLink_start: "{{request()->get('report_start_date')}}",
                processing_date_archiveMediaLink_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option: "{{request()->get('filter_date_option')}}",
                @endif
            },
            success: function (data) {
                $('#tbody_invoice').html(data.view)
                lastPage = data.last_page
                $('#total-row').html(data.total_row)
                $('#totalCom-row').html(data.totalComForAgent)
                $('#total_flywire_filter').html('(' + data.total_row + ')')
            }, complete: function () {
                $('.loading-fixed-top').css('display', 'none')
            },
        })
    }

    getCustomerTab()

    function getFilter() {
        let html = ''
        $.get('{{route('ajax.flywire.getTotalData')}}', {}, function (data) {
            if (data) {
                $.each(data, function (key, value) {
                    html += '<a class="btn btn-falcon-info btn-sm mr-3 font-size-12px border border-radius-20px btn_status" data-value="' + value.id + '" href="#!">' + key + '<sup style="color: red">(' + value.count + ')</sup></a>'
                })
                console.log(html)
                $('.flywire-header-filter').append(html)
            }
        }).fail(function (fail) {
            console.log(fail)
        })
    }

    getFilter()

    function callAjax() {
        ready = false
        page = 1
        @foreach($elementFilterIds as $element)
            {{$element}}_filter = $('#{{$element}}_filter').val()
        @endforeach
            _department = $('#f_department').val()
        _period = $('#f_period').val()
        _time = $('#f_time').val()
        _time_end = $('#f_time_end').val()
        _time_start = $('#f_time_start').val()
        _country = $('#f_country').val()
        _type = $('#f_type').val()
        _status = $('#f_status').val()
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
            _status,
        )
        $('.table-div').scrollTop(0)
    }

    function ajax(data) {
        callAjax()
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

    $(document).on('keyup', '.last-row input[type="text"]', function (e) {
        debounceAjax(e.target.value)
    })

    $(document).on('keyup', '.last-row input[type="email"]', function (e) {
        debounceAjax(e.target.value)
    })

    $(document).on('change', '.last-row select', function (e) {
        debounceAjax(e.target.value)
    })
    $(document).on('change', '.last-row input[type="text"]', function (e) {
        debounceAjax(e.target.value)
    })
    $(document).on('click', '.apply-filter', function (e) {
        e.preventDefault()
        if (ready) {
            callAjax()
        }
    })

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
        f_status_filter,
    ) {
        $('.loading-fixed-top').css('display', 'block')

        $.ajax({
            url: "{{route('ajax.flywire.getData')}}",
            type: 'get',
            // processData: false,
            // contentType: false,
            data: {
                page: pageCustomerTab,
                f_department: f_department_filter,
                f_period: f_period_filter,
                f_time: f_time_filter,
                f_time_end: f_time_end_filter,
                f_time_start: f_time_start_filter,
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
                $('#tbody_invoice').html(data.view)
            } else if (isAppend == 1) {
                $('#tbody_invoice').append(data.view)
            }
            lastPage = data.last_page
            $('#total-row').html(data.total_row)
            $('#totalCom-row').html(data.totalComForAgent)
        }
    ,
        complete: function () {
            ready = true
            $('.loading-fixed-top').css('display', 'none')
        }
    })
    }

    function fillter() {
        _department = $('#f_department').val()
        _period = $('#f_period').val()
        _time = $('#f_time').val()
        _time_end = $('#f_time_end').val()
        _time_start = $('#f_time_start').val()
        _country = $('#f_country').val()
        _type = $('#f_type').val()
        _status = $('#f_status').val()
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
            _status,
        )
        $('.table-div').scrollTop(0)

    }

    $(document)
        .on('change', '#f_time_start,#f_time_end,#f_department, #f_period, #f_time, #f_country, #f_status', function () {
            fillter()
        })
    $(document).on('click', '.btn_status', function (e) {
        e.preventDefault()
        _department = $('#f_department option:selected').attr('value')
        _period = $('#f_period').val()
        _time = $('#f_time').val()
        _time_end = $('#f_time_end').val()
        _time_start = $('#f_time_start').val()
        _country = $('#f_country').val()
        _type = $('#f_type').val()
        _status = $(this).data('value')
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
            _status,
        )
        $('.table-div').scrollTop(0)
    })

    $('.table-main-customer').scroll(function (e) {
        if (ready && Math.round($(this).scrollTop() + $(this)
            .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - $('#tbody_invoice').innerHeight()) {
            ready = false
            if (page < lastPage) {
                page++
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
                    _status)
            } else {
                ready = true
            }
        }
    })

    $(document).on('click', '.delete-filter', function (e) {
        e.preventDefault()
        @foreach($elementFilterIds as $element)
        $('#{{$element}}_filter').val('').change()
        @endforeach
        getCustomerTab()
    })
    @foreach($popup_form_element_class as $element_form)
    $(document).on('mouseover', '.{{$element_form}}', function (e) {
        e.preventDefault()
        var element = this
        $(element).fancybox({
            'width': 1200,
            'height': 900,
            'type': 'iframe',
            'autoScale': false,
            'autoSize': false,
            helpers: {
                title: {
                    type: 'float',
                },
            },
            afterClose: function () {
                var id = $(element).attr('data-id')
                var url = $(element).attr('data-url_edit')
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function (data) {
                        $('#{{$element_id_row_edit}}_' + data.id).replaceWith(data.view)
                    },
                })
            },
        })
    })
    @endforeach
    $(document).on('click', '.modal_delete', function (e) {
        e.preventDefault()
        let action_url = $(this).data('action')
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
                    url: action_url,
                    type: 'post',
                    data: {
                        '_token': '{{csrf_token()}}',
                        '_method': 'delete',
                    },
                    success: function (data) {
                        $('#data-customer_' + data.id).remove()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                        )
                    },
                })
            }
        })
    })
    $('#agent_id_filter').on('select2:select', function (e) {
        debounceAjax()
    })
</script>
@include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'initiated_date_filter'
],
'functionNameCall'=>'debounceAjax'
])
