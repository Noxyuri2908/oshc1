@extends('CRM.layouts.default')

@section('title')
EXCHANGE RATE MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-exchange')
@stop

@section('js')
<script src="{{asset('js/filemanage.js')}}"></script>
@if ($errors->any())
    <script>
        $('#modal_exchange_add').modal('show');
    </script>
    @endif
    @include('CRM.partials.number_currency',['ids'=>[
        'unit_to_aud',
        'aud_to_vnd'
    ]])
    <script>
            $(document).on('change','.content-information #type',function(e){
                let flywire_com_provider_id = '{{$typeFlywireComProvider}}';
                let flywire_com_agent_id = '{{$typeFlywireComAgent}}';
                let value = $(this).val();
                if(value == flywire_com_provider_id){
                    $('.unit_form').show();
                    $('.month_form').hide();
                    $('.exchange_rate_form').hide();
                    $('.quarter_form').show();
                    $('.unit_to_aud_form').show();
                    $('.aud_to_vnd_form').hide();
                }else if(value == flywire_com_agent_id){
                    $('.unit_form').hide();
                    $('.month_form').hide();
                    $('.exchange_rate_form').hide();
                    $('.quarter_form').show();
                    $('.unit_to_aud_form').hide();
                    $('.aud_to_vnd_form').show();
                }else{
                    $('.unit_form').show();
                    $('.quarter_form').hide();
                    $('.unit_to_aud_form').hide();
                    $('.aud_to_vnd_form').hide();
                    $('.month_form').show();
                    $('.exchange_rate_form').show();
                }
            });
    </script>
<script>


	var ajax_url = $("#ajax_crm_url").val();
	// var editEx = ajax_url + "ajax/editEchange";
	// var searchEx = ajax_url + "ajax/searchExchange";
	// var export_url = ajax_url + "export/Exchange";
    var editEx = "{{route('crm.editEchange')}}";
	var searchEx = ajax_url + "ajax/searchExchange";
	var export_url = ajax_url + "export/Exchange";

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

		$("#mainContent").delegate(".export", "click", function(){
			window.open(export_url);
		});

		$("#mainContent").delegate("#f_month, #f_year, #f_type, #f_created_by", "change", function(){
			_month = $('#f_month').val();
			_year = $('#f_year').val();
			_type = $('#f_type').val();
			_created_by = $('#f_created_by').val();
			$.get(searchEx, {f_month: _month, f_year: _year, f_type: _type, f_created_by: _created_by}, function(data){
				$('#tbody_exchange_rate').html(data);
			});
		});

		$("#mainContent").delegate(".add_new", "click", function(){
            $.get("{{route('crm.createExchange')}}",function(data){
                $('#div_exchange_form').html(data);
                $('#modal_exchange_add').modal('toggle');
            })

		});

		$("#mainContent").delegate(".modal_edit", "click", function(){
			_id = $(this).data('id');
			$.get(editEx, {id: _id}, function (data) {
				$('#div_exchange_form').html(data);
				$('#modal_exchange_add').modal('toggle');
			});
		});
		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#exchange_id').val(id);
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
