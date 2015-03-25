<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

	/*No necesitamos poner
		protected $table = 'user_profiles';
	  porque Laravel automáticamente intenta transformar "UserProfile" a "user_profiles" y enlazarlo a una tabla.
	*/
	public function getAgeAttribute() //$this->age
	{
		return \Carbon\Carbon::parse($this->birthdate)->age;
	}

}
