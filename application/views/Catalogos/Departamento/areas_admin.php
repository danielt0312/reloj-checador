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
</style>
<!-- BLOQUE BUSQUEDA  -->
<div class="container">
    <div style="height: 40px;"></div>
    <label class="page-container__title ">&nbsp;Catálogos: Departamento | <label class="text-muted">AREAS DE <?=$departamento[0]['nombre']?></label></label>
    <br>
    <a href="<?=base_url('Catalogos/Departamento/')?>" class="btn btn-azul"><i class="fa fa-plus" aria-hidden="true"></i> Regresar</a>
    <a href="<?=base_url('Catalogos/Departamento/agregarArea/'.$departamento[0]['id'])?>" class="btn btn-azul"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Area</a>
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
            echo '<button type="button" data-id="1" data-nombre="Dirección" class="btn btn-rojo datoselim" data-toggle="modal" data-target="#user-id"><i class="fa fa-trash" aria-hidden="true"></i></button>';
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

                    //url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                }
            });
    } );
</script>