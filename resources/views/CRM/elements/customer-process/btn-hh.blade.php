@php
$hh = $obj->hoahong;
@endphp
@if($hh == null && auth()->user()->can('commissionInvoice.store'))
    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_hh">
        <span class="far fa-save" data-fa-transform="shrink-3"></span> Save
    </button>
@elseif(!empty($hh) && auth()->user()->can('commissionInvoice.update'))
<button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" id="btn_save_hh">
	<span class="far fa-save" data-fa-transform="shrink-3"></span> Update
</button>
@endcan
@if(!empty($hh))
<a href="#" class="btn btn-falcon-default btn-sm mr-1 mb-1" id="btn_reset_com" data-url="{{route('crm.hoahong.delete',['id'=>$hh->id])}}" data-id="{{$hh->id}}" >Reset</a>
@endif<div id="alert_msg_hh"></div>
<hr>
@include('CRM.elements.customer-process.form-hh',['hh'=>$hh])
@push('scripts')
    <script>
        $(document).on('click','#btn_reset_com',function(e){
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
    </script>
@endpush
