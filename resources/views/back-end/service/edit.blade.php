@extends('back-end.layouts.main')

@section('title')
Thay đổi dịch vụ
@endsection

@section('css')
<link href="{{asset('backend/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">

@endsection

{{-- Page content --}}
@section('content')
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Thông tin chi tiết</h5>
			</div>
			<div class="ibox-content">
				@include('back-end.partials.alert-msg')
				<form id="form" class="form-horizontal" role="form" action="{{route('service.update',['id'=>$obj->id])}}"
				enctype="multipart/form-data" method="POST">
				@method('PATCH')
				@csrf
					@include('back-end.service.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" >Làm mới</button>
							<button class="btn btn-primary" type="submit">Cập nhật</button>
						</div>
					</div>
				</form>
                <div class="form-group">
                    <a class="covers" data-toggle="modal" id="click-modal" data-target="#covers" style="text-decoration: underline">Config Covers</a>
                    <div class="inner wrapper-cover">
                        <table class="table-cover">
                            <thead>
                            <tr>
                                <th>Policys</th>
                                <th>Covers</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="body-data-cover">
                                @include('back-end.cover.tbody-data', ['covers' => $covers])
                            </tbody>

                        </table>
                    </div>
                    <div class="modal fade" id="covers" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Config Covers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="wrapper-modal-cover">
                                        <div class="option">
                                            <label for="" class="control-label">Policy</label>
                                            <select name="policy-cover" id="policy-cover">
                                                @foreach(config('myconfig.policy') as $key => $item)
                                                    <option value="{{$key}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="option">
                                            <label for="" class="control-label">Cover</label>
                                            <input type="text" name="cover-input" id="cover-input" style="width: 300px">
                                        </div>

                                        <input type="hidden" value="" id="action-modal">
                                        <input type="hidden" value="" id="contain-cover-id">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="status">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('keypress', function (e){
            var cover = $('#cover-input').val();
            var policy = $('#policy-cover').val();
            var action = $('#action-modal').val();
            var cover_id = $('#contain-cover-id').val();
            if (e.which == 13){
                if (policy == 'null') return alert('bạn chưa chọn policy');
                cancleFormSubmit();
                ajaxPushStoreCover(cover, policy, action, cover_id);

            }
        })

        // click action edit cover
        function btnEdit(obj)
        {
            $('#covers').modal('show');

            var cover = obj.parentElement.previousElementSibling.textContent;
            var policy = obj.parentElement.previousElementSibling.previousElementSibling.getAttribute('data-policy');
            var cover_id = obj.parentElement.getAttribute('data-id');

            $('#cover-input').val(cover); // set cover
            $('#policy-cover').val(policy).change(); // set policy
            $('#action-modal').val('update'); // set action
            $('#contain-cover-id').val(cover_id); // get and set id cover
        }

        // click action remove cover
        function btnRemove(obj){
            var coverId = obj.parentElement.getAttribute('data-id');
            $.ajax({
                url : '{{route('removeCoverById')}}',
                type : 'POST',
                data : {
                    _token: "{{ csrf_token() }}",
                    id : coverId
                },
                success : function (data){
                    if (data.error) return alert(data.error);

                    return obj.parentElement.parentElement.remove();
                }
            });

        }

        function cancleFormSubmit()
        {
            $("form#form").submit(function(e){
                e.preventDefault();
            });
        }

        function ajaxPushStoreCover(cover, policy, action, cover_id)
        {
            $.ajax({
                url : '{{route('pushStoreCover')}}',
                type : 'POST',
                data : {
                    _token: "{{ csrf_token() }}",
                    service_id : {{$obj->id}},
                    policy,
                    cover,
                    action,
                    cover_id
                },
                success : function (data){
                    if (data.error) return alert('Error : please call admin check code');

                    $('#cover-input').val('');
                    $('.status').text(data.message).fadeIn(2000, function (){
                        $(this).fadeOut(4000);
                    });
                    $('#covers').modal('hide');
                    return $('#body-data-cover').html(data.view);
                }
                });
        }
    </script>
@endpush

@section('js')
<script src="{{asset('js/slug.js')}}"></script>
<script src="{{asset('backend/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script>
	var ckeditor_path = $("#ckeditor_path").val();
	$(document).ready(function() {

        // add new hospital
        $('#submit_add_hospital').on('click', () => {
            let hospital = $('#hospital_input').val();
            if (hospital > 0)
            {
                $.ajax({
                    url : '{{route('hospital.add')}}',
                    type : 'POST',
                    data : {
                        _token: "{{ csrf_token() }}",
                        service_id : {{$obj->id}},
                        hospital
                    },
                    success : function (data){
                        $('#hospital_acc').append($('<option>', {
                            value: data.id,
                            text: data.hostpital_access
                        }));
                        $('#hospital_input').val('');
                    }
                });
            }
        });

        // on change select hospital
        $('#hospital_acc').on('change', () => {
            let hospital = $('#hospital_acc').find(":selected").text();
            $('#hospital_input').val(hospital);
            $('#hospital_del').val($('#hospital_acc').find(":selected").val());
            $('#submit_add_hospital').css('display', 'none');
            $('#submit_remove_hospital').css('display', 'inline-block');
            $('#submit_update_hospital').css('display', 'inline-block');
        })

        // update hospital
        $('#submit_update_hospital').on('click', () => {
            let hospital = $('#hospital_input').val();
            if (hospital > 0) {
                $.ajax({
                    url: '{{route('hospital.update')}}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        hospital: $('#hospital_del').val(),
                        value: hospital
                    },
                    success: function (data) {
                        if (data === '1') {
                            $('#hospital_input').val('');
                            $('#submit_remove_hospital').css('display', 'none')
                            $('#submit_add_hospital').css('display', 'inline-block')
                            $('#hospital_acc').find(":selected").html($('<option>', {
                                value: $('#hospital_del').val(),
                                text: hospital
                            }));
                        }
                    }
                });
            }
        });

        // del hospital
        $('#submit_remove_hospital').on('click', () => {
            let hospital = $('#hospital_input').val();
            if (hospital > 0)
            {
                $.ajax({
                    url : '{{route('hospital.remove')}}',
                    type : 'POST',
                    data : {
                        _token: "{{ csrf_token() }}",
                        hospital : $('#hospital_del').val(),
                    },
                    success : function (data){
                        if (data === '1'){
                            $('#hospital_input').val('');
                            $('#submit_remove_hospital').css('display', 'none')
                            $('#submit_add_hospital').css('display', 'inline-block')
                            $('#hospital_acc').find(":selected").remove();
                        }
                    }
                });
            }
        });

		settingIframe("#iframe-btn-0", "#thumb_0", "#preview_0");
		CKEDITOR.replace('des_f' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
		$('.chosen-select').chosen({width: "100%"});
	});
</script>
@endsection
