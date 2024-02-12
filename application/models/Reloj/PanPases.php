<?php
Class PanPases extends  CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function borrarPase($id){
        $this->db->delete('rh_pases', ['id' => $id]);
    }
}