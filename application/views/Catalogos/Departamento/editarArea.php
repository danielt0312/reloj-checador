<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Departamento | <label class="text-muted">EDITAR AREA DE <?=$departamento[0]['nombre']?></label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <div style="height: 40px;"></div>
    <label class="page-container__title ">&nbsp;Catálogos: Departamento | <label class="text-muted">EDITAR AREA DE <?=$departamento[0]['nombre']?></label></label>
    <br>
    <a href="<?=base_url('Catalogos/Departamento/')?>" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    <hr>

</div>

<div class="container"><br>
    <form class="validacionGeneral" action="<?=base_url('Catalogos/Departamento/guardarArea')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >
        <div class="form-group">
            <label for="nombre_id" class="page-description">Nombre del area</label>
            <input type="text" class="form-control required input-busqueda" required id="nombre_id" name="nombre" placeholder="Escribir nombre del area">
        </div>
        <input type="hidden" name="departamento_id" value="<?=$departamento[0]['id']?>">
        <input type="submit" value="Registrar" class="btn btn-azulclaro">
    </form>
</div>


