<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<style type="text/css">
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

<div class="container"><br>
		<table id="example" class="stripe" style="width:100%">
	        <thead>
	            <tr>
	                <th>Id</th>
	                <th>Clave</th>
	                <th>Nombre</th>
	                <th>Opciones</th>
	            </tr>
	        </thead>
	        
	    </table>
</div>


<script type="text/javascript">
 	$(document).ready(function() {
	    // Setup - add a text input to each footer cell
	    $('#example tfoot th').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
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
	             'url':'<?=base_url()?>Inicio/empList'
	          	},
		        'columns': [
		             { data: 'id' },
		             { data: 'clave' },
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
	                    .draw();
	            }
	        });
	    });
	});
</script>