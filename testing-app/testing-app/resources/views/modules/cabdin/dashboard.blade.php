@extends('layouts.form')


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

@section('form')
<h2>Status DUPAK</h2>
<div class="ui">
	<div class="fields">
		<div class="sixteen wide field">
			<div class="ui five steps">
			 	<div class="step">
			 		@if($dupak)
			    	<i class="check green icon"></i>
			    	<div class="content">
			      		<div class="title">Input DUPAK</div>
			      		<div class="description">{{ $dupak->created_at }}</div>
			    	</div>
			    	@else
			    	<i class="refresh blue icon"></i>
			    	<div class="content">
			      		<div class="title">Input DUPAK</div>
			      		<div class="description">-</div>
			    	</div>			    	
			    	@endif
			  	</div>
			  	<div class="step">
			    	@if($dupak and $dupak->cabdin_at)
			    	<i class="check green icon"></i>
			    	<div class="content">
			      		<div class="title">Cabang Dinas</div>
			      		<div class="description">{{ $dupak->cabdin_at }}</div>
			    	</div>
			    	@else
			    	<i class="refresh blue icon"></i>
			    	<div class="content">
			      		<div class="title">Cabang Dinas</div>
			      		<div class="description">-</div>
			    	</div>			    	
			    	@endif
			  	</div>
			  	<div class="step">
			    	@if($dupak and $dupak->sekretariat_at)
			    	<i class="check green icon"></i>
			    	<div class="content">
			      		<div class="title">Sekretariat</div>
			      		<div class="description">{{ $dupak->sekretariat_at }}</div>
			    	</div>
			    	@else
			    	<i class="refresh blue icon"></i>
			    	<div class="content">
			      		<div class="title">Sekretariat</div>
			      		<div class="description">-</div>
			    	</div>			    	
			    	@endif
			  	</div>
			  	<div class="step">
			    	@if($dupak and $dupak->penilai_at)
			    	<i class="check green icon"></i>
			    	<div class="content">
			      		<div class="title">Penilaian</div>
			      		<div class="description">{{ $dupak->penilai_at }}</div>
			    	</div>
			    	@else
			    	<i class="refresh blue icon"></i>
			    	<div class="content">
			      		<div class="title">Penilaian</div>
			      		<div class="description">-</div>
			    	</div>			    	
			    	@endif
			  	</div>			  				  				  	
			</div>			
		</div>
	</div>
</div>    
@endsection