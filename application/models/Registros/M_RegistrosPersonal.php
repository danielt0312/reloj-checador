<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_RegistrosPersonal extends CI_Model {
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
     $searchBycurp = $_POST['curp'];
     $searchByrfc = $_POST['rfc'];
     $searchByName = $_POST['nombre'];
     $searchByapp = $_POST['apellido_paterno'];
     $searchByapm = $_POST['apellido_materno'];
     $searchBytel = $_POST['telefono'];

     ## Search
     $searchQuery = "";

    if ($searchById !='' && $searchBycurp !='' && $searchByrfc !='' && $searchByName !='' && $searchByapp !='' && $searchByapm !='' && $searchBytel !='') {
         $searchQuery = " (id like '%".$searchById."%' or curp like '%".$searchBycurp."%' or rfc like '%".$searchByrfc."%' or nombre like '%".$searchByName."%' or apellido_paterno like '%".$searchByapp."%' or apellido_materno like '%".$searchByapm."%' or telefono like '%".$searchBytel."%' ) ";
    }
    else{
        if($searchById != ''){
          $searchQuery = " (id like '%".$searchById."%' ) ";
        }
        if($searchBycurp != ''){
          $searchQuery = " (curp like '%".$searchBycurp."%' ) ";
        }
        if($searchByrfc != ''){
          $searchQuery = " (rfc like '%".$searchByrfc."%' ) ";
        }
        if($searchByName != ''){
          $searchQuery = " (nombre like '%".$searchByName."%' ) ";
        }
        if($searchByapp != ''){
          $searchQuery = " (apellido_paterno like '%".$searchByapp."%' ) ";
        }
        if($searchByapm != ''){
          $searchQuery = " (apellido_materno like '%".$searchByapm."%' ) ";
        }
        if($searchBytel != ''){
          $searchQuery = " (telefono like '%".$searchBytel."%' ) ";
        }
    }

     if($searchValue != ''){
        $searchQuery = ' (id like "%'.$searchValue.'%" or curp like "%'.$searchValue.'%" or rfc like "%'.$searchValue.'%" or nombre like "%'.$searchValue.'%" or apellido_paterno like "%'.$searchValue.'%" or apellido_materno like "%'.$searchValue.'%" or telefono like "%'.$searchValue.'%") OR CONCAT(nombre," ",apellido_paterno," ",apellido_materno) like "%'.$searchValue.'%"';
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_personal')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_personal')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_personal')->result();

     $data = array();
      if($this->session->userdata('rol_id') != 6){
        foreach($records as $record ){

            $data[] = array(
              "id"=>$record->id,
              "curp"=>$record->curp,
              "rfc"=>$record->rfc,
              "nombre"=>$record->nombre,
              "apellido_paterno"=>$record->apellido_paterno,
              "apellido_materno"=>$record->apellido_materno,
              "telefono"=>$record->telefono,
              #"opciones"=>"<a href='Registro/Ver/$record->id' class='btn btn-azulclaro'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
              "opciones"=>"<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".$record->id."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
            );
        }
      }
      else{
        foreach($records as $record ){
            $data[] = array(
              "id"=>$record->id,
              "curp"=>$record->curp,
              "rfc"=>$record->rfc,
              "nombre"=>$record->nombre,
              "apellido_paterno"=>$record->apellido_paterno,
              "apellido_materno"=>$record->apellido_materno,
              "telefono"=>$record->telefono,
              #"opciones"=>"<a href='Registro/Ver/$record->id' class='btn btn-azulclaro'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
              "opciones"=>"<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".$record->id."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;"
            );
        }
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
