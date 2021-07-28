{{--css--}}
<link href="{{asset('backend_CRM/pages/assets/lib/flatpickr/flatpickr.min.css')}}" rel="stylesheet">

<!-- Mainly scripts -->
<script src="{{asset('backend/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend_CRM/js/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('backend_CRM/pages/assets/lib/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('backend/js/inspinia.js')}}"></script>
<script src="{{asset('backend/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	$(document).ready(function () {
		var ajax_url = $('#base_url').val();
		var url_reload = ajax_url + 'admin/reload-data';
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
		var time = new Date().getTime();

	    function refresh() {
	        if(new Date().getTime() - time >= 10000){
	        	time = new Date().getTime();
	        	$.get(url_reload, {}, function (data) {
					$('.notify').html(data['notify']);
					$('.agent-pending').html(data['reg']);
					$('.apply-pending').html(data['apply']);
					$('.person').html(data['person']);
				});
	        	setTimeout(refresh, 10000);
	        }
	    }
	    setTimeout(refresh, 10000);
	});
</script>
