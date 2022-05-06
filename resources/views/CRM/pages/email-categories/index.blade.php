@extends('CRM.layouts.default')

@section('title')
    Email Tempaltes
    @parent
@stop

@section('css')
    @include('CRM.partials.loading-css')
@stop
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7">
                <h4 class="page-title text-truncate text-dark font-weight-bold mb-1"> Email Categories</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item text-muted active" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Email Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="row">
                <!--       START FORM show categories         -->
                <div style="border-right: 1px solid #ccc;" class="col-md-6">
                    <div class="table-email-templates">
                        <table class="w-100">
                            <thead>
                            <tr class="bg-color-email-template text-center">
                                <th class="width-15">STT</th>
                                <th class="width-140">Name</th>
                                <th class="width-25">Status</th>
                                <th class="width-25">Action</th>
                            </tr>
                            </thead>

                            <tbody id="data-categories">
                            @include('CRM.pages.email-categories.data', ['emailCategories' => $emailCategories]) {{--resources/views/CRM/pages/email-categories/data.blade.php--}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--       END FORM show catetories         -->

                <!--       START FORM ADD + UPDATE CATEGORIES         -->
                <div class="col-md-6">
                    <div class="row">


                        <input type="hidden" id="id-pickup" data-id="">
                        <div class="col-md-6 form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="cat-name-edit">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="" class="position-relative" style="left: 18px">Status</label>
                            <div class="button-cover position-absolute " style="top: 40px">
                                <div class="button r" id="button-2">
                                    <input type="checkbox"
                                           class="checkbox" {{!empty($emailTemplate) && $emailTemplate->status == 1 ? 'checked': ''}}>
                                    <div class="knobs"></div>
                                    <div class="layer"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 form-group">
                            <label for=""></label>
                            <input type="submit" class="form-control" id="btn-clear-value" value="Clear value"
                                   style="display: none">

                        </div>
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 "
                                    id="btn-action"
                                    style="border-radius: 12px">
                                Add new
                            </button>
                        </div>
                    </div>
                </div>
                <!--       END FORM ADD + UPDATE CATEGORIES         -->
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {

            $(document).on('click', '#btn-edit', function (e) { // action move value to form
                e.preventDefault();
                var id = $(this).attr('data-id');

                $('#btn-action').text('Update'); // change text btn
                $('#btn-clear-value').css('display', 'block'); // change text btn

                var catName = $(`#cat-${id} > #cat-name`).text(); // get cat name
                var catStatus = $(`#cat-${id} > td > span#cat-status`).text(); // get cat status

                $('#cat-name-edit').val(catName);
                $('#id-pickup').val(id);
                if (catStatus === 'Active') {
                    $('input[type="checkbox"]').prop('checked', false)
                } else if (catStatus === 'Deactive') {
                    $('input[type="checkbox"]').prop('checked', true)
                }
            })

            $(document).on('click', '#btn-action', function (e) { // handle action with text in tag
                var action = $(this).text().trim(); // get name action
                var urlEvent = "{{route('email.email-categories.event')}}";

                var id = $('#id-pickup').val();
                var name = $('#cat-name-edit').val();
                var status = $('input[type="checkbox"]').is(':checked') ? 0 : 1;


                if (action === 'Update') {
                    objectProcessEmail.handleEventAjaxEmail({urlEvent, id, name, status, action});
                } else if (action === 'Add new') {
                    objectProcessEmail.handleEventAjaxEmail({urlEvent, id, name, status, action});
                }
            })

            $(document).on('click', '#btn-clear-value', function () { // action clear value in form
                $('#cat-name-edit').val(''); // clear value
                $('input[type="checkbox"]').prop('checked', false) // change status
                $('#btn-action').text('Add new'); // change text btn
            });


            $(document).on('click', '#destroy', function (e) { // action delete record
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {

                        var urlEvent = "{{route('email.email-categories.event')}}";
                        var action = 'Delete';
                        var id = $(this).attr('data-id');

                        objectProcessEmail.handleEventAjaxEmail({urlEvent, id, action});

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        })

        var objectProcessEmail = {
            handleEventAjaxEmail: function (...rest) {
                $.ajax({
                    url: rest[0].urlEvent,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: rest[0].id ?? '',
                        name: rest[0].name ?? '',
                        status: rest[0].status ?? '',
                        action: rest[0].action ?? ''
                    },
                    success: function (result) {
                        if (result.code == 200) {
                            $('#data-categories').html(result.view);
                            Notiflix.Notify.success(`${result.message}`);
                        }
                    }
                })
            }
        }
    </script>
@endpush
