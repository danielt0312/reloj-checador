<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="icon" href="https://www.tamaulipas.gob.mx/wp-content/uploads/2022/10/cropped-escudo-tam-dorado-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.tamaulipas.gob.mx/wp-content/uploads/2022/10/cropped-escudo-tam-dorado-192x192.png" sizes="192x192" />
  <title>Secretaría de Educación | Gobierno del Estado de Tamaulipas</title>

  <script src="<?=base_url()?>assets/js/plantilla/jquerymin.js"></script>
  <script src="<?=base_url()?>assets/js/plantilla/jquery-migrate.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate-1.14.0.min.js" /></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/jquery-validate.bootstrap-tooltip.js" /></script>
  <script src="<?=base_url()?>assets/js/messages_es.js?"></script>
  <style>
   body {
	width: 99%;
}
@import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');

.login {
	padding: 30px;
}

@media (max-width: 767px) {
	.oculto {
		display: none !important;
	}
}

.titulo {
	padding: 0;
    margin: 0;
    line-height: 1;
    font-weight: 600;
    letter-spacing: 0px;
    color: #333;
    font-size: 18px;
    text-transform: uppercase;
    line-height: 1.5;
    font-family: 'Raleway', sans-serif;
}

.recuperar {
	margin-top: 100px;
	padding-left: 30px;
	color: #495057;
	font-size: 15px;
	font-weight: 600;
	font-family: 'Roboto Condensed', sans-serif;
	text-transform: uppercase;
	cursor: pointer;
}

.fondo {
	height: 100vh;
	font-family: "Exo", sans-serif;
	color: #fff;
	filter: contrast(110%);
	background: linear-gradient(60deg, #ab0033 3%, #ab0033 15%, #ab0033 60%, #ab0033);
	background-size: 300% 300%;
	animation: gradientBG 35s ease infinite;
}

.fondo label {
	color: white;
	font-size: 90px;
	font-weight: bold;
	padding-top: 26%;
	line-height: normal;
	letter-spacing: -2px;
}

.logo {
	width: 100%;
}

.logo2 {
	width: 40%;
}

@keyframes gradientBG {
	0% {
		background-position: 0% 50%;
	}

	50% {
		background-position: 100% 50%;
	}

	100% {
		background-position: 0% 50%;
	}
}

label {
	display: inline-block;
    font-size: 13px;
    font-weight: 700;
    font-family: 'Raleway', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #555;
    margin-bottom: 5px;
    cursor: pointer;
}

.log {
	padding: 20px;
	color: #242424;
	display: block;
	font-size: 18px;
	font-weight: 600;
	height: 16px;
	margin-bottom: 10px;
	font-family: 'Roboto Condensed', sans-serif;
	text-transform: uppercase;
}

input[type=text], select, textarea {
	display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    font-family: 'Nunito', sans-serif;
}

input[type=password], select, textarea {
	display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    font-family: 'Nunito', sans-serif;
    
}

#submit {
	color: white;
	background-color: #bc955c;
	font-family: 'Nunito', sans-serif;
	font-size: 13px;
	margin-bottom: 0;
	font-weight: 700;
  border-radius: 30px;
	text-align: center;
	vertical-align: middle;
	-ms-touch-action: manipulation;
	touch-action: manipulation;
	cursor: pointer;
	background-image: none;
	white-space: nowrap;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	outline: none !important;
  width: 100%;
  text-transform: uppercase;
}

#submit:hover {
	color: white;
	background-color: #ab0033;
}

#submit:focus {
	color: #6d6d6d;
	font-weight: bold;
}

#submit:active {
	color: #6d6d6d;
	font-weight: bold;
}

  </style>
  <!--sweet alert-->
  <script src="<?=base_url()?>assets/js/plantilla/sweetalert.min.js"></script>

</head>
<body>
  <div class="contenedor-principal">
    <div class="row">
      <div class="col-md-3" style="background-color: white;">
        <div class="login">
          <div class="col-md-12 text-left">
            <img src="<?= base_url();?>assets/img/logo-educacion.png" class="logo">
           
          </div>
        </div>
        <p class="titulo text-center">Iniciar Sesión</p>
        <div class="form login">
          <form action="<?php echo base_url();?>Inicio/login" method="post" role="form" class="formValidate">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required class="required">
            <br>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required class="required">
            <div style="height: 20px;"></div>
            <input type="submit" id="submit" value="Ingresar" class="btn" size="100">

          </form>
        </div>
        <div style="height: 170px;" class="oculto">

        </div>
        <div class="row">
          <!-- <div class="col-md-6 text-left">
            <p class="recuperar"><i class="fa fa-pencil-square" aria-hidden="true"></i> Registro</p>
          </div> -->
          <div class="col-md-6  text-right">
          </div>
          <?php if ($this->session->flashdata('mensaje')): ?>
              <center>
                <p class="alert alert-warning" style="font-size: 13px;" role="alert"><span class="glyphicon glyphicon-exclamation-sign" style="font-size: 15px; color: red;"></span>&nbsp;
                  <?php echo $this->session->flashdata('mensaje');?>
                </p>
              </center>
          <?php endif ?><br>
        </div>
      </div>
      <div class="col-md-9 fondo text-center d-lg-none d-xl-block">
        <label><img src="<?= base_url();?>assets/img/rhs.png" class="logo2"></label>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function() {
    $('.formValidate').validate({
      errorElement: 'span',
    })
  })
</script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
  <script src="<?=base_url()?>assets/js/funcionesvalidaciones.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
