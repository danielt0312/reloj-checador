<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: Submenú - Agregar</label>
	<br>
	<a href="<?=base_url()?>Administracion/Submenu" class="btn btn-azul">/ Regresar</a>
	<hr>
	<form class="validacionGeneral" action="<?=base_url('Administracion/Submenu/Guardar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

	  <div class="form-group">
	    <label for="exampleFormControlInput1" class="page-description">Nombre del Submenu</label>
	    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" placeholder="Escritir nombre del Submenu">
	  </div>
	  <input type="hidden" name="fecha_registro" value="<?=date('Y-m-d H:i:s')?>">
	  <input type="hidden" name="alta_baja" value="1">
	  <input type="submit" value="/ Registrar" class="btn btn-azulclaro">
	</form>
</div>
<div style="height: 400px;"></div>