<div class="ui grid">
	<div class="sixteen wide column">
		@if(isset($pkb))
	        <table class="ui celled compact table">
	            <thead>
	                <tr>
	                    <th class="center aligned" width="25%">Unsur</th>
	                    <th class="center aligned" width="25%">Sub Unsur</th>
	                    <th class="center aligned" width="25%">Keterangan</th>
	                    <th class="center aligned">Tahun</th>
	                    <th class="center aligned">Nilai</th>
	                    <th class="center aligned">Status</th>
	                    <th class="center aligned">Aksi</th>
	                </tr>
	            </thead>
	            <tbody>
	                @foreach($pkb as $item)
	                	<tr>
	                		<td>{{ $item->angkaKredit->kategori->subUnsur->nama }}</td>
	                		<td>{{ $item->angkaKredit->kategori->nama }}</td>
	                		<td>{{ $item->deskripsi }}</td>
	                		<td>{{ $item->tahun }}</td>
	                		<td>{{ $item->angkaKredit->nilai }}</td>
	                		<td class="status">
	                          	@if($item->status == 0) <span class="ui tail label">Proses</span>
	                          	@elseif($item->status == 1) <span class="ui tail label green">Terima</span>
	                          	@else <span class="ui tail label red">Tolak</span>
	                          	@endif
	                     	</td>
	                		<td style="white-space: nowrap;" class="aksi">
	                			<button type="button" class="ui green button mini terima" onclick="showFormTerima(this, '{{ $item->id }}')">Terima</button>
	                			<button type="button" class="ui red button mini tolak" onclick="showFormTolak(this, '{{ Helper::encrypt($item->id) }}')">Tolak</button>
	                		</td>
	                	</tr>
	                @endforeach
	            </tbody>
	        </table>
        @endif
	</div>
</div>
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		
	});
</script>
@append