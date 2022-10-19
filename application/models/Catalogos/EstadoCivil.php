<?php
Class EstadoCivil extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getEstadoCivil($where = null){
        $this->db->select('*');
        $this->db->from('rh_cat_estadocivil');
        if($where){
            foreach ($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        return $this->db->get()->result();
    }
}