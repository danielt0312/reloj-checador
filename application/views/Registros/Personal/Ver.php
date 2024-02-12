<div style="height: 30px;"></div>
<div class="container">
	<script>
		var loadFile = function(event) {
			var output = document.getElementById('output');
			output.src = URL.createObjectURL(event.target.files[0]);
			document.getElementById("output").style.width = "200px";
			document.getElementById("output").style.height = '200px';
		};
	</script>

	<style>
		.inputfile-1+label {
			border: #ebebeb solid 1px;
			padding: 4px 6px 4px 8px;
			font-size: 16px;
			color: #ffffff;
			background: #bc955c;
			font-family: 'Roboto Condensed', sans-serif;
			font-weight: bold;
			text-transform: uppercase;
		}

		.inputfile-1:focus+label,
		.inputfile-1.has-focus+label,
		.inputfile-1+label:hover {
			background-color: #fff;
			/* color: #fff; */
			color: #c4c4c4;
			border: 1px solid #c4c4c4;
		}


		.inputfile+label {
			font-size: 16px;
			/* 20px */
			font-weight: 700;
			text-overflow: ellipsis;
			white-space: nowrap;
			cursor: pointer;
			/* 10px 20px */
		}

		.no-js .inputfile+label {
			display: none;
		}

		.inputfile:focus+label,
		.inputfile.has-focus+label {
			outline: 1px dotted #000;
			outline: -webkit-focus-ring-color auto 5px;
		}

		.inputfile+label * {
			/* pointer-events: none; */
			/* in case of FastClick lib use */
		}

		.inputfile+label svg {
			width: 1em;
			height: 1em;
			vertical-align: middle;
			fill: currentColor;
			margin-top: -0.25em;
			/* 4px */
			margin-right: 0.25em;
			/* 4px */
		}
	</style>
	<!--#1976d2-->
	<div class="contenedor-principal">
		<div style="height: 40px;"></div>
		<label class="page-container__title ">&nbsp;Registros: Ver Personal</label>
		<br>
		<a href="<?=base_url()?>Registros/Registro" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i>  Regresar</a>
		<hr>
		<?php foreach ($consultagen as $item) {?>

		<div class="container">
			<div class="panel panel-default"> 
				<div class="gem-titulo">
					<label>Datos personales</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<?php if (is_file(substr($item['foto'], 1))){ ?>
							<div class="col-sm-12">
								<div class="image-upload">
									<label for="file-input">
										<img src="<?=base_url($item['foto']);?>" width="150" height="190" id="peviavista" />
									</label>
								</div>
							</div>
							<?php }else{ ?>
							<div class="col-sm-12">
								<!-- <label for="file-input">
										<img src="<?= base_url();?>assets/img/usuario.png" width="150" height="150" id="peviavista" />
									</label> -->
								<input id="file-input" type="file" accept="image/*" onchange="showMyImage(this)" />
								<!-- <label id="label-imagenes" class="textoimagen" for="imagenes">
												Solo se aceptan archivos con extensión de imagen.
											</label> -->
							</div>
							<?php } ?>
						</div>
					</div><br>
					<div class="row ">
						<div class="col-md-4 form-group">
							<div class="col-md-3">
								<label class="grisfor">CURP:</label>
							</div>
							<div class="col-md-8">
								<!-- <label><?=$item['curp']?></label> -->
								 <input type="text" class=" redonlyform" name="curp" value="<?=$item['curp']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">RFC:</label>
								</div>
								<div class="col-md-8">
										<!-- <label><?=$item['rfc']?></label> -->
									 <input type="text" class= redonlyform" placeholder="RFC" name="rfc" value="<?=$item['rfc']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Sexo:</label>
								</div>
								<div class="col-md-8">
										<!-- <label><?=$item['sexo']?></label> -->
									<input type="text" class="  redonlyform" id="sexo" readonly name="sexo" value="<?=$item['sexo']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Nombre(s):</label>
								</div>
								<div class="col-md-8">
										<!-- <label><?=$item['nombre']?></label> -->
							 <input type="text" class="  redonlyform nombre_usuario" readonl name="nombre" value="<?=$item['nombre']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Apellido Paterno:</label>
								</div>
								<div class="col-md-8">
										<!-- <label><?=$item['apellido_paterno']?></label> -->
									 <input type="text" class="  redonlyform apellido_paterno" readonly name="apellido_paterno" value="<?=$item['apellido_paterno']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Apellido Materno:</label>
								</div>
								<div class="col-md-8">
										<!-- <label><?=$item['apellido_materno']?></label> -->
									 <input type="text" class="  redonlyform apellido_materno" readonly name="apellido_materno" value="<?=$item['apellido_materno']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Tipo de Sangre:</label>
								</div>
								<div class="col-md-8">
									<select class=" btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="tipo_sangre" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
										<option value="">Seleccionar</option>
										<?php
										foreach($tiposangre as $indice):
											$selected 			= ($indice['id'] == $item['tipo_sangre']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Estado Civil:</label>
								</div>
								<div class="col-md-8">
									<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="estado_civil" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
										<option value="">Seleccionar</option>
										<?php
										foreach($estadocivil as $indice):
											$selected 			= ($indice['id'] == $item['estado_civil']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Hijos:</label>
								</div>
								<div class="col-md-8">
									<input type="number" value="<?=$item['hijos']?>" class="btn btn-secondary btn-block" placeholder="Número de hijos" min="0" max="12" name="hijos" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Correo Electrónico:</label>
								</div>
								<div class="col-md-8">
									<input type="text" class="floating" placeholder="Correo Electrónico" name="correo" value="<?=$item['correo']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Teléfono:</label>
								</div>
								<div class="col-md-8">
									<input type="text" class="floating" placeholder="Teléfono" name="telefono" value="<?=$item['telefono']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>
						<?php if ($this->session->userdata('rol_id') != 6){?>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Tipo de Plaza:</label>
								</div>
								<div class="col-md-8">
								<select class="btn btn-secondary btn-block " data-select2-id="1" tabindex="-1" aria-hidden="true" id="plaza" name="plaza" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
										<option value="">Seleccionar</option>
										<?php
										foreach($plaza as $indice):
											$selected 			= ($indice['id'] == $item['plaza']) ? 'selected' : '';
											echo '<option camponombre="' . $indice['nombre'] . '" value="'.$indice['clave'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
									</select></div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			

			<div class="panel panel-default">
				<div class="gem-titulo ">
					<label>Dirección</label>
				</div>
				<div class="panel-body">
					<div class="row ">
						<div class="col-md-6">
							<div class="form-group">
								<label class="grisfor">Calle:</label>
								<input type="text" class="floating" placeholder="Calle" name="calle" value="<?=$item['calle']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label class="grisfor">Número:</label>
								<input type="text" class="floating" placeholder="Número" name="numero" value="<?=$item['numero']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="grisfor">Colonia:</label>
								<input type="text" class="floating" placeholder="Colonia" name="colonia" value="<?=$item['colonia']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Código Postal:</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="floating" placeholder="Código Postal" name="cp" value="<?=$item['cp']?>" style="background: #cfcfcf;" readonly>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Estado:</label>
								</div>
								<div class="col-md-8">
									<select class="btn btn-secondary btn-block  selectPadre" data-select2-id="1" data-dependiente="#municipio_id" data-metodo="<?=base_url('Registros/Registro/getMunicipio')?>" id="estadovalor" tabindex="-1" aria-hidden="true"
										name="estado_id" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
										<option value="">Seleccionar</option>
										<?php foreach ($estados as $indice) {
											$selected = ($indice['clave'] == $item['estado_id']) ? 'selected' : '';
                                                echo '<option camponombre="' . $indice['nombre'] . '" value="' . $indice['id'] . '" '.$selected.'>' . $indice['nombre'].'</option>';
										}?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-3">
									<label class="grisfor">Municipio:</label>
								</div>
								<div class="col-md-8">
									<select class="btn btn-secondary btn-block " data-select2-id="1" tabindex="-1" aria-hidden="true" id="municipio_id" name="municipio_id" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
										<option value="">Seleccionar</option>
										<?php
										foreach($municipios as $indice):
											$selected 			= ($indice['id'] == $item['municipio_id']) ? 'selected' : '';
											echo '<option camponombre="' . $indice['nombre'] . '" value="'.$indice['clave'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="gem-titulo  ">
					<label>Dirección</label>
				</div>
				<div class="panel-body">
					<div class="row ">
						<div class="col-md-3">
							<div class="form-group">
								<label class="grisfor">Grado máxiamo de estudios:</label>
								<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="grado_estudios" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
										foreach($gradosestudio as $indice):
											$selected 			= ($indice['id'] == $item['grado_estudios']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="grisfor">Nombre de la carrera:</label>
								<input type="text" class="floating" placeholder="Nombre de la carrera" name="carrera" value="<?=$item['carrera']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="grisfor">Institución:</label>
								<input type="text" class="floating" placeholder="Institución" name="institucion" value="<?=$item['institucion']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label class="grisfor">Año de egreso:</label>
								<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="fecha_egreso" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
							                for($anio=(date("Y")+1); 1980<=$anio; $anio--) {
							                  if ($item['fecha_egreso']==$anio) {
							                    echo '<option value="'.$anio.'" selected="selected">'.$anio.'</option>';
							                  }
							                  else{
							                     echo "<option value=".$anio.">".$anio."</option>";
							                   }
							                }
							            ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="grisfor">Número de cédula/Título:</label>
								<input type="text" class="floating" placeholder="Número de cédula/Título" name="folio_titulo" value="<?=$item['folio_titulo']?>" style="background: #cfcfcf;" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="grisfor">Grado profesional:</label>
								<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="grado_profesion" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
										foreach($gradoprofesional as $indice):
											$selected 			= ($indice['id'] == $item['grado_profesion']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>



			
				<div class="panel panel-default">
					<div class="gem-titulo ">
						<label>Datos del trabajador</label>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<label class="grisfor">Departamento:</label>
									<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="departamento" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
										foreach($departamento as $indice):
											$selected 			= ($indice['id'] == $item['departamento']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="grisfor">Area:</label>
									<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="area" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
										foreach($areas as $indice):
											$selected 			= ($indice['id'] == $item['area']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
								</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="grisfor">Turno:</label>
									<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true" name="turno" style="border: 1px solid #c9c9c9; background: #cfcfcf;" readonly>
									<option value="">Seleccionar</option>
									<?php
										foreach($turno as $indice):
											$selected 			= ($indice['id'] == $item['turno']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
								</select>
								</div>
							</div>
						</div>
						
					</div>
				</div>
		</div>
		<?php }?>
		<div style="height: 20px;"></div>
		<div style="height: 100px;"></div>
	</div>
