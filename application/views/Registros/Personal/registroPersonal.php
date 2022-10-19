<?=header('Content-Type: text/html; charset=UTF-8')?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    body{
        padding: 50px;
    }
    .header{
        width: 100%;
        height: 100px;
        display: inline;

    }
    .logo-tam{
        width: 25%;
        height: 100%;
        padding-top: 15px;
        padding-left: 15px;
        position: absolute;
    }
    .titulo{
        width: 50%;
        height: 100%;
        padding-top: 15px;
        padding-right: 35px;
        text-align: center;
        position: relative;
        left: 25%;
        color: #696a6c;
    }
    .logo-edu{
        width: 25%;
        height: 100%;
        padding-top: 15px;
        padding-left: 15px;
        position: absolute;
        left: 75%;
    }

    .contenido{
        width: 95%;
        height: 550px;
        padding: 20px;
        top: 100px;
        position: absolute;

    }

    .img-profile{
        width: 135px;
        height: 153px;
        border: gray solid 1px;
    }

    .row{
        width: 100%;
        height: auto;


    }
    .col-100{
        width: 100%;
        height: auto;
    }
    .col-50{
        width: 50%;
        height: auto;
        float: left;
    }
    .col-25{
        width: 30%;
        height: auto;
        display: inline;
        border: gray solid 1px;

    }
    .col-10{
        width: 10%;
        height: auto;
        float: left;
    }
    .right{
        float: right;
    }
    .left{
        float: left;
    }
    .panel{
        width: 1070px;
        height: auto;
        border: gray solid 1px;
    }
    .panel-titulo{
        height: 20px;
        padding-top: 5px;
        padding-left: 5px;
        background-color: #0064a8;
        color: white;
    }
    .panel-body{
        padding: 5px;
        padding-top: 5px;
    }
    p{
        margin-top: 8px;
        margin-bottom: 5px;
    }
    ul{
        margin-left:-20px;
    }

</style>

<body>

<div class="header">
    <div class="logo-tam">
        <img src="assets/img/tam.png" alt="" width="150">
    </div>
    <div class="titulo">
        <h3>CENTRO ESTATAL DE TECNOLOGÍA EDUCATIVA FICHA INFORMATIVA DE PERSONAL</h3>
    </div>
    <div class="logo-edu">
        <img src="assets/img/educacion.jpg" alt="" width="250">
    </div>

</div>

<div class="contenido">

    <div class="panel" col="50">
        <div class="panel contenido-personal">
            <div class="panel-titulo contenido-titulo">
                INFORMACIÓN PERSONAL
            </div>
            <div class="panel-body">
                <table border="0">
                    <tr>
                        <td>
                            <div class="img-profile">
                                <?php if(is_file(substr($personal->foto, 1))) { ?>
                                    <img src='<?=base_url($personal->foto)?>' alt="" width="135" height="153">
                                <?php } ?>
                            </div>
                        </td>
                        <td>
                            <div class="col-100">
                                <p style="text-transform:uppercase;"><b>Nombre:</b> <?=$personal->nombre?> <?=$personal->apellido_paterno?> <?=$personal->apellido_materno?>&nbsp;&nbsp;&nbsp;&nbsp;<b>CURP: </b><?=$personal->curp?>&nbsp;&nbsp;&nbsp;&nbsp;<b>RFC: </b><?=$personal->rfc?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Sexo:</b> <?=$personal->sexo?></p>
                                <p style="text-transform:uppercase;"><b>Estado civil: </b> <?=(isset($estado_civil->nombre)) ? $estado_civil->nombre : '---'?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Hijos: </b><?=$personal->hijos?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Típo de sangre: </b><?=(isset($tipo_sanguineo->nombre)) ? $tipo_sanguineo->nombre : '---'?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Teléfono: </b><?=$personal->telefono?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Colonia:</b> <?=$personal->colonia?>   </p>
                                <p style="text-transform:uppercase;"><b>Calle: </b><?=$personal->calle?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Número: </b><?=$personal->numero?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Código Postal: </b><?=$personal->cp?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Estado:</b> <?=(isset($entidad_federativa->nombre)) ? $entidad_federativa->nombre : '---'?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Municipio: </b><?=(isset($municipio->nombre)) ? $municipio->nombre : '---'?></p>
                                <p style="text-transform:uppercase;"><b>Demanda: </b><?php if ($personal->demanda == 1) {?>Si&nbsp;&nbsp;&nbsp;&nbsp;<b>Observacion: </b><?=$personal->obs_demanda?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{?>No&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?><b>Pensión: </b><?php if ($personal->pension == 1) {?>Si&nbsp;&nbsp;&nbsp;&nbsp;<b>Beneficiario: </b><?=$personal->beneficiario?><?php }else{?>No<?php }?></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div><br>

    <div class="panel">
        <div class="panel contenido-personal">
            <div class="panel-titulo contenido-titulo">
                INFORMACIÓN ACADÉMICA
            </div>
            <div class="panel-body">
                <table border="0">
                    <tr>
                        <td>
                            <div class="col-100">
                                <p style="text-transform:uppercase;"><b>Grado máximo de estudios:</b> <?=(isset($grado_estudios->nombre)) ? $grado_estudios->nombre : '---'?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Año de egreso: </b><?=$personal->fecha_egreso?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Nombre de la carrera: </b><?=$personal->carrera?></p>
                                <p style="text-transform:uppercase;"><b>Institución educativa:</b> <?=$personal->institucion?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Número de cédula/título: </b><?=$personal->folio_titulo?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Documento comprobante: </b> <?=(isset($grado_profesional->nombre)) ? $grado_profesional->nombre : '---'?></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div><br>
                              
    <div class="panel">
        <div class="panel contenido-personal">
            <div class="panel-titulo contenido-titulo">
                INFORMACIÓN LABORAL
            </div>
            <div class="panel-body" style="pading-top: 5px!important;">
                <table border="0">
                    <tr>
                        <td align="left" style="width:450px">
                            <p style="text-transform:uppercase;"><b>Departamento:</b><br> <?=(isset($departamento->nombre)) ? $departamento->nombre : 'NO ASIGNADO'?></p>
                            <p style="text-transform:uppercase;"><b>Área: </b><?=(isset($area->nombre)) ? $area->nombre : 'NO ASIGNADO'?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Estatus: </b><?=(isset($estatus->nombre_estatus)) ? $estatus->nombre_estatus : 'NO ASIGNADO'?><br><b>Puesto:</b><?php if ($puesto[0]->nombre == 'Laboratorista') {?>Laboratorista&nbsp;&nbsp;&nbsp;&nbsp;<b>CCT Lab: </b><?=$personal->cct_laboratorista?>&nbsp;&nbsp;&nbsp;&nbsp;<?php }else{?> <?=(isset($puesto[0]->nombre)) ? $puesto[0]->nombre : 'NO ASIGNADO'; }?></p>
                            <p style="text-transform:uppercase;"><b>Observaciones:</b> <?=$personal->observaciones?></p>
                            </td>
                        <td align="left" style="width:300px">
                            <p style="text-transform:uppercase;"><?php if ($estatus->nombre_estatus == "INACTIVO") { ?><b>Motivo de baja:</b> <?=$estatus->nombre_motivo?>&nbsp;&nbsp;<br>&nbsp;<b>Fecha baja: </b><?=$estatus->fecha_baja?><br><?php } ?><b>Fecha de ingreso al sistema: </b> <?=$personal->fecha_ingreso_sistema?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha de ingreso C.T.: </b> <?=$personal->fecha_ingreso_ct?></p>
                            <p style="text-transform:uppercase;"><b>Estatal</b> (<?=($personal->base_estatal == 1) ? 'X' : ' '?>)&nbsp;&nbsp;&nbsp;&nbsp;<b>Federal</b> (<?=$personal->base_federal == 1 ? 'X' : ' '?>)&nbsp;&nbsp;&nbsp;&nbsp;<b>Contrato</b> (<?=($personal->base_contrato == 1) ? 'X' : ' '?>)&nbsp;&nbsp;&nbsp;&nbsp;<b>Otro</b> (<?=($personal->base_otro == 1) ? 'X' : ' '?>)</p>
                        </td>
                        <td align="left" style="width:200px">
                            <p style="text-transform:uppercase;"><b>Horario: </b></p>
                            <ul class="list">
                                <?php foreach($horarios as $hroario_personal): ?>
                                <li style="text-transform:uppercase;"><?=$hroario_personal->dia?>: <?=$hroario_personal->horario?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                </table>
                <?php if ($this->session->userdata('rol_id') != 6){?>   
                <?php if ($personal->base_estatal == 1 || $personal->base_federal == 1) {  ?>
                <table border="0" >                    
                    <tr>
                    
                        <td style="width:190px">
                            <p style="text-transform:uppercase;"><b>Claves:</b></p>
                                <ul>
                                    <?php foreach($claves as $clave): ?>
                                    <li><?=$clave->clave_presupuestal?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td style="width:380px">
                                <p style="text-transform:uppercase;"><b>Nombre clave:</b></p>
                                <ul>
                                    <?php foreach($claves as $clave): ?>
                                    <li><?=$clave->nombre?></li>
                                    <?php endforeach; ?>
                                </ul>
                        </td>
                        <td style="width:120px">
                            <p style="text-transform:uppercase;"><b>CCT:</b></p>
                                <ul>
                                    <?php foreach($claves as $clave): ?>
                                    <li><?=$clave->cct?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td style="width:340px">
                                <p style="text-transform:uppercase;"><b>Nombre CCT:</b></p>
                                <ul>
                                    <?php foreach($claves as $clave): ?>
                                    <li><?=$clave->nombrect?></li>
                                    <?php endforeach; ?>
                                </ul>
                        </td>
                    
                    </tr>
                </table>
                <?php } }?>
            </div>
        </div>
    </div><br>
                                    
</div>

</body>
</html>