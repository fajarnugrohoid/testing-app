<?php

use Illuminate\Database\Seeder;

use App\Models\Master\Dapodik;

class DapodikSeeder extends Seeder
{
    public function run()
    {
		\DB::statement('SET foreign_key_checks = 0;');

		// seeder ref_dapodik
		$strfile = file_get_contents(database_path('data/ref_dapodik.json'));
		$json    = json_decode($strfile, true);
		foreach ($json['ref_dapodik'] as $value) {
			Dapodik::create($value);
		}
    }
}
