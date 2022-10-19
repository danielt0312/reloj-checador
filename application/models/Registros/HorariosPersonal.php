<?php
class HorariosPersonal extends  CI_Model{

    public $dias = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes'];
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('Util');
    }

    public function getHorariosPersonal($where = null){
        $this->db->select('*');
        $this->db->from('rh_horarios');
        if($where){
            foreach ($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        $data =  $this->db->get()->result();
        $asistencias_personal = [];
        foreach($this->dias as $indice => $valor){
            $this->dias[$indice] = [
                'data' => [
                    'id' => null,
                    'dia' => $valor,
                    'cve_dia' => $indice,
                    'horario' => '00:00'
                ]
            ];
        }
        foreach($data as $dato){
                $this->dias[$dato->cve_dia] = [
                    'data' => [
                        'id' => $dato->id,
                        'personal_id' => $dato->personal_id,
                        'dia' => $dato->dia,
                        'cve_dia' => $dato->cve_dia,
                        'horario' => $dato->horario
                    ]
                ];
        }
        return $this->dias;
    }

    public function setHorariosPersonal($data, $personal_id = null){
        if($personal_id){
            $this->limpiahorarios($personal_id);
        }
        foreach($data as $key => $value){
            foreach($value as $indice => $valor){
                $this->db->set($indice, $valor);
            }
                $this->db->set('fecha_registro', date('Y-m-d H:i:s'));
                $this->db->insert('rh_horarios');
                $result = $this->util->validaSeteo($this->db->insert_id());
            #}
        }
        #return $result;
    }

    public function limpiaHorarios($personal_id){
        $this->db->select('*');
        $this->db->from('rh_horarios');
        $this->db->where('personal_id', $personal_id);
        if($this->db->get()->num_rows() > 0){
            $this->db->delete('rh_horarios', ['personal_id' => $personal_id]);
        }
        return true;

     }

     public function getHorario($where = null){
        $this->db->select('*');
        $this->db->from('rh_horarios');
        if($where){
            foreach($where as $indice => $valor){
                $this->db->where($indice, $valor);
            }
        }
        return $this->db->get()->result();
     }
    }