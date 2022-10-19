<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Catálogos: Áreas - Departamentos</label>
		</div>
	</div>
</div>
<br>
<div class="container">
	<a href="<?=base_url()?>Catalogos/Departamento/Agregar" class="btn btn-azul"><i class="fa fa-plus"
			aria-hidden="true"></i> Agregar Departamento</a>
	<hr>

</div>

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
			<?php foreach($departamentos as $departamento): ?>
			<tr>
				<td><?=$departamento->id?></td>
				<td><?=$departamento->nombre?></td>
				<td>
					<a href="<?=base_url('Catalogos/Departamento/Editar/'.$departamento->id)?>" class='btn btn-azul'><i
							class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;
					<a href="<?=base_url('Catalogos/Departamento/Areas/'.$departamento->id)?>" class='btn btn-azul'
						data-toggle="tooltip" data-placement="top" title="Agregar Áreas"><i class='fa fa-list'
							aria-hidden='true'></i></a>&nbsp;
					<button type='button' class='btn btn-rojo datoselim ajaxConfirm'
						data-url="<?=base_url('Catalogos/Departamento/eliminarDepartamento/'.$departamento->id)?>"
						data-reload="true"><i class='fa fa-trash' aria-hidden='true'></i></button>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<!-- BLOQUE DATATABLE FIN  -->

<!-- BLOQUE VENTANA MODAL ELIMINA -->
<div id="user-id" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header gem-tabla">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="validacionGeneral" action="<?=base_url('Catalogos/Departamento/Eliminar')?>" method="POST"
				onKeypress="if(event.keyCode == 13) event.returnValue = false;">
				<div class="modal-body">
					<div class="control-group">
						<label>Nombre:</label>
						<input type="text" name="nombre" class="form-control" id="nombreregistro" value="" />
						<input type="hidden" name="id" class="form-control" id="idregistro" value="" />
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
<!-- BLOQUE VENTANA MODAL ELIMINA FIN  -->

<script type="text/javascript">
	$(document).ready(function () {
		// DataTable
		var table = $('#example').DataTable({
			'language': {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningún dato disponible en esta tabla",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar en todos los registros:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
				//url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
			},
			'processing': true,

		});



	});
</script>

<script>
	$(document).on("click", ".datoselim", function () {
		var valorid = $(this).data('id');
		var valornombre = $(this).data('nombre');
		$(".modal-body #idregistro").val(valorid);
		$(".modal-body #nombreregistro").val(valornombre);



	});
</script>