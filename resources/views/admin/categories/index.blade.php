@extends('admin.template.main')

@section('title', 'Lista de Categorias')

@section('body')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Lista de categorias</div>
			</div>
			<div class="card-body">
				@include('flash::message')
				<a href="{{ route('categories.create') }}" class="btn btn-info mb-3" >Registrar una categorias</a><br>
				<table class="table table-striped">
				  <thead>
				    <tr>
				      	<th scope="col">#</th>
				      	<th scope="col">Nombre</th>
				    	<th scope="col">Accion</th>
				  	</tr>
				  </thead>
					<tbody>
						@foreach ($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>
									<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a>
									<a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar esta categoria?')"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a>
								</td>
							</tr>
						@endforeach
				  	</tbody>
				</table>
				{{ $categories->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>
@endsection