<?php

class Querys extends CI_Model {
    
    function __construct() {
        parent::__construct();

        $this->load->database();

    }
    
    public function consulta($campos, $tabla, $join = null, $where = null, $limite = null, $inicio = null,  $orden = null, $tipo_orden = null, $group_by = null) {
        
        $this->db->select($campos);
        $this->db->from($tabla);
        
        #WHERE
        if($where) {
            
            if(is_array($where))    {
                
                if(array_key_exists('and', $where)) {
                    
                    $this->db->where($where['and']);
                    
                }
                
                if(array_key_exists('like', $where))    {
                    
                    $this->db->like($where['like']);
                    
                }
                
                if(array_key_exists('or', $where))  {
                    
                    $this->db->or_where($where['or']);
                    
                }
                
                if(array_key_exists('in', $where))  {
                    
                    $this->db->where_in($where['in']['campo'], $where['in']['valores']);
                    
                }
                
                
                
            }else   {
                
                $this->db->where($where);
                
            }

        }
        
        #JOIN
        if (is_array($join)) {

            for ($i=0; $i < sizeof($join) ; $i++) {

                if (isset($join[$i]['tabla'])) {
                    
                    $tipo_join = (array_key_exists('tipo', $join[$i])) ? $join[$i]['tipo'] : 'left';
                    $this->db->join($join[$i]['tabla'], $join[$i]['join'], $tipo_join);

                }

            }

        }
        
        #RANGOS
        if ($limite != 0 || $limite != null) {
            
            $this->db->limit($limite, $inicio);
            
        }
        
        #ORDER
        if ($orden) {
            
            $tipo_ordenamiento      = ($tipo_orden) ? $tipo_orden : 'asc';
            $this->db->order_by($orden, "$tipo_ordenamiento");

        }
        
        if($group_by)   {
            
            $this->db->group_by($group_by);
            
        }

        $consulta = $this->db->get();
        $resultado = $consulta->result_array();

        return $resultado;
        
    }
    
    public function guardar($tabla, $data, $where = null){
        
        #$this->db->insert_batch(tabla, arreglo);
        
        if($where) {
            
            if(is_array($where))    {
                
                if(array_key_exists('and', $where)) {
                    
                    $this->db->where($where['and']);
                    
                }
                
                if(array_key_exists('like', $where))    {
                    
                    $this->db->like($where['like']);
                    
                }
                
                if(array_key_exists('or', $where))  {
                    
                    $this->db->or_where($where['or']);
                    
                }
                
                if(array_key_exists('in', $where))  {
                    
                    $this->db->where_in($where['in']['campo'], $where['in']['valores']);
                    
                }
                
                
                
            }else   {
                
                $this->db->where($where);
                
            }
                        
            if($this->db->update($tabla, $data))    {
                
                $this->session->set_flashdata('error', 0);
                $this->session->set_flashdata('mensaje', 'Registro editado correctamente.');
                
            }else   {
                
                $this->session->set_flashdata('error', 1);
                $this->session->set_flashdata('mensaje', 'Error: Error inesperado.');   
                
            }

            
        }else {
            
            $this->db->insert($tabla, $data);
            $id_insert = $this->db->insert_id();

            if ($id_insert) {

                $this->session->set_flashdata('error', 0);
                $this->session->set_flashdata('mensaje', 'Registro guardado correctamente.');

            }else{

                $this->session->set_flashdata('error', 1);
                $this->session->set_flashdata('mensaje', 'Error: Error inesperado.');

            }

            return $id_insert;
            
        }
        
    }
    
    
    public function eliminar($tabla, $where) {
        
        $conditions            = sizeof($where);
        
        if($conditions < 0) {
            
            for($i = 0; $i > $conditions; $i++) {
                
                foreach($where[$i] as $indice) {
                    
                    $id = $indice['valor'];
                    $this->db->where($indice['campo'], $indice['valor']);
                    
                }
                
            }
            
        }else {
            
            foreach($where as $indice) {
                
                $id = $indice['valor'];
                $this->db->where($indice['campo'], $indice['valor']);
                
            }
            
        }
        
        $this->db->delete($tabla);
        
        $this->session->set_flashdata('error', 0);
        $this->session->set_flashdata('mensaje', '¡Registro eliminado correctamente!');
        
    }
    
    public function menus() {
        
        $this->db->select('b.id, b.nombre');
        $this->db->from('siincom_permisosmenu a');
        $this->db->join('siincom_menus b', 'a.menu_id = b.id', 'left');
        $this->db->where('a.rol_id', $this->session->userdata('rol'));
        $this->db->order_by('b.orden', 'asc');
        $consulta       = $this->db->get();
        $items          = $consulta->result_array();

        return $items;
        
    }
    
    public function submenus()  {
        
        $this->db->select('b.id, b.menu_id, b.nombre, b.url');
        $this->db->from('siincom_permisossubmenu a');
        $this->db->join('siincom_submenus b', 'a.submenu_id = b.id', 'left');
        $this->db->where('a.rol_id', $this->session->userdata('rol'));
        $consulta       = $this->db->get();
        $items          = $consulta->result_array();

        return $items;
        
    }
    
    public function log($tabla, $action, $registro, $usuario = null) {
        
        $data['usuario_id']     = ($usuario) ? $usuario : 0;
        $data['registro_id']    = $registro;
        $data['accion']         = $action;
        $data['tabla']          = $tabla;
        $data['fecha_registro'] = date('Y-m-d H:i:s');

        $this->db->insert('siincom_log', $data);

    }
    
}