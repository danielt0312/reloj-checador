<?php
class Lotes extends CI_Model{

    protected $table = 'rh_credencializacion_lote';

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get($where = null){
        $this->db->select('*');
        if($where){
            foreach($where as $key => $value){
                $this->db->where($key, $value);
            }
        }
        $this->db->from($this->table);
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