						<table class="table table-striped">
						  <tr>
						  	<th>ID</th>
						  	<th>Nombre</th>
						  	<th>Email</th>
						  	<th>Tipo</th>
						  	<th>Acciones</th>
						  </tr>

						  @foreach ($users as $user)
						  <tr data-id="{{ $user->id }}">
						  	<td>{{$user->id}}</td>
						  	<td>{{$user->full_name}}</td>
						  	<td>{{$user->email}}</td>
						  	<td>{{$user->type}}</td>
						  	<td>
						  		<a href="{{ route('admin.users.edit', $user) }}">Editar</a> {{-- Podemos pasar el objeto entero $user y laravel 5 coge automáticamente el id. ($user->id)--}}
						  		<a href="" class="btn-delete">Eliminar</a> 
						  	</td>
						  </tr>
						  @endforeach
						</table>