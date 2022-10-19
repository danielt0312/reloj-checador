$(document).ready(function(){
  var base_url = 'https://proyectoscete.tamaulipas.gob.mx/rh_identidad/';

  $('.confirmarsesion').on("click", function(e) {
    e.preventDefault();
    var controlador = '/Inicio/logout';
      swal({
          title: "¿Desea cerrar sesión?",
          text: "",
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
                className: "cerrarsesion",
                closeModal: true
              }
            },
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {

            swal("Se cerrará sesión...", {
              className: "eliiminadion",
              buttons: false,
              timer: 3000,
            }).then(function() {
            window.location.href = base_url+controlador;
          });
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
  });


  $('.eliminaRegistro').on("click", function(e) {
        e.preventDefault();
        var controlador = $('.eliminaRegistro').attr('href');
        var info= $(this).data('info');
        var registros="";
        $.each(info.datos, function(i, item) {

            registros += ''+item.nombre+': '+item.valor+'\n';
        })
            swal({
                  title: "¿Desea eliminar el registro?",
                  text: ""+registros,
                  html:true,
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
                            className: "cerrarsesion",
                            closeModal: true
                          }
                        },
                  dangerMode: true,
            })
            .then((willDelete) => {
                  if (willDelete) {

                    swal("Se esta eliminando el registro...", {
                      className: "eliiminadion",
                      buttons: false,
                      timer: 3000,
                    }).then(function() {
                        window.location.href = controlador;
                    });
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
    });

  //validación de formularios
    $('.validaComentario').validate({
        errorElement: 'span',
        submitHandler: function(form) {
          url = $('.validaComentario').attr('action');
          var controlador = '/Inicio';
            $.ajax({
              url: url,
                type: 'POST',
                data: $('.validaComentario').serialize(),
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
                  swal("¡Gracias por participar!", {
                      buttons: false,
                      icon: "success",
                      timer: 3000,
                    }).then(function() {
                        limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });

                },
                error: function(data) {
                  swal("Se produjo un error, favor de volver a intentar.", {
                      buttons: false,
                      icon: "error",
                      timer: 3000,
                    }).then(function() {
                        limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });
                }
            })
        }
    });

    //validación de formularios
    $('.CorreoRestablece').validate({
        errorElement: 'span',
        submitHandler: function(form) {
          url = $('.CorreoRestablece').attr('action');
          var controlador = '/Inicio/CuentaRestablecer';
            $.ajax({
              url: url,
                type: 'POST',
                data: $('.CorreoRestablece').serialize(),
                beforeSend: function()  {

                    swal({
                        title: "Espere por favor...",
                        //className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })

                },
                success: function(data) {
                  swal(data, {
                      buttons: false,
                      icon: "success",
                      timer: 3000,
                    }).then(function() {
                        limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });

                },
                error: function(data) {
                  swal("Se produjo un error, favor de volver a intentar.", {
                      buttons: false,
                      icon: "error",
                      timer: 3000,
                    }).then(function() {
                        limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });
                }
            })
        }
    });

        //validación de formularios
    $('.validacionGeneral').validate({
        errorElement: 'span',
        submitHandler: function(form) {
          url = $('.validacionGeneral').attr('action');
            $.ajax({
              url: url,
                type: 'POST',
                data: $('.validacionGeneral').serialize(),
                beforeSend: function()  {

                    swal({
                        title: "Espere por favor...",
                        //className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })

                },
                success: function(data) {
                  swal(data, {
                      //buttons: true,
                      //buttons: ["Aceptar"],
                      button: {
                        text: "Aceptar",
                        closeModal: false,
                      },
                      icon: "success",

                      // timer: 3000,
                    }).then(function() {
                        location.reload();
                        //limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });

                },
                error: function(data) {
                  swal("Se produjo un error, favor de volver a intentar.", {
                      buttons: false,
                      icon: "error",
                      timer: 3000,
                    }).then(function() {
                        limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });
                }
            })
        }
    });
    $("#validaelimi").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    //var form = $(this);
    var url = $('.validaelimi').attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data:  $('.validaelimi').serialize(), // serializes the form's elements.
           beforeSend: function()  {
                    swal({
                        title: "Espere por favor...",
                        //className: "eliiminadion",
                        //text: dialogo,
                        //icon: "warning",
                        buttons: false,
                        //dangerMode: true,
                    })

                },
                success: function(data) {
                  swal(data, {
                      //buttons: true,
                      //buttons: ["Aceptar"],
                      button: {
                        text: "Aceptar",
                        closeModal: false,
                      },
                      icon: "success",

                      // timer: 3000,
                    }).then(function() {
                        location.reload();
                        //limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });

                },
                error: function(data) {
                  swal("Se produjo un error, favor de volver a intentar.", {
                      buttons: false,
                      icon: "error",
                      timer: 3000,
                    }).then(function() {
                        //limpiarcampos($('.limpiarregistro'));
                        //window.location.href = base_url+controlador;
                    });
                }
         });


});
  function limpiarcampos(dato) {
    $(dato).val('');
  }
});
