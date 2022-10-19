<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laboratoristas extends CI_Controller {
    private $dataOrden = array('asc', 'desc');
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->model([
            'M_laboratoristas'
        ]);
    }
    public function index() {
                
        $data['API de Laboratoristas']= $this->M_laboratoristas->getData();
        echo json_encode($data);
    }
}
