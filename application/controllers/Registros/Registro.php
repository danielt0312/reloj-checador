<?php
use Spipu\Html2Pdf\Html2Pdf;

defined('BASEPATH') OR exit('No direct script access allowed');
class Registro extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');             
        $this->load->model('M_webService');
        $this->load->model([
            'Registros/M_RegistrosPersonal',
            'Catalogos/CatMotivosBajas',
            'Catalogos/CatEstatus',
            'Catalogos/Departamentos',
            'Catalogos/CatAreas',
            'Catalogos/Turnos',
            'Catalogos/Estados',
            'Catalogos/Municipios',
            'Catalogos/EstadoCivil',
            'Catalogos/TipoSanguineo',
            'Catalogos/GradoEstudio',
            'Catalogos/GradoProfesional',
            'Catalogos/Puestos',
            'Registros/VitacoraPersonal',
            'Registros/Personal',
            'Registros/HorariosPersonal'
        ]);
        $this->load->library([
            'Quincenas'
        ]);
        $this->seguridad(); 
    }
    public function index() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/Tabla');
        $this->load->view('Plantilla/v_footer');

    }
    public function Contenido(){
         // POST data
         $postData = $this->input->post();

         // Get data
         $data = $this->M_RegistrosPersonal->getEmployees($postData);

         echo json_encode($data);
    }
    public function Agregar()
    {
        if($this->session->userdata('rol_id') == 4){
            redirect(base_url('registros/personal-activo'));
        }
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();  
        $data['estadocivil']        = $this->Querys->consulta('*', 'rh_cat_estadocivil'); 
        $data['gradoprofesional']   = $this->Querys->consulta('*', 'rh_cat_gradoprofesional'); 
        $data['gradosestudio']      = $this->Querys->consulta('*', 'rh_cat_gradosestudio'); 
        $data['tiposangre']         = $this->Querys->consulta('*', 'rh_cat_tiposangre'); 
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento'); 
        $data['estados']            = $this->Querys->consulta('*', 'rh_cat_estados');  
        $data['plaza']              = $this->Querys->consulta('*', 'rh_cat_plaza');
        $data['turno']              = $this->Querys->consulta('*', 'rh_cat_turno');
        $data['motivos_baja']       = $this->CatMotivosBajas->getMotivosBaja();
        $data['estatus']            = $this->CatEstatus->getEstatus();
        $data['puestos']            = $this->Puestos->getPuestos();
        $data['ct_municipio']       = $this->Querys->consulta('*', 'rh_cat_municipios','','estado_id=28');
        $data['horarios']           = $this->HorariosPersonal->getHorariosPersonal();
        $data['dias_semana']        = $this->HorariosPersonal->dias;

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/Agregar',$data);
        $this->load->view('Plantilla/v_footer');
    }
    public function Editar($id)
    {
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $data['consultagen']        = $this->Querys->consulta('*', 'rh_personal','','id='.$id);
        $data['estadocivil']        = $this->Querys->consulta('*', 'rh_cat_estadocivil'); 
        $data['gradoprofesional']   = $this->Querys->consulta('*', 'rh_cat_gradoprofesional'); 
        $data['gradosestudio']      = $this->Querys->consulta('*', 'rh_cat_gradosestudio'); 
        $data['tiposangre']         = $this->Querys->consulta('*', 'rh_cat_tiposangre'); 
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento'); 
        $data['areas']              = $this->Querys->consulta('*', 'rh_cat_areas', null, ['and' => ['departamento_id' => $data['consultagen'][0]['departamento']]]);
        $data['estados']            = $this->Querys->consulta('*', 'rh_cat_estados'); 
        $data['municipios']         = $this->Querys->consulta('*', 'rh_cat_municipios', null, ['and' => ['estado_id' => $data['consultagen'][0]['estado_id']]]);
        $data['plaza']              = $this->Querys->consulta('*', 'rh_cat_plaza');
        $data['turno']              = $this->Querys->consulta('*', 'rh_cat_turno');
        $data['motivos_baja']       = $this->CatMotivosBajas->getMotivosBaja();
        $data['estatus_personal']   = $this->CatEstatus->getEstatus();
        $data['bitacora']           = $this->Querys->consulta('*','rh_vitacora_personal', null, ['and' => ['personal_id' => $id, 'activo' => 1]]);
        $data['claves_persupuestales'] = $this->Personal->getClavesPersonal(['personal_id' => $id]);
        $data['puestos']            = $this->Puestos->getPuestos();
        $data['horarios']           = $this->HorariosPersonal->getHorariosPersonal(['personal_id' => $id]);
        $data['dias_semana']        = $this->HorariosPersonal->dias;
        $data['ct_municipio']       = $this->Querys->consulta('*', 'rh_cat_municipios','','estado_id=28');

        $this->load->model('Registros/Personal');
        $this->load->library('Util');
        #$data['plazas']             = $this->util->setArreglo($this->Personal->getTiposPlazaPersona($id), 'tipo_plaza_id');

        if($this->session->userdata('rol_id') == 4){
            if($data['consultagen'][0]['area'] != $this->session->userdata('area_id')){
                redirect(base_url('registros/personal-activo'));
            }
        }

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/Editar',$data);
        $this->load->view('Plantilla/v_footer');
    }
    public function Ver($id)
    {
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $data['consultagen']        = $this->Querys->consulta('*', 'rh_personal','','id='.$id);
        $data['estadocivil']        = $this->Querys->consulta('*', 'rh_cat_estadocivil'); 
        $data['gradoprofesional']   = $this->Querys->consulta('*', 'rh_cat_gradoprofesional'); 
        $data['gradosestudio']      = $this->Querys->consulta('*', 'rh_cat_gradosestudio'); 
        $data['tiposangre']         = $this->Querys->consulta('*', 'rh_cat_tiposangre'); 
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento'); 
        $data['areas']              = $this->Querys->consulta('*', 'rh_cat_areas'); 
        $data['estados']            = $this->Querys->consulta('*', 'rh_cat_estados'); 
        $data['municipios']         = $this->Querys->consulta('*', 'rh_cat_municipios');
        $data['ct_municipio']       = $this->Querys->consulta('*', 'rh_cat_municipios');
        $data['plaza']              = $this->Querys->consulta('*', 'rh_cat_plaza');
        $data['turno']              = $this->Querys->consulta('*', 'rh_cat_turno');
        
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/Ver',$data);
        $this->load->view('Plantilla/v_footer');
    }
    public function Eliminar(){
        $id=$this->input->post('id');
        $this->M_querys->actualiza('rh_personal', array('alta_baja' => 0,'fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id);        
        //$this->index();
        echo "Registro eliminado";
    }

    public function eliminarPersonal(){
        $id = $this->input->post('id');
        $this->Personal->eliminaPersonal($id);
        echo "Registro eliminado";
    }

    public function eliminarClave($id_clave_presupuestal){
        echo json_encode($this->Personal->eliminarClavePresupuestal($id_clave_presupuestal));
    }

    public function editaClaves(){
	    $personal_id    = $_POST['personal_id'];
	    $claves         = $_POST['claves'];
        if($_POST['fechaIngresoSistema'] != ""){
            #Si recivimos una string con datos seteamos el formato de la fecha
            $this->quincenas->startLibrary($_POST['fechaIngresoSistema']);
            $fechaIngresoSistema = $this->quincenas->getDateformat();
            $this->Personal->setPersonal(['fecha_ingreso_sistema' => $fechaIngresoSistema], $personal_id);
        }
        $this->Personal->eliminarClavePresupuestal(['personal_id' => $personal_id]);
        if(count($claves) > 0){
            #Insertar claves si se encuentra en el ws de nómina
            for($i = 0; $i < count($claves); $i++){
                $busca_clave = $this->Personal->getClavesPersonal(['personal_id' => $personal_id, 'clave_presupuestal' => $claves[$i]['clave']]);
                #inserta si no se encunetra en db
                if(count($busca_clave) == 0) {
                    $this->Personal->setClavesPersonal(
                        $personal_id,
                        array(
                            $claves[$i]['ct'] => $claves[$i]['clave'])
                    );
                }

            }
            echo json_encode(array('error' => 0, 'mensaje' => 'Operación exitosa'));
        }else{
            echo json_encode(array('error' => 1, 'mensaje' => 'No se encontraron claves presupuestales'));
        }
    }
    public function actualizarClaves($personal_id){
	    $personal = $this->Personal->getPeronal(['id' => $personal_id]);
	    $consultaClaves = json_encode($this->wsNomina($personal[0]->rfc));
	    $claves = array();

	    if(count($consultaClaves->claves) > 0){
	        #Insertar claves si se encuentra en el ws de nómina
            for($i = 0; $i < count($consultaClaves->claves); $i++){
                $busca_clave = $this->Personal->getClavesPersonal(['personal_id' => $personal_id, 'clave_presupuestal' => $consultaClaves->claves[$i]->clave]);
                #inserta si no se encunetra en db
                if(count($busca_clave) == 0) {
                    $this->Personal->setClavesPersonal(
                        $personal[0]->id,
                        array(
                            $consultaClaves->claves[$i]->ct => $consultaClaves->claves[$i]->clave)
                    );
                }

            }
            echo json_encode(array('error' => 0, 'mensaje' => 'Operación exitosa'));
        }else{
            echo json_encode(array('error' => 1, 'mensaje' => 'No se encontraron claves presupuestales'));
        }


    }

    public function modalDetalle($personal_id){
        $data['personal'] = $this->Personal->getPeronal(['id' => $personal_id])[0];
        $data['claves'] = $this->Personal->getClavesPersonal(['personal_id' => $personal_id]);
        $data['estatus'] = $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $personal_id]);
        $data['departamento'] = $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento]);
        $data['area'] = $this->CatAreas->getAreas(['id' => $data['personal']->area]);
        $data['turno'] = $this->Turnos->getTurnos(['id' => $data['personal']->turno]);
        $data['estado'] = $this->Estados->getEstados(['id' => $data['personal']->estado_id]);
        $data['municipio'] = $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id]);
        $data['ct_municipio'] = $this->Municipios->getMunicipios(['id' => $data['personal']->nombre_municipio]);
        $data['estado_civil'] = $this->EstadoCivil->getEstadoCivil(['id' => $data['personal']->estado_civil]);
        $data['tipo_sanguineo'] = $this->TipoSanguineo->getTipoSanguineo(['id' => $data['personal']->tipo_sangre]);
        $data['grado_estudios'] = $this->GradoEstudio->getGradoProfesional(['id' => $data['personal']->grado_estudios]);
        $data['grado_profesional'] = $this->GradoProfesional->getGradoProfesional(['id' => $data['personal']->grado_profesion]);
        $data['puesto'] = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);
        $data['horarios']           = $this->HorariosPersonal->getHorariosPersonal(['personal_id' => $personal_id]);
        $data['dias_semana']        = $this->HorariosPersonal->dias;
        $this->load->view('Registros/Personal/detallePersonal', $data);
    }
    public function webServiceCurp() {
        $curp       = strtoupper($this->input->post('curp'));
        $parametros = array(
            'Curp'      => $curp,
            'id_Valor'  => 11,
            'Cadena'    => 'M3hx¡#¡nhU3a?LX'
        );

        $servicio   = 'https://sce.tamaulipas.gob.mx/WS_RENAPO_V2/Consulta_curp.asmx?wsdl'; 
        $json['renapo'] = $this->M_webService->getDataWebService($servicio, $parametros, 1);
        $registrado     = $this->M_webService->checkRegistros(1, $curp);

        if ($registrado != 0) {
            $json['duplicado'] = false;
        } else {
            $json['duplicado'] = true;
        }
        echo json_encode($json);
    }

    public function activaredicionrh() {

        $data_personal['opedicion'] = $this->input->post('opedicion');     
        
            $this->load->model('Querys');
            $inactivo =$this->Querys->guardar('rh_submenu', $data_personal, ['and' => ['id' => 11]]);
            $activo =$this->Querys->guardar('rh_submenu', $data_personal, ['and' => ['id' => 12]]);

                $retorno[0]['error']        = 0;
                $retorno[0]['mensaje']      = "Actualización realizada correctamente";
                                    
        echo json_encode($retorno);
        
    }

    public function nuevoRegistro() {

        foreach($_POST['data']['personal'] as $indice => $valor) {
            if(!is_array($valor)) {
                $data_personal[$indice] = $valor;
            }
        }
        $data_personal['fecha_registro'] = date('Y-m-d H:i:s');
        $data_personal['id_usuario_reg'] = $this->session->userdata('id');
        $validacurp = $this->M_querys->RevisarRegistros('rh_personal', 'curp', $data_personal['curp']);
        if ($validacurp==1) {
            $retorno[0]['error']        = 1;
            $retorno[0]['mensaje']      = "El curp que intenta guardar ya se encuentra registrado, favor de cambiar la dirección.";
        }else{

            #validar si se cargo una imagen
            #if(array_key_exists('file-0', $_FILES)) {
            if(1) {

                #Validación exitosa...
                #Guardar datos de usuario
                $this->load->model('Querys');

                $id_insert          = $this->Querys->guardar('rh_personal', $data_personal);

                if($id_insert)  {
                    $data_personal['id_cifrado'] = md5($id_insert);
                    //$this->Querys->guardar('rh_personal', ['id_cifrado' => md5(sha1($id_insert))], ['and' => ['id'] => $id_insert]);
                    $this->Querys->guardar('rh_personal', $data_personal, ['and' => ['id' => $id_insert]]);


                    $this->load->model('Registros/Personal');
                    if(isset($_POST['data']['personal']['plazas'])) {
                        $this->Personal->setTiposPlazaPersona($id_insert, $_POST['data']['personal']['plazas']);
                    }
                    $data_vitacora = array(
                        'personal_id' => $id_insert,
                        'estatus_id' => $_POST['data']['vitacora']['estatus_id'],
                        'fecha_baja' => $_POST['data']['vitacora']['fecha_baja'],
                        'motivo_baja_id' => $_POST['data']['vitacora']['motivo_baja_id']
                    );
                    if(isset($_POST['data']['claves'])){
                        $this->Personal->setClavesPersonal($id_insert, $_POST['data']['claves']);
                    }
                    $this->VitacoraPersonal->setVitacoraPersonal($data_vitacora, $id_insert);

                    /**
                     * seteo de horario
                     */
                    if(isset($_POST['data']['horario'])){
                        $horario = $_POST['data']['horario'];
                        $dias = $this->HorariosPersonal->dias;
                        $data_horarios = array();
                        foreach($horario as $indice => $data){

                            if(isset($data['dia']) && $data['dia'] > 0){
                                array_push($data_horarios, [
                                    'personal_id' => $id_insert,
                                    'dia' => $dias[$data['dia']],
                                    'cve_dia' => $data['dia'],
                                    'horario' => $data['entrada'].'-'.$data['salida']
                                ]);
                            }
                        }
                        $this->HorariosPersonal->setHorariosPersonal($data_horarios, $id_insert);
                    }


                    #Crear direcotrio de usuario y guardar imágen
                    $directorio     = 'assets/personal/'.$id_insert;
                    if(!is_dir($directorio))   {
                        mkdir($directorio);
                        chmod($directorio, 0777);
                        if(array_key_exists('file-0', $_FILES)) {
                            $extension      = explode(".", $_FILES['file-0']['name']);
                            $extension      = end($extension);
                            $filename       = md5(uniqid($id_insert, true));
                            move_uploaded_file($_FILES['file-0']['tmp_name'], $directorio.'/'.$filename.'.'.$extension);

                            #Guardamos el nombre del archivo en la tabla de usuarios
                            $datos_perfil    = ['foto' => '/assets/personal/'.$id_insert.'/'.$filename.'.'.$extension];
                            $this->Querys->guardar('rh_personal', $datos_perfil, ['and' => ['id' => $id_insert]]);
                        }
                    }
                        
                    // #guardamos datos de la escuela
                    // $datos_ct['usuario_id']         = $id_insert;
                    // $this->Querys->guardar('rh_personal', $datos_ct);
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
                         
        echo json_encode($retorno);
        
    }

    public function testPost($id = null){

        print_r($_POST);

    }
    public function edicionRegistro($id_usuario = null)   {
        foreach($_POST['data']['personal'] as $indice => $valor) {
            if(!is_array($valor)){
                $datos_usuario[$indice]= $valor;
            }
        }
        $datos_usuario['base_estatal'] = (array_key_exists('base_estatal', $datos_usuario)) ? 1 : 0;
        $datos_usuario['base_federal'] = (array_key_exists('base_federal', $datos_usuario)) ? 1 : 0;
        $datos_usuario['base_contrato'] = (array_key_exists('base_contrato', $datos_usuario)) ? 1 : 0;
        $datos_usuario['base_otro'] = (array_key_exists('base_otro', $datos_usuario)) ? 1 : 0;

        $this->load->model('Querys');
        // #Gurdamos lo dato de usuario
        $datos_usuario['id_usuario_reg'] = $this->session->userdata('id');
        $this->Querys->guardar('rh_personal', $datos_usuario, ['and' => ['id' => $id_usuario]]);
        $this->load->model('Registros/Personal');
        if(isset($_POST['data']['personal']['plazas'])){
            $this->Personal->setTiposPlazaPersona($id_usuario, $_POST['data']['personal']['plazas']);
        }

        $data_vitacora = array(
            'personal_id' => $id_usuario,
            'estatus_id' => $_POST['data']['vitacora']['estatus_id'],
            'fecha_baja' => $_POST['data']['vitacora']['fecha_baja'],
            'motivo_baja_id' => (isset($_POST['data']['vitacora']['motivo_baja_id'])) ? $_POST['data']['vitacora']['motivo_baja_id'] : 0
        );
        $this->VitacoraPersonal->setVitacoraPersonal($data_vitacora, $id_usuario);

        /**
         * seteo de horario
         */
        $horario = $_POST['data']['horario'];
        $dias = $this->HorariosPersonal->dias;
        $data_horarios = array();

        foreach($horario as $indice => $data){
            #print_r($data);

            if(isset($data['dia']) && $data['dia'] > 0){
                array_push($data_horarios, [
                    'personal_id' => $id_usuario,
                    'dia' => $dias[$data['dia']],
                    'cve_dia' => $data['dia'],
                    'horario' => $data['entrada'].'-'.$data['salida']
                ]);
            }
        }
        $this->HorariosPersonal->setHorariosPersonal($data_horarios, $id_usuario);
        /**
         *
         */

        if($_FILES) {
            #Si tenemos un archivo que subir
            $directorio     = 'assets/personal/'.$id_usuario;
            if(!is_dir($directorio))   {
                #Si no existe el directorio de usuario lo creamos
                mkdir($directorio);
                chmod($directorio, 0777);
            }
            $extension      = explode(".", $_FILES['file-0']['name']);
            $extension      = end($extension);
            $filename       = md5(uniqid($id_usuario, true));
            #Subimos el archivo a directorio del usuario
            move_uploaded_file($_FILES['file-0']['tmp_name'], $directorio.'/'.$filename.'.'.$extension);

            #Guardamos el nombre del archivo en la tabla de usuarios
            $datos_perfil    = ['foto' => '/assets/personal/'.$id_usuario.'/'.$filename.'.'.$extension];
            $this->Querys->guardar('rh_personal', $datos_perfil, ['and' => ['id' => $id_usuario]]);
        }

        echo json_encode([0 => ['error' => 0, 'mensaje' => 'Datos actualizados']]);

    }
    public function eliminarImagen($id_personal) {
        $consulta           = $this->Querys->consulta('foto', 'rh_personal', null, ['and' => ['id' => $id_personal]]);
        unlink(substr($consulta[0]['foto'], 1));
        $this->M_querys->actualiza('rh_personal', array('foto' => '','fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id_personal);  
        echo json_encode([0 => ['error' => 0, 'mensaje' => "Operación exitosa"]]);
    }
    public function getMunicipio()  {        
        $this->load->model('Querys');
        $id             = $_POST['valor'];
        $lista          = $this->Querys->consulta('clave as value, nombre as legend', 'rh_cat_municipios', null, ['and' => ['estado_id' => $id]],'','','legend','','');
        echo (json_encode($lista));        
    }
    public function getArea()  {        
        $this->load->model('Querys');
        $id             = $_POST['valor'];
        $lista          = $this->Querys->consulta('id as value, nombre as legend', 'rh_cat_areas', null, ['and' => ['departamento_id' => $id]],'','','legend','asc','');
        echo (json_encode($lista));        
    }
    /**********************Permisos***************************/
    public function menu(){        
        $items  = $this->Querys->consulta('a.id as id_menu, a.nombre as nombre_menu, a.orden, a.alta_baja, a.url', 'rh_menu a', array(array('tabla' => 'rh_menus_rol b', 'join' => 'b.menu_id=a.id')),"b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");        
        return $items;        
    }
    public function submenu(){
        $items  = $this->Querys->consulta('a.id as id_submenu, a.nombre as nombre_submenu, a.menu_id, a.url, a.alta_baja', 'rh_submenu a',array(array('tabla' => 'rh_submenus_rol b', 'join' => 'b.submenu_id=a.id')), "b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");
        return $items;        
    }
    public function seguridad() 
    {
        if ($this->session->userdata('id')) {
            return true;
        } else {
            redirect(base_url());
        }
    }

    public function seteaData(){
        $registros = $this->Querys->consulta('id, grado_estudios', 'rh_personal');
        foreach($registros as $persona){
            #$this->Querys->guardar('rh_personal', ['carrera' => $persona['grado_estudios']], ['and' => ['id' => $persona['id']]]);
        }
    }

    public function wsRfc(){
        date_default_timezone_set('America/Mexico_City');
        $servicio 	     = 'http://siie.tamaulipas.gob.mx/WebServices_Cete2/Servicios.asmx?wsdl';
        $cadena 	     = 'k1¡pKa@h0FW!';
        $id_valor 	     = 13;
        $rfc             = $_POST['rfc'];

        $parametros = array(
            'Id_Valor' 	=> $id_valor,
            'Cadena' 	=> $cadena
        );
        $parametros['RFC'] 		= strtoupper($rfc);
        $busqueda 				= strtoupper($rfc);
        $parametros['Key']      = md5(''.date("H").'L@tQvrHKmz'.$busqueda.date("d").date("m").date("Y"));

        try {
            $client     = new SoapClient($servicio, $parametros);
            $result    = $client->M02Datos_Docente($parametros);

            $data 	= $result->M02Datos_DocenteResult;

            #echo $data;
            if(isset($data)){
                echo $data;
            }else{
                echo json_encode(['error' => 'rfc no encontrado']);
            }



        } catch (Exception $e) {
            $data[0] = array('error' => 'prueba');
            echo $data;
        }
    }

    public static function wsNomina($rfc = null) {
        #header("Content-Type:application/json");

        $rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : $rfc;
        curl_setopt_array($ch = curl_init(), array(
            #CURLOPT_URL                     => 'http://200.23.59.105/api/nomina.php',
            CURLOPT_URL => 'http://cambiosypermutas.tamaulipas.gob.mx/Servicios/consultar',
            CURLOPT_POST => 'TRUE',
            CURLOPT_RETURNTRANSFER => 'TRUE',
            CURLOPT_POSTFIELDS => array(
                "rfc" => $rfc,
                "cadena" => 'jBr9xATOTx'
            )
        ));
        $respuesta = curl_exec($ch);
        curl_close($ch);

        echo $respuesta;
    }

    public function fichaPersonal($personal_id){
 
        #$personal_id = base64_decode($pegitrsonal_id1);
        #print_r($personal_id);

        $data['personal'] = $this->Personal->getPersonalCifrado(['id_cifrado' => $personal_id]);
        $idpersonal = $data['personal'][0]->id;
        if(count($data['personal']) > 0){
            $data['estatus']            = (count($this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $idpersonal])) > 0) ? $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $idpersonal])[0] : 'NULL';
            $data['personal']           = $data['personal'][0];
            $data['estado_civil']       = ($data['personal']->estado_civil > 0) ? $this->EstadoCivil->getEstadoCivil(['id' => $data['personal']->estado_civil])[0] : null;
            $data['tipo_sanguineo']     = ($data['personal']->tipo_sangre > 0) ? $this->TipoSanguineo->getTipoSanguineo(['id' => $data['personal']->tipo_sangre])[0] : null;
            $data['entidad_federativa'] = (((integer) $data['personal']->estado_id) > 0) ? $this->Estados->getEstados(['id' => $data['personal']->estado_id])[0] : null;
            $data['municipio']          = (((integer) $data['personal']->municipio_id) > 0 && $data['personal']->estado_id > 0) ? $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0] : null;
            $data['grado_profesional']  = ($data['personal']->grado_profesion > 0) ? $this->GradoProfesional->getGradoProfesional(['id' => $data['personal']->grado_profesion])[0] : null;
            $data['grado_estudios']     = ($data['personal']->grado_estudios > 0) ? $this->GradoEstudio->getGradoProfesional(['id' => $data['personal']->grado_estudios])[0] : null;
            $data['departamento']       = ($data['personal']->departamento > 0) ? $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0] : null;
            $data['area']               = ($data['personal']->area > 0) ? $this->CatAreas->getAreas(['id' => $data['personal']->area])[0] : null;
            $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);
            $data['claves']             = $this->Personal->getClavesPersonal(['personal_id' => $idpersonal]);
            $data['horarios']           = $this->HorariosPersonal->getHorario(['personal_id' => $idpersonal]);
            $data['ct_municipio']       = ($data['personal']->nombre_municipio) > 0 ? $this->Municipios->getMunicipios(['id' => $data['personal']->nombre_municipio])[0] : null;

            ob_start();
            $this->load->view('Registros/Personal/registroPersonal', $data);
            $html = ob_get_clean();
            $html2pdf = new Html2Pdf('L','A4','da', true, 'UTF-8', array(0,0,0,0));
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        }else{
            redirect(base_url('Registros/Registro'));
        }
    }

    public function gafetePersonal($personal_id){
        $data['personal'] = $this->Personal->getPersonalCifrado(['id_cifrado' => $personal_id]);
        $idpersonal = $data['personal'][0]->id;
        
        if (count($data['personal']) > 0) {
            $data['personal']           = $data['personal'][0];
            $data['estatus']            = (count($this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $idpersonal])) > 0) ? $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $idpersonal])[0] : 'NULL';
            $data['departamento']       = ($data['personal']->departamento > 0) ? $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0] : null;
            $data['area']               = ($data['personal']->area > 0) ? $this->CatAreas->getAreas(['id' => $data['personal']->area])[0] : null;
            $data['municipio']          = (((integer) $data['personal']->municipio_id) > 0 && $data['personal']->estado_id > 0) ? $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0] : null;
            $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);
            
            ob_start();
            $this->load->view('Registros/Personal/gafetePersonal', $data);
            $html = ob_get_clean();
            $html2pdf = new HTML2PDF('P', array(70,115), 'en', true, 'UTF-8', array(0, 0, 0, 0));
            #$html2pdf = new Html2Pdf('L','A4','da', true, 'UTF-8', array(0,0,0,0));
            $html2pdf->writeHTML($html);
            $html2pdf->output('Credencial-'.$idpersonal.'-frontal.pdf');
        }
    }

    public function gafetePersonalTrasera($personal_id){
        $data['personal'] = $this->Personal->getPeronal(['id' => $personal_id]);
        $idpersonal = $data['personal'][0]->id;

        if (count($data['personal']) > 0) {
            $data['personal']           = $data['personal'][0];
            $data['estatus']            = (count($this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $personal_id])) > 0) ? $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $personal_id])[0] : 'NULL';
            $data['departamento']       = ($data['personal']->departamento > 0) ? $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0] : null;
            $data['area']               = ($data['personal']->area > 0) ? $this->CatAreas->getAreas(['id' => $data['personal']->area])[0] : null;
            $data['municipio']          = (((integer) $data['personal']->municipio_id) > 0 && $data['personal']->estado_id > 0) ? $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0] : null;
            $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);

            ob_start();
            $this->load->view('Registros/Personal/gafetePersonalTrasera', $data);
            $html = ob_get_clean();
            $html2pdf = new HTML2PDF('P', array(70,115), 'en', true, 'UTF-8', array(0, 0, 0, 0));
            #$html2pdf = new Html2Pdf('L','A4','da', true, 'UTF-8', array(0,0,0,0));
            $html2pdf->writeHTML($html);
            $html2pdf->output('Credencial-'.$personal_id.'-trasera.pdf');
        }
    }


    public function testConverterPdfToJpg(){
        $im = new Imagick();
        $im->setResolution( 300, 300 );

        $im->readImage($_SERVER['DOCUMENT_ROOT'].'/rh/assets/personal/1/credencial_a.pdf');
        $im->writeImage('frontal.jpg');

        #$imagick = $im->flattenImages();
        $im->writeImage($_SERVER['DOCUMENT_ROOT'].'/rh/assets/personal/1/prueba.jpg');
        chmod($_SERVER['DOCUMENT_ROOT'].'/rh/assets/personal/1/prueba.jpg', 0766);
        // Output the image

        //$output = $im->getimageblob();
        //$outputtype = $im->getFormat();

        //header("Content-type: $outputtype");
        //echo $output;
    }


}
