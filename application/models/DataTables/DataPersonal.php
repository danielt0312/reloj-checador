<?php
class DataPersonal extends CI_Model{

    protected $draw;
    protected $start;
    protected $row_perpage;
    protected $column_index;
    protected $column_name;
    protected $column_sort_order;
    protected $estatus_vitacora;
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
        $this->estatus_vitacora    = $post_data['vitacora'];


        
          
        
    }

    /**
     * retorna la data para la libreria datatable
     * @return array
     */
    public function getData(){
        ## Data
        $this->db->select('rh_personal.*,rh_usuarios.nombre as nom_us, rh_usuarios.apellido_paterno as app_us, rh_usuarios.apellido_materno as apm_us');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');        
        $this->db->join('rh_usuarios', 'rh_personal.id_usuario_reg = rh_usuarios.id', 'left');

        if($this->search_value != ''){
            $this->db->like('CONCAT(rh_personal.id," ",rh_personal.curp," ",rh_personal.rfc," ",rh_personal.nombre," ",rh_personal.apellido_paterno," ",rh_personal.apellido_materno)' , $this->search_value);
        }

        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.activo', 1);
        $this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);

        if($this->session->userdata('rol_id') == 4){
            $this->db->where('rh_personal.area', $this->session->userdata('area_id'));
        }

        $this->db->order_by($this->column_name, $this->column_sort_order);
        $this->db->group_by('rh_personal.id');
        $this->db->limit($this->row_perpage, $this->start);
        $records = $this->db->get('rh_personal')->result();

        $data = array();

        foreach($records as $record ){
            if($record->id_usuario_reg==0){
                $validacion_reg="<a href='' class='btn btn-amarillo tip tip-red' title='POR VALIDAR'><i class='fa fa-circle' aria-hidden='true'></i></a>";
            }
            else{                
                $validacion_reg="<a href='' class='btn btn-verde' title='VALIDADO POR: ".$record->nom_us." ".$record->app_us." ".$record->apm_us."'><i class='fa fa-check' aria-hidden='true'></i></a>";
            }
            if($this->session->userdata('rol_id') == 4){ 
            	$this->db->select('opedicion');
            	$this->db->where('id', 11);
            	$this->db->where('alta_baja', 1);
            	$opedi = $this->db->get('rh_submenu')->result();  

            	foreach($opedi as $recordopedit){

            		if($recordopedit->opedicion==0){
            			 $opciones = "<div class='btn-group'>&nbsp;".$validacion_reg."&nbsp;&nbsp;<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-curp='".$record->curp."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;</div>";
            		}
            		else{
            			 $opciones = "<div class='btn-group'>&nbsp;".$validacion_reg."&nbsp;&nbsp;<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-curp='".$record->curp."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='".base_url('registros/'.$this->uri->segment(2).'/editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a></div>";

            		}
            	}               
            }else{
            	//$this->db->select('opedicion');
            	//$this->db->where('id', 11);
            	//$this->db->where('alta_baja', 1);
            	//$opedi = $this->db->get('rh_submenu')->result();

            	//foreach($opedi as $recordopedit ){

            	//	if($recordopedit->opedicion==0){

            		// 	$opciones = "<div class='btn-group'>&nbsp;".$validacion_reg."&nbsp;&nbsp;<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-curp='".$record->curp."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button></div>";

            		// }
            		// else{

                        if($this->session->userdata('rol_id') == 6){
                            $opciones = "<div class='btn-group'>&nbsp;".$validacion_reg."&nbsp;&nbsp;<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-curp='".$record->curp."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button></div>";
                        }
                        else{
                            $opciones = "<div class='btn-group'>&nbsp;".$validacion_reg."&nbsp;&nbsp;<a href='' data-url='".base_url('Registros/Registro/modalDetalle/'.$record->id)."' class='btn btn-azulclaro verDetalleModal' data-personal='".md5($record->id)."' data-curp='".$record->curp."' data-toggle='modal' data-target='#modalDetalleUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='".base_url('registros/'.$this->uri->segment(2).'/editar/'.$record->id)."' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button></div>";
                        }
            			
            	//	}
            	//}



                
            }
            $data[] = array(
                "id"                =>$record->id,
                "curp"              =>$record->curp,
                "rfc"               =>$record->rfc,
                "nombre"            =>$record->nombre,
                "apellido_paterno"  =>$record->apellido_paterno,
                "apellido_materno"  =>$record->apellido_materno,
                "telefono"          =>$record->telefono,
                #"opciones"=>"<a href='Registro/Ver/$record->id' class='btn btn-azulclaro'><i class='fa fa-eye' aria-hidden='true'></i></a>&nbsp;<a href='Registro/Editar/$record->id' class='btn btn-azul'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;<button type='button' data-id='$record->id' data-curp='$record->curp' data-rfc='$record->rfc' data-nombre='$record->nombre' data-apellido_paterno='$record->apellido_paterno' data-apellido_materno='$record->apellido_materno' data-telefono='$record->telefono' class='btn btn-rojo datoselim' data-toggle='modal' data-target='#user-id'><i class='fa fa-trash' aria-hidden='true'></i></button>"
                "opciones"          =>$opciones
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
        $this->db->select('rh_personal.*');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');
        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);
        $this->db->where('rh_vitacora_personal.activo', 1);
        return $this->db->get('rh_personal')->num_rows();
    }

    public function iTotalDisplayRecords(){
        # Obtención de paginas
        $this->db->select('rh_personal.*');
        $this->db->join('rh_vitacora_personal', 'rh_personal.id = rh_vitacora_personal.personal_id');

        if($this->search_value != ''){
            $this->db->like('CONCAT(rh_personal.id," ",rh_personal.curp," ",rh_personal.rfc," ",rh_personal.nombre," ",rh_personal.apellido_paterno," ",rh_personal.apellido_materno)' , $this->search_value);
        }

        if($this->session->userdata('rol_id') == 4){
            $this->db->where('rh_personal.area', $this->session->userdata('area_id'));
        }

        $this->db->where('rh_personal.alta_baja',1);
        $this->db->where('rh_vitacora_personal.estatus_id', $this->estatus_vitacora);
        $this->db->where('rh_vitacora_personal.activo', 1);
        return $this->db->get('rh_personal')->num_rows();
    }
}
