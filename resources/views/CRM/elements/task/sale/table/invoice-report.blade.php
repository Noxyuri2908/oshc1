
<div class="table-invoice-report table-div">
    <table class="">
        @include('CRM.elements.task.sale.table.invoice-report.header')
        <tbody id="invoice-report-data-sale">

        </tbody>
    </table>
</div>
<div id="invoice-report-sale-modal"></div>
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'processingDateinvoiceReportStart',
        'processingDateinvoiceReportEnd',
        'deadlineinvoiceReportStart',
        'deadlineinvoiceReportEnd',
        'processing_date_invoice-report',
        'deadline_invoice-report'
    ]]);
    <script>
        //load
        var pageinvoiceReport = 1;
        var lastpageinvoiceReport ;
        var iteminvoiceReportFilter = '';
        var processingDateinvoiceReportStart = '';
        var processingDateinvoiceReportEnd = '';
        var typeinvoiceReportFilter = '';
        var deadlineinvoiceReportStart = '';
        var deadlineinvoiceReportEnd = '';
        var resultinvoiceReportFilter = '';
        var readyinvoiceReport = true;
        var arrData = [];
        function getInvoiceReports(page){
            if(!page){
                page = 1;
            }
            $.ajax({
                url:"{{route('tasks.getInvoiceReports')}}",
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
                    $('#invoice-report-data-sale').html(data);
                },
                complete: function() {
                    readyinvoiceReport = true;
                }
            })
        }
        getInvoiceReports();

        $(document).on('keypress',function(e){
            if(e.keyCode == 13 && readyinvoiceReport && hoverTable == 'invoice-report'){
                readyinvoiceReport = false;
                pageCustomer = 1;
                pageinvoiceReport = 1;
                iteminvoiceReportFilter = $('#iteminvoiceReportFilter').val();
                processingDateinvoiceReportStart = $('#processingDateinvoiceReportStart').val();
                processingDateinvoiceReportEnd = $('#processingDateinvoiceReportEnd').val();
                typeinvoiceReportFilter = $('#typeinvoiceReportFilter').val();
                deadlineinvoiceReportStart = $('#deadlineinvoiceReportStart').val();
                deadlineinvoiceReportEnd = $('#deadlineinvoiceReportEnd').val();
                resultinvoiceReportFilter = $('#resultinvoiceReportFilter').val();
                getInvoiceReportsFilter(
                    pageCustomer,
                    iteminvoiceReportFilter,
                    processingDateinvoiceReportStart,
                    processingDateinvoiceReportEnd,
                    typeinvoiceReportFilter,
                    deadlineinvoiceReportStart,
                    deadlineinvoiceReportEnd,
                    resultinvoiceReportFilter,
                    0);
                $('#box_data_customer').scrollTop(0);
            }
        });

        function getInvoiceReportsFilter(
            page,
            iteminvoiceReportFilter,
            processingDateinvoiceReportStart,
            processingDateinvoiceReportEnd,
            typeinvoiceReportFilter,
            deadlineinvoiceReportStart,
            deadlineinvoiceReportEnd,
            resultinvoiceReportFilter,
            isAppend
        ){

            $.ajax({
                url:"{{route('tasks.getInvoiceReports')}}",
                type:'get',
                data:{
                    page:page,
                    iteminvoiceReportFilter:iteminvoiceReportFilter,
                    processingDateinvoiceReportStart:processingDateinvoiceReportStart,
                    processingDateinvoiceReportEnd:processingDateinvoiceReportEnd,
                    typeinvoiceReportFilter:typeinvoiceReportFilter,
                    deadlineinvoiceReportStart:deadlineinvoiceReportStart,
                    deadlineinvoiceReportEnd:deadlineinvoiceReportEnd,
                    resultinvoiceReportFilter:resultinvoiceReportFilter,
                },
                success:function(data){
                    if(isAppend == 0){
                        $('#invoice-report-data-sale').html(data.view);
                    }else if(isAppend == 1){
                        $('#invoice-report-data-sale').append(data.view);
                    }
                    lastpageinvoiceReport = data.last_page;
                },
                complete: function() {
                    readyinvoiceReport = true;
                }
            })
        }

        $('.table-invoice-report').scroll(function(e) {

            if(readyinvoiceReport && Math.round($(this).scrollTop() + $(this).innerHeight(),10) >= Math.round($(this)[0].scrollHeight,10)-80){
                readyinvoiceReport = false;
                if(pageinvoiceReport < lastpageinvoiceReport){
                    pageinvoiceReport++;
                    getInvoiceReportsFilter(
                        pageinvoiceReport,
                        iteminvoiceReportFilter,
                        processingDateinvoiceReportStart,
                        processingDateinvoiceReportEnd,
                        typeinvoiceReportFilter,
                        deadlineinvoiceReportStart,
                        deadlineinvoiceReportEnd,
                        resultinvoiceReportFilter,
                        1);
                }else{
                    readyinvoiceReport = true;
                }
            }
        });
        function deleteAllFilterinvoiceReports(){
            getInvoiceReports(1);
            $('#iteminvoiceReportFilter').val();
            $('#processingDateinvoiceReportStart').val();
            $('#processingDateinvoiceReportEnd').val();
            $('#typeinvoiceReportFilter').val();
            $('#deadlineinvoiceReportStart').val();
            $('#deadlineinvoiceReportEnd').val();
            $('#resultinvoiceReportFilter').val();
            $('#box_data_customer').scrollTop(0);
        }
        $('#delete_all_invoice-report_fillter').on('click',function(e){
            e.preventDefault();
            deleteAllFilterinvoiceReports();
        })

        //end load
    </script>
@endpush
