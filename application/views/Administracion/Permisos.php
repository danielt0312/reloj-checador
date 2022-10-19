<?php
extract($registro[0]);
?>

<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: Roles - Permisos</label>
	<br>
	<a href="<?=base_url()?>Administracion/Roles" class="btn btn-azul">/ Regresar</a>
<hr>


	<div class="panel-group">
                    <?php
                    foreach($cat_menus as $indice)  {

                        echo '<div class="panel panel-default">';
                        echo    '<div class="gem-tabla">';
                        echo        '<h4 class="panel-title gem-tabla">';
                        echo            '<a data-toggle="collapse" href="#collapse_' .$indice['id']. '">' .$indice['nombre_menu']. '</a>';
                        echo            (array_search($indice['id'], $reg_menus)) ? '<a href="' .base_url('Administracion/Roles/offPermisomenu/' .$id. '/' .$indice['id']). '" class="fa fa-toggle-on onAjax" style="float: right;"></a>' : '<a href="' .base_url('Administracion/Roles/onPermisomenu/' .$id. '/' .$indice['id']). '" class="fa fa-toggle-off onAjax" style="float: right;"></a>';
                        echo        '</h4>';
                        echo    '</div>';
                        echo    '<div id="collapse_' .$indice['id']. '" class="panel-collapse in">';
                        echo        '<div class="panel-body ">';

                        echo            '<ul class="list-group">';
                        if(array_search($indice['id'], $reg_menus)) {

                            foreach($cat_submenus as $indice_submenu)   {

                                if($indice_submenu['menu_id'] == $indice['id']) {

                                    echo        '<li class="list-group-item">';
                                    echo        $indice_submenu['nombre_submenu'];
                                    echo        (array_search($indice_submenu['id'], $reg_submenus)) ? '<a href="' .base_url('Administracion/Roles/offPermisosubmenu/' .$id. '/' .$indice_submenu['id']). '" class="fa fa-toggle-on onAjax" style="float: right;"></a>' : '<a href="' .base_url('Administracion/Roles/onPermisosubmenu/' .$id. '/' .$indice_submenu['id']). '" class="fa fa-toggle-off onAjax" style="float: right;"></a>';
                                    echo        '</li>';

                                }

                            }


                        }
                        echo            '</ul>';

                        echo        '</div>';
                        //echo        '<div class="panel-footer">Panel Footer</div>';
                        echo    '</div>';
                        echo '</div>';

                    }
                    ?>

    </div>
</div>
<div style="height: 100px;"></div>

<script>
  $(document).ready(function() {
    $('.formValidate').validate({
      errorElement: 'span',
      submitHandler: function(form) {
        var url = $('.formValidate').attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: $('.formValidate').serialize(),
            success: function(data) {
              $('#result').html(data);
                sweetAlert({title:'Mensaje',text:'¡Registro modificado!' + data + '',html:true,timer:3000,showConfirmButton:false,type:'success'});
            }
        })
      }
    })

      $('.onAjax').click(function(e)    {

          e.preventDefault();
          var url       = $(this).data('url') || $(this).attr('href');
          var mensaje   = $(this).data('mensaje') || "¿Seguro desea realizar esta acción?";
          $.ajax({
              url: url,
              type: 'POST',
              success: function(data)   {

                  sweetAlert({title:'Mensaje',text:data,html:true,timer:3000,showConfirmButton:false,type:'success'});

              }

          })
          window.setTimeout('location.reload()', 3000);

      })
  })
</script>
