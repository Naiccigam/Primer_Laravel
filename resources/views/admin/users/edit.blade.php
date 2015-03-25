@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"> Editar usuario: {{$user->first_name}}</div>
				
				@if(Session::has('message'))
					<p class='alert alert-success'>{{ Session::get('message') }}</p>
				@endif

					<div class="panel-body">

						@include('admin.partials.messages')
						
						{!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!} {{-- Form::model es nuevo de laravel 5 y es un método para atar un modelo a un formulario, en este caso $user. en 'route' pasamos un array donde el primer parámetro es la ruta y el resto de parámetros son los parámetros que pasamos, en este caso el objeto $user, de donde laravel cogerá $user->id --}}
							  @include('admin.users.partials.fields')
							  <button type="submit" class="btn btn-default">Actualizar usuario</button>
						{!! Form::close() !!}
						
					</div>
			</div>
			@include('admin.users.partials.delete')
		</div>
	</div>
</div>
@endsection
