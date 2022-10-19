<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EstadoCivil extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');            
        $this->load->model('Catalogos/M_EstadoCivil');
        $this->seguridad();  
    }
    public function index() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/EstadoCivil/Registros');
        $this->load->view('Plantilla/v_footer');

    }
    public function Contenido(){
         // POST data
         $postData = $this->input->post();

         // Get data
         $data = $this->M_EstadoCivil->getEmployees($postData);

         echo json_encode($data);
    }
    public function Agregar()
    {
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/EstadoCivil/Agregar');
        $this->load->view('Plantilla/v_footer');
    }
    public function Editar($id)
    {
        $data['consulta']= $this->Querys->consulta('*', 'rh_cat_estadocivil','','id='.$id);
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/EstadoCivil/Editar',$data);
        $this->load->view('Plantilla/v_footer');
    }
    public function Eliminar(){
        $id=$this->input->post('id');
        $this->M_querys->actualiza('rh_cat_estadocivil', array('alta_baja' => 0,'fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id);        
        //$this->index();
        echo "Registro eliminado";
    }
    public function Guardar($id=null){
        foreach ($_POST as $indice => $valor) {
            $data[$indice] = $this->input->post($indice);
        }
        if ($id) {
            $insert_id = $this->M_querys->guardar('rh_cat_estadocivil', $data, $id);
            echo $this->session->flashdata('mensaje');
        } 
        else {
            $insert_id = $this->M_querys->guardar('rh_cat_estadocivil', $data);
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
