<?php
class Correos extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");     
        $this->load->model('Auth/Nav');
        $this->load->library('email');
    }

    public function index(){
        $data['correos'] = $this->Querys->consulta('*', 'rh_cat_correo');
        $this->render('Reloj/Control/correos', $data);
    }

    public function getDatos(){
        $data = array();
        if(empty($_POST)){
            echo json_encode([0 => ['error' => 1, 'mensaje' => 'No se selecciono ninguna opcion']]);
        } else{
            foreach($_POST['data']['personal'] as $indice => $valor){
                if(!is_array($valor)):
                    $data[$indice] = $valor;
                endif;
            }
            $mensaje = '';
            
            if(!empty($data[1])){
                $control = $this->Querys->consulta('personal_id, hora_entrada, hora_salida', 'rh_control', '', array('and' => ['fecha_registro' => date('Y-m-d')]));
                if(empty($control)){
                    $mensaje .= 'NO HUBO NINGUNA ASISTENCIA EL DÍA DE HOY ('.date('Y-m-d').')';
                } else{
                    foreach($control as $valor){
                        $personal = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno', 'rh_personal', '', 'id='.$valor['personal_id']);
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                        $horario_salida = intval(substr($horario[0]['horario'], 6, 2)) * 60 + intval(substr($horario[0]['horario'], 9, 2));
                        $salida = intval(substr($valor['hora_salida'], 0, 2)) * 60 + intval(substr($valor['hora_salida'], 3, 2));
                        $entrada = intval(substr($valor['hora_entrada'], 0, 2)) * 60 + intval(substr($valor['hora_entrada'], 3, 2));

                        if($entrada != 0 and $salida != 0){
                            $mensaje .= '
                                NOMBRE: '.$personal[0]['nombre'].' '.$personal[0]['apellido_paterno'].' '.$personal[0]['apellido_materno'].' <br>
                                HORARIO: '.$horario[0]['horario'].' HORA DE ENTRADA: '.substr($valor['hora_entrada'], 0, 5).' HORA DE SALIDA: '.substr($valor['hora_salida'], 0, 5).' <br><br>
                            ';
                        }
                    }
                }
                $this->crearCorreo($data[1], $mensaje);
                $mensaje = '';
            }
            if(!empty($data[2])){
                $pases = $this->Querys->consulta('*', 'rh_pases', '', array('and' => ['fecha_registro' => date('Y-m-d')]));

                if(empty($pases)){
                    $mensaje .= 'NO HUBO NINGÚN PASE DE SALIDA EL DÍA DE HOY ('.date('Y-m-d').')';
                } else{
                    foreach($pases as $valor){
                        $personal = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno', 'rh_personal', '', 'id='.$valor['personal_id']);
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                        
                        if($valor['motivo'] == 1){
                            $valor['motivo'] = 'PERSONAL';
                        }
                        if($valor['motivo'] == 2){
                            $valor['motivo'] = 'TRABAJO';
                        }
                        
                        $mensaje .= '
                            NOMBRE: '.$personal[0]['nombre'].' '.$personal[0]['apellido_paterno'].' '.$personal[0]['apellido_materno'].' <br>
                            HORARIO: '.$horario[0]['horario'].' HORA DE SALIDA (PASE): '.substr($valor['hora_salida'], 0, 5).' HORA DE ENTRADA (PASE): '.substr($valor['hora_entrada'], 0, 5).' <br>
                            HORA DE SALIDA: '.substr($valor['huella_hora_salida'], 0, 5).' HORA DE REGRESO: '.substr($valor['huella_hora_entrada'], 0, 5).'<br>
                            MOTIVO: '.$valor['motivo'].' DESCRIPCIÓN: '.$valor['descripcion'].' <br><br>
                        ';
                    }
                }
                $this->crearCorreo($data[2], $mensaje);
                $mensaje = '';
            }
            if(!empty($data[3])){
                $inasistencia = $this->Querys->consulta('*', 'rh_control', '', array('and' => ['hora_entrada' => '00:00:00', 'hora_salida' => '00:00:00', 'fecha_registro' => date('Y-m-d')]));
                
                if(empty($inasistencia)){
                    $mensaje.= 'NO HUBO NINGUNA INASISTENCIA EL DÍA DE HOY ('.date('Y-m-d').')';
                } else{
                    foreach($inasistencia as $valor){
                        $personal = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno, correo, telefono', 'rh_personal', '', 'id='.$valor['personal_id']);
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                        
                        $mensaje .= '
                            NOMBRE: '.$personal[0]['nombre'].' '.$personal[0]['apellido_paterno'].' '.$personal[0]['apellido_materno'].' <br>
                            CORREO: '.$personal[0]['correo'].' TELÉFONO: '.$personal[0]['telefono'].' <br><br>
                        ';
                    }
                }

                $this->crearCorreo($data[3], $mensaje);
                $mensaje = '';
            }
            if(!empty($data[4])){
                $retardo = $this->Querys->consulta('*', 'rh_control', '', array('and' => ['fecha_registro' => date('Y-m-d')]));
                
                if(empty($retardo)){
                    $mensaje.= 'NO HUBO NINGUNA ASISTENCIA EL DÍA DE HOY ('.date('Y-m-d').')';
                } else{
                    foreach($retardo as $valor){
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                        $horario_entrada = intval(substr($horario[0]['horario'], 0, 2)) * 60 + intval(substr($horario[0]['horario'], 3, 2));
                        $horario_entradatolerancia = $horario_entrada + 15;
                        $entrada = intval(substr($valor['hora_entrada'], 0, 2)) * 60 + intval(substr($valor['hora_entrada'], 3, 2));

                        if($entrada > $horario_entradatolerancia){
                            $personal = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno, correo, telefono', 'rh_personal', '', 'id='.$valor['personal_id']);
                            $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                            
                            $mensaje .= '
                                NOMBRE: '.$personal[0]['nombre'].' '.$personal[0]['apellido_paterno'].' '.$personal[0]['apellido_materno'].' <br>
                                HORARIO: '.$horario[0]['horario'].' HORA DE ENTRADA: '.substr($valor['hora_entrada'], 0, 5).' <br>
                                CORREO: '.$personal[0]['correo'].' TELÉFONO: '.$personal[0]['telefono'].' <br><br>
                            ';
                        }
                    }

                    if(empty($mensaje)){
                        $mensaje.= 'NO HUBO NINGÚN RETARDO EL DÍA DE HOY ('.date('Y-m-d').')';
                    }
                }

                $this->crearCorreo($data[4], $mensaje);
                $mensaje = '';
            }
            if(!empty($data[5])){
                $temprana = $this->Querys->consulta('*', 'rh_control', '', array('and' => ['fecha_registro' => date('Y-m-d')]));
                
                if(empty($temprana)){
                    $mensaje.= 'NO HUBO NINGUNA ASISTENCIA EL DÍA DE HOY ('.date('Y-m-d').')';
                } else{
                    foreach($temprana as $valor){
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                        $horario_salida = intval(substr($horario[0]['horario'], 6, 2)) * 60 + intval(substr($horario[0]['horario'], 9, 2));
                        $salida = intval(substr($valor['hora_salida'], 0, 2)) * 60 + intval(substr($valor['hora_salida'], 3, 2));
                        $horario_entrada = intval(substr($horario[0]['horario'], 0, 2)) * 60 + intval(substr($horario[0]['horario'], 3, 2));
                        $entrada = intval(substr($valor['hora_entrada'], 0, 2)) * 60 + intval(substr($valor['hora_entrada'], 3, 2));

                        if($entrada != 0 and $salida != 0 and $salida < $horario_salida){
                            $personal = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno, correo, telefono', 'rh_personal', '', 'id='.$valor['personal_id']);
                            $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => date('N'))));
                            
                            $mensaje .= '
                                NOMBRE: '.$personal[0]['nombre'].' '.$personal[0]['apellido_paterno'].' '.$personal[0]['apellido_materno'].' <br>
                                HORARIO: '.$horario[0]['horario'].' HORA DE SALIDA: '.substr($valor['hora_salida'], 0, 5).' <br>
                                CORREO: '.$personal[0]['correo'].' TELÉFONO: '.$personal[0]['telefono'].' <br><br>
                            ';
                        }
                    }

                    if(empty($mensaje)){
                        $mensaje.= 'NO HUBO NINGUNA SALIDA TEMPRANA EL DÍA DE HOY ('.date('Y-m-d').')';
                    }
                }

                $this->crearCorreo($data[5], $mensaje);
                $mensaje = '';
            }
            echo json_encode([0 => ['error' => 0, 'mensaje' => 'Correos enviados correctamente']]);
        }
    }

    public function crearCorreo($asunto, $mensaje){
        //Configuración SMTP y de  Mail
        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '3a97bdd58f26e7',
            'smtp_pass' => 'bb0e3d4d879ff9',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        );

        //Configuración
        $this->email->set_mailtype("html");
        $this->email->set_newline("rn");
        $this->email->initialize($config);

        $this->email->to('cuenta_registro@gmail.com');
        $this->email->from('rh@gmail.com','Recursos Humanos');
        $this->email->subject($asunto);
        $this->email->message($mensaje);

        //Envío
        $this->email->send();
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