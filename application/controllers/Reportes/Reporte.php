<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reporte extends CI_Controller {
	function __construct() {        
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
        $this->load->library('excel');
        $this->seguridad();      
    }
    public function index(){        
        $data_nav['menu']           = $this->menu();
        $data_nav['submenu']        = $this->submenu();   
        $this->load->view('Plantilla/v_head');
        $this->load->view('Plantilla/v_nav',$data_nav);      
		$this->load->view('Reportes/Generar_reporte');
		$this->load->view('Plantilla/v_footer');
     
    }
    public function Personal_(){
        echo "registros";
    }
    public function Personal(){
        $ReporteParticipantes = $this->M_querys->ObtenerReporte();
        $excel_formato=PHPExcel_IOFactory::load('./assets/reporteexcel/documento.xlsx');
        $excel_formato->setActiveSheetIndex(0);
        $excel_formato->getActiveSheet()->getPageMargins()->setHeader(0);
        $excel_formato->getActiveSheet()->getPageMargins()->setTop(1.2);

        $excel_formato->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P de &N');
        $excel_formato->setActiveSheetIndex(0);

                    $estiloEncabezadosColumnas = array(
                        'font' => array(
                                'name'   => 'Verdana',
                                'bold'   => true,
                                'italic' => false,
                                'strike' => false,
                                'size'   => 10,
                                'color' => array(
                                'rgb'   => 'FFFFFF'
                                )
                         ),

                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN                    
                            )
                        ),

                        'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => 'ab0033')
                        )
                    );
        
                    $estiloCuerpoColumnas = array(
                        'font' => array(
                            'name'      => 'Arial',
                            'bold'      => false,                          
                            'color'     => array(
                                'rgb'   => '000000'
                            )
                        ),
                        'borders' => array(
                            'outline' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN                    
                            ),
                        )
                    );   
        // Aplica el diseño a todas las columnas
        $excel_formato->getActiveSheet()->getStyle('A6:AQ6')->applyFromArray($estiloEncabezadosColumnas);
        
        // Auto Size
        for($i = 'A'; $i !== 'AR'; $i++) {
            $excel_formato->getActiveSheet()->getColumnDimension( $i )->setAutoSize(true);  
        }
                                                                                
        //nombre de la hoja
        $excel_formato->getActiveSheet()->setTitle('Registros');

        //encabezados de la tabla
        $filaEncabezados = 6;
        
        //foreach ($data_encabezados as $key => $value) {
        $excel_formato->getActiveSheet()
                ->setCellValue('A'.$filaEncabezados, 'Id')
                ->setCellValue('B'.$filaEncabezados, 'NOMBRE')
                ->setCellValue('C'.$filaEncabezados, 'APELLIDO PATERNO')
                ->setCellValue('D'.$filaEncabezados, 'APELLIDO MATERNO')
                ->setCellValue('E'.$filaEncabezados, 'CURP')
                ->setCellValue('F'.$filaEncabezados, 'RFC')
                ->setCellValue('G'.$filaEncabezados, 'SEXO')
                ->setCellValue('H'.$filaEncabezados, 'ESTADO CIVIL')
                ->setCellValue('I'.$filaEncabezados, 'HIJOS')
                ->setCellValue('J'.$filaEncabezados, 'CORREO')
                ->setCellValue('K'.$filaEncabezados, 'TIPO SANGRE')
                ->setCellValue('L'.$filaEncabezados, 'TELÉFONO')                
                ->setCellValue('M'.$filaEncabezados, 'ESTATUS_PERSONAL')
                ->setCellValue('N'.$filaEncabezados, 'MOTIVO_BAJA')
                ->setCellValue('O'.$filaEncabezados, 'FECHA_BAJA')
                ->setCellValue('P'.$filaEncabezados, 'FECHA_INGRESO_SISTEMA')
                ->setCellValue('Q'.$filaEncabezados, 'FECHA_INGRESO_CT')
                ->setCellValue('R'.$filaEncabezados, 'DEMANDA')
                ->setCellValue('S'.$filaEncabezados, 'OBS_DEMANDA')
                ->setCellValue('T'.$filaEncabezados, 'PENSION')
                ->setCellValue('U'.$filaEncabezados, 'BENEFICIARIO')
                ->setCellValue('V'.$filaEncabezados, 'CLAVES_PRESUPUESTALES')
                ->setCellValue('W'.$filaEncabezados, 'BASE ESTATAL')
                ->setCellValue('X'.$filaEncabezados, 'BASE FEDERAL')
                ->setCellValue('Y'.$filaEncabezados, 'CONTRATO')
                ->setCellValue('Z'.$filaEncabezados, 'OTRA FORMA DE PAGO')
                ->setCellValue('AA'.$filaEncabezados, 'CALLE')
                ->setCellValue('AB'.$filaEncabezados, 'NÚMERO')
                ->setCellValue('AC'.$filaEncabezados, 'COLONIA')
                ->setCellValue('AD'.$filaEncabezados, 'CÓDIGO POSTAL')
                ->setCellValue('AE'.$filaEncabezados, 'ESTADO')
                ->setCellValue('AF'.$filaEncabezados, 'MUNICIPIO')
                ->setCellValue('AG'.$filaEncabezados, 'GRADO MÁXIMO DE ESTUDIOS')
                ->setCellValue('AH'.$filaEncabezados, 'NOMBRE CARRERA')
                ->setCellValue('AI'.$filaEncabezados, 'INSTITUCIÓN')
                ->setCellValue('AJ'.$filaEncabezados, 'AÑO DE EGRESO')
                ->setCellValue('AK'.$filaEncabezados, 'FOLIO TÍTULO')
                ->setCellValue('AL'.$filaEncabezados, 'GRADO PROFESIONAL')
                ->setCellValue('AM'.$filaEncabezados, 'DEPARTAMENTO')
                ->setCellValue('AN'.$filaEncabezados, 'AREA')
                ->setCellValue('AO'.$filaEncabezados, 'PUESTO')
                ->setCellValue('AP'.$filaEncabezados, 'CCT LABORATORISTA')
                ->setCellValue('AQ'.$filaEncabezados, 'HORARIO')
        ;

        $filaContenido = 7;
        foreach ($ReporteParticipantes as $val){                  
            $excel_formato->getActiveSheet()
                ->setCellValue('A'.$filaContenido, strtoupper($val['id']))
                ->setCellValue('B'.$filaContenido, strtoupper($val['nombre']))
                ->setCellValue('C'.$filaContenido, strtoupper($val['apellido_paterno']))
                ->setCellValue('D'.$filaContenido, strtoupper($val['apellido_materno']))
                ->setCellValue('E'.$filaContenido, strtoupper($val['curp']))
                ->setCellValue('F'.$filaContenido, strtoupper($val['rfc']))
                ->setCellValue('G'.$filaContenido, strtoupper($val['sexo']))
                ->setCellValue('H'.$filaContenido, strtoupper($val['estado_civil']))
                ->setCellValue('I'.$filaContenido, strtoupper($val['hijos']))
                ->setCellValue('J'.$filaContenido, strtolower($val['correo']))
                ->setCellValue('K'.$filaContenido, strtoupper($val['tipo_sangre']))
                ->setCellValue('L'.$filaContenido, strtoupper($val['telefono']))
                ->setCellValue('M'.$filaContenido, $val['estatus'])
                ->setCellValue('N'.$filaContenido, $val['motivo_estatus'])
                ->setCellValue('O'.$filaContenido, $val['fecha_baja'])
                ->setCellValue('P'.$filaContenido, $val['fecha_ingreso_sistema'])
                ->setCellValue('Q'.$filaContenido, $val['fecha_ingreso_ct'])
                ->setCellValue('R'.$filaContenido, ($val['demanda'] == 1) ? 'SI' : 'NO')
                ->setCellValue('S'.$filaContenido, strtoupper($val['obs_demanda']))
                ->setCellValue('T'.$filaContenido, ($val['pension'] == 1) ? 'SI' : 'NO')
                ->setCellValue('U'.$filaContenido, strtoupper($val['beneficiario']))
                ->setCellValue('V'.$filaContenido, str_replace('|','  | ', str_replace('#', '  ', $val['claves_presupuestales'])))
                ->setCellValue('W'.$filaContenido, ($val['base_estatal'] == 1) ? 'X' : '')
                ->setCellValue('X'.$filaContenido, ($val['base_federal'] == 1) ? 'X' : '')
                ->setCellValue('Y'.$filaContenido, ($val['base_contrato'] == 1) ? 'X' : '')
                ->setCellValue('Z'.$filaContenido, ($val['base_otro'] == 1) ? 'X' : '')
                ->setCellValue('AA'.$filaContenido, strtoupper($val['calle']))
                ->setCellValue('AB'.$filaContenido, strtoupper($val['numero']))
                ->setCellValue('AC'.$filaContenido, strtoupper($val['colonia']))
                ->setCellValue('AD'.$filaContenido, strtoupper($val['cp']))
                ->setCellValue('AE'.$filaContenido, strtoupper($val['nombre_estado']))
                ->setCellValue('AF'.$filaContenido, strtoupper($val['nombre_municipio']))
                ->setCellValue('AG'.$filaContenido, strtoupper($val['grado_estudios']))
                ->setCellValue('AH'.$filaContenido, strtoupper($val['carrera']))
                ->setCellValue('AI'.$filaContenido, strtoupper($val['institucion']))
                ->setCellValue('AJ'.$filaContenido, strtoupper($val['fecha_egreso']))
                ->setCellValue('AK'.$filaContenido, strtoupper($val['folio_titulo']))
                ->setCellValue('AL'.$filaContenido, strtoupper($val['grado_profesion']))
                ->setCellValue('AM'.$filaContenido, strtoupper($val['departamento']))
                ->setCellValue('AN'.$filaContenido, strtoupper($val['area']))
                ->setCellValue('AO'.$filaContenido, strtoupper($val['nombre_puesto']))
                ->setCellValue('AP'.$filaContenido, strtoupper($val['cct_laboratorista']))
                ->setCellValue('AQ'.$filaContenido, str_replace('|', '  | ', str_replace('#', '  ', $val['horario'])))
                #->setCellValue('AQ'.$filaContenido, $val['dias_horario'])

            ;
            $filaContenido++;
        }
        
        for($i = 'A'; $i !== 'AQ'; $i++) {
            $excel_formato->getActiveSheet()->getStyle( $i.'7:'.$i.($filaContenido-1) )->applyFromArray($estiloCuerpoColumnas);
        }

        // No se, hay que investigar
        //$excel_formato->getActiveSheet()->fromArray($ReporteParticipantes, null, 'A7');
                                                                                         
        $filename='Reporte_Personal.xls'; //nombre del archivo
                                                                                        
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //nombre del archivo
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($excel_formato, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
    }
    /**********************Permisos***************************/
    public function menu(){        
        $items  = $this->Querys->consulta('a.id as id_menu, a.nombre as nombre_menu, a.orden, a.alta_baja, a.url', 'rh_menu a', array(array('tabla' => 'rh_menus_rol b', 'join' => 'b.menu_id=a.id')),"b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");        
        return $items;        
    }
    public function submenu(){
        $items  = $this->Querys->consulta('a.id as id_submenu, a.nombre as nombre_submenu, a.menu_id, a.url, a.alta_baja', 'rh_submenu a',array(array('tabla' => 'rh_submenus_rol b', 'join' => 'b.submenu_id=a.id')), "b.rol_id = " .$this->session->userdata('rol_id')." AND a.alta_baja=1", null, null, "a.orden", "asc");
        return $items;        
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
