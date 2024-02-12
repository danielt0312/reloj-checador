<style>
    .titulo{
        padding-left: 15px;
        padding-top: 5px;
        color: rgb(0, 0, 0);
        font-size: 23px;
        font-family: 'Roboto Condensed', sans-serif;
        font-weight: bold;
        text-transform: uppercase;
    }
</style>

<div class="row mb10">
    <div class="col-md-12">
        <div class="col-md-12 titulo">
            DATOS personales
            <hr>
        </div>
        <div class="col-md-4 mb5">
            <img class="img-responsive shadow" src="
            <?=(is_file(substr($info_personal->foto, 1))) ? base_url($info_personal->foto).'?' : base_url('assets/img/usuario.png')?>
            " alt="">
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-md-8">
                    <p class="textform"><b>NOMBRE:</b></p>
                    <p for=""><span class="text-muted "><?=$info_personal->nombre.' '.$info_personal->apellido_paterno.' '.$info_personal->apellido_materno?></span></p>
                    <div class="col-md-12">
                <div class="form-group">
                    
                <div class="col-md-12">
                    <label class="grisfor">Horario:</label>
                </div>

            </div>
            <div style="display:">
                <table class="table">
                    <?php foreach($dias_semana as $dia): ?>
                        <tr>
                            <td> 
                                <input class="form-check-input disabled" type="checkbox" id="" <?=(($dia['data']['id'] != 0)) ? 'checked' : ''?> name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][dia]" value="<?=(!is_array($dia)) ? 0 : $dia['data']['cve_dia']?>" disabled>
                                <label class="form-check-label" for=""><?=(!is_array($dia)) ? $dia : $dia['data']['dia']?></label>
                            </td>
                            <td>
                                <?php
                                $entrada = (is_array($dia)) ? explode('-', $dia['data']['horario']) : $dia = '00:00';
                                ?>
                                <input type="time" value="<?=(is_array($dia)) ? reset($entrada) : '00:00'?>" name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][entrada]" class="disabled" disabled>
                                <input type="time" value="<?=(is_array($dia)) ? end($entrada) : '00:00'?>" name="data[horario][<?=(!is_array($dia)) ? $dia : $dia['data']['dia']?>][salida]" class="disabled" disabled>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            </div>

                </div>
            </div>
        </div>
    </div>
</div>