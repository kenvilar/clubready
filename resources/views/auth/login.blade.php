@extends('layouts.auth')

@section('content')
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
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group @error('password') has-error @enderror">
            <label for="password" class="sr-only">{{ __('Password') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password" placeholder="{{ __('Password') }}"
                   autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
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
            <a href="{{ route('password.request') }}" id="forgot" class="forgot"> {{ __('Forgot Password') }} ? </a>
        @endif

        @if (Route::has('register'))
            <span class="float-right sign-up">{{ __('New') }} ? <a
                    href="{{ route('register') }}">{{ __('Sign Up') }}</a></span>
        @endif
    </form>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/login.js') }}" type="text/javascript"></script>
@endpush
