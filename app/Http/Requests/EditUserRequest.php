<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditUserRequest extends Request {

	public function __construct(Route $route)
	{
		$this->route = $route;
	}


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
			'email' => 'required|unique:users,email,' .$this->route->getParameter('users'), //Comprueba que el email es requerido y que es único en la tabla users en la columna email excepto en la fila del ID que le pasamos.
			'password' => '',
			'type' => 'required|in:user,admin' //in: permite que sólo puedan ser esos valores. Así evitamos que puedan usar el inspeccionador de elementos para modificarlo
		];
	}

}
