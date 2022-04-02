<!DOCTYPE html>
<html>

@include('back-end.partials.head')
@yield('css')

<body class="">
    <div id="wrapper">
        @include('back-end.partials.nav')
        <div id="page-wrapper" class="gray-bg">
            @include('back-end.partials.header')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>@yield('title')</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        @if(isset($parent_menu))
                        <li>
                            <a href="{{$parent_route}}">{{$parent_menu}}</a>
                        </li>
                        @endif
                        <li class="active">
                            @if(!empty($page_name))
                                <strong>{{$page_name}}</strong>
                            @endif
                        </li>
                    </ol>
                </div>
                @if(isset($route_button))
                @can('providerList.store')
                        <div class="col-sm-8">
                            <div class="title-action">
                                <a href="{{$route_button}}" class="btn btn-primary">{{$name_button}}</a>
                            </div>
                        </div>
                @endcan
                @endif
            </div>

            <div class="wrapper wrapper-content">
               @yield('content')
            </div>
            @include('back-end.partials.footer')
        </div>
    </div>
    @include('back-end.partials.scripts')
    @yield('js')
    @stack('scripts')
</body>

</html>
