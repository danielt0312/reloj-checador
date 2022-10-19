<?php
Class Nav extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function menus(){
        $this->db->select('rh_menu.id as id_menu, rh_menu.nombre as nombre_menu, rh_menu.orden, rh_menu.url');
        $this->db->from('rh_menu');
        $this->db->join('rh_menus_rol', 'rh_menu.id = rh_menus_rol.menu_id');
        $this->db->where(['rh_menus_rol.rol_id' => $this->session->userdata('rol_id')]);
        $consulta = $this->db->get();
        return $consulta->result_array();
    }

    public function submenus(){
        $this->db->select('rh_submenu.id as id_submenu, rh_submenu.nombre as nombre_submenu, rh_submenu.menu_id, rh_submenu.url');
        $this->db->from('rh_submenu');
        $this->db->join('rh_submenus_rol', 'rh_submenu.id = rh_submenus_rol.submenu_id');
        $this->db->where(['rh_submenus_rol.rol_id' => $this->session->userdata('rol_id')]);
        $consulta = $this->db->get();
        return $consulta->result_array();
    }
}