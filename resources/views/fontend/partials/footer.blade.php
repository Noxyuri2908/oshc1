{{-- <div id="footer" class="d-flex container">
	<div class="row w-100">
		<div class="ft-1 footer-sidebar col-md-4">
			<a href="{{route('about')}}"><div class="icon-ft1 icon">
			</div></a>
			<div class="content-ft">
				<div class="title">
					<a href="{{route('about')}}">{{get_name($title_footer_col_1)}}</a>
				</div>
				<div class="line"></div>
				<div class="info">
					{!! get_content($title_footer_col_1)  !!}
				</div>
			</div>
		</div>
		<div class="ft-2 footer-sidebar col-md-4">
			<a href="http://oshcglobal.com.au/news/terms-conditions/Terms-conditions.html"><div class="icon-ft1 icon">
			</div></a>
			<div class="content-ft">
				<div class="title">
					<a href="http://oshcglobal.com.au/news/terms-conditions/Terms-conditions.html">{{get_name($title_footer_col_2)}}</a>
				</div>
				<div class="line"></div>
				<div class="info">
					{!! get_content($title_footer_col_2)  !!}
				</div>
			</div>
		</div>
		<div class="ft-3 footer-sidebar col-md-4">
			<a href="{{config('admin.base_url')}}news/policy/privacy-policy.html"><div class="icon-ft3 icon">
			</div></a>
			<div class="content-ft">
				<div class="title">
					<a href="{{config('admin.base_url')}}news/policy/privacy-policy.html">{{get_name($title_footer_col_3)}}</a>
				</div>
				<div class="line"></div>
				<div class="info">

				</div>
			</div>
		</div>
	</div>
</div> --}}
<section id="footer-welcome" class="w-100 d-flex justify-content-center">
    <div class="w-100">
        <div class="row py-5 mb-5 mt-5">
            <div class="col-xs-12 col-sm-4 col-md-3 mb-3">
                <h6 class="title text-uppercase font-weight-bold text-dark-gray text-uppercase">get in touch</h3>
{{--                    @if(!empty($hotline))--}}
{{--                        <div class="d-flex text-dark-gray mb-2">--}}
{{--                            <div>--}}
{{--                                <i class="fas fa-phone-alt"></i>--}}
{{--                            </div>--}}
{{--                            <div class="ml-3 font-size-13px">--}}
{{--                                <a href="tel:{{get_content($hotline)}}"--}}
{{--                                   class="text-dark-gray">{{get_content($hotline)}}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    @if(!empty($email))
                        <div class="d-flex text-dark-gray mb-2">
                            <div>
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="ml-3 font-size-13px">
                                <a class="text-dark-gray" href="mailto:{{get_link($email)}}">{{get_link($email)}}</a>
                            </div>
                        </div>
                    @endif
                    @if(!empty($address))
                        <div class="d-flex text-dark-gray mb-2">
                            <div>
                                <i class="fas fa-map-marker"></i>
                            </div>
                            <div class="ml-3 font-size-13px">
                                {{get_name($address)}}
                            </div>
                        </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 mb-3">
                <h6 class="title text-uppercase font-weight-bold text-dark-gray text-uppercase">useful links</h3>
                    <div class="d-flex flex-column">
                        @if(!empty($aboutUs))
                            <a class="text-dark-gray font-size-13px"
                               href="{{get_link($aboutUs)}}">{{get_name($aboutUs)}}</a>
                        @endif
                        @if(!empty($termAndConditions))
                            <a class="text-dark-gray font-size-13px"
                               href="{{get_link($termAndConditions)}}">{{get_name($termAndConditions)}}</a>
                        @endif
                        @if(!empty($privacyPolicy))
                            <a class="text-dark-gray font-size-13px"
                               href="{{get_link($privacyPolicy)}}">{{get_name($privacyPolicy)}}</a>
                        @endif
                    </div>

            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 mb-3">
                <h6 class="title text-uppercase font-weight-bold text-dark-gray text-uppercase">social links</h3>
                    @if(!empty($linkFb))
                        <a href="{{get_link($linkFb)}}" class="d-flex text-dark-gray mb-2 align-items-center">
                            <div>
                                <i class="fa-2x fab fa-facebook-square"></i>
                            </div>
                            <div class="ml-3 font-size-13px">
                                Facebook
                            </div>
                        </a>
                    @endif
                    @if(!empty($linkGg))
                        <a href="{{get_link($linkGg)}}" class="d-flex text-dark-gray mb-2 align-items-center">
                            <div>
                                <i class="fa-2x fab fa-twitter-square"></i>
                            </div>
                            <div class="ml-3 font-size-13px">
                                Twitter
                            </div>
                        </a>
                    @endif
                    @if(!empty($linkTwiter))
                        <a href="{{get_link($linkTwiter)}}" class="d-flex text-dark-gray mb-2 align-items-center">
                            <div>
                                <i class="fa-2x fab fa-linkedin"></i>
                            </div>
                            <div class="ml-3 font-size-13px">
                                Linkedin
                            </div>
                        </a>
                @endif
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 mb-3">
                <h6 class="title text-uppercase font-weight-bold text-dark-gray text-uppercase">newsletters</h3>
                    <div class="text-dark-gray font-size-13px">
                        {{get_name($newLetter)}}
                    </div>
                    <div class="position-relative">
                        <form action="">
                            <input type="text" class="mt-3 font-size-13px form-control text-light form-email-footer"
                                   placeholder="Enter your email" style="">
                            <button type="submit" class="btn btn-link position-absolute icon-email"><i
                                    class="fas fa-envelope "></i></button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<div class="copyright">
    <div class="">
        <div class="d-flex justify-content-between copyright-content">
            <div class="info-copyright">
                @if(!empty($copyright))
                    {!! get_content($copyright)  !!}
                @endif
            </div>
            <div class="">
                @if(!empty($homeFooter))
                    <a class="text-light ml-2" href="{{get_link($homeFooter)}}">{{get_name($homeFooter)}}</a>
                @endif
                @if(!empty($aboutFooter))
                    <a class="text-light ml-2" href="{{get_link($aboutFooter)}}">{{get_name($aboutFooter)}}</a>
                @endif

                @if(!empty($eventFooter))
                    <a class="text-light ml-2" href="{{get_link($eventFooter)}}">{{get_name($eventFooter)}}</a>
                @endif

                @if(!empty($contactFooter))
                    <a class="text-light ml-2" href="{{get_link($contactFooter)}}">{{get_name($contactFooter)}}</a>
                @endif

            </div>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        $('.title').matchHeight();
    </script>
@endpush
