<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"/> -->

<div class="contenedor-principal">
    <div class="titulo-principal shadow fondo">
        <div class="container contao ">
            <label>Reloj Checador: Vista principal</label>
        </div>
    </div>
</div>
<br>
<div class="container">
    <?= $this->session->userdata('rol_id') != 6 ? "<a href=".base_url('Reloj/Huella/opciones')." class='btn btn-azul' ><i class='fa fa-plus' aria-hidden='true'></i> Huella</a><hr>" : ''?>
    
    <div>
		<div class="form-group">
			<label for="exampleFormControlInput1" class="textform text-uppercase">Ingresa la huella (código)</label>
			<input type="text" class="text-uppercase huella" id="huella" placeholder="HUELLA" required>
		</div>
		<button type="button" id="" class="btn btn-azul asistencia">Enviar</button>	
	</div>

    <div style="height: 250px;"></div>
</div>


<!--Modal VISTA-->
<div id="modalDetalleUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header gem-titulo">
                <button type="button" class="close" style="opacity:1;color:black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="bodyModal">
			</div>

            <div class="modal-footer">
                <!-- <a href="#" target="_blank" class="btn btn-azul" id="personalPdf">Imprimir</a> -->
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<script>
	$(document).on('click', '.asistencia', function(e){
		var data = new FormData();
		var id = document.getElementById("huella").value;
		var url = '<?=base_url('Reloj/Vista/respuesta/')?>'+id;

		$.ajax({
			url: url,
			type: 'POST',
			beforeSend: function () {
				swal({
					title: "Espere por favor...",
					buttons: false,
					timer: 3000,
				})
			},
			success: function (data) {
				var objeto = JSON.parse(data);
				$.each(objeto, function (i, item) {
					notificacion(item.error, item.mensaje);
				})
			},
		})
	})

	function notificacion(error, mensaje) {
		var base_url = '<?=base_url();?>Reloj/Vista';
		if (error == 0) {
			swal(mensaje, {
				buttons: false,
				icon: "success",
				timer: 3000,
			}).then(function () {
				$('#modalDetalleUsuario').modal('show');
				var huella = document.getElementById("huella").value;
				var url = '<?=base_url('Reloj/Vista/modalHuella/')?>'+huella;
				$.ajax({
					url: url,
					type: 'POST',
					success: function(data){
						$('#bodyModal').empty();
						$('#bodyModal').html(data);
					}
				})
				$(".form-group #huella").val('');
			});

		} else if (error == 1) {
			swal(mensaje, {
				icon: "warning",
				buttons: false,
				timer: 3000,
			}).then(function () {
				window.location.href = base_url;
			});
		} else {
            swal(mensaje, {
				icon: "warning",
				buttons: false,
				timer: 3000,
			}).then(function () {
				window.location.href = base_url;
			});
        }
	}
</script>