<div style="height: 30px;"></div>
<div class="container">
	<a href="<?=base_url()?>Administracion/Menu">Regresar</a>
	<?php foreach ($consulta as $key) {?>
		<form class="validacionGeneral" action="<?=base_url()?>Administracion/Menu/Guardar/<?=$key['id']?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

		  <div class="form-group">
		    <label for="exampleFormControlInput1">Nombre del menú</label>
		    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" value="<?=$key['nombre']?>" placeholder="Escritir nombre del menú">
		  </div>
		  <input type="hidden" name="fecha_modificacion" value="<?=date('Y-m-d H:i:s')?>">
		  <input type="submit" value="Registrar" class="btn btn-info">
		</form>
	<?php }?>
</div>
<div style="height: 400px;"></div>
