	<!-- Logo -->
		<div id="logo-redes">
		    <div class="container">
		    	<div class="row">
			    	
		    		<div class="col-md-3 col-sm-6">
		    			<a class="logo-a" href="https://www.tamaulipas.gob.mx/educacion">
		    				<h1 class="hidden">Secretaría de Educación | Gobierno del Estado de Tamaulipas</h1>
		    			   		<img class="logotam img-responsive" src="<?=base_url()?>assets/img/tam.png" alt="Secretaría de Educación - Gobierno del Estado de Tamaulipas">
		                </a>
		    		</div>

		        <div class="col-md-3 col-sm-6 col-md-push-6">
		          <a class="logo-a" href="https://www.tamaulipas.gob.mx/educacion">
		            <img class="logotam img-responsive" src="<?=base_url()?>assets/img/educacion.jpg" alt="Secretaría de Educación - Gobierno del Estado de Tamaulipas">
		          </a>
		        </div>
		    		
		    		<div class="col-md-6 col-sm-12 col-md-pull-3">
			    		<div class="row">
				    		<div class="col-sm-12">
					      	<div id="buscador">
					      		<form class="form-buscador form-group" method="get" action="https://www.tamaulipas.gob.mx/educacion"> 
					      		  <input type="hidden" name="buscar" value="pages">
					      			<input class="form-control input-lg" name="s" placeholder="¿En qué te puedo ayudar?" autocomplete="off">
					      			<div class="buscador-filtro">
					      			  <ul>
						      			  <li><a href="" data-buscar="pages">Buscar "<span></span>" en Secciones</a></li>
				      			     	  <li><a href="" data-buscar="posts" class="selected">Buscar "<span></span>" en Sala de Prensa</a></li>
					      			  </ul>
					      			</div>
					      		</form>
					      	</div>
				    		</div>
			    		</div>
		    		</div>
		    		
		    	</div>
		    </div>
		</div>
	<!-- /Logo -->
	<!-- Menú -->
		<div id="menu-secretarias">
			<input type="checkbox" name="menu-toggle" id="menu-open">
		 	<div class="container">	    
			  	<div id="row-cabecera" class="row">		  	
					<!-- Menú para escritorio -->
			  		<div class="menu-escritorio col-xs-12 hidden-xs hidden-sm">
						<div id="menu-container" class="menu-menu-principal-container">
							<ul id="menu-menu-principal" class="clean-list menu pull-right">

								<label class="blanco">
									<!-- <i class="fa fa-user-circle" aria-hidden="true"></i>  -->
									<?=$this->session->userdata('nombre').' '.$this->session->userdata('apellido_paterno').' '.$this->session->userdata('apellido_materno')?>
								</label>

								<li id="menu-item-285" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-285"><a href="<?=base_url()?>Bienvenida" aria-current="page">Inicio</a></li>

								<?php 
									foreach ($menu as $indice_menu) {
										if ($indice_menu['url']=='') {
								?>
					                	<li id="menu-item-285" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-285"><a aria-current="page"><?=$indice_menu['nombre_menu']?></a>
					                		<ul class="sub-menu">	
							                	<?php foreach ($submenu as $indice_submenu) {	
							                		if($indice_submenu['menu_id'] == $indice_menu['id_menu']){?>
															<li id="menu-item-378" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-378"><a href="<?=base_url($indice_submenu['url'])?>"><?=$indice_submenu['nombre_submenu']?></a></li>														
												<?php }}?>
											</ul>
					               		</li>
								<?php }
									else{?>
										<li id="menu-item-285" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-285">
											<a href="<?php echo base_url().$indice_menu["url"]?>" aria-current="page"> <?=$indice_menu['nombre_menu']?></a>
										</li>
								<?php	}
								}?>
								

								<li id="menu-item-573" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-573"><a href="" class="confirmarsesion" mensaje="¿Seguro que desea cerrar sesión?" confirmacion="Cerrando sesión...">Cerrar<br>Sesión</a>
								</li>



							</ul>
						</div>  		
					</div>
			  		<!-- Menú para escritorio -->
			  		<div id="barras-boton" class="col-xs-offset-6 col-xs-6 visible-xs-block visible-sm-block">
							<div class="menu-btn-container">
								<label for="menu-open" id="menu-btn" class="btn-movil">
									<div class="menu-bars">
										<span></span>
										<span></span>
										<span></span>
									</div>
								</label>
							</div>
			    	</div>  		
	  			</div>  	
	  		</div>  
	  		<div id="row-menu-movil" class="container hidden-md hidden-lg">
				<nav class="menu-menu-principal-container">
					<ul id="menu-menu-principal-1" class="clean-list nav-menu">
						<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-285"><a href="<?=base_url()?>Bienvenida" aria-current="page">Inicio</a></li>
						
								<?php 
									foreach ($menu as $indice_menu) {
										if ($indice_menu['url']=='') {
								?>
					                	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-573 padre" style="height: 300px;"><a class="sub-open"><?=$indice_menu['nombre_menu']?></a>
					                		<ul class="sub-menu" style="height: 260px;">	
							                	<?php foreach ($submenu as $indice_submenu) {	
							                		if($indice_submenu['menu_id'] == $indice_menu['id_menu']){?>
															<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9393"><a href="<?=base_url($indice_submenu['url'])?>"><?=$indice_submenu['nombre_submenu']?></a></li>														
												<?php }}?>
											</ul>
											<i class="fa fa-angle-down menu-flecha open"></i>
					               		</li>
								<?php }
									else{?>
										<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-285">
											<a href="<?php echo base_url().$indice_menu["url"]?>" aria-current="page"> <?=$indice_menu['nombre_menu']?></a>
										</li>
								<?php	}
								}?>


						<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-563"><a href="" class="confirmarsesion" mensaje="¿Seguro que desea cerrar sesión?" confirmacion="Cerrando sesión...">Cerrar<br>Sesión</a>
						</li>
					</ul>
				</nav>	
			</div>	
		</div>
	<!-- Menú -->