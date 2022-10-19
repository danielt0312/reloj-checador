<style type="text/css">
	.tooltip.top .tooltip-arrow{
		border-top-color: #00b9ff !important;
	}
	.tooltip-inner {

    	background-color: #00b9ff !important;
	}
</style>
<div class="contenedor-principal">
			<img src="<?=base_url()?>assets/img/recursos.png" class="img-responsive">
</div>
<div class="container contenidorecursos" style="align-items: center;">
	<!-- recursos -->
	<div id="categoriasrecursos">
		<div class="row">
			<?php
				if ($registrocat==null) {
					echo '<div class="col-md-12 recursos inputdiv59" style="background-color: #fcd5da !important; font-size:18px !important;"><center><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Disculpe las molestias pero acutalmente esta sección <b>NO CUENTA CON CONTENIDO DISPONIBLE</b>.</div></center>';
				}
				else{
					foreach ($registrocat as $indice) {
	        ?>
	        <div class="col-md-5 categoriasrecursos inputdiv59">
					<label><?php echo $indice['titulo']?></label><br>
					<label style="font-size: 19px;color:#5d5d5d;"><?php echo $indice['subtitulo']?></label><br>
				<?php
					if ($indice['url']=="" && $indice['pdf']=="" && $indice['examen']=="") {
	        	?>
					<a data-toggle="tooltip" data-placement="top" href="<?=base_url()?>Inicio/RecursoCategoria/<?=$indice['id']?>" class="btn-azul">Clic para ver información</a>


				<?php
					} else{
						if ($indice['pdf']!="") {
	        	?>
						<a data-toggle="tooltip" data-placement="top" href="<?=base_url($indice['pdf'])?>" target="_blank" class="btn-azul">Clic para abrir documento</a>
	        	<?php
					}
					if ($indice['url']!=""){
	        	?>
					<a data-toggle="tooltip" data-placement="top" href="<?=$indice['url']?>" target="_blank" class="btn-azul">Clic para ver información</a>
	        	<?php
					}
					if ($indice['examen']!=""){
	        	?>
					<a data-toggle="tooltip" data-placement="top" href="<?=base_url($indice['examen'])?>" class="btn-azul">Clic para ver información</a>
	        	<?php
					}}
	        	?>
	        	<img src="<?=base_url().$indice["archivo"]?>">
			</div>
			<?php
				}}
	        ?>
        </div>
	</div>
	<div style="height: 150px;"></div>
</div>
<script type="text/javascript">
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

