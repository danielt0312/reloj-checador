<?php
Class VitacoraPersonal extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function setVitacoraPersonal($data, $id){
        $this->db->set('activo', 0);
        $this->db->where('personal_id', $id);
        $this->db->set('fecha_modificado', date('Y-m-d H:i:s'));
        $this->db->update('rh_vitacora_personal');

        extract($data);
        $this->db->set('personal_id', $id);
        $this->db->set('estatus_id', $estatus_id);
        $this->db->set('motivo_baja_id', ($estatus_id == 2) ? $motivo_baja_id : 0);
        $this->db->set('fecha_baja', $fecha_baja);
        $this->db->set('activo', 1);
        $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
        $this->db->insert('rh_vitacora_personal');
        return $this->db->insert_id();
    }

    public function getVitacoraPersonal($where = null){
        $this->db->select('rh_vitacora_personal.id,rh_vitacora_personal.fecha_baja,rh_vitacora_personal.personal_id,rh_vitacora_personal.comentario,rh_vitacora_personal.fecha_registro, rh_cat_estatus.nombre as nombre_estatus, rh_motivos_vaja.nombre as nombre_motivo');
        $this->db->from('rh_vitacora_personal');
        $this->db->join('rh_cat_estatus', 'rh_vitacora_personal.estatus_id = rh_cat_estatus.id');
        $this->db->join('rh_motivos_vaja', 'rh_vitacora_personal.motivo_baja_id = rh_motivos_vaja.id', 'left');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        $this->db->where('rh_vitacora_personal.activo', 1);

        return $this->db->get()->result();
    }

}