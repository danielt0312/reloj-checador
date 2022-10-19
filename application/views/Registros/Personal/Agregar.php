<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

<script>
	var loadFile = function (event) {
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
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Registros / Agregar Personal</label>
		</div>
	</div>
</div>

<br>
<div class="container">
	<form class="validaFormulario" action="<?=base_url('Registros/Registro/nuevoRegistro')?>" method="POST"
		onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">
		<!--<form class="" action="<?=base_url('Registros/Registro/testPost')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">-->
		<div class="panel panel-default shadow">
			<div class="gem-titulo">
				<label>Datos personales</label>
			</div>
			<div class="panel-body ">
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Imagen</label>
						<input id="file-input" type="file" accept="image/*" onchange="showMyImage(this)" />
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">CURP:</label>
						<input type="text" maxlength="18" minlength="18"
							class="form-control text-uppercase required limpiarregistro" name="data[personal][curp]"
							id="curp_id" placeholder="Escribir CURP">

					</div>

					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Validar CURP:</label><br>
						<a id="btn_valida_curp" class="btn btn-azulclaro btn-block"><i class="fa fa-check"
								aria-hidden="true"></i> Validar</a>
					</div>
					<div class="col-sm-2">
						&nbsp;<span id="curp_label" class="label label-danger" style="display: none;">CURP NO
							VALIDADO</span>
						&nbsp;<span id="curp_registrada_anteriormente" class="label label-danger"
							style="display: none;">CURP YA REGISTRADA</span>
						&nbsp;<span id="curp_error" class="label label-danger" style="display: none;">ERROR EN
							LA VALIDACIÓN</span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Nombre(s):</label>
						<input type="text" class="nombre_usuario required form-control text-uppercase"
							name="data[personal][nombre]" required placeholder="Nombre(s)">
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Apellido Paterno:</label>
						<input type="text" class="apellido_paterno required form-control text-uppercase"
							name="data[personal][apellido_paterno]" required placeholder="Apellido Paterno">
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Apellido Materno:</label>
						<input type="text" class="apellido_materno required form-control text-uppercase"
							name="data[personal][apellido_materno]" required placeholder="Apellido Materno">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">RFC:</label>
						<input type="text" class="required  form-control text-uppercase" placeholder="RFC"
							name="data[personal][rfc]" id="rfc_id"
							onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Sexo:</label>
						<select class=" btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[personal][tipo_sangre]" style="border: 1px solid #c9c9c9;"
							required>
							<option value="">Seleccionar</option>
							<option value="M">FEMENINO</option>
							<option value="H">MASCULINO</option>
						</select>
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Tipo de Sangre:</label>
						<select class=" btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[personal][tipo_sangre]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($tiposangre as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Estado Civil:</label>
						<select class="btn btn-secondary btn-block      required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[personal][estado_civil]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($estadocivil as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Hijos:</label>
						<input type="number" class="btn btn-secondary btn-block      required"
							placeholder="Número de hijos" min="0" max="12" name="data[personal][hijos]"
							style="border: 1px solid #c9c9c9;">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Correo Electrónico:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Correo Electrónico"
							name="data[personal][correo]">
					</div>
					<div class="col-sm-12 col-lg-3 col-form-label">
						<label for="c_Nombre" class="textform">Teléfono:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Teléfono"
							name="data[personal][telefono]">
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Estatus:</label>
						<select class="btn btn-secondary btn-block required" aria-hidden="true"
							name="data[vitacora][estatus_id]" id="estatus_id" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php
                                            foreach($estatus as $item):
                                                echo '<option value="'.$item->id.'">'.$item->nombre.'</option>';
                                            endforeach;
                                            ?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-3 col-form-label" id="motivos_baja">
						<label for="c_Nombre" class="textform">Motivo Baja:</label>
						<select class="btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[vitacora][motivo_baja_id]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php
                                            foreach($motivos_baja as $item):
                                                echo '<option value="'.$item->id.'">'.$item->nombre.'</option>';
                                            endforeach;
                                            ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Fecha Ingreso sistema:</label>
						<input type="text" class="form-control redonlyform text-uppercase" placeholder=""
							name="data[personal][fecha_ingreso_sistema]" id="fechaIngresoSistema" readonly>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Fecha Ingreso Centro de Trabajo:</label>
						<input type="date" class="form-control text-uppercase" placeholder=""
							name="data[personal][fecha_ingreso_ct]">
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label" id="fecha_baja">
						<label for="c_Nombre" class="textform">Fecha Baja:</label>
						<input type="date" class="form-control text-uppercase" placeholder=""
							name="data[vitacora][fecha_baja]">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">¿Tiene demanda?:</label>
						<select class=" btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" id="demanda" name="data[personal][demanda]"
							style="border: 1px solid #c9c9c9;" required>
							<option value="">Seleccionar</option>
							<option value="1">Si</option>
							<option value="2">No</option>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label" id="obs_demanda">
						<label for="c_Nombre" class="textform">Observación demanda:</label>
						<input type="text" class="required form-control text-uppercase"
							placeholder="Observación demanda" name="data[personal][obs_demanda]">
					</div>
					<div class="col-sm-12 col-lg-3 col-form-label">
						<label for="c_Nombre" class="textform">Municipio centro de trabajo:</label>
						<select class="btn btn-secondary btn-block required" aria-hidden="true"
							name="data[vitacora][ct_municipio]" id="ct_municipio" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php
                                            foreach($ct_municipio as $item):
                                                echo '<option value="'.$item['nombre'].'">'.$item['nombre'].'</option>';
                                            endforeach;
                                            ?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-3 col-form-label">
						<label for="c_Nombre" class="textform">Pensión Alimenticia:</label>
						<select class=" btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" id="pension" name="data[personal][pension]"
							style="border: 1px solid #c9c9c9;" required>
							<option value="">Seleccionar</option>
							<option value="1">Si</option>
							<option value="2">No</option>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label" id="beneficiario">
						<label for="c_Nombre" class="textform">Beneficiario:</label>
						<input type="text" class="required form-control text-uppercase"
							placeholder="Nombre beneficiario" name="data[personal][beneficiario]">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label class="textform">Claves Presupuestales:</label>
						<div class="col-md-12">
							<div id="claves_presupuestales">

							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-6 col-form-label">
						<label class="textform">Tipo plaza:</label><br>
						<?php foreach($plaza as $item): ?>
						<div class="checkbox-inline ">
							<input name="data[personal][<?=$item['campo']?>]" class="form-check-input" type="checkbox"
								value="1" id="defaultCheck1">
							<label class="form-check-label text-uppercase textform" for="defaultCheck1">
								<?=$item['nombre']?>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default shadow">
			<div class="gem-titulo ">
				<label>Dirección</label>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Calle:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Calle"
							name="data[personal][calle]">
					</div>
					<div class="col-sm-12 col-lg-2 col-form-label">
						<label for="c_Nombre" class="textform">Número:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Número"
							name="data[personal][numero]">
					</div>
					<div class="col-sm-12 col-lg-6 col-form-label">
						<label for="c_Nombre" class="textform">Colonia:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Colonia"
							name="data[personal][colonia]">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Código Postal:</label>
						<input type="text" class="required form-control text-uppercase" placeholder="Código Postal"
							name="data[personal][cp]">
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Estado:</label>
						<select class="btn btn-secondary btn-block   selectPadre required" data-select2-id="1"
							data-dependiente="#municipio_id" data-metodo="getMunicipio" id="estadovalor" tabindex="-1"
							aria-hidden="true" name="data[personal][estado_id]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($estados as $key) {
												echo '<option camponombre="' . $key['nombre'] . '" value="' . $key['id'] . '">' . $key['nombre'].'</option>';
											}?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Municipio:</label>
						<select class="btn btn-secondary btn-block     required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" id="municipio_id" name="data[personal][municipio_id]"
							style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default shadow">
			<div class="gem-titulo ">
				<label>Información académica</label>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 col-lg-3 col-form-label">
						<label for="c_Nombre" class="textform">Grado máximo de estudios:</label>
						<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1" aria-hidden="true"
							name="data[personal][grado_estudios]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($gradosestudio as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Nombre de la carrera:</label>
						<input type="text" class="form-control text-uppercase" placeholder="Nombre de la carrera"
							name="data[personal][carrera]">
					</div>
					<div class="col-sm-12 col-lg-5 col-form-label">
						<label for="c_Nombre" class="textform">Institución:</label>
						<input type="text" class="form-control text-uppercase" placeholder="Institución"
							name="data[personal][institucion]">
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Año de egreso:</label>
						<select class=" btn btn-secondary btn-block" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[personal][fecha_egreso]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php
															for($anio=(date("Y")); 1980<=$anio; $anio--) {
																echo "<option value=".$anio.">".$anio."</option>";
															}
													?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Número de cédula/Título:</label>
						<input type="text" class="form-control text-uppercase" placeholder="Número de cédula/Título"
							name="data[personal][folio_titulo]">
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Grado profesional:</label>
						<select class=" btn btn-secondary btn-block" data-select2-id="1" tabindex="-1"
							aria-hidden="true" name="data[personal][grado_profesion]"
							style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($gradoprofesional as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default shadow">
			<div class="gem-titulo ">
				<label>Datos del trabajador</label>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Departamento:</label>
						<select class="btn btn-secondary btn-block  selectPadre required   required" data-select2-id="1"
							tabindex="-1" data-dependiente="#area_id" data-metodo="getArea" id="departamentovalor"
							aria-hidden="true" name="data[personal][departamento]" style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($departamento as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
						</select>
					</div>
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Área:</label>
						<select class="btn btn-secondary btn-block     required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" id="area_id" name="data[personal][area]"
							style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
						</select>
					</div>
					<!--
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-3">
										<label class="textform">Turno:</label>
									</div>
									<div class="col-md-8">
									<select class="btn btn-secondary btn-block      required" data-select2-id="1" tabindex="-1" aria-hidden="true" name="data[personal][turno]" style="border: 1px solid #c9c9c9;">
											<option value="">Seleccionar</option>
											<?php foreach ($turno as $key) {
												echo "<option value='".$key['id']."'>".$key['nombre']."</option>";
											}?>
										</select>
									</div>
								</div>
							</div>
							-->
					<div class="col-sm-12 col-lg-4 col-form-label">
						<label for="c_Nombre" class="textform">Puesto:</label>
						<select class="btn btn-secondary btn-block required" data-select2-id="1" tabindex="-1"
							aria-hidden="true" id="puesto" name="data[personal][puesto_id]"
							style="border: 1px solid #c9c9c9;">
							<option value="">Seleccionar</option>
							<?php foreach ($puestos as $key) {
                                                echo "<option value='".$key->id."'>".$key->nombre."</option>";
                                            }?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12 col-lg-12 col-form-label">
						<label for="c_Nombre" class="textform">Observaciones:</label>
						<textarea type="text" class="form-control text-uppercase" placeholder="Observaciones"
							name="data[personal][observaciones]"></textarea>
					</div>
					</div><br>

				<div class="row" id="campo_laboratorista" style="display: none;">
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">C.C.T. Asignado</span>
							<input type="text" id="tags" name="data[personal][cct_laboratorista]" class="form-control"
								placeholder="Escribe la clave o nombre del Centro de Trabajo"
								aria-describedby="basic-addon1">
						</div>
					</div>
				</div><br>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-12">
								<label class="textform">Horario:</label>
							</div>
						</div>
						<div style="display:">
							<table class="table">
								<?php foreach($dias_semana as $dia): ?>
								<tr>
									<td>
										<input class="form-check-input" type="checkbox" id=""
											name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][dia]"
											value="<?=(!is_array($dia)) ? 0 : $dia['data']['cve_dia']?>">
										<label class="form-check-label text-uppercase textform"
											for=""><?=(!is_array($dia)) ? $dia : $dia['data']['dia']?></label>
									</td>
									<td>
										<input type="time"
											name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][entrada]">
										a
										<input type="time"
											name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][salida]">
									</td>
								</tr>
								<?php endforeach; ?>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default shadow">
			<div class="gem-titulo">
				<label>Autorización</label>
			</div>
			<div class="panel-body">
				<div class="alert alert-warning">
					<input class="coupon_question" type="checkbox" name="coupon_question" value="1" />&nbsp;&nbsp;Acepto
					de conformidad, se realizó la
					validación y actualización
					correspondiente de los datos registrados en la plataforma del personal a cargo.</div>
				<fieldset class="question">

					<fieldset class="answer">
						<div class="row">
							<div class="col-md-4">
							</div>
							<div class="col-md-4">
								<input type="hidden" name="fecha_registro" value="<?=date('Y-m-d H:i:s')?>">
								<input type="hidden" name="data[personal][alta_baja]" value="1">
								<input type="hidden" name="nombre_estado" id="id_nombreestado" value="">
								<input type="hidden" name="nombre_municipio" id="id_nombremunicipio" value="">
								<!--<input type="hidden" name="nombre_departamento" id="id_nombredepartamento" value="">-->
								<!--<input type="hidden" name="nombre_area" id="id_nombrearea" value="">-->
								<!--<center><input type="submit" value="Registrar" class="btn btn-verde  btn-block btnguarda" disabled=""></center>-->
								<input type="submit" value="Registrar" class="btn btn-verde btnguarda btn-block">
							</div>
						</div>
					</fieldset>
			</div>
		</div>
</div>

</form>
<div class="container">
	<a href="<?=base_url('registros/'.$this->uri->segment(2))?>" class="btn btn-azul"><i class="fa fa-chevron-left"
			aria-hidden="true"></i> Regresar</a>
</div>
<div style="height: 20px;"></div>

</div>

</div>

<script type="text/javascript">
	$(document).ready(function () {

		$('#motivos_baja').hide();
		$('#fecha_baja').hide();
		$('#obs_demanda').hide();
		$('#fecha_baja').hide();
		$('#beneficiario').hide();

		$('#estatus_id').change(function () {
			var valor = $(this).val();
			console.log(valor);
			if (valor == 2) {
				$('#motivos_baja').show();
				$('#fecha_baja').show();
			} else {
				$('#motivos_baja').hide();
				$('#fecha_baja').hide();
			}
		})

		$('#demanda').change(function () {
			var valor = $(this).val();
			console.log(valor);
			if (valor == 1) {
				$('#obs_demanda').show();
			} else {
				$('#obs_demanda').hide();
			}
		})

		$('#pension').change(function () {
			var valor = $(this).val();
			console.log(valor);
			if (valor == 1) {
				$('#beneficiario').show();
			} else {
				$('#beneficiario').hide();
			}
		})
	})

	function showMyImage(fileInput) {
		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img = document.getElementById("peviavista");
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function (aImg) {
				return function (e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
	}
</script>
<script type="text/javascript">
	$(document).ready(function () {
		//validación de formularios
		$('.validaFormulario').validate({
			//errorElement: 'span',
			submitHandler: function (form) {
				var data = new FormData();
				var url = $('.validaFormulario').attr('action');


				jQuery.each($('input[type=file]')[0].files, function (i, file) {
					data.append('file-' + i, file);
				});
				var other_data = $('.validaFormulario').serializeArray();
				$.each(other_data, function (key, input) {
					data.append(input.name, input.value);
				});

				$.ajax({
					url: url,
					type: 'POST',
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {

						swal({
							title: "Espere por favor...",
							//text: dialogo,
							//icon: "warning",
							buttons: false,
							//dangerMode: true,
						})

					},
					success: function (data) {

						var objeto = JSON.parse(data);
						$.each(objeto, function (i, item) {

							notificacion(item.error, item.mensaje);

						})

					}
				})
			}
		});
		$('.selectPadre').change(function (e) {
			var elemento_dependiente = $(this).data('dependiente');
			var metodo = $(this).data('metodo');
			var seleccionado = $(this).val();
			var option = "";

			$.ajax({
				url: metodo,
				type: 'POST',
				data: {
					valor: seleccionado
				},
				beforeSend: function () {
					swal('Buscando...');
				},
				success: function (data) {

					var objeto = JSON.parse(data);
					option += '<option>Seleccionar</option>';
					$.each(objeto, function (i, item) {
						option += '<option valornom="' + item.legend + '" value="' +
							item.value + '">' + item.legend + '</option>';
					})
					if (elemento_dependiente == '#localidad_id') {
						option += '<option value="otra_localidad_id">Otra Localidad</option>';
					}

					swal.close();
					$(elemento_dependiente).empty();
					$(elemento_dependiente).html(option);

				}
			})

		})

		//puesto
		$('#puesto').change(function (e) {
			var valor_puesto = $(this).val();
			if (valor_puesto == 8) {
				$('#tags').attr('required', true);
				$('#campo_laboratorista').show();
			} else {
				$('#tags').val('');
				$('#tags').attr('required', true);
				$('#campo_laboratorista').hide();
			}
		})

	});

	function notificacion(error, mensaje) {
		var base_url = '<?=base_url();?>Registros/Registro/Agregar';
		if (error == 0) {
			swal(mensaje, {
				buttons: false,
				icon: "success",
				timer: 5000,
			}).then(function () {
				//window.location.href = base_url;
				location.reload();
			});

		} else if (error == 1) {

			swal(mensaje, {
				icon: "warning"

			});

		}
	}
</script>
<script>
	$(function () {
		$(document).on('change', '#estadovalor', function () {
			var dataid = $("#estadovalor option:selected").attr('camponombre');
			$('#id_nombreestado').val(dataid);
		});
		$(document).on('change', '#municipio_id', function () {
			var dataid = $("#municipio_id option:selected").attr('valornom');
			$('#id_nombremunicipio').val(dataid);
		});
	});

	$(function () {
		$(document).on('change', '#departamentovalor', function () {
			var dataid = $("#departamentovalor option:selected").attr('camponombre');
			$('#id_nombredepartamento').val(dataid);
		});
		$(document).on('change', '#area_id', function () {
			var dataid = $("#area_id option:selected").attr('valornom');
			$('#id_nombrearea').val(dataid);
		});
	});
</script>
<script>
	$(function () {
		$("#tags").autocomplete({
			//source: availableTags
			source: function (request, response) {
				$.ajax({
					url: "<?=base_url('catalogos/centros-trabajo/buscar')?>",
					type: 'POST',
					dataType: "json",
					data: {
						search: request.term
					},
					success: function (data) {
						var result = [];
						$.each(data, function (key, value) {
							result[key] = value;
						})
						response(result);
					}
				})
			}
		});
	});
</script>
<script>
	$(".answer").hide();
	$(".coupon_question").click(function () {
		if ($(this).is(":checked")) {
			$(".answer").show();
		} else {
			$(".answer").hide();
		}
	});
</script>