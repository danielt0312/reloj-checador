<?php
class RegistrosLote extends CI_Model{

    protected $table = 'rh_registros_lote';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($where = null){
        $this->db->select('rh_registros_lote.*, rh_personal.nombre, rh_personal.apellido_paterno, rh_personal.apellido_materno, rh_personal.area, rh_personal.departamento, rh_personal.puesto_id');
        if($where){
            foreach($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        $this->db->from($this->table);
        $this->db->join('rh_personal', 'rh_registros_lote.personal_id = rh_personal.id', 'left');
        return $this->db->get()->result();
    }

    public function contadorRegistros($where){
        $this->db->select('lote_id, COUNT(lote_id)');
        if($where){
            foreach($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        $this->db->from($this->table);
        $this->db->group_by('lote_id');
        return $this->db->get()->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        $id_insert = $this->db->insert_id();
        if($id_insert){
            $this->session->set_flashdata('id_insert', $id_insert);
            $this->session->set_flashdata('error', 0);
            $this->session->set_flashdata('mensaje', 'Registro guardado correctamente');
        }else{
            $this->session->set_flashdata('id_insert', $id_insert);
            $this->session->set_flashdata('error', 0);
            $this->session->set_flashdata('mensaje', 'Error: Intentelo de nuevo o más tarde');
        }
    }

    public function update($data, $id){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('error', 0);
            $this->session->set_flashdata('mensaje', 'Registro actualizado correctamente');
        }else{
            $this->session->set_flashdata('error', 1);
            $this->session->set_flashdata('mensaje', 'No se pudo actualizar el registro');
        }
    }
}