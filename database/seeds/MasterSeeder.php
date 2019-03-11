<?php

use Illuminate\Database\Seeder;

use App\Models\Master\Unsur;
use App\Models\Master\SubUnsur;
use App\Models\Master\Kategori;
use App\Models\Master\AngkaKredit;
use App\Models\Master\Penolakan;
use App\Models\Master\Cadisdik;
use App\Models\Master\Kota;
use App\Models\Master\UnitKerja;

class MasterSeeder extends Seeder
{
    public function run()
    {
		\DB::statement('SET foreign_key_checks = 0;');

		// seeder ref_unsur
		$strfile = file_get_contents(database_path('data/ref_unsur.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_unsur'] as $value) {
			Unsur::create($value);
		}

		// seeder ref_subunsur
		$strfile = file_get_contents(database_path('data/ref_subunsur.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_subunsur'] as $value) {
			SubUnsur::create($value);
		}

		// seeder ref_kategori
		$strfile = file_get_contents(database_path('data/ref_kategori.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_kategori'] as $value) {
			Kategori::create($value);
		}

		// seeder ref_ak
		$strfile = file_get_contents(database_path('data/ref_ak.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_ak'] as $value) {
			AngkaKredit::create($value);
		}

		// seeder ref_tolak
		$strfile = file_get_contents(database_path('data/ref_tolak.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_tolak'] as $value) {
			Penolakan::create($value);
		}

		// seeder ref_penolakan_angkakredit
		$strfile = file_get_contents(database_path('data/ref_at.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_at'] as $value) {
			\DB::table('ref_penolakan_angkakredit')->insert($value);
		}

		// seeder ref_golongan
		$strfile = file_get_contents(database_path('data/ref_golongan.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_golongan'] as $value) {
			\DB::table('ref_golongan')->insert($value);
		}

		// seeder cadisdik & kota
		$data = [
			['nama' => 'Cadisdik 1', 'kota' => ['Kab. Bogor']],
			['nama' => 'Cadisdik 2', 'kota' => ['Kota Bogor', 'Kota Depok']],
			['nama' => 'Cadisdik 3', 'kota' => ['Kab. Bekasi', 'Kota Bekasi']],
			['nama' => 'Cadisdik 4', 'kota' => ['Kab. Karawang', 'Kab. Purwakarta', 'Kab. Subang']],
			['nama' => 'Cadisdik 5', 'kota' => ['Kab. Sukabumi', 'Kota Sukabumi']],
			['nama' => 'Cadisdik 6', 'kota' => ['Kab. Bandung Barat', 'Kab. Cianjur']],
			['nama' => 'Cadisdik 7', 'kota' => ['Kota Bandung', 'Kota Cimahi']],
			['nama' => 'Cadisdik 8', 'kota' => ['Kab. Bandung', 'Kab. Sumedang']],
			['nama' => 'Cadisdik 9', 'kota' => ['Kab. Indramayu', 'Kab. Majalengka']],
			['nama' => 'Cadisdik 10', 'kota' => ['Kab. Kuningan', 'Kab. Cirebon', 'Kota Cirebon']],
			['nama' => 'Cadisdik 11', 'kota' => ['Kab. Garut']],
			['nama' => 'Cadisdik 12', 'kota' => ['Kab. Tasikmalaya', 'Kota Tasikmalaya']],
			['nama' => 'Cadisdik 13', 'kota' => ['Kab. Ciamis', 'Kab. Pangandaran', 'Kota Banjar']],
		];
		foreach ($data as $val) {
			$cadisdik = Cadisdik::create(['nama' => $val['nama']]);
			foreach ($val['kota'] as $kota) {
				$cadisdik->kota()->create(['nama' => $kota]);
			}
		}

		// seeder ref_unit_kerja
		$strfile = file_get_contents(database_path('data/ref_unit_kerja.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_unit_kerja'] as $value) {
			\DB::table('ref_unit_kerja')->insert($value);
		}
    }
}
