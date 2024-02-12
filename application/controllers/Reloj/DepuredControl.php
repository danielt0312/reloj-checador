<?php
class DepuredControl extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");     
        $this->load->model('Auth/Nav');
        $this->seguridad(); 
    }

    
    public function index(){
        $data = array();
        $horarios = $this->Querys->consulta('personal_id, horario', 'rh_horarios', array(0 => ['tipo' => 'INNER', 'tabla' => 'rh_personal', 'join' => 'rh_horarios.personal_id=rh_personal.id ']), 'cve_dia='.date('N'));
        if(!empty($horarios)){
            foreach($horarios as $valor){
                $data['registro'] = $this->Querys->consulta('*', 'rh_control', '', array('and' => ['personal_id' => $valor['personal_id'], 'fecha_registro' => date('Y-m-d')]));
                
                if(empty($data['registro'])){
                    $this->crearRegistro($valor['personal_id']);
                }
            }
        }

        $data['mostrar'] = $this->Querys->consulta('*', 'rh_control');
        
        foreach($data['mostrar'] as $indice => $valor){
            $horario    = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $valor['personal_id'], 'cve_dia' => $valor['cve_dia'])));
            $consulta   = $this->Querys->consulta('nombre, id, apellido_paterno, apellido_materno', 'rh_personal', '', 'id='.$valor['personal_id']);
            $huella     = $this->Querys->consulta('huella', 'rh_personal', '', 'id='.$valor['personal_id']);
            $pase_diario = $this->Querys->consulta('personal_id, fecha_registro, pase_pdf', 'rh_pases', '', 'personal_id='.$valor['personal_id']);

            $fecha = $valor['fecha_registro'];
            $pases = 'Sin registros';
            if(!empty($pase_diario)){
                $dia = $valor['fecha_registro'];
                foreach($pase_diario as $pase){
                    $p = $pase['fecha_registro'];
                    if($dia == $p){
                        $pases = "<center> <div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' data-personal='".($valor['personal_id'])."' data-fecha='".$fecha."' class='btn btn-azulclaro verPaseModal' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a></div> </center>";
                    }
                }
            }

            $data['mostrar'][$indice] = array(
                'personal_id'   => $consulta[0]['id'],
                'nombre'        => $consulta[0]['nombre'] . ' ' . $consulta[0]['apellido_paterno'] . ' ' . $consulta[0]['apellido_materno'],
                'fecha'         => $valor['fecha_registro'],
                'hora_entrada'  => substr($valor['hora_entrada'], 0, 5),
                'hora_salida'   => substr($valor['hora_salida'], 0, 5),
                'pases'         => $pases,
                'horario'       => $this->session->userdata('rol_id') != 6 ? "<center> <div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' class='btn btn-azulclaro verHorario' data-personal='".($valor['personal_id'])."' data-toggle='modal' data-target='#modalHorarioUsuario'><i class='fa fa-calendar' aria-hidden='true'></i></a></div> </center>" : "<div class='btn-group'><a href='' data-url='".md5($valor['personal_id'])."' class='btn btn-azulclaro verHorario' data-personal='".($valor['personal_id'])."' data-toggle='modal' data-target='#modalHorarioUsuario'><i class='fa fa-calendar' aria-hidden='true'></i></a></div>",
            );
        }
        $this->render('Reloj/Control/control', $data);
    }

    public function crearRegistro($id){
        $datos = array(
            'personal_id'      => $id,
            'cve_dia'          => date('N'),
            'hora_entrada'     => '00:00:00',
            'hora_salida'      => '00:00:00' ,
            'fecha_registro'   => date('Y-m-d'),
        );

        switch(date('N')){
            case 1: $datos['dia']   = 'Lunes';    break;
            case 2: $datos['dia']   = 'Martes';    break;
            case 3: $datos['dia']   = 'Miercoles';    break;
            case 4: $datos['dia']   = 'Jueves';    break;
            case 5: $datos['dia']   = 'Viernes';    break;
            case 6: $datos['dia']   = 'Sabado'; break;
            case 7: $datos['dia']   = 'Domingo'; break;
            default: $datos['dia']  = '';  break;
        }

        $this->Querys->guardar('rh_control', $datos);
    }

    public function getDatos(){
        $data = array();        
        foreach($_POST['data']['personal'] as $indice => $valor){
            if(!is_array($valor)):
                $data[$indice] = $valor;
            endif;
        }
        
        if(empty($data['opcion'])){
            echo json_encode([0 => ['error' => 1, 'mensaje' => 'No se selecciono ningún motivo']]);
        } else{
            // Validación de formato de hora (hh:mmm, 24hrs)
            $busqueda_salida = strpos($data['hora_salida'], ':');
            $busqueda_entrada = strpos($data['hora_entrada'], ':');
            if($busqueda_salida === false or $busqueda_salida != 2 or $busqueda_entrada === false or $busqueda_entrada !=2 or strlen($data['hora_entrada']) != 5 or strlen($data['hora_salida']) != 5 or substr($data['hora_salida'], 0, 2) > 23 or substr($data['hora_entrada'], 3, 2) > 59 or substr($data['hora_entrada'], 0, 2) > 23 or substr($data['hora_salida'], 3, 2) > 59){
                echo json_encode([0 => ['error' => 1, 'mensaje' => 'Las hora/s está mal escritas']]);
            } else{
                // Conversión de la hora (hh:mm) a unidades minuto (mm)
                $pase_salida = intval(substr($data['hora_salida'], 0, 2)) * 60 + intval(substr($data['hora_salida'], 3));
                $pase_entrada = intval(substr($data['hora_entrada'], 0, 2)) * 60 + intval(substr($data['hora_entrada'], 3));

                // Validación de la hora/minuto de salida y entrada del pase 
                if($pase_salida >= $pase_entrada){
                    echo json_encode([0 => ['error' => 1, 'mensaje' => 'Las horas de entrada o salida no corresponden']]);
                } else{
                    $consulta = $this->Querys->consulta('id, nombre, apellido_paterno, apellido_materno', 'rh_personal');

                    foreach($consulta as $valor){
                        $nombre = $valor['nombre'].' '.$valor['apellido_paterno'].' '.$valor['apellido_materno'];
                        if($data['nombre'] == $nombre){
                            $data['id'] = $valor['id'];
                            break;
                        }
                    }

                    if(empty($data['id'])){
                        echo json_encode([0 => ['error' => 1, 'mensaje' => 'no se encontró este personal, asegurese de que escribio bien el nombre: '.$data['nombre']]]);
                    } else{
                        $horario = $this->Querys->consulta('horario', 'rh_horarios', '', array('and' => array('personal_id' => $data['id'], 'cve_dia' => date('N'))));
                        $horario_entrada = intval(substr($horario[0]['horario'], 0, 2)) * 60 + intval(substr($horario[0]['horario'], 3, 2));
                        $horario_salida = intval(substr($horario[0]['horario'], 6, 2)) * 60 + intval(substr($horario[0]['horario'], 9, 2));

                        // Validación de que el pase esté dentro del horario
                        if($pase_salida < $horario_entrada){
                            echo json_encode([0 => ['error' => 1, 'mensaje' => 'Las horas de entrada o salida no corresponden con el horario']]);
                        } else{
                            $control = $this->Querys->consulta('hora_entrada, fecha_registro', 'rh_control', '', array('and' => ['personal_id' => $data['id'], 'fecha_registro' => date('Y-m-d')]));
                            if(empty($control)){
                                echo json_encode([0 => ['error' => 1, 'mensaje' => 'No hay ningún registro del día de hoy de este empleado']]);
                            } elseif($control[0]['fecha_registro'] == date('Y-m-d') and $control[0]['hora_entrada'] == '00:00:00' and $pase_salida != $horario_entrada){
                                echo json_encode([0 => ['error' => 1, 'mensaje' => 'Para crear un pase de salida debe de entrar primero el personal o que la salida sea en su hora de entrada']]);
                            } else{

                                $id_insert = $this->Querys->guardar('rh_pases', array('personal_id' => $data['id'], 'fecha_registro' => date('Y-m-d'), 'hora_salida' => $data['hora_salida'], 'hora_entrada' => $data['hora_entrada'], 'motivo' => $data['opcion'], 'descripcion' => $data['descripcion']));
                                if(empty($id_insert)){
                                    echo json_encode([0 => ['error' => 1, 'mensaje' => 'Hubo un error al subir']]);
                                }

                                if($pase_salida == $horario_entrada){
                                    $this->Querys->guardar('rh_control', array('hora_entrada' => $data['hora_salida']), array('and' => ['personal_id' => $data['id'], 'fecha_registro' => date('Y-m-d')]));
                                } 
                                
                                if($pase_entrada >= $horario_salida){
                                    $this->Querys->guardar('rh_control', array('hora_salida' => $data['hora_entrada']), array('and' => ['personal_id' => $data['id'], 'fecha_registro' => date('Y-m-d')]));
                                }

                                if($_FILES) {
                                    $directorio     = 'assets/pases/'.$data['id'];
                                    if(!is_dir($directorio))   {
                                        #Si no existe el directorio de usuario lo creamos
                                        mkdir($directorio);
                                        chmod($directorio, 0777);
                                    }
                                    $extension      = explode(".", $_FILES['file-0']['name']);
                                    $extension      = end($extension);
                                    // $filename       = md5(uniqid($data['id'], true));
                                    $filename       = md5(uniqid($_FILES['file-0']['name'], true));
                                    #Subimos el archivo a directorio del usuario
                                    move_uploaded_file($_FILES['file-0']['tmp_name'], $directorio.'/'.$filename.'.'.$extension);
                        
                                    #Guardamos el nombre del archivo en la tabla de usuarios
                                    $datos_pase   = ['pase_pdf' => '/assets/pases/'.$data['id'].'/'.$filename.'.'.$extension];
                                    $this->Querys->guardar('rh_pases', $datos_pase, ['and' => ['id' => $id_insert]]);
                                }
                                echo json_encode([0 => ['error' => 0, 'mensaje' => 'El registro se completó']]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function eliminarPase(){
        $id = $this->input->post('id');
        $this->PanPases->borrarPase($id);
        redirect('Reloj/DepuredPases');
    }
    
    public function render($view, $data = null){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view($view, $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function agregar(){
        $data['opciones'] = $this->Querys->consulta('*', 'rh_cat_motivos_pase');
        $data['personal'] = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno', 'rh_personal', '', 'alta_baja=1');
        $this->render('Reloj/Pases/agregar', $data);
    }

    public function seguridad(){
        if ($this->session->userdata('id')) {
            return true;
        } else {
            redirect(base_url());
        }
    }
}