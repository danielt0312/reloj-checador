<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>"cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

<style>
	.inputfile-1+label {
		border: #ebebeb solid 1px;
		padding: 4px 6px 4px 8px;
		font-size: 16px;
		color: #ffffff;
		background: #bc955c;
		font-family: 'Roboto Condensed', sans-serif;
		font-weight: bold;
		text-transform: uppercase;
	}

	.inputfile-1:focus+label,
	.inputfile-1.has-focus+label,
	.inputfile-1+label:hover {
		background-color: #fff;
		/* color: #fff; */
		color: #c4c4c4;
		border: 1px solid #c4c4c4;
	}


	.inputfile+label {
		font-size: 16px;
		/* 20px */
		font-weight: 700;
		text-overflow: ellipsis;
		white-space: nowrap;
		cursor: pointer;
		/* 10px 20px */
	}

	.no-js .inputfile+label {
		display: none;
	}

	.inputfile:focus+label,
	.inputfile.has-focus+label {
		outline: 1px dotted #000;
		outline: -webkit-focus-ring-color auto 5px;
	}

	.inputfile+label * {
		/* pointer-events: none; */
		/* in case of FastClick lib use */
	}
</style>

<style>
	.header{
		display: flex;
	}
	.menu{
		float: right;
	}
</style>

<div class="contenedor-principal">
	<div class="titulo-principal shadow fondo">
		<div class="container contao ">
			<label>Reloj checador: Panel de Control</label>
		</div>
	</div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-2 col-form-label">
            <?= $this->session->userdata('rol_id') != 6 ? "<a href=".base_url('Reloj/Correos/index')." class='btn btn-azul' ><i class='fa fa-plus' aria-hidden='true'></i> Generar Correos</a><hr>" : ''?>
        </div>
        <div class="col-sm-12 col-lg-2 col-form-label">
            <?= $this->session->userdata('rol_id') != 6 ? "<a href=".base_url('Reloj/DepuredControl/agregar')." class='btn btn-azul' ><i class='fa fa-plus' aria-hidden='true'></i> Generar Pase de salida</a><hr>" : ''?>
        </div>
    </div>

	<div class="panel panel-default">
		<div class="gem-titulo">
			<label>Rango de fechas</label>
		</div>
		<div class="panel-body">
			<div class="row fechas">
				<div class="col-sm-12 col-lg-2 col-form-label">
					<label for="start">FECHA INICIAL:</label>
					<input type="date" id="min" name="min" value="" min="" max="">
				</div>
				<div class="col-sm-12 col-lg-2 col-form-label">
					<label for="end">FECHA FINAL:</label>
					<input type="date" id="max" name="max" value="" min="" max="">
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table id="example" class="table table-hover shadow" style="width:100%">
				<thead class="gem-tabla">
				</thead>
			</table>
		</div>
	</div>

	<div style="height:100px;"></div>
</div>

<!--Modal PASES-->
<div id="modalDetalleUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header gem-titulo">
                <button type="button" class="close" style="opacity:1;color:black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Pases de salida</h4>
            </div>
           
            <div class="modal-body" id="bodyModal">
			</div>

            <div class="modal-footer">
                <!-- <a href="#" target="_blank" class="btn btn-azul" id="personalPdf">Imprimir</a> -->
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>
         
        </div>
    </div>
</div>

<!--Modal HORARIO-->
<div id="modalHorarioUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header gem-titulo">
                <button type="button" class="close" style="opacity:1;color:black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="bodyModal_1">
			</div>

            <div class="modal-footer">
                <!-- <a href="#" target="_blank" class="btn btn-azul" id="personalPdf">Imprimir</a> -->
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal Confirmación eliminar -->
<div id="user-id" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="validacionGeneral" action="<?=base_url('Reloj/DepuredPases/eliminarPase')?>" method="POST"
                onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <div class="modal-body">
                    <div class="control-group">
                        <center><label>¿Está seguro de eliminar el siguiente pase?</label></center>
						<label>Fecha:</label>
                        <input type="text" name="fecha" class="form-control" id="fecha" value="" readonly disabled/>
						<label>Hora salida:</label>
                        <input type="text" name="hora_salida" class="form-control" id="hora_salida" value="" readonly disabled/>
						<label>Hora regreso:</label>
                        <input type="text" name="hora_entrada" class="form-control" id="hora_entrada" value="" readonly disabled/>
                        <label>Nombre del empleado:</label>
                        <input type="text" name="nombre" class="form-control" id="nombreregistro" value="" readonly disabled/>
                        <label>Apellido paterno:</label>
                        <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" value="" readonly disabled/>
                        <label>Apellido materno:</label>
                        <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" value="" readonly disabled/>
                        <input type="hidden" name="id" class="form-control" id="idregistro" value="" />
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Eliminar" class="btn btn-secondary">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Modal pases-->
<div id="modalPasesDia" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header gem-titulo">
                <button type="button" class="close" style="opacity:1;color:black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Pase de salida</h4>
            </div>
           
            <div class="modal-body" id="bodyModal_2">
				<iframe id="iframePDF" src="" frameborder="0" scrolling="yes" height="450px" width="100%"></iframe>
			</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>
         
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(document).on('click', '.verPaseModal',function(e){
        e.preventDefault();
		var id = $(this).data('personal');
        var fecha = $(this).data('fecha');
        var url = '<?=base_url('Reloj/Vista/modalPases/')?>'+id+'/'+fecha;

        $.ajax({
			url: url,
			type: 'POST',
			success: function(data){
				$('#bodyModal').empty();
				$('#bodyModal').html(data);
			}
		})
    })
})
</script>

<script>
$(document).ready(function(){
    $(document).on('click', '.verPaseDiaModal',function(e){
        var pase = $(this).data('pase');
        var url = '<?=base_url('')?>'+pase;
		$('#iframePDF').attr('src', url);
    })
})
</script>

<script>
	$(document).on('click', '.verHorario', function(e){
		var id = $(this).data('personal');
		var url = '<?=base_url('Reloj/Vista/modalHorario/')?>'+id;
		$.ajax({
			url: url,
			type: 'POST',
			success: function(data){
				$('#bodyModal_1').empty();
				$('#bodyModal_1').html(data);
			}
		})
	})
</script>

<script>
$(document).ready(function () {
	var data = <?php echo json_encode($mostrar) ?>;
    $('#example').DataTable({
		'order': [1, 'desc'],
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
        },
        data: data,
        columns: [
            // {data: 'personal_id', title: 'ID' },
            {data: 'nombre', title: 'Nombre' },
            {data: 'fecha', title: 'Fecha' },
			{data: 'hora_entrada', title: 'Hora de entrada' },
            {data: 'hora_salida', title: 'Hora de salida' },
			{data: 'pases', title: 'Pases'},
			{data: 'horario', title: 'Horario'}
        ],
    });
});
</script>

<script>
	$(document).ready(function(e) {
		var table = $('#example').DataTable();
		var dateIni = $('#min').val();
		var dateFin = $('#max').val();

		$('#min,#max').keyup( function() {
			table.draw();
		});
	});

$.fn.dataTable.ext.search.push(
    function(oSettings, aData, iDataIndex) {
        var dateIni = $('#min').val();
        var dateFin = $('#max').val();
        var indexCol = 1;
        dateIni = dateIni.replace(/-/g, "");
        dateFin= dateFin.replace(/-/g, "");

        var dateCol = aData[indexCol].replace(/-/g, "");

        if (dateIni === "" && dateFin === ""){
            return true;
        }
        if(dateIni === ""){
            return dateCol <= dateFin;
        }
        if(dateFin === ""){
            return dateCol >= dateIni;
        }
        return dateCol >= dateIni && dateCol <= dateFin;
    }
);
</script>