<div class="ui inverted loading dimmer">
	<div class="ui text loader">Loading</div>
</div>
<div class="header">Form Penolakan</div>
<div class="content">
 	<form class="ui data form" id="form-tolak" action="{{ url('penilai/proses-tolak') }}" method="POST">
 		<input type="hidden" name="detail_id" value="{{ $detail->id }}">
		<div class="ui error message"></div>
		{!! csrf_field() !!}
		<table class="ui celled compact table">
        <thead>
            <tr>
                <th class="center aligned" width="1%">Kode</th>
                <th class="center aligned" width="44%">Alasan</th>
                <th class="center aligned" width="45%">Saran</th>
                <th class="center aligned" width="10px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail->angkaKredit->penolakanAngkaKredit as $item)
            	<tr>
                    <td>{{ $item->nomor }}{{ $item->sub_nomor }}</td>
            		<td>{{ $item->alasan }}</td>
            		<td>{{ $item->saran }}</td>
            		<td style="white-space: nowrap;" class="aksi center aligned middle aligned">
            			<div class="ui checkbox">
						    <input type="checkbox" name="tolak[{{ $item->id }}]" >
						</div>
            		</td>
            	</tr>
            @endforeach
        </tbody>
    </table>
	</form>
</div>
<div class="actions">
	<div class="ui black deny button">
		Batal
	</div>
	<div class="ui positive right labeled icon save button">
		Simpan
		<i class="checkmark icon"></i>
	</div>
</div>