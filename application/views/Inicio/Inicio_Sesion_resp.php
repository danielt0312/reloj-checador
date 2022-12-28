<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.form-control {
		min-height: 41px;
		background: #fff;
		box-shadow: none !important;
		border-color: #e3e3e3;
	}

	.form-control:focus {
		border-color: #70c5c0;
	}
	.tcp{
	    	background-image: url(<?=base_url()?>assets/img/login.png);
		    height: 600px;
		    width: 1500px;
		    background-position: center;
		    background-repeat: no-repeat;
		    z-index: 3;
		    margin-bottom: 100px;
		    margin-top: 50px;
		    margin-left: 50px;
		    margin-right: 100px;
	}
</style>
 <div class="contenedor-principal">
  <div class="row  tcp">
  	<div class="col-md-4"></div>
    <div class="col-md-5" style="margin-top: 160px;">
	<form action="<?=base_url()?>Inicio/login" method="POST" role="form" class="formValidate">
		<!-- <div class="avatar">
			<img src="<?=base_url()?>assets/img/usuariolog.png" alt="Avatar">
		</div> -->
		<h2 class="text-center" style="color:#ffffff;">INICIAR SESIÓN</h2>
		<br>
		<div class="form-group">
			<label style="color:#ffffff;font-size: 15px;">USUARIO</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control required" name="usuario" placeholder="Escribir Usuario" required="required">
			</div>
		</div>
		<div class="form-group">
			<label style="color:#ffffff;font-size: 15px;">CONTRASEÑA</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" class="form-control required" name="password" placeholder="Escribir Contraseña" required="required">
			</div>
		</div>


		<?php if ($this->session->flashdata('mensaje')): ?>
		<center>
			<p class="alert alert-warning" style="font-size: 13px;" role="alert"><span class="glyphicon glyphicon-exclamation-sign" style="font-size: 15px; color: red;"></span>&nbsp;
				<?php echo $this->session->flashdata('mensaje');?>
			</p>
		</center>
		<?php endif ?><br>




		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-lg btn-block">INGRESAR</button>
		</div>
		<div class="clearfix">
			<p class="text-center small"><a href="<?=base_url()?>Inicio/CuentaRestablecer" style="color:#ffffff;font-size: 14px;">¿Olvidaste la contraseña?</a></p>
		</div>
	</form>
	<div style="height: 150px;"></div>
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