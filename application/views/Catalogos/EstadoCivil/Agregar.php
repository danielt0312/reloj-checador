<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Estado Civil / Agregar</label>
		</div>
	</div>
</div>
<br>
<div class="container">
	<a href="<?=base_url()?>Catalogos/EstadoCivil" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
	<form class="validacionGeneral" action="<?=base_url('Catalogos/EstadoCivil/Guardar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >
<hr>
	  <div class="form-group">
	    <label for="exampleFormControlInput1" class="textform text-uppercase">Nombre del estado civil:</label>
	    <input type="text" class="form-control required input-busqueda text-uppercase" required id="exampleFormControlInput1" name="nombre" placeholder="Escribir nombre del estado civil">
	  </div>
	  <input type="hidden" name="fecha_registro" value="<?=date('Y-m-d H:i:s')?>">
	  <input type="hidden" name="alta_baja" value="1">
	  <input type="submit" value="Registrar" class="btn btn-azulclaro">
	</form>
</div>
<div style="height: 400px;"></div>
