<?php
class Personal extends CI_Model{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $personal_id  Identificador del registro al que se le afectaran sus datos
     * @param $idsTiposPlaza arreglo de los checkbox que se envían para su guardado
     */
    public function getPeronal($where){

        //for ($i=0; $i < 644; $i++) {
        //    $data= array(
        //        "id_cifrado" => md5($i)
        //    );
            
        //    $this->db->where("id", $i);
        //    $this->db->update("rh_personal", $data);
        //}
        
        $this->db->select('*');
        foreach($where as $indice => $valor){
            $this->db->where($indice, $valor);
        }
        $this->db->from('rh_personal');
        return $this->db->get()->result();
    }

    public function getPersonalJoins($select = '*', $where = null){
        $this->db->select($select);
        $this->db->from('rh_personal');
        $this->db->join('rh_cat_puestos', 'rh_personal.puesto_id = rh_cat_puestos.id', 'left');
        $this->db->join('rh_cat_departamento', 'rh_personal.departamento = rh_cat_departamento.id', 'left');
        $this->db->join('rh_cat_areas', 'rh_personal.area = rh_cat_areas.id', 'left');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        return $this->db->get()->result();

    }

    public function getIdCifrado($where){
        $this->db->select('id');
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function getPersonalCifrado($where){
        
        $this->db->select('*');
        foreach($where as $indice => $valor){
            $this->db->where($indice, $valor);
        }
        $this->db->from('rh_personal');
        return $this->db->get()->result();
    }

    public function setTiposPlazaPersona($personal_id, $idsTiposPlaza){
        $data_save = array();
        $this->db->select('id');
        $this->db->from('rh_plaza_personal');
        $this->db->where('personal_id', $personal_id);
        $consulta = $this->db->get();
        $this->load->library('Util');
        $datos = $this->util->setArreglo($consulta->result());

        if(count($datos) > 0){

            $this->db->where('personal_id', $personal_id);
            $this->db->where_not_in('tipo_plaza_id', $idsTiposPlaza);
            $this->db->delete('rh_plaza_personal');

            foreach($idsTiposPlaza as $indice => $valor){
                $arreglo = array(
                    'personal_id' => $personal_id,
                    'tipo_plaza_id' => $valor,
                    'fecha_registro' => date('Y-m-d H:i:s')
                );
                $this->db->select('id');
                $this->db->from('rh_plaza_personal');
                $this->db->where('personal_id', $personal_id);
                $this->db->where('tipo_plaza_id', $valor);
                $consulta = $this->db->get();
                if(!$consulta->result()){
                    array_push($data_save, $arreglo);
                }

            }

        }else{
            foreach($idsTiposPlaza as $indice => $valor){
                $arreglo = array(
                    'personal_id' => $personal_id,
                    'tipo_plaza_id' => $valor,
                    'fecha_registro' => date('Y-m-d H:i:s')
                );
                array_push($data_save, $arreglo);
            }
        }

        if(count($data_save) > 0){
            $this->db->insert_batch('rh_plaza_personal', $data_save);
        }

    }

    public function setClavesPersonal($personal_id, $claves){

        foreach($claves as $cct => $clave){
            $data_save = array(
                'personal_id ' => $personal_id,
                'cct' => $cct,
                'clave_presupuestal' => $clave
            );
            $this->db->insert('rh_claves_personal', $data_save);
        }

    }

    public function getClavesPersonal($where = array()){
        $this->db->select('*');
        $this->db->from('rh_claves_personal');
        $this->db->join('rh_cat_categorias','rh_claves_personal.clave_presupuestal 
                LIKE concat("%", rh_cat_categorias.categoria, "%")','left');
        $this->db->join('mec_centros_trabajo','rh_claves_personal.cct = mec_centros_trabajo.clavecct','left');
        foreach($where as $indice => $valor){
            $this->db->where('personal_id', $valor);
        }
        return $this->db->get()->result();

    }

    public function getCategoria($where = array()){
       $this->db->select('SUBSTRING(clave_presupuestal, 7, 5) as clave');
       $this->db->from('rh_claves_personal');
       foreach($where as $indice => $valor){
            $this->db->where($indice, $valor);
    }
       $cat = $this->db->get()->result_array();
        $this->db->select('nombre');
        $this->db->from('rh_cat_categorias');
        foreach($cat as $indice => $valor){
            print_r($valor['clave']);
            $this->db->where('categoria', $valor['clave']);
        }
        $min = $this->db->get()->result();

        print_r($min);
    }

    public function eliminarClavePresupuestal($where){
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
            $this->db->delete('rh_claves_personal');
            return $this->util->validaSeteo($this->db->affected_rows());
        }else{
            return 0;
        }

    }

    public function eliminaPersonal($id){
        $this->db->delete('rh_personal', ['id' => $id]);
    }

    /**
     * @param $personal_id Identificador de personal
     * @return Objeto de tipos de plaza de persona
     */
    public function getTiposPlazaPersona($personal_id){
        $this->db->select();
        $this->db->from('rh_plaza_personal');
        $this->db->where('personal_id', $personal_id);
        $consulta =  $this->db->get();
        return $consulta->result();
    }

    public function getTiposPlazaPersonaRelCat($personal_id){
        $this->db->select('rh_plaza_personal.*, rh_cat_plaza.nombre');
        $this->db->from('rh_plaza_personal');
        $this->db->join('rh_cat_plaza', 'rh_plaza_personal.tipo_plaza_id = rh_cat_plaza.id', 'left');
        $this->db->where('rh_plaza_personal.personal_id', $personal_id);
        $consulta =  $this->db->get();
        return $consulta->result();
    }

    public function setPersonal($data, $id = null){
        foreach($data as $indice => $valor){
            $this->db->set($indice, $valor);
        }
        if($id){
            $this->db->where('id', $id);
            $this->db->update('rh_personal');
        }else{
            $this->db->insert('rh_personal');
        }

    }

    public function dataTable($postData = null){
        $response = array();

        ## POST
        $draw               = $postData['draw'];
        $start              = $postData['start'];
        $rowperpage         = $postData['length']; // Rows display per page
        $columnIndex        = $postData['order'][0]['column']; // Column index
        $columnName         = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder    = $postData['order'][0]['dir']; // asc or desc
        $searchValue        = $postData['search']['value']; // Search value
        $estatusvitacora    = $postData['vitacora'];
        $searchQuery        = "";

        if($searchValue != ''){
            $searchQuery = ' (rh_personal.id like "%'.$searchValue.'%" or rh_personal.curp like "%'.$searchValue.'%" or rh_personal.rfc like "%'.$searchValue.'%" or rh_personal.nombre like "%'.$searchValue.'%" or rh_personal.apellido_paterno like "%'.$searchValue.'%" or rh_personal.apellido_materno like "%'.$searchValue.'%" or rh_personal.telefono like "%'.$searchValue.'%") OR  CONCAT(rh_personal.nombre," ",rh_personal.apellido_paterno," ",rh_personal.apellido_materno) like "%'.$searchValue.'%"';
        }

        ## Total registros
        $this->db->select('rh_personal.*');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');
        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.estatus_id', $estatusvitacora);
        $this->db->where('rh_vitacora_personal.activo', 1);
        $totalRecords = $this->db->get('rh_personal')->num_rows();

        # Obtención de paginas
        $this->db->select('rh_personal.*');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');
        if($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.estatus_id', $estatusvitacora);
        $this->db->where('rh_vitacora_personal.activo', 1);
        $totalRecordwithFilter = $this->db->get('rh_personal')->num_rows();


        ## Data
        $this->db->select('rh_personal.*');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');
        if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.activo', 1);
        $this->db->where('rh_vitacora_personal.estatus_id', $estatusvitacora);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->group_by('rh_personal.id');
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('rh_personal')->result();

        $data = array();
        if($this->session->userdata('rol_id') != 6){
                foreach($records as $record ){

                    $data[] = array(
                        "id"                =>$record->id,
                        "curp"              =>$record->curp,
                        "rfc"               =>$record->rfc,
                        "nombre"            =>$record->nombre,
                        "apellido_paterno"  =>$record->apellido_paterno,
                        "apellido_materno"  =>$record->apellido_materno,
                        "telefono"          =>$record->telefono,
                        #"opciones"=>"<a href='Registro/Ver/$record->id' class='btn btn-azulclaro'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
                        "opciones"          =>"<div class='btn-group'>ssss<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".$record->id."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='".base_url('registros/'.$this->uri->segment(2).'/editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button></div>"
                    );
                }
        }
        else{
            foreach($records as $record ){

                $data[] = array(
                    "id"                =>$record->id,
                    "curp"              =>$record->curp,
                    "rfc"               =>$record->rfc,
                    "nombre"            =>$record->nombre,
                    "apellido_paterno"  =>$record->apellido_paterno,
                    "apellido_materno"  =>$record->apellido_materno,
                    "telefono"          =>$record->telefono,
                    #"opciones"=>"<a href='Registro/Ver/$record->id' class='btn btn-azulclaro'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
                    "opciones"          =>"<div class='btn-group'>ssss<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".$record->id."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;</div>"
                );
            }
        }

        ## Response
        $response = array(
            "draw"                  => intval($draw),
            "iTotalRecords"         => $totalRecords,
            "iTotalDisplayRecords"  => $totalRecordwithFilter,
            "aaData"                => $data
        );

        return $response;
    }

}