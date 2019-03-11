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
        <!--<input type="hidden" name="id" value="{{ isset($record->id) ? Helper::encrypt($record->id) : '' }}">-->

        {{-- loading --}}
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Mengirim Data...</div>
        </div>
        <div class="ui grid">
            {{-- right form --}}
            <div class="sixteen wide column">
                <div class="ui form">
                    <h4 class="ui horizontal divider header blue">Project</h4>             
                    <div class="ui segment">
                        <div class="fields">
                            <div class="eight wide field">
                                <label for="">Project Name</label>
                                <div class="ui small input">
                                    <input type="text" id="project_name" name="project_name" placeholder="Project ID">
                                </div>
                            </div>
                            <div class="eight wide field">
                                <label for="">Description</label>
                                <div class="ui small input">
                                    <input type="text" id="description" name="description" placeholder="Description">
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label for="">Start Project</label>
                                <div class="ui calendar">
                                    <div class="ui small input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name="start_project"  value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="eight wide field">
                                <label for="">End Project</label>
                                <div class="ui calendar">
                                    <div class="ui small input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name="end_project"  value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <div class="right aligned column">
                                        <div class="ui green right labeled icon button save" onclick="javascript:saveData('form-data')"><i class="right check icon"></i> Simpan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{--ui form--}}
            </div>
            {{-- left form --}}
        </div>
    </form>
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        // onchange
        $('#pkb_a_unsur').on('change', function(){
            $('#pkb_a_subunsur').dropdown('clear');

            $.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
                $('#pkb_a_subunsur').html(response)
            });
        })

        $('#pkb_b_unsur').on('change', function(){
            $('#pkb_b_subunsur').dropdown('clear');

            $.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
                $('#pkb_b_subunsur').html(response)
            });
        })

        $('#pkb_c_unsur').on('change', function(){
            $('#pkb_c_subunsur').dropdown('clear');

            $.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
                $('#pkb_c_subunsur').html(response)
            });
        })

        /* buat add row */
        pkb_add_row = function(prefix){
            // get from template
            var tmp = $('#template_pkb').html();
            var row = $(tmp);

            $(row).find('.unsur').html($('#'+prefix+'_unsur :selected').text())
            $(row).find('.sub_unsur').html($('#'+prefix+'_subunsur :selected').text())
            $(row).find('.keterangan').html($('#'+prefix+'_keterangan').val())
            $(row).find('.tahun').html($('#'+prefix+'_tahun').val())
            $(row).find('.nilai').html('-')

            $(row).find('input[name="angkakredit_id[]"]').val($('#'+prefix+'_subunsur :selected').val())
            $(row).find('input[name="angkakredit_deskripsi[]"]').val($('#'+prefix+'_keterangan').val())
            $(row).find('input[name="angkakredit_tahun[]"]').val($('#'+prefix+'_tahun').val())

            // get angka kredit
            $.post('{{ url('ajax/info/angka-kredit') }}', {id: $('#'+prefix+'_subunsur :selected').val()}, function(response) {
                var res = eval('('+response+')')
                $(row).find('.nilai').html(res.nilai);
                $(row).find('input[name="angkakredit_nilai[]"]').val(res.nilai);
            });

            if($('#'+prefix+'_subunsur :selected').val() && $('#'+prefix+'_keterangan').val() && $('#'+prefix+'_tahun').val()){
                // clear form
                $('#'+prefix+'_unsur').dropdown('clear');
                $('#'+prefix+'_subunsur').dropdown('clear');
                $('#'+prefix+'_keterangan').val('');
                $('#'+prefix+'_tahun').val('');

                // append to table
                $('#' + prefix + '_row').append(row);       
            }else{
                alert('Pilih Unsur & Isi Keterangan/Judul dan Tahun!');
            }
        }

        pkb_delete_row = function(elm){
            //var idx = $(elm).closest("tr").index()
            
            // if (idx != 0) {
                var tr = $(elm).closest("tr")

                $(tr).fadeOut(500, function(){
                    $(this).remove();
                });
            // }
        }

        pkb_reindex = function(){

        }
        /* buat add row */

    });
</script>
@append