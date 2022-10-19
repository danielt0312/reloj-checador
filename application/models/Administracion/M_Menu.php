<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {
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
     $searchByName = $_POST['nombre'];
     $searchByurl = $_POST['url'];
     $searchByorden = $_POST['orden'];

     ## Search
     $searchQuery = "";

    if ($searchById !='' && $searchByName !='' && $searchByurl !='' && $searchByorden !='') {
         $searchQuery = " (id like '%".$searchById."%' or nombre like '%".$searchByName."%' or url like '%".$searchByurl."%' or orden like '%".$searchByorden."%' ) ";
    }
    else{
        if($searchById != ''){
          $searchQuery = " (id like '%".$searchById."%' ) ";
        }
        if($searchByName != ''){
          $searchQuery = " (nombre like '%".$searchByName."%' ) ";
        }
        if($searchByurl != ''){
          $searchQuery = " (url like '%".$searchByurl."%' ) ";
        }
        if($searchByorden != ''){
          $searchQuery = " (orden like '%".$searchByorden."%' ) ";
        }
    }

     if($searchValue != ''){
        $searchQuery = " (id like '%".$searchValue."%' or nombre like '%".$searchValue."%' or url like '%".$searchValue."%' or orden like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_menu')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_menu')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_menu')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array(
           "id"=>$record->id,
           "nombre"=>$record->nombre,
           "url"=>$record->url,
           "orden"=>$record->orden,
           "opciones"=>"<a href='Administracion/Menu/Editar/$record->id' class='btn btn-azul'>/ Editar</a>&nbsp;<button type='button' data-id='$record->id' data-nombre='$record->nombre' data-url='$record->url' data-orden='$record->orden' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'>/ Eliminar</button>"
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
