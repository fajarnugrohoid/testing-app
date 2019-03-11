<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Style --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('semantic/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style type="text/css">
        .ui.file.input input[type="file"] {
            display: none;
        }
        .ui.button>.ui.floated.label {
            position: absolute;
            top: 15px;
            right: -10px;
        }
        .table tr th{
            white-space: nowrap;
        }
    </style>
    @yield('css')
    @yield('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119518882-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-119518882-2');
    </script> -->

</head>

<body id="app">
    <div class="dimmed pusher content">
        <header>
            @include('partials.header')
        </header>

        <message></message>
        <div class="main ui fluid container" id="main-container">
            @yield('content')
        </div>
    </div>
    
    {{-- @include('partials.footer') --}}

    {{-- form modals --}}
    @yield('modals')
    <div class="ui mini modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui tiny modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui small modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui large modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    <div class="ui fullscreen modal">
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Loading</div>
        </div>
    </div>

    {{-- Script --}}
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!}
    </script>
    {{-- <script src="{{ asset('js/es6-promise.auto.min.js') }}"></script> --}}
    
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('semantic/semantic.min.js') }}"></script>


    
    <script src="{{ asset('js/global-variable.js') }}"></script>
    @yield('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // initialize and add onChange event
            $('.ui.dropdown').dropdown({
                onChange: function(value) {
                    var target = $(this).dropdown();
                    if (value!="") {
                        target
                            .find('.dropdown.icon')
                            .removeClass('dropdown')
                            .addClass('delete')
                            .on('click', function() {
                                target.dropdown('clear');
                                $(this).removeClass('delete').addClass('dropdown');
                                return false;
                            });
                    }
                }
            });
            // force onChange  event to fire on initialization
            $('.ui.dropdown')
                .closest('.ui.selection')
                .find('.item.active').addClass('qwerty').end()
                .dropdown('clear')
                    .find('.qwerty').removeClass('qwerty')
                .trigger('click');

            $('.message .close').on('click', function() {
                $(this).closest('.message').transition('fade');
            });
        });

        $(document)
          .on('click', '.ui.file.input input:text, .ui.button', function(e) {
            $(e.target).parent().find('input:file').click();
          })
        ;

        $(document)
          .on('change', '.ui.file.input input:file', function(e) {
            var file = $(e.target);
            var name = '';

            for (var i=0; i<e.target.files.length; i++) {
              name += e.target.files[i].name + ', ';
            }
            // remove trailing ","
            name = name.replace(/,\s*$/, '');
            console.log(name);

            $('input:text', file.parent()).val(name);
          })
        ;
    </script>
        
    @yield('scripts')
</body>
</html>