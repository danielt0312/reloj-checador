<?php
class DataLotes extends CI_Model{

    protected $draw;
    protected $start;
    protected $row_perpage;
    protected $column_index;
    protected $column_name;
    protected $column_sort_order;
    #protected $estatus_vitacora;
    protected $search_value;

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**
     * configuración inicial de datatable
     * @param $post_data  post de la librería datatables y los datos que se mandan por ajax para la búsqueda
     */
    public function dataConfig($post_data){
        ## POST
        $this->draw                = $post_data['draw'];
        $this->start               = $post_data['start'];
        $this->row_perpage         = $post_data['length']; // Rows display per page
        $this->column_index        = $post_data['order'][0]['column']; // Column index
        $this->column_name         = $post_data['columns'][$this->column_index]['data']; // Column name
        $this->column_sort_order   = $post_data['order'][0]['dir']; // asc or desc

        $this->search_value        = $post_data['search']['value']; // Search value
        #$this->estatus_vitacora    = $post_data['vitacora'];
    }

    /**
     * retorna la data para la libreria datatable
     * @return array
     */
    public function getData(){
        ## Data
        $this->db->select('rh_credencializacion_lote.*, rh_cat_areas.nombre as nombre_area, rh_estatus_lotes.nombre as estatus');
        $this->db->join('rh_cat_areas', 'rh_credencializacion_lote.area_id = rh_cat_areas.id', 'left');
        $this->db->join('rh_estatus_lotes', 'rh_credencializacion_lote.estatus_id = rh_estatus_lotes.id', 'left');

        if($this->search_value != ''){
            $this->db->like('CONCAT(rh_credencializacion_lote.id," ",rh_cat_areas.nombre," ",rh_estatus_lotes.nombre)' , $this->search_value);
        }

        #$this->db->where('rh_personal.alta_baja',1);
        #$this->db->where('rh_vitacora_personal.activo', 1);
        #$this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);


        $this->db->order_by($this->column_name, $this->column_sort_order);
        $this->db->group_by('rh_credencializacion_lote.id');
        $this->db->limit($this->row_perpage, $this->start);
        $records = $this->db->get('rh_credencializacion_lote')->result();

        $data = array();

        foreach($records as $record ){
            if($this->session->userdata('rol_id') == 4){
                #$opciones = "<div class='btn-group'><a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a></div>&nbsp;<a href='".base_url('registros/'.$this->uri->segment(2).'/editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                if($record->estatus == 'LOTE CREADO'){
                    $opciones = '<a href="'.base_url('credencializacion/ver-lote/'.$record->id).'" class="btn btn-primary"">Ver Lote</a>';
                }
            }else{
                #$opciones = "<div class='btn-group'><a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='".base_url('registros/'.$this->uri->segment(2).'/editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button></div>";
                $opciones = '<a href="'.base_url('credencializacion/ver-lote/'.$record->id).'" class="btn btn-primary"">Ver Lote</a>';
            }
            $data[] = array(
                "id"                => $record->id,
                "nombre_area"       => $record->nombre_area,
                "generados"         => $record->generados,
                "pendientes"        => $record->pendientes,
                "total"             => $record->total,
                "fecha_registro"    => $record->fecha_registro,
                "estatus"           => $record->estatus,
                "opciones"          => $opciones
            );
        }

        ## Response
        $response = array(
            "draw"                  => intval($this->draw),
            "iTotalRecords"         => $this->iTotalRecords(),
            "iTotalDisplayRecords"  => $this->iTotalDisplayRecords(),
            "aaData"                => $data
        );

        return $response;
    }

    public  function iTotalRecords(){
        ## Total registros
        $this->db->select('rh_credencializacion_lote.*, rh_cat_areas.nombre as nombre_area, rh_estatus_lotes.nombre as estatus');
        $this->db->join('rh_cat_areas', 'rh_credencializacion_lote.area_id = rh_cat_areas.id', 'left');
        $this->db->join('rh_estatus_lotes', 'rh_credencializacion_lote.estatus_id = rh_estatus_lotes.id', 'left');
        #$this->db->where('rh_personal.alta_baja',1);
        #$this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);
        #$this->db->where('rh_vitacora_personal.activo', 1);
        return $this->db->get('rh_credencializacion_lote')->num_rows();
    }

    public function iTotalDisplayRecords(){
        # Obtención de paginas
        $this->db->select('rh_credencializacion_lote.*, rh_cat_areas.nombre as nombre_area, rh_estatus_lotes.nombre as estatus');
        $this->db->join('rh_cat_areas', 'rh_credencializacion_lote.area_id = rh_cat_areas.id', 'left');
        $this->db->join('rh_estatus_lotes', 'rh_credencializacion_lote.estatus_id = rh_estatus_lotes.id', 'left');

        if($this->search_value != ''){
            $this->db->like('CONCAT(rh_credencializacion_lote.id," ",rh_cat_areas.nombre," ",rh_estatus_lotes.nombre)' , $this->search_value);
        }

        #if($this->session->userdata('rol_id') == 4){
        #    $this->db->where('rh_personal.area', $this->session->userdata('area_id'));
        #}

        #$this->db->where('rh_personal.alta_baja',1);
        #$this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);
        #$this->db->where('rh_vitacora_personal.activo', 1);
        return $this->db->get('rh_credencializacion_lote')->num_rows();
    }
}