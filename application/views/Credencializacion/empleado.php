<?php if($error == 0){ ?>

    <div class="col-md-12 mb5">
        <div class="panel panel-default">
            <div class="panel-heading">Datos del empleado</div>
            <div class="panel-body">
                <p><label for="">Ubicación: </label> <?=$personal->lote_id?></p>
                <p><label for="">RFC: </label> </p>
                <p><label for="">Nombre(s): </label> <?=$personal->nombre?></p>
                <p><label for="">Apellido(s): </label> <?=$personal->apellido_paterno.' '.$personal->apellido_materno?></p>
                <p><label for="">Departamento: </label> <?=$departamento?></p>
                <p><label for="">Área: </label> <?=$area?></p>
                <p><label for="">Puesto: </label> <?=$puesto?></p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb5">
        <div class="panel panel-default">
            <div class="panel-heading">Archivos

                <div class="btn-group" role="group" aria-label="..." style="float: right;">
                    <a href="<?=base_url('credencializacion/generar-archivos/'.$personal->id.'/'.$personal->lote_id)?>" id="generar-archivos" class="btn btn-primary btn-sm" title="Generar imágenes"><i class="fa fa-image"></i></a>
                    <?php if($personal->estatus_id == 2){ ?>
                        <a href="<?=base_url('credencializacion/descargar-archivos/'.$personal->id.'/'.$personal->lote_id.'/'.$personal->personal_id)?>" id="descargar-archivos" class="btn btn-primary btn-sm" title="Descargar archivos"><i class="fa fa-download"></i></a>
                    <?php } ?>
                </div>

            </div>
            <div class="panel-body" id="contenido-archivos">
                <div class="row">
                    <div class="col-md-6" style="text-align: center;">
                        <?php if(file_exists('assets/credencializacion/'.$personal->lote_id.'/'.$personal->img_a)){ ?>
                            <a href="" class="fa fa-id-card" style="font-size: 10em;"></a>
                        <?php } else {?>
                            <a href="" class="fa fa-folder-open" style="font-size: 10em;"></a>
                        <?php } ?>
                        <p for="">Frontal</p>
                    </div>
                    <div class="col-md-6" style="text-align: center;">
                        <?php if(file_exists('assets/credencializacion/'.$personal->lote_id.'/'.$personal->img_b)){ ?>
                            <a href="" class="fa fa-qrcode" style="font-size: 10em;"></a>
                        <?php } else {?>
                            <a href="" class="fa fa-folder-open" style="font-size: 10em;"></a>
                        <?php } ?>
                        <p for="">Trasera</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">No se encontraron datos.</div>
<?php } ?>
