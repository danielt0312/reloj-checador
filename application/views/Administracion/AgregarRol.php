<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: Rol - Agregar</label>
	<br>
	<a href="<?=base_url()?>Administracion/Roles" class="btn btn-azul">/ Regresar</a>
	<form class="validacionGeneral" action="<?=base_url('Administracion/Roles/Guardar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >
<hr>
	  <div class="form-group">
	    <label for="exampleFormControlInput1" class="page-description">Nombre del rol</label>
	    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" placeholder="Escritir nombre del rol">
	  </div>
	  <input type="hidden" name="fecha_registro" value="<?=date('Y-m-d H:i:s')?>">
	  <input type="hidden" name="alta_baja" value="1">
	  <input type="submit" value="/ Registrar" class="btn btn-azulclaro">
	</form>
</div>
<div style="height: 400px;"></div>
