<script>
    $(document).keydown(function (event) {
        if (event.keyCode == 40) {
            event.preventDefault();
            if ($('#tbody_invoice tr.selected_row').length == 0) {
                $('#tbody_invoice tr:first').addClass('selected_row');
                $('#tbody_invoice tr:first').children('td').css('background-color', '#ccc');
            } else if ($('#tbody_invoice tr.selected_row').length > 0) {
                $('.data-commission td').css('background-color', '');
                $('.data-customer td').css('background-color', '');
                $('.data-profit td').css('background-color', '');
                $('.data-refund td').css('background-color', '');
                selectElement = $('#tbody_invoice tr.selected_row');
                nextElement = $('#tbody_invoice tr.selected_row').next();
                nextElement.addClass('selected_row');
                nextElement.children('td').css('background-color', '#ccc');
                selectElement.removeClass('selected_row');
            }


            // console.log($('.selected_row:first').offset().top);
        } else if (event.keyCode == 38) {
            event.preventDefault();
            if ($('#tbody_invoice tr.selected_row').length == 0) {
                $('#tbody_invoice tr:last').addClass('selected_row');
                $('#tbody_invoice tr:last').children('td').css('background-color', '#ccc');
            } else if ($('#tbody_invoice tr.selected_row').length > 0) {
                $('.data-commission td').css('background-color', '');
                $('.data-customer td').css('background-color', '');
                $('.data-profit td').css('background-color', '');
                $('.data-refund td').css('background-color', '');
                selectElement = $('#tbody_invoice tr.selected_row');
                nextElement = $('#tbody_invoice tr.selected_row').prev();
                nextElement.addClass('selected_row');
                nextElement.children('td').css('background-color', '#ccc');
                selectElement.removeClass('selected_row');
            }
        }
        // $("#tbody_invoice").scroll(function(e){
        //     console.log(e);
        // });
        // $("#tbody_invoice").scrollTop(0);
        // $("#tbody_invoice").scrollTop($('.selected_row:first').offset().top - $("#tbody_invoice").height());
    })

    $(document).on('click', '#on_delete_data', function (e) {
        e.preventDefault();
        var _type = $(this).data('type');
        var _url = $(this).data('url');
        var _id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                    success: function (data) {
                        if (data.success == 1) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload();
                        }
                    }
                })

            }
        })

    })





    (function () {
        $('.table-responsive-sm').on('shown.bs.dropdown', function (e) {
            var $table = $(this),
                $menu = $(e.target).find('.dropdown-menu'),
                tableOffsetHeight = $table.offset().top + $table.height(),
                menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

            if (menuOffsetHeight > tableOffsetHeight)
                $('#table-all').css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
        });
        $('.table-responsive-sm').on('hide.bs.dropdown', function () {
            $('#table-all').css("padding-bottom", 0);
        })
    })();


    $(document).on('click', '.delete_doc', function (e) {
        e.preventDefault();
        let _url = '{{route('apply.tailieu.destroy')}}'
        let _id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: _url,
                    type: 'post',
                    dataType: 'html',
                    data: {
                        data_del: _id,
                        _token: '{{csrf_token()}}',
                        action: 'customer_docs_receipt_delete'
                    },
                    success: function (data) {
                        $('#div_table_doc_receipt').html(data);
                    }
                })
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })

    })

    function check(input) {
        if (input.value == 0) {
            input.setCustomValidity('The number must not be zero.');
        } else {
            // input is fine -- reset the error message
            input.setCustomValidity('');
        }
    }

    $(document).on('click', '.edit_doc', function (e) {
        e.preventDefault();
        _id = $('#_id').val();
        _url = '{{route('ajax.getFormEditTailieu')}}';
        _tailieu_id = $(this).data('id');
        $.get(_url, {id: _id, type: 'customer_docs', tailieu_id: _tailieu_id}, function (data) {
            $('#div_modal_doc').html(data);
            $('#tailieuModal').modal('toggle');
            $('#form-docs-action').val('customer_docs_receipt_update');
        });
    })


    function storeDocs(formdata) {
        $.ajax({
            url: '{{route('apply.tailieu.store')}}',
            data: formdata,
            type: 'post',
            dataType: 'html',
            processData: false,
            contentType: false,
            success: function (data) {
                $('#div_table_doc_receipt').html(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#tailieuModal').modal('hide');
            }
        })
    }

    function updateDocs(formdata) {
        var url = '{{route('apply.tailieu.update',":id")}}';
        var _tailieu_id = formdata.get('tailieu_id');
        url = url.replace(':id', _tailieu_id);
        $.ajax({
            url: url,
            data: formdata,
            type: 'post',
            dataType: 'html',
            processData: false,
            contentType: false,
            success: function (data) {
                $('#div_table_doc_receipt').html(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#tailieuModal').modal('hide');
            }
        })
    }

    $(document).ajaxStart(function () {
        $('#loading-overlay').show();
    });
    $(document).ajaxComplete(function () {
        $('#loading-overlay').hide();
    });
    $(document).delegate("#btn_add_doc", "click", function () {
        _id = $(this).attr('data-id');
        _html = '';
        if (_id > 0) {
            _url = '{{route('ajax.getFormCreateTailieu')}}';
            $.get(_url, {id: _id, type: 'customer_docs'}, function (data) {
                $('#div_modal_doc').html(data);
                $('#tailieuModal').modal('toggle');
                $('#form-docs-action').val('customer_docs_receipt_create')
            });
        } else {
            _html += '<div class="alert alert-danger">Chọn khách hàng để tạo mới</div>';
            $('.alert-modal-receipt').html(_html);
        }
    });

    $(document).on('submit', '#form-scan-modal', function (e) {
        e.preventDefault();
        var formdata = new FormData($(this)[0]);
        console.log(formdata.get('action'), formdata.get('apply_id'));
        if (formdata.get('action') == 'customer_docs_receipt_create') {
            storeDocs(formdata);
        } else if (formdata.get('action') == 'customer_docs_receipt_update') {
            updateDocs(formdata);
        }
    });
</script>
