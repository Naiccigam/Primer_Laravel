{!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'DELETE']) !!} 
		
		<button type="submit" class="btn btn-danger" onclick="return confirm('Seguro que desea eliminar?')">Eliminar usuario</button>
{!! Form::close() !!}
