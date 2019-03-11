<div class="ui grid">
	{{-- right form --}}
	<div class="sixteen wide column">
		<div class="ui form">
			<div class="ui segment">
				<div class="fields">
					<div class="eight wide field">
						<label for="">Unsur</label>
						<div class="ui small input">
							<select id="penugasan_unsur" class="ui fluid search selection dropdown pilihan">
								{!! 
									\App\Models\Master\Kategori::options('nama', 'id', [
										'filters' => [function($q){ $q->whereIn('sub_unsur_id', [3,4,5]); }]
									])
								!!}
							</select>
						</div>
					</div>
					<div class="eight wide field">
						<label for="">Sub Unsur</label>
						<div class="ui small input">
							<select id="penugasan_subunsur" class="ui fluid search selection dropdown pilihan">
								
							</select>
						</div>
					</div>
				</div>
				<div class="fields">
					<div class="thirteen wide field">
						<label for="">Keterangan / Judul</label>
						<div class="ui small input">
							<input type="text" id="penugasan_keterangan" placeholder="Diisi dengan nama/judul penugasan">
						</div>
					</div>
					<div class="two wide field">
						<label for="">Tahun</label>
						<div class="ui small input">
							<input type="number" id="penugasan_tahun" placeholder="Tahun" max="{{ date('Y') }}">
						</div>
					</div>
					<div class="one wide field">
						<label for="">&nbsp;</label>
						<button type="button" class="ui teal icon button" onclick="penugasan_add_row('penugasan_row')">
							<i class="plus icon"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="field">
				<div class="sixteen wide field">
					<table class="ui celled table">
						<thead>
					    	<tr>
						    	{{-- <th width="1%">No</th> --}}
							    <th>Sub Unsur</th>
							    <th>Keterangan</th>
							    <th>Tahun</th>
							    <th>Nilai</th>
							    <th width="1%"></th>
							</tr>
						</thead>
					  	<tbody id="penugasan_row">
					    	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- left form --}}
</div>

<template id="template_penugasan">
	<tr>
  		{{-- <td><span class="nomor">1</span></td> --}}
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
  			<button type="button" class="ui red icon button mini" onclick="penugasan_delete_row(this)"><i class="trash icon"></i></button>
  		</td>
	</tr>
</template>

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		
		$('#penugasan_unsur').on('change', function(){
			$('#penugasan_subunsur').dropdown('clear');

			$.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
				$('#penugasan_subunsur').html(response)
			});
		})

		/* buat add row */
		penugasan_add_row = function(tbody){
			// get from template
            var tmp = $('#template_penugasan').html();
            var row = $(tmp);

            $(row).find('.sub_unsur').html($('#penugasan_subunsur :selected').text())
            $(row).find('.keterangan').html($('#penugasan_keterangan').val())
            $(row).find('.tahun').html($('#penugasan_tahun').val())
            $(row).find('.nilai').html('-')

            $(row).find('input[name="angkakredit_id[]"]').val($('#penugasan_subunsur :selected').val())
            $(row).find('input[name="angkakredit_deskripsi[]"]').val($('#penugasan_keterangan').val())
            $(row).find('input[name="angkakredit_tahun[]"]').val($('#penugasan_tahun').val())

            // get angka kredit
            $.post('{{ url('ajax/info/angka-kredit') }}', {id: $('#penugasan_subunsur :selected').val()}, function(response) {
            	var res = eval('('+response+')')
            	if (res.nilai == 'Paket') {
            		$(row).find('.nilai').html('')
            		$(row).find('input[name="angkakredit_nilai[]"]').val(0).attr('type', 'number').css('width', '85px');;
            	} else {
            		$(row).find('.nilai').html(res.nilai)
            		$(row).find('input[name="angkakredit_nilai[]"]').val(res.nilai)
            	}
            });

            if($('#penugasan_subunsur :selected').val() && $('#penugasan_keterangan').val() && $('#penugasan_tahun').val()){
	            // clear form
	            $('#penugasan_unsur').dropdown('clear')
	            $('#penugasan_subunsur').dropdown('clear')
	            $('#penugasan_keterangan').val('')
	            $('#penugasan_tahun').val('')

	            // append to table
	            $('#' + tbody).append(row);            	
            }else{
            	alert('Pilih Unsur & Isi Keterangan/Judul dan Tahun!');
            }
		}

		penugasan_delete_row = function(elm){
			//var idx = $(elm).closest("tr").index()
            
            // if (idx != 0) {
                var tr = $(elm).closest("tr")

                $(tr).fadeOut(500, function(){
                    $(this).remove();
                });
            // }
		}

		penugasan_reindex = function(){

		}
		/* buat add row */

	});
</script>
@append