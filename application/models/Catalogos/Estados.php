<?php
Class Estados extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');

    }

    public function getEstados($where = null){
        $this->db->select('*');
        $this->db->from('rh_cat_estados');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor, 'left');
            }
        }
        return $this->db->get()->result();
    }
}