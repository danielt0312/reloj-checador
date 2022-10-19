<div class="container">
	<div id="conocenos" class="bloque-index">
		<h2>Inicio</h2>
		<form class="form-inline" action="POST" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
			<div class="panel panel-default coo">
				<div class="panel-heading panelgris">
					<label class="grisclaro2">DATOS PERSONALES DEL DOCENTE</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<div class="row">
									<div class="col-sm-12">
										<div class="image-upload">
											<label for="file-input">
												<img src="<?= base_url();?>assets/img/imagen/user.png" width="150" height="150" src="" />
											</label>
											<input id="file-input" type="file" />
										</div>
										<label class="grisfor2"><i class="fa fa-arrow-up" aria-hidden="true"></i> Subir imagen</label>
										<label id="label-imagenes" class="grisclaro" for="imagenes">
											Solo se aceptan archivos con extensión de imagen.
										</label>
									</div>
								</div>
							</div>
							<div class="col-md-10">
								<div class="row">
									<div class="col-sm-1">
										<label class="grisfor">CURP:</label>
									</div>
									<div class="col-sm-3">
										<input type="text" class="inputs uppercase required field" name="" placeholder="Escribir CURP" required>
									</div>
									<div class="col-sm-2">
										<a id="buscarRFC" href="#" class="btn btn-gris btn-block">Validar CURP</a>
									</div>
								</div><br>
								<div class="row">
									<div class="col-sm-1">
										<label class="grisfor" for="">Nombre(s):</label>
									</div>
									<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
									</div>
									<div class="col-sm-1">
										<label class="grisfor" for="">Apellido Paterno:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Apellido Materno:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Nombre de Usuario:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Correo electrónico:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Confirmar Correo electrónico:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Contraseña:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Confirmar contraseña:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
						</div>
					</div>
				</div>
					</div>
				</div>

			<div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
								<label class="grisclaro2">DATOS DE LA ESCUELA</label>
						</div>
		     	<div class="panel-body">
		     		<label>Llene el formulario de inscripción al proyecto <b>Tablilocas</b>. Es muy importante verificvar que <u>los datos que proporciona son correctos y vigentes</u>.</label>
						<div class="row">
							<div class="col-sm-1">
									<label class="grisfor" for="">Nombre de la Escuela:</label>
							</div>
							<div class="col-sm-11">
									<input type="text" class="inputs uppercase field">
							</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Clave del centro de trabajo:</label>
								</div>
								<div class="col-sm-4">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Turno:</label>
								</div>
								<div class="col-sm-2">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Sector:</label>
								</div>
								<div class="col-sm-1">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Zona:</label>
								</div>
								<div class="col-sm-1">
										<input type="text" class="inputs uppercase field">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Teléfono:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Estado:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Municipio:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Localidad:</label>
								</div>
								<div class="col-sm-3">
										<select name="" class="inputs"><option value="">Seleccionar</option></select>
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Clave de Red ILCE:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" class="inputs uppercase field">
											Este campo no es obligatorio
								</div>
						</div><br>
		     	</div>
		    </div>

			<div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
							  <label class="grisclaro2">datos de los alumnos</label>
						</div>
		     	<div class="panel-body">
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Grado:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Grupo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" class="inputs uppercase field">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Número de alumnos del equipo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Nombre del Equipo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" class="inputs uppercase field">
								</div>
						</div>
		     	</div>
		    </div>

			<div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
							 <label class="grisclaro2">DATOS DEL RESPONSABLE DEL AULA DE MEDIOS</label>
						</div>
		     	<div class="panel-body">
						<div class="row">
								<div class="col-sm-2">
										<label class="grisfor" for="">Nombre del Responsable del Aula de Medios:</label>
								</div>
								<div class="col-sm-4">
										<input type="text" class="inputs uppercase field">
								</div>
								<div class="col-sm-2">
										<label class="grisfor" for="">Correo Eléctronico del Responsable de Aula de Medios:</label>
								</div>
								<div class="col-sm-4">
										<input type="text" class="inputs uppercase field">
								</div>
						</div>
		     	</div>
		    </div>

		    <div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
							 <label class="grisclaro2">DATOS IMPORTANTES</label>
						</div>
		     	<div class="panel-body">
					    <div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">Número de computadoras</label>
							<input type="text" class="inputs" name="nombre" required>
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Cuántas horas a la semana acude el grupo al aula de medios?</label>
							<input type="text" class="inputs" name="nombre" required>
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Porqué se inscribieron en este proyecto?</label>
							<textarea type="text" class="inputs" name="nombre" required rows="5" style="width: 100%; height: 100%;"></textarea>
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Qué esperan de este proyecto?</label>
							<textarea type="text" class="inputs" name="nombre" required rows="5" style="width: 100%; height: 100%;"></textarea>
						</div>

		     	</div>
		    </div>

		</form>
	</div>
</div>