<style>
    .titulo{
        padding-left: 15px;
    padding-top: 5px;
    color: rgb(0, 0, 0);
    font-size: 23px;
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: bold;
    text-transform: uppercase;
    }
</style>
<div class="row mb10">
<div class="col-md-12">
    <div class="col-md-12 titulo">
        DATOS personales
        <hr>
    </div>
    <div class="col-md-4 mb5">
        <img class="img-responsive shadow" src="
        <?=(is_file(substr($personal->foto, 1))) ? base_url($personal->foto).'?' : base_url('assets/img/usuario.png')?>
        " alt="">
    </div>

    <div class="card">
        <div class="card-body">
            <div class="col-md-8">
                <p class="textform"><b>NOMBRE:</b></p>
                <p for=""><span class="text-muted "><?=$personal->nombre.' '.$personal->apellido_paterno.' '.$personal->apellido_materno?></span></p>
            </div>
            <div class="col-md-6">
                <p class="textform"><b>CURP:</b></h7>
                <p for="" class="text-muted"><?=$personal->curp?></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>RFC:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->rfc?></span></p>
            </div>
            
            <div class="col-md-4">
                <p class="textform"><b>SEXO:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->sexo?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>ESTADO CIVIL:</b></h7>
                <p for=""><span class="text-muted "><?=(array_key_exists(0, $estado_civil)) ? $estado_civil[0]->nombre : '---'?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>HIJOS:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->hijos?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>GRUPO SANGUÍNEO:</b></h7>
                <p for=""><span class="text-muted "><?=(array_key_exists(0, $tipo_sanguineo)) ? $tipo_sanguineo[0]->nombre : '---'?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>TELÉFONO:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->telefono?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>ESTATUS:</b></h7>
                <p for=""><span class="text-muted "><?=(array_key_exists(0, $estatus)) ? $estatus[0]->nombre_estatus : '---'?></span></p>
            </div>
            <div class="col-md-4" <?=($estatus[0]->nombre_estatus == 'ACTIVO') ? 'hidden': ''?>>
                <p class="textform"><b>MOTIVO DE BAJA:</b></h7>
                <p for=""><span class="text-muted "><?=(array_key_exists(0, $estatus)) ? $estatus[0]->nombre_motivo : '---'?></span></p>
            </div>
            <div class="col-md-4" <?=($estatus[0]->nombre_estatus == 'ACTIVO') ? 'hidden': ''?>>
                <p class="textform"><b>FECHA BAJA:</b></h7>
                <?php if(array_key_exists(0, $estatus)) { ?>
                    <p for=""><span class="text-muted " ><?=($estatus[0]->nombre_estatus == 'INACTIVO') ? $estatus[0]->fecha_baja : '---'?></span></p>
                <?php } ?>

            </div>
            <div class="col-md-4">
                <p class="textform"><b>FECHA INGRESO SISTEMA:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->fecha_ingreso_sistema?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>FECHA INGRESO C.T.:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->fecha_ingreso_ct?></span></p>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4 ml-2">
                <p class="textform"><b>DEMANDA:</b></h7>
                <p for=""><span class="text-muted "><?=($personal->demanda == 1) ? 'SI' : 'NO'?></span></p>
            </div>
            <div class="col-md-6"<?=($personal->demanda == '1') ? '' : 'style="display: none;"'?>>
                <p class="textform"><b>OBSERVACION DEMANDA:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->obs_demanda?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>PENSION:</b></h7>
                <p for=""><span class="text-muted "><?=($personal->pension == 1) ? 'SI' : 'NO'?></span></p>
            </div>
            <div class="col-md-4">
                <p class="textform"><b>MUNICIPIO DE CENTRO DE TRABAJO:</b></h7>
                <p for=""><span class="text-muted"><?=(array_key_exists(0, $ct_municipio)) ? $ct_municipio[0]->nombre : '---'?></span></p>
            </div>
            <div class="col-md-8"<?=($personal->pension == '1') ? '' : 'style="display: none;"'?>>
                <p class="textform"><b>BENEFICIARIO:</b></h7>
                <p for=""><span class="text-muted "><?=$personal->beneficiario?></span></p>
            </div>
        </div>
    </div>
    <?php if($this->session->userdata('rol_id') != 6){?>
    <div class="col-md-12">
        <table class="table" style="width: 100%;" <?=(isset($claves[0]->id)) ? '': 'hidden'?>>
            <thead>
                <tr>                
                    <th>CLAVE</th>
                    <th>NOMBRE</th>
                    <th>CCT</th>
                    <th>NOMBRE CCT</th>
                </tr> 
            </thead>
            
            <?php foreach($claves as $clave) : ?>
            <tr>
                <td><?=$clave->clave_presupuestal?></td>
                <td><?=$clave->nombre?></td>
            
                <td><?=$clave->cct?></td>
                <td><?=$clave->nombrect?></td>
                
            </tr>
            <?php endforeach;?>
        </table>
    </div>
    <?php }?>

    <?php if($this->session->userdata('rol_id') != 6){?>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="grisfor">Tipo plaza:</label>
                        </div>

                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" value="1" id="defaultCheck1" <?=($personal->base_estatal == 1) ? 'checked' : ''?> disabled>
                                <label class="form-check-label" for="defaultCheck1">
                                    Estatal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" value="1" id="defaultCheck1" <?=($personal->base_federal == 1) ? 'checked' : ''?> disabled>
                                <label class="form-check-label" for="defaultCheck1">
                                    Federal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" value="1" id="defaultCheck1" <?=($personal->base_contrato == 1) ? 'checked' : ''?> disabled>
                                <label class="form-check-label" for="defaultCheck1">
                                    Contrato
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input disabled" type="checkbox" value="1" id="defaultCheck1" <?=($personal->base_otro == 1) ? 'checked' : ''?> disabled>
                                <label class="form-check-label" for="defaultCheck1">
                                    Otro
                                </label>
                            </div>


                    </div>
                </div>
                
            </div>
        <?php }?>

        </div>
    
</div>
</div>
<hr>
<!---->
<div class="row mb10">
    <div class="col-md-12 mb5">
        <div class="col-md-12 titulo">
            DIRECCIÓN
            <hr>
        </div>
        <div class="card col-md-6">
            <p class="textform"><b>COLONIA:</b></h7>
            <p for=""><span class="text-muted"><?=$personal->colonia?></span></p>
        </div>
        <div class="col-md-6">
            <p class="textform"><b>CALLE:</b></h7>
            <p for=""><span class="text-muted"><?=$personal->calle?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>NÚMERO:</b></h7>
            <p for=""><span class="text-muted"><?=$personal->numero?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>CÓDIGO POSTAL:</b></h7>
            <p for=""><span class="text-muted"><?=$personal->cp?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>ESTADO:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $estado)) ? $estado[0]->nombre : '---'?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>MUNICIPIO:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $municipio)) ? $municipio[0]->nombre : '---'?></span></p>
        </div>
    </div>
</div>
<hr>
<div class="row mb10">
    <div class="col-md-12 mb5">
        <div class="col-md-12 titulo">
            INFORMACIÓN ACADEMICA
            <hr>
        </div>
        <div class="col-md-4">
            <p class="textform"><b>GRADO MÁXIMO DE ESTUDIOS:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $grado_estudios)) ? $grado_estudios[0]->nombre : '---'?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>AÑO DE EGRESO:</b></h7>
            <p for=""><span class="text-muted"><?=$personal->fecha_egreso?></span></p>
        </div>
        <div class="col-md-4">
            <p class="textform"><b>NOMBRE DE LA CARRERA:</b></h7>
            <p for=""><span class="text-muted"><?=($personal->carrera != "") ? $personal->carrera : '---'?></span></p>
        </div>
        <div class="col-md-4">
            <p class="textform"><b>INSTITUCIÓN EDUCATIVA:</b></h7>
            <p for=""><span class="text-muted"><?=($personal->institucion != "") ? $personal->institucion : '---'?></span></p>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>NÚMERO DE CÉDULA/TITULO:</b></h7>
            <p for=""><span class="text-muted"><?=($personal->folio_titulo != "") ? $personal->folio_titulo : 'NA'?></span></p>
        </div>
        <div class="col-md-4">
            <p class="textform"><b>DOCUMENTO COMPROBANTE:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $grado_profesional)) ? $grado_profesional[0]->nombre : '---'?></span></p>
        </div>
    </div>
</div>
<hr>
<?php if($this->session->userdata('rol_id') != 6){?>
<div class="row mb10">
    <div class="col-md-12 mb5">
        <div class="col-md-12 titulo">
            INFORMACIÓN LABORAL
            <hr>
        </div>
        <div class="col-md-6">
            <p class="textform"><b>DEPARTAMENTO:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $departamento)) ? $departamento[0]->nombre : '---'?></span></p>
        </div>
        <div class="col-md-6">
            <p class="textform"><b>ÁREA:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $area)) ? $area[0]->nombre : '---'?></span></p>
        </div>
        <!--
        <div class="col-md-6">
            <p class="textform"><b>TURNO:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $turno)) ? $turno[0]->nombre : '---'?></span></p>
        </div>
        -->
        <div class="col-md-6">
            <p class="textform"><b>PUESTO:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $puesto)) ? $puesto[0]->nombre : '---'?></span></p>
        </div>
        <div class="col-md-6">
            <p class="textform"><b>OBSERVACIONES:</b></h7>
            <p for=""><span class="text-muted"><?=($personal->observaciones != "") ? $personal->observaciones : '---'?></span></p>

        <div class="col-md-6" <?=($puesto[0]->nombre == "Laboratorista") ? '' : 'hidden' ?> >
            <p class="textform"><b>CCT Lab:</b></h7>
            <p for=""><span class="text-muted"><?=(array_key_exists(0, $puesto)) ? $personal->cct_laboratorista : '---'?></span></p>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="grisfor">Horario:</label>
                </div>
            </div>
            <div style="display:">
                <table class="table">
                    <?php foreach($dias_semana as $dia): ?>
                        <tr>
                            <td>
                                <input class="form-check-input disabled" type="checkbox" id="" <?=(($dia['data']['id'] != 0)) ? 'checked' : ''?> name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][dia]" value="<?=(!is_array($dia)) ? 0 : $dia['data']['cve_dia']?>" disabled>
                                <label class="form-check-label" for=""><?=(!is_array($dia)) ? $dia : $dia['data']['dia']?></label>
                            </td>
                            <td>
                                <?php
                                $entrada = (is_array($dia)) ? explode('-', $dia['data']['horario']) : $dia = '00:00';
                                ?>
                                <input type="time" value="<?=(is_array($dia)) ? reset($entrada) : '00:00'?>" name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][entrada]" class="disabled" disabled>
                                a
                                <input type="time" value="<?=(is_array($dia)) ? end($entrada) : '00:00'?>" name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][salida]" class="disabled" disabled>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>

    </div>
</div>
<?php }?>
<div class="row mb10" id="capacitaciones" style="display=none">
    <div class="col-md-12 mb5">
        <div class="col-md-12 titulo">
            CAPACITACIONES
            <hr>
        </div>
        <div class="col-md-6">
            <p class="textform"><b>Nombre:</b></h7>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>Fecha inicio:</b></h7>
        </div>
        <div class="col-md-3">
            <p class="textform"><b>Fecha fin:</b></h7>
        </div>
        <div class="col-md-6">
            <div id="nombre_curso" for=""><span class="text-muted"></span></div>
        </div>
        <div class="col-md-3">
            <p id="fecha_inicio" for=""><span class="text-muted"></span></p>
        </div>
        <div class="col-md-3">
            <p id="fecha_fin" for=""><span class="text-muted"></span></p>
        </div>

    </div>
</div>