<?php
Class CatRoles extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getRoles(){
        $this->db->select('*');
        $this->db->from('rh_roles');
        $consulta = $this->db->get();
        return $consulta->result();
    }
}