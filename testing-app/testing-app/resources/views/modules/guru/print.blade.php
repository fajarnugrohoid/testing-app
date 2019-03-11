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
            <td style="width:100%; text-align: center;">BUKTI PENDAFTARAN</td>
        </tr>
        <tr>
            <td style="text-align: center;">PENETAPAN ANGKA KREDIT GURU</td>
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

    <table border="1" style="border-collapse: collapse;margin-top: 15px;" width="100%">
        <tr>
            <th colspan="2" style="text-align: center">LAMPIRAN PENDUKUNG</th>
        </tr>
        <tr>
            <th style="width: 1%;text-align: center;">NO</th>
            <th style="text-align: left;padding-left: 5px;">LAMPIRAN</th>
        </tr>
        <tr><td style="text-align: center;">1</td><td>Surat pengantar dari Sekolah dan Cabang Dinas Pendidikan</td></tr>
        <tr><td style="text-align: center;">2</td><td>Salinan sah SK Pangkat dan Jabatan terakhir</td></tr>
        <tr><td style="text-align: center;">3</td><td>Salinan sah PAK terakhir</td></tr>
        <tr><td style="text-align: center;">4</td><td>Salinan sah PAK penyesuaian</td></tr>
        <tr><td style="text-align: center;">5</td><td>Salinan sah Surat Hasil PAK</td></tr>
        <tr><td style="text-align: center;">6</td><td>Daftar Usulan Penetapan Angka Kredit (DUPAK)</td></tr>
        <tr><td style="text-align: center;">7</td><td>Ijazah terakhir sampai dengan Ijazah terakhir</td></tr>
        <tr><td style="text-align: center;">8</td><td>DP-3/Penilaian Kinerja (SKP), 2 (dua) tahun terakhir sesuai Permenpan 16 Tahun 2009 (bagi guru)</td></tr>
        <tr><td style="text-align: center;">9</td><td>Surat pernyataan telah melaksanakan proses Pembelajaran/Bimbingan</td></tr>
        <tr><td style="text-align: center;">10</td><td>Surat pernyataan telah melaksanakan kegiatan PKB</td></tr>
        <tr><td style="text-align: center;">11</td><td>Surat pernyataan telah melaksanakan kegiatan unsur penunjang</td></tr>
        <tr><td style="text-align: center;">12</td><td>Bukti fisik pelaksanaan unsur utama dan penunjang</td></tr>
        <tr><td style="text-align: center;">13</td><td>Salinan Sertifikat Pendidik</td></tr>
        <tr><td style="text-align: center;">14</td><td>Salinan SK. Alih Kelola</td></tr>
        <tr><td style="text-align: center;">15</td><td>SK pembagian Tugas guru yang ditandatangani Kepala Sekolah</td></tr>
        <tr><td style="text-align: center;">16</td><td>Pengusulan PAK wajib dilengkapi dengan Karya Tulis Ilmiah atau Jurnal yang asli</td></tr>
        <tr><td style="text-align: center;">17</td><td>Foto copy SK Mutasi/Alih Tugas (jika ada)</td></tr>
        <tr><td style="text-align: center;">18</td><td>Surat Tugas/Ijin belajar</td></tr>
    </table>

    <table style="right: 150px;margin-top: 25px;margin-right: 20px;position: absolute;">
        <tr>
            <td style="text-align: center;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ date('Y') }}
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">Pengusul,<br><br><br><br><br><br></td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $dupak->user->biodata->nama }}</td>
        </tr>
        <tr>
            <td style="text-align: center;border-top: 2px solid">NIP. {{ $dupak->user->biodata->nip }}</td>
        </tr>
    </table>
    <div class="pagebreak"></div>
    <h4 style="text-align: center;">DETAIL & REKAP INPUT PENETAPAN PENILAIAN ANGKA KREDIT</h4>
    <table border="1" style="border-collapse: collapse;margin-top: 15px;border: 1px solid #000" width="100%">
        <tr>
            <th colspan="7" style="text-align: center">DETAIL INPUT PENILAIAN ANGKA KREDIT</th>
        </tr>
        <tr>
            <th width="1%" style="text-align: center">UNSUR</th>
            <th width="15%" style="text-align: center">SUB UNSUR</th>
            <th width="20%" style="text-align: center">KATEGORI</th>
            <th width="20%" style="text-align: center">BUTIR KEGIATAN</th>
            <th style="text-align: center">JUDUL</th>
            <th width="1%" style="text-align: center">TAHUN</th>
            <th width="1%" style="text-align: center">NILAI</th>
        </tr>
        @php
            $uutama = 0; $upenunjang = 0; $namaunsur="";$namasubunsur="";$namakategori="";$namakegiatan="";
        @endphp            
        @foreach($detail as $d)
        <tr>
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
        </tr>
            @if($d->angkaKredit->kategori->subUnsur->unsur->kategori == "Unsur Utama") 
                @php $uutama     += $d->nilai_angka_kredit; @endphp
            @else
                @php $upenunjang += $d->nilai_angka_kredit; @endphp                   
            @endif
        @endforeach
    </table>
    <table border="1" style="border-collapse: collapse;margin-top: 15px;" width="100%">
        <tr>
            <th colspan="3">REKAP PENILAIAN HASIL ANGKA KREDIT</th>
        </tr>            
        <tr>
            <th>KATEGORI</th>
            <th>NILAI</th>
            <th>PERSENTASE</th>
        </tr>
        <tr>
            <td>UNSUR UTAMA</td>
            <td class="number">{{ $uutama }}</td>
            <td style="text-align: center">{{ number_format($uutama/($uutama+$upenunjang)*100,2,'.',',') }} %</td>
        </tr>
        <tr>
            <td>UNSUR PENUNJANG</td>
            <td class="number">{{ $upenunjang }}</td>
            <td style="text-align: center">{{ number_format($upenunjang/($uutama+$upenunjang)*100,2,'.',',') }} %</td>
        </tr>
        <tr>
            <td><strong>TOTAL UNSUR UTAMA & PENUNJANG</strong></td>
            <td class="number"><strong>{{ $upenunjang+$uutama }}</strong></td>
            <td style="text-align: center"><strong>{{ number_format(($upenunjang+$uutama)/($uutama+$upenunjang)*100,2,'.',',') }} %</strong></td>
        </tr>
    </table>
</body>
</html>