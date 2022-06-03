<!DOCTYPE html>
<html lang="en">
@include("fontend.partials.head")
@yield('css')
<body>
	<div class="left-poplink">
        @if(!empty($quote_now->link))
		<div class="item-link">
			<a href="{{(!empty($quote_now->link))?$quote_now->link:''}}">
				<span>{{(!empty($quote_now->name))?$quote_now->name:''}}</span>
			</a>
        </div>
        @endif
        @if(!empty($special_offer->link))
		<div class="item-link">
			<a href="{{(!empty($special_offer->link))?$special_offer->link:''}}">
				<span>{{(!empty($special_offer->name))?$special_offer->name:''}}</span>
			</a>
        </div>
        @endif
	</div>
	<!--/Header-->
{{--    @dump(session()->all())--}}
	@include("fontend.partials.header")
		@yield('content')
	@include("fontend.partials.footer")
	<!--/Footer-->
</body>
@include("fontend.partials.scripts")
@yield('js')
@stack('scripts')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    // $(window).on('load', function(){
    //     window.fbAsyncInit = function() {
    //         FB.init({
    //             xfbml            : true,
    //             version          : 'v8.0'
    //         });
    //     };
    //     (function(d, s, id) {
    //         var js, fjs = d.getElementsByTagName(s)[0];
    //         if (d.getElementById(id)) return;
    //         js = d.createElement(s); js.id = id;
    //         js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    //         fjs.parentNode.insertBefore(js, fjs);
    //     }(document, 'script', 'facebook-jssdk'));
    // });


</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="925435610945610"
     logged_in_greeting = "hello"
     greeting_dialog_display="fade"
     greeting_dialog_delay="30"
     data-controls="false"
     data-href="http://oschabc.test/">
</div>
</html>
