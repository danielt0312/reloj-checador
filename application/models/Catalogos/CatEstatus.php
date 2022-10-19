<?php
Class CatEstatus extends CI_Model{

    protected $estatus;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    /**
     * @return mixed
     */
    public function getEstatus($where = null)
    {
        $this->db->select('*');
        $this->db->from('rh_cat_estatus');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        $this->estatus = $this->db->get();
        return $this->estatus->result();
    }

    /**
     * @param mixed $estatus
     */
    public function setEstatus($estatus, $id)
    {
        $this->estatus = $estatus;
    }


}