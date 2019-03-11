<div class="ui grid">
	{{-- right form --}}
	<div class="eight wide column">
		<div class="ui form">
			<input type="hidden" name="pendidikan">
			<input type="hidden" name="jurusan">
			<input type="hidden" name="tahun_pendidikan">
			<div class="inline fields">
				<div class="sixteen wide field">
					<label>Merupakan pendidikan baru</label>
				    <div class="field">
				      <div class="ui radio checkbox">
				        <input type="radio" name="pendidikan_baru" value="1">
				        <label>Ya</label>
				      </div>
				    </div>
				    <div class="field">
				      <div class="ui radio checkbox">
				        <input type="radio" name="pendidikan_baru" value="0" checked="checked" >
				        <label>Tidak</label>
				      </div>
				    </div>
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<label for="">Pendidikan (Sesuai SK Mengajar)</label>
					<div class="ui small input">
						<select id="pendidikan" name="angkakredit_id[]" class="ui fluid search selection dropdown pilihan pendidikan" disabled="">
						</select>
						<input type="hidden" id="nilai_pendidikan" name="angkakredit_nilai[]" disabled="">
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="twelve wide field">
					<label for="">Jurusan</label>
					<div class="ui small input">
						<input type="text" id="jurusan" name="angkakredit_deskripsi[]" disabled="" placeholder="Jurusan">
					</div>
				</div>
				<div class="four wide field">
					<label for="">Tahun Lulus</label>
					<div class="ui small input">
						<input type="text" id="tahun_pendidikan" name="angkakredit_tahun[]" disabled="" placeholder="Tahun">
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- left form --}}
	<div class="ui vertical divider" style="left: 50%;"></div>
	<div class="eight wide column">
		<div class="ui form">
			<div class="inline fields">
				<div class="sixteen wide field">
					<label>Mengikuti Prajabatan</label>
				    <div class="field">
				      <div class="ui radio checkbox">
				        <input type="radio" name="prajabatan" value="1">
				        <label>Ya</label>
				      </div>
				    </div>
				    <div class="field">
				      <div class="ui radio checkbox">
				        <input type="radio" name="prajabatan" checked="checked" value="0">
				        <label>Tidak</label>
				      </div>
				    </div>
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<div class="ui small input">
						<input type="text" id="prajabatan_angkakredit_deskripsi" name="angkakredit_deskripsi[]" disabled="" placeholder="Nomor sertifikat prajabatan">
						<input type="hidden" id="prajabatan_angkakredit_id" name="angkakredit_id[]" value="" disabled="">
						<input type="hidden" id="prajabatan_angkakredit_nilai" name="angkakredit_nilai[]" value="" disabled="">
						<input type="hidden" id="prajabatan_angkakredit_tahun" name="angkakredit_tahun[]" value="-" disabled="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		/* pendidikan */
		$('#pendidikan').on('change', function(){
			$('input[name=pendidikan]').val($('#pendidikan :selected').text())
			// get angka kredit
            $.post('{{ url('ajax/info/angka-kredit') }}', {id: $('#pendidikan :selected').val()}, function(response) {
            	var res = eval('('+response+')')
            	$('#nilai_pendidikan').val(res.nilai)
            });
		})

		$('#jurusan').on('change', function(){
			$('input[name=jurusan]').val($('#jurusan').val())
		})

		$('#tahun_pendidikan').on('change', function(){
			$('input[name=tahun_pendidikan]').val($('#tahun_pendidikan').val())
		})

		$('input[name=pendidikan_baru]').change(function() {
		    if (this.value == "1") {
		    	$('#pendidikan').prop('disabled',false);
		    	$('.pendidikan').removeClass('disabled');
		    	$('#jurusan').prop('disabled',false);
		    	$('#tahun_pendidikan').prop('disabled',false);
		    	$('#nilai_pendidikan').prop('disabled',false);
		    }
		    else if (this.value == "0") {
		        $('#pendidikan').prop('disabled',true);
		    	$('.pendidikan').addClass('disabled');
		    	$('#jurusan').prop('disabled',true);
		    	$('#tahun_pendidikan').prop('disabled',true);
		    	$('#nilai_pendidikan').prop('disabled',true);
		    }
		});

		/* prajabatan */
		$('input[name=prajabatan]').change(function() {
		    if (this.value == "1") {
		    	$('#prajabatan_angkakredit_deskripsi').prop('disabled',false);
		    	$('#prajabatan_angkakredit_id').prop('disabled',false);
		    	$('#prajabatan_angkakredit_nilai').prop('disabled',false);
		    	$('#prajabatan_angkakredit_tahun').prop('disabled',false);
		    }
		    else if (this.value == "0") {
		    	$('#prajabatan_angkakredit_deskripsi').prop('disabled',true);
		    	$('#prajabatan_angkakredit_id').prop('disabled',true);
		    	$('#prajabatan_angkakredit_nilai').prop('disabled',true);
		    	$('#prajabatan_angkakredit_tahun').prop('disabled',true);
		    }
		});
	});
</script>
@append