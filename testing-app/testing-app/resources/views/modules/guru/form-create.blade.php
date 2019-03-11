@extends('layouts.form')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semanticui-calendar/calendar.min.css') }}">
@append

@section('js')
	<script src="{{ asset('plugins/summernote/summernote-lite.js') }}"></script>
    <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js') }}"></script>
@append

@section('scripts')
	<script type="text/javascript">
        $(document).ready(function() {

            $('.button.next').on('click', function(){
                // populate in last state
                // if ($(this).data('tab') == 4) {
                //     populateFormKonfirmasi()
                // }

                // change active header
                $('.step').removeClass('active')
                $('.step').addClass('disabled')

                $('#header-tab-' + $(this).data('tab')).removeClass('disabled')
                $('#header-tab-' + $(this).data('tab')).addClass('active')

                // change active header
                $('.tab.content').removeClass('active')
                $('#content-tab-' + $(this).data('tab')).addClass('active')
            })

            $('.button.previous').on('click', function(){
                // change active header
                $('.step').removeClass('active')
                $('.step').addClass('disabled')

                $('#header-tab-' + $(this).data('tab')).removeClass('disabled')
                $('#header-tab-' + $(this).data('tab')).addClass('active')

                // change active header
                $('.tab.content').removeClass('active')
                $('#content-tab-' + $(this).data('tab')).addClass('active')
            })

        });

        $(document).ready(function($) {
            $('.pilihan').dropdown({
                fullTextSearch : true,
            })
            $('.ui.calendar').calendar(calendarOpts);
            $('.ui.checkbox').checkbox();
        });
    </script>
@append

@section('form')
	<form id="form-data" action="{{ url($pageUrl) }}" method="post" class="ui data form">
        <input type="hidden" name="status" value="baru">
        <input type="hidden" name="id" value="{{ isset($record->id) ? Helper::encrypt($record->id) : '' }}">

        {{-- loading --}}
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Mengirim Data...</div>
        </div>

        <div class="ui six mini steps">
          <div class="step active" id="header-tab-1">
            <i class="user icon"></i>
            <div class="content">
              <div class="title">Biodata</div>
              <div class="description">Biodata Pendaftar</div>
            </div>
          </div>
          <div class="disabled step" id="header-tab-2">
            <i class="graduation cap icon"></i>
            <div class="content">
              <div class="title">Pendidikan</div>
              <div class="description">Detail Pendidikan</div>
            </div>
          </div>
          <div class="disabled step" id="header-tab-3">
            <i class="briefcase icon"></i>
            <div class="content">
              <div class="title">Penugasan</div>
              <div class="description">Detail Penugasan</div>
            </div>
          </div>
          <div class="disabled step" id="header-tab-4">
            <i class="folder icon"></i>
            <div class="content">
              <div class="title">PKB</div>
              <div class="description">Pengembangan Keprofesian Berkelanjutan</div>
            </div>
          </div>
          <div class="disabled step" id="header-tab-5">
            <i class="folder open icon"></i>
            <div class="content">
              <div class="title">Penunjang</div>
              <div class="description">Penunjang Tugas Guru</div>
            </div>
          </div>
          <div class="disabled step" id="header-tab-6">
            <i class="check circle icon"></i>
            <div class="content">
              <div class="title">Konfirmasi</div>
              <div class="description">Mengirim Data</div>
            </div>
          </div>
        </div>

        {{-- Content Tab --}}
        <div class="ui active transition tab content" id="content-tab-1">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.biodata')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui grid">
                    <div class="right aligned column">
                        <div class="ui blue right labeled icon button next" data-tab="2"><i class="right arrow icon"></i> Selanjutnya</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui transition tab content" id="content-tab-2">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.pendidikan')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui two columns grid">
                    <div class="left aligned column">
                        <div class="ui left labeled icon button previous" data-tab="1"><i class="left arrow icon"></i> Sebelumnya</div>
                    </div>

                    <div class="right aligned column">
                        <div class="ui blue right labeled icon button next" data-tab="3"><i class="right arrow icon"></i> Selanjutnya</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="ui transition tab content" id="content-tab-3">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.penugasan')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui two columns grid">
                    <div class="left aligned column">
                        <div class="ui left labeled icon button previous" data-tab="2"><i class="left arrow icon"></i> Sebelumnya</div>
                    </div>

                    <div class="right aligned column">
                        <div class="ui blue right labeled icon button next" data-tab="4"><i class="right arrow icon"></i> Selanjutnya</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="ui transition tab content" id="content-tab-4">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.pkb')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui two columns grid">
                    <div class="left aligned column">
                        <div class="ui left labeled icon button previous" data-tab="3"><i class="left arrow icon"></i> Sebelumnya</div>
                    </div>

                    <div class="right aligned column">
                        <div class="ui blue right labeled icon button next" data-tab="5"><i class="right arrow icon"></i> Selanjutnya</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui transition tab content" id="content-tab-5">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.penunjang')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui two columns grid">
                    <div class="left aligned column">
                        <div class="ui left labeled icon button previous" data-tab="4"><i class="left arrow icon"></i> Sebelumnya</div>
                    </div>

                    <div class="right aligned column">
                        <div class="ui blue right labeled icon button next" data-tab="6"><i class="right arrow icon"></i> Selanjutnya</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui transition tab content" id="content-tab-6">
            <div class="ui top attached segment min-content">
                @include('modules.guru.tab.konfirmasi')
            </div>
            <div class="ui bottom attached segment">
                <div class="ui two columns grid">
                    <div class="left aligned column">
                        <div class="ui left labeled icon button previous" data-tab="5"><i class="left arrow icon"></i> Sebelumnya</div>
                    </div>

                    <div class="right aligned column">
                        <div class="ui green right labeled icon button save disabled" onclick="javascript:saveData('form-data')"><i class="right check icon"></i> Simpan</div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection