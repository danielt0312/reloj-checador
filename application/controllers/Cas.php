<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cas extends CI_Controller {
    private $dataOrden = array('asc', 'desc');
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->model([
            'M_cas'
        ]);
    }
    public function index() {
                
        $data['personal']= $this->M_cas->getData();
        //  foreach($data as $row){ 
        //     echo $row->id.'<br>';  
        // } 
        echo json_encode($data);


                // $data = $this->M_cas->getData();
                // echo (json_encode($data));
    }
}
