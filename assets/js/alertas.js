$(document).ready(function () {

    /**
     * Confirmación por ajax, recive data-url="url que ejecutara", data.reloar="tru/false si deseas que redireccione", data-reloadurl="url a la que quieres que redireccione
     * despues de ejecutar en segundo plano"
     */
    $('.ajaxConfirm').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var reload = $(this).data('reload') || false;
        var reload_url = $(this).data('reloadurl') || null;
        swal({
            //title: "Are you sure?",
            text: "¿Seguro desea realizar esta acción?",
            icon: "warning",
            buttons: ['Cancelar', 'Continuar'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        beforeSend: function() {
                            swal({
                                text: 'Procesando...',
                                buttons: false,
                            });
                        },
                        success: function(data){
                            console.log(data);
                            respuesta = JSON.parse(data);
                            if(respuesta.error == 0){
                                swal("Operación exitosa", {
                                    icon: "success",
                                    buttons: false,
                                });
                                if(reload == true){setTimeout(
                                    'document.location.reload()',
                                    3000
                                );
                                    if(reload_url){
                                        setTimeout(
                                            reload_url,
                                            3000
                                        );
                                    }else{
                                        setTimeout(
                                            'document.location.reload()',
                                            3000
                                        );
                                    }
                                }
                            }else{
                                swal("Error: error inesperado, por favor intentelo más tarde", {
                                    icon: "warning",
                                    buttons: false,
                                });
                            }
                        }
                    })
                } else {
                    swal("Operación cancelada!");
                }
            });
    })
    /******************************************************************/

})