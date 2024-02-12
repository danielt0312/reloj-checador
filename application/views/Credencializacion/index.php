<div class="contenedor-principal">
    <div class="titulo-principal shadow fondo">
        <div class="container contao ">
            <label>Credencialización de personal</label>
        </div>
    </div>
</div>
<br>
<div class="container mb-5"><br>
    <?php
    if($this->session->userdata('rol_id') != 4){ ?>
    <button class="btn btn-azul" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"
            aria-hidden="true"></i> Nueva Credencialización</button>
    <button class="btn btn-azul" data-toggle="modal" data-target="#modal-buscar"><i class="fa fa-search"
            aria-hidden="true"></i> Buscar empleado</button>
    <?php } ?>
    <hr>

    <table id="example" class="table table-hover shadow" style="width:100%">
        <thead class="gem-tabla">
            <tr>
                <th>Lote</th>
                <th>Área</th>
                <th>Fecha Creación</th>
                <th>Total</th>
                <th>Generados</th>
                <th>Pendientes</th>
                <th>Estatus</th>
                <th width="15%">Opciones</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo lote de credenciales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('credencializacion/crear-lote')?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="area-select">Área</label>
                        <select name="area_id" id="area-select" class="form-control" required>
                            <option value="" selected style="display: none;">--Seleccióne el área---</option>
                            <?php foreach($areas as $area): ?>
                            <option value="<?=$area->id?>"><?=$area->nombre?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="volument-input">Volumen</label>
                        <input name="total" type="number" class="form-control" id="volument-input" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="generados-input">Generados</label>
                        <input name="generados" type="number" class="form-control" id="generados-input" readonly
                            value="0">
                    </div>
                    <div class="form-group">
                        <label for="pendientes-input">Pendientes</label>
                        <input name="pendientes" type="number" class="form-control" id="pendientes-input" readonly
                            required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" value="Continuar">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal búsqueda -->
<div class="modal fade" id="modal-buscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar empleado en los lotes generados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-info"><b>Nota: </b>Si no encuentra el empleado que busca, es probable que no se
                    haya creado el registro en los lotes existentes</div>

                <div class="row">

                    <div class="col-md-12 mb5">
                        <div class="input-group ">
                            <input type="text" id="buscar-empleado-curp" class="form-control" placeholder="Ingrese CURP"
                                aria-describedby="basic-addon2" maxlength="18" minlength="18">
                            <a href="#" class="input-group-addon" id="buscar-empleado">Buscar</a>
                        </div>
                    </div>

                    <div id="datos-empleado" style="display: none;">

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#area-select').change(function (e) {
            area = $(this).val();
            console.log(area);
            $.ajax({
                url: "<?=base_url('credencializacion/cantidad-personal-area')?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    area: area
                },
                success: function (data) {
                    $('#volument-input').val(data);
                    $('#pendientes-input').val(data);
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell

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
            },
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': "<?=base_url('credencializacion/data-table')?>",
                'type': "POST",
                'data': function (data) {

                    data.id = $('input[type=search]').val();
                    data.nombre_area = $('input[type=search]').val();
                    data.estatus = $('input[type=search]').val();
                },
            },
            columnDefs: [{
                targets: 7,
                sortable: false
            }],
            'columns': [{
                    data: 'id'
                },
                {
                    data: 'nombre_area'
                },
                {
                    data: 'fecha_registro'
                },
                {
                    data: 'total'
                },
                {
                    data: 'generados'
                },
                {
                    data: 'pendientes'
                },
                {
                    data: 'estatus'
                },
                {
                    data: 'opciones'
                },
            ]
        });

        $('#buscar-empleado').click(function (e) {
            e.preventDefault();
            curp = $('#buscar-empleado-curp').val();
            if (curp.length == 18) {
                $.ajax({
                    url: "<?=base_url('credencializacion/buscar-empleado')?>",
                    type: 'POST',
                    dataType: 'HTML',
                    data: {
                        curp: curp
                    },
                    success: function (data) {
                        $('#datos-empleado').show();
                        $('#datos-empleado').empty();
                        $('#datos-empleado').html(data);

                    }
                })
            }
        })



    });
</script>