<style type="text/css">
    .tooltip.top .tooltip-arrow {
        border-top-color: #F44336 !important;
    }

    .tooltip-inner {

        background-color: #F44336 !important;
    }
</style>
<div class="contenedor-principal">
    <div class="titulo-principal shadow fondo">
        <div class="container contao ">
            <label>Reporte: Personal</label>
        </div>
    </div>
</div>
<br>
<div class="container">
    <p class="text-brand49 text-justify">Al dar clic en el botón se <b>descargará</b> un documento de formato Excel con
        los registros del personal.</p>
</div>
<center>
    <div class="row">
        <div class="col-md-12">
            <a href="<?=base_url()?>Reportes/Reporte/Personal" class="btn btn-azulclaro reporte">
                <i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 20px;"></i>
                <br>GENERAR EXCEL</a>
        </div>
    </div><br>
</center>
<div style="height: 1000px;"></div>
</div>
<style type="text/css">
    .load {
        background-image: url('<?=base_url()?>assets/img/loads.gif');
        background-repeat: no-repeat;
        background-size: auto;
        background-position: center;
        background-size: 120px;
        background-position-y: 80px;
        height: 150px;
    }
</style>
<script type="text/javascript">
    $('.reporte').click(function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        $.ajax({

            beforeSend: function () {
                swal({
                    title: "Espere por favor...",
                    className: "eliiminadion",
                    buttons: false,
                })
            },
            success: function (data) {
                swal({
                    title: 'Empezando descarga...',
                    className: "load",
                    timer: 4000,
                    buttons: false

                }).then(function () {
                    window.location.href = url;
                });

            },
            error: function (data) {
                swal("Se produjo un error, favor de volver a intentar.", {
                    buttons: false,
                    icon: "error",
                    timer: 3000,
                }).then(function () {});
            }
        })
        return false;
    });
</script>