
<div class="table-agent-report table-div">
    <table class="">
        @include('CRM.elements.task.sale.table.agent-report.header')
        <tbody id="agent-report-data-sale">

        </tbody>
    </table>
</div>
<div id="agent-report-sale-modal"></div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'processingDateAgentReportStart',
        'processingDateAgentReportEnd',
        'deadlineAgentReportStart',
        'deadlineAgentReportEnd',
        'processing_date_agent-report',
        'deadline_agent-report'
    ]]);
    <script>

        function showModel(elm)
        {
            var id = elm.getAttribute('id');
            var content = $(`#${id}`).data('content');

            if (elm.getAttribute('id') === 'content_note_new_agent')
            {
                var contentAtt = elm.innerText;
            }else{

                var contentAtt = ''
                content.forEach(function (e){
                    contentAtt += e+'<br>';
                })
            }

            var html = '';
            html += '<div class="modal fade show" role="dialog" id="modelAgent" style="display: block" onclick="hideModelAgent()">'
            html += '<div class="modal-dialog">'
            html += '<div class="modal-content">'
            html += '<div class="modal-header">'
            html += '<button type="button" class="close" data-dismiss="modal">&times;</button>'
            html += '</div>'
            html += '<div class="modal-body">'
            html += `<div><p style="white-space: pre-wrap;">${contentAtt}</p></div>`
            html += '</div>'
            html += '<div class="modal-footer">'
            html += '<button type="button" class="btn btn-default " id="close-model-attendees" onclick="hideModelAgent()">Close</button>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            html += '</div>'
            elm.insertAdjacentHTML("beforebegin", html);
            $('body').append('<div class="modal-backdrop fade show"></div>')
            $('body').addClass('modal-open')
        }

        function hideModelAgent()
        {
            $('#modelAgent').remove();
            $('.modal-backdrop').remove()
            $('body').removeClass('modal-open')
        }

        //load
        var pageAgentReport = 1;
        var lastpageAgentReport ;
        var itemAgentReportFilter = '';
        var processingDateAgentReportStart = '';
        var processingDateAgentReportEnd = '';
        var typeAgentReportFilter = '';
        var deadlineAgentReportStart = '';
        var deadlineAgentReportEnd = '';
        var resultAgentReportFilter = '';
        var readyagentReport = true;
        var arrData = [];
        function getAgentReports(page){
            if(!page){
                page = 1;
            }
            $.ajax({
                url:"{{route('tasks.getAgentReports')}}",
                type:'get',
                data:{
                    page:page,
                    @if(request()->get('report_end_date') && request()->get('report_start_date'))
                    report_start_date: "{{request()->get('report_start_date')}}",
                    report_end_date: "{{request()->get('report_end_date')}}",
                    @endif
                    @if(request()->get('filter_date_option'))
                    filter_date_option:"{{request()->get('filter_date_option')}}"
                    @endif
                },
                success:function(data){
                    $('#agent-report-data-sale').html(data);
                },
                complete: function() {
                    readyagentReport = true;
                }
            })
        }
        getAgentReports();

        function callAjax(){
            readyagentReport = false;
            pageCustomer = 1;
            pageAgentReport = 1;
            itemAgentReportFilter = $('#itemAgentReportFilter').val();
            processingDateAgentReportStart = $('#processingDateAgentReportStart').val();
            processingDateAgentReportEnd = $('#processingDateAgentReportEnd').val();
            typeAgentReportFilter = $('#typeAgentReportFilter').val();
            deadlineAgentReportStart = $('#deadlineAgentReportStart').val();
            deadlineAgentReportEnd = $('#deadlineAgentReportEnd').val();
            resultAgentReportFilter = $('#resultAgentReportFilter').val();
            getAgentReportsFilter(
                pageCustomer,
                itemAgentReportFilter,
                processingDateAgentReportStart,
                processingDateAgentReportEnd,
                typeAgentReportFilter,
                deadlineAgentReportStart,
                deadlineAgentReportEnd,
                resultAgentReportFilter,
                0);
            $('#box_data_customer').scrollTop(0);
        }
        function ajax(data){
            if (readyagentReport) {
                callAjax();
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

        $(document).on('keyup','.last-row input',function(e){
            debounceAjax(e.target.value);
        });
        $(document).on('change','.last-row select',function(e){
            debounceAjax(e.target.value);
        });
        $(document).on('keypress',function(e){
            if(e.keyCode == 13 && readyagentReport && hoverTable == 'agent-report'){
                readyagentReport = false;
                pageCustomer = 1;
                pageAgentReport = 1;
                itemAgentReportFilter = $('#itemAgentReportFilter').val();
                processingDateAgentReportStart = $('#processingDateAgentReportStart').val();
                processingDateAgentReportEnd = $('#processingDateAgentReportEnd').val();
                typeAgentReportFilter = $('#typeAgentReportFilter').val();
                deadlineAgentReportStart = $('#deadlineAgentReportStart').val();
                deadlineAgentReportEnd = $('#deadlineAgentReportEnd').val();
                resultAgentReportFilter = $('#resultAgentReportFilter').val();
                getAgentReportsFilter(
                    pageCustomer,
                    itemAgentReportFilter,
                    processingDateAgentReportStart,
                    processingDateAgentReportEnd,
                    typeAgentReportFilter,
                    deadlineAgentReportStart,
                    deadlineAgentReportEnd,
                    resultAgentReportFilter,
                    0);
                $('#box_data_customer').scrollTop(0);
            }
        });

        function getAgentReportsFilter(
            page,
            itemAgentReportFilter,
            processingDateAgentReportStart,
            processingDateAgentReportEnd,
            typeAgentReportFilter,
            deadlineAgentReportStart,
            deadlineAgentReportEnd,
            resultAgentReportFilter,
            isAppend
        ){

            $.ajax({
                url:"{{route('tasks.getAgentReports')}}",
                type:'get',
                data:{
                    page:page,
                    itemAgentReportFilter:itemAgentReportFilter,
                    processingDateAgentReportStart:processingDateAgentReportStart,
                    processingDateAgentReportEnd:processingDateAgentReportEnd,
                    typeAgentReportFilter:typeAgentReportFilter,
                    deadlineAgentReportStart:deadlineAgentReportStart,
                    deadlineAgentReportEnd:deadlineAgentReportEnd,
                    resultAgentReportFilter:resultAgentReportFilter,
                },
                success:function(data){
                    if(isAppend == 0){
                        $('#agent-report-data-sale').html(data.view);
                    }else if(isAppend == 1){
                        $('#agent-report-data-sale').append(data.view);
                    }
                    lastpageAgentReport = data.last_page;
                },
                complete: function() {
                    readyagentReport = true;
                }
            })
        }

        $('.table-agent-report').scroll(function(e) {

            if(readyagentReport && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
                readyagentReport = false;
                if(pageAgentReport < lastpageAgentReport){
                    pageAgentReport++;
                    getAgentReportsFilter(
                        pageAgentReport,
                        itemAgentReportFilter,
                        processingDateAgentReportStart,
                        processingDateAgentReportEnd,
                        typeAgentReportFilter,
                        deadlineAgentReportStart,
                        deadlineAgentReportEnd,
                        resultAgentReportFilter,
                        1);
                }else{
                    readyagentReport = true;
                }
            }
        });
        function deleteAllFilterAgentReports(){
            getAgentReports(1);
            $('#itemAgentReportFilter').val();
            $('#processingDateAgentReportStart').val();
            $('#processingDateAgentReportEnd').val();
            $('#typeAgentReportFilter').val();
            $('#deadlineAgentReportStart').val();
            $('#deadlineAgentReportEnd').val();
            $('#resultAgentReportFilter').val();
            $('#box_data_customer').scrollTop(0);
        }
        $('#delete_all_agent-report_fillter').on('click',function(e){
            e.preventDefault();
            deleteAllFilterAgentReports();
        })

        //end load
    </script>
@endpush
