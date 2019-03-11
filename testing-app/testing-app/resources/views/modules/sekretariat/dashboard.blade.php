@extends('layouts.base')


@section('css')
@append

@section('styles')
    <style type="text/css">
        
    </style>
@append

@section('js')
    {{-- <script src="{{ asset('plugins/step/jquery.steps.min.js') }}"></script> --}}
@append

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
        });
    </script>
@append

@section('form-title')
	{{ $title }}
@endsection

@section('content')
<div class="ui centered grid">
    <div class="twelve wide column main-content">
		<div class="ui cards">
		  <div class="card">
		    <div class="content">
		      <div class="header">Total DUPAK</div>
		      <div class="description">
		      	<h1 class="text-right"></h1>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="content">
		      <div class="header">Total DUPAK Sekretariat</div>
		      <div class="description">
		      	<h1 class="text-right"></h1>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="content">
		      <div class="header">Total DUPAK Diterima</div>
		      <div class="description">
		      	<h1 class="text-right"></h1>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="content">
		      <div class="header">Total DUPAK Ditolak</div>
		      <div class="description">
		      	<h1 class="text-right"></h1>
		      </div>
		    </div>
		  </div>
    	</div>
    	<table class="table ui">
    		<thead>
    			<tr>
    				<th width="1%">No</th>
    				<th>NIP</th>
    				<th>Usulan Pangkat</th>
    				<th>Asal</th>
    				<th></th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($dupak as $d)
    			<tr>
    				<td>{{ $loop->iteration }}</td>
    				<td>{{ $d->user->biodata->nama }}</td>
    				<td>{{ $d->golonganUsulan->nama }}/{{ $d->golonganUsulan->pangkat }}</td>
    				<td>{{ $d->unitkerja->nama }}</td>
    				<td>
    					<a href="{{ url('/') }}/sekretariat/print/{{ $d->id }}" target="_blank" class="button ui blue"><i class="print ui icon"></i> Cetak</a>
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
	</div>
</div>
@endsection