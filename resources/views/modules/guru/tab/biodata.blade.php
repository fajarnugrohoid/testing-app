<div class="ui grid">
	{{-- right form --}}
	<div class="eight wide column">
		<h4>Data Pribadi</h4>
		<div class="ui form">
			<div class="fields">
				<div class="eight wide field">
					<label>Nomor Induk Pegawai</label>
					<div class="ui small input">
						<input type="text" value="{{ $biodata->nip }}" readonly>
					</div>
				</div>
				<div class="eight wide field">
					<label>Nomor Induk Kependudukan</label>
					<div class="ui small input">
						<input type="text" name="nik" value="{{ $biodata->nik }}" readonly>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<label for="">Nama</label>
					<div class="ui small input">
						<input type="text" name="nama" value="{{ $biodata->nama }}">
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="ten wide field">
					<label for="">Tempat Lahir</label>
					<div class="ui small input">
						<input type="text" name="tmp_lahir" value="{{ $biodata->tmp_lahir }}">
					</div>
				</div>
				<div class="six wide field">
		  	  		<label>Tanggal Lahir</label>
		  	      	<div class="ui calendar">
						<div class="ui small input left icon">
							<i class="calendar icon"></i>
							<input type="text" name="tgl_lahir"  value="{{ \Carbon\Carbon::parse($biodata->tgl_lahir)->format('d/m/Y') }}" autocomplete="off">
						</div>
					</div>
				</div>	
			</div>
			<div class="inline fields">
				<label>Jenis Kelamin</label>
			    <div class="field">
			      <div class="ui radio checkbox">
			        <input type="radio" name="jk" value="L" {{ $biodata->jk == 'L' ? 'checked' : '' }}>
			        <label>Laki-laki</label>
			      </div>
			    </div>
			    <div class="field">
			      <div class="ui radio checkbox">
			        <input type="radio" name="jk" value="P" {{ $biodata->jk == 'P' ? 'checked' : '' }}>
			        <label>Perempuan</label>
			      </div>
			    </div>
			</div>
		</div>
	</div>
	{{-- left form --}}
	<div class="ui vertical divider" style="left: 50%;"></div>
	<div class="eight wide column">
		<h4>Data Unit Kerja</h4>
		<div class="ui form">
			<div class="fields">
				<div class="eight wide field">
					<label for="">Kab / Kota</label>
					<div class="ui small input">
						<select name="kota" class="ui fluid search selection dropdown pilihan">
							{!! 
								\App\Models\Master\Kota::options('nama', 'id', [
									'selected' => isset($biodata->unitKerja) ? $biodata->unitKerja->kota_id : '',
								])
							!!}
						</select>
					</div>
				</div>
				<div class="eight wide field">
					<label for="">Sekolah</label>
					<div class="ui small input">
						<select name="unit_kerja_id" class="ui fluid search selection dropdown pilihan">
							
						</select>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="sixteen wide field">
					<label for="">Alamat Unit kerja</label>
					<div class="ui small input">
						<textarea rows="4" readonly="readonly" id="alamat_unit_kerja">{{ isset($biodata->unitKerja) ? $biodata->unitKerja->alamat : '' }}</textarea>
					</div>
				</div>
			</div>
			
			<div class="fields">
				<div class="twelve wide field">
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
				<div class="four wide field">
					<label>TMT</label>
		  	      	<div class="ui calendar" id="to">
						<div class="ui small input left icon">
							<i class="calendar icon"></i>
							<input type="text" name="tmt_golongan" value="{{ $biodata->tmt_golongan ? \Carbon\Carbon::parse($biodata->tmt_golongan)->format('d/m/Y') : '' }}" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		$('select[name=kota]').on('change', function(){
			$.post('{{ url('ajax/option/unit-kerja') }}', {kota_id: this.value}, function(response, textStatus, xhr) {
				$('select[name=unit_kerja_id]').dropdown('clear');
				$('select[name=unit_kerja_id]').html(response)
			});
		})

		$('select[name=unit_kerja_id]').on('change', function(){
			$('#alamat_unit_kerja').html('');

			$.post('{{ url('ajax/info/unit-kerja') }}', {id: this.value}, function(response) {
            	var res = eval('('+response+')')
            	$('#alamat_unit_kerja').html(res.alamat);
            });
		})

	});
</script>
@append