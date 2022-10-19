<?php
Class M_laboratoristas extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
        
    }
    


    public function getData(){
        
        $this->db->select('rh_personal.cp,rh_personal.id, rh_personal.curp, rh_personal.rfc, rh_personal.foto, rh_personal.nombre, rh_personal.apellido_paterno,rh_personal.apellido_materno, rh_personal.correo,rh_cat_estados.nombre as estado, rh_cat_municipios.nombre as municipio, rh_personal.telefono, rh_cat_departamento.nombre as departamento, rh_cat_areas.nombre as area, rh_cat_puestos.nombre as puesto, rh_personal.cct_laboratorista as cct,');
        $this->db->from('rh_personal');
        $this->db->where('rh_personal.alta_baja =', 1);
        $this->db->where('rh_personal.puesto_id =', 8);
        $this->db->where('rh_personal.correo !=','');
        $this->db->where('rh_personal.correo !=', '0');
        $this->db->where('rh_personal.cct_laboratorista !=','');
        $this->db->where('rh_cat_municipios.estado_id =', 28);
        $this->db->join('rh_cat_estados', 'rh_cat_estados.id = rh_personal.estado_id');
        $this->db->join('rh_cat_areas', 'rh_cat_areas.id = rh_personal.area');
        $this->db->join('rh_cat_municipios', 'rh_cat_municipios.clave = rh_personal.municipio_id');
        $this->db->join('rh_cat_departamento', 'rh_cat_departamento.id = rh_personal.departamento');
        $this->db->join('rh_cat_puestos', 'rh_cat_puestos.id = rh_personal.puesto_id');
        $query = $this->db->get();
        $retorno = $query->result();
        return $retorno;
    }
}