<div class="menu">
    @if(\Auth::user()->hasRole('admin'))
        <div class="ui dropdown item" tabindex="2">
            <i class="database icon"></i>
            <span>Master Data</span>
            <i class="dropdown icon"></i>
            <div class="menu transition hidden" tabindex="-1">
                 <a href="{{ url('pendidikan') }}" class="item">
                    <i class="users icon"></i>Pendidikan
                </a>
            </div>
        </div>
    @elseif(\Auth::user()->hasRole('guru'))
        <a href="{{ url('guru') }}" class="item" tabindex="1">
            <i class="briefcase icon"></i>Daftar DUPAK
        </a>
        <a href="{{ url('guru/create') }}" class="item" tabindex="1">
            <i class="money icon"></i>Buat DUPAK
        </a>
        <a href="{{ url('guru/biodata') }}" class="item" tabindex="1">
            <i class="plane icon"></i>BIODATA
        </a>
        
    @elseif(\Auth::user()->hasRole('cabdin'))
        <a href="{{ url('/cabdin') }}" class="item" tabindex="1">
            <i class="briefcase icon"></i>Daftar DUPAK
        </a>
    
    @elseif(\Auth::user()->hasRole('sekretariat'))
        <a href="{{ url('sekretariat') }}" class="item" tabindex="1">
            <i class="briefcase icon"></i>Daftar DUPAK
        </a>
       
    @elseif(\Auth::user()->hasRole('penilai'))
        <a href="{{ url('penilai') }}" class="item" tabindex="1">
            <i class="briefcase icon"></i>Daftar DUPAK
        </a>
       
    @endif
</div>
