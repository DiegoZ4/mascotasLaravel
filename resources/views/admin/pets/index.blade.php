@extends('admin.template.main')

@section('title', 'Lista de mascotas')

@section('body')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Lista de Mascotas</div>
			</div>
			<div class="card-body">
				@include('flash::message')
				<div class="row">
					<div class="col">
    					<a href="{{ route('pets.create') }}" class="btn btn-info mb-3" >Agregar una mascota</a><br>
					</div>
				    <div class="col-6"></div>
				    <div class="col">
						<!-- BUSCADOR DE Articulo -->
							{!! Form::open(['route' => 'pets.index', 'method' => 'get', 'class' => 'navbar-form pull-*-left']) !!}
								<div class="form-group">
									<div class="input-group" style="height: 40px">
										{!! Form::text('name', null, ['class'=>'form-control mb-3', 'style'=>'height:40px; padding-bottom:10px', 'placeholder'=>'Buscar Mascota...']) !!}
										<div class="input-group-btn">
							        		<button class="btn btn-default" type="submit"><i class="material-icons">search</i></button>
							      		</div>
							      	</div>
								</div>

							{!! Form::close() !!}
						<!-- FIN DEL BUSCADOR -->


					</div>
				</div>	
				<table class="table table-striped">
				  <thead>
				    <tr>
				      	<th scope="col">#</th>
				      	<th scope="col">Nombre</th>
				      	<th scope="col">Raza</th>
				      	<th scope="col">Dueño</th>
				    	<th scope="col">Accion</th>
				  	</tr>
				  </thead>
					<tbody>
						@foreach ($pets as $pet)
							<tr>
								<td>{{ $pet->id }}</td>
								<td>{{ $pet->name }}</td>
								<td>{{ $pet->rase }}</td>
								<td>{{ $pet->user->name }}</td>
								<td>
									<a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-warning"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a>
									<a href="{{ route('pets.destroy', $pet->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar este artículo?')"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a>
								</td>
							</tr>
						@endforeach
				  	</tbody>
				</table>
				{{ $pets->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>
@endsection