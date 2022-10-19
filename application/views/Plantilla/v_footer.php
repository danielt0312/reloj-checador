</div>	<!-- Footer -->
<div id="footer">
    <div id="footer-bg">
        <div class="container">
            <div id="footer-rows" class="row cols-same-height">
                <div class="info col-md-3 hidden-sm hidden-xs" style="height: 241px;">
                    <h2>Secretaría de Educación</h2>
                    <p>Calzada General Luis Caballero S/N, Fracc. Las Flores,<br>
                        Cd. Victoria, Tamaulipas, México, C.P. 87078</p>
                    <p>
                        834 318 6600<br>834 318 6601<br>834 318 6602<br>
                    </p>
                </div>
                <div id="footer-no-diagonal" class="col-md-1 hidden-sm hidden-xs" style="height: 241px;">

                </div>
                <div id="footer-links" class="col-md-8" style="height: 241px;">
                    <div class="row cols-same-height">
                        <div class="col-md-3 col-xs-6" style="height: 149px;">
                            <h2>Secretaría de Educación</h2>
                            <div class="menu-secretaria-de-educacion-container"><ul id="menu-secretaria-de-educacion" class="clean-list menu"><li id="menu-item-584" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-584"><a href="http://www.tamaulipas.gob.mx/educacion/conocenos/">Conócenos</a></li>
                                    <li id="menu-item-3813" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3813"><a href="http://www.tamaulipas.gob.mx/educacion/conset/">Consejo Estatal Técnico de la Educación</a></li>
                                    <li id="menu-item-21089" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21089"><a href="https://www.tamaulipas.gob.mx/educacion/codigo-de-etica/">Código de Ética</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6" style="height: 149px;">
                            <h2>Información por Perfiles</h2>
                            <div class="menu-informacion-de-perfiles-container"><ul id="menu-informacion-de-perfiles" class="clean-list menu">
                                    <li id="menu-item-590" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-590"><a href="http://www.tamaulipas.gob.mx/educacion/perfiles/padre-de-familia/">Padres de Familia</a></li>
                                    <li id="menu-item-589" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-589"><a href="http://www.tamaulipas.gob.mx/educacion/perfiles/estudiante/">Estudiantes</a></li>
                                    <li id="menu-item-588" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-588"><a href="http://www.tamaulipas.gob.mx/educacion/perfiles/escuelas/">Escuelas</a></li>
                                    <li id="menu-item-587" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-587"><a href="http://www.tamaulipas.gob.mx/educacion/perfiles/docentes/">Docentes</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--
						<div class="col-md-3 col-xs-6" style="height: 149px;">
							<h2>Becas</h2>
							<div class="menu-becas-container"><ul id="menu-becas" class="clean-list menu">
                                <li id="menu-item-22911" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22911"><a href="https://www.tamaulipas.gob.mx/educacion/becas/">Becas Tam</a></li>
								<li id="menu-item-582" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-582"><a href="http://www.tamaulipas.gob.mx/educacion/becas/">Beca Integración</a></li>
								</ul>
							</div>
						</div>
						-->
                        <div class="col-md-3 col-xs-6" style="height: 149px;">
                            <h2>Sitios Recomendados</h2>
                            <div class="menu-sitios-recomendados-container"><ul id="menu-sitios-recomendados" class="clean-list menu"><li id="menu-item-575" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-575"><a target="_blank" rel="noopener noreferrer" href="http://www.tamaulipas.gob.mx/">Gobierno del Estado de Tamaulipas</a></li>
                                    <li id="menu-item-576" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-576"><a target="_blank" rel="noopener noreferrer" href="http://www.diftamaulipas.gob.mx/">DIF Tamaulipas</a></li>
                                    <li id="menu-item-577" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-577"><a target="_blank" rel="noopener noreferrer" href="http://www.gob.mx/sep">Secretaría de Educación Pública</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="info col-sm-12 visible-sm-block visible-xs-block">
                    <h2>Secretaría de Educación</h2>
                    <p>Calzada General Luis Caballero S/N,<br>
                        Fracc. Las Flores,<br>
                        Cd. Victoria, Tamaulipas,<br>
                        México, C.P. 87078</p>
                    <p>
                        834 318 6600<br>834 318 6601<br>834 318 6602<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Footer -->
<!-- Liston inferior -->
<div id="liston-inferior">
    Todos los derechos reservados © <?=date('Y')?> <span id="to-break">/</span> Gobierno del Estado de Tamaulipas <?=($this->uri->segment(2) == 'ficha_publica' || $this->uri->segment(4) == 'ficha_publica') ? '' : '2016 - 2022'?>
</div>
<!-- /Liston inferior -->
<script src="https://use.fontawesome.com/f66bf0287f.js"></script>
<script src="<?=base_url()?>assets/js/verpdf.js"></script>
<script src="<?=base_url()?>assets/js/funcionesvalidaciones.js"></script>
<script src="<?=base_url('assets/js/alertas.js')?>"></script>
<script>
    $(document).ready(function(){
        $('.gem-titulo-oculto').hide();
        $('.busqueda').hide();
    })
</script>
</body>
</html>
