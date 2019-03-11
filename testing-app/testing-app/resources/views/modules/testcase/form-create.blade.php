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
                                <label for="">Project</label>
                                <div class="ui small input">
                                    <select id="project_id" name="project_id" class="ui fluid search selection dropdown pilihan">
                                        {!! 
                                            \App\Models\Projects::options('project_name', 'id', [])
                                        !!}
                                    </select>
                                </div>
                            </div>
                            <div class="eight wide field">
                                <label for="">Title</label>
                                <div class="ui small input">
                                    <input type="text" id="title" name="title" placeholder="Title">
                                </div>
                            </div>
                            
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label for="">Severity</label>
                                <div class="ui small input">
                                    <select id="severity" name="severity" class="ui fluid search selection dropdown pilihan">
                                        {!! 
                                            \App\Models\Master\Severity::options('severity_name', 'id', [])
                                        !!}
                                    </select>
                                </div>
                            </div>
                            <div class="eight wide field">
                                <label for="">Type Test</label>
                                <div class="ui small input">
                                    <select id="type_test" name="type_test" class="ui fluid search selection dropdown pilihan">
                                        {!! 
                                            \App\Models\Master\TypeTest::options('name', 'id', [])
                                        !!}
                                    </select>
                                </div>
                            </div>
                            
                        </div>

                        <div class="fields">
                            
                            <div class="eight wide field">
                                <label for="">Version</label>
                                <div class="ui small input">
                                    <input type="text" id="version" name="version" placeholder="Version">
                                </div>
                            </div>
                            
                        </div>
                        <div class="fields">
                            <div class="thirteen wide field">
                                <label for="">Pre Conditions</label>
                                <div class="ui small input">
                                    <textarea id="pre_condition" name="pre_condition"></textarea>
                                </div>
                            </div>
                            <div class="thirteen wide field">
                                <label for="">Description</label>
                                <div class="ui small input">
                                    <textarea id="description" name="description" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="sixteen wide field">
                                <table class="ui celled table">
                                    <thead>
                                        <tr>
                                            <th width="10%">Step No</th>
                                            <th>What To Do</th>
                                            <th>Expected Result</th>
                                            <th width="15%">Act</th>
                                        </tr>
                                    </thead>
                                    <tbody id="step_tbody">
                                        <tr>
                                            <td><input type="text" name="step_no[]"></td>
                                            <td><input type="text" name="what_to_do[]"></td>
                                            <td>
                                                <input type="text" name="expected_result[]"></td>
                                            <td>
                                                <button type="button" class="ui teal icon button" onclick="pkb_add_row('pkb_c')">
                                                    <i class="plus icon"></i>
                                                </button>
                                                <button type="button" class="ui teal icon button" onclick="pkb_delete_row('pkb_c')">
                                                    <i class="minus icon"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                    <!--<tbody id="pkb_c_row">
                                        
                                    </tbody>-->
                                </table>
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

            </div> {{--sixteen wide column--}}
            {{--left form--}}
        </div> {{--ui grid--}}
    </form>
@endsection

            <!--<button type="button" class="ui red icon button mini" onclick="pkb_delete_row(this)"><i class="trash icon"></i></button> -->

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#pkb_b_unsur').on('change', function(){
            $('#pkb_b_subunsur').dropdown('clear');

            $.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
                $('#pkb_b_subunsur').html(response)
            });
        });

        $('#pkb_c_unsur').on('change', function(){
            $('#pkb_c_subunsur').dropdown('clear');

            $.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
                $('#pkb_c_subunsur').html(response)
            });
        })

        /* buat add row */
        pkb_add_row = function(prefix){
            // get from template
            var tmp = $('#step_tbody').html();
            var row = $(tmp);
            
            $(row).find('input[name="step_no[]"]').val();
            console.log("row:",row);
            /*$(row).find('input[name="angkakredit_deskripsi[]"]').val($('#'+prefix+'_keterangan').val())
            $(row).find('input[name="angkakredit_tahun[]"]').val($('#'+prefix+'_tahun').val())

            // get angka kredit
            $.post('{{ url('ajax/info/angka-kredit') }}', {id: $('#'+prefix+'_subunsur :selected').val()}, function(response) {
                var res = eval('('+response+')')
                $(row).find('.nilai').html(res.nilai);
                $(row).find('input[name="angkakredit_nilai[]"]').val(res.nilai);
            }); */
            var markup = "<tr>"
                        + "<td><input type='text' name='step_no[]'></td>" 
                        + "<td><input type='text' name='what_to_do[]'></td>"
                        + "<td><input type='text' name='expected_result[]'></td>"
                        + "<td>"
                            + "<button type='button' class='ui teal icon button' onclick='pkb_add_row(\"pkb_c\")'><i class='plus icon'></i>"
                            + "</button>"
                            + "<button type='button' class='ui teal icon button' onclick='pkb_delete_row(\"pkb_c\")'><i class='minus icon'></i></button>"
                        + "</td>"
                        +"</tr>";

                // append to table
                $('#step_tbody').append(markup);       
            
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