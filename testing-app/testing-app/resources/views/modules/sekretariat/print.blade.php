<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table{
			font-size: 60%;
			font-family: 'tahoma';
		}
		td{
			padding-left: 5px;
		}
		.number{
			text-align: right;
			padding-right: 5px;
		}
		.header{
			font-size: 100%;
		}
	</style>
</head>
<body>
<table width="100%" class="header">
	<tr>
		<th>DAFTAR USUL</th>
	</tr>
	<tr>
		<th>PENETAPAN ANGKA KREDIT GURU</th>
	</tr>
</table>
<table border="1" style="border-collapse: collapse;margin-top: 15px;">
    <tr>
        <th width="1%">NO</th>
        <th colspan="11">KETERANGAN PERSEORANGAN</th>
    </tr>
    <tr>
        <td width="1%">1</td>
        <td colspan="5">Nama</td>
        <td colspan="6">{{ $dupak->user->biodata->nama }}</td>
    </tr>
    <tr>
        <td width="1%">2</td>
        <td colspan="5">NIP</td>
        <td colspan="6">{{ $dupak->user->biodata->nip }}</td>
    </tr>
    <tr>
        <td width="1%">3</td>
        <td colspan="5">Tempat Tanggal Lahir</td>
        <td colspan="6">{{ $dupak->user->biodata->tmp_lahir.','.$dupak->user->biodata->tgl_lahir }}</td>
    </tr>
    <tr>
        <td width="1%">4</td>
        <td colspan="5">Pendidikan yang diperhitungkan Angka Kreditnya</td>
        <td colspan="6">{{ $dupak->pendidikan }}</td>
    </tr>
    <tr>
        <td width="1%">5</td>
        <td colspan="5">Pangkat/Golongan Ruang/TMT</td>
        <td colspan="6">{{ $dupak->golonganSekarang->nama.', '.$dupak->tmt_golongan }}</td>
    </tr>
    <tr>
        <td width="1%">6</td>
        <td colspan="5">Jabatan </td>
        <td colspan="6">{{ $dupak->golonganSekarang->jabatan.', '.$dupak->tmt_golongan }}</td>
    </tr>
    <tr>
        <td width="1%" rowspan="2">7</td>
        <td colspan="4" rowspan="2">Masa Kerja Golongan</td>
        <td colspan="1" width="1%">Lama</td>
        <td colspan="6">-</td>
    </tr>
    <tr>
        <td>Baru</td>
        <td colspan="6">-</td>
    </tr>
    <tr>
        <td width="1%">8</td>
        <td colspan="5">Jenis Guru</td>
        <td colspan="6">Guru Mata Pelajaran</td>
    </tr>
    <tr>
        <td width="1%">9</td>
        <td colspan="5">Unit Kerja</td>
        <td colspan="6">{{ $dupak->unitKerja->nama }}</td>
    </tr>
    <tr>
    	<td colspan="12"></td>
    </tr>
    <tr>
    	<th colspan="12">UNSUR YANG DINILAI</th>
    </tr>
    <tr>
        <th width="1%" rowspan="3">NO</th>
        <th colspan="5" rowspan="3">UNSUR, SUB UNSUR DAN BUTIR KEGIATAN</th>
        <th colspan="6">ANGKA KREDIT MENURUT</th>
    </tr>
    <tr>
    	<th colspan="3">INSTANSI PENGUSUL</th>
    	<th colspan="3">TIM PENILAI</th>
    </tr>
    <tr>
    	<th>LAMA</th>
    	<th>BARU</th>
    	<th>JUMLAH</th>
    	<th>LAMA</th>
    	<th>BARU</th>
    	<th>JUMLAH</th>                        	
    </tr>
    <tr>
        <td width="1%" rowspan="10" valign="top">I</td>
        <td colspan="5">UNSUR UTAMA</td>
        <td width="8%"></td>
        <td width="8%"></td>
        <td width="8%"></td>
        <td width="8%"></td>
        <td width="8%"></td>
        <td width="8%"></td>
    </tr>
    @php
    	$alphabet 	= ['a','b','c'];$totalutama = 0;$totalpenunjang = 0;
    @endphp
    @foreach($unsurutama as $item)
    <tr>
    	<td width="1%" valign="top">{{ $loop->iteration }}</td>
    	<td colspan="4">{{ $item->nama }}</td>
    	<td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @foreach($subunsurutama[$loop->index] as $sub)
    <tr>
    	<td></td>
    	<td width="1%">{{ $alphabet[$loop->index] }}</td>
    	<td colspan="3">{{ $sub['nama'] }}</td>
        <td class="number">-</td>
        <td class="number">{{ $sub['nilai'] }}</td>
        <td class="number">{{ $sub['nilai'] }}</td>
        <td class="number"></td>
        <td class="number">
        </td>
        <td class="number"></td>
    </tr>
    @php $totalutama+=$sub['nilai'] @endphp
    @endforeach
    @endforeach
    <tr>
    	<th colspan="5">JUMLAH UNSUR UTAMA</th>
    	<th class="number">-</th>
        <th class="number">{{ $totalutama }}</th>
        <th class="number">{{ $totalutama }}</th>
        <th class="number"></th>
        <th class="number"></th>
        <th class="number"></th>
    </tr>
    <tr>
        <td width="1%" rowspan="4" valign="top">II</td>
        <td colspan="5">UNSUR PENUNJANG</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @foreach($unsurpenunjang as $item)
    <tr>
    	<td width="1%">{{ $loop->iteration }}</td>
    	<td colspan="4">{{ $item['nama'] }}</td>
    	<td class="number">-</td>
        <td class="number">{{ $item['nilai'] }}</td>
        <td class="number">{{ $item['nilai'] }}</td>
        <td class="number"></td>
        <td class="number"></td>
        <td class="number"></td>
    </tr>
    @php $totalpenunjang+=$item['nilai'] @endphp
    @endforeach
    <tr>
    	<th colspan="6">JUMLAH PENUNJANG</th>
    	<th class="number">-</th>
        <th class="number">{{ $totalpenunjang }}</th>
        <th class="number">{{ $totalpenunjang }}</th>
        <th class="number"></th>
        <th class="number"></th>
        <th class="number"></th>
    </tr>
    <tr>
    	<th colspan="6">JUMLAH UNSUR UTAMA DAN UNSUR PENUNJANG</th>
    	<th class="number">{{ $dupak->total_sebelum }}</th>
        <th class="number">{{ $totalutama + $totalpenunjang }}</th>
        <th class="number">{{ $dupak->total_sebelum + $totalutama + $totalpenunjang }}</th>
        <th class="number"></th>
        <th class="number"></th>
        <th class="number"></th>
    </tr>
</table>
</body>
<script type="text/javascript">
    window.print();
</script>
</html>