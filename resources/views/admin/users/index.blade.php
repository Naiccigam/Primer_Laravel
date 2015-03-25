@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Usuarios</div>

				@if(Session::has('message'))
					<p class='alert alert-success'>{{ Session::get('message') }}</p>
				@endif

					<div class="panel-body">
						{!! Form::open(['route' => 'admin.users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role'=> 'search' ]) !!}
						  <div class="form-group">
						  	{!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Nombre de usuario']) !!}
						  </div>
						  <button type="submit" class="btn btn-default">Buscar</button>

						{!! Form::close() !!}

						<p>
							<a class="btn btn-info" href="{{ route('admin.users.create') }}" role="button">Crear usuario</a>
						</p>
						<p>Hay {{ $users->total()}} usuarios en total.</p>
						@include('admin.users.partials.table')
						{!! $users->render() !!}
					</div>
			</div>
		</div>
	</div>
</div>
{{--Formulario oculto--}}
{!! Form::open(['route' => ['admin.users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id'=>'form-delete']) !!} {{--:USER_ID es un placeholder que nos permitirá ir cambiando el valor mediante JS--}}		
{!! Form::close() !!}
@endsection





@section('scripts')
<script>
	$(document).ready(function(){

		$('.btn-delete').click(function (e) {

			e.preventDefault();//Evento que evita que el navegador envíe la acción del enlace.

			var row = $(this).parents('tr'); //Almacenamos la fila <tr> padre del elemento botón eliminar.
			var id = row.data('id'); //Almacenamos el id de la fila que le dimos en data-id.
			var form = $('#form-delete');
			var url = form.attr('action').replace(':USER_ID', id); //Reemplazamos el placeholder del formulario por el id del usuario de la fila.
			var data = form.serialize();


			$.post(url,data, function(result){ //Enviamos la petición con ajax, cuyos parámetros son primero la url, segundo los datos, y por último un callback en caso de que el método tenga éxito y pueda ser procesador por el servidor.
				alert(result.message);
				row.fadeOut(); //Ocultamos la fila tras eliminarla.
			}).fail(function(){
				alert('El usuario no fue eliminado');
			});

		});
	});
</script>

@endsection