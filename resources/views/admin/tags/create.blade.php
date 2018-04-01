@extends('admin.template.main')

@section('title', 'Crear un tag')

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Crear un tag</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => 'tags.store', 'method' => 'POST', 'files' => true]) !!}
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre Completo']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection