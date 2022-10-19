<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_querys extends CI_Model {

  function __construct() {
    parent::__construct();

    $this->load->database();

  }

  #Estructura de metodo consulta()
  # $this->M_query->consulta(SELECT[campos a seleccionar], FROM[primera tabla a seleccionar], JOIN[uniones de tablas van dentro de un array ej: array(array('tabla' => 'tabla a', 'join' => 'a.campo_id = b.id'), array('tabla' => 'tabla c', 'join' => 'a.campo_id = c.id'))], WHERE[Condicion(es)], START[inicio de rango de valores], LIMIT[final de rango de valores], ORDER[campo a ordenar], GROUP BY[campo a agrupar])

  public function consulta($select, $tabla, $join = null, $where = null, $start = null , $limit = null, $order = null, $group = null, $ordenamiento = null) {

    $this->db->select($select);

    $this->db->from($tabla);

    if ($where) { $this->db->where($where);}

    if (is_array($join)) {

      for ($i=0; $i < sizeof($join) ; $i++) {

        if (isset($join[$i]['tabla'])) {

          $this->db->join($join[$i]['tabla'], $join[$i]['join'], 'left');

        }

      }

    }

    if ($limit != 0 || $limit != null) {
      $this->db->limit($limit, $start);
    }

    if ($group) {

      $this->db->group_by("$group");

    }

    if ($order) {

      $this->db->order_by($order, "$ordenamiento");

    }

    $consulta = $this->db->get();
    $resultado = $consulta->result_array();

    return $resultado;

  }
  public function RevisarRegistros($tabla, $dato, $comparacion) {
    $var1=1;
    $var2=2;
    $this->db->select('*');
    $this->db->from($tabla);    
    $this->db->where($dato,$comparacion);
    $this->db->where('alta_baja','1');
    $consulta = $this->db->get();
    $cantidad_encontrados = $consulta->num_rows();

    if ($cantidad_encontrados!="") {
      return $var1;
      //$this->session->set_flashdata('mensaje', 'El registro ya existe');
    }
    else{
      return  $var2;
      //$this->session->set_flashdata('mensaje', '');
    }      
  }

  
  public function getData($select, $tabla, $join = null,$where = null, $limit, $start, $st = NULL, $like, $order = null, $group = null, $ordenamiento = null) {

    $this->db->select($select);
    $this->db->from($tabla);

    if ($where) { $this->db->where($where);}

    if (is_array($join)) {

      for ($i=0; $i < sizeof($join) ; $i++) {

        if (isset($join[$i]['tabla'])) {

          $this->db->join($join[$i]['tabla'], $join[$i]['join']);

        }

      }

    }

    if ($like) {

      $this->db->like($like,$st);

    }

    if ($limit != 0 || $limit != null) {

      $this->db->limit($limit, $start);

    }

    if ($order && ($order != 'id' || $order != 'a.id')) {

      $this->db->order_by($order, "$ordenamiento");

    } else {

      $this->db->order_by('id', "$ordenamiento");

    }

    if($group) {

      $this->db->group_by($group);

    }

    $consulta = $this->db->get();
     $resultado = $consulta->result_array();

    return $resultado;

  }
  public function getData2($select, $tabla, $join = null,$where = null, $limit, $start, $st = NULL, $like, $order = null) {

    $this->db->select($select);
    $this->db->from($tabla);

    if ($where) { $this->db->where($where);}

    if (is_array($join)) {

      for ($i=0; $i < sizeof($join) ; $i++) {

        if (isset($join[$i]['tabla'])) {

          $this->db->join($join[$i]['tabla'], $join[$i]['join'], $join[$i]['tipo']);

        }

      }

    }

    if ($like) {

      $this->db->like($like,$st);

    }

    if ($limit != 0 || $limit != null) {

      $this->db->limit($limit, $start);

    }

    if ($order && $order != 'id') {

      $this->db->order_by($order, "asc");

    } else {

      $this->db->order_by('id', 'desc');

    }

    $consulta = $this->db->get();
     $resultado = $consulta->result_array();

    return $resultado;

  }

  public function guardar($tabla, $data, $id = null) {

    if ($id) {

      $this->db->where("id", $id);
      $this->db->update($tabla, $data);

      $this->session->set_flashdata('mensaje', 'Registro editado correctamente');

    } else {

      $this->db->insert($tabla, $data);
      $id_insert = $this->db->insert_id();

      if ($id_insert) {

        $this->session->set_flashdata('mensaje', 'Registro guardado correctamente');

      }else{

        $this->session->set_flashdata('mensaje', 'Error al guardar registro');

      }

      return $id_insert;

    }

  }

  public function actualiza($tabla, $data, $where) {

    $this->db->where($where);
    $this->db->update($tabla, $data);

  }

  public function eliminar($campo, $tabla, $id) {
    $this->db->where($campo, $id);
    $this->db->delete($tabla);
  }
    
    public function setDelete($tabla, $where) {
        
        foreach($where as $arreglo)   {
            
            foreach($arreglo as $indice => $valor)  {
                
                $this->db->where($indice, $valor);
                
            }
            
        }
        
        $this->db->delete($tabla);
        
    }
    
  public function getpdf2($array){
    $op1=$array['rango1'];
    $op2=$array['rango2'];
    $opciones=$array['opciones'];
    $todos=$array['todos'];
    $dat_imp=$array['dat_imp'];
    $tablas = $array['tablas'];

    $this->db->select('*');
    $this->db->from($tablas[$dat_imp]['tabla']);
    if ($array['var'] == 1) {
      if ($opciones == 1) {
        if (empty($op1) && empty($op2)) {
          $this->db->where($tablas[$dat_imp]['nombre'], $op1);
        }elseif (empty($op2)) {
          $this->db->like($tablas[$dat_imp]['nombre'], $op1);
        }else{
          $this->db->like($tablas[$dat_imp]['nombre'], $op1,'after');
          $this->db->or_like($tablas[$dat_imp]['nombre'], $op2,'after');
        }
      }elseif ($opciones == 2) {
        $this->db->order_by($tablas[$dat_imp]['nombre'], 'ASC');
      }
    }else if($array['var'] == 2){
      if ($opciones == 1) {
        $this->db->where($tablas[$dat_imp]['id'].' >=', $op1);
        $this->db->where($tablas[$dat_imp]['id'].' <=', $op2);
      }elseif ($opciones == 2) {
        $this->db->order_by($tablas[$dat_imp]['id'], 'ASC');
      }
    }
    $q = $this->db->get();
        return $q->result();
        $q->free_result();
  }
  public function imprimir($registros, $tabla, $joins = null, $condicion=null) {
    $qry='SELECT '.$registros.' FROM '.$tabla.' '.$joins.' '.$condicion;
    $result=$this->db->query($qry);
    return $result->result_array();
  }
  public function guardarfecha($data, $tabla, $id = null) {

    if ($id) {
      $this->db->where('id', $id);
      $this->db->update($tabla, $data);

      $id_insert = $id;

    }else{

      if (array_key_exists("0", $data)) {
        for ($i=0; $i < sizeof($data) ; $i++) {

          $this->db->insert($tabla, $data[$i]);

        }

      }else{

        $valida_fecha = $this->valida_fecha($data['fecha']);
        if ($valida_fecha == true) {

          $this->session->set_flashdata('mensaje',"El año ya se encuentra registrado.");

        }else{

          $this->db->insert($tabla, $data);

        }

      }


      $id_insert = $this->db->insert_id();
      if ($id_insert) {


        $this->session->set_flashdata('mensaje', 'Registro agregado correctamente');    #Si recivimos el id que se creo creamos un mensaje para el usuario
      }

      return $id_insert;
    }


  }

  public function valida_fecha($fecha) {

    $this->db->select('fecha');
    $this->db->from('rvoe_catfechafiscal');
    $this->db->where('fecha', $fecha);

    $consulta = $this->db->get();
    if($consulta->num_rows() > 0) {

      $correo = true;

    }else{

      $correo = false;

    }

    return $correo;

  }
   public function guardar_ciclo($tabla, $data, $id = null,$registro2) {


    if ($id) {

      if ($registro2=="3") {
        $registro_estatus= array('estatus_id' => '4');

        $this->db->where('estatus_id','3');
        $this->db->update($tabla,$registro_estatus);

        $this->db->where('id', $id);
        $this->db->update($tabla, $data);
      }
      else{
        $this->db->where('id', $id);
        $this->db->update($tabla, $data);
        //$this->session->set_flashdata('mensaje', '');
      }
    } else {
      $registro_estatus= array('estatus_id' => '4');

      $this->db->where('estatus_id','3');
      $this->db->update($tabla,$registro_estatus);

      $this->db->insert($tabla, $data);
      $id_insert = $this->db->insert_id();

      if ($id_insert) {

        $this->session->set_flashdata('mensaje', 'Registro guardado correctamente');

      }else{

        $this->session->set_flashdata('mensaje', 'Error al Guardar Registro');

      }

      return $id_insert;

    }

  }
  public function validafecha($campo1,$campo2,$tabla,$registro1,$registro2){
    $var1=1;
    $var2=2;
    $this->db->select('*');
    $this->db->from($tabla);    
    $this->db->where($campo1,$registro1);
    $this->db->where($campo2,$registro2);
    $this->db->where('alta_baja','1');
    $consulta = $this->db->get();
    $cantidad_encontrados = $consulta->num_rows();

    if ($cantidad_encontrados!="") {
      return $var1;
      //$this->session->set_flashdata('mensaje', 'El registro ya existe');
    }
    else{
      return  $var2;
      //$this->session->set_flashdata('mensaje', '');
    }
  }
  
  public function eliminar_datas_cat($campo, $tabla, $id) {
    $data=array('alta_baja' => 2,'fecha_modificacion'=>date('Y-m-d H:i:s'));
    $this->db->where($campo, $id);
    $this->db->update($tabla,$data);
  }

  public function getLocalidades($id){
    $qry = "SELECT id, UPPER(nombre) as nombre FROM programas_cat_localidades WHERE municipio_id = (SELECT municipio_id FROM programas_cat_localidades WHERE id = $id) ORDER BY nombre ASC";
    $query = $this->db->query($qry);

    return $query->result_array();
  }
  public function ObtenerReporte(){

    $this->db->select('
      a.id,
      a.curp,
      a.rfc,
      a.nombre,
      a.apellido_paterno,
      a.apellido_materno,
      a.sexo,
      b.nombre as estado_civil,
      c.nombre as tipo_sangre,
      a.hijos,
      a.telefono,
      j.fecha_baja,
      a.correo,
      a.calle,
      a.numero,
      a.colonia,
      a.cp,
      m.nombre as nombre_estado,
      n.nombre as nombre_municipio,
      d.nombre as grado_estudios,
      a.carrera,
      a.institucion,
      a.fecha_egreso,
      a.folio_titulo,
      e.nombre as grado_profesion,      
      g.nombre as departamento,
      h.nombre as area,
      i.nombre as turno,
      a.fecha_registro,
      a.fecha_modificacion,
      a.fecha_ingreso_sistema,
      a.fecha_ingreso_ct,
      a.base_estatal,
      a.base_federal,
      a.base_contrato,
      a.base_otro,
      a.id as personal_id,
      a.demanda,
      a.obs_demanda,
      a.pension,
      a.beneficiario,
      a.cct_laboratorista,
      o.nombre as nombre_puesto,
      k.nombre as estatus,
      l.nombre as motivo_estatus,
      (SELECT 
        GROUP_CONCAT(
            CONCAT(
                "*",claves.clave_presupuestal,"#Categoria:",rh_cat_categorias.nombre,"#ClaveCT:",claves.cct,"#NombreCT:",mec_centros_trabajo.nombrect
            ) SEPARATOR "\n"
        ) as claves_presupuestales 
        FROM rh_claves_personal as claves
        LEFT JOIN mec_centros_trabajo ON claves.cct = mec_centros_trabajo.clavecct
        INNER JOIN rh_cat_categorias ON claves.clave_presupuestal like CONCAT("%", rh_cat_categorias.categoria, "%")
        WHERE claves.personal_id = a.id
      ) as claves_presupuestales, 
      (SELECT
        GROUP_CONCAT( 
            CONCAT(
                rh_horarios.dia,"#-",rh_horarios.horario
            ) SEPARATOR "|"
        ) as horario
        FROM rh_horarios
        WHERE rh_horarios.personal_id = a.id
       
      ) as horario
    ');
    $this->db->from('rh_personal AS a');
    $this->db->join('rh_cat_estadocivil AS b', 'a.estado_civil=b.id','left');
    $this->db->join('rh_cat_tiposangre AS c', 'a.tipo_sangre=c.id','left');
    #$this->db->join('rh_cat_plaza AS f', 'a.plaza=f.id','left');
    $this->db->join('rh_cat_gradosestudio AS d', 'a.grado_estudios=d.id','left');
    $this->db->join('rh_cat_gradoprofesional AS e', 'a.grado_profesion=e.id','left');
    $this->db->join('rh_cat_departamento AS g', 'a.departamento=g.id','left');
    $this->db->join('rh_cat_areas AS h', 'a.area=h.id','left');
    $this->db->join('rh_cat_turno AS i', 'a.turno=i.id','left');
    $this->db->join('rh_vitacora_personal j', 'a.id = j.personal_id', 'left');
    $this->db->join('rh_cat_estatus k', 'j.estatus_id = k.id', 'left');
    $this->db->join('rh_motivos_vaja l', 'j.motivo_baja_id = l.id', 'left');
    $this->db->join('rh_cat_estados m', 'a.estado_id = m.id', 'left');
    $this->db->join('rh_cat_municipios n', 'a.municipio_id = n.clave', 'left');
    $this->db->join('rh_cat_puestos o', 'a.puesto_id = o.id', 'left');
    $this->db->where('j.activo', 1);
    $this->db->where('a.alta_baja', 1);
    $this->db->where('n.estado_id', 28);

    if($this->session->userdata('rol_id') == 4){
        $this->db->where('a.area', $this->session->userdata('area_id'));
    }

    $this->db->order_by('a.id');
    return $this->db->get()->result_array();
  }
  public function pass(){
    $this->db->select('*');
    $this->db->from('rh_usuarios');   
    return $this->db->get()->result_array();
  }
  public function total_registros($tabla,$campo,$comparacion){    
          $this->db->select('COUNT(*) AS Cantidad');
          $this->db->from($tabla);
          $this->db->where($campo, $comparacion);
          $queryres=$this->db->get()->row()->Cantidad;
          return $queryres;
  }
  public function totales_esc($tabla,$campo){ 
          $query="SELECT COUNT(*) AS Cantidad FROM ".$tabla." ".$campo;
          $result=$this->db->query($query);
           return $result->result();
  }
}
 ?>
