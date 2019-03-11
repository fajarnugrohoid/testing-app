<div class="ui fixed blue inverted menu">
	<a href="{{ url('/') }}" class="header item">
		{{-- <img class="logo" src="{{ asset('img/logo.png')}}" style="width:4.5em">&nbsp;&nbsp; --}}
		{{ config('app.name') }}
	</a>

    @include('partials.menu')
    
    <div class="right menu">
        <div class="ui pointing dropdown item" tabindex="0">
            {{ auth()->user()->nama }} <i class="dropdown icon"></i>
            <div class="menu transition hidden" tabindex="-1">
                <a class="item" href="{{ url('/') }}"><i class="user icon"></i> Profile</a>
                <a class="item" href="{{ url('/logout') }}"><i class="sign out icon"></i> Logout</a>
            </div>
        </div>
    </div>
</div>