<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogo: Motivos Baja / <label class="">Nuevo Registro</label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <a href="<?=base_url('Catalogos/MotivosBajas')?>" class="btn btn-azul" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    <hr>

    <div class="row">
        <?php
        $id = (isset($registro[0]->id)) ? $registro[0]->id : null;
        ?>
        <form class="" action="<?=base_url('Catalogos/MotivosBajas/guardar/'.$id)?>" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="textform text-uppercase">Nombre Estatus:</label>
                <input type="text" class="form-control required text-uppercase" required id="" name="nombre" placeholder="Descripción del motivo de baja" value="<?=(isset($registro[0]->nombre)) ? $registro[0]->nombre : ''?>">
            </div>

            <div class="form-group">
                <select class=" btn btn-secondary btn-block required" name="estatus_id" style="">
                    <option value="">Seleccionar</option>
                    <?php
                    foreach($estatus as $item):
                        if(isset($registro[0]->estatus_id)){
                            $selected = ($registro[0]->estatus_id == $item->id) ? 'selected' : '';
                            echo '<option value="'.$item->id.'" '.$selected.'>'.$item->nombre.'</option>';
                        }else{
                            echo '<option value="'.$item->id.'">'.$item->nombre.'</option>';
                        }

                    endforeach; ?>
                </select>
            </div>

            <input type="submit" value="Registrar" class="btn btn-azulclaro">

        </form>
    </div>
    <div style="height: 400px;"></div>

</div>