@extends('admin.template.main')

@section('name', 'Crear una mascota')

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Crear una mascota</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => 'pets.store', 'method' => 'POST', 'files' => true]) !!}
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('rase', 'Raza') !!}
						{!! Form::text('rase', null, ['class' => 'form-control', 'required', 'placeholder' => 'Raza']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type', 'Tipo') !!}
						{!! Form::select('type', ['perro' => 'Perro', 'gato' => 'Gato'], null, ['placeholder' => 'Selecciona Nivel...', 'required', 'class' => 'form-control']) !!}﻿
					</div>

					<div class="form-group">
						{!! Form::label('user_id', 'Dueño') !!}
						{!! Form::select('user_id', $users, null, ['class' => 'form-control select-category', 'data-placeholder'=>'Selecciona un dueño', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('image','Imagén') !!}
						{!! Form::file('image') !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection

@section('js')
	<script>
		$(document).ready(function(){
			$('.select-tag').chosen({
				max_selected_options: 3,
				no_results_text: "No se encontró:"
			});

			$('.select-category').chosen({
				no_results_text: "No se encontró:"
			});

			$('.trumbowyg').trumbowyg();
		});
	</script>
@endsection