@extends('back-end.layouts.main')

@section('title')
Test
@endsection


@section('content')
<!-- HEADER POST -->
<div class="wrapper wrapper-content">
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal">Open Modal</button>
	<div id="mymodal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Thêm mới chiến dịch</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div class="form-group row">
						<div class="col-md-6">
							<label for="text">Mã chiến dịch</label>
							<input type="text" class="form-control" id="ma-id" placeholder="Mã ID">
						</div>
						<div class="col-md-6">
							<label for="text">Tên chiến dịch</label>
							<input type="text" class="form-control" id="ten-cd" placeholder="Tên chiến dịch">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="text">Tiêu đề</label>
							<input type="text" class="form-control" id="tieu-de" placeholder="Tiêu đề">
						</div>
						<div class="col-md-6">
							<label for="text">Lên lịch</label>
							<input type="text" class="form-control" id="len-lich" placeholder="Lên lịch">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="text">Chức vụ</label>
							<select class="form-control" id="sel1">
								<option>Giáo viên</option>
								<option>Hiệu trưởng</option>
								<option>Hiệu phó</option>
								<option>Giáo viên</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="text">Hình thức gửi</label>
							<label class="checkbox-inline"><input type="checkbox" value=""><span>SMS</span></label>
							<label class="checkbox-inline"><input type="checkbox" value=""><span>Email</span></label>
							<label class="checkbox-inline"><input type="checkbox" value=""><span>App</span></label>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="text">Phạm vi gửi</label>
							<select class="form-control" id="sel1">
								<option>Toàn bộ trung tâm</option>
								<option>Hiệu trưởng</option>
								<option>Hiệu phó</option>
								<option>Giáo viên</option>
							</select>
						</div>
						<div class="col-md-6">
							<label for="textarea">Ghi chú</label>
							<textarea class="form-control" rows="5" id="comment" placeholder="Mô tả ngắn..."></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<label for="textarea">Nội dung</label>
							<textarea name="content" id="content" class="form-control my-editor" rows="5" required>
							</textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-them" data-dismiss="modal">Thêm</button>
				<button type="button" class="btn btn-default btn-huy" data-dismiss="modal">Hủy</button>
			</div>
		</div>
	</div>
</div>

@stop
@section('js')
<script>
	$(document).ready(function() {
		CKEDITOR.replace('content' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
	});
</script>
@endsection