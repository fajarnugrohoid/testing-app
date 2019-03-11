<div class="ui grid">
	{{-- right form --}}
	<div class="sixteen wide column">
		<div class="ui form">
			<h4 class="ui horizontal divider header blue">A. Pengembangan Diri</h4>				
			<div class="ui segment">
				<div class="fields">
					<div class="eight wide field">
						<label for="">Unsur</label>
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
						<label for="">Subunsur</label>
						<div class="ui small input">
							<select id="pkb_a_subunsur" class="ui fluid search selection dropdown pilihan">

							</select>
						</div>
					</div>
				</div>
				<div class="fields">
					<div class="thirteen wide field">
						<label for="">Keterangan / Judul</label>
						<div class="ui small input">
							<input type="text" id="pkb_a_keterangan" placeholder="Diisi dengan nama/judul pengembangan diri">
						</div>
					</div>
					<div class="two wide field">
						<label for="">Tahun</label>
						<div class="ui small input">
							<input type="number" id="pkb_a_tahun" placeholder="Tahun" max="{{ date('Y') }}">
						</div>
					</div>
					<div class="one wide field">
						<label for="">&nbsp;</label>
						<button type="button" class="ui teal icon button" onclick="pkb_add_row('pkb_a')">
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
					  	<tbody id="pkb_a_row">
					    	
						</tbody>
					</table>
				</div>
			</div>

			<br>
			<h4 class="ui horizontal divider header blue">B. Publikasi Ilmiah</h4>
			<div class="ui segment">
				<div class="fields">
					<div class="eight wide field">
						<label for="">Unsur</label>
						<div class="ui small input">
							<select id="pkb_b_unsur" class="ui fluid search selection dropdown pilihan">
								{!! 
									\App\Models\Master\Kategori::options('nama', 'id', [
										'filters' => [function($q){ $q->whereIn('sub_unsur_id', [7]); }]
									])
								!!}
							</select>
						</div>
					</div>
					<div class="eight wide field">
						<label for="">Subunsur</label>
						<div class="ui small input">
							<select id="pkb_b_subunsur" class="ui fluid search selection dropdown pilihan">

							</select>
						</div>
					</div>
				</div>
				<div class="fields">
					<div class="thirteen wide field">
						<label for="">Keterangan / Judul</label>
						<div class="ui small input">
							<input type="text" id="pkb_b_keterangan" placeholder="Diisi dengan nama/judul publikasi ilmiah">
						</div>
					</div>
					<div class="two wide field">
						<label for="">Tahun</label>
						<div class="ui small input">
							<input type="number" id="pkb_b_tahun" placeholder="Tahun" max="{{ date('Y') }}">
						</div>
					</div>
					<div class="one wide field">
						<label for="">&nbsp;</label>
						<button type="button" class="ui teal icon button" onclick="pkb_add_row('pkb_b')">
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
					  	<tbody id="pkb_b_row">
					    	
						</tbody>
					</table>
				</div>
			</div>

			<br>
			<h4 class="ui horizontal divider header blue">C. Karya Inovatif</h4>
			<div class="ui segment">
				<div class="fields">
					<div class="eight wide field">
						<label for="">Unsur</label>
						<div class="ui small input">
							<select id="pkb_c_unsur" class="ui fluid search selection dropdown pilihan">
								{!! 
									\App\Models\Master\Kategori::options('nama', 'id', [
										'filters' => [function($q){ $q->whereIn('sub_unsur_id', [8]); }]
									])
								!!}
							</select>
						</div>
					</div>
					<div class="eight wide field">
						<label for="">Subunsur</label>
						<div class="ui small input">
							<select id="pkb_c_subunsur" class="ui fluid search selection dropdown pilihan">

							</select>
						</div>
					</div>
				</div>
				<div class="fields">
					<div class="thirteen wide field">
						<label for="">Keterangan / Judul</label>
						<div class="ui small input">
							<input type="text" id="pkb_c_keterangan" placeholder="Diisi dengan nama/judul karya inovatif">
						</div>
					</div>
					<div class="two wide field">
						<label for="">Tahun</label>
						<div class="ui small input">
							<input type="number" id="pkb_c_tahun" placeholder="Tahun" max="{{ date('Y') }}">
						</div>
					</div>
					<div class="one wide field">
						<label for="">&nbsp;</label>
						<button type="button" class="ui teal icon button" onclick="pkb_add_row('pkb_c')">
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
					  	<tbody id="pkb_c_row">
					    	
						</tbody>
					</table>
				</div>
			</div>
		</div>
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