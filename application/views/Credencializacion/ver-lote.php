<div class="contenedor-principal">
    <div class="titulo-principal shadow fondo">
        <div class="container contao ">
            <label>Credencialización de personal: Ver Lote</label>
        </div>
    </div>
</div>
<br>
<div class="container mb-5"><br>
    <?php
    if($this->session->userdata('rol_id') != 4){ ?>
        <a href="<?=base_url('credencializacion')?>" class="btn btn-azul"><i class="fa fa-chevron-left" aria-hidden="true"></i> Regresar</a>
        <a href="<?=base_url('credencializacion/descargar-lote/'.$lote->id)?>" class="btn btn-azul"><i class="fa fa-download" aria-hidden="true"></i> Descargar Lote</a>
    <?php } ?>
    

    <table id="example" class="table table-hover shadow" style="width:100%;boder-radius:50px;">
        <thead class="gem-tabla">
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th width="15%">Opciones</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($personal as $empleado):?>
                <tr>
                    <td><?=$empleado->id?></td>
                    <td><?=$empleado->personal_id?></td>
                    <td><?=$empleado->nombre?></td>
                    <td><?=$empleado->apellido_paterno?></td>
                    <td><?=$empleado->apellido_materno?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?=base_url('credencializacion/generar-archivos/'.$empleado->id.'/'.$lote->id)?>" class="btn btn-primary fa fa-file" title="Generar Archivos"></a>
                            <?php if($empleado->estatus_id == 2){ ?>
                                <a href="<?=base_url('credencializacion/descargar-archivos/'.$empleado->id.'/'.$lote->id.'/'.$empleado->personal_id)?>" class="btn btn-primary fa fa-download" title="Descargar"></a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <div style="height:100px;"></div>
</div>



<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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