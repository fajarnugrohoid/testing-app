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
		      <div class="header">Total DUPAK Proses</div>
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
    </div>
</div>
@endsection