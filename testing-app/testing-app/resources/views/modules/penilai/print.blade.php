<!DOCTYPE html>
<html>
<head>
    <title>BUKTI PENDAFTARAN - {{ $dupak->user->biodata->nip }}</title>
<style type="text/css">
    table{
        font-size: 70%;
    }
    td{
        padding-left: 5px;
    }
    th{
        text-align: center;
    }
    .number{
        text-align: right;
        padding-right: 5px;
    }
    .header{
        font-size: 100%;
    }
    .pagebreak { page-break-before: always; }
</style>
</head>
<body>
    <img src="{{ public_path('images/logo_jabar.png') }}" width="80px;" style="position: absolute;margin-top:10px;margin-left:20px;">
    <table style="text-align: center;width: 100%" >
        <tr>
            <td>
                <h3>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h3>
                <h2 style="margin-top: -15px;">DINAS PENDIDIKAN</h2>
                <p style="margin-top: -10px;">Jalan Dr. Radjiman No. 6 Telp. (022) 4264813 Fax. (022) 4264881</p>
                <p style="margin-top: -10px;">Wesselbord (022) 4264944, 4264957, 4264973</p>
                <p style="margin-top: -10px;">BANDUNG (40171)</p>
            </td>        
        </tr>
    </table>

    <hr style="margin-top: 0px;border-top: 3px double #000;">

    <table class="header" style="font-weight: bold;width: 100%">
        <tr>
            <td style="width:100%; text-align: center;">DETAIL & REKAP</td>
        </tr>
        <tr>
            <td style="text-align: center;"> INPUT PENETAPAN PENILAIAN ANGKA KREDIT</td>
        </tr>
    </table>
    
    <table border="1" style="border-collapse: collapse;margin-top: 15px;" width="100%">
        <tr>
            <th style="width: 5%;">NO</th>
            <th colspan="2" style="text-align: center;">KETERANGAN PERSEORANGAN</th>
        </tr>
        <tr>
            <td style="text-align: center;">1</td>
            <td>Nama</td>
            <td>{{ $dupak->user->biodata->nama }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">2</td>
            <td>NIP</td>
            <td>{{ $dupak->user->biodata->nip }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">3</td>
            <td>Tempat Tanggal Lahir</td>
            <td>{{ $dupak->user->biodata->tmp_lahir.','.$dupak->user->biodata->tgl_lahir }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">4</td>
            <td>Pendidikan yang diperhitungkan Angka Kreditnya</td>
            <td>{{ $dupak->pendidikan }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">5</td>
            <td>Golongan/Pangkat Saat Ini</td>
            <td>{{ $dupak->golonganSekarang->nama.' / '.$dupak->golonganSekarang->pangkat }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">6</td>
            <td>Golongan/Pangkat yang Diajukan</td>
            <td>{{ $dupak->golonganUsulan->nama.' / '.$dupak->golonganUsulan->pangkat }}</td>
        </tr>
        <tr>
            <td width="1%" style="text-align: center;">7</td>
            <td>Unit Kerja</td>
            <td>{{ $dupak->unitKerja->nama }}</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;margin-top: 15px;border: 1px solid #000" width="100%">
        <tr>
            <th colspan="8" style="text-align: center">DETAIL INPUT PENILAIAN ANGKA KREDIT</th>
        </tr>
        <tr>
            <th width="1%" style="text-align: center">UNSUR</th>
            <th width="15%" style="text-align: center">SUB UNSUR</th>
            <th width="20%" style="text-align: center">KATEGORI</th>
            <th width="20%" style="text-align: center">BUTIR KEGIATAN</th>
            <th style="text-align: center">JUDUL</th>
            <th width="1%" style="text-align: center">TAHUN</th>
            <th width="1%" style="text-align: center">PENGUSUL</th>
            <th width="1%" style="text-align: center">PENILAI</th>
        </tr>
        @php
            $pengusulUtama = 0; $pengusulPenunjang = 0; 
            $penilaiUtama = 0; $penilaiPenunjang = 0; 
            $namaunsur="";$namasubunsur="";$namakategori="";$namakegiatan="";
        @endphp            
        @foreach($detail as $d)
        @if($d->status == 0)
        <tr style="background-color: #fbbd08;">
        @elseif($d->status == 1)
        <tr>
        @else
        <tr style="background-color: #db2828;">
        @endif
            @if($namaunsur != $d->angkaKredit->kategori->subUnsur->unsur->kategori)
                <td style="border-bottom: none">
                    {{ $d->angkaKredit->kategori->subUnsur->unsur->kategori }}
                </td>
                    @else
                <td style="border-top: none;border-bottom: none"></td>
            @endif
            @php $namaunsur = $d->angkaKredit->kategori->subUnsur->unsur->kategori @endphp

            @if($namasubunsur != $d->angkaKredit->kategori->subUnsur->unsur->nama)
                <td style="border-bottom: none">
                    {{ $d->angkaKredit->kategori->subUnsur->unsur->nama }}
                </td>
                    @else
                <td style="border-top: none;border-bottom: none"></td>
            @endif
            @php $namasubunsur = $d->angkaKredit->kategori->subUnsur->unsur->nama @endphp

            @if($namakategori != $d->angkaKredit->kategori->subUnsur->nama)
                <td style="border-bottom: none">
                    {{ $d->angkaKredit->kategori->subUnsur->nama }}
                </td>
                    @else
                <td style="border-top: none;border-bottom: none"></td>
            @endif
            @php $namakategori = $d->angkaKredit->kategori->subUnsur->nama @endphp

            @if($namakegiatan != $d->angkaKredit->kategori->nama)
                <td style="border-bottom: none">
                    {{ $d->angkaKredit->kategori->nama }}
                </td>
                    @else
                <td style="border-top: none;border-bottom: none"></td>
            @endif
            @php $namakegiatan = $d->angkaKredit->kategori->nama @endphp

            <td>{{ $d->deskripsi }}</td>
            <td style="text-align: center">{{ $d->tahun }}</td>
            <td class="number">{{ $d->nilai_angka_kredit }}</td>
            <td class="number">
                @if($d->status == 1)
                {{ $d->nilai_angka_kredit }}
                @else
                0
                @endif
            </td>
        </tr>
            @if($d->angkaKredit->kategori->subUnsur->unsur->kategori == "Unsur Utama") 
                @php 
                    $pengusulUtama     += $d->nilai_angka_kredit;
                    if($d->status == 1) $penilaiUtama     += $d->nilai_angka_kredit;
                @endphp
            @else
                @php 
                    $pengusulPenunjang     += $d->nilai_angka_kredit; 
                    if($d->status == 1) $penilaiPenunjang     += $d->nilai_angka_kredit;
                @endphp                   
            @endif
        @endforeach
    </table>
    <table border="1" style="border-collapse: collapse;margin-top: 15px;" width="100%">
        <tr>
            <th colspan="5">REKAP PENILAIAN HASIL ANGKA KREDIT</th>
        </tr>            
        <tr>
            <th rowspan="2">KATEGORI</th>
            <th colspan="2">PENGUSUL</th>
            <th colspan="2">PENILAI</th>
        </tr>
        <tr>
            <th>NILAI</th>
            <th>PRESENTASE</th>
            <th>NILAI</th>
            <th>PRESENTASE</th>
        </tr>
        <tr>
            <td>UNSUR UTAMA</td>
            <td class="number">{{ $pengusulUtama }}</td>
            <td style="text-align: center">{{ number_format($pengusulUtama/($pengusulUtama+$pengusulPenunjang)*100,2,'.',',') }} %</td>
            <td class="number">{{ $penilaiUtama }}</td>
            <td style="text-align: center">
                @if($penilaiUtama+$penilaiPenunjang != 0)
                {{ number_format($penilaiUtama/($penilaiUtama+$penilaiPenunjang)*100,2,'.',',') }} %
                @else
                0 %
                @endif
            </td>
        </tr>
        <tr>
            <td>UNSUR PENUNJANG</td>
            <td class="number">{{ $pengusulPenunjang }}</td>
            <td style="text-align: center">{{ number_format($pengusulPenunjang/($pengusulUtama+$pengusulPenunjang)*100,2,'.',',') }} %</td>
            <td class="number">{{ $penilaiPenunjang }}</td>
            <td style="text-align: center">
                @if($penilaiUtama+$penilaiPenunjang != 0)                
                {{ number_format($penilaiPenunjang/($penilaiUtama+$penilaiPenunjang)*100,2,'.',',') }} %
                @else
                0 %
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>TOTAL UNSUR UTAMA & PENUNJANG</strong></td>
            <td class="number"><strong>{{ $pengusulUtama+$pengusulPenunjang }}</strong></td>
            <td style="text-align: center"><strong>{{ number_format(($pengusulUtama+$pengusulPenunjang)/($pengusulUtama+$pengusulPenunjang)*100,2,'.',',') }} %</strong></td>
            <td class="number"><strong>{{ $penilaiUtama+$penilaiPenunjang }}</strong></td>
            <td style="text-align: center"><strong>
                @if($penilaiUtama+$penilaiPenunjang != 0)                
                {{ number_format(($penilaiUtama+$penilaiPenunjang)/($penilaiUtama+$penilaiPenunjang)*100,2,'.',',') }} %
                @else
                0 %
                @endif
            </strong></td>
        </tr>
    </table>
</body>
</html>