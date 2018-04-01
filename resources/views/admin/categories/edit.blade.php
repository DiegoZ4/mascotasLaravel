@extends('admin.template.main')

@section('title', 'Editar categoria '.$category->name)

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Editar categoria {{ $category->name }}</div>
			</div>
			<div class="card-body">
				@include('admin.template.partials.errors')
				
				{!! Form::open(array('route' => ['categories.update',$category->id], 'method' => 'put')) !!}﻿
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', $category->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre de la categoria']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection