<?php
class PuestosController extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth/Nav');
        $this->load->model([
            'Catalogos/Puestos',
            'Catalogos/CatEstatus'
        ]);
    }

    public function index(){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $data['puestos']      = $this->Puestos->getPuestos();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Puestos/admin', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function nuevo(){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $data['estatus']            = $this->CatEstatus->getEstatus();
        $data['ruta_form']          = 'catalogos/puestos/guardar';
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Puestos/formulario', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function editar($id){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $data['estatus']    = $this->CatEstatus->getEstatus();
        $data['registro']   = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $id]);
        $data['ruta_form']          = 'catalogos/puestos/actualizar/'.$id;
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Catalogos/Puestos/formulario', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function guardar($id = null){
        $data = array();
        foreach($_POST as $indice => $valor){
            $data[$indice] = $valor;
        }
        $guardar = $this->Puestos->setPuestos($data, $id);
        redirect(base_url('catalogos/puestos'));
    }

    public function eliminar($puesto_id){
        $result = $this->Puestos->setPuestos(
            array(
                'estatus_id' => 2
            ),
            $puesto_id
        );
        echo json_encode($result);
    }
}