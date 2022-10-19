<?php

Class PersonalController extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Auth/Nav',
            'Registros/Personal',
            'Registros/VitacoraPersonal',
            'Registros/M_RegistrosPersonal',
            'Catalogos/Municipios',
            'Catalogos/CatAreas',
            'Catalogos/CentrosTrabajo',
            'DataTables/DataPersonal'
        ]);
        $this->dir_views = $this->uri->segment(1).'/'.$this->uri->segment(2);
        $this->seguridad();  
    }

    public function index(){
        $data['motivos']    = $this->CatMotivosBajas->getMotivosBaja();
        $this->render('admin', $data);
    }

    public function render($view, $data = null){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view($this->dir_views.'/'.$view, $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function personalActivo(){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $data['vitacora']           = 1;
        $data['opedicion']          = $this->opsubmenuedicion();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/index', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function personalInctivo(){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $data['vitacora']           = 2;
        $data['opedicion']           = $this->opsubmenuedicion();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Registros/Personal/index', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function getMunicipio()  {
        $id             = $_POST['valor'];
        $lista          = $this->Municipios->listOptionMunicipios(['estado_id' => $id]);
        echo (json_encode($lista));
    }

    public function getArea(){
        $id             = $_POST['valor'];
        $lista          = $this->CatAreas->listOptionAreas(['departamento_id' => $id]);
        echo (json_encode($lista));
    }

    public function dataTable(){
        $postData   = $this->input->post();
        #$data       = $this->Personal->dataTable($postData);
        $this->DataPersonal->dataConfig($postData);
        $data       = $this->DataPersonal->getData();
        echo json_encode($data);
    }

    public function autoCompleteCT(){
        $valor = $_POST['search'];
        $arreglo = array();
        foreach($this->CentrosTrabajo->getCT(['clavecct' => $valor, 'nombrect' => $valor]) as $result){
            array_push($arreglo, $result->clavecct.','.$result->nombrect);
        }
        echo json_encode($arreglo);
    }

        /**********************Permisos***************************/
        public function menu(){        
            $items  = $this->Querys->consulta('a.id as id_menu, a.nombre as nombre_menu, a.orden, a.alta_baja, a.url', 'rh_menu a', array(array('tabla' => 'rh_menus_rol b', 'join' => 'b.menu_id=a.id')),"b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");        
            return $items;        
        }
        public function submenu(){
            $items  = $this->Querys->consulta('a.id as id_submenu, a.nombre as nombre_submenu, a.menu_id, a.url, a.alta_baja, a.opedicion', 'rh_submenu a',array(array('tabla' => 'rh_submenus_rol b', 'join' => 'b.submenu_id=a.id')), "b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");
            return $items;        
        }
        public function opsubmenuedicion(){
            $items  = $this->Querys->consulta('a.opedicion', 'rh_submenu a',array(array('tabla' => 'rh_submenus_rol b', 'join' => 'b.submenu_id=a.id')), "b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1 AND a.id=11", null, null, null, null);
            foreach ($items as $key) {
                return $key['opedicion'];
            }
            
            //return $items;        
        }
        public function seguridad() 
        {
            if ($this->session->userdata('id')) {
                return true;
            } else {
                redirect(base_url());
            }
        }

}