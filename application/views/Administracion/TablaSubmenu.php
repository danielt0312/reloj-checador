<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>


<style type="text/css">
  tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<!-- search box container starts  -->
<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Administración: Submenú</label>
	<br>
  <a href="<?=base_url()?>Administracion/Submenu/Agregar" class="btn btn-azul" >/ Agregar</a>
<hr>
<div class="gem-titulo">
  panel de busqueda
</div>
        <div class="busqueda">
                <div class="row">
                  <div class="col-md-12">
                    <form class="form-inline"  method="post" >
                      <div class="form-group">
                        <label for="fromdate" class="form-label">&emsp;Id : </label>
                        <input type="text"  id="datepicker1" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="todate" class="form-label">&emsp;Menú : </label>
                          <input type="text"  id="datepicker2" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="todate" class="form-label">&emsp;Nombre : </label>
                          <input type="text"  id="datepicker3" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="todate" class="form-label">&emsp;URL : </label>
                          <input type="text"  id="datepicker4" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="todate" class="form-label">&emsp;Orden : </label>
                          <input type="text"  id="datepicker5" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group" class="form-label">
                          &emsp;&emsp;&emsp;<button type="submit" id="search"  class="btn btn-azulclaro">/ Buscar</button>
                      </div>
                     </form>
                  </div>
                </div>
                </div>
            </div>
        </div>
        <!-- search box container ends  -->

<div class="container"><br>
    <table id="example" class="stripe" style="width:100%">
          <thead class="gem-tabla">
              <tr>
                  <th>Id</th>
                  <th>Menú</th>
                  <th>Nombre</th>
                  <th>URL</th>
                  <th>Orden</th>
                  <th>Opciones</th>
              </tr>
          </thead>


      </table>
</div>


<script type="text/javascript">
  $(document).ready(function() {
      // Setup - add a text input to each footer cell

      // DataTable

      var table = $('#example').DataTable(
        {
            'language': {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar en todos los registros:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

              //url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
          },
          'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'ajax': {
                  'url':'<?=base_url()?>Administracion/Submenu/Contenido',
                  'type': "POST",
                  'data':function(data) {
                    data.id = $('#datepicker1').val();
                    data.menu_id = $('#datepicker2').val();
                    data.nombre = $('#datepicker3').val();
                    data.url = $('#datepicker4').val();
                    data.orden = $('#datepicker5').val();
                  },
              },
            'columns': [
                 { data: 'id' },
                 { data: 'menu_id' },
                 { data: 'nombre' },
                 { data: 'url' },
                 { data: 'orden' },
                 { data: 'opciones' }
            ]

      });

      $('#search').on( 'click change', function (event) {
          event.preventDefault();

          // if($('#datepicker1').val()=="")
          // {
          //   $('#datepicker1').focus();
          // }
          // else if($('#datepicker2').val()=="")
          // {
          //   $('#datepicker2').focus();
          // }
          // else
          // {
            table.draw();
         // }

        } );

} );
</script>



<div id="user-id" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header gem-tabla">
          <h5 class="modal-title" id="exampleModalLabel">Información del registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form class="validacionGeneral" action="<?=base_url('Administracion/Submenu/Eliminar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <div class="modal-body">
              <div class="control-group">
                <center><label>¿Esta seguro de eliminar el siguiente registro?</label></center>
                <br>
                        <label>Menú:</label>
                        <input type="text" name="menu_id" class="form-control" id="menu" value=""/>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value=""/>
                        <label>URL:</label>
                        <input type="text" name="url" class="form-control" id="url" value=""/>
                        <label>Orden:</label>
                        <input type="text" name="orden" class="form-control" id="orden" value=""/>
                        <input type="hidden" name="id" class="form-control" id="idregistro" value=""/>
                    </div>
          <br>
        </div>
        <div class="modal-footer">
          <input type="submit" value="/ Eliminar información" class="btn btn-azulclaro ">
          <button type="button" class="btn btn-rojo" data-dismiss="modal">/ Cancelar</button>
        </div>
        </form>

    </div>
  </div>
</div>

<script>
$(document).on("click", ".datoselim", function () {
  var valorid=$(this).data('id');
  var valormenu=$(this).data('menu_id');
  var valornombre=$(this).data('nombre');
  var valorurl=$(this).data('url');
  var valororden=$(this).data('orden');
    $(".modal-body #idregistro").val(valorid);
    $(".modal-body #menu").val(valormenu);
    $(".modal-body #nombre").val(valornombre);
    $(".modal-body #url").val(valorurl);
    $(".modal-body #orden").val(valororden);
});
</script>
