<?php

class Vista extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");     
        $this->load->model('Auth/Nav');
        $this->load->model([
            'Registros/Personal',
            'Registros/HorariosPersonal'
        ]);
    }

    public function index(){
        $this->render('Reloj/Vista/vista');
    }

    public function modalHuella($huella = null){ 
        $info['personal'] = $this->Querys->consulta('*', 'rh_personal', '', 'huella='.$huella);
        if(!empty($info['personal'])){
            $info['info_personal']      = $this->Personal->getPeronal(['id' => $info['personal'][0]['id']])[0];
            $info['horarios']           = $this->HorariosPersonal->getHorariosPersonal(['personal_id' => $info['personal'][0]['id']]);
            $info['dias_semana']        = $this->HorariosPersonal->dias;
            $this->load->view('Reloj/Vista/mostrar', $info);
        }
    }

    public function modalHorario($personal_id = null){ 
        $info['personal'] = $this->Querys->consulta('*', 'rh_personal', '', 'id='.$personal_id);
        if(!empty($info['personal'])){
            $info['info_personal'] = $this->Personal->getPeronal(['id' => $info['personal'][0]['id']])[0];
            $info['horarios']           = $this->HorariosPersonal->getHorariosPersonal(['personal_id' => $info['personal'][0]['id']]);
            $info['dias_semana']        = $this->HorariosPersonal->dias;
            $this->load->view('Reloj/Vista/mostrar', $info);
        }
    }

    public function modalPases($personal_id = null, $fecha = null){
        $info['personal'] = $this->Querys->consulta('*', 'rh_pases', '', 'personal_id='.$personal_id);
        if(!empty($info['personal'])){
            foreach($info['personal'] as $indice => $valor){
                $consulta   = $this->Querys->consulta('*', 'rh_personal', '', array('and' => array('id' => $valor['personal_id'], 'alta_baja' => 1)));
                $motivo     = $this->Querys->consulta('nombre', 'rh_cat_motivos_pase', '', 'id='.$valor['motivo']);

                $fecha_pase = $valor['fecha_registro'];

                if($fecha_pase == $fecha){
                    $info['pases'][$indice] = array(
                        'personal_id'       => $valor['personal_id'],
                        'nombre'            => $consulta[0]['nombre'] . ' ' .$consulta[0]['apellido_paterno'] . ' ' . $consulta[0]['apellido_materno'],
                        'fecha'             => $valor['fecha_registro'],
                        'hora_salida'       => substr($valor['hora_salida'], 0, 5),
                        'hora_entrada'      => substr($valor['hora_entrada'], 0, 5),
                        'motivo'            => $motivo[0]['nombre'],
                        'descripcion'       => $valor['descripcion'],
                        // 'opciones'          => $this->session->userdata('rol_id') != 6 ? "<div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' class='btn btn-azulclaro verPaseModal' data-personal='".($valor['personal_id'])."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='".$valor['id']."' data-fecha='".substr($valor['fecha_salida'], 0, 10)."' data-nombre='".$consulta[0]['nombre']."' data-apellido_paterno='".$consulta[0]['apellido_paterno']."' data-apellido_materno='".$consulta[0]['apellido_materno']."' data-hora_salida='".substr($valor['fecha_salida'], 11, 5)."' data-hora_entrada='".substr($valor['fecha_entrada'], 11, 5)."' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button> </div>" : "<div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' class='btn btn-azulclaro verPaseModal' data-personal='".($valor['personal_id'])."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a></div>"
                        'opciones'          => "<div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' class='btn btn-azulclaro verPaseDiaModal' data-personal='".($valor['personal_id'])."' data-pase='".$valor['pase_pdf']."' data-toggle='modal' data-target='#modalPasesDia'><i class='fa fa-eye' aria-hidden='true'></i></a></div>"
                    );
                }
            }
            $this->load->view('Reloj/Pases/pases', $info);
        }
    }

    public function respuesta($huella = null){
        $info['personal'] = $this->Querys->consulta('*', 'rh_personal', '', 'huella='.$huella);
        if(!empty($info['personal'])){
            $mensaje = $this->getHuella($huella);
            echo json_encode([0 => $mensaje]);
        }
        else{
            echo json_encode([0 => ['error' => 1, 'mensaje' => 'Huella no identificada']]);
        }
    }

    public function getHuella($huella = null){
        $datos = $this->Querys->consulta('*', 'rh_personal', '', array('and' => array('huella' => $huella, 'alta_baja' => 1)));
        $mensaje = array();    
        if(empty($datos)){
            $mensaje = array('error' => 1, 'mensaje' => 'Huella no identificada');
        } else{            
            $id = $datos[0]['id'];
            $fecha = array(
                'entrada'   => $this->Querys->consulta('*', 'rh_control', '', array('and' => ['personal_id' => $id, 'fecha_registro' => date('Y-m-d')])),
                'salida'    => $this->Querys->consulta('*', 'rh_control', '', array('and' => ['personal_id' => $id, 'fecha_registro' => date('Y-m-d')])),
            );

            if(is_null($fecha)){
                $mensaje = array('error' => 1, 'mensaje' => 'Aún no se ha hecho el registro de este personal');
            } elseif($fecha['entrada'][0]['hora_entrada'] != '00:00:00' and $fecha['entrada'][0]['hora_salida'] != '00:00:00'){
                $mensaje = array('error' => 1, 'mensaje' => 'Ya no hay entrada/salida');
            } else{
                $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => ['personal_id' => $id, 'cve_dia' => date('N')]));
                $tiempo = intval(date('H')) * 60 + intval(date('i'));

                if($fecha['entrada'][0]['hora_entrada'] == '00:00:00'){
                    $horario_entrada = intval(substr($horario[0]['horario'], 0, 2)) * 60 + intval(substr($horario[0]['horario'], 3, 2));
                    $horario_entradatolerancia = $horario_entrada + 15;
                    $horario_salida = intval(substr($horario[0]['horario'], 6, 2)) * 60 + intval(substr($horario[0]['horario'], 9, 2));
                    
                    if($tiempo < $horario_entrada or $tiempo > $horario_salida){
                        $mensaje = array('error' => 1, 'mensaje' => 'Debes de entrar a la hora de entrada de tu horario');
                    } else{
                        $this->Querys->guardar('rh_control', ['hora_entrada' => date('H:i:00')], array('and' => ['personal_id' => $id, 'fecha_registro' => date('Y-m-d')]));
                        $mensaje = array('error' => 0, 'mensaje' => 'Registro completado');
                    } 

                } elseif($fecha['salida'][0]['hora_salida'] == '00:00:00'){
                    $pases = $this->Querys->consulta('*', 'rh_pases', '', array('and' => ['personal_id' => $id, 'fecha_registro' => date('Y-m-d')]));
                    if(!empty($pases)){
                        $bool_salida = true;
                        $bool_entrada = true;

                        foreach($pases as $indice => $valor){
                            $pase_salida = intval(substr($valor['hora_salida'], 0, 2)) * 60 + intval(substr($valor['hora_salida'], 3, 2));
                            $pase_entrada = intval(substr($valor['hora_entrada'], 0, 2)) * 60 + intval(substr($valor['hora_entrada'], 3, 2));
                            $bool_salida = true;
                            $bool_entrada = true;

                            if($tiempo >= $pase_salida and $tiempo <= $pase_entrada and $valor['huella_hora_entrada'] == '00:00:00' and $valor['huella_hora_salida'] == '00:00:00'){
                                $this->Querys->guardar('rh_pases', array('huella_hora_salida' => date('H:i:00')), array('and' => ['personal_id' => $id, 'hora_entrada' => $valor['hora_entrada'], 'hora_salida' => $valor['hora_salida'], 'fecha_registro' => date('Y-m-d')]));
                                $bool_salida = false;
                                $mensaje = array('error' => 0, 'mensaje' => 'Registro (salida) completado del pase #'.($indice+1));
                            } elseif($tiempo >= $pase_salida and $valor['huella_hora_entrada'] == '00:00:00' and $valor['huella_hora_salida'] != '00:00:00'){
                                $this->Querys->guardar('rh_pases', array('huella_hora_entrada' => date('H:i:00')), array('and' => ['personal_id' => $id, 'hora_entrada' => $valor['hora_entrada'], 'hora_salida' => $valor['hora_salida'], 'fecha_registro' => date('Y-m-d')]));
                                $bool_entrada = false;
                                $mensaje = array('error' => 0, 'mensaje' => 'Registro (entrada) completado del pase #'.($indice+1));
                            }
                        }

                        if($bool_salida and $bool_entrada){
                            $this->Querys->guardar('rh_control', ['hora_salida' => date('H:i:00')], array('and' => ['personal_id' => $id, 'hora_salida' => '00:00:00', 'fecha_registro' => date('Y-m-d')]));
                            $mensaje = array('error' => 0, 'mensaje' => 'Registro completado, que tengas buen día');
                        }
                    } else{
                        $this->Querys->guardar('rh_control', ['hora_salida' => date('H:i:00')], array('and' => ['personal_id' => $id, 'hora_salida' => '00:00:00', 'fecha_registro' => date('Y-m-d')]));
                        $mensaje = array('error' => 0, 'mensaje' => 'Registro completado, que tengas buen día');
                    }
                } 
            }
        }
        return $mensaje;
    }

    public function render($view, $data = null){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view($view, $data);
        $this->load->view('Plantilla/v_footer');
    }
}