<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Reloj checador: Panel de control / <label class=""> Generar correos</label>
		</div>
	</div>
</div>
<br>

<div class="container">
    <a href="<?=base_url('Reloj/DepuredControl')?>" class="btn btn-azul" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    <hr>
    <div class="row">
        <div class="col-sm-12 col-lg-6 col-form-label">
            <form class="validaFormulario" action="<?=base_url('Reloj/Correos/getDatos')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" enctype="multipart/form-data">
                <label class="textform">Generar correos de:</label><br>
                <div class="form-check">
                    <input type="checkbox" name="data[personal][<?= $correos[0]['id']?>]" class="form-check-input" value="<?= $correos[0]['nombre']?>"> <?= $correos[0]['nombre']?> <br>
                    <input type="checkbox" name="data[personal][<?= $correos[1]['id']?>]" class="form-check-input" value="<?= $correos[1]['nombre']?>"> <?= $correos[1]['nombre']?> <br>
                    <input type="checkbox" name="data[personal][<?= $correos[2]['id']?>]" class="form-check-input" value="<?= $correos[2]['nombre']?>"> <?= $correos[2]['nombre']?> <br>
                    <input type="checkbox" name="data[personal][<?= $correos[3]['id']?>]" class="form-check-input" value="<?= $correos[3]['nombre']?>"> <?= $correos[3]['nombre']?> <br>
                    <input type="checkbox" name="data[personal][<?= $correos[4]['id']?>]" class="form-check-input" value="<?= $correos[4]['nombre']?>"> <?= $correos[4]['nombre']?> <br>
                </div>
                <div style="height: 20px;"></div>
                <input type="submit" value="Aceptar" class="btn btn-azulclaro">
            </form>
        </div>
    </div>
    
    <div style="height: 230px;"></div>
</div>

<script>
    $(document).ready(function () {
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
					alert(input.name);
                    alert(input.value);
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
							buttons: false,
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
    });

    function notificacion(error, mensaje) {
        var base_url = '<?=base_url('Reloj/DepuredControl')?>';
		if (error == 0) {
			swal(mensaje, {
				buttons: false,
				icon: "success",
				timer: 3000,
			}).then(function () {
				window.location.href = base_url;
			});

		} else if (error == 1) {
			swal(mensaje, {
				icon: "warning",
				buttons: false,
				timer: 3000,
			});
		}
	}
</script>
