@extends('layouts.app')

@section('content')

    <section class="content mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h6>PLEASE CHOOSE A CLUB!!</h6>
                            <div class="w-50 m-auto">
                                @foreach($clubs as $club)
                                    <a href="" onclick="postForm({{ $club }});event.preventDefault();">
                                        <div class="card-header card_small mb-3">
                                            {{ $club['club']['name'] }} <i class="fa fa-fw fa-angle-right"></i>
                                        </div>
                                    </a>
                                @endforeach

                                <form id="selected-club" action="{{ route('selectedClub') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    <input type="hidden" name="admin" id="admin"/>
                                    <input type="hidden" name="club_id" id="club_id"/>
                                    <input type="hidden" name="id" id="id"/>
                                    <input type="hidden" name="user_id" id="user_id"/>
                                    <input type="hidden" name="uuid" id="uuid"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('footer-scripts')
    <script>
        $("img[alt='Logo'], .left-side, .right-side .content-header, " +
            ".user.user-menu li:nth-child(2), .user.user-menu li:nth-child(4), .navbar-btn.sidebar-toggle").hide();
        $(".right-side").css({"margin-left": 0});

        function postForm(club) {
            var form = $("#selected-club");
            $("#selected-club input[name='admin']").val(club.admin);
            $("#selected-club input[name='club_id']").val(club.club_id);
            $("#selected-club input[name='id']").val(club.id);
            $("#selected-club input[name='user_id']").val(club.user_id);
            $("#selected-club input[name='uuid']").val(club.uuid);
            form.submit();
        }
    </script>
@endpush
