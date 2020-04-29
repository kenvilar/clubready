@if (Auth::check())
    <ul class="navigation">
        @if (UserHelper::isSuperAdmin())
            @include('inc.parts.left-sidebar.navbar-left-for-admins')
        @endif
    </ul>
@endif

@push('footer-scripts')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
@endpush
