@extends('admin.template.main')

@section('name', 'Editar una mascota')

@section('body')
	
	<div class="container">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Editar una mascota</div>
			</div>
			<div class="card-body">

				@include('admin.template.partials.errors')

				{!! Form::open(['route' => ['pets.update', $pet], 'method' => 'PUT', 'files' => true]) !!}
			
					<div class="form-group">
						{!! Form::label('name', 'Nombre') !!}
						{!! Form::text('name', $pet->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('rase', 'Raza') !!}
						{!! Form::text('rase', $pet->rase, ['class' => 'form-control', 'required', 'placeholder' => 'Raza']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type', 'Tipo') !!}
						{!! Form::select('type', ['perro' => 'Perro', 'gato' => 'Gato'], $pet->type, ['placeholder' => 'Selecciona Nivel...', 'required', 'class' => 'form-control']) !!}﻿
					</div>

					<div class="form-group">
						{!! Form::label('user_id', 'Dueño') !!}
						{!! Form::select('user_id', $users, $pet->user_id, ['class' => 'form-control select-category', 'data-placeholder'=>'Selecciona un dueño', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('image','Imagén') !!}
						{!! Form::file('image') !!}
						<img src="/images/pets/{{ $pet->imagesPets->last()->name }}" width="300"/>
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
					</div>

				{!! Form::close() !!}
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<div class="card-title">Visitas al veterinario de {{ $pet->name }}</div>
			</div>
			<div class="card-body">
				<table class="table table-striped">
				 	<thead  class="thead-default">
					    <tr>
					      <th>#</th>
					      <th>Clinica</th>
					      <th>Doctor</th>
					      <th>Acciones</th>
					    </tr>
				  	</thead>
					<tbody id="listVisits"></tbody>
				</table>
				
				<p>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="newForm">
  						<i class="material-icons" style="color:white; font-size: 16px">add_circle</i> Agregrar una visita 
					</button>
				</p>
				
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					    <div class="modal-content">
					    <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					    </div>
					    <div class="modal-body">
							<form>
								<div class="form-group">
									<label for="v_clinic">Clínica</label>
									<input class="form-control" required="" placeholder="Nombre de la Clinica" name="v_clinic" type="text" id="v_clinic">
								</div>

								<div class="form-group">
									<label for="v_date">Fecha</label>
									<input class="form-control" required="" placeholder="Ingrese la fecha de atención" name="v_date" type="text" id="v_date">
								</div>

								<div class="form-group">
									<label for="v_doctor">Doctor</label>
									<input class="form-control" required="" placeholder="Ingrese el nombre del doctor que atendió" name="v_doctor" type="text" id="v_doctor">
								</div>

								<div class="form-group">
									<label for="v_diagnostic">Diagnóstico</label>
									<textarea class="form-control" required="" placeholder="Escriba el diagnóstico" name="v_diagnostic" rows="5" type="text" id="v_diagnostic" rows="5"></textarea>
								</div>

								<div class="form-group">
									<label for="v_recipe">Receta</label>
									<textarea class="form-control" required="" placeholder="Escriba el tratamiento" name="v_recipe" rows="5" type="text" id="v_recipe" rows="5"></textarea>
								</div>
								<input type="hidden" id="v_pet" name="v_pet">
							</form>
						</div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					        <button type="button" class="btn btn-primary" id="saveForm">Guardar</button>
					    </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@section('js')
	<script>
		function cathData(idVisit){
						/*LEER JSON*/
			$.getJSON('/admin/visits/'+idVisit, function(visitas){
						    
				//mostramos la lista de visitas
			    $.each(visitas, function(posicion, visita){
			        console.log(visita);
					$('#v_clinic').val(visita.clinica);
					$('#v_doctor').val(visita.doctor);
					$('#v_date').val(visita.fecha);
					$('#v_recipe').val(visita.receta);
					$('#v_diagnostic').val(visita.diganostico);
					$('#v_pet').val(visita.pet_id);
				});
			});
		}

		function cathDataShow(idVisit){
			/*LEER JSON y traer los datos*/
			$.getJSON('/admin/visits/'+idVisit+'/show', function(visitas){
						    
				//mostramos la lista de visitas
			    $.each(visitas, function(posicion, visita){
			        console.log(visita);
					$('#v_clinic').val(visita.clinica);
					$('#v_doctor').val(visita.doctor);
					$('#v_date').val(visita.fecha);
					$('#v_recipe').val(visita.receta);
					$('#v_diagnostic').val(visita.diganostico);
					//Asignar el id al campo hidden para pasar el parametro del id
					$('#v_pet').val(visita.id);
				});
			});
		}

		
			
		
		
		$(document).ready(function(){
			$('.select-tag').chosen({
				max_selected_options: 3,
				no_results_text: "No se encontró:"
			});

			$('.select-category').chosen({
				no_results_text: "No se encontró:"
			});

			$('.trumbowyg').trumbowyg();

			$.datepicker.regional['es'] = {
			 closeText: 'Cerrar',
			 prevText: '< Ant',
			 nextText: 'Sig >',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			 weekHeader: 'Sm',
			 dateFormat: 'yy-mm-dd ',
			 firstDay: 1,
			 isRTL: false,
			 showMonthAfterYear: false,
			 yearSuffix: ''
			 };
			 $.datepicker.setDefaults($.datepicker.regional['es']);

			$( "#v_date" ).datepicker();

			

			/*LEER JSON*/
			$.getJSON('/admin/visits/{{ $pet->id }}', function(visitas){
				    
					$.each(visitas, function(posicion, visita){
				        console.log(visita.clinica);
						$('#listVisits').append('<tr><td scope="row">'+visita.id+'</td><td class="clinica'+visita.id+'">'+visita.clinica+'</td><td class="doctor'+visita.id+'">'+visita.doctor+'</td><td><a href="" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" onclick="cathDataShow('+visita.id+')" id="editForm"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a><button data-delete="'+visita.id+'" class="btn btn-danger btn-delete"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></button></td></tr>');
					});

					//BORRAR VISITA
					$('.btn-delete').click(function(){
						var visitDelete = $(this).attr('data-delete');
						var r = confirm("¿Está seguro que quiere eliminar esta visita?");
					    var item = $(this).parent().parent();
					    
					    if (r == true) {

					       	$.ajax({
							    url: '/admin/visits/'+visitDelete,
							    type: 'DELETE',
							    success: function(data) {
							        if(data!="0") {
										console.log("delete ok");
										
										//borrar visita de la fila
										item.remove();
									}else {
										console.log("hubo un error por puto y por cagon");
									}
								}
							});
							console.log(visitDelete) ;
					    } else {
					        console.log("no hace nada");
					    }
					});
			});

			/*/*ENVIAR EL FORMULARIO*******/
			$('#newForm').click(function(){
				$('#v_pet').val(0);
			})

			//Si el input hidden es 0... es un nuevo ingreso
			$('#exampleModal').on('shown.bs.modal', function () {
				
				
			});




			//GRABAR FORMULARIO
			$('#saveForm').click(function(){

				//tomar valores del form y guardarlos en las variables
				var update = $('#v_pet').val();
				var doctor = $('#v_doctor').val();
				var fecha = $('#v_date').val();
				var clinica = $('#v_clinic').val();
				var diganostico = $('#v_diagnostic').val();
				var receta = $('#v_recipe').val();

				if(update==0){
					console.log(update+' - nuevo envio');
					//envio el formulario para agregar

					$.post('/admin/visits/{{ $pet->id }}/indexpet', {doctor:doctor, fecha:fecha, clinica:clinica, diganostico:diganostico, receta:receta}, function(data) {
						if(data!="0") {
							console.log("envio ok");
							//cerrar el modal de bootstrap
							$('#exampleModal').modal('hide');
							//agregar la visita en la fila de la tabla
							$('#listVisits').append('<tr><td scope="row">'+data+'</td><td class="clinica'+id+'">'+clinica+'</td><td class="doctor'+id+'">'+doctor+'</td><td><a href="" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" onclick="cathData({{ $pet->id }})" id="editForm"><i class="material-icons" style="color:white; font-size: 16px">mode_edit</i></a><a href="" data-delete="'+id+'" class="btn btn-danger btn-delete"><i class="material-icons" style="color:white; font-size: 16px" >delete</i></a></td></tr>');
						}
						else {
							console.log("hubo un error por puto y poe cagon");
						}
					});
				}else{
					console.log(update+' - es un update');

					$.ajax({
					    url: '/admin/visits/{{ $pet->id }}/'+update+'/indexpet',
					    data: {doctor:doctor, fecha:fecha, clinica:clinica, diganostico:diganostico, receta:receta},
					    type: 'PUT',
					    success: function(data) {
					        if(data!="0") {
								console.log("update ok");
								//cerrar el modal de bootstrap
								$('#exampleModal').modal('hide');
								
								//cambiar valores en la fila
								//var clinicChange = $('#listVisits').find('.clinica'+data);
								//console.log(clinicChange);
								//console.log(clinicChange.html());
								$('#listVisits').find('.clinica'+data).html(clinica);
								$('#listVisits').find('.doctor'+data).html(doctor);
							}else {
								console.log("hubo un error por puto y por cagon");
							}
						}
					});
				}
			})
		});
	</script>
@endsection