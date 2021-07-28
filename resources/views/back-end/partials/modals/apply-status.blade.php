<div id="applyModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title_apply_status"></h4>
			</div>
			<div class="modal-body">	
				<form id="modal-form-apply-status" action="" method="POST">
		          @csrf
		          <input type ="hidden" value="" id="value_apply_status" name="value_apply_status">
		          <button class="btn hoi" type="submit">Có</button>
		          <button type="button" class="close" data-dismiss="modal">Không
				 </button>
		        </form>			
			</div>
		</div>
	</div>
</div>