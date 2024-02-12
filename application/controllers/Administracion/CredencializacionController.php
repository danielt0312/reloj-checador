<?php
use Spipu\Html2Pdf\Html2Pdf;
class CredencializacionController extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model([
            'Auth/Nav',
            'Registros/Personal',
            'Registros/VitacoraPersonal',
            'Registros/M_RegistrosPersonal',
            'Catalogos/Municipios',
            'Catalogos/CatAreas',
            'Catalogos/Departamentos',
            'Catalogos/Puestos',
            'Credencializacion/Lotes',
            'Credencializacion/RegistrosLote',
            'Catalogos/CentrosTrabajo',
            'DataTables/DataLotes',
        ]);
        $this->seguridad();
    }

    public function index(){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();

        $data['areas']              = $this->CatAreas->getAreas();
        $data['generados']           = $this->RegistrosLote->contadorRegistros(['estatus_id' => 2]);

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Credencializacion/index', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function dataTable(){
        $postData   = $this->input->post();
        $this->DataLotes->dataConfig($postData);
        $data       = $this->DataLotes->getData();
        echo json_encode($data);
    }

    public function contarPersonal(){
        $personal = $this->Personal->getPeronal(['area' => $this->input->post('area')]);
        echo count($personal);
    }

    public function store(){
        $lote = new stdClass();
        $lote->area_id = $this->input->post('area_id');
        $lote->generados = $this->input->post('generados');
        $lote->pendientes = $this->input->post('pendientes');
        $lote->total = $this->input->post('total');
        $lote->estatus_id = 1;
        $lote->usuario_id = $this->session->userdata('id');
        $lote->fecha_registro = date('Y-m-d H:i:s');
        $this->Lotes->save($lote);
        $id_insert = $this->session->flashdata('id_insert');
        if($id_insert > 0){
            mkdir('assets/credencializacion/'.$id_insert, 0777);
            chmod('assets/credencializacion/'.$id_insert, 0777);
            $consulta_personal = $this->Personal->getPeronal(['area' => $this->input->post('area_id')]);
            foreach($consulta_personal as $personal):
                $registro = new stdClass();
                $registro->lote_id = $id_insert;
                $registro->personal_id = $personal->id;
                $registro->estatus_id = 1;
                $registro->fecha_registro = date('Y-m-d H:i:s');
                $this->RegistrosLote->save($registro);
            endforeach;
        }

        redirect(base_url('credencializacion'));
    }

    public function verLote($id){
        $data_nav['menu']           = $this->Nav->menus();
        $data_nav['submenu']        = $this->Nav->submenus();

        $data['lote']              = $this->Lotes->get(['id' => $id])[0];
        $data['personal']           = $this->RegistrosLote->get(['rh_registros_lote.lote_id' => $data['lote']->id]);

        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);
        $this->load->view('Credencializacion/ver-lote', $data);
        $this->load->view('Plantilla/v_footer');
    }

    public function generarArchivos($id, $lote){

        $consulta_registro = $this->RegistrosLote->get(['rh_registros_lote.id' => $id])[0];
        //$consulta_registro = $this->RegistrosLote->get(['rh_registros_lote.estatus_id' => 1]);

        /*
        foreach($consulta_registro as $item){
            $nombre_pdf_a = $item->personal_id.'_A.pdf';
            $nombre_pdf_b = $item->personal_id.'_B.pdf';
            $nombre_jpg_a = $item->personal_id.'_A';
            $nombre_jpg_b = $item->personal_id.'_B';
            $this->pdfA($item->personal_id, $nombre_pdf_a, $lote);
            $this->pdfB($item->personal_id, $nombre_pdf_b, $lote);
            $this->conviertePDFaJPG($nombre_pdf_a, $nombre_jpg_a.'.jpg', $lote);
            $this->conviertePDFaJPG($nombre_pdf_b, $nombre_jpg_b.'.jpg', $lote);

            $registro = new stdClass();
            $registro->pdf_a = $nombre_pdf_a;
            $registro->pdf_b = $nombre_pdf_b;
            $registro->img_a = $nombre_jpg_a.'.jpg';
            $registro->img_b = $nombre_jpg_b.'.jpg';
            $registro->estatus_id = 2;
            $registro->fecha_modificacion = date('Y-m-d H:i:s');
            $this->RegistrosLote->update($registro, $item->id);
        }
        */
        $nombre_pdf_a = $consulta_registro->personal_id.'_A.pdf';
        $nombre_pdf_b = $consulta_registro->personal_id.'_B.pdf';
        $nombre_jpg_a = $consulta_registro->personal_id.'_A';
        $nombre_jpg_b = $consulta_registro->personal_id.'_B';
        $this->pdfA($consulta_registro->personal_id, $nombre_pdf_a, $lote);
        $this->pdfB($consulta_registro->personal_id, $nombre_pdf_b, $lote);
        $this->conviertePDFaJPG($nombre_pdf_a, $nombre_jpg_a.'.jpg', $lote);
        $this->conviertePDFaJPG($nombre_pdf_b, $nombre_jpg_b.'.jpg', $lote);

        $registro = new stdClass();
        $registro->pdf_a = $nombre_pdf_a;
        $registro->pdf_b = $nombre_pdf_b;
        $registro->img_a = $nombre_jpg_a.'.jpg';
        $registro->img_b = $nombre_jpg_b.'.jpg';
        $registro->estatus_id = 2;
        $registro->fecha_modificacion = date('Y-m-d H:i:s');
        $this->RegistrosLote->update($registro, $id);

        redirect(base_url('credencializacion/ver-lote/'.$lote));
    }

    public function descargasArchivos($id, $lote, $personal_id){

        $personal = $this->RegistrosLote->get(['rh_registros_lote.id' => $id])[0];
        $zip = new ZipArchive();
        $archivo = md5(date('Y-m-d H:i:s').$id).'.zip';
        if($zip->open($archivo, ZipArchive::CREATE) == true){
            $zip->addFile('./assets/credencializacion/'.$lote.'/'.$personal->img_a, $personal->img_a);
            $zip->addFile('./assets/credencializacion/'.$lote.'/'.$personal->img_b, $personal->img_b);
            $zip->addFile('./assets/credencializacion/'.$lote.'/'.$personal->pdf_a, $personal->pdf_a);
            $zip->addFile('./assets/credencializacion/'.$lote.'/'.$personal->pdf_b, $personal->pdf_b);
            $zip->close();

            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=archivos-credencial-".$personal_id.".zip");
            header("Cache-Control: no-cache, must-revalidate");
            header('Content-Length: ' . filesize($archivo));
            header("Expires: 0");
            readfile($archivo);
            unlink($archivo);
        }
    }

    public function descargasLote($id){
        $registros = $this->RegistrosLote->get(['rh_registros_lote.lote_id' => $id, 'rh_registros_lote.estatus_id' => 2]);
        $zip = new ZipArchive();
        $archivo = md5(date('Y-m-d H:i:s').$id).'.zip';
        if($zip->open($archivo, ZipArchive::CREATE) == true){
            foreach($registros as $registro){
                ($registro->img_a != "") ? $zip->addFile('./assets/credencializacion/'.$id.'/'.$registro->img_a, $registro->img_a) : '';
                ($registro->img_b != "") ?$zip->addFile('./assets/credencializacion/'.$id.'/'.$registro->img_b, $registro->img_b) : '';
                ($registro->pdf_a != "") ?$zip->addFile('./assets/credencializacion/'.$id.'/'.$registro->pdf_a, $registro->pdf_a) : '';
                ($registro->pdf_b != "") ?$zip->addFile('./assets/credencializacion/'.$id.'/'.$registro->pdf_b, $registro->pdf_b) : '';
            }
            $zip->close();

            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=archivos-lote-".$id.".zip");
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            readfile($archivo);
            unlink($archivo);
        }
    }

    public function pdfA($id, $nombre_archivo, $lote){
        $data['personal'] = $this->Personal->getPeronal(['id' => $id]);
        $idpersonal = $data['personal'][0]->id;

        if (count($data['personal']) > 0) {
            $data['personal']           = $data['personal'][0];
            $data['estatus']            = (count($this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $id])) > 0) ? $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $id])[0] : 'NULL';
            $data['departamento']       = ($data['personal']->departamento > 0) ? $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0] : null;
            $data['area']               = ($data['personal']->area > 0) ? $this->CatAreas->getAreas(['id' => $data['personal']->area])[0] : null;
            $data['municipio']          = (((integer) $data['personal']->municipio_id) > 0 && $data['personal']->estado_id > 0) ? $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0] : null;
            $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);

            ob_start();
            $this->load->view('Registros/Personal/gafetePersonal', $data);
            $html = ob_get_clean();
            $html2pdf = new HTML2PDF('P', array(70,115), 'en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->writeHTML($html);
            $html2pdf->output($_SERVER['DOCUMENT_ROOT'].'/rh/assets/credencializacion/'.$lote.'/'.$nombre_archivo, 'f');
            //chmod('assets/credencializacion/'.$lote.'/'.$nombre_archivo, 0777);
        }
    }

    public function pdfB($id, $nombre_archivo, $lote){
        $data['personal'] = $this->Personal->getPeronal(['id' => $id]);

        if (count($data['personal']) > 0) {
            $data['personal']           = $data['personal'][0];
            $data['estatus']            = (count($this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $id])) > 0) ? $this->VitacoraPersonal->getVitacoraPersonal(['personal_id' => $id])[0] : 'NULL';
            $data['departamento']       = ($data['personal']->departamento > 0) ? $this->Departamentos->getDepartamento(['id' => $data['personal']->departamento])[0] : null;
            $data['area']               = ($data['personal']->area > 0) ? $this->CatAreas->getAreas(['id' => $data['personal']->area])[0] : null;
            $data['municipio']          = (((integer) $data['personal']->municipio_id) > 0 && $data['personal']->estado_id > 0) ? $this->Municipios->getMunicipios(['estado_id' => $data['personal']->estado_id, 'clave' => (integer) $data['personal']->municipio_id])[0] : null;
            $data['puesto']             = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $data['personal']->puesto_id]);

            ob_start();
            $this->load->view('Registros/Personal/gafetePersonalTrasera', $data);
            $html = ob_get_clean();
            $html2pdf = new HTML2PDF('P', array(70,115), 'en', true, 'UTF-8', array(0, 0, 0, 0));
            $html2pdf->writeHTML($html);
            $html2pdf->output($_SERVER['DOCUMENT_ROOT'].'/rh/assets/credencializacion/'.$lote.'/'.$nombre_archivo, 'f');
            //chmod('assets/credencializacion/'.$lote.'/'.$nombre_archivo, 0777);
        }
    }

    public function conviertePDFaJPG($origen, $destino, $lote){
        $im = new Imagick();
        $im->setResolution( 300, 300 );

        $im->readImage($_SERVER['DOCUMENT_ROOT'].'/rh/assets/credencializacion/'.$lote.'/'.$origen);

        $im->writeImage($_SERVER['DOCUMENT_ROOT'].'/rh/assets/credencializacion/'.$lote.'/'.$destino);
        //chmod($_SERVER['DOCUMENT_ROOT'].'/rh/assets/credencializacion/'.$lote.'/'.$destino, 0766);
    }

    public function buscarEmpleado(){
        $curp = $this->input->post('curp');

        $consulta = $this->RegistrosLote->get(['rh_personal.curp' => $curp]);

        if(isset($consulta[0])){
            $departamento   = $this->Departamentos->getDepartamento(['id' => $consulta[0]->departamento])[0];
            $area           = $this->CatAreas->getAreas(['id' => $consulta[0]->area])[0];
            $puesto         = $this->Puestos->getPuestos(['rh_cat_puestos.id' => $consulta[0]->puesto_id])[0];
            $consulta['personal'] = $consulta[0];
            $consulta['departamento'] = $departamento->nombre;
            $consulta['area'] = $area->nombre;
            $consulta['puesto'] = $puesto->nombre;
            $consulta['error'] = 0;
        }else{
            $consulta['error'] = 1;
        }

        $this->load->view('Credencializacion/empleado', $consulta);
    }

    public function seguridad()
    {
        if ($this->session->userdata('id')) {
            return true;
        } else {
            redirect(base_url());
        }
    }
}