<?php namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller {


	public function getOrm()
	{
		$users = User::select('id','first_name')
				->with('profile') //Equivalente a un join pero empleando el método que hicimos profile() de hasOne
				->where('first_name','<>','Tortu')
				->orderby('first_name','asc')
				->get();

		dd($users->toArray());
	}

	public function getIndex()
	{
		$result = \DB::table('users')
				->select(
					'users.*',
					'user_profiles.id as profile_id',
					'user_profiles.twitter',
					'user_profiles.birthdate'
					)
				->orderby('id', 'asc')
				->leftjoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
				->get();


		foreach ($result as $row) 
		{
			$row->full_name = $row->first_name . ' ' . $row->last_name;
			$row->age = \Carbon\Carbon::parse($row->birthdate)->age;
		}


		dd($result);

		return $result;
	}

}
