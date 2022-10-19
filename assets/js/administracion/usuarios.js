var base_url = 'http://' + location.hostname + '/rh';
/**
 * Agregar usuarios
 *
 * Acciones para area y departamento si se selecciona jefe de area
 */

$(document).ready(function(){
    $('#rol_id').change(function(){
        rol = $('#rol_id').val();
        if(rol == 4){
            $('#group-jefe-area').show();
            $('#group-jefe-departamento').show();

            $('#area_id').attr('required', true);
            $('#departamento_id').attr('required', true);
        }else{
            $('#group-jefe-area').hide();
            $('#group-jefe-departamento').hide();

            $('#area_id').attr('required', false);
            $('#area_id').val("0");
            $('#departamento_id').attr('required', false);
            $('#departamento_id').val("0");
        }
    })

    $('#departamento_id').change(function(){
        var departamento_id = $(this).val();
        $('#area_id').empty();
        var lista           = $.ajax({
            url: base_url + '/catalogos/areas/get-area',
            type: 'POST',
            data: {"conditions": {departamento_id:departamento_id}},
            success: function(response){
                var objeto = JSON.parse(response)
                var lista = '';
                $.each(objeto, function(i,item){
                    lista += '<option value="'+item.id+'">'+item.nombre+'</option>';
                })
                $('#area_id').html(lista);
            }

        });
    })
})
