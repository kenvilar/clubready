<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', '::Admin Login::') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- end of bootstrap -->

    <!--page level css -->
    <link href="{{ asset('css/themify-icons/css/themify-icons.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <!--end page level css-->
</head>

<body id="sign-in">

<div id="app">
    <div class="preloader">
        <div class="loader_img"><img src="{{ asset('img/loader.gif') }}" alt="loading..." height="64" width="64"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-10 col-sm-8 m-auto login-form">

                <h2 class="text-center logo_h2">
                    <img src="{{ asset('img/logo/logo-black-text.png') }}" alt="Logo" width="200">
                </h2>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('login') }}" id="authentication" method="post"
                                  class="login_validator">
                                @csrf

                                <div class="form-group @error('email') has-error @enderror">
                                    <label for="email" class="sr-only">{{ __('E-mail') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ old('email') }}"
                                           autocomplete="email" autofocus
                                           placeholder="{{ __('E-mail') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('password') has-error @enderror">
                                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password" placeholder="{{ __('Password') }}"
                                           autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group checkbox">
                                    <label for="remember">
                                        <input type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        &nbsp; {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{ __('Login') }}" class="btn btn-primary btn-block"/>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" id="forgot"
                                       class="forgot"> {{ __('Forgot Password') }} ? </a>
                                @endif

                                @if (Route::has('register'))
                                    <span class="float-right sign-up">{{ __('New') }} ? <a
                                            href="{{ route('register') }}">{{ __('Sign Up') }}</a></span>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row text-center social">
                        <div class="col-12">
                            <p class="alter">{{ __('Sign in with') }}</p>
                        </div>
                        <div class="row m-auto">

                            <div class="col-4">
                                <a href="#" class="btn btn-lg btn-facebook">
                                    <i class="ti-facebook"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="btn btn-lg btn-twitter">
                                    <i class="ti-twitter-alt"></i>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="btn btn-lg btn-google">
                                    <i class="ti-google"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.Laravel = {!! json_encode(['apiToken' => session('myToken') ?? null]) !!};
</script>

<!-- global js -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- end of global js -->

<!-- page level js -->
<script src="{{ asset('vendors/iCheck/js/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom_js/login.js') }}" type="text/javascript"></script>
<!-- end of page level js -->
</body>

</html>

