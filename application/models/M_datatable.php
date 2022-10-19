<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datatable extends CI_Model {
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

     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (id like '%".$searchValue."%' or clave like '%".$searchValue."%' or nombre like'%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get('rh_municipios')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get('rh_municipios')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_municipios')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array( 
           "id"=>$record->id,
           "clave"=>$record->clave,
           "nombre"=>$record->nombre,
           "opciones"=>"<a href='Inicio/listas/$record->id' class='btn btn-info fa fa-pencil' style='color: white;' data-tippy='Editar Registro'>Editar</a><a class='btn btn-danger fa fa-trash loadAjax' data-confirmacion='true' data-reload='true'>Eliminar</a>"
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