<?php
Class Municipios extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getMunicipios($where = null){
        $this->db->select('*');
        $this->db->from('rh_cat_municipios');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor, 'left');
            }
        }
        return $this->db->get()->result();
    }

    public function listOptionMunicipios($where = null){
        $this->db->select('clave as value, nombre as legend');
        $this->db->from('rh_cat_municipios');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor, 'left');
            }
        }
        return $this->db->get()->result();
    }
}