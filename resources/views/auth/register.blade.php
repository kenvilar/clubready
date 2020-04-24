@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('register') }}" id="authentication" class="signup_validator">
        @csrf

        <div class="form-group @error('first_name') has-error @enderror">
            <label for="first_name" class="sr-only">{{ __('First Name') }}</label>
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                   name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}" required
                   autocomplete="first_name" autofocus>
            @error('first_name')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="form-group @error('last_name') has-error @enderror">
            <label for="last_name" class="sr-only">{{ __('Last Name') }}</label>
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                   name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}" required
                   autocomplete="last_name" autofocus>
            @error('last_name')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="form-group @error('email') has-error @enderror">
            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="form-group @error('password') has-error @enderror">
            <label for="password" class="sr-only">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                   placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <input type="submit" value="{{ __('Register') }}" class="btn btn-primary btn-block"/>
        </div>

        @if (Route::has('login'))
            <div class="form-group">
                <span class="sign-in">Already a member? <a href="{{ route('login') }}">Sign In</a></span>
            </div>
        @endif
    </form>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/register.js') }}" type="text/javascript"></script>
@endpush
