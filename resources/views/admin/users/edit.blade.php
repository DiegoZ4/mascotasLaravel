@extends('admin.template.main')

@section('title', 'Editar un usuario '.$user->name)

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Editar usuario {{ $user->name }}</div>
			</div>
			<div class="card-body">
				{!! Form::open(array('route' => ['users.update',$user->id], 'method' => 'put')) !!}﻿
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', $user->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre Completo']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('email', 'Email') !!}
						{!! Form::email('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => 'usuario@mail.com']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type', 'Tipo') !!}
						{!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], $user->type, ['placeholder' => 'Selecciona Nivel...', 'class' => 'form-control']) !!}﻿
					</div>

					<div class="form-group">
						{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection