<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name','last_name', 'email', 'password','type'];/*Para enviar datos "en masa" de un formulario a la DB*/

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function profile()
	{
		return $this->hasOne('App\UserProfile');
	}

	public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}


	public function setPasswordAttribute($value)
	{
		if( !empty($value)) //Si el password no está vacío que lo encripte, y si no que no haga nada para evitar que al modificar un usuario modifique la pass en blanco.
		{
			$this->attributes['password'] = \Hash::make($value); /*Encriptamos la password SIEMPRE que desde cualquier lado se cambien/cree la pass de un usuario*/			
		}

	}

	public function scopeName($query, $name)
	{
		if(trim($name) != "")
 		{
 			$query->where('full_name',"LIKE", "%$name%");
 		}
	}

	public function save(array $options = array()) //Sobreescribimos el método save() para que cada vez que se guarde/actualize un usuario rellenar "a mano" la columna full_name
	{
		$this->full_name = $this->first_name." ".$this->last_name;
		parent::save();
	}

}
