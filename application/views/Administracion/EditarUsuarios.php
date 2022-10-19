<div style="height: 30px;"></div>
<div class="container">
	<a href="<?=base_url()?>Administracion/Usuarios">Regresar</a>
	<?php foreach ($consulta as $key) {?>
		<form class="validacionGeneral" action="<?=base_url()?>Administracion/Usuarios/Guardar/<?=$key['id']?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;" >

		  <div class="form-group">
		    <label for="exampleFormControlInput1">Nombre del usuario</label>
		    <input type="text" class="form-control required" required id="exampleFormControlInput1" name="nombre" value="<?=$key['nombre']?>" placeholder="Escribir nombre del usuario">
		  </div>

            <div class="form-group">
                <label for="apellido_paterno_id" class="page-description">Apellido Paterno</label>
                <input type="text" class="form-control required" required  name="apellido_paterno" placeholder="Escritir apellido paterno" id="apellido_paterno_id" value="<?=$key['apellido_paterno']?>">
            </div>

            <div class="form-group">
                <label for="apellido_materno_id" class="page-description">Apellido Materno</label>
                <input type="text" class="form-control required" required  name="apellido_materno" placeholder="Escritir apellido paternmaterno" id="apellido_materno_id" value="<?=$key['apellido_materno']?>">
            </div>

            <div class="form-group">
                <label for="movil_id" class="page-description">Movil</label>
                <input type="text" class="form-control required" required  name="movil" placeholder="Escritir teléfono móvil" id="movil_id" value="<?=$key['movil']?>">
            </div>

            <div class="form-group">
                <label for="telefono_id" class="page-description">Teléfono</label>
                <input type="text" class="form-control required" required  name="telefono" placeholder="Escritir teléfono" id="telefono_id" value="<?=$key['telefono']?>">
            </div>

            <div class="form-group">
                <label for="correo_id" class="page-description">Correo</label>
                <input type="text" class="form-control required" required  name="correo" placeholder="Escritir correo electrónico" id="correo_id" value="<?=$key['correo']?>">
            </div>

            <div class="form-group">
                <label for="usuario_id" class="page-description">Usuario</label>
                <input type="text" class="form-control required" required  name="usuario" placeholder="Escritir nombre de usuario" id="usuario_id" value="<?=$key['usuario']?>">
            </div>

            <div class="form-group">
                <label for="rol_id" class="page-description">Rol</label>
                <!--<input type="password" class="form-control required" required name="rol" placeholder="Escritir contraseña" id="rol_id">-->
                <select name="rol_id" id="rol_id" class="form-control required">
                    <?php
                    foreach($roles as $item):
                        $selected = ($key['rol_id'] == $item->id) ? 'selected' : '';
                        echo '<option value="'.$item->id.'" '.$selected.'>'.$item->nombre.'</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group" id="group-jefe-departamento" <?=($key['rol_id'] != 4) ? 'style="display: none;"' : ''?>>
                <label for="departamento_id" class="page-description">Departamento</label>
                <select name="departamento_id" id="departamento_id" class="form-control" <?=($key['rol_id'] == 4) ? 'required' : ''?>>
                    <option value=""></option>
                    <?php
                    foreach($departamentos as $departamento):
                        $selected = ($departamento->id == $key['departamento_id']) ? 'selected' : '';
                        echo '<option value="'.$departamento->id.'" '.$selected.'>'.$departamento->nombre.'</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group" id="group-jefe-area" <?=($key['rol_id'] != 4) ? 'style="display: none;"' : ''?>>
                <label for="area_id" class="page-description">Area</label>
                <select name="area_id" id="area_id" class="form-control" <?=($key['rol_id'] == 4) ? 'required' : ''?>>
                    <option value=""></option>
                    <?php
                    foreach($areas as $area):
                        $selected = ($area->id == $key['area_id']) ? 'selected' : '';
                        echo '<option value="'.$area->id.'" '.$selected.'>'.$area->nombre.'</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            
		  <input type="hidden" name="fecha_modificacion" value="<?=date('Y-m-d H:i:s')?>">
		  <input type="submit" value="Registrar" class="btn btn-info">
		</form>
	<?php }?>
</div>
<div style="height: 400px;"></div>
<script src="<?=base_url('assets/js/administracion/usuarios.js')?>"></script>