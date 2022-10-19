$(document).ready(function(){
	var base_url = 'http://' + location.hostname + '/rh';

	$('#btn_valida_curp').on('click', function(){
		var curp = $('#curp_id').val();
 		var validarepetido = $(this).data('valicaduplicado');
 		console.log(validarepetido);
		$('#curp_label').show().removeClass('label-danger').addClass('label-info');
		$('#curp_label').html('VALIDANDO CURP...');
		$('#curp_registrada_anteriormente').hide();

		$.post(base_url + '/Registros/Registro/webServiceCurp', { curp : curp })
			.done(function(resp){
				var json = JSON.parse(resp);
				if(validarepetido === undefined || validarepetido == true){
					var valida_duplicado = json.duplicado
				}else{
					var valida_duplicado = false
				}
				if (valida_duplicado == true) {
					$('#curp_label').hide();
					$('#curp_registrada_anteriormente').show();
					$('.apellido_paterno').val("");
					$('.apellido_materno').val("");
					$('.nombre_usuario').val("");
				}
				else{
					if (json.renapo.Curp[0] != null && json.renapo.Curp[0] != 'R') {
						$('#curp_label').removeClass('label-info').addClass('label-success');
						$('#curp_label').html('CURP VÁLIDO');
						$('#curp_registrada_anteriormente').hide();
							$('.apellido_paterno').val(""+json.renapo.Apellido1[0]);
							$('.apellido_materno').val(""+json.renapo.Apellido2[0]);
							$('.nombre_usuario').val(""+json.renapo.NombreS[0]);
						if(json.renapo.Sexo[0] == 'M'){
							//$('#genero').val("1").removeAttr('name').attr('disabled', 'disabled');
							$('#sexo').val('M');
						} else{
							//$('#genero').val("2").attr('disabled', 'disabled');
							$('#sexo').val('H');
						}
						$('.btnguarda').removeAttr('disabled');
					}
					else {
						$('#curp_label').removeClass('label-info').addClass('label-danger');
						$('#curp_label').html('CURP NO VALIDADO POR RENAPO');
						$('#curp_id').val('');

							if(json.renapo.Curp[0] == 'R'){
								console.log(json.renapo.Curp[0]);
								$('#curp_label').hide().removeClass('label-info').addClass('label-danger');
								$('#curp_error').show();
								$('#curp_id').val('');
							}
						$('.apellido_paterno').val("");
						$('.apellido_materno').val("");
						$('.nombre_usuario').val("");
						$('#sexo').val("");
					}

				}
			})
		.fail(function(){
			alert('Problemas en el Servidor, por favor contacte al personal de soporte.');
		});
	});

	$('#rfc_id').blur(function(){
		var rfc = $('#rfc_id').val();
		rfc = rfc.toUpperCase();
		swal('Buscando RFC...');
		$.ajax({
			url: 'wsNomina',
			type: 'POST',
			data: {rfc:rfc},
			//data: {rfc:'ROPR880801AR3'},
			success: function(data){
				data = JSON.parse(data)
				console.log(data);
				$('#claves_presupuestales').empty();
				if(data.fechaIngresoSistema){
					var fechaIngresoSistema = data.fechaIngresoSistema;
					$('#fechaIngresoSistema').val(fechaIngresoSistema.substr(0,4)+'-'+fechaIngresoSistema.substr(4,2)+'-01');
					$('#fechaIngresoSistema').attr('readonly',true);
					$('#fechaIngresoSistema').attr('type', 'text');
					$('#fechaIngresoSistema').addClass('redonlyform');
					$.each(data.claves, function(i, item){
						$('#claves_presupuestales').append('<input type="text" class="form-control" readonly name="data[claves]['+item.ct+'_'+i+']" value="'+item.clave+'"><br>');

					})
				}else{
					$('#fechaIngresoSistema').val('');
					$('#fechaIngresoSistema').attr('readonly',false);
					$('#fechaIngresoSistema').removeClass('redonlyform');
					$('#fechaIngresoSistema').attr('type', 'date');
					$('#claves_presupuestales').append('No Aplica');
				}


				swal.close();

			}
		})
	})

});
