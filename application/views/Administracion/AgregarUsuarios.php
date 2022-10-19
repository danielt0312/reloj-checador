<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: Usuarios - Agregar</label>
	<br>
	<a href="<?=base_url()?>Administracion/Usuarios" class="btn btn-azul">/ Regresar</a>
	<form class="validacionGeneral" action="<?=base_url('Administracion/Usuarios/Guardar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

	  <div class="form-group">
	    <label for="exampleFormControlInput1" class="page-description">Nombre</label>
	    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" placeholder="Escritir nombre">
	  </div>

        <div class="form-group">
            <label for="apellido_paterno_id" class="page-description">Apellido Paterno</label>
            <input type="text" class="form-control required" required  name="apellido_paterno" placeholder="Escritir apellido paterno" id="apellido_paterno_id">
        </div>

        <div class="form-group">
            <label for="apellido_materno_id" class="page-description">Apellido Materno</label>
            <input type="text" class="form-control required" required  name="apellido_materno" placeholder="Escritir apellido paternmaterno" id="apellido_materno_id">
        </div>

        <div class="form-group">
            <label for="movil_id" class="page-description">Movil</label>
            <input type="text" class="form-control required" required  name="movil" placeholder="Escritir teléfono móvil" id="movil_id">
        </div>

        <div class="form-group">
            <label for="telefono_id" class="page-description">Teléfono</label>
            <input type="text" class="form-control required" required  name="telefono" placeholder="Escritir teléfono" id="telefono_id">
        </div>

        <div class="form-group">
            <label for="correo_id" class="page-description">Correo</label>
            <input type="text" class="form-control required" required  name="correo" placeholder="Escritir correo electrónico" id="correo_id">
        </div>

        <div class="form-group">
            <label for="usuario_id" class="page-description">Usuario</label>
            <input type="text" class="form-control required" required  name="usuario" placeholder="Escritir nombre de usuario" id="usuario_id">
        </div>

        <div class="form-group">
            <label for="password_id" class="page-description">Password</label>
            <input type="password" class="form-control required" required name="password" placeholder="Escritir contraseña" id="password_id">
        </div>

        <div class="form-group">
            <label for="rol_id" class="page-description">Rol</label>
            <!--<input type="password" class="form-control required" required name="rol" placeholder="Escritir contraseña" id="rol_id">-->
            <select name="rol_id" id="rol_id" class="form-control required">
                <?php
                foreach($roles as $item):
                    echo '<option value="'.$item->id.'">'.$item->nombre.'</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group" id="group-jefe-departamento" style="display: none;">
            <label for="departamento_id" class="page-description">Departamento</label>
            <select name="departamento_id" id="departamento_id" class="form-control">
                <option value=""></option>
                <?php
                foreach($departamentos as $departamento):
                    echo '<option value="'.$departamento->id.'">'.$departamento->nombre.'</option>';
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group" id="group-jefe-area" style="display: none">
            <label for="area_id" class="page-description">Area</label>
            <select name="area_id" id="area_id" class="form-control options-list">
            </select>
        </div>

	  <input type="hidden" name="fecha_registro" value="<?=date('Y-m-d H:i:s')?>">
	  <input type="hidden" name="alta_baja" value="1">
	  <input type="submit" value="Registrar" class="btn btn-azulclaro">
	</form>
</div>
<div style="height: 400px;"></div>

<script src="<?=base_url('assets/js/administracion/usuarios.js')?>"></script>
