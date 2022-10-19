<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>

<!-- BLOQUE BUSQUEDA  -->
<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Departamento / <label class="">ÁREAS DE <?=$departamento[0]['nombre']?></label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <a href="<?=base_url()?>Catalogos/Departamento" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
    <a href="<?=base_url('Catalogos/Departamento/agregarArea/'.$departamento[0]['id'])?>" class="btn btn-azulclaro"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Área</a>
    <hr>

</div>
<!-- BLOQUE BUSQUEDA FIN  -->

<!-- BLOQUE DATATABLE -->
<div class="container"><br>
    <table id="example" class="table table-hover shadow" style="width:100%">
        <thead class="gem-tabla">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($areas as $item):
            echo '<tr>';
            echo '<td>'.$item->id.'</td>';
            echo '<td>'.$item->nombre.'</td>';
            echo '<td>';
            echo '<a href="'.base_url('Catalogos/Departamento/editarArea/'.$item->id).'" class="btn btn-azul"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;';
            echo '<button type="button" class="btn btn-rojo ajaxConfirm" data-url="'.base_url('Catalogos/Departamento/eliminarArea/'.$item->id).'" data-reload="true"><i class="fa fa-trash" aria-hidden="true"></i></button>';
            echo '</td>';
            echo '</tr>';
        endforeach;
        ?>
        </tbody>
    </table>
</div>
<!-- BLOQUE DATATABLE FIN  -->

<script type="text/javascript">
    $(document).ready(function() {

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
                }
            });
    } );
</script>