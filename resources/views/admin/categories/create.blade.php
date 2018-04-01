@extends('admin.template.main')

@section('title', 'Crear un categoria')

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Crear una categoria</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'files' => true]) !!}
			
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