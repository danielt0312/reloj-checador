<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Departamento extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->model([
            'Catalogos/M_Departamento',
            'Catalogos/CatAreas',
            'Catalogos/Departamentos',
            'Catalogos/CatEstatus'
        ]);
        $this->load->library('Util');
        $this->seguridad();  
    }
    public function index() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['departamentos']      = $this->Departamentos->getDepartamento();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Departamento/Registros', $data);
        $this->load->view('Plantilla/v_footer');

    }
    public function Contenido(){
         // POST data
         $postData = $this->input->post();

         // Get data
         $data = $this->M_Departamento->getEmployees($postData);

         echo json_encode($data);
    }
    public function Agregar()
    {
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Departamento/Agregar');
        $this->load->view('Plantilla/v_footer');
    }
    public function Editar($id)
    {
        $data['consulta']= $this->Querys->consulta('*', 'rh_cat_departamento','','id='.$id);
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Departamento/Editar',$data);
        $this->load->view('Plantilla/v_footer');
    }
    public function Eliminar(){
        $id=$this->input->post('id');
        $this->M_querys->actualiza('rh_cat_departamento', array('alta_baja' => 0,'fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id);        
        //$this->index();
        echo "Registro eliminado";
    }
    public function Guardar($id=null){
	    /*
        foreach ($_POST as $indice => $valor) {
            $data[$indice] = $this->input->post($indice);
        }
        if ($id) {
            $insert_id = $this->M_querys->guardar('rh_cat_departamento', $data, $id);
            echo $this->session->flashdata('mensaje');
        } 
        else {
            $insert_id = $this->M_querys->guardar('rh_cat_departamento', $data);
            echo $this->session->flashdata('mensaje');
        }
	    */
	    $result = $this->Departamentos->setDepartamento($_POST, $id);
	    echo $result['mensaje'];
    }

    public function Areas($departamento_id){
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento', null, ['and' => ['id' => $departamento_id]]);
        $data['areas']              = $this->CatAreas->getAreas(['departamento_id' => $departamento_id]);
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Area/admin',$data);
        $this->load->view('Plantilla/v_footer');
    }

    public function agregarArea($departamento_id){
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento', null, ['and' => ['id' => $departamento_id]]);
        $data['estatus']            = $this->CatEstatus->getEstatus();
        $data['url_form']           = base_url('Catalogos/Departamento/guardarArea/');
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Area/formulario',$data);
        $this->load->view('Plantilla/v_footer');
    }

    public function guardarArea($area_id = null){
	    $data = $this->util->setPost($_POST);
	    $result = $this->CatAreas->setAreas($data['data'], $area_id);
        echo $result['mensaje'];
    }

    public function editarArea($area_id){
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['area']               = $this->CatAreas->getAreas(['id' => $area_id]);
        $data['departamento']       = $this->Querys->consulta('*', 'rh_cat_departamento', null, ['and' => ['id' => $data['area'][0]->departamento_id]]);
        $data['estatus']            = $this->CatEstatus->getEstatus();
        $data['url_form']           = base_url('Catalogos/Departamento/guardarArea/'.$data['area'][0]->id);
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Area/formulario',$data);
        $this->load->view('Plantilla/v_footer');
    }

    public function eliminarArea($area_id){
	    $result = $this->CatAreas->setAreas(
	        array(
	            'estatus_id' => 2
            ),
            $area_id
        );
	    echo json_encode($result);
    }

    public function listaAreas(){
	    echo json_encode($this->CatAreas->getAreas($this->input->post('conditions')));
    }

    public function eliminarDepartamento($departamento_id){
        $result = $this->Departamentos->setDepartamento(
            array(
                'estatus_id' => 2
            ),
            $departamento_id
        );
        echo json_encode($result);
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
}
