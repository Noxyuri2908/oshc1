@extends('CRM.layouts.default')

@section('title')
PROVIDER COMMISSION MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-provider-com')
@stop

@section('js')
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
    // var editCom = ajax_url + "ajax/editProviderCom";
    var editCom = "{{route('crm.editProviderCom')}}";



	jQuery(document).ready(function($){
		$('#master').on('click', function(e) {
		    if($(this).is(':checked',true))
		    {
		      $(".sub_chk").prop('checked', true);
		    } else {
		      $(".sub_chk").prop('checked',false);
		    }
		});

		$(".sub_chk").on('click', function(e) {
		    if(!$(this).is(':checked',true))
		    {
		      $('#master').prop('checked', false);
		    }
		});

		$("#mainContent").delegate(".add_new", "click", function(){

			$('#modal_provider_com_add').modal('toggle');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){

			_id = $(this).data('id');
			$.get(editCom, {id: _id}, function (data) {
				$('#div_edit_provider_com').html(data);
				$('#modal_provider_com_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#provider_id').val(id);
			$('#modal_delete').modal('toggle');
		});

		// CKEDITOR.replace('content' ,{
		// 	filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// });
		// CKEDITOR.replace('content_sp' ,{
		// 	filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// });

	});
</script>
@stop
