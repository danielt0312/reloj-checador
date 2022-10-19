<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Tipo de Sangre / Editar</label>
		</div>
	</div>
</div>
<br>
<div class="container">
	<a href="<?=base_url()?>Catalogos/TipoSangre" class="btn btn-azul"><i class="fa fa-chevron-left"
			aria-hidden="true"></i> Regresar</a>
	<?php foreach ($consulta as $key) {?>
	<form class="validacionGeneral" action="<?=base_url()?>Catalogos/TipoSangre/Guardar/<?=$key['id']?>" method="POST"
		onKeypress="if(event.keyCode == 13) event.returnValue = false;">
		<hr>
		<div class="form-group">
			<label for="exampleFormControlInput1" class="textform text-uppercase">Nombre del tipo de sangre:</label>
			<input type="text" class="form-control required input-busqueda text-uppercase" required
				id="exampleFormControlInput1" name="nombre" value="<?=$key['nombre']?>"
				placeholder="Escritir nombre del tipo de sangre">
		</div>
		<input type="hidden" name="fecha_modificacion" value="<?=date('Y-m-d H:i:s')?>">
		<input type="submit" value="Registrar" class="btn btn-azulclaro">
	</form>
	<?php }?>
</div>
<div style="height: 400px;"></div>