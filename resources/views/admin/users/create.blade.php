@extends('admin.template.main')

@section('title', 'Crear un usuario')

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Crear un usuario</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => 'users.store', 'method' => 'POST', 'files' => true]) !!}
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre Completo']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('email', 'Email') !!}
						{!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'usuario@mail.com']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('password', 'Contraseña') !!}
						{!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => 'usuario@mail.com']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type', 'Tipo') !!}
						{!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], null, ['placeholder' => 'Selecciona Nivel...', 'required', 'class' => 'form-control']) !!}﻿
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection