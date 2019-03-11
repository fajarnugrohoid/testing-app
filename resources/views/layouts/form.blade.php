@extends('layouts.modal-view')

@section('css')
@append

@section('styles')
    <style type="text/css">
        .text-center {
            text-align: center !important;
        }
        .ui.radio.checkbox {
            margin: 0px !important;
        }
        .results.transition.visible{
            width: 31em !important;
        }
        .min-content {
            min-height: 250px;
        }
    </style>
@append

@section('js')
    <script src="{{ asset('plugins/input-mask/jquery.mask.js') }}"></script>
    <script src="{{ asset('plugins/jquery-numeric/jquery-numeric.min.js') }}"></script>
@append

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            
            // ketika tekan enter, kursor akan pindah ke inputan lain
            // $('input').keydown( function(e) {
            //     var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
            //     if(key == 13) {
            //         e.preventDefault();
            //         var inputs = $(this).closest('form').find(':input:visible');
            //         inputs.eq( inputs.index(this)+ 1 ).focus();
            //     }
            // });

        });
    </script>
    @include('scripts.action')
@append


@section('content')
    @section('content-header')
    <div class="ui centered grid">
        <div class="twelve wide column main-content">
            <h2 class="ui header">
              <div class="content">
                {!! $title or '-' !!}
                {{-- <div class="sub header">{!! $subtitle or ' ' !!}</div> --}}
                <div class="sub header">{!! $subtitle or ' ' !!}</div>
              </div>
            </h2>
        </div>
    </div>
    @show

    <div class="ui clearing divider" style="border-top: none !important; margin:10px"></div>

    @section('content-body')
    <div class="ui centered grid">
        <div class="twelve wide column main-content">
            <div class="ui segments">
                <div class="ui segment">
					@yield('form')
                </div>
            </div>
        </div>
    </div>
    @show
@endsection


@section('modals')

@append