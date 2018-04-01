@extends('admin.template.main')

@section('title', 'Lista de artículos')

@section('body')
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Lista de artículos</div>
			</div>
			<div class="card-body">
				@include('flash::message')
				<div class="row">
					<div class="col">
    					<a href="{{ route('articles.create') }}" class="btn btn-info mb-3" >Agregar un artículo</a><br>
					</div>
				    <div class="col-6"></div>
				    <div class="col">
						<!-- BUSCADOR DE Articulo -->
							{!! Form::open(['route' => 'articles.index', 'method' => 'get', 'class' => 'navbar-form pull-*-left']) !!}
								<div class="form-group">
									<div class="input-group" style="height: 40px">
										{!! Form::text('title', null, ['class'=>'form-control mb-3', 'style'=>'height:40px; padding-bottom:10px', 'placeholder'=>'Buscar Artículo...']) !!}
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
				      	<th scope="col">Titulo</th>
				      	<th scope="col">Categoria</th>
				      	<th scope="col">Usuario</th>
				    	<th scope="col">Accion</th>
				  	</tr>
				  </thead>
					<tbody>
						@foreach ($articles as $article)
							<tr>
								<td>{{ $article->id }}</td>
								<td>{{ $article->title }}</td>
								<td>{{ $article->category->name }}</td>
								<td>{{ $article->user->name }}</td>
								<td>
									<a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a>
									<a href="{{ route('articles.destroy', $article->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro deseas eliminar este artículo?')"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a>
								</td>
							</tr>
						@endforeach
				  	</tbody>
				</table>
				{{ $articles->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>
	</div>
@endsection