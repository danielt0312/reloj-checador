<?php
class CentrosTrabajo extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getCT($where = null){
        $this->db->select('*');
        $this->db->from('mec_centros_trabajo');
        if($where){
            foreach($where as $key => $value){
                $this->db->or_like($key, $value);
            }
        }
        $this->db->limit(10);
        return $this->db->get()->result();
    }
}