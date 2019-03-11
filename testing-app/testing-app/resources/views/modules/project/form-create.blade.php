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
        <div class="ui grid">
    {{-- right form --}}
    <div class="sixteen wide column">
        <div class="ui form">
            <h4 class="ui horizontal divider header blue">Test Case</h4>             
            <div class="ui segment">
                <div class="fields">
                    <div class="eight wide field">
                        <label for="">Test Case ID</label>
                        <div class="ui small input">
                            <input type="text" id="test_case_id" placeholder="Test Case ID">
                        </div>
                    </div>
                    <div class="eight wide field">
                        <label for="">Title</label>
                        <div class="ui small input">
                            <input type="text" id="title" placeholder="Title">
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="eight wide field">
                        <label for="">Severity</label>
                        <div class="ui small input">
                            <select id="pkb_a_unsur" class="ui fluid search selection dropdown pilihan">
                                {!! 
                                    \App\Models\Master\Kategori::options('nama', 'id', [
                                        'filters' => [function($q){ $q->whereIn('sub_unsur_id', [6]); }]
                                    ])
                                !!}
                            </select>
                        </div>
                    </div>
                    <div class="eight wide field">
                        <label for="">Pre Conditions</label>
                        <div class="ui small input">
                            <select id="pkb_a_subunsur" class="ui fluid search selection dropdown pilihan">

                            </select>
                        </div>
                    </div>
                </div>

                <br/>
                <h4 class="ui horizontal divider header blue">List Test Case</h4>
                <div class="fields">
                    <div class="four wide field">
                        <label for="">Step 1</label>
                        <div class="ui small input">
                            <input type="text" id="step1" placeholder="Step1">
                        </div>
                    </div>
                    <div class="thirteen wide field">
                        <label for="">Actually</label>
                        <div class="ui small input">
                            <input type="text" id="pkb_a_keterangan" placeholder="Actually">
                        </div>
                    </div>
                    <div class="thirteen wide field">
                        <label for="">Expected Result</label>
                        <div class="ui small input">
                            <input type="text" id="pkb_a_tahun" placeholder="Expected Result">
                        </div>
                    </div>
                    <div class="eight wide field">
                        <label for="">&nbsp;</label>
                        <button type="button" class="ui teal icon button" onclick="pkb_add_row('pkb_a')">
                            <i class="plus icon"></i>
                        </button>
                        <button type="button" class="ui teal icon button" onclick="pkb_remove_row('pkb_a')">
                            <i class="minus icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!--<div class="fields">
                <div class="sixteen wide field">
                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th>Unsur</th>
                                <th>Sub Unsur</th>
                                <th>Keterangan</th>
                                <th>Tahun</th>
                                <th>Nilai</th>
                                <th width="1%"></th>
                            </tr>
                        </thead>
                        <tbody id="pkb_a_row">
                            
                        </tbody>
                    </table>
                </div>
            </div> -->

        </div> {{--ui form--}}
    </div>
    {{-- left form --}}
</div>
    
    <template id="template_pkb">
        <tr>
            {{-- <td><span class="nomor">1</span></td> --}}
            <td>
                <span class="unsur"></span>
            </td>
            <td>
                <span class="sub_unsur"></span>
                <input type="hidden" name="angkakredit_id[]">
            </td>
            <td>
                <span class="keterangan"></span>
                <input type="hidden" name="angkakredit_deskripsi[]">
            </td>
            <td>
                <span class="tahun"></span>
                <input type="hidden" name="angkakredit_tahun[]">
            </td>
            <td>
                <span class="nilai"></span>
                <input type="hidden" name="angkakredit_nilai[]">
            </td>
            <td>
                <button type="button" class="ui red icon button mini" onclick="pkb_delete_row(this)"><i class="trash icon"></i></button>
            </td>
        </tr>
    </template>
      

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