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
    
    div.gafete{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 544px;
        height: auto;
        /*border: dotted;*/
        margin-top: 0px;
        margin-left: 0px;
    }
    .gaf-img{
       
    }
    .img-profile{
        position: absolute;
        top: 130px;
        left: 80px;
        width: 100px;
        height: 136px;
        border: gray solid 1px;
    }
    .datos{
        top: 290px;
        left: 20px;
        position:absolute;
    }
    #img-qr{
        position: relative;
        left: 275px;
        top: -200px;
    }
    #img-qr2{
        position: absolute;
        left: 0;
        top: 120;
        width: 50;
        height: 50;
        background: none;
    }
</style>

<body>
<?php

$url_qr = "http://142.250.81.78/chart?cht=qr&chs=300x300&chl=http://proyectoscete.tamaulipas.gob.mx/rh/personal/ficha_publica/".$personal->id_cifrado;
$url_qr2 = "http://142.250.81.78/chart?cht=qr&chs=300x300&chl=http://proyectoscete.tamaulipas.gob.mx/rh/personal/ficha_publica/".$personal->id_cifrado;
?>
    <div class="gafete">
        <div class=".gaf-img">
            <img src='<?=base_url("assets/img/gafete-b.jpg")?>' alt="" style="
            position: relative;
            top: 0px;
            left: -2px;
            width: 270;
            height: 434.3px;
            ">
        </div>
        <img src=<?=$url_qr2?> alt="" id="img-qr2" width="80" height="80">
    </div> 
      
    <div class="img-profile">
        <?php if(is_file(substr($personal->foto, 1))) { ?>
        <img src='<?=base_url($personal->foto)?>' alt="" width="120" height="136">
        <?php } ?>
    </div>

    <div class="datos" style="color: #FFF">
        <b>Nombre del trabajador:</b><br>
        <?=$personal->nombre?><br> <?=$personal->apellido_paterno?> <?=$personal->apellido_materno?><br><br>

        <b>Puesto de trabajo:</b> <br>
        <?=$puesto[0]->nombre?>
        <br><br>
        <b>Municipio:</b> <br>
        <?=$municipio->nombre?><br>

        <!--<img src=<?=$url_qr?> alt="" width="100%" id="img-qr">-->
    </div>

</body>
</html>