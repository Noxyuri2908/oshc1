<script>
    $(document).on('click','.remind-invoice',function(e){
        e.preventDefault();
        if($('#modalRemindStatus').length == 0){
            alert('Chọn khách hàng để tạo mới');
        }
        $('#modalRemindStatus').modal('show');
    });
    $(document).on('click','.remind-extend-invoice',function(e){
        if($(this).attr('href') == '#'){
            e.preventDefault();
            alert('Error');
        }
    })
    $(document).on('click','.save-remind-form',function(e){
        let apply_id = $(this).data('id');
        let remind_status_id = $('#remind_status_id').val();
        let remind_processing_date = $('#remind_processing_date').val();
        let remind_status_note = $('#remind_status_note').val();
        let urlRemind = '{{route("ajax.storeRemind",["id"=>"%id"])}}';
        urlRemind = urlRemind.replace('%id',apply_id);

        $.ajax({
            url:urlRemind,
            data:{
                remind_status_id:remind_status_id,
                remind_status_note:remind_status_note,
                remind_processing_date:remind_processing_date,
                _token:'{{ csrf_token()}}'
            },
            type:'post',
            success:function(data){
                $('#modalRemindStatus').modal('hide');
                if(data.success){
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                }
                location.reload();
            }
        })
    })
</script>
