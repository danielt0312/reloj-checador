<?php
Class Turnos extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function getTurnos($where){
        $this->db->select('*');
        $this->db->from('rh_cat_turno');
        #$this->db->where('estatus_id', 1);
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor, 'left');
            }
        }
        return $this->db->get()->result();
    }

        public function setTurnos($data, $id = null){
            foreach($data as $indice => $valor){
                $this->db->set($indice, $valor);
            }
            if($id){
                $this->db->set('fecha_modificacion', date('Y-m-d H:i:s'));
                $this->db->update('rh_cat_turno');
                $result = $this->util->validaSeteo($this->db->affected_rows());
            }else{
                $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
                $this->db->update('rh_cat_turno');
                $result = $this->util->validaSeteo($this->db->insert_id());
            }
            return $result;
        }
}