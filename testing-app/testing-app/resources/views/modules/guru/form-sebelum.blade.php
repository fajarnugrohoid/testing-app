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

            // init component
            $('.pilihan').dropdown({
                  fullTextSearch : true,
            })
            $('.ui.calendar').calendar(calendarOpts);
            $('.ui.checkbox').checkbox();

            // onchange
            $('.utama').on('change', function(){
                calculate()
            })

            $('.penunjang').on('change', function(){
                calculate()
            })

            $('.ui.checkbox.konfirmasi').checkbox({
                onChange: function() {
                    // console.log($('.ui.checkbox.konfirmasi').checkbox('is checked'))
                    if ($('.ui.checkbox.konfirmasi').checkbox('is checked')) {
                        $('.button.save').removeClass('disabled')
                    } else {
                        $('.button.save').addClass('disabled')
                    }
                }
            });

            // function
            calculate = function(){
                var utama = 0.0
                var penunjang = 0.0

                $('input.utama').each(function(index, el) {
                    utama += parseFloat($(el).val())
                });

                $('input.penunjang').each(function(index, el) {
                    penunjang += parseFloat($(el).val())
                });


                $('#total_utama').html(utama)
                $('#total_penunjang').html(penunjang)
                $('#total_semua').html(utama+penunjang)
            }

        });
    </script>
@append

@section('form')
	<form id="form-data" action="{{ url($pageUrl) }}" method="post" class="ui data form">
        <input type="hidden" name="status" value="lama">

        <input type="hidden" name="tgl_lahir" value="{{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d/m/Y') }}">
        <input type="hidden" name="pendidikan" value="-">
        <input type="hidden" name="jurusan" value="-">
        <input type="hidden" name="tahun_pendidikan" value="-">

        {{-- loading --}}
        <div class="ui inverted loading dimmer">
            <div class="ui text loader">Mengirim Data...</div>
        </div>

        {{-- Content Tab --}}
        <div class="ui active transition tab content" id="content-tab-1">
            <div class="ui top attached segment min-content">
                <div class="ui grid">
                    <div class="sixteen wide column">
                        <div class="ui orange message">
                            <div class="ui konfirmasi">
                                <label>Isi Golongan/Pangkat/Jabatan & Penilaian Angka Kredit (PAK) terakhir sebelum membuat DUPAK baru!</label>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="five wide field">
                                <label for="">Gol / Pangkat / Jabatan Saat ini</label>
                                <div class="ui small input">
                                    <select name="golongan_id" class="ui fluid search selection dropdown pilihan">
                                        {!! 
                                            \App\Models\Master\Golongan::options(function($q){ return $q->nama . ' / ' . $q->pangkat . ' / ' . $q->jabatan; }, 'id', [
                                                'selected' => $biodata->golongan_id,
                                            ])
                                        !!}
                                    </select>
                                </div>
                            </div>
                            <div class="three wide field">
                                <label>TMT Golongan</label>
                                <div class="ui calendar" id="to">
                                    <div class="ui small input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" name="tmt_golongan" value="{{ $biodata->tmt_golongan ? \Carbon\Carbon::parse($biodata->tmt_golongan)->format('d/m/Y') : '' }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="eight wide field">
                                <label for="">Unit Kerja</label>
                                <div class="ui small input">
                                    <select name="unit_kerja_id" class="ui fluid search selection dropdown pilihan">
                                        {!! 
                                            \App\Models\Master\UnitKerja::options(function($q){ return $q->nama . ' - ' . $q->kecamatan; }, 'id', [

                                            ])
                                        !!}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <table class="ui celled striped table">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th class="collapsing" colspan="3">Unsur, Sub Unsur, Butir Kegiatan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>I</td>
                                    <td colspan="3">Unsur Utama</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">1</td>
                                    <td colspan="2">Pendidikan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">a</td>
                                    <td>Mengikuti pendidikan dan mernperoleh gelar/ijazah/akta</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama1a->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">b</td>
                                    <td>Mengikuti pelatihan prajabatan  </td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama1b->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">2</td>
                                    <td colspan="2">Pembelajaran/ Bimbingan Dan Tugas Tertentu  </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">a</td>
                                    <td>Melaksanakan proses pembelajaran</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama2a->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">b</td>
                                    <td>Melaksanakan proses bimbingan</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama2b->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">c</td>
                                    <td>Melaksanakan tugas lain yang relevan dengan fungsi sekolah / madrasah.</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama2c->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">3</td>
                                    <td colspan="2">Pengembangan Keprofesian Berkelanjutan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">a</td>
                                    <td>Pengembangan diri</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama3a->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">b</td>
                                    <td>Publikasi ilmiah</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama3b->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td width="1%">c</td>
                                    <td>Karya inovatif</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $utama3c->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="utama" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="center aligned"><strong>Total Unsur Utama</strong></td>
                                    <td class="center aligned"><strong id="total_utama">0</strong></td>
                                </tr>
                                <tr>
                                    <td>II</td>
                                    <td colspan="3">Unsur Penunjang</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">1</td>
                                    <td colspan="2">Memperoleh gelar/ijazah yang tidak sesuai dengan bidang yang diampunya</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $penunjang1->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="penunjang" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">2</td>
                                    <td colspan="2">Melaksanakan kegiatan yang mendukung tugas guru</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $penunjang2->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="penunjang" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td width="1%">3</td>
                                    <td colspan="2">Perolehan penghargaan/tanda jasa</td>
                                    <td>
                                        <input type="hidden" name="angkakredit_id[]" value="{{ $penunjang3->id }}">
                                        <input type="hidden" name="angkakredit_deskripsi[]" value="">
                                        <input type="hidden" name="angkakredit_tahun[]" value="">
                                        <input type="number" name="angkakredit_nilai[]" placeholder="Input Nilai" class="penunjang" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="center aligned"><strong>Total Unsur Penunjang</strong></td>
                                    <td class="center aligned"><strong id="total_penunjang">0</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="center aligned"><strong>Total Unsur Utama & Penunjang</strong></td>
                                    <td class="center aligned"><strong id="total_semua">0</strong></td>
                                </tr>
                          </tbody>
                        </table>
                        <div class="ui centered grid">
                            <div class="eight wide column main-content">
                                <div class="ui error message" style="margin:0px !important;"></div>
                                <div class="ui info message">
                                    <div class="ui checkbox konfirmasi">
                                        <input type="checkbox" name="check">
                                        <label>Data yang dimasukan sudah sesuai dengan PAK terakhir</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui bottom attached segment">
                <div class="ui grid">
                    <div class="right aligned column">
                        <div class="ui green right labeled icon button save disabled" onclick="javascript:saveData('form-data')"><i class="check icon"></i> Simpan</div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection