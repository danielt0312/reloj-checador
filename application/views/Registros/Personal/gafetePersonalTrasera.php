<?=header('Content-Type: text/html; charset=UTF-8')?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trasera</title>
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
        width: 100%;
    }
    #img-qr{
        position: relative;
        text-align: center;
        left: 40px;
        top: 90px;
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




<div class="datos" style="color: #FFF">


    <img src=<?=$url_qr?> alt="" width="200" id="img-qr" style="
    position: absolute;
    top: 120px;
    left: 30px;
    ">
</div>

</body>
</html>