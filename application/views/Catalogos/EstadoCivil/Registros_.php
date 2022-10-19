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
        <div class="well">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                  <div class="col-md-10 col-md-offset-2">
                    <form class="form-inline"  method="post" >
                      <div class="form-group">
                        <label for="fromdate">&emsp;Id : </label>
                        <input type="text"  id="datepicker1" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="todate">&emsp;Nombre : </label>
                          <input type="text"  id="datepicker2" value="" class="form-control"  placeholder="" >
                      </div>
                      <div class="form-group">
                          &emsp;&emsp;&emsp;<button type="submit" id="search"  class="btn btn-default">Buscar</button>
                      </div>
                     </form> 
                  </div>
                </div>
                </div>
            </div>
        </div>
        <!-- search box container ends  -->

<div class="container"><br>
	<a href="<?=base_url()?>Catalogos/EstadoCivil/Agregar">Agregar</a>
		<table id="example" class="stripe" style="width:100%">
	        <thead>
	            <tr>
	                <th>Id</th>
	                <th>Nombre</th>
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
	             'url':'<?=base_url()?>Catalogos/EstadoCivil/Contenido',
               'type': "POST",
               'data':function(data) {
              data.id = $('#datepicker1').val();
              data.nombre = $('#datepicker2').val();
               // data.<?php echo $this->security->get_csrf_token_name(); ?> = "<?php echo $this->security->get_csrf_hash(); ?>";
               },
               //'data':{id:$('#datepicker1').val()}
	          	},
		        'columns': [
		             { data: 'id' },
		             { data: 'nombre' },
		             { data: 'opciones' },
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
      
	    <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    <form class="validacionGeneral" action="<?=base_url('Catalogos/EstadoCivil/Eliminar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <div class="modal-body">        
			        <div class="control-group">
			        	<label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="nombreregistro" value=""/>
                        <input type="hidden" name="id" class="form-control" id="idregistro" value=""/>
                    </div>
					<br>
        </div>
      	<div class="modal-footer">
      		<input type="submit" value="Enviar información" class="btn btn-secondary ">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      	</div>
      	</form>
      
    </div>
  </div>
</div>

<script>
$(document).on("click", ".datoselim", function () {
	var valorid=$(this).data('id');
	var valornombre=$(this).data('nombre');
    $(".modal-body #idregistro").val(valorid);
    $(".modal-body #nombreregistro").val(valornombre);
});
</script>


