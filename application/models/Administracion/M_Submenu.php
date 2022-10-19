<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Submenu extends CI_Model {
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
     $searchBymenu = $_POST['menu_id'];
     $searchByName = $_POST['nombre'];
     $searchByurl = $_POST['url'];
     $searchByorden = $_POST['orden'];

     ## Search
     $searchQuery = "";

    if ($searchById !='' && $searchByName !='' && $searchByurl !='' && $searchByorden !='') {
         $searchQuery = " (a.id like '%".$searchById."%' or b.nombre like '%".$searchBymenu."%' or a.nombre like '%".$searchByName."%' or a.url like '%".$searchByurl."%' or a.orden like '%".$searchByorden."%' ) ";
    }
    else{
        if($searchById != ''){
          $searchQuery = " (a.id like '%".$searchById."%' ) ";
        }
        if($searchBymenu != ''){
          $searchQuery = " (b.nombre like '%".$searchBymenu."%' ) ";
        }
        if($searchByName != ''){
          $searchQuery = " (a.nombre like '%".$searchByName."%' ) ";
        }
        if($searchByurl != ''){
          $searchQuery = " (a.url like '%".$searchByurl."%' ) ";
        }
        if($searchByorden != ''){
          $searchQuery = " (a.orden like '%".$searchByorden."%' ) ";
        }
    }

     if($searchValue != ''){
        $searchQuery = " (a.id like '%".$searchValue."%' or b.nombre like '%".$searchValue."%'or a.nombre like '%".$searchValue."%' or a.url like '%".$searchValue."%' or a.orden like '%".$searchValue."%' ) ";
     }

     ## Número total de registros sin filtrar
     $this->db->select('count(*) as allcount ');
     $this->db->where('a.alta_baja',1);
     $this->db->join('rh_menu b', 'b.id = a.menu_id', 'left');
     $records = $this->db->get('rh_submenu a')->result();
     $totalRecords = $records[0]->allcount;

     ## Número total de registros con filtrado
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.alta_baja',1);
        $this->db->join('rh_menu b', 'b.id = a.menu_id', 'left');
     $records = $this->db->get('rh_submenu a')->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Obtener registros
     $this->db->select('a.*,b.nombre as menuid');
     if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->where('a.alta_baja',1);
        $this->db->join('rh_menu b', 'b.id = a.menu_id', 'left');
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get('rh_submenu a')->result();

     $data = array();

     foreach($records as $record ){

        $data[] = array(
           "id"=>$record->id,
           "menu_id"=>$record->menuid,
           "nombre"=>$record->nombre,
           "url"=>$record->url,
           "orden"=>$record->orden,
           "opciones"=>"<a href='Administracion/Submenu/Editar/$record->id' class='btn btn-azul'>/ Editar</a>&nbsp;<button type='button' data-id='$record->id'  data-menu_id='$record->menuid' data-nombre='$record->nombre' data-url='$record->url' data-orden='$record->orden' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'>/ Eliminar</button>"
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
