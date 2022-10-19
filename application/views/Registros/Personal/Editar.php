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
			<label>Registros / Editar Personal</label>
		</div>
	</div>
</div>
<br>
<div class="container">
	<?php foreach ($consultagen as $item) {?>
	<form class="validaFormulario" action="<?=base_url()?>Registros/Registro/edicionRegistro/<?=$item['id']?>"
		method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">
		<!--<form class="" action="<?=base_url()?>Registros/Registro/testPost/<?=$item['id']?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">-->
		<div class="container">
			<div class="panel panel-default">
				<div class="gem-titulo">
					<label>Datos personales</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-lg-3 col-form-label">
							<?php if (is_file(substr($item['foto'], 1))){ ?>
							<div class="col-sm-10">
								<div class="image-upload">
									<label for="file-input">
										<img src="<?=base_url($item['foto']);?>?" width="100%" height="100%"
											id="peviavista" />
									</label>
								</div>
								<a data-url="<?=base_url('Registros/Registro/eliminarImagen/'.$item['id'])?>"
									class="btn btn-rojo btn-block loadAjax" data-confirmacion="true"
									data-reload="true"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar
									Imagen</a>
							</div>

							<?php }else{ ?>

							<div class="col-sm-10">
								<label for="file-input">
									<img src="<?= base_url();?>assets/img/usuario.png" width="100%" height="100%"
										id="peviavista" />
								</label>
								<input id="file-input" type="file" accept="image/*" onchange="showMyImage(this)" />
								<!-- <label id="label-imagenes" class="textoimagen" for="imagenes">
												Solo se aceptan archivos con extensión de imagen.
											</label> -->
							</div>

							<?php } ?>

						</div>
						<div class="col-sm-12 col-lg-6 col-form-label">
							<label for="c_Nombre" class="textform">CURP:</label>
							<div class="row">
								<div class="col-md-9">
									<input type="text" class="form-control" name="data[personal][curp]" id="curp_id"
										value="<?=$item['curp']?>" style="background: #cfcfcf;"
										<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
								</div>
								<div class="col-sm-3">
									<?php if($this->session->userdata('rol_id') < 4) { ?>
									<a id="btn_valida_curp" class="btn btn-verde" data-valicaduplicado="false"><i
											class="fa fa-check" aria-hidden="true"></i> Validar CURP</a>
									<?php } ?>
								</div>
								<div class="col-sm-2">
									&nbsp;<span id="curp_label" class="label label-danger" style="display: none;">CURP
										NO VALIDADO</span>
									&nbsp;<span id="curp_registrada_anteriormente" class="label label-danger"
										style="display: none;">CURP YA REGISTRADA</span>
									&nbsp;<span id="curp_error" class="label label-danger" style="display: none;">ERROR
										EN LA VALIDACIÓN</span>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">RFC:</label>
							<input type="text" class="form-control" placeholder="RFC" name="data[personal][rfc]"
								value="<?=$item['rfc']?>" id="rfc_id_edicion"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
							<!--<input type="text" class="" placeholder="RFC" name="data[personal][rfc]" value="<?=$item['rfc']?>" id="">-->
						</div>
						<div class="col-sm-12 col-lg-2 col-form-label">
							<label for="c_Nombre" class="textform">Sexo:</label>
							<input type="text" class="form-control " id="sexo" readonly name="data[personal][sexo]"
								value="<?=$item['sexo']?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>

					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Nombre(s):</label>
							<input type="text" class="form-control redonlyform nombre_usuario " readonl
								name="data[personal][nombre]" value="<?=$item['nombre']?>" readonly>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Apellido Paterno:</label>
							<input type="text" class="form-control  redonlyform apellido_paterno" readonly
								name="data[personal][apellido_paterno]" value="<?=$item['apellido_paterno']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Apellido Materno:</label>
							<input type="text" class="form-control  redonlyform apellido_materno" readonly
								name="data[personal][apellido_materno]" value="<?=$item['apellido_materno']?>">
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Tipo de Sangre:</label>
							<select class=" btn btn-secondary btn-block " data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[personal][tipo_sangre]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
										foreach($tiposangre as $indice):
											$selected 			= ($indice['id'] == $item['tipo_sangre']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
							</select>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Estado Civil:</label>
							<select class="btn btn-secondary btn-block " data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[personal][estado_civil]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
										foreach($estadocivil as $indice):
											$selected 			= ($indice['id'] == $item['estado_civil']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
							</select>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Hijos:</label>
							<input type="number" value="<?=$item['hijos']?>" class="btn btn-secondary btn-block "
								placeholder="Número de hijos" min="0" max="12" name="data[personal][hijos]"
								style="border: 1px solid #c9c9c9;">
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Correo Electrónico:</label>
							<input type="text" class="floating " placeholder="Correo Electrónico"
								name="data[personal][correo]" value="<?=$item['correo']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Teléfono:</label>
							<input type="text" class="floating " placeholder="Teléfono" name="data[personal][telefono]"
								value="<?=$item['telefono']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Estatus:</label>
							<?php if($this->session->userdata('rol_id') == 4) {
                                            foreach($estatus_personal as $item_estatus):
                                                if($item_estatus->id == $bitacora[0]['estatus_id']) {?>
							<input type="text" class="form-control" value="<?=$item_estatus->nombre?>" disabled></input>
							<input type="hidden" class="form-control" name="data[vitacora][estatus_id]"
								value="<?=$item_estatus->id?>"></input>
							<?php } ?>
							<?php endforeach;?>

							<?php } else {?>
							<select class="btn btn-secondary btn-block required" aria-hidden="true"
								name="data[vitacora][estatus_id]" id="estatus_id" style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
                                                foreach($estatus_personal as $item_estatus):
                                                    $selected = ($item_estatus->id == $bitacora[0]['estatus_id']) ? 'selected' : '';
                                                    echo '<option value="'.$item_estatus->id.'" '.$selected.'>'.$item_estatus->nombre.'</option>';
                                                endforeach;
                                                ?>
							</select>
							<?php } ?>
						</div>
					</div><br>

					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label" id="motivos_baja"
							style="<?=(isset($bitacora[0]['estatus_id']) && $bitacora[0]['estatus_id'] == 1) ? 'display: none;' : ''?>">
							<label for="c_Nombre" class="textform">Motivo Baja:</label>
							<?php if($this->session->userdata('rol_id') == 4) {
                                            foreach($motivos_baja as $item_motivo):
                                                if($item_motivo->id == $bitacora[0]['motivo_baja_id']){ ?>
							<input type="text" class="form-control" value="<?=$item_motivo->nombre?>" disabled></input>
							<input type="hidden" class="form-control" name="data[vitacora][motivo_baja_id]"
								value="<?=$item_motivo->id?>"></input>
							<?php  }
                                            endforeach;
                                        } else { ?>
							<select class="btn btn-secondary btn-block" data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[vitacora][motivo_baja_id]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
                                                foreach($motivos_baja as $item_motivo):
                                                    $selected_motivo = ($item_motivo->id == $bitacora[0]['motivo_baja_id']) ? 'selected' : '';
                                                    echo '<option value="'.$item_motivo->id.'" '.$selected_motivo.'>'.$item_motivo->nombre.'</option>';
                                                endforeach;
                                                ?>
							</select>
							<?php } ?>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label" id="fecha_baja"
							style="<?=(isset($bitacora[0]['estatus_id']) && $bitacora[0]['estatus_id'] == 1) ? 'display: none;' : ''?>">
							<label for="c_Nombre" class="textform">Fecha baja:</label>
							<input type="date" class="form-control" placeholder="" name="data[vitacora][fecha_baja]"
								value="<?=($bitacora[0]['fecha_baja']) ? $bitacora[0]['fecha_baja'] : ''?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Fecha Ingreso sistema:</label>
							<input type="date" class="form-control" placeholder=""
								name="data[personal][fecha_ingreso_sistema]" value="<?=$item['fecha_ingreso_sistema']?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>

					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Fecha Ingreso Centro de Trabajo</label>
							<input type="date" class="form-control" placeholder=""
								name="data[personal][fecha_ingreso_ct]" value="<?=$item['fecha_ingreso_ct']?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">¿Tiene demanda?:</label>
							<?php if($this->session->userdata('rol_id') == 4){ ?>
							<input type="text" class="form-control" value="<?=($item["demanda"] == 1) ? 'SI' : 'NO'?>"
								readonly>
							<?php }else { ?>
							<select class="btn btn-secondary btn-block required text-uppercase" aria-hidden="true"
								name="data[personal][demanda]" id="demanda" style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<option value="1" <?=($item["demanda"] == 1) ? 'Selected' : ''?>>Si</option>
								<option value="2" <?=($item["demanda"] == 2) ? 'Selected' : ''?>>No</option>

							</select>
							<?php }?>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label" id="obs_demanda"
							style="<?=($item['demanda'] == 2) ? 'display: none;' : ''?>">
							<label for="c_Nombre" class="textform">Observación demanda:</label>
							<input type="text" class="form-control floating text-uppercase"
								placeholder="Observación demanda" name="data[personal][obs_demanda]"
								value="<?=($item['demanda'] == 1) ? $item['obs_demanda'] : ''?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Municipio centro de trabajo:</label>
							<select class="btn btn-secondary btn-block text-uppercase"
								name="data[personal][nombre_municipio]" style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
                                            foreach($ct_municipio as $indice):
                                                $selected 			= ($indice['id'] == $item['nombre_municipio']) ? 'selected' : '';
                                                echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
                                            endforeach;
                                            ?>
							</select>
						</div>

					</div><br>

					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Pensión:</label>
							<?php if($this->session->userdata('rol_id') == 4){ ?>
							<input type="text" class="form-control text-uppercase"
								value="<?=($item['pension'] == 1) ? 'SI' : 'NO'?>" readonly>
							<?php } else { ?>
							<select class="btn btn-secondary btn-block required text-uppercase" aria-hidden="true"
								name="data[personal][pension]" id="pension" style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<option value="1" <?=($item["pension"] == 1) ? 'Selected' : ''?>>Si</option>
								<option value="2" <?=($item["pension"] == 2) ? 'Selected' : ''?>>No</option>
							</select>
							<?php } ?>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label" id="beneficiario"
							style="<?=($item['pension'] == 2) ? 'display: none;' : ''?>">
							<label for="c_Nombre" class="textform">Beneficiario:</label>
							<input type="text" class="form-control floating text-uppercase"
								placeholder="Nombre beneficiario" name="data[personal][beneficiario]"
								value="<?=($item['pension'] == 1) ? $item['beneficiario'] : ''?>"
								<?=($this->session->userdata('rol_id') == 4) ? 'readonly' : ''?>>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-12 col-form-label">
							<label class="textform">Claves Presupuestales:</label><br>
							<?php  if(count($claves_persupuestales) > 0){ ?>
							<!--<a class="btn btn-primary mb5 ajaxConfirm" data-url="<?=base_url('Registros/Registro/actualizarClaves/'.$item['id'])?>" data-reload="true">Actualizar Claves Presupuestales</a>-->
							<?php if($this->session->userdata('rol_id') != 4) {?>
							<a class="btn btn-azulclaro mb5 consutaClaves"
								data-url="<?=base_url('Registros/Registro/actualizarClaves/'.$item['id'])?>"
								data-reload="true"><i class="fa fa-refresh" aria-hidden="true"></i> Actualizar
								Claves Presupuestales</a>
							<?php } ?>
							<!-- <ul class="list-group"> -->
							<table class="table table-responsive">
								<tr rol="row">
									<th>CLAVE</th>
									<th>NOMBRE</th>
									<th>CCT</th>
									<th>NOMBRE CCT</th>
								</tr>
								<?php foreach($claves_persupuestales as $indice_claves): ?>
								<!--
                                                    <div class="input-group mb5">
                                                        <input type="text" class="form-control ajaxConfirm" placeholder="Recipient's username" aria-describedby="basic-addon2" value="<?=$indice_claves->clave_presupuestal?>" disabled>
                                                        <span class="input-group-addon ajaxConfirm" id="basic-addon2" data-url="<?=base_url('Registros/Registro/eliminarClave/'.$indice_claves->id)?>" data-reload="true">Eliminar</span>
                                                    </div>
                                                    -->
								<tr>
									<td><?=$indice_claves->clave_presupuestal?></td>
									<td><?=$indice_claves->nombre?></td>
									<td><?=$indice_claves->cct?></td>
									<td><?=$indice_claves->nombrect?></td>
								</tr>
								<?php endforeach; ?>
								<!-- </ul> -->
							</table>
							<?php }else{ ?>
							<div class="alert alert-info">No hay claves presupuestales para este registro.
								<!--<a class="btn btn-primary ajaxConfirm" data-url="<?=base_url('Registros/Registro/actualizarClaves/'.$item['id'])?>" data-reload="true">Buscar Claves presupuestales</a>-->
								<a class="btn btn-primary consutaClaves"
									data-url="<?=base_url('Registros/Registro/actualizarClaves/'.$item['id'])?>"
									data-reload="true">Buscar Claves presupuestales</a>
							</div>
							<?php }  ?>
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-6 col-form-label">
							<label class="textform">Tipo plaza:</label><br>
							<?php foreach($plaza as $plaza_tipo): ?>
							<div class="form-check">
								<?php if($this->session->userdata('rol_id') == 4){ ?>
								<input <?=($item[$plaza_tipo['campo']] == 1) ? 'checked' : ''?> class="form-check-input"
									type="checkbox" value="<?=($item[$plaza_tipo['campo']] == 1) ? 1 : 0?>" id=""
									readonly disabled>
								<input <?=($item[$plaza_tipo['campo']] == 1) ? 'checked' : ''?>
									name="data[personal][<?=$plaza_tipo['campo']?>]" class="form-check-input"
									type="checkbox" value="<?=($item[$plaza_tipo['campo']] == 1) ? 1 : 0?>" id=""
									style="display: none;">
								<?php } else {?>
								<input <?=($item[$plaza_tipo['campo']] == 1) ? 'checked' : ''?>
									name="data[personal][<?=$plaza_tipo['campo']?>]" class="form-check-input"
									type="checkbox" value="<?=($item[$plaza_tipo['campo']] == 1) ? 1 : 0?>" id="">
								<?php } ?>
								<label class="form-check-label text-uppercase textform" for="">
									<?=$plaza_tipo['nombre']?>
								</label>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="gem-titulo ">
					<label>Dirección</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-lg-6 col-form-label">
							<label for="c_Nombre" class="textform">Calle:</label>
							<input type="text" class="floating form-control text-uppercase" placeholder="Calle"
								name="data[personal][calle]" value="<?=$item['calle']?>">
						</div>
						<div class="col-sm-12 col-lg-2 col-form-label">
							<label for="c_Nombre" class="textform">Número:</label>
							<input type="text" class="floating form-control text-uppercase" placeholder="Número"
								name="data[personal][numero]" value="<?=$item['numero']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Colonia:</label>
							<input type="text" class="floating form-control text-uppercase" placeholder="Colonia"
								name="data[personal][colonia]" value="<?=$item['colonia']?>">
						</div>
					</div><br>

					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Código Postal:</label>
							<input type="text" class="floating form-control text-uppercase" placeholder="Código Postal"
								name="data[personal][cp]" value="<?=$item['cp']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Estado:</label>
							<select class="btn btn-secondary btn-block  selectPadre " data-select2-id="1"
								data-dependiente="#municipio_id"
								data-metodo="<?=base_url('Registros/Registro/getMunicipio')?>" id="estadovalor"
								tabindex="-1" aria-hidden="true" name="data[personal][estado_id]"
								style="border: 1px solid #c9c9c9;">
								<!--<option value="">Seleccionar</option>-->
								<?php foreach ($estados as $indice) {
                                            $selected = ($indice['clave'] == $item['estado_id']) ? 'selected' : '';
                                            echo '<option camponombre="' . $indice['nombre'] . '" value="' . $indice['id'] . '" '.$selected.'>' . $indice['nombre'].'</option>';
                                        }?>
							</select>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Municipio:</label>
							<select class="btn btn-secondary btn-block  " data-select2-id="1" tabindex="-1"
								aria-hidden="true" id="municipio_id" name="data[personal][municipio_id]"
								style="border: 1px solid #c9c9c9;">
								<!--<option value="">Seleccionar</option>-->
								<?php
                                        foreach($municipios as $indice):
                                            $selected 			= ($indice['clave'] == $item['municipio_id']) ? 'selected' : '';
                                            echo '<option valornom="' . $indice['nombre'] . '" value="'.$indice['clave'].'" '.$selected.'>'.$indice['nombre'].'</option>';
                                        endforeach;
                                        ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="gem-titulo  ">
					<label>Información académica</label>
				</div>
				<div class="panel-body">
					<div class="row ">
						<div class="col-sm-12 col-lg-3 col-form-label">
							<label for="c_Nombre" class="textform">Grado máximo de estudios:</label>
							<select class="btn btn-secondary btn-block " data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[personal][grado_estudios]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
										foreach($gradosestudio as $indice):
											$selected 			= ($indice['id'] == $item['grado_estudios']) ? 'selected' : '';
											echo '<option value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
										endforeach;
										?>
							</select>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Nombre de la carrera:</label>
							<input type="text" class="floating text-uppercase" placeholder="Nombre de la carrera"
								name="data[personal][carrera]" value="<?=$item['carrera']?>">
						</div>
						<div class="col-sm-12 col-lg-5 col-form-label">
							<label for="c_Nombre" class="textform">Institución:</label>
							<input type="text" class="floating text-uppercase" placeholder="Institución"
								name="data[personal][institucion]" value="<?=$item['institucion']?>">
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Año de egreso:</label>
							<select class="btn btn-secondary btn-block text-uppercase" data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[personal][fecha_egreso]"
								style="border: 1px solid #c9c9c9;">
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
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Número de cédula/Título:</label>
							<input type="text" class="floating text-uppercase" placeholder="Número de cédula/Título"
								name="data[personal][folio_titulo]" value="<?=$item['folio_titulo']?>">
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Grado profesional:</label>
							<select class="btn btn-secondary btn-block text-uppercase" data-select2-id="1" tabindex="-1"
								aria-hidden="true" name="data[personal][grado_profesion]"
								style="border: 1px solid #c9c9c9;">
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
			<div class="panel panel-default">
				<div class="gem-titulo ">
					<label>Datos del trabajador</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Departamento:</label>
							<?php if($this->session->userdata('rol_id') == 4){
                                        foreach ($departamento as $indice):
                                            if($indice['id'] == $item['departamento']){ ?>
							<input type="text" class="form-control text-uppercase" value="<?=$indice['nombre']?>"
								readonly>
							<?php }
                                        endforeach;
                                    } else { ?>
							<select class="btn btn-secondary btn-block  selectPadre text-uppercase" data-select2-id="1"
								data-dependiente="#area_id" data-metodo="<?=base_url('Registros/Registro/getArea')?>"
								id="departamentovalor" tabindex="-1" aria-hidden="true"
								name="data[personal][departamento]" style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php foreach ($departamento as $indice) {
                                                $selected = ($indice['id'] == $item['departamento']) ? 'selected' : '';
                                                echo '<option camponombre="' . $indice['nombre'] . '" value="' . $indice['id'] . '" '.$selected.'>' . $indice['nombre'].'</option>';
                                            }?>
							</select>
							<?php } ?>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Área:</label>
							<?php if($this->session->userdata('rol_id') == 4){
                                        foreach ($areas as $indice):
                                            if($indice['id'] == $item['area']){ ?>
							<input type="text" class="form-control text-uppercase" value="<?=$indice['nombre']?>"
								readonly>
							<?php }
                                        endforeach;
                                    } else { ?>
							<select class="btn btn-secondary btn-block text-uppercase" data-select2-id="1" tabindex="-1"
								aria-hidden="true" id="area_id" name="data[personal][area]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
                                            foreach($areas as $indice):
                                                $selected 			= ($indice['id'] == $item['area']) ? 'selected' : '';
                                                echo '<option valornom="' . $indice['nombre'] . '" value="'.$indice['id'].'" '.$selected.'>'.$indice['nombre'].'</option>';
                                            endforeach;
                                            ?>
							</select>
							<?php } ?>
						</div>
						<div class="col-sm-12 col-lg-4 col-form-label">
							<label for="c_Nombre" class="textform">Puesto:</label>
							<?php if($this->session->userdata('rol_id') == 4){
                                            foreach ($puestos as $indice):
                                                if($indice->id == $item['puesto_id']){ ?>
							<input type="text" class="form-control text-uppercase" value="<?=$indice->nombre?>"
								readonly>
							<?php }
                                            endforeach;
                                        } else { ?>
							<select class="btn btn-secondary btn-block text-uppercase" data-select2-id="1" tabindex="-1"
								aria-hidden="true" id="puesto" name="data[personal][puesto_id]"
								style="border: 1px solid #c9c9c9;">
								<option value="">Seleccionar</option>
								<?php
                                                foreach($puestos as $indice):
                                                    $selected 			= ($indice->id == $item['puesto_id']) ? 'selected' : '';
                                                    echo '<option value="'.$indice->id.'" '.$selected.'>'.$indice->nombre.'</option>';
                                                endforeach;
                                                ?>
							</select>
							<?php } ?>
						</div>
					</div><br>
					<div class="row">
					<div class="col-sm-12 col-lg-12 col-form-label">
							<label for="c_Nombre" class="textform">Observaciones:</label>
							<textarea type="text" class="form-control text-uppercase" placeholder="observaciones"
								name="data[personal][observaciones]"><?=$item['observaciones']?></textarea>
						</div>
					</div>
					<br>
					<div class="row" id="campo_laboratorista"
						<?=($item['puesto_id'] == 8) ? 'style="display: block;"' : 'style="display: none;"'?>>
						<div class="col-md-12">
							<div class="input-group text-uppercase">
								<span class="input-group-addon" id="basic-addon1">C.C.T. Asignado</span>
								<input type="text" id="tags" name="data[personal][cct_laboratorista]"
									class="form-control text-uppercase"
									placeholder="Escribe la clave o nombre del Centro de Trabajo"
									aria-describedby="basic-addon1" value="<?=$item['cct_laboratorista']?>">
							</div>
						</div>
					</div><br>
					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-12">
									<label class="textform">Horario:</label>
								</div>
							</div>
							<div>
								<table class="table">
									<?php foreach($dias_semana as $dia): ?>
									<tr>
										<td>
											<input class="form-check-input" type="checkbox" id=""
												<?=(($dia['data']['id'] != 0)) ? 'checked' : ''?>
												name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][dia]"
												value="<?=(!is_array($dia)) ? 0 : $dia['data']['cve_dia']?>">
											<label class="form-check-label text-uppercase textform"
												for=""><?=(!is_array($dia)) ? $dia : $dia['data']['dia']?></label>
										</td>
										<td>
											<?php
                                                $entrada = (is_array($dia)) ? explode('-', $dia['data']['horario']) : $dia = '00:00';
                                                ?>
											<input type="time" value="<?=(is_array($dia)) ? reset($entrada) : '00:00'?>"
												name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][entrada]">
											a
											<input type="time" value="<?=(is_array($dia)) ? end($entrada) : '00:00'?>"
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
						<input class="coupon_question" type="checkbox" name="coupon_question"
							value="1" />&nbsp;&nbsp;Acepto
						de conformidad, se realizó la
						validación y actualización
						correspondiente de los datos registrados en la plataforma del personal a cargo.</div>
					<fieldset class="question">

						<fieldset class="answer">
							<div class="row">
								<div class="col-md-4">
								</div>
								<div class="col-md-4">
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
<script type="text/javascript" src="<?=base_url('assets/js/jsedit/funciones.js')?>"></script>
<script>
	$(document).ready(function () {

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
</script>

<script type="text/javascript">
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
			errorElement: 'span',
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

	});

	function notificacion(error, mensaje) {
		var segmento = '<?=$this->uri->segment(2)?>';
		var base_url = '<?=base_url();?>registros/' + segmento + '/editar/<?=$item['
		id ']?>';
		if (error == 0) {
			swal(mensaje, {
				buttons: false,
				icon: "success",
				timer: 5000,
			}).then(function () {
				window.location.href = base_url;
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
	$(document).ready(function () {
		$('.consutaClaves').click(function (e) {
			e.preventDefault();
			var rfc = $('#rfc_id_edicion').val();
			rfc = rfc.toUpperCase();
			swal("Buscando claves presupuestales....", {
				buttons: false
			});
			$.ajax({
				url: '<?=base_url("Registros/Registro/wsNomina/")?>',
				type: 'POST',
				data: {
					rfc: rfc
				},
				//data: {rfc:'ROPR880801AR3'},
				success: function (data) {
					data = JSON.parse(data)
					$.ajax({
						url: '<?=base_url("Registros/Registro/editaClaves/")?>',
						type: 'POST',
						data: {
							claves: data.claves,
							fechaIngresoSistema: data.fechaIngresoSistema,
							personal_id: '<?=$item["id"]?>'
						},
						success: function (data) {
							console.log(data);
							swal("Operación exitosa", {
								icon: "success",
								buttons: false,
							});

							setTimeout(
								'document.location.reload()',
								3000
							);
						}
					})

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
				$('#tags').attr('required', true);
				$('#tags').val('');
				$('#campo_laboratorista').hide();
			}
		})

	})
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
<?php }?>
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