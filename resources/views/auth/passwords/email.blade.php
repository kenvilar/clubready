@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" id="forgot_password">
        @csrf

        <div class="form-group @error('email') has-error @enderror">
            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" value="{{ __('Send Password Reset Link') }}" class="btn btn-primary btn-block"/>
        </div>
    </form>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/custom_js/forgot_password.js') }}" type="text/javascript"></script>
@endpush
