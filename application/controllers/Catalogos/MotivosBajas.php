<?php
class MotivosBajas extends CI_Controller {

    public $motivos;
    protected $dir_views;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth/Nav');
        $this->load->model('Catalogos/CatMotivosBajas');
        $this->load->model('Catalogos/CatEstatus');
        $this->dir_views = $this->uri->segment(2);
    }

    public function index(){
        $data['motivos']    = $this->CatMotivosBajas->getMotivosBaja();
        $this->render('Catalogos/MotivosBajas/admin', $data);
    }

    public function nuevo(){
        $data['estatus']    = $this->CatEstatus->getEstatus();
        $this->render('Catalogos/MotivosBajas/formulario', $data);
    }

    public function editar($id){
        $data['estatus']    = $this->CatEstatus->getEstatus();
        $data['registro']   = $this->CatMotivosBajas->getMotivosBaja($id);
        $this->render('Catalogos/MotivosBajas/formulario', $data);
    }

    public function guardar($id = null){
        $data = array();
        foreach($_POST as $indice => $valor){
            $data[$indice] = $valor;
        }
        $guardar = $this->CatMotivosBajas->setMotivosBaja($data, $id);
        $this->index();
    }

    public function eliminar($motivobaja_id){
        $result = $this->CatMotivosBajas->setMotivosBaja(
            array(
                'estatus_id' => 2
            ),
            $motivobaja_id
        );
        echo json_encode($result);
    }

    public function render($view, $data = null){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view($view, $data);
        $this->load->view('Plantilla/v_footer');
    }

    /**
     * @return mixed
     */
    public function getMotivos()
    {
        return $this->motivos;
    }

    /**
     * @param mixed $motivos
     */
    public function setMotivos($motivos)
    {
        $this->motivos = $motivos;
    }



}