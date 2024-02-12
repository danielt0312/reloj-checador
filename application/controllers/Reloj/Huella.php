<?php
class Huella extends CI_Controller{
    function __construct(){
        parent::__construct();
        date_default_timezone_set("America/Mexico_City");     
        $this->load->model('Auth/Nav');
        $this->load->model([
            'Reloj/PanVista',
            'Registros/Personal',
            'Registros/HorariosPersonal'
        ]);
    }
    
    public function opciones(){
        $data['opciones'] = $this->Querys->consulta('*', 'rh_cat_huella');
        $data['personal'] = $this->Querys->consulta('nombre, apellido_paterno, apellido_materno', 'rh_personal', '', 'alta_baja=1');
        $this->render('Reloj/Vista/huella', $data);
    }

    public function getDatos(){
        $data = array();
        foreach($_POST as $indice => $valor){
            $data[$indice] = $valor;
        }

        if(empty($data['opcion'])){
            print_r($data);
            echo 'NO SELECCIONO ALGUNA DE LAS OPCIONES';
            # MOSTRAR ALERTA !!! 
        } else{
            $consulta = $this->Querys->consulta('id, nombre, apellido_paterno, apellido_materno', 'rh_personal');

            foreach($consulta as $valor){
                $nombre = $valor['nombre'].' '.$valor['apellido_paterno'].' '.$valor['apellido_materno'];
                if($data['nombre'] == $nombre){
                    $data['id'] = $valor['id'];
                    break;
                }
            }

            if(empty($data['id'])){
                echo '<br> no se encontró este personal, asegurese de que escribio bien el nombre: '.$data['nombre'];
                # MOSTRAR ALERTA !!!
            } else{
                if($data['opcion'] == 1){ #REGISTRA
                    $id_insert = $this->Querys->guardar('rh_personal', array('huella' => $data['huella']));
                    if(empty($id_insert)):
                        echo 'Hubo un error, contactar con soporte';
                    endif;
                } elseif($data['opcion'] == 2){ #ACTUALIZA
                    $this->Querys->guardar('rh_personal', array('huella' => $data['huella']), 'id='.$data['id']);
                } else{
                    echo 'Hubo un error, contactar con soporte';
                }
            }
            
        }
        redirect(base_url('Reloj/Vista/index'));
    }

    public function render($view, $data = null){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view($view, $data);
        $this->load->view('Plantilla/v_footer');
    }
}