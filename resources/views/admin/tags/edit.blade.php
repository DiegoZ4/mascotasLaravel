@extends('admin.template.main')

@section('title', 'Editar tag '.$tag->name)

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Editar tag {{ $tag->name }}</div>
			</div>
			<div class="card-body">
				@include('admin.template.partials.errors')
				
				{!! Form::open(array('route' => ['tags.update',$tag->id], 'method' => 'put')) !!}﻿
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', $tag->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre del tag']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
@endsection