<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>"cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>

<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />

<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Pases del día</label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <!-- <?= $this->session->userdata('rol_id') != 6 ? "<a href=".base_url('Reloj/DepuredPases/agregar')." class='btn btn-azul' ><i class='fa fa-plus' aria-hidden='true'></i> Agregar Pase de salida</a><hr>" : ''?> -->

    <div class="row">
        <div class="col-d-12">
            <table class="table table-hover shadow" style="width:870px">
                <thead class="gem-tabla">
                <tr>
					<th>Nombre</th>
					<th>Fecha</th>
					<th>Hora de salida</th>
					<th>Hora de entrada</th>
					<th>Motivo</th>
					<th>Descripcion</th>
					<th>Pase</th>
				</tr>
                </thead>
                <tbody>
                <?php
                    if(!empty($pases)){
                        foreach($pases as $item){  ?>
                            <tr>
                                <td><?=$item['nombre']?></td>
                                <td><?=$item['fecha']?></td>
                                <td><?=$item['hora_salida']?></td>
                                <td><?=$item['hora_entrada']?></td>
                                <td><?=$item['motivo']?></td>
                                <td><?=$item['descripcion']?></td>
                                <td><?=$item['opciones']?></td>
                            </tr>
                        <?php } 
                    }
					?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
$(document).ready(function () {
	var data = <?php echo json_encode($mostrar) ?>;
    $('#example').DataTable({
		'language': {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar en todos los regisstros:",
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
        },
        data: data,
        columns: [
            {data: 'personal_id', title: 'ID' },
            {data: 'nombre', title: 'Nombre' },
            {data: 'fecha', title: 'Fecha' },
            {data: 'hora_salida', title: 'Hora de saalida' },
            {data: 'hora_entrada', title: 'Hora de regreso' },
            {data: 'motivo', title: 'Motivo' },
            {data: 'descripcion', title: 'Descripción' },
            {data: 'opciones', title: 'Opciones' },
        ],
    });
});
</script>

<script>
    $(document).on("click", ".datoselim", function () {
        var valorid = $(this).data('id');
        var valornombre = $(this).data('nombre');
        var valorapellidop = $(this).data('apellido_paterno');
        var valorapellidom = $(this).data('apellido_materno');
		var valorfecha = $(this).data('fecha');
        var valorhora_salida = $(this).data('hora_salida');
		var valorhora_entrada = $(this).data('hora_entrada');
        $(".modal-body #idregistro").val(valorid);
        $(".modal-body #nombreregistro").val(valornombre);
        $(".modal-body #apellido_paterno").val(valorapellidop);
        $(".modal-body #apellido_materno").val(valorapellidom);
		$(".modal-body #fecha").val(valorfecha);
        $(".modal-body #hora_salida").val(valorhora_salida);
		$(".modal-body #hora_entrada").val(valorhora_entrada);
    });
</script>