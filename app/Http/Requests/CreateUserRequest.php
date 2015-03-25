<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|unique:users,email', //Comprueba que el email es requerido y que es único en la tabla users en la columna email.
			'password' => 'required',
			'type' => 'required|in:user,admin'
		];
	}

}
