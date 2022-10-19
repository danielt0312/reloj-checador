<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_webService extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function checkRegistros($fn_case, $buscar) {
        $this->db->select('*');
        switch ($fn_case) {
            // curp
            case 1:
                $this->db->from('rh_personal');
                $this->db->where('curp', $buscar);
                break;
            // correo de usuarios
            case 2: 
                $this->db->from('rh_personal');
                $this->db->where('correo', $buscar);
                break;
        }
        $this->db->where('alta_baja', 1);
        $rows = $this->db->get()->num_rows();
        return ($rows > 0) ? false : true;
    }

    public function guardarRegistro($tabla, $data)
    {
        if ($this->db->insert($tabla, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }
    public function getDataWebService($service, $parameters, $action)
    {
        // $action = 1 consulta el webservice de renapo
        // $action = 2 consulta el webservice del siie
        try {
            $soap = new \SoapClient($service, $parameters);
            $result = $soap->Consulta_por_CURP($parameters);
            $xml = $result->Consulta_por_CURPResult->any;
           /*  $client = new SoapClient($service, $parameters);         
                $result = $client->Consultar($parameters);
                $xml    = $result->ConsultarResult->any; */
                if (strlen($xml) == 1871) {
                    return $return = array('Curp' => '', 'Apellido1' => '', 'Apellido2' => '', 'NombreS' => '', 'Sexo' => '');
                } else {
                    $xml  = str_replace(array('diffgr:', 'msdata:'), '', $xml);
                    $xml  = '<package>' . $xml . '</package>';
                    $data = simplexml_load_string($xml);
                    return array(
                        'Curp'      => $data->diffgram->DocumentElement->Datos->Curp,
                        'Apellido1' => $data->diffgram->DocumentElement->Datos->Apellido1,
                        'Apellido2' => $data->diffgram->DocumentElement->Datos->Apellido2,
                        'NombreS'   => $data->diffgram->DocumentElement->Datos->NombreS,
                        'Sexo'      => $data->diffgram->DocumentElement->Datos->Sexo,
                    );
                }
           
        } catch (SoapFault $fault) {
            return false;
        }
    }

    public function guardar($tabla, $data, $id = null, $campo)
    {
        if ($id != null) {

            // $this->db->set(array('grado' => '4'));
            // $this->db->where('id', '1');
            // $this->db->update('programas_reg_setsnte');

            $this->db->where($campo, $id);
            $this->db->update($tabla, $data);

            // return $this->db->last_query();

            $this->session->set_flashdata('mensaje', 'Registro guardado correctamente');

        } else {

            $this->db->insert($tabla, $data);
            $id_insert = $this->db->insert_id();

            if ($id_insert) {

                $this->session->set_flashdata('mensaje', 'Registro guardado correctamente');

            } else {

                $this->session->set_flashdata('mensaje', 'Error al guardar registro');

            }

            return $id_insert;

        }

    }

    public function getMunicipio($municipio)
    {
        $qry   = "SELECT id FROM programas_cat_municipios WHERE nombre_municipio = '$municipio' AND estado_id = 28";
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function getArea($area)
    {
        $qry   = "SELECT id FROM programas_cat_areas WHERE nombre_area = '$area' AND departamento_id = 28";
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function getNivelEducativo($nivel)
    {
        $qry    = "SELECT id FROM programas_cat_nivel_educativo WHERE nombre = '$nivel' AND alta_baja = 1";
        $result = $this->db->query($qry);
        if ($result->num_rows()) {
            $result->result();
            return $result->id;
        } else {
            return 0;
        }

    }
}
