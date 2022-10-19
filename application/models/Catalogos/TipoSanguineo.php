<?php
Class TipoSanguineo extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getTipoSanguineo($where){
        $this->db->select('*');
        $this->db->from('rh_cat_tiposangre');
        if($where){
            foreach ($where as $indice => $valor){
                $this->db->where($indice, $valor, 'left');
            }
        }
        return $this->db->get()->result();
    }
}