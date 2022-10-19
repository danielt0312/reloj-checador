<?php
Class CatMotivosBajas extends CI_Model{

    public $motivosBaja;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    /**
     * @return mixed
     */
    public function getMotivosBaja($id = null)
    {
        $this->db->select('rh_motivos_vaja.*, rh_cat_estatus.nombre as nombre_estatus');
        $this->db->from('rh_motivos_vaja');
        $this->db->join('rh_cat_estatus', 'rh_motivos_vaja.estatus_id = rh_cat_estatus.id');
        if($id){
            $this->db->where('rh_motivos_vaja.id', $id);
        }
        $this->motivosBaja = $this->db->get();
        return $this->motivosBaja->result();
    }

    /**
     * @param mixed $motivosBaja
     */
    public function setMotivosBaja($motivosBaja, $id = null){
        foreach($motivosBaja as $indice => $valor) {
            $this->db->set($indice, $valor);
        }
        if($id){
            $this->db->set('fecha_modificado', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update('rh_motivos_vaja');
            $result = $this->util->validaSeteo($this->db->affected_rows());
        }else{
            $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
            #$data_save['fecha_registro'] = date('Y-m-d H:i:s');
            $this->db->insert('rh_motivos_vaja');
            $result = $this->util->validaSeteo($this->db->insert_id());
        }
        return $result;
    }

}