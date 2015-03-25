<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder{
	
	public function run()
	{
		\DB::table('users')->insert(array(
			'first_name'=> 'Alejandro',
			'last_name'	=> 'García Gallego',
			'email' 	=> 'gargalale@gmail.com',
			'password' 	=> \Hash::make('secret'), //Encriptamos la clave
			'type' 		=> 'admin',
			'full_name' => 'Alejandro García Gallego'
			 ));

		\DB::table('user_profiles')->insert(array(
			'user_id'=>1,
			'birthdate' => '1991/03/10'
		));
	}



}