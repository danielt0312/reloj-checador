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
		<a class="btn btn-info" href="<?=base_url()?>Inicio/Recursos">Regresar</a>
		<div class="row">
			<?php if ($registrosubcat==NULL) { 
					echo '<div class="col-md-12 recursos inputdiv59" style="background-color: #fcd5da !important; font-size:18px !important;"><center><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Disculpe las molestias pero acutalmente esta sección <b>NO CUENTA CON CONTENIDO DISPONIBLE</b>.</div></center>';
			    }
			foreach ($registrosubcat as $indice) { ?>  	      
	        
			        <div class="col-md-5 subcategoriasrecursos inputdiv59">
			        	<label><?php echo $indice['titulo']?></label><br>
			        	<label style="font-size: 20px !important;"><?php echo $indice['subtitulo']?></label><br>
			        	<div class="row">
			        		<?php  if ($indice['archivo']!='') {?>
			        			<div class="col-md-3">			        			
			        					<img src="<?=base_url().$indice["archivo"]?>">			        			
			        			</div>
			        		<?php }else{?>
			        			<div class="col-md-1"></div>
			        		<?php } ?> 
			        		<div class="col-md-9" >
			        			<?php if ($indice['pdf']!="") { ?>
									<a href="<?=base_url($indice['pdf'])?>" target="_blank" class="btn-verde">Clic para ver información</a>
									<?php } if ($indice['url']!="") { ?>
									<a href="<?=$indice['url']?>" target="_blank" class="btn-verde">Clic para ver información</a>
								    <?php } 
								    	if ($indice['audio']!='') {
								    		$urlaudio = $indice['audio'];
											$urlaudio = explode(",", $urlaudio);

											$textoaudio = $indice['texto_audio'];
											$textoaudio = explode(",", $textoaudio);

											$j=0;
											echo "<div class='row'>";
											for($i=0;$i<count($textoaudio);$i++)
											{
												echo "<div class='col-md-10 recsub'>".$textoaudio[$i]."</div>";
												echo "<div class='col-md-6'><audio src='".base_url().$urlaudio[$j]."' preload='none' controls></audio></div>";
												$j++;
											}
											echo "</div>";
								    	}
								    ?>

									<br>
									<?php  
								    	if ($indice['varias_imagenes']!='') {
								    		$urlimgs = $indice['varias_imagenes'];
											$urlimgs = explode(",", $urlimgs);

											$textodescripcion = $indice['descripcion'];
											$textodescripcion = explode("_", $textodescripcion);

											$x=0;
											echo "<div class='row'>";
											for($y=0;$y<count($urlimgs);$y++)
											{
												echo "<div class='col-md-2 recsub'><img src='".base_url().$urlimgs[$y]."' style='height:90px;'></div>";
												echo "<div class='col-md-10'><p>".$textodescripcion[$x]."</p><br></div>";
												$x++;
											}
											echo "</div>";
								    	}
								    	else{
								    		echo '<p>'.$indice['descripcion'].'</p><br>';
								    	}
								    ?>

									

			        		</div>
			        	</div>
					</div>	
			<?php
				}
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