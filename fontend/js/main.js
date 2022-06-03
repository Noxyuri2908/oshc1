jQuery(document).ready(function($) {
	jQuery('.menu-responsive .menu-item-has-children > a').after('<span class="sub-open"></span>');
	jQuery('.menu-responsive .sub-open').click( function () {
		jQuery(this).closest('li').children('.sub-menu').toggle(600);
		jQuery(this).toggleClass('sub-opend');
	});
	/* menu responsive*/
	jQuery('.menu-open').click( function () {
		jQuery('.menu-responsive, .menu-responsive-overlay').toggleClass('show-mn');
	});
	jQuery('.search-mobile').click(function(){
		jQuery('.serch-main-topbar').toggleClass('show-icon');
	});
	$('.side-menu li a').click(function(){
		 event.preventDefault();
		if ($('.side-menu li').hasClass('active')) {
			$('.side-menu li').removeClass('active');
		}
		$id = $(this).data('id');
		$('.tab-customs').find('.active').removeClass('active');
		$('#menu'+$id).addClass('active');
		$(this).parent().addClass('active');
	});

	jQuery('.menu-close, .menu-responsive-overlay').click( function () {
		jQuery('.menu-responsive, .menu-responsive-overlay').toggleClass('show-mn');
	});
	// jQuery('.home-slide').lightSlider({
	// 	item:1,
	// 	slideMargin:0,
	// 	mode: 'fade',
	// 	auto:true,
	// 	pause: 3800,
	// 	speed: 1800,
	// 	pager: false,
	// 	loop:true,
	// 	controls: false,
	// 	enableDrag: false,
	// });
	// jQuery('.client-slide').lightSlider({
	// 	item:3,
	// 	slideMargin:0,
	// 	slideMove:2,
	// 	auto:false,
	// 	pause: 3800,
	// 	speed: 1500,
	// 	pager: true,
	// 	loop:true,
	// 	controls: false,
	// 	responsive : [
	// 	{
	// 		breakpoint:800,
	// 		settings: {
	// 			item:2,
	// 			slideMove:1,
	// 			slideMargin:6,
	// 		}
	// 	},
	// 	{
	// 		breakpoint:480,
	// 		settings: {
	// 			item:1,
	// 			slideMove:1
	// 		}
	// 	}
	// 	]
	// });
	// jQuery('.partner-slide').lightSlider({
	// 	item:6,
	// 	slideMargin:0,
	// 	slideMove:3,
	// 	auto:true,
	// 	pause: 3800,
	// 	speed: 1500,
	// 	pager: true,
	// 	loop:true,
	// 	controls: false,
	// 	responsive : [
	// 	{
	// 		breakpoint:800,
	// 		settings: {
	// 			item:3,
	// 			slideMove:1,
	// 			slideMargin:6,
	// 		}
	// 	},
	// 	{
	// 		breakpoint:480,
	// 		settings: {
	// 			item:2,
	// 			slideMove:1
	// 		}
	// 	}
	// 	]
	// });
	// jQuery('.who-slide').lightSlider({
	// 	item:2,
	// 	slideMargin:0,
	// 	slideMove:1,
	// 	auto:true,
	// 	pause: 3800,
	// 	speed: 1500,
	// 	pager: true,
	// 	loop:true,
	// 	controls: false,
	// 	responsive : [
	// 	{
	// 		breakpoint:480,
	// 		settings: {
	// 			item:1,
	// 			slideMove:1
	// 		}
	// 	}
	// 	]
	// });
});

