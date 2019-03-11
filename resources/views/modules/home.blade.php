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
	
@endsection