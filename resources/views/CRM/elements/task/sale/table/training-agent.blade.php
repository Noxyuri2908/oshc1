<div class="table-training table-div">
    <table class="">
        @include('CRM.elements.task.sale.table.training-agent.header')
        <tbody id="training-data-sale">

        </tbody>
    </table>
</div>
<div id="training-sale-modal"></div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[

        'processing_date_training',
        'deadline_training'
    ]]);
    <script>
        //load
        var pagetraining = 1
        var lastPagetraining
        var item_training_filter = ''
        var processing_date_training_start = ''
        var processing_date_training_end = ''
        var type_training_filter = ''
        var deadline_training_start = ''
        var deadline_training_end = ''
        var result_training_filter = ''
        var readytraining = true
        var arrData = []

        function gettrainings(page) {
            if (!page) {
                page = 1
            }
            $.ajax({
                url: "{{route('tasks.getTrainings')}}",
                type: 'get',
                data: {
                    page: page,
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    processing_date_training_start: "{{request()->get('report_start_date')}}",
                    processing_date_training_end: "{{request()->get('report_end_date')}}",
                    @endif
                        @if(request()->get('filter_date_option'))
                    filter_date_option: "{{request()->get('filter_date_option')}}"
                    @endif
                },
                success: function (data) {
                    $('#training-data-sale').html(data.view)
                    lastPagetraining = data.last_page
                },
                complete: function () {
                    readytraining = true
                },
            })
        }

        gettrainings()

        function callAjaxTraining() {
            readytraining = false
            pageCustomer = 1
            pagetraining = 1
            item_training_filter = $('#item_training_filter').val()
            processing_date_training_start = $('#processing_date_training_start').val()
            processing_date_training_end = $('#processing_date_training_end').val()
            type_training_filter = $('#type_training_filter').val()
            deadline_training_start = $('#deadline_training_start').val()
            deadline_training_end = $('#deadline_training_end').val()
            result_training_filter = $('#result_training_filter').val()
            gettrainingsFilter(
                pageCustomer,
                item_training_filter,
                processing_date_training_start,
                processing_date_training_end,
                type_training_filter,
                deadline_training_start,
                deadline_training_end,
                result_training_filter,
                0)
            $('#box_data_customer').scrollTop(0)
        }

        function ajaxTraining(data) {
            if (readytraining) {
                callAjaxTraining()
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

        const debounceAjaxTraining = debounce(ajaxTraining, 300)

        $(document).on('keyup', '.table-training .last-row input', function (e) {
            debounceAjaxTraining(e.target.value)
        })
        $(document).on('change', '.table-training .last-row select', function (e) {
            debounceAjaxTraining(e.target.value)
        })

        $(document).on('keypress', function (e) {
            if (e.keyCode == 13 && readytraining && hoverTable == 'training') {
                callAjaxTraining()
            }
        })

        function gettrainingsFilter(
            page,
            item_training_filter,
            processing_date_training_start,
            processing_date_training_end,
            type_training_filter,
            deadline_training_start,
            deadline_training_end,
            result_training_filter,
            isAppend,
        ) {

            $.ajax({
                url: "{{route('tasks.getTrainings')}}",
                type: 'get',
                data: {
                    page: page,
                    item_training_filter: item_training_filter,
                    processing_date_training_start: processing_date_training_start,
                    processing_date_training_end: processing_date_training_end,
                    type_training_filter: type_training_filter,
                    deadline_training_start: deadline_training_start,
                    deadline_training_end: deadline_training_end,
                    result_training_filter: result_training_filter,
                },
                success: function (data) {
                    if (isAppend == 0) {
                        $('#training-data-sale').html(data.view)
                    } else if (isAppend == 1) {
                        $('#training-data-sale').append(data.view)
                    }
                    lastPagetraining = data.last_page
                },
                complete: function () {
                    readytraining = true
                },
            })
        }

        $('.table-training').scroll(function (e) {

            if (readytraining && Math.round($(this).scrollTop() + $(this)
                .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
                readytraining = false
                if (pagetraining < lastPagetraining) {
                    pagetraining++
                    gettrainingsFilter(
                        pagetraining,
                        item_training_filter,
                        processing_date_training_start,
                        processing_date_training_end,
                        type_training_filter,
                        deadline_training_start,
                        deadline_training_end,
                        result_training_filter,
                        1)
                } else {
                    readytraining = true
                }
            }
        })

        function deleteAllFiltertrainings() {
            gettrainings(1)
            $('#item_training_filter').val()
            $('#processing_date_training_start').val()
            $('#processing_date_training_end').val()
            $('#type_training_filter').val()
            $('#deadline_training_start').val()
            $('#deadline_training_end').val()
            $('#result_training_filter').val()
            $('#box_data_customer').scrollTop(0)
        }

        $('#delete_all_training_fillter').on('click', function (e) {
            e.preventDefault()
            deleteAllFiltertrainings()
        })

        //end load
        //create
        $(document).on('click', '#create_training_sale', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            if (isClick == 'false') {
                $(this).attr('is-click', true)
                $.ajax({
                    url: '{{route("tasks.createTraining")}}',
                    type: 'get',
                    data: {},
                    success: function (data) {
                        $('#training-sale-modal').html(data)
                        $('#modal_training').modal('toggle')
                    },
                    complete: function () {
                        element.attr('is-click', false)
                    },
                })
            }

        })
        //end create
        //update
        $(document).on('click', '.edit-training-agent', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            var id = $(this).attr('data-id')
            var urlEdit = '{{route("tasks.editTraining",["id"=>"training_id"])}}'
            url = urlEdit.replace('training_id', id)
            $.ajax({
                url: url,
                type: 'get',
                data: {},
                success: function (data) {
                    $('#training-sale-modal').html(data)
                    $('#modal_training').modal('toggle')
                },
                complete: function () {
                    element.attr('is-click', false)
                },
            })
        })
        //end update
        //submit form
        $(document).on('click', '.btn-submit-training-form', function (e) {
            e.preventDefault()
            var isClick = $(this).attr('is-click')
            var element = $(this)
            var url = $(this).attr('data-url')
            var processing_date_training = $('#processing_date_training').val()
            var type_training = $('#type_training').val()
            var deadline_training = $('#deadline_training').val()
            var result_training = $('#result_training').val()
            var des_item_training = $('#des_item_training').val()
            var des_note_training = $('#des_note_training').val()
            if (isClick == 'false') {
                element.attr('is-click', true)
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        processing_date: processing_date_training,
                        type: type_training,
                        deadline: deadline_training,
                        result: result_training,
                        item: des_item_training,
                        note: des_note_training,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (data) {
                        $('#modal_training').modal('hide')
                        $('#training-data-sale').html(data.view)
                    },
                    complete: function () {
                        element.attr('is-click', false)
                    },
                })
            }
        })
        //end submit form
        //delete
        $(document).on('click', '.delete-training-agent', function (e) {
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
                            id: id,
                            _token: '{{csrf_token()}}',
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            )
                            $('#training-data-sale').html(data.view)
                        },
                    })

                }
            })

        })
        //end delete
    </script>
    @include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'processing_date_training_start',
        'processing_date_training_end',
        'deadline_training_start',
        'deadline_training_end',
    ],
    'functionNameCall'=>'debounceAjaxTraining'
    ])
@endpush
