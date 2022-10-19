<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Consultas extends RestController {

    protected $CI;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->model('Registros/Personal');
        header("Access-Control-Allow-Origin: *");
    }

    public function buscar_por_email_post(){

        if($this->post('correo')){
            $personal = $this->CI->Personal->getPersonalJoins(
                'rh_personal.id,
                rh_personal.foto,
                rh_personal.correo,
                rh_personal.nombre,
                rh_personal.apellido_paterno,
                rh_personal.apellido_materno,
                rh_personal.telefono,
                rh_personal.cct_laboratorista,
                rh_cat_departamento.nombre as cat_departamento,
                rh_cat_areas.nombre as cat_area,
                rh_cat_puestos.nombre as cat_puesto',
                ['correo'=> $this->post('correo')]);
            if(count($personal) > 0){
                $this->response($personal, 200);
            }else{
                $this->response("Personal no encontrado", 404);
            }

        }else{
            $this->response('No se recive el parametro esperado', 200);
        }
    }

    public function buscarPersonalPorId_post(){
        if($this->head('id')){
            $personal = $this->CI->Personal->getPersonalJoins(
                'rh_personal.id,
                rh_personal.foto,
                rh_personal.correo,
                rh_personal.nombre,
                rh_personal.apellido_paterno,
                rh_personal.apellido_materno,
                rh_personal.telefono,
                rh_personal.cct_laboratorista,
                rh_cat_departamento.nombre as cat_departamento,
                rh_cat_areas.nombre as cat_area,
                rh_cat_puestos.nombre as cat_puesto',
                ['rh_personal.id'=> $this->head('id')]);
            if(count($personal) > 0){
                $this->response($personal, 200);
            }else{
                $this->response("Personal no encontrado", 404);
            }

        }else{
            $this->response('No se recive el parametro esperado', 200);
        }
    }
}