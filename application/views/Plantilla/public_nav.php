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



                
            </ul>
        </nav>
    </div>
</div>
<!-- Menú -->