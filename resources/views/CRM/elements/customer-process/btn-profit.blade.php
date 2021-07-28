@php
    $hh = $obj->hoahong;
    if($hh != null){
        $payment_note = $hh->payment_note_provider;
            $text_com = null;
        $agent = $obj->agent;
        if($payment_note == 1){
            $comm = $obj->getCom();
            if($comm != null){
                $text_com = $comm->comm;
            }
        }
        $profit = $obj->profit->first();
    }
@endphp
@if($hh != null)
    @if(!empty($profit) && auth()->user()->can('profitInvoice.update'))
        <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_profit">
            <span class="far fa-save" data-fa-transform="shrink-3"></span> Update
        </button>
        <a href="#" class="btn btn-falcon-default btn-sm mr-1 mb-1" id="btn_reset_profit" data-url="{{route('crm.ajax.deleteProfit',['id'=>$profit->id])}}">Reset</a>
    @elseif(empty($profit) && auth()->user()->can('profitInvoice.store'))
        <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_profit">
            <span class="far fa-save" data-fa-transform="shrink-3"></span> Save
        </button>
    @endif
    <div id="alert_msg_profit"></div>
    <hr>
    @include('CRM.elements.customer-process.form-profit', ['profit'=>$profit])
@else
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>Can not find commission data !</div>
@endif
<script>
    $(document).on('click','#btn_reset_profit',function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let id = $(this).attr('data-id');
        if (confirm("Are you sure?") == true) {
            $.ajax({
                url:url,
                type:'post',
                data:{
                    _token:"{{csrf_token()}}"
                },
                success:function (data) {
                    if(data.success == 1){
                        location.reload();
                    }
                }
            })
        }
    });

    $(document).ready(function (){
       var date_pay_provider = $('#pay_provider_date').val();
       if (date_pay_provider === "")
       {
           getDateOfPayment();
       }

       $('#profit-tab').on('click', function (){
           getDateOfPayment();
       })
    });

    function getDateOfPayment()
    {
        var id = window.location.pathname;
        id = id.split('/');
        var agent = id[4];

        $.ajax({
            url:"{{route('ajax.getDateOfPayment')}}",
            type:'post',
            data:{
                _token:"{{csrf_token()}}",
                agent
            },
            success:function (data) {
                $('#pay_provider_date').val(data.date);
            }
        })
    }
</script>
