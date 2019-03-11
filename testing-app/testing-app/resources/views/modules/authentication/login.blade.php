@extends('layouts.auth')

@section('content')
    <div class="ui middle aligned center aligned grid">
        <div class="seven wide column">
            <div class="ui segment">
                <div class="ui grid">
                    <div class="sixteen wide column">Logo : O-PAK</div>
                    <div class="eight wide column">
                        <form class="ui large form" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="NIP/Username" required autofocus>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <button type="submit" class="ui fluid large blue submit button">Login</button>
                        </form>
                    </div>
                    {{-- <div class="ui vertical divider" style="left:50%"></div> --}}
                    <div class="eight wide column">
                        <p>Gunakan NIP untuk login ke aplikasi</p>
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="ui negative message">
                    <i class="close icon"></i>
                    <div class="header">
                        <strong>Mohon Maaf, </strong>Terjadi Kesalahan<br>
                    </div>
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>
@endsection
