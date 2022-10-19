<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->model('Administracion/M_Roles');
        $this->seguridad();
        if($this->session->userdata('rol_id') == 4 OR $this->session->userdata('rol_id') == 3){
            redirect(base_url('Bienvenida/index'));
        }
    }
    public function index() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/TablaRoles');
        $this->load->view('Plantilla/v_footer');

    }
    public function Contenido(){
         // POST data
         $postData = $this->input->post();

         // Get data
         $data = $this->M_Roles->getEmployees($postData);

         echo json_encode($data);
    }
    public function Agregar() {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/AgregarRol');
        $this->load->view('Plantilla/v_footer');

    }
    public function Editar($id) {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();
        $data['consulta']= $this->Querys->consulta('*', 'rh_roles','','id='.$id);   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/EditarRol',$data);
        $this->load->view('Plantilla/v_footer');

    }
    public function Eliminar() {      
        $id=$this->input->post('id');
        $this->M_querys->actualiza('rh_roles', array('alta_baja' => 0,'fecha_modificacion' => $this->input->post('fecha_modificacion')),'id='.$id);
        echo "Registro eliminado";
    }
    public function Permisos($id) {      
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu(); 
        $data['registro']       = $this->M_querys->consulta('*', 'rh_roles', null, 'id = '.$id);
        $data['cat_menus']      = $this->Querys->consulta('a.*,a.nombre as nombre_menu', 'rh_menu a');
        $data['cat_submenus']   = $this->Querys->consulta('a.*,a.nombre as nombre_submenu', 'rh_submenu a');
        $data['reg_menus']      = $this->creaArray($this->Querys->consulta('a.menu_id as id', 'rh_menus_rol a', null, "a.rol_id = $id"));
        $data['reg_submenus']   = $this->creaArray($this->Querys->consulta('a.submenu_id as id', 'rh_submenus_rol a', null, "a.rol_id = $id"));  
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Administracion/Permisos',$data);
        $this->load->view('Plantilla/v_footer');

    }
    public function Guardar($id=null){
        foreach ($_POST as $indice => $valor) {
            $data[$indice] = $this->input->post($indice);
        }
        if ($id) {
            $insert_id = $this->M_querys->guardar('rh_roles', $data, $id);
            echo $this->session->flashdata('mensaje');
        } 
        else {
            $insert_id = $this->M_querys->guardar('rh_roles', $data);
            echo $this->session->flashdata('mensaje');
        }              
    }
    public function creaArray($data)    {
        
        $arreglo        = array();
        for($i = 0; $i < sizeof($data); $i++)   {
            
            $arreglo[$i+1]            = $data[$i]['id'];
            
        }
        
        return $arreglo;
        
    }
     public function offPermisomenu($rol_id, $menu_id)  {
        
        $this->Querys->eliminar('rh_menus_rol', array(array('campo' => 'menu_id', 'valor' => $menu_id), array('campo' => 'rol_id', 'valor' => $rol_id)));
        
        echo $this->session->flashdata('mensaje');
        
    }    
    public function onPermisomenu($rol_id, $menu_id)   {
        
        $data['rol_id']         = $rol_id;
        $data['menu_id']        = $menu_id;
        $data['fecha_registro'] = date('Y-m-d H:i:s');
        
        $id_insert              = $this->Querys->guardar('rh_menus_rol', $data);
        
        if($id_insert)  {
            
            echo $this->session->flashdata('mensaje');
            
        }else   {
            
            echo "Error: Error inesperado, por favor intentelo mas tarde.";
            
        }
        
    }    
    public function onPermisosubmenu($rol_id, $submenu_id)  {
        
        $data['rol_id']         = $rol_id;
        $data['submenu_id']     = $submenu_id;
        $data['fecha_registro'] = date('Y-m-d H:i:s');
        
        $id_insert              = $this->Querys->guardar('rh_submenus_rol', $data);
        
        if($id_insert)  {
            
            echo $this->session->flashdata('mensaje');
            
        }else   {
            
            echo "Error: Error inesperado, por favor intentelo mas tarde.";
            
        }
        
    }    
    public function offPermisosubmenu($rol_id, $menu_id)  {        
        $this->Querys->eliminar('rh_submenus_rol', array(array('campo' => 'submenu_id', 'valor' => $menu_id), array('campo' => 'rol_id', 'valor' => $rol_id)));
        
        echo $this->session->flashdata('mensaje');        
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
