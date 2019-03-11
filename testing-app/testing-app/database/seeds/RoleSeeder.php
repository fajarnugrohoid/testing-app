<?php

use Illuminate\Database\Seeder;
use App\Models\Authentication\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create([
    		'name' => 'admin',
			'display_name' => 'Administrator',
			'description' => 'User Administrator',
    	]);

    	Role::create([
    		'name' => 'guru',
			'display_name' => 'Guru',
			'description' => 'User Guru',
    	]);

    	Role::create([
    		'name' => 'cabdin',
			'display_name' => 'Cabang Dinas',
			'description' => 'User Cabang Dinas',
    	]);

    	Role::create([
    		'name' => 'sekretariat',
			'display_name' => 'Sekretariat',
			'description' => 'User Sekretariat',
    	]);

    	Role::create([
    		'name' => 'penilai',
			'display_name' => 'Penilai',
			'description' => 'User Penilai',
    	]);
    }
}
