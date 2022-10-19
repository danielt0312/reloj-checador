<?php
class Puestos extends  CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function getPuestos($where = null){
        $this->db->select('rh_cat_puestos.*, rh_cat_estatus.nombre nombre_estatus');
        $this->db->from('rh_cat_puestos');
        $this->db->join('rh_cat_estatus', 'rh_cat_puestos.estatus_id = rh_cat_estatus.id', 'left');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);;
            }
        }

        return $this->db->get()->result();
    }

    public function setPuestos($data, $id = null){
        foreach($data as $indice => $valor){
            $this->db->set($indice, $valor);
        }
        if($id){
            $this->db->set('fecha_modificado', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update('rh_cat_puestos');
            $result = $this->util->validaSeteo($this->db->affected_rows());
        }else{
            $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
            $this->db->insert('rh_cat_puestos');
            $result = $this->util->validaSeteo($this->db->insert_id());
        }
        return $result;
    }
}