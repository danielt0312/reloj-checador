<?php
Class Departamentos extends  CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function  getDepartamento($where = null){
        $this->db->select('*');
        $this->db->from('rh_cat_departamento');
        $this->db->where('estatus_id', 1);
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        return $this->db->get()->result();
    }

    public function setDepartamento($departamento, $id = null){
        foreach($departamento as $indice => $valor){
            $this->db->set($indice, $valor);
        }
        if($id){
            $this->db->set('fecha_modificacion', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update('rh_cat_departamento');
            $result = $this->util->validaSeteo($this->db->affected_rows());
        }else {
            $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
            $this->db->insert('rh_cat_departamento');
            $result = $this->util->validaSeteo($this->db->insert_id());
        }

        return $result;
    }
}