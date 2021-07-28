<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="modal-form-import" action="{{route('import.price')}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn nhập vào hệ thống!</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<select class="form-control" name="service_id" id="service_id" required>
							<option label="">--Choose service--</option>
							@foreach($services as $service)
							<option value="{{$service->id}}">{{$service->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<input class="form-control-file" name="file" id="file" type="file" required>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Upload</button>        
				</div>
			</div>
		</form>
	</div>
</div> 