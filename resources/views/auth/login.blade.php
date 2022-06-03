<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản trị | Login</title>

    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg bg-login">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="login">
            <h3>Chào mừng đến hệ thống quản lý website OSHC</h3>
            <p>Đăng nhập để sử dụng hệ thống</p>
            <div class="col-md-5 form-login">
                <form method="POST" class="m-t" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b bt-login">Đăng nhập</button>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Quên mật khẩu?') }}
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

<!-- Mainly scripts -->
<script src="{{asset('backend/js/jquery-2.1.1.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>

</body>

</html>
