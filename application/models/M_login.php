<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function consulta($usuario, $password) 
  {
    $this->db->select('a.id,a.nombre, a.apellido_paterno,a.apellido_materno,a.usuario,a.password,a.rol_id,a.alta_baja,a.departamento_id,a.area_id');
    $this->db->from('rh_usuarios a');
    $this->db->where('a.usuario', $usuario);
    $consulta = $this->db->get();

    if ($consulta->num_rows() > 0) {
      $this->db->where('a.usuario', $usuario)->where('a.password', $password)->where('a.alta_baja',1);
      $this->db->from('rh_usuarios a');
      $consulta1 = $this->db->get();

      if ($consulta1->num_rows() > 0) {

        $consulta = $consulta->row();
        $data     = array(
                'id'      => $consulta->id,
                'nombre'    => $consulta->nombre,
                'apellido_paterno'    => $consulta->apellido_paterno,
                'apellido_materno' => $consulta->apellido_materno,        
                'rol_id'     => $consulta->rol_id,
                'departamento_id' => $consulta->departamento_id,
                'area_id' => $consulta->area_id,
                'registros' => 10
              );
        $this->session->set_userdata($data);

      } else {
        $this->session->set_flashdata('mensaje', 'Cuenta deshabilitada temporalmente, o su contraseña es incorrecta, Verifique!');
      }

    } else {
      $this->session->set_flashdata('mensaje', '¡Usuario incorrecto, verifique!');
    }

  }
}
?>