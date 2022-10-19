<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->model('Administracion/M_Menu');
        $this->seguridad();      
    }
    public function index() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/TablaMenu');
        $this->load->view('Plantilla/v_footer');

    }
    public function Contenido(){
         // POST data
         $postData = $this->input->post();
         // Get data
         $data = $this->M_Menu->getEmployees($postData);
         echo json_encode($data);
    }
    public function Agregar() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/AgregarMenu');
        $this->load->view('Plantilla/v_footer');

    }
    public function Editar($id) {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['consulta']= $this->Querys->consulta('*', 'rh_menu','','id='.$id);   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/EditarMenu',$data);
        $this->load->view('Plantilla/v_footer');

    }
    public function Eliminar() {      
        $id=$this->input->post('id');
        $this->M_querys->actualiza('rh_menu', array('alta_baja' => 0,'fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id);
        echo "Registro eliminado";
    }
    public function Guardar($id=null){
        foreach ($_POST as $indice => $valor) {
            $data[$indice] = $this->input->post($indice);
        }
        if ($id) {
            $insert_id = $this->M_querys->guardar('rh_menu', $data, $id);
            echo $this->session->flashdata('mensaje');
        } 
        else {
            $insert_id = $this->M_querys->guardar('rh_menu', $data);
            echo $this->session->flashdata('mensaje');
        }              
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
