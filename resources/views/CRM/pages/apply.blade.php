@extends('CRM.layouts.default')

@section('title')
APPLY MANAGEMENT
@parent
@stop

@section('css')


<style>
	#cutum-frm{
	    padding-bottom: 0px;
	    margin-bottom: 10px;
	    background-color: #edf2f9;
	    display: none;
	    padding-top: 6px;
	    -webkit-box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);
	    box-shadow: 0 7px 14px 0 rgba(59, 65, 94, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);

	}
	#cutum-frm .form-filter{
		background: #fff;
        padding: 15px 0;
	}
	#cutum-frm .form-filter .form-group input{
        width: 100%;
	    border-radius: 5px;
	    box-shadow: none;
	    padding: 5px 10px;
	    border: 1px solid #cadbef;
	}
	#cutum-frm .form-filter .form-group input::placeholder{
		font-size: 13.33px;
		font-weight: 400;
		 color: #adadad !important;
	}
	#cutum-frm .form-filter .form-group label{
        font-size: 13.33px;
        
        font-weight: 600 !important;
        color: #344050;
	}
	#cutum-frm  .bt-submit{
		text-align: right;
	}
	.delete-controlog .modal-footer button[type="button"].closes,
	#cutum-frm  .bt-submit button{
		 font-size: 15px;
		  padding: 3px 13px;
		  border-radius: 5px;
		  color: #fff;
		  background-color: #f50000;
		border: 1px solid #f50000;
	}
	
	.user-information  .modal-footer button[type="button"],
	#cutum-frm  .bt-submit button[type="submit"]{
	    background-color: #2c7be5;
	    border-color:  #2c7be5;
	    box-shadow: none;
	}
	.user-information  .modal-footer button[type="button"]:hover,
	#cutum-frm  .bt-submit button[type="submit"]:hover{
		background-color: #1a68d1;
        border-color: #1862c6;
	}
	.delete-controlog .modal-footer button[type="button"].closes:hover,
	#cutum-frm  .bt-submit button.closes:hover{
		background-color: #dc0000;
		border-color: #dc0000;
	}
    .sxme{
    	margin-right: 10px;
    }
    .sxme:last-child{
    	margin-right: 0;
    }
	.dropdown-cutum-frm-hide{
		display: inline-block;
	}

	.dropdown-cutum-frm-hide .dropdown-menu{
		padding: 5px 2px;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li{
	    padding: 2px 10px;
	    border-bottom: 1px solid #e6edf5;
	}
	
	.dropdown-cutum-frm-hide .dropdown-menu li:last-child{
		 border-bottom: none;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li a{
        color: #344050;
        display: block;
	}
	.dropdown-cutum-frm-hide .dropdown-menu li a:hover{
		color: red;
		text-decoration: none;

	}

	.user-information .modal-content{
     	border: 2px solid #1a68d1;
     	border-radius: 0;
    }


    .user-information .modal-header{
        background-color: #1a68d1;
        border-bottom: 1px solid  #fff;
       border-radius: 0;
    }

    .user-information .modal-header h5,
    .user-information .modal-header .close{
      	color: #fff;
    }


    .content-information h3.name{
        font-size: 24px;
	    font-weight: 600;
	    color: #1a68d1;
	    padding-bottom: 5px;
	    border-bottom: 1px solid #cadbef;
    }

    .content-information .form-group .control-label{
    	width: 100%;
    	float:none;
    	color: #5e6e82;
    	font-size: 13.33px;
    }
    .content-information .form-group input{
	    width: 100%;
	    border: 1px solid #d8e2ef;
	    font-size: 1rem;
	    font-weight: 300;
	    color: #6c8bb5;
	    padding: 0.2rem .5rem;
	    border-radius: 0.25rem;
    }

    .delete-controlog .modal-content{
         border-radius: 5px;
    }

     .delete-controlog .modal-content .modal-body{
     	text-align: center;
     }
     .delete-controlog .modal-title{
 	    font-size: 24px;
	    font-weight: 600;
	    color: #1a68d1;
     }
     .delete-controlog .comment-d {
	    padding: 15px;
	    width: 80%;
	    margin: auto;
	    background-color: #4b98ff;
	     margin-top: 15px;
	    margin-bottom: 15px;
	    border: 1px solid #1967d1;
	    border-radius: 9px;
     }
     .delete-controlog .comment-d p{
     	margin-bottom: 0;
     	font-size: 14px;
     	color: #fff;
     }
     .delete-controlog .button-contenr .yes{
        background-color: #2c7be5;
	    border-color:  #2c7be5;
     }
     .delete-controlog .button-contenr .yes:hover{
        background-color: #1a68d1;
        border-color: #1862c6;
     }
     .delete-controlog .button-contenr .no{
        background-color: #f50000;
		border: 1px solid #f50000;
     }
     .delete-controlog .button-contenr .no:hover{
     	background-color: #dc0000;
		border-color: #dc0000;

     }
    .delete-controlog .form-group{
    	text-align: left;
    }
    .delete-controlog .form-group #email-example{
    	width: 100%;
    	border: 1px solid #d8e2ef;
    	font-size: 1rem;
    	font-weight: 300;
    	color: #6c8bb5;
    	padding: 0.2rem .5rem;
    	border-radius: 0.25rem;
    }
    .delete-controlog .form-group #email-example option{
    	font-weight: 300;
    }
   

</style>

@stop
@section('content')
@include('CRM.elements.table-apply')
@stop

@section('js')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
	var getAgentInfo = ajax_url + "ajax/getAgentInfo";
	var getServiceInfo = ajax_url + "ajax/getServiceInfo";
	var getApplyInfo = ajax_url + "ajax/getApplyInfo";
	var getCustomInfo = ajax_url + "ajax/getCustomInfo";

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

		$(".cutum-frm-hide").click(function(){
		    $('#cutum-frm').slideToggle();
		});
		$(".closes").click(function(){
		    $('#cutum-frm').slideUp("slow");
		});

		$("#mainContent").delegate(".service_info", "click", function(){

			_id = $(this).data('id');
			$.get(getServiceInfo, {id: _id}, function (data) {
				console.log(data);
				$('#div_service_info').html(data);
				$('#modal_service').modal('show');
			});
		});
		$("#mainContent").delegate(".agent_info", "click", function(){

			_id = $(this).data('id');
			$.get(getAgentInfo, {id: _id}, function (data) {
				console.log(data);
				$('#modal_agent').html(data);
				$('#modal_agent_info').modal('show');
			});
		});

		$("#mainContent").delegate(".apply_info", "click", function(){

			_id = $(this).data('id');
			$.get(getApplyInfo, {id: _id}, function (data) {
				console.log(data);
				$('#div_apply_info').html(data);
				$('#modal_apply_info').modal('show');
			});
		});

		$("#mainContent").delegate(".customer_info", "click", function(){

			_id = $(this).data('id');
			$.get(getCustomInfo, {id: _id}, function (data) {
				console.log(data);
				$('#div_custom_info').html(data);
				$('#modal_custom_info').modal('show');
			});
		});



		$("#mainContent").delegate("#type_content", "change", function(){
			v = $(this).val();
			if(v == 1){
				$('.template_mail').css('display','block');
				$('.fill_content').css('display','none');
			}else{
				$('.template_mail').css('display','none');
				$('.fill_content').css('display','block');
			}
			// $.get(getContactInfo, {id: _id}, function (data) {
			// 	console.log(data);
			// 	$('#modal_contact').html(data);
			// 	$('#modal_contact_info').modal('show');
			// });
		});

		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#apply_id').val(id);
			$('#modal_delete').modal('toggle');
		});

		$("#mainContent").delegate(".add_invoice", "click", function(){
			$('#modal_invoice_add').modal('toggle');
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