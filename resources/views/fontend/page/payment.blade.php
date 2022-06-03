@extends('fontend.layouts.master')
@section('title')
Payment - OSHC
@endsection
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shortcut-buttons-flatpickr@0.1.0/dist/themes/light.min.css">
<link href="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
<style>
    .left-poplink{
        display: none;
    }
</style>
@endsection
@section('content')
{{--    @dump(session()->all())--}}
<section id="allpy-register-service">
	<div class="allpy-service">
		<div class="container">
			<div class="title-section">
				{{ get_name($payment_section_1) }}
			</div>
			<div class="des-section">
				{!! get_content($payment_section_1) !!}
			</div>
			<div class="buge">...</div>
			<div class="breadcrumb">
				<ul>
					<li>
						@lang('header.get_a_quote')
					</li>
					<div class="dimi">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</div>
					<li>
						@lang('header.apply')
					</li>
					<div class="dimi">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</div>
					<li class="active">
						@lang('header.payment')
					</li>
				</ul>
			</div>
			<div class="infonation-payment">
				@include('fontend.partials.apply.detail')
				<span id="payment-res">
					@include('fontend.partials.payment.payment-choose-method')
				</span>
			</div>
		</div>
	</div>
    <div class="loading-apply" style="display:none">Loading&#8230;</div>
	<!-- begin service-home -->
	@include('fontend.partials.service-home',['sevice_intro_home'=>$sevice_intro_home,'sevice_home'=>$sevice_home,'title'=>$sevice_title_home,'des'=>$sevice_des_home])
	<!--  end service-home -->
	@include('fontend.partials.partner-home',['title'=>$partner_title_home,'des'=>$partner_des_home,'partner'=>$pt_item])
	<!-- end partner-home -->
</section>
@section('js')
<script src="https://cdn.jsdelivr.net/npm/shortcut-buttons-flatpickr@0.1.0/dist/shortcut-buttons-flatpickr.min.js"></script>
<script type="text/javascript" src="{{asset('backend/pages/assets/lib/flatpickr/flatpickr.min.js')}}"></script>
<script type="text/javascript">
	const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	const buttons = months.map((month) => {
		return { label: month.substr(0, 3) };
	});


	var ajax_url = $("#ajax_url").val();
	// var payment_tranfers_url = ajax_url + "/payment-tranfer/ajax";
    var payment_tranfers_url = '{{route("payment.tranfer")}}';

    // $(document).ajaxStart(function(){
    //     $("#wait").css("display", "block");
    // });
    $(document).ajaxStart(function(){
        $('.loading-apply').fadeIn();
    })

    $(document).ajaxComplete(function(){
        $("body").removeClass("modal-open");
        $('.modal-backdrop').fadeOut();
        $('.loading-apply').fadeOut();
    });

	$(document).on('click',".payment-tranfer",function(){
        var attrUrl = $(this).attr('data-url');
        var element = $(this);
	    if(typeof attrUrl !== typeof undefined && attrUrl !== false){
            window.open(attrUrl, '_blank');
        }else{
            var bankName = $('select[name=list_bank_sel] option').filter(':selected').val();
            $.get(payment_tranfers_url, {'bank_name':bankName}, function (data) {
                // $('#chose-banks').modal('hide');
                // $('#payment-res').html(data);
                element.attr('data-url',data);
                window.open(data, '_blank');
            });
        }
	});

	flatpickr("#birth-day", {
		dateFormat: "d/m/Y",
		plugins: [
		ShortcutButtonsPlugin({
			button: buttons,
			onClick: (index, fp) => {
				const date = new Date();
				date.setDate(1);
				date.setMonth(index);
				date.setYear(fp.currentYear);

				fp.setDate(date);
			}
		})
		]
	});
	/* ===== Logic for creating fake Select Boxes ===== */
	$('.sel').each(function() {
		$(this).children('select').css('display', 'none');

		var $current = $(this);

		$(this).find('option').each(function(i) {
			if (i == 0) {
				$current.prepend($('<div>', {
					class: $current.attr('class').replace(/sel/g, 'sel__box')
				}));

				var placeholder = $(this).text();
				$current.prepend($('<span>', {
					class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
					text: placeholder,
					'data-placeholder': placeholder
				}));

				return;
			}
			$current.children('div').append($('<span>', {
				class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
				text: $(this).text()
			}));
		});
	});
// Toggling the `.active` state on the `.sel`.
$('.sel').click(function() {
	$(this).toggleClass('active');
});
// Toggling the `.selected` state on the options.
$('.sel__box__options').click(function() {
	var txt = $(this).text();
	var index = $(this).index();

	$(this).siblings('.sel__box__options').removeClass('selected');
	$(this).addClass('selected');

	var $currentSel = $(this).closest('.sel');
	$currentSel.children('.sel__placeholder').text(txt);
	$currentSel.children('select').prop('selectedIndex', index + 1);
});
</script>
@endsection
@endsection
