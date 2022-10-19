<style type="text/css">
	.tooltip.top .tooltip-arrow{
		border-top-color: #F44336 !important;
	}
	.tooltip-inner {
    	
    	background-color: #F44336 !important;
	}
</style>

<div class="container"><br>
	<div id="conocenos" class="bloque-index">
		<form class="form-inline validaFormulario CorreoRestablece" action="<?=base_url('Inicio/RestaurarUsuario')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;">

			<div class="panel panel-default coo">
				<div class="panel-heading panelgris">
					<label class="grisclaro2">DATOS PERSONALES DE LA CUENTA</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="row">
								<div class="col-sm-1"></div>
								<div class="col-sm-4">
										<label class="grisfor" for="">Correo con el que se registro la cuenta:</label>
								</div>
								<div class="col-sm-3">
										<input type="text" name="correo" class="inputs uppercase field required">
								</div>
						</div><br>
					</div>
				</div>
			</div>	
		<input type="submit" value="Enviar" class="btn btn-info">
		</form>
	</div>
</div>
