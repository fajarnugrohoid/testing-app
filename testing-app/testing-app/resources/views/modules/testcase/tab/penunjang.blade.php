<div class="ui grid">
	{{-- right form --}}
	<div class="sixteen wide column">
		<div class="ui form">
			<div class="ui segment">
				<div class="fields">
					<div class="eight wide field">
						<label for="">Unsur</label>
						<div class="ui small input">
							<select id="penunjang_unsur" class="ui fluid search selection dropdown pilihan">
								{!! 
									\App\Models\Master\Kategori::options('nama', 'id', [
										'filters' => [function($q){ $q->whereIn('sub_unsur_id', [9,10,11]); }]
									])
								!!}
							</select>
						</div>
					</div>
					<div class="eight wide field">
						<label for="">Subunsur</label>
						<div class="ui small input">
							<select id="penunjang_subunsur" class="ui fluid search selection dropdown pilihan">

							</select>
						</div>
					</div>
				</div>
				<div class="fields">
					<div class="thirteen wide field">
						<label for="">Keterangan / Judul</label>
						<div class="ui small input">
							<input type="text" id="penunjang_keterangan" placeholder="Diisi dengan nama/Judul penunjang">
						</div>
					</div>
					<div class="two wide field">
						<label for="">Tahun</label>
						<div class="ui small input">
							<input type="number" id="penunjang_tahun" max="{{ date('Y') }}">
						</div>
					</div>
					<div class="one wide field">
						<label for="">&nbsp;</label>
						<button type="button" class="ui teal icon button" onclick="penunjang_add_row('penunjang')">
							<i class="plus icon"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="fields">
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
					  	<tbody id="penunjang_row">
					    	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{-- left form --}}
</div>

<template id="template_penunjang">
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
  			<button type="button" class="ui red icon button mini" onclick="penunjang_delete_row(this)"><i class="trash icon"></i></button>
  		</td>
	</tr>
</template>

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		// onchange
		$('#penunjang_unsur').on('change', function(){
			$('#penunjang_subunsur').dropdown('clear');

			$.post('{{ url('ajax/option/angka-kredit') }}', {kategori_id: this.value}, function(response, textStatus, xhr) {
				$('#penunjang_subunsur').html(response)
			});
		})

		/* buat add row */
		penunjang_add_row = function(prefix){
			// get from template
            var tmp = $('#template_penunjang').html();
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

		penunjang_delete_row = function(elm){
			//var idx = $(elm).closest("tr").index()
            
            // if (idx != 0) {
                var tr = $(elm).closest("tr")

                $(tr).fadeOut(500, function(){
                    $(this).remove();
                });
            // }
		}

		penunjang_reindex = function(){

		}
		/* buat add row */

	});
</script>
@append