$(document).ready(function()	{

	//Validacion de formulario con archivo de imagen.
	$('.validaFormulario').validate({
        errorElement: 'span',
        submitHandler: function(form) {
            var data = new FormData();
            var url             = $('.validaFormulario').attr('action');
            var reload        = $('.validaFormulario').data('reload') || false;
            /*
            Función anterior
            
            jQuery.each($('input[type=file]')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });
            */
            jQuery.each($('input[type=file]'), function(i, file) {
                $.each(file.files, function(itertor,item)   {
                    data.append('file-'+i, item);   
                })
            });

            var other_data = $('.validaFormulario').serializeArray();
            $.each(other_data,function(key,input){
                data.append(input.name,input.value);
            });
            
            $.ajax({
            	url: url,
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()  {
                    
                    swal({
                        title: "Espere por favor...",
                        className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })
                    
                },
                success: function(data) {

                    var objeto              = JSON.parse(data);
                    $.each(objeto, function(i, item)    {
                        
                        notificacion(item.error, item.mensaje);
                        if(reload == true)  {
                            recarga();
                            //$('.swal-button--confirm').attr('onclick', 'recarga()');
            
                        }
                        
                    })
                    
                }
            })
        }
    });

    //Validacion de formulario con archivo de imagen.
    $('.validaFormularioagregar').validate({
        errorElement: 'span',
        submitHandler: function(form) {
            var data = new FormData();
            var url             = $('.validaFormularioagregar').attr('action');
            var reload        = $('.validaFormularioagregar').data('reload') || false;
            /*
            Función anterior
            
            jQuery.each($('input[type=file]')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });
            */
            jQuery.each($('input[type=file]'), function(i, file) {
                $.each(file.files, function(itertor,item)   {
                    data.append('file-'+i, item);   
                })
            });

            var other_data = $('.validaFormularioagregar').serializeArray();
            $.each(other_data,function(key,input){
                data.append(input.name,input.value);
            });
            
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function()  {
                    
                    swal({
                        title: "Espere por favor...",
                        className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })
                    
                },
                success: function(data) {

                    var objeto              = JSON.parse(data);
                    $.each(objeto, function(i, item)    {
                        
                        notificacionagregar(item.error, item.mensaje);
                        if(reload == true)  {
            
                            $('.swal-button--confirm').attr('onclick', 'recarga()');
            
                        }
                        
                    })
                    
                }
            })
        }
    });

    /*conformacion*/
    $('.loadAjax').click(function(e) {
        
        e.preventDefault();
        var url             = $(this).data('url');
        var reload          = $(this).data('reload') || false;
        var confirmacion    = $(this).data('confirmacion') || false;
        var mensaje         = $(this).data('mensaje') || '¿Confirma realizar esta acción?';
        var dialogo         = $(this).data('dialogo') || '';
        
        if(confirmacion == true)    {
            
            swal({
                title: mensaje,
                text: dialogo,
                icon: "warning",
                buttons: {
                          cancel: {
                            text: "Cancelar",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                          },
                          confirm: {
                            text: "Aceptar",
                            value: true,
                            visible: true,
                            closeModal: true
                          }
                        },
                dangerMode: true,
            })
            .then((ok) => {
                if (ok) {
                
                $.ajax({
                    url: url,
                    action: 'POST',
                    beforeSend: function()  {
                        swal({
                            title: "Espere por favor...",
                            className: "eliiminadion",
                            //text: dialogo,
                            //icon: "warning",
                            buttons: false,
                            //dangerMode: true,
                        })
                    },
                    success: function(data) {
                        
                        var objeto              = jQuery.parseJSON(data);
                        $.each(objeto, function(i, item)    {
                        
                            notificacionagregar(item.error, item.mensaje);
                            
                            if(reload == true)  {
            
                              $('.swal-button--confirm').attr('onclick', 'recarga()');
            
                            }
                        
                        })
                        
                    }
                })
                
            } else {
                swal({
                        title:"",
                        text:"¡Operación Cancelada!",
                        icon:"error",
                        buttons: false,
                        timer: 3000,
                });
            }
        });
            
        }else   {
            
            $.ajax({
                url: url,
                type: 'POST',
                success: function(data) {
                
                    var objeto          = JSON.parse(data);
                        $.each(objeto, function(i, item)    {
                            
                            notificacion(item.error, item.mensaje);
                            if(reload == true)  {
                                
                                $('.swal-button--confirm').attr('onclick', 'recarga()');
                            }
                            
                        })
                    }
                    
                })
                
            }
            
        
        
    })

    /*Busqueda en grid*/
    $(this).on('click', '.busqueda-por', function(e) {

        e.preventDefault(); //Prevenimos el evento
        var campo = $(this).attr('campo'); //Obtenemos el atributo campo del elemento actual
        var icono = campo.replace('.', '-');
        var texto = $(this).text(); //Obtenemos el texto impreso en el elemento actual

        $('.input-busqueda').attr('placeholder', 'Buscar por '+texto); //Modificamos el atributo placeholder del elemento con clase .input-busqueda para mostrar cuál sera el campo por el que se realizará la búsqueda
        $('.campo-busqueda').attr('value', campo); //Asignamos el valor del campo por el que realizara la busqueda al elemento input para que sea enviado por POST al controlador.
        $('i').removeClass('fa-search');
        $('#'+icono).next().addClass('fa-search');

    })

    /*Listas para select dependiente*/
    $('.selectPadre').change(function(e)  {
        var elemento_dependiente            = $(this).data('dependiente');
        var metodo                          = $(this).data('metodo');
        var seleccionado                    = $(this).val();
        var option                          = "";

        $.ajax({
            url: metodo,
            type: 'POST',
            data: { valor:seleccionado },
            beforeSend: function()  {
                swal('Buscando...');
            },
            success: function(data) {

                var objeto      = JSON.parse(data);
                option += '<option>-Seleccionar-</option>';
                $.each(objeto, function(i, item)    {
                    option += '<option valornom="'+item.legend+'" value="'+item.value+'">'+item.legend+'</option>';
                })
                if (elemento_dependiente=='#localidad_id') {
                    option += '<option value="otra_localidad_id">Otra Localidad</option>';
                }

                swal.close();
                $(elemento_dependiente).empty();
                $(elemento_dependiente).html(option);

            }
        })

    })

})

function notificacionagregar(error, mensaje)    {
    
    if(error == 0)  {
        
        swal(mensaje, {
            icon: "success",
            timer: 3000,   
            button: false
            
        }).then(function() {
            location.reload();
        });     
        
    }else if(error == 1)    {
        
        swal(mensaje, {
            icon: "warning"
            
        });        
        
    }
    
}

function notificacion(error, mensaje)    {
    
    if(error == 0)  {
        
        swal(mensaje, {
            icon: "success",
            timer: 3000,   
            button: false
            
        });     
        
    }else if(error == 1)    {
        
        swal(mensaje, {
            icon: "warning"
            
        });        
        
    }
    
}

function recarga()  {
    
    location.reload();
    
}
  function limpiarcampos(dato) {
    $(dato).val('');
  } 