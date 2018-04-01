@extends('admin.template.main')

@section('title', 'Editar un artículo - '.$article->id)

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Editar un artículo - {{ $article->title }}</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => ['articles.update', $article], 'method' => 'PUT', 'files' => true]) !!}
			
					<div class="form-group">
						{!! Form::label('title', 'Título') !!}
						{!! Form::text('title', $article->title, ['class' => 'form-control', 'required', 'placeholder' => 'Título del artículo...']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('desc', 'Descripción') !!}
						{!! Form::text('desc', $article->desc, ['class' => 'form-control', 'required', 'placeholder' => 'Descripción del artículo...']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('volanta', 'Volanta') !!}
						{!! Form::text('volanta', $article->volanta, ['class' => 'form-control', 'required', 'placeholder' => 'Volanta del artículo...']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('category_id', 'Categoria') !!}
						{!! Form::select('category_id', $categories, $article->category_id, ['class' => 'form-control select-category', 'data-placeholder'=>'Selecciona una categoría', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('content', 'Contenido') !!}
						{!! Form::textarea('content', $article->content, ['class' => 'form-control trumbowyg', 'required', 'placeholder' => 'Escribe tu contenido aquí', 'rows'=>'5']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('tags', 'Tags') !!}
						{!! Form::select('tags[]', $tags, $article->tags, ['multiple', 'required', 'class' => 'form-control select-tag', 'tags'=>'id', 'data-placeholder'=>'Elije un máximo de 3 tags']) !!}﻿
					</div>

					<div class="form-group">
						{!! Form::label('image','Imagén') !!}
						{!! Form::file('image') !!}
						<img src="/images/articles/{{ $article->images->last()->name }}" width="300"/>
					</div>

					<div class="form-group">
						{!! Form::label('public', 'Publicado') !!}
						{!! Form::checkbox('public', '1', $article->public, ['class' => 'form-check-input', 'style'=>'margin-top:0.45rem;margin-left:0.45rem']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
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