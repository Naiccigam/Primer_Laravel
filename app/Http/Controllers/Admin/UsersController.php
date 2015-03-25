<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;



/*Clases añadidas por nosotros*/
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller {


	public function __construct()
	{
		$this->beforeFilter('@findUser',['only'=> ['show','edit','update','destroy'] ]); //Cada vez que llame al método show, edit, update o destroy, llamará al método findUser
	}


	public function findUser(Route $route) //Busca el usuario con el id que le pasamos por parámetro y lo guarda en el objeto $this->user para usarlo en el resto de métodos.
	{
		$this->user = User::findOrFail($route->getParameter('users'));
		//$this->user = User::where('username', $route->getParameter('users'))->firstOrFail(); Para que busque un usuario en función del nombre de usuario y no del ID.
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{


		$users = User::name($request->get('name'))->orderBy('id','DESC')->paginate();
		
		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request) //Validación --Modo 3-- CreateUserRequest
	{

		$user = User::create($request->all()); //Esto también hace el $user->save();
		return redirect()->route('admin.users.index');

		//Validación--Modo 2--
		//$this->validate($request, $rules); //Esto hace ya lacomprobación de si falla la validación y demás.

	

	/*Validación---Modo 1---


		$v = Validator::make($data, $rules);

		if( $v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput(Request::except('password'));
		}
	*/
	
/*		Equivalente a:
			$user = new User($request->all());
	
		Equivalente a:
			$user = new User();
			$user->fill($request->all());

		$user->save();
*/
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return view('admin.users.edit')->with('user', $this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EditUserRequest $request)
	{
		
		$this->user->fill($request->all());
		$this->user->save();

		Session::flash('message', 'Usuario actualizado con éxito.');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{	

		$this->user->delete(); //Borra de la DB el usuario pero aún tenemos disponible el objeto para poder mostrar mensajes después. por ejemplo
		//User::destroy($id);
	
		$message = $this->user->full_name .' fue eliminado.';

		if ($request->ajax())
		{
			return response()->json([
				'id'	  => $this->user->id,
				'message' => $message
			]);
		}


		Session::flash('message', $message);

		return redirect()->route('admin.users.index');
	}

}
