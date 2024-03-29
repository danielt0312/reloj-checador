<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Departamento extends CI_Model {
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
     #$searchValue = $postData['search']['value']; // Search value
     //$searchByid = $_POST['id'];
     #$searchById = $_POST['id'];
     #$searchByName = $_POST['nombre'];

     ## Search
     $searchQuery = "";



     ## Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_cat_departamento')->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $records = $this->db->get('rh_cat_departamento')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('alta_baja',1);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_cat_departamento')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array(
           "id"=>$record->id,
           "nombre"=>$record->nombre,
           "opciones"=>"<a href=".base_url('Catalogos/Departamento/Editar/'.$record->id)." class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<a href=".base_url('Catalogos/Departamento/Areas/'.$record->id)." class='btn btn-azul'><i class='fa fa-list' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-nombre='$record->nombre' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
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
