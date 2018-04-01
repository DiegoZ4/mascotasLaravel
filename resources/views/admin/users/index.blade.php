@extends('admin.template.main')

@section('title', 'Lista de Usuarios')

@section('body')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Lista de usuarios</div>
			</div>
			<div class="card-body">
				@include('flash::message')
				<a href="{{ route('users.create') }}" class="btn btn-info mb-3" >Registrar un usuario</a><br>
				<table class="table table-striped">
				  <thead>
				    <tr>
				      	<th scope="col">#</th>
				      	<th scope="col">Nombre</th>
				      	<th scope="col">Email</th>
				      	<th scope="col">Tipo de usuario</th>
				    	<th scope="col">Accion</th>
				  	</tr>
				  </thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									@if($user->type == 'admin')
										<span class="badge badge-danger"> {{ $user->type }}</span>
									@else
										<span class="badge badge-primary"> {{ $user->type }}</span>
									@endif
								</td>
								<td>
									<a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a>
									<a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar este usuario?')"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a>
								</td>
							</tr>
						@endforeach
				  	</tbody>
				</table>
				{{ $users->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>
@endsection