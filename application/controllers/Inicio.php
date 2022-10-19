<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Spipu\Html2Pdf\Html2Pdf;
class Inicio extends CI_Controller {
    function __construct() {

        parent::__construct();
         /** Se establece la zona horaria en el sistema */
        date_default_timezone_set('America/Mexico_City');
        $this->load->model('M_querys');
        $this->load->model('M_webService');
        $this->load->model('M_datatable');
        $this->load->model([
            'Registros/Personal',
            'Registros/VitacoraPersonal',
            'Catalogos/Departamentos',
            'Catalogos/CatAreas',
            'Catalogos/Municipios',
            'Catalogos/Puestos',
            'Catalogos/Estados',
            'Catalogos/Municipios',
        ]);
    }

    /**
        Controlador que carga la vista principal
    */
    public function index()
    {
        //$this->load->view('Plantilla/v_head');
        //$this->load->view('Plantilla/v_nav');
        $this->load->view('Inicio/Login');
        //$this->load->view('Inicio/Inicio_Sesion');
        //$this->load->view('Plantilla/v_footer');
    }  

    public function Editar($id){
        echo "bien".$id;
    }
    public function empList(){
         // POST data
         $postData = $this->input->post();

         // Get data
         $data = $this->M_datatable->getEmployees($postData);

         echo json_encode($data);
    }
 
    public function webServiceCurp() {
        $curp = strtoupper($this->input->post('curp'));
        //$curp = 'CASA111016MTSSNRA6';

                $registrado = $this->M_webService->checkRegistros(1, $curp);
                if ($registrado != 0) {
                    $parametros = array(
                        'Curp' => $curp,
                        'id_Valor' => 11,
                        'Cadena' => 'M3hx¡#¡nhU3a?LX'
                    );

                    $servicio = 'http://sce.tamaulipas.gob.mx/curp_renapoVS/service1.asmx?wsdl';
                    $json['renapo'] = $this->M_webService->getDataWebService($servicio, $parametros, 1);

                    echo json_encode($json);
                 } else {
                     $json['duplicado'] = true;
                     echo json_encode($json);
                 }


    }
    public function GuardarUsuario(){
        $usuario = $this->input->post('usuario');
        $escuela = $this->input->post('escuela');

        echo $usuario;
        echo $escuela;
        print_r($_POST);
    }
    public function CuentaRestablecer(){
        $datomenu['activacion']= $this->Querys->consulta('*', 'divcom_activarregistrousuarios','','id=1');        
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$datomenu);
        $this->load->view('Inicio/RestablecerCuenta');
        $this->load->view('Plantilla/v_footer');
    }
    public function RestaurarUsuario(){
        $this->load->library('Mail');
        
        $datos= $this->Querys->consulta('*', 'divcom_usuarios','','alta_baja=1 AND correo="'.$_POST['correo'].'"');
        if ($datos==null) {
            echo "No existe cuenta con el correo capturado.";  
        }
        else{
            echo "Por favor revise su correo.";
            foreach($datos as $indice) { 
                $data_mail['correo']        = $indice['correo'];//correo que recibira notificación
                $data_mail['asunto']        = "DATOS DE SU CUENTA";
                $data_mail['mensaje']       = "Por medio del sistema PROYECTO COLABORATIVO DIVERTICÓMPUTO solicito la siguiente información, quedando bajo su responsablidad la condifencialidad de la cuenta.<br><br><b>Nombre:</b> ".$indice['nombre'].' '.$indice['apellido_paterno'].' '.$indice['apellido_materno'].'<br><b>Usuario:</b> '.$indice['usuario'].'<br><b>Contraseña:</b> '.$indice['password'];
                $this->mail->enviarMensaje($data_mail);
            }
        }
    }
    public function nuevoRegistro() {
        
        #CURP MAHE870316HTSRRD01
        #Datos del usuario
    
        foreach($_POST['data']['usuario'] as $indice => $valor) {
            $datos_usuario[$indice]         = $valor;
        }
        
        #Datos de la escuela
        foreach($_POST['data']['ct'] as $indice => $valor)  {
            $datos_ct[$indice]              = $valor;
        }        
        #validación de cconfirmación de correo
        if($datos_usuario['correo'] == $_POST['confirmar_correo'])   {
            
            #validación de cconfirmación de password
            if($datos_usuario['password'] == $_POST['confirmar_password'])   {
                
                $validausuario=$this->M_querys->RevisarRegistros('divcom_usuarios','usuario',$datos_usuario['usuario']);
                if ($validausuario==1) {
                        $retorno[0]['error']        = 1;
                        $retorno[0]['mensaje']      = "El usuario que intenta guardar ya se encuentra registrado, favor de intentar con otro nombre.";
                }
                else{
                    $validacorreo=$this->M_querys->RevisarRegistros('divcom_usuarios','correo',$_POST['confirmar_correo']);
                    if ($validacorreo==1) {
                        $retorno[0]['error']        = 1;
                        $retorno[0]['mensaje']      = "El correo que intenta guardar ya se encuentra registrado, favor de cambiar la dirección.";
                    }
                    
                    else{
                        #validar si se cargo una imagen
                        if(array_key_exists('file-0', $_FILES)) {
                             
                                #Validación exitosa...
                                #Guardar datos de usuario
                                $this->load->model('Querys');
                                $id_insert          = $this->Querys->guardar('divcom_usuarios', $datos_usuario);
                    
                                if($id_insert)  {                        
                                    #Enviamos el correo con los datos de acceso
                                    $this->load->library('Mail');
                                    $data_mail['correo']        = $datos_usuario['correo'];
                                    $data_mail['asunto']        = "REGISTRO".APP_NAME;
                                    $data_mail['mensaje']       = "Su registro al sistema ".APP_NAME." fue realizado satisfactoriamente. Lo invitamos acceder a la plataforma con las siguientes credenciales en el Menú <a href='".base_url('Inicio/Inicio_Sesion')."' target='_blank'>Iniciar Sesión</a>:<br>Usuario: ".$datos_usuario['usuario']."<br>Contraseña: ".$datos_usuario['password'];
                                    $this->mail->enviarMensaje($data_mail);

                                    #Crear direcotrio de usuario y guardar imágen
                                    $directorio     = 'assets/usuarios/'.$id_insert;
                                    if(!is_dir($directorio))   {
                                        mkdir($directorio);
                                        chmod($directorio, 0777);
                                        if(array_key_exists('file-0', $_FILES)) {
                                            $extension      = explode(".", $_FILES['file-0']['name']);
                                            $extension      = end($extension);
                                            move_uploaded_file($_FILES['file-0']['tmp_name'], $directorio.'/img_profile.'.$extension);   
                                        
                                            #Guardamos el nombre del archivo en la tabla de usuarios
                                            $datos_perfil    = ['foto_perfil' => '/assets/usuarios/'.$id_insert.'/img_profile.'.$extension];
                                            $this->Querys->guardar('divcom_usuarios', $datos_perfil, ['and' => ['id' => $id_insert]]);
                                        }
                                    }
                        
                                    #guardamos datos de la escuela
                                    $datos_ct['usuario_id']         = $id_insert;
                                    $this->Querys->guardar('divcom_escuela', $datos_ct);
                                    $retorno[0]['error']        = 0;
                                    $retorno[0]['mensaje']      = "Registro guardado correctamente";
                        
                                }else   {
                        
                                    $retorno[0]['error']        = 1;
                                    $retorno[0]['mensaje']      = "Error inesperado.";
                        
                                } 
                                
                        }else{                                
                                $retorno[0]['error']        = 1;
                                $retorno[0]['mensaje']      = "Se requiere una imagen de perfil.";
                                
                        } 
                    }            
                }
            }else   {
                
                $retorno[0]['error']        = 1;
                $retorno[0]['mensaje']      = "Las contraseñas no coinciden.";
                
            }
            
        }else   {
            
            $retorno[0]['error']        = 1;
            $retorno[0]['mensaje']      = "Los correo no coinciden.";
            
        }
        
        echo json_encode($retorno);
        
    }
    
    public function getMunicipio()  {
        
        $this->load->model('Querys');
        $id             = $_POST['valor'];
        $lista          = $this->Querys->consulta('id as value, nombre as legend', 'divcom_municipios', null, ['and' => ['estado_id' => $id]],'','','legend','asc','');


        echo (json_encode($lista));
        
    }

    public function getArea()  {
        
        $this->load->model('Querys');
        $id             = $_POST['valor'];
        $lista          = $this->Querys->consulta('id as value, nombre as legend', 'divcom_area', null, ['and' => ['departamento_id' => $id]],'','','legend','','');


        echo (json_encode($lista));
        
    }
    
    public function getLocalidad()  {
        
        $this->load->model('Querys');
        $id             = $_POST['valor'];
        $lista          = $this->Querys->consulta('clave as value, nombre as legend', 'divcom_localidades', null, ['and' => ['municipio_id' => $id]],'','','legend','asc','');
        echo (json_encode($lista));
        
    }
    public function login()
    {
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
 
        $this->M_login->consulta($usuario, $password);
        if ($this->session->userdata('id')) {
            redirect(base_url('Bienvenida/index'));
        }
        else {
            $this->index();
        }
    }
    public function logout()
    {
        unset($usuario);
        unset($password);
        $this->session->sess_destroy();
        $this->index();
    }

    public function datosPersonal($personal_id){

        $data['personal']           = $this->Personal->getPeronal(['id' => $personal_id])[0];
        $data['departamento']       = $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0];
        $data['area']               = $this->CatAreas->getAreas(['id' => $data['personal']->area])[0];
        $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id])[0];
        $data['estatus']            = $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $data['personal']->id])[0];
        $data['estado']             = $this->Estados->getEstados(['id' => $data['personal']->estado_id])[0];
        $data['municipio']          = $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0];

        $data_nav['menu']           = NULL;
        $data_nav['submenu']        = null;
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/public_nav',$data_nav);
        $this->load->view('Plantilla/datos_publicos', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function ficha_publica($personal_id){
        
        $data['personal']           = $this->Personal->getPeronal(['id_cifrado' => $personal_id])[0];
        $data['departamento']       = $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0];
        $data['area']               = $this->CatAreas->getAreas(['id' => $data['personal']->area])[0];
        $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id])[0];
        $data['estatus']            = $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $data['personal']->id])[0];
        $data['estado']             = $this->Estados->getEstados(['id' => $data['personal']->estado_id])[0];
        $data['municipio']          = $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0];

        $data_nav['menu']           = NULL;
        $data_nav['submenu']        = null;
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/public_nav',$data_nav);
        $this->load->view('Plantilla/datos_publicos', $data);
        $this->load->view('Plantilla/v_footer');
    }
}