<?php
Class CatAreas extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function getAreas($where = null){
        $this->db->select('*');
        $this->db->from('rh_cat_areas');
        $this->db->where('estatus_id', 1);
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        $consulta = $this->db->get();
        return $consulta->result();

    }

    public function listOptionAreas($where = null){
        $this->db->select('id as value, nombre as legend');
        $this->db->from('rh_cat_areas');
        $this->db->where('estatus_id', 1);
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function setAreas($data, $id = null){
        foreach($data as $indice => $valor){
            $this->db->set($indice, $valor);
        }
        if($id){
            $this->db->set('fecha_modificacion', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update('rh_cat_areas');
            $result = $this->util->validaSeteo($this->db->affected_rows());

        }else{
            $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
            $this->db->insert('rh_cat_areas');
            $result = $this->util->validaSeteo($this->db->insert_id());
        }
        return $result;
    }
}