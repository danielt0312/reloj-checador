<style type="text/css">
	.tooltip.top .tooltip-arrow{
		border-top-color: #F44336 !important;
	}
	.tooltip-inner {

    	background-color: #F44336 !important;
	}

	.label-danger{
		display: none;     background: #ff6f6b;
	    font-size: 15px;
	    color: #fff;
	    text-align: center;
	    font-weight: bold;
	}
	.label-success{
		display: none;     background: #9fd756;
	    font-size: 15px;
	    color: #fff;
	    text-align: center;
	    font-weight: bold;
	}
	.label-info{
		display: none;     background: #bc955c;
	    font-size: 15px;
	    color: #fff;
	    text-align: center;
	    font-weight: bold;
	}
</style>

<div class="contenedor-principal">
			<img src="<?=base_url()?>assets/img/inscripcion.png" class="img-responsive">
</div>
<div class="container">
				<p class="text-instrucciones">
					Llene el formulario de inscripción al proyecto <b>Diverticómputo</b>. Es muy importante verificar que <u>los datos que proporciona son correctos y vigentes</u>.
				</p>

	<div id="conocenos" class="bloque-index">
		<form class="form-inline validaFormulario" action="<?=base_url('Inicio/nuevoRegistro')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-10"></div>
				<div class="col-md-1 paneltabla"><i class="fa fa-user" aria-hidden="true"></i></div>
			</div>
			<div class="panel panel-default">
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
												<img src="<?= base_url();?>assets/img/usuario.png" width="150" height="150" id="peviavista"/>
											</label>
											<input id="file-input" type="file" accept="image/*" onchange="showMyImage(this)"/>
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
										<input type="text" maxlength="18" minlength="18" class="inputs uppercase field usuario required limpiarregistro"  name="data[usuario][curp]" id="curp_id" placeholder="Escribir CURP">
									</div>
									<div class="col-sm-2">
										<a id="btn_valida_curp" class="btn btn-gris btn-block">Validar CURP</a>
									</div>
									<div class="col-sm-2">
										&nbsp;<span id="curp_label" class="label label-danger">CURP NO VALIDADO</span>
						                &nbsp;<span id="curp_registrada_anteriormente" class="label label-danger" style="display: none;">CURP YA REGISTRADA</span>
						                &nbsp;<span id="curp_error" class="label label-danger" style="display: none;">ERROR EN LA VALIDACIÓN</span>
									</div>
								</div><br>
								<div class="row">
									<div class="col-sm-1">
										<label class="grisfor" for="">Nombre(s):</label>
									</div>
									<div class="col-sm-3">
										<input type="text" name="data[usuario][nombre]" class="limpiarregistro inputs uppercase field nombre_usuario redonly usuario" readonly>
									</div>
									<div class="col-sm-1">
										<label class="grisfor" for="">Apellido Paterno:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="data[usuario][apellido_paterno]" class="limpiarregistro inputs uppercase field apellido_paterno redonly usuario" readonly>
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Apellido Materno:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="data[usuario][apellido_materno]" class="limpiarregistro inputs uppercase field apellido_materno redonly usuario" readonly>
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Nombre de Usuario:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="data[usuario][usuario]" class="limpiarregistro inputs uppercase field required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Correo electrónico:</label>
								</div>
								<div class="col-sm-3">
										<input type="email" name="data[usuario][correo]" class="inputs uppercase field required" id="correo_uno">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Confirmar Correo electrónico:</label>
								</div>
								<div class="col-sm-3">
										<input type="email" name="confirmar_correo" class="inputs uppercase field required" id="correo">
										<div id="message"></div>
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Contraseña:</label>
								</div>
								<div class="col-sm-3">
										<input type="password" name="data[usuario][password]" class="inputs uppercase field required" id="pass_uno">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Confirmar contraseña:</label>
								</div>
								<div class="col-sm-3">
										<input type="password" name="confirmar_password" class="inputs uppercase field required" id="pass"><div id="msg"></div>
								</div>
						</div>
					</div>
				</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-1 paneltabla"><i class="fa fa-home" aria-hidden="true"></i></div>
				</div>
			<div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
								<label class="grisclaro2">DATOS DE LA ESCUELA</label>
						</div>
		     	<div class="panel-body">
						<div class="row">
							<div class="col-sm-1">
									<label class="grisfor" for="">Nombre de la Escuela:</label>
							</div>
							<div class="col-sm-11">
									<input type="text" name="data[ct][nombre]" class="inputs uppercase field required">
							</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Clave del centro de trabajo:</label>
								</div>
								<div class="col-sm-4">
										<input type="text" name="data[ct][cct]" class="inputs uppercase field escuela required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Turno:</label>
								</div>
								<div class="col-sm-2">
									<select name="data[ct][turno]" class="inputs uppercase field escuela required">
										<option style="display: none;" selected>-Seleccionar-</option>
										<?php
										foreach($turnos as $turno):
											echo '<option value="'.$turno['Turno'].'">'.$turno['Desc_Turno'].'</option>';
										endforeach;
										?>
									</select>
										<!--<input type="text" name="data[ct][turno]" class="inputs uppercase field escuela required">-->
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Sector:</label>
								</div>
								<div class="col-sm-1">
										<input type="text" name="data[ct][sector]" class="inputs uppercase field required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Zona:</label>
								</div>
								<div class="col-sm-1">
										<input type="text" name="data[ct][zona]" class="inputs uppercase field required">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Teléfono:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="data[ct][telefono]" class="inputs uppercase field required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Estado:</label>
								</div>
								<div class="col-sm-3">
									<select name="data[ct][estado]" class="inputs uppercase field required selectPadre" data-dependiente="#municipio_id" data-metodo="getMunicipio" id="estadovalor">
										<option value="">-Seleccionar-</option>
										<?php foreach ($estados as $key) {
                                                echo '<option  camponombre="' . $key['nombre'] . '" value="' . $key['id'] . '">' . $key['nombre'].'</option>';
                                        } ?>
									</select>
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Municipio:</label>
								</div>
								<div class="col-sm-3">
									<select name="data[ct][municipio]" class="inputs uppercase field required selectPadre" data-dependiente="#localidad_id" data-metodo="getLocalidad" id="municipio_id">
										<option value="" selected>-Seleccionar-</option>
									</select>

								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Localidad:</label>
								</div>
								<div class="col-sm-3">
									<select name="data[ct][localidad]" class="inputs uppercase field required" id="localidad_id">
										<option value=""  selected>-Seleccionar-</option>
									</select>
									<div class="otralocalidad" style="display: none;">
										<label class="grisfor" for="">Otra Localidad:</label><input type="text" name="data[ct][otra_localidad]" class="inputs uppercase field required" value="">
									</div>									
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Clave de Red ILCE:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="data[ct][clave_redilce]" class="inputs uppercase field">
											Este campo no es obligatorio
								</div>
						</div><br>
		     	</div>
		    </div>
				<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-1 paneltabla"><i class="fa fa-users" aria-hidden="true"></i></div>
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
										<input type="text" name="data[ct][grado]" class="inputs uppercase field required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Grupo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" name="data[ct][grupo]" class="inputs uppercase field required">
								</div>
						</div><br>
						<div class="row">
								<div class="col-sm-1">
										<label class="grisfor" for="">Número de alumnos del equipo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" name="data[ct][num_alumnos]" class="inputs uppercase field required">
								</div>
								<div class="col-sm-1">
										<label class="grisfor" for="">Nombre del Equipo:</label>
								</div>
								<div class="col-sm-5">
										<input type="text" name="data[ct][nombre_equipo]" class="inputs uppercase field required">
								</div>
						</div>
		     	</div>
		    </div>

		    	<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-1 paneltabla"><i class="fa fa-address-book-o" aria-hidden="true"></i></div>
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
										<input type="text" name="data[ct][responsable_aulamedios]" class="inputs uppercase field required">
								</div>
								<div class="col-sm-2">
										<label class="grisfor" for="">Correo Eléctronico del Responsable de Aula de Medios:</label>
								</div>
								<div class="col-sm-4">
										<input type="email" name="data[ct][correo_respaulamedios]" class="inputs uppercase field required">
								</div>
						</div>
		     	</div>
		    </div>

		    	<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-1 paneltabla"><i class="fa fa-star"></i></div>
				</div>
		    <div class="panel panel-default coo">
		      	<div class="panel-heading panelgris">
							 <label class="grisclaro2">DATOS IMPORTANTES</label>
						</div>
		     	<div class="panel-body">
					    <div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">Número de computadoras</label>
							<input type="text" class="inputs required" name="data[ct][num_computadoras] " >
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Cuántas horas a la semana acude el grupo al aula de medios?</label>
							<input type="text" class="inputs required" name="data[ct][horas_aulamedios]" >
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Porqué se inscribieron en este proyecto?</label>
							<textarea type="text" class="inputs required" name="data[ct][porque_seinscribieron]"  rows="5" style="width: 100%; height: 100%;"></textarea>
						</div>
						<div class="col-sm-6 input-field">
						  	<label for="nombre" class="grisfor">¿Qué esperan de este proyecto?</label>
							<textarea type="text" class="inputs required" name="data[ct][que_esperan]"  rows="5" style="width: 100%; height: 100%;"></textarea>
						</div>

		     	</div>
		    </div>
		    <input type="hidden" name="data[usuario][fecha_registro]" value="<?=date('Y-m-d H:i:s')?>">
		    <input type="hidden" name="data[usuario][alta_baja]" value="1">
		    <input type="hidden" name="data[usuario][rol_id]" value="3">
		    <input type="hidden" name="data[ct][fecha_registro]" value="<?=date('Y-m-d H:i:s')?>">
		    <input type="hidden" name="data[ct][alta_baja]" value="1" >
		    <input type="hidden" name="data[ct][nombre_estado]"    id="id_nombreestado" value="" >
		    <input type="hidden" name="data[ct][nombre_municipio]" id="id_nombremunicipio" value="" >
		    <input type="hidden" name="data[ct][nombre_localidad]" id="id_nombrelocalidad" value="" >

		<center><input type="submit" value="Registrar" class="btn btn-azulclaro btn-block"></center>
		</form>
	</div>
</div>

<script type="text/javascript">
 function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img=document.getElementById("peviavista");
            img.file = file;
            var reader = new FileReader();
            reader.onload = (function(aImg) {
                return function(e) {
                    aImg.src = e.target.result;
                };
            })(img);
            reader.readAsDataURL(file);
        }
    }
</script>
<script type="text/javascript">
	//validación de formularios
    $('.validaFormulario').validate({
        errorElement: 'span',
        submitHandler: function(form) {
            var data = new FormData();
            var url             = $('.validaFormulario').attr('action');
            jQuery.each($('input[type=file]')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });
            var other_data = $('.validaFormulario').serializeArray();
            $.each(other_data,function(key,input){
                data.append(input.name,input.value);
            });

            $.ajax({
            	url: url,
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()  {

                    swal({
                        title: "Espere por favor...",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })

                },
                success: function(data) {

                    var objeto              = JSON.parse(data);
                    $.each(objeto, function(i, item)    {

                        notificacion(item.error, item.mensaje);

                    })

                }
            })
        }
    });

    $('.selectPadre').change(function(e)  {
        var elemento_dependiente            = $(this).data('dependiente');
        var metodo                          = $(this).data('metodo');
        var seleccionado                    = $(this).val();
        var option                          = "";

        $.ajax({
            url: metodo,
            type: 'POST',
            data: { valor:seleccionado },
            beforeSend: function()  {
                swal('Buscando...');
            },
            success: function(data) {

                var objeto      = JSON.parse(data);
                option += '<option>-Seleccionar-</option>';
                $.each(objeto, function(i, item)    {
                    option += '<option valornom="'+item.legend+'" value="'+item.value+'">'+item.legend+'</option>';
                })
                if (elemento_dependiente=='#localidad_id') {
                	option += '<option value="otra_localidad_id">Otra Localidad</option>';
                }

                swal.close();
                $(elemento_dependiente).empty();
                $(elemento_dependiente).html(option);

            }
        })

    })

});

function notificacion(error, mensaje)    {
var base_url = 'http://' + location.hostname + '/proyectodiverticomputo/Inicio/Registro'; 
    if(error == 0)  {
    	 swal(mensaje, {
            buttons: false,
            icon: "success",
            timer: 3000,                      
          }).then(function() {
                window.location.href = base_url;
          }); 

    }else if(error == 1)    {

        swal(mensaje, {
            icon: "warning"

        });

    }

}
</script>
<script type="text/javascript">
    $('#correo').on('keyup', function() {
        if ($('#correo_uno').val() == $('#correo').val()) {
            if ($('#correo_uno').val().length > 0 && $('#correo').val().length > 0) {
                $('#message').html('').css('color', 'green');
            } else {
                $('#message').html('No coincide').css('color', 'red');
            }
        } else {
            $('#message').html('No coinciden correos').css('color', 'red');
        }
    });
    $('#pass').on('keyup', function() {
        if ($('#pass_uno').val() == $('#pass').val()) {
            if ($('#pass_uno').val().length > 0 && $('#pass').val().length > 0) {
                $('#msg').html('').css('color', 'green');
            } else {
                $('#msg').html('No coincide').css('color', 'red');
            }
        } else {
            $('#msg').html('No coinciden contraseñas').css('color', 'red');
        }
    });

</script>



<script>
	$(function(){
  	$(document).on('change','#estadovalor',function(){ 
  		var dataid = $("#estadovalor option:selected").attr('camponombre');
      	$('#id_nombreestado').val(dataid);
    });
    $(document).on('change','#municipio_id',function(){ 
    	var dataid = $("#municipio_id option:selected").attr('valornom');
      $('#id_nombremunicipio').val(dataid);
    });
    $(document).on('change','#localidad_id',function(){ 
    	var dataid = $("#localidad_id option:selected").attr('valornom');
    	var otraloc = $('#localidad_id').val();
        $('#id_nombrelocalidad').val(dataid);
	    if (otraloc=='otra_localidad_id') {	    	
       		$('.otralocalidad').show();
	    }
	    else{
	    	$('.otralocalidad').hide();
	    }
    });
  });
</script>