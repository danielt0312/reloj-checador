<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Departamento / <label class="">NUEVA ÁREA DE <?=$departamento[0]['nombre']?></label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <a href="<?=base_url('Catalogos/Departamento/Areas/'.$departamento[0]['id'])?>" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    <hr>

</div>

<div class="container mb5"><br>
    <form class="validacionGeneral" action="<?=$url_form?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

        <div class="form-group">
            <label for="nombre_id" class="textform text-uppercase">Nombre del área:</label>
            <input type="text" class="form-control required input-busqueda text-uppercase" required id="nombre_id" name="nombre" placeholder="Escribir nombre del área" value="<?=(isset($area)) ? $area[0]->nombre : ''?>">
        </div>

        <div class="form-group">
            <label for="nombre_id" class="textform text-uppercase">Estatus</label>
            <select name="estatus_id" id="estatus_id" class="form-control">
                <?php foreach($estatus as $item_estatus):
                    $selected = (isset($area[0]->estatus_id) && $item_estatus == $area[0]->estatus_id) ? 'selected' : '';
                    echo '<option value="'.$item_estatus->id.'" '.$selected.'>'.$item_estatus->nombre.'</option>';
                endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="departamento_id" value="<?=$departamento[0]['id']?>">
        <input type="submit" value="Registrar" class="btn btn-azulclaro">
    </form>
    <div style="height: 400px;"></div>
</div>