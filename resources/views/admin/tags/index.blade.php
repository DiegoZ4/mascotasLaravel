@extends('admin.template.main')

@section('title', 'Lista de Tags')

@section('body')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Lista de tags</div>
			</div>
			<div class="card-body">
				@include('flash::message')
				<div class="row">
					<div class="col">
    					<a href="{{ route('tags.create') }}" class="btn btn-info mb-3" >Registrar un tags</a><br>
					</div>
				    <div class="col-6"></div>
				    <div class="col">
						<!-- BUSCADOR DE TAGS -->
							{!! Form::open(['route' => 'tags.index', 'method' => 'get', 'class' => 'navbar-form pull-*-left']) !!}
								<div class="form-group">
									<div class="input-group" style="height: 40px">
										{!! Form::text('name', null, ['class'=>'form-control mb-3', 'style'=>'height:40px; padding-bottom:10px', 'placeholder'=>'Buscar Tag...']) !!}
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
				    	<th scope="col">Accion</th>
				  	</tr>
				  </thead>
					<tbody>
						@foreach ($tags as $tag)
							<tr>
								<td>{{ $tag->id }}</td>
								<td>{{ $tag->name }}</td>
								<td>
									<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a>
									<a href="{{ route('tags.destroy', $tag->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar este tag?')"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a>
								</td>
							</tr>
						@endforeach
				  	</tbody>
				</table>
				{{ $tags->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>
@endsection