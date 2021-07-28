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
                            <strong>{{$page_name}}</strong>
                        </li>
                    </ol>
                </div>
                @if(isset($route_button))
                <div class="col-sm-8">
                    <div class="title-action">
                        @if(isset($flag))
                            @if($flag == 'price')
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#importModal" class="btn btn-success import-button"><span class="fas fa-cloud-upload-alt" data-fa-transform="shrink-3"></span>Import File</a>
                            @endif
                        @endif
                        <a href="{{$route_button}}" class="btn btn-primary">{{$name_button}}</a>
                    </div>
                </div>
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
</body>

</html>
