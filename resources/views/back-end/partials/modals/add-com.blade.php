<div class="modal fade" id="addComm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Enter information commission</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<select class="form-control" name="new_service_id" id="new_service_id">
						<option label="">Choose service</option>
						@foreach($products as $product)
						<option value="{{$product->id}}">{{$product->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" name="new_policy_id" id="new_policy_id">
						<option label="">Choose policy</option>
						<option value="1">Single</option>
						<option value="2">Couple</option>
						<option value="3">Family</option>
					</select>
				</div>
				<div class="form-group">
					<input class="form-control" name="new_comm_id" id="new_comm_id" type="text" placeholder=" Value of commission">
				</div>
				<div class="form-group">
					<input class="form-control" name="new_date_id" id="new_date_id" type="text" placeholder=" End date of commission">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary add-new-btn-modal">Submit</button>
			</div>
		</div>
	</div>
</div> 