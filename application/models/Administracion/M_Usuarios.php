<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Usuarios extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function getEmployees($postData=null){

     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
     //$searchByid = $_POST['id'];
     $searchById = $_POST['id'];
     $searchByrol = $_POST['rol_id'];
     $searchByName = $_POST['nombre'];
     $searchByapp = $_POST['apellido_paterno'];
     $searchByapm = $_POST['apellido_materno'];
     $searchBycorreo = $_POST['correo'];

     ## Search
     $searchQuery = "";

    if ($searchById !='' && $searchByName !='' && $searchByapp !='' && $searchByapm !='' && $searchByrol !='' && $searchBycorreo !='') {
         $searchQuery = " (a.id like '%".$searchById."%' or b.nombre like '%".$searchByrol."%' or a.nombre like '%".$searchByName."%' or a.apellido_paterno like '%".$searchByapp."%' or a.apellido_materno like '%".$searchByapm."%' or a.correo like '%".$searchBycorreo."%' ) ";
    }
    else{
        if($searchById != ''){
          $searchQuery = " (a.id like '%".$searchById."%' ) ";
        }
        if($searchByrol != ''){
          $searchQuery = " (b.nombre like '%".$searchByrol."%' ) ";
        }
        if($searchByName != ''){
          $searchQuery = " (a.nombre like '%".$searchByName."%' ) ";
        }
        if($searchByapp != ''){
          $searchQuery = " (a.apellido_paterno like '%".$searchByapp."%' ) ";
        }
        if($searchByapm != ''){
          $searchQuery = " (a.apellido_materno like '%".$searchByapm."%' ) ";
        }
        if($searchBycorreo != ''){
          $searchQuery = " (a.correo like '%".$searchBycorreo."%' ) ";
        }
    }

     if($searchValue != ''){
        $searchQuery = " (a.id like '%".$searchValue."%' or b.nombre like '%".$searchValue."%'or a.nombre like '%".$searchValue."%' or a.apellido_paterno like '%".$searchValue."%' or a.apellido_materno like '%".$searchValue."%' or a.correo like '%".$searchValue."%' ) ";
     }

     ## Número total de registros sin filtrar
     $this->db->select('count(*) as allcount ');
     $this->db->where('a.alta_baja',1);
     $this->db->join('rh_roles b', 'b.id = a.rol_id', 'left');
     $records = $this->db->get('rh_usuarios a')->result();
     $totalRecords = $records[0]->allcount;

     ## Número total de registros con filtrado
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.alta_baja',1);
        $this->db->join('rh_roles b', 'b.id = a.rol_id', 'left');
     $records = $this->db->get('rh_usuarios a')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Obtener registros
     $this->db->select('a.*,b.nombre as rolid');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.alta_baja',1);
        $this->db->join('rh_roles b', 'b.id = a.rol_id', 'left');
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_usuarios a')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array(
           "id"=>$record->id,
           "rol_id"=>$record->rolid,
           "nombre"=>$record->nombre,
           "apellido_paterno"=>$record->apellido_paterno,
           "apellido_materno"=>$record->apellido_materno,
           "correo"=>$record->correo,
           "opciones"=>"<a href='".base_url('Administracion/Usuarios/Editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id'  data-rol_id='$record->rolid' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
        );
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response;
  }
}
?>
