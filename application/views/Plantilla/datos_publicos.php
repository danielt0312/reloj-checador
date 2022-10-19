<div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px;">

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Datos del Personal</h3>
                    </div>
                    <div class="panel-body">

                        <?php if($estatus->nombre_estatus == 'ACTIVO') {?>
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-responsive" src="<?=(is_file(substr($personal->foto, 1))) ? base_url($personal->foto) : base_url('assets/img/usuario.png')?>        " alt="">
                            </div>
                            <div class="col-md-9">

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><b>Nombre(s): </b><?=$personal->nombre.' '.$personal->apellido_paterno.' '.$personal->apellido_materno?></p>
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Sexo: </b><?=$personal->sexo?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><b>Estado: </b><?=$estado->nombre?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>Municipio: </b><?=$municipio->nombre?></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>Departamento: </b><?=$departamento->nombre?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>Área: </b><?=$area->nombre?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>Puesto: </b><?=$puesto->nombre?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php } else{ ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive" src="<?=base_url('assets/img/usuario.png')?>" alt="">
                                </div>
                                <div class="col-md-9">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><b>Nombre(s): </b>Información no disponible
                                        </div>
                                        <div class="col-md-2">
                                            <p><b>Sexo: </b>Información no disponible</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><b>Estado: </b>Información no disponible</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>Municipio: </b>Información no disponible</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><b>Departamento: </b>Información no disponible</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>Área: </b>Información no disponible</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><b>Puesto: </b>Información no disponible</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="panel-footer">
                        <b>Estatus del personal: </b><?=($estatus->nombre_estatus == 'ACTIVO') ? $estatus->nombre_estatus : 'Información no disponible'?>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>