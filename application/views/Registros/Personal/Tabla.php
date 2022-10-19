<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

<style type="text/css">
  tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
        background-color: #bc955c;
        color: #fff;
        font-size: 14px;
        font-family: 'Roboto Condensed', sans-serif;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
  }
  .panel {display: none;}
  #op0 {display: block;}

/*  .dataTables_filter {
      float: left !important;
      text-align: left !important;
  }
  .dataTables_wrapper .dataTables_length {
      float: right !important;
  }*/
</style>
<!-- search box container starts  -->
<div class="container">
	<div style="height: 40px;"></div>
	<label class="page-container__title ">&nbsp;Registros</label>
	<br>
  <a href="<?=base_url()?>Registros/Registro/Agregar" class="btn btn-azulclaro" ><i class="fa fa-plus" aria-hidden="true"></i> Agregar Personal</a>
<hr>

        <div class="busqueda" style="display: none;">
                <div class="row">
                  <div class="col-md-12">
                    <form class="form-inline"  method="post" >
                        <div class="row">
                              <div class="form-group col-md-5">
                                <label for="fromdate">&emsp;Búsqueda específica por: </label>
                                  <select class="form-control" id="selectopciones">
                                      <option value="op0" selected>-Seleccionar-</option>
                                      <option value="op1">Id</option>
                                      <option value="op2">RFC</option>
                                      <option value="op3">CURP</option>
                                      <option value="op4">Nombre</option>
                                      <option value="op5">Apellido Paterno</option>
                                      <option value="op6">Apellido Materno</option>
                                      <option value="op7">Teléfono</option>
                                  </select>
                              </div>
                              <div class="panel col-md-5" id="op0"></div>
                              <div class="panel col-md-5" id="op1">
                                  <div class="form-group">
                                    <label for="fromdate">&emsp;Id : </label>
                                    <input type="text"  id="datepicker1" value="" class="form-control"  placeholder="" >
                                  </div>
                              </div>
                              <div class="panel col-md-5" id="op2">
                                  <div class="form-group">
                                    <label for="todate">&emsp;RFC : </label>
                                      <input type="text"  id="datepicker2" value="" class="form-control"  placeholder="" >
                                  </div>
                              </div>
                              <div class="panel col-md-5" id="op3">
                                  <div class="form-group">
                                    <label for="todate">&emsp;CURP : </label>
                                      <input type="text"  id="datepicker3" value="" class="form-control"  placeholder="" >
                                  </div>
                              </div>
                              <div class="panel col-md-5" id="op4">
                                <div class="form-group">
                                  <label for="todate">&emsp;Nombre : </label>
                                    <input type="text"  id="datepicker4" value="" class="form-control"  placeholder="" >
                                </div>
                              </div>
                              <div class="panel col-md-5" id="op5">
                                <div class="form-group">
                                  <label for="todate">&emsp;Apellido Paterno : </label>
                                    <input type="text"  id="datepicker5" value="" class="form-control"  placeholder="" >
                                </div>
                              </div>
                              <div class="panel col-md-5" id="op6">
                                <div class="form-group">
                                  <label for="todate">&emsp;Apellido Materno : </label>
                                    <input type="text"  id="datepicker6" value="" class="form-control"  placeholder="" >
                                </div>
                              </div>
                              <div class="panel col-md-5" id="op7">
                                <div class="form-group">
                                  <label for="todate">&emsp;Teléfono : </label>
                                    <input type="text"  id="datepicker7" value="" class="form-control"  placeholder="" >
                                </div>
                              </div>

                              <div class="form-group col-md-2">
                                  &emsp;&emsp;&emsp;<button type="submit" id="search"  class="btn btn-azulclaro"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                              </div>
                        </div>


                     </form>
                  </div>
                </div>
                </div>
            </div>
        </div>
        <!-- search box container ends  -->

<div class="container"><br>
		<table id="example" class="striped" style="width:100%">
	        <thead class="gem-tabla">
	            <tr>
	                <th>Id</th>
	                <th>CURP</th>
	                <th>RFC</th>
	                <th>Nombre</th>
	                <th>Apellido paterno</th>
	                <th>Apellido materno</th>
	                <th>Teléfono</th>
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
	             	'url':'<?=base_url()?>Registros/Registro/Contenido',
               		'type': "POST",
               		'data':function(data) {
		              data.id = $('#datepicker1').val();
		              data.curp = $('#datepicker2').val();
		              data.rfc = $('#datepicker3').val();
		              data.nombre = $('#datepicker4').val();
		              data.apellido_paterno = $('#datepicker5').val();
		              data.apellido_materno = $('#datepicker6').val();
		              data.telefono = $('#datepicker7').val();
		            },
	          	},
            columnDefs:[{
                targets: 7,
                sortable: false
              }],
		        'columns': [
		             { data: 'id' },
		             { data: 'curp' },
		             { data: 'rfc' },
		             { data: 'nombre' },
		             { data: 'apellido_paterno' },
		             { data: 'apellido_materno' },
		             { data: 'telefono' },
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
	        <h5 class="modal-title" id="exampleModalLabel">Información del registro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    <form class="validacionGeneral" action="<?=base_url('Registros/Registro/Eliminar')?>" method="POST" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <div class="modal-body">
			        <div class="control-group">
			        	<center><label>¿Esta seguro de eliminar el siguiente registro?</label></center>
			        	<br><label>CURP:</label>
                        <input type="text" name="curp" class="form-control" id="curp" value=""/>
                        <label>RFC:</label>
                        <input type="text" name="rfc" class="form-control" id="rfc" value=""/>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="nombreregistro" value=""/>
                        <label>Apellido paterno:</label>
                        <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" value=""/>
                        <label>Apellido materno:</label>
                        <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" value=""/>
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" value=""/>
                        <input type="hidden" name="id" class="form-control" id="idregistro" value=""/>
                    </div>
					<br>
        </div>
      	<div class="modal-footer">
      		<input type="submit" value="Eliminar" class="btn btn-secondary ">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      	</div>
      	</form>

    </div>
  </div>
</div>

<!--Modal detalle-->
<div id="modalDetalleUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header gem-titulo">
                <button type="button" class="close" style="opacity:1;color:white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Ficha del trabajador</h4>
                
            </div>
           
            <div class="modal-body" id="bodyModal">

            </div>
            <div class="modal-footer">
                <a href="#" target="_blank" class="btn btn-azul" id="personalPdf">Imprimir</a>
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>
         
        </div>
    </div>
</div>

<script>
$(document).on("click", ".datoselim", function () {
	var valorid=$(this).data('id');
	var valorcurp=$(this).data('curp');
	var valorrfc=$(this).data('rfc');
	var valornombre=$(this).data('nombre');
	var valorapellidop=$(this).data('apellido_paterno');
	var valorapellidom=$(this).data('apellido_materno');
	var valortelefono=$(this).data('telefono');
    $(".modal-body #idregistro").val(valorid);
    $(".modal-body #curp").val(valorcurp);
    $(".modal-body #nombreregistro").val(valornombre);
    $(".modal-body #apellido_paterno").val(valorapellidop);
    $(".modal-body #apellido_materno").val(valorapellidom);
    $(".modal-body #telefono").val(valortelefono);
});
</script>

<script type="text/javascript">
  $('#selectopciones').change(function(){
    var myID = $(this).val();
    $('.panel').each(function(){
        myID === $(this).attr('id') ? $(this).show() : $(this).hide();
    });
});
</script>

<script>

    $(document).on('click', '.verDetalleModal',function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var personal = $(this).data('personal');
        $('#personalPdf').attr('href', '<?=base_url("Registros/Registro/fichaPersonal/")?>'+personal);
        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            success: function(data){
                $('#bodyModal').empty();
                $('#bodyModal').html(data);
            }
        })

    })

    function pruebaDivAPdf() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#modalDetalleUsuario')[0];

        specialElementHandlers = {
            '#bypassme': function (element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };

        pdf.fromHTML(
            source, 
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, 
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                pdf.save('Prueba.pdf');
            }, margins
        );
    }
     
</script>
