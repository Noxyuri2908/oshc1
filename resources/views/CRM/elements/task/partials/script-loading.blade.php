<script>
    var {{$pageProposal}} = 1;
    var last{{$pageProposal}};
    var agent_proposal_filter = ''
    var processing_date_proposal_start = ''
    var processing_date_proposal_end = ''
    var issue_proposal_filter = ''
    var person_in_charge_proposal_filter = ''
    var proposal_proposal_filter = ''

    var ready{{$readyProposal}} = true
    var arrData = []

    function getproposals(page) {
        if (!page) {
            page = 1
        }
        $.ajax({
            url: "{{route('tasks.getProposals')}}",
            type: 'get',
            data: {
                page: page,
                @if(request()->get('report_end_date') && request()->get('report_start_date'))
                processing_date_proposal_start: "{{request()->get('report_start_date')}}",
                processing_date_proposal_end: "{{request()->get('report_end_date')}}",
                @endif
                    @if(request()->get('filter_date_option'))
                filter_date_option: "{{request()->get('filter_date_option')}}",
                @endif
            },
            success: function (data) {
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
                $('#proposal-data-sale').html(data.view)
                last{{$pageProposal}} = data.last_page
                // white-space-break-spaces
            },
        })
    }

    getproposals()

    function callAjaxProposal() {
        ready{{$readyProposal}} = false
        {{$pageProposal}} = 1
        agent_proposal_filter = $('#agent_proposal_filter').val()
        processing_date_proposal_start = $('#processing_date_proposal_start').val()
        processing_date_proposal_end = $('#processing_date_proposal_end').val()
        issue_proposal_filter = $('#issue_proposal_filter').val()
        person_in_charge_proposal_filter = $('#person_in_charge_proposal_filter').val()
        proposal_proposal_filter = $('#proposal_proposal_filter').val()
        getproposalsFilter(
            {{$pageProposal}},
            agent_proposal_filter,
            processing_date_proposal_start,
            processing_date_proposal_end,
            issue_proposal_filter,
            person_in_charge_proposal_filter,
            proposal_proposal_filter
            , 0)
        $('#box_data_customer').scrollTop(0)
    }

    function ajaxProposal(data) {
        if (ready{{$readyProposal}}) {
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

    $(document).on('keyup', '.last-row input', function (e) {
        debounceAjaxProposal(e.target.value)
    })
    $(document).on('change', '.last-row select', function (e) {
        debounceAjaxProposal(e.target.value)
    })

    $(document).on('keypress', function (e) {
        if (e.keyCode == 13 && ready{{$readyProposal}} && hoverTable == 'proposal') {
            callAjaxProposal()
        }
    })

    function getproposalsFilter(
        page,
        agent_proposal_filter,
        processing_date_proposal_start,
        processing_date_proposal_end,
        issue_proposal_filter,
        person_in_charge_proposal_filter,
        proposal_proposal_filter,
        isAppend,
    ) {

        $.ajax({
            url: "{{route('tasks.getProposals')}}",
            type: 'get',
            data: {
                page: page,
                agent_proposal_filter: agent_proposal_filter,
                processing_date_proposal_start: processing_date_proposal_start,
                processing_date_proposal_end: processing_date_proposal_end,
                issue_proposal_filter: issue_proposal_filter,
                person_in_charge_proposal_filter: person_in_charge_proposal_filter,
                proposal_proposal_filter: proposal_proposal_filter,
            },
            success: function (data) {
                console.log(data)
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
                if (isAppend == 0) {
                    $('#proposal-data-sale').html(data.view)
                } else if (isAppend == 1) {
                    $('#proposal-data-sale').append(data.view)
                }
                last{{$pageProposal}} = data.last_page
            },
            complete: function () {
                ready{{$readyProposal}} = true
            },
        })
    }

    $('.table-proposal').scroll(function (e) {
        if (ready{{$readyProposal}} && Math.round($(this).scrollTop() + $(this)
            .innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - 80) {
            ready{{$readyProposal}} = false
            if ({{$pageProposal}} < last{{$pageProposal}}) {
                {{$pageProposal}}++
                getproposalsFilter(
                    {{$pageProposal}},
                    agent_proposal_filter,
                    processing_date_proposal_start,
                    processing_date_proposal_end,
                    issue_proposal_filter,
                    person_in_charge_proposal_filter,
                    proposal_proposal_filter,
                    1)
            } else {
                ready{{$readyProposal}} = true
            }
        }
    })

    function deleteAllFilterproposals() {
        getproposals(1)
        $('#agent_proposal_filter').val('')
        $('#processing_date_proposal_start').val('')
        $('#processing_date_proposal_end').val('')
        $('#issue_proposal_filter').val('')
        $('#person_in_charge_proposal_filter').val('')
        $('#proposal_proposal_filter').val('')
        $('#box_data_customer').scrollTop(0)
    }

    $('#delete_all_proposal_fillter').on('click', function (e) {
        e.preventDefault()
        deleteAllFilterproposals()
    })

    //crud
    $(document).on('click', '.delete-proposal-agent', function (e) {
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

            if (result.isConfirmed && ready{{$readyProposal}}) {
                ready{{$readyProposal}} = false
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                    },
                    success: function (data) {
                        $('#proposals-' + id).remove()
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                        )
                        $('#modal_proposal').modal('hide')
                    }, complete: function () {
                        ready{{$readyProposal}} = true
                    },
                })
            }
        })
    })
    $(document).on('click', '#btn_add_new_proposal', function (e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        if (ready{{$readyProposal}}) {
            ready{{$readyProposal}} = false
            $.ajax({
                url: "{{route('crm.ajax.addNewProposal')}}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function (data) {
                    $('#modal_proposal_form').html(data)
                    $('#modal_proposal').modal('toggle')
                }, complete: function () {
                    ready{{$readyProposal}} = true
                },
            })
        }
        // }else{
        //     alert('No data selected !');
        // }
    })

    $(document).on('click', '.btn-submit-proposal-form', function (e) {
        e.preventDefault()
        let _url = $(this).attr('data-url')
        let _processing_date = $('#processing_date_proposal').val()
        let _issue = $('#issue_proposal').val()
        let _person_in_charge = $('#person_in_charge_proposal').val()
        let _proposal = $('#des_proposal').val()
        let _agent_id = $('#agent_follow_up').val()
        if (ready{{$readyProposal}}) {
            ready{{$readyProposal}} = false
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    _token: "{{csrf_token()}}",
                    processing_date: _processing_date,
                    issue: _issue,
                    person_in_charge: _person_in_charge,
                    proposal: _proposal,
                    user_id: _agent_id,
                    submit_from: 'task_sale',
                },
                success: function (data) {
                    // console.log(data);
                    if (data.type == 'create') {
                        {{$pageProposal}} = 1
                        $('#proposal-data-sale').html(data.view)
                        last{{$pageProposal}} = data.last_page
                    } else if (data.type == 'update') {
                        $('#proposals-' + data.id).replaceWith(data.view)
                    }
                    // $('#proposal-table').html(data);
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', { timeOut: 5000 })
                    $('#modal_proposal').modal('hide')
                }, complete: function () {
                    ready{{$readyProposal}} = true
                },
            })
        }
    })
    $(document).on('click', '.edit-proposal-agent', function (e) {
        e.preventDefault()
        var id = $(this).attr('data-id')
        var agent_id = $(this).attr('data-agent_id')
        if (ready{{$readyProposal}}) {
            ready{{$readyProposal}} = false

            $.ajax({
                url: "{{route('crm.ajax.editProposal')}}",
                type: 'get',
                data: {
                    id: id,
                    agent_id: agent_id,
                },
                success: function (data) {
                    $('#modal_proposal_form').html(data)
                    $('#modal_proposal').modal('toggle')
                }, complete: function () {
                    ready{{$readyProposal}} = true
                },
            })
        }
    })
    //end curd
</script>
