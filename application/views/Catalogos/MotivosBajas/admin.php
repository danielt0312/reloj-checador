<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogo: Motivos Baja</label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <a href="<?=base_url('Catalogos/MotivosBajas/nuevo')?>" class="btn btn-azul" ><i class="fa fa-plus" aria-hidden="true"></i> Agregar Motivo de baja</a>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-hover shadow" style="width:100%">
                <thead class="gem-tabla">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($motivos as $item){ ?>
                    <tr>
                        <td><?=$item->id?></td>
                        <td><?=$item->nombre?></td>
                        <td><?=$item->nombre_estatus?></td>
                        <td>
                            <a href="<?=base_url('Catalogos/MotivosBajas/editar/'.$item->id)?>" class="btn btn-azul"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                            <button data-url="<?=base_url('Catalogos/MotivosBajas/eliminar/'.$item->id)?>" class="btn btn-rojo ajaxConfirm" data-reload="true"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
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

<script>
    $(document).ready(function(){

        $('.loadAjax').click(function(e){
            e.preventDefault();
            swal({
                title: "¿Esta seguro de realizar esta acción?",
                //text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: ['Cancelar', 'Continuar'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Operación cancelada");
                    }
                });
        })
    })
</script>