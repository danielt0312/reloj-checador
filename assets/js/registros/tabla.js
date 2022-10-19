$(document).ready(function() {
// Setup - add a text input to each footer cell

// DataTable

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
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': tabla_url+'/dataTable',
            'type': "POST",
            'data':function(data) {

                data.id = $('input[type=search]').val();
                data.curp = $('input[type=search]').val();
                data.rfc = $('input[type=search]').val();
                data.nombre = $('input[type=search]').val();
                data.apellido_paterno = $('input[type=search]').val();
                data.apellido_materno = $('input[type=search]').val();
                data.telefono = $('input[type=search]').val();
                data.vitacora = vitacora;
            },
        },
        columnDefs:[{
            targets: 7,
            sortable: false
        }],
        'columns': [
            { data: 'id' },
            { data: 'curp' },
            { data: 'rfc' },
            { data: 'nombre' },
            { data: 'apellido_paterno' },
            { data: 'apellido_materno' },
            { data: 'telefono' },
            { data: 'opciones' },
        ]
    });

} );