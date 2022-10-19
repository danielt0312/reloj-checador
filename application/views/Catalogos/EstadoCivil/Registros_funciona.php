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
          <tfoot>
              <tr>
                  <th>Id</th>
                  <th>Nombre</th>
              </tr>
          </tfoot>
	        
	    </table>
</div>


<script type="text/javascript">
 	$(document).ready(function() {
	    // Setup - add a text input to each footer cell
	    $('#example tfoot th').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="Buscar '+title+'" name="nombre" />' );
	    });	 
	    // DataTable
       
	    var table = $('#example').DataTable(
	    	{
		    	'language': {
	        		url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
	    		},
		    	'processing': true,
	          	'serverSide': true,
	          	'serverMethod': 'post',
	          	'ajax': {
	             'url':'<?=base_url()?>Catalogos/EstadoCivil/Contenido',
               'type': "POST",
               'data':{id:'7'}
	          	},
		        'columns': [
		             { data: 'id' },
		             { data: 'nombre' },
		             { data: 'opciones' },
		        ]	    		
			    
			});	 
	    // Apply the search
	    table.columns().every( function () {
	        var that = this;
	 
	        $('input', this.footer() ).on( 'keyup change clear', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
                      .columns( 2 )
	                    .draw();
	            }
	        });
	    });

});
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

$("#validaelimi").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    //var form = $(this);
    var url = $('.validaelimi').attr('action'); 

    $.ajax({
           type: "POST",
           url: url,
           data:  $('.validaelimi').serialize(), // serializes the form's elements.
           beforeSend: function()  {                    
                    swal({
                        title: "Espere por favor...",
                        //className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })
                    
                },
                success: function(data) {
                  swal(data, {
                      //buttons: true,
                      //buttons: ["Aceptar"],
                      button: {
                        text: "Aceptar",
                        closeModal: false,
                      },
                      icon: "success",
                      
                      // timer: 3000,                      
                    }).then(function() {                       
                        location.reload();
                        //limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    }); 
                    
                },
                error: function(data) {
                  swal("Se produjo un error, favor de volver a intentar.", {
                      buttons: false,
                      icon: "error",
                      timer: 3000,
                    }).then(function() {
                        //limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    }); 
                }
         });


});

</script>
