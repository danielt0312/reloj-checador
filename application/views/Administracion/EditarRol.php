<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: roles - editar</label>
	<br>
	<a href="<?=base_url()?>Administracion/Roles" class="btn btn-azul">/ Regresar</a>
	<?php foreach ($consulta as $key) {?>
		<form class="validacionGeneral" action="<?=base_url()?>Administracion/Roles/Guardar/<?=$key['id']?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

		  <div class="form-group">
		    <label for="exampleFormControlInput1" class="page-description">Nombre del rol</label>
		    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" value="<?=$key['nombre']?>" placeholder="Escritir nombre del rol">
		  </div>
		  <input type="hidden" name="fecha_modificacion" value="<?=date('Y-m-d H:i:s')?>">
		  <input type="submit" value="Registrar" class="btn btn-azulclaro">
		</form>
	<?php }?>
</div>
<div style="height: 400px;"></div>
