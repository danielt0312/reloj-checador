<div class="contenedor-principal">
    <div class="titulo-principal shadow fondo">
        <div class="container contao ">
            <label>Registros</label>
        </div>
    </div>
</div>
<br>
<div class="container mb-5"><br>
    <div class="row">
        <?php 
    if($this->session->userdata('rol_id') != 4 && $this->session->userdata('rol_id') != 6){ ?>
    <div class="col-md-3">
    <a href="<?=base_url('registros/'.$this->uri->segment(2).'/agregar')?>" class="btn btn-azulclaro"><i
                class="fa fa-plus" aria-hidden="true"></i> Agregar Personal</a>
    </div>
    <div class="col-md-4 col-md-offset-5">
    <form class="validaFormulario" action="<?=base_url('Registros/Registro/activaredicionrh')?>" method="POST"
            onKeypress="if(event.keyCode == 13) event.returnValue = false;">
            <?php if($opedicion == 1){ ?>
            <input class="coupon_question" type="checkbox" name="opedicion" value="0" checked /><p class="textform">&nbsp;DESACTIVAR EDICIÓN</p> 
            <?php } else{?>
            <input class="coupon_question" type="checkbox" name="opedicion" value="1" /><p class="textform">&nbsp;ACTIVAR EDICIÓN</p> 
            <?php } ?>
            <input type="submit" value="Aceptar" class="btn btn-verde btnguarda">
        </form>
    </div>


      


        <?php } ?>
    </div>
    <hr>
    <table id="example" class="table table-hover shadow" style="width:100%">
        <thead class="gem-tabla">
            <tr>
                <th>Id</th>
                <th>CURP</th>
                <th>RFC</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Teléfono</th>
                <th width="20%">Opciones</th>
            </tr>
        </thead>


    </table>
</div>

<!--Modal detalle-->
<div id="modalDetalleUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="panel panel-default">
                <div class="gem-titulo">
                    <label>FICHA INFORMATIVA DE PERSONAL</label>
                </div>

            </div>

            <div class="panel-body" id="bodyModal">

            </div>
            <div class="modal-footer">
                <?php if($this->session->userdata('rol_id') == 1 || $this->session->userdata('rol_id') == 2){?>
                <?=($this->uri->segment(2) == 'personal-activo') ? '<a href="#" target="_blank" class="btn btn-azul" id="personalGafete">Gafete (frontal)</a> <a href="#" target="_blank" class="btn btn-azul" id="personalGafeteTrasera">Gafete (trasera)</a>' : ''?>
                <?php } ?>
                <a href="#" target="_blank" class="btn btn-azul" id="personalPdf">Imprimir</a>
                <button type="button" class="btn btn-azul" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>

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
            <form class="validacionGeneral" action="<?=base_url('Registros/Registro/eliminarPersonal')?>" method="POST"
                onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                <div class="modal-body">
                    <div class="control-group">
                        <center><label>¿Esta seguro de eliminar el siguiente registro?</label></center>
                        <br><label>CURP:</label>
                        <input type="text" name="curp" class="form-control" id="curp" value="" />
                        <label>RFC:</label>
                        <input type="text" name="rfc" class="form-control" id="rfc" value="" />
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" id="nombreregistro" value="" />
                        <label>Apellido paterno:</label>
                        <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno"
                            value="" />
                        <label>Apellido materno:</label>
                        <input type="text" name="apellido_materno" class="form-control" id="apellido_materno"
                            value="" />
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" value="" />
                        <input type="hidden" name="id" class="form-control" id="idregistro" value="" />
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Eliminar" class="btn btn-secondary ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div style="height:100px;"></div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<script>
    vitacora = "<?=$vitacora?>";
    tabla_url = "<?=$this->uri->segment(2)?>";
</script>
<script type="text/javascript" src="<?=base_url('assets/js/registros/tabla.js')?>"></script>

<script src="<?=base_url('assets/js/registros/personal.js')?>"></script>

<script>
    $(document).on("click", ".datoselim", function () {
        var valorid = $(this).data('id');
        var valorcurp = $(this).data('curp');
        var valorrfc = $(this).data('rfc');
        var valornombre = $(this).data('nombre');
        var valorapellidop = $(this).data('apellido_paterno');
        var valorapellidom = $(this).data('apellido_materno');
        var valortelefono = $(this).data('telefono');
        $(".modal-body #idregistro").val(valorid);
        $(".modal-body #curp").val(valorcurp);
        $(".modal-body #nombreregistro").val(valornombre);
        $(".modal-body #apellido_paterno").val(valorapellidop);
        $(".modal-body #apellido_materno").val(valorapellidom);
        $(".modal-body #telefono").val(valortelefono);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        //validación de formularios
        $('.validaFormulario').validate({
            //errorElement: 'span',
            submitHandler: function (form) {
                var data = new FormData();
                var url = $('.validaFormulario').attr('action');


                // jQuery.each($('input[type=file]')[0].files, function (i, file) {
                // 	data.append('file-' + i, file);
                // });
                var other_data = $('.validaFormulario').serializeArray();
                $.each(other_data, function (key, input) {
                    data.append(input.name, input.value);
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {

                        swal({
                            title: "Espere por favor...",
                            //text: dialogo,
                            //icon: "warning",
                            buttons: false,
                            //dangerMode: true,
                        })

                    },
                    success: function (data) {

                        var objeto = JSON.parse(data);
                        $.each(objeto, function (i, item) {

                            notificacion(item.error, item.mensaje);

                        })

                    }
                })
            }
        });
    });

    function notificacion(error, mensaje) {
        //var base_url = '<?=base_url();?>Registros/Registro/Agregar';
        if (error == 0) {
            swal(mensaje, {
                buttons: false,
                icon: "success",
                timer: 5000,
            }).then(function () {
                //window.location.href = base_url;
                location.reload();
            });

        } else if (error == 1) {

            swal(mensaje, {
                icon: "warning"

            });

        }
    }
</script>

<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    tippy('.tip-blue')

    tippy('.tip-red')
</script>