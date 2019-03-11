<?php

use Illuminate\Database\Seeder;

use App\Models\Authentication\User;
use App\Models\Authentication\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
		$admin       = Role::where('name', 'admin')->first();
		$guru        = Role::where('name', 'guru')->first();
		$cabdin      = Role::where('name', 'cabdin')->first();
		$sekretariat = Role::where('name', 'sekretariat')->first();
		$penilai     = Role::where('name', 'penilai')->first();

		// create user admin
		$user = new User();
		$user->username = 'admin';
		$user->nama = 'Admin';
		$user->password = bcrypt('password');
		$user->last_login = date('Y-m-d H:i:s');
    	$user->save();
    	// set role
    	$user->roles()->attach($admin);


    	// create user guru
		$user = new User();
		$user->username = 'guru';
		$user->nama = 'Guru';
		$user->password = bcrypt('password');
		$user->last_login = date('Y-m-d H:i:s');
    	$user->save();
    	// set role
    	$user->roles()->attach($guru);


    	// create user cabdin
		$user = new User();
		$user->username = 'cabdin';
		$user->nama = 'Cabang Dinas';
		$user->cabang_dinas_id = 7;
		$user->password = bcrypt('password');
		$user->last_login = date('Y-m-d H:i:s');
    	$user->save();
    	// set role
    	$user->roles()->attach($cabdin);


    	// create user sekretariat
		$user = new User();
		$user->username = 'sekretariat';
		$user->nama = 'Sekretariat';
		$user->password = bcrypt('password');
		$user->last_login = date('Y-m-d H:i:s');
    	$user->save();
    	// set role
    	$user->roles()->attach($sekretariat);


    	// create user penilai
		$user = new User();
		$user->username = 'penilai';
		$user->nama = 'Penilai';
		$user->password = bcrypt('password');
		$user->last_login = date('Y-m-d H:i:s');
    	$user->save();
    	// set role
    	$user->roles()->attach($penilai);
    }
}
