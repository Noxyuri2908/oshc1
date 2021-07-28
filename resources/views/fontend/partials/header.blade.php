`<header id="header" class="site-header">
    <input type="hidden" id="ajax_url" value="{{config('admin.ajax_url')}}">

    <div id="top-bar" style="overflow:unset">
        <div class="container d-flex justify-content-between h-100">
            <div class="">

            </div>
            <div class="d-flex align-items-center">
                {{-- <button class="call-top-bar hidden-sm hidden-xs">
                    <a href="{{route('become-a-agent')}}">
                        <span>Become an User</span>
                    </a>
                </button> --}}
                {{-- <div class="serch-main-topbar hidden-lg hidden-md">
                    <form action="" method="" class="serch-main">
                        <input type="text" name="s" class="input-s" placeholder="@lang('header.keyword')...">
                        <button type="submit" class="btn-submit"></button>
                    </form>
                    <div class="icon-click-search"><i class="fa fa-search"></i></div>
                </div>
                <div class="divi">|</div>
                @if (Route::has('login'))
                    <div class="login">
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-falcon-default dropdown-toggle" id="dropdownMenuButton"
                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    {{\Auth::user()->name}}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right py-0"
                                     aria-labelledby="dropdownMenuButton">
                                    <div class="bg-white rounded-soft py-2">
                                        <a class="dropdown-item" href="{{route('agent-profile.get')}}"
                                           target="_blank">@lang('header.profile_account')
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            		document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>@lang('header.logout')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button class="btn btn-falcon-default dropdown-toggle" id="dropdown-menu-login"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('header.login')
                            </button>
                            <div class="dropdown-menu dropdown-menu-right py-0 form-login-hd"
                                 aria-labelledby="dropdown-menu-login">
                                <div class="bg-white rounded-soft py-2">
                                    <form method="POST" class="m-t" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                                   placeholder="Your email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
						                    <strong>{{ $message }}</strong>
						                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="current-password"
                                                   placeholder="Your password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
						                <strong>{{ $message }}</strong>
						            </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary block full-width m-b btn-lgin">
                                            LOGIN
                                        </button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link forget-pass" href="{{ route('password.request') }}">
                                                {{ __('Forgot password?') }}
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                @endif--}}

                @if(!empty($email))
                    <div class="font-size-14px font-weight-400 text-light">Email: <a
                            class="  text-light text-decoration-none"
                            href="mailto:{{get_link($email)}}">{{get_name($email)}}</a></div>
                    <div class="divi">|</div>
                @endif
                <div class="language-swith">
                    <div class="dropdown">
                        <button class="btn btn-falcon-default dropdown-toggle" id="dropdown-menu-leg" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="flag-in"></span>
                            <span class="name-flag lang-active">
								@php
                                    if (\App::isLocale('cn'))
                                        echo "Chinese";
                                    elseif (\App::isLocale('vi'))
                                        echo "Vietnamese";
                                    else echo "English";
                                @endphp
							</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="dropdown-menu-leg">
                            <div class="bg-white rounded-soft py-2">
                                <a class="dropdown-lgg en"
                                   href="{!! route('change-language',['language'=>'en']) !!}"><span
                                        class="flag-en"></span>English</a>
                                {{-- <a class="dropdown-lgg cn"
                                   href="{!! route('change-language',['language'=>'cn']) !!}"><span
                                        class="flag-cn"></span>Chinese</a>
                                <a class="dropdown-lgg vi"
                                   href="{!! route('change-language',['language'=>'vi']) !!}"><span
                                        class="flag-vi"></span>Vietnamese</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container d-flex h-100">
            <div class="logo-site col-md-2 col-sm-6 col-xs-9">
                <div class="menu-icon hidden-lg hidden-md">
                    <div class="menu-open">
                        <div class="pull-right">
                            <div class="icon-click">
                                <i class="fa fa-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="icon-welcome-nav">
                    <a href="{{route('home')}}">
                        @if(!empty($logo))
                            <img src="{{$logo->image}}">
                        @endif
                    </a>
                </div>
            </div>
            <div class="main-navigation col-md-10 col-sm-6 col-xs-3 d-flex">
                <div class="main-menu hidden-sm hidden-xs d-flex justify-content-center">
                    <ul class="menu-header w-100 justify-content-around d-flex">
                        <li class="item-menu">
                            <a href="{{route('get-a-quote.get')}}">
                                @lang('header.get_a_quote')
                            </a>
                        </li>
                        <li class="item-menu">
                            <a href="{{route('qa')}}">{{trans('header.qa')}}</a>
                        </li>
                        @if(!empty($menu_headers))
                            @foreach($menu_headers as $menu)
                                <li class="item-menu">
                                    <a href="{{route('get_by_menu',['slug'=>$menu->slug])}}">{{get_name($menu)}}</a>
                                </li>
                            @endforeach
                        @endif
                        <li class="item-menu">
                            <a href="{{route('get.contact')}}">{{trans('header.contact')}}</a>
                        </li>
                        <li class="item-menu">
                            <a href="{{route('about')}}">{{trans('header.about')}}</a>
                        </li>
                        <li class="item-menu">
                            <a href="{{route('special_offer')}}">{{trans('header.specical_offer')}}</a>
                        </li>
                        <li class="item-menu">
                            <ul class="ul-social hidden-xs">
                                @if(!empty($link_fb))
                                    <li>
                                        <a href="{{get_link($link_fb)}}"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                @endif
                                @if(!empty($link_twiter))
                                    <li>
                                        <a href="{{get_link($link_twiter)}}"><i class="fab fa-twitter"></i></a>
                                    </li>
                                @endif
                                @if(!empty($link_gplus))
                                    <li>
                                        <a href="{{get_link($link_gplus)}}"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                    </ul>

                </div>
                <div class="header-search hidden-sm hidden-xs">
                    <form action="{{route('get_by_menu',['slug'=>'news'])}}" method="get" class="serch-main">
                        <input type="text" name="s" value="{{request()->get('s')}}" class="input-s"
                               placeholder="@lang('header.keyword')...">
                        <button type="submit" class="btn-submit"></button>
                    </form>
                </div>
                {{-- <div class="hotline-mb hidden-lg hidden-md">
                    <a href="tel:"><i class="fa fa-phone" aria-hidden="true"></i><span>{{get_content($hotline)}}</span></a>
                </div> --}}
            </div>
        </div>
    </div>
</header>
<div class="menu-responsive hidden-lg bg-light">
    <div class="menu-close bg-light">
        {{-- <i class="fa fa-bars"></i> --}}
        <div class="logo-mb">
            <a href="{{route('home')}}">
                <img src="{{asset('source/logo.png')}}">
            </a>
        </div>
        <span class="icon-close"><i class="fa fa-times text-dark" aria-hidden="true"></i></span>
    </div>
    <ul class="center main-nav">
        <li class="spacer navbar-inner">
            <a href="{{route('get-a-quote.get')}}" class="text-dark">{{trans('header.get_a_quote')}}</a>
        </li>
        <li class="spacer navbar-inner">
            <a class="text-dark" href="{{route('qa')}}">{{trans('header.qa')}}</a>
        </li>
        @if(!empty($menu_headers))
            @foreach($menu_headers as $menu)
                <li class="spacer navbar-inner">
                    <a class="text-dark" href="{{route('get_by_menu',['slug'=>$menu->slug])}}">{{get_name($menu)}}</a>
                </li>
            @endforeach
        @endif
        <li class="spacer navbar-inner">
            <a class="text-dark" href="{{route('get.contact')}}">{{trans('header.contact')}}</a>
        </li>
        <li class="spacer navbar-inner">
            <a class="text-dark" href="{{route('about')}}">{{trans('header.about')}}</a>
        </li>
    </ul>
</div>

