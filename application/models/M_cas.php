<?php
Class M_cas extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
        
    }
    


    public function getData(){
        
        $this->db->select('rh_cat_departamento.nombre as departamento, rh_personal.foto,rh_personal.id, rh_personal.nombre,rh_personal.correo,rh_cat_areas.nombre as area, rh_personal.apellido_paterno,rh_personal.apellido_materno, rh_personal.correo, rh_personal.telefono ,rh_cat_puestos.nombre as puesto, rh_personal.cct_laboratorista as cct,');
        $this->db->from('rh_personal');
        $this->db->where('rh_personal.alta_baja =', 1);
        $this->db->join('rh_cat_areas', 'rh_cat_areas.id = rh_personal.area');
        $this->db->join('rh_cat_departamento', 'rh_cat_departamento.id = rh_personal.departamento');
        $this->db->join('rh_cat_puestos', 'rh_cat_puestos.id = rh_personal.puesto_id');
        $query = $this->db->get();
        $retorno = $query->result();
        return $retorno;
        
            //foreach ($query->result_array() as $row){
                
              //  $retorno['Id'] = $row['id'];
                // $retorno['Nombre'] = $row->nombre;
                // $retorno['Apellido Paterno'] = $row->apellido_paterno;
                // $retorno['Apellido Materno'] = $row->apellido_materno;
                // $retorno['Correo Electrónico'] = $row->correo;
                // $retorno['Puesto'] = $row->puesto;
                // $retorno['CCT Laboratorista'] = $row->cct;
                // $retorno['Área'] = $row->area;
                // $retorno['Departamento'] = $row->departamento;
            // if (empty($row->foto)) {
            //         $retorno['foto'] = 'https://proyectoscete.tamaulipas.gob.mx/rh/assets/img/usuario.png';
            // }
            // else{
            //     $retorno['foto'] = 'https://proyectoscete.tamaulipas.gob.mx/rh'.$row->foto;
            // }
            //    return $retorno;
            // // }
           
            
     
              
            
        //return $query->result();

        //return $this->db->get('rh_personal')->result();
       
        // $this->db->select('rh_cat_departamento.nombre as departamento, rh_personal.foto,rh_personal.id, rh_personal.nombre,rh_personal.correo,rh_cat_areas.nombre as area, rh_personal.apellido_paterno,rh_personal.apellido_materno, rh_personal.correo, rh_cat_puestos.nombre as puesto, rh_personal.cct_laboratorista as cct');
        //     $this->db->from('rh_personal');
        //     $this->db->where('rh_personal.id',$id);
        //     $this->db->join('rh_cat_areas', 'rh_cat_areas.id = rh_personal.area');
        //     $this->db->join('rh_cat_departamento', 'rh_cat_departamento.id = rh_personal.departamento');
        //     $this->db->join('rh_cat_puestos', 'rh_cat_puestos.id = rh_personal.puesto_id');
        //     $datass=$this->db->get();
            
        //     foreach ($datass->result() as $row){
        //         $retorno[0]['Id'] = $row->id;
        //         $retorno[0]['Nombre'] = $row->nombre;
        //         $retorno[0]['Apellido Paterno'] = $row->apellido_paterno;
        //         $retorno[0]['Apellido Materno'] = $row->apellido_materno;
        //         $retorno[0]['Correo Electrónico'] = $row->correo;
        //         $retorno[0]['Puesto'] = $row->puesto;
        //         $retorno[0]['CCT Laboratorista'] = $row->cct;
        //         $retorno[0]['Área'] = $row->area;
        //         $retorno[0]['Departamento'] = $row->departamento;
        //         if (empty($row->foto)) {
        //             $retorno[0]['foto'] = 'https://proyectoscete.tamaulipas.gob.mx/rh/assets/img/usuario.png';
        //        }
        //        else{
        //         $retorno[0]['foto'] = 'https://proyectoscete.tamaulipas.gob.mx/rh'.$row->foto;
        //        }
                
        //     }
        //     return $retorno;
    }
}