<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['catalogos/puestos'] = 'Catalogos/PuestosController';
$route['catalogos/puestos/nuevo'] = 'Catalogos/PuestosController/nuevo';
$route['catalogos/puestos/guardar'] = 'Catalogos/PuestosController/guardar/';
$route['catalogos/puestos/editar/(:num)'] = 'Catalogos/PuestosController/editar/$1';
$route['catalogos/puestos/actualizar/(:num)'] = 'Catalogos/PuestosController/guardar/$1';
$route['catalogos/puestos/eliminar/(:num)'] = 'Catalogos/PuestosController/eliminar/$1';

#Rutas para registros de personal
#Personal activo
#Personal inactivo
$route['registros/personal-inactivo'] = 'Registros/PersonalController/personalInctivo';
$route['registros/personal-inactivo/dataTable'] = 'Registros/PersonalController/dataTable';
$route['registros/personal-inactivo/agregar'] = 'Registros/Registro/Agregar';
$route['registros/personal-inactivo/editar/(:num)'] = 'Registros/Registro/Editar/$1';
$route['registros/personal-inactivo/wsNomina'] = 'Registros/Registro/wsNomina';
$route['registros/personal-inactivo/getMunicipio'] = 'Registros/PersonalController/getMunicipio';
$route['registros/personal-inactivo/getArea'] = 'Registros/PersonalController/getArea';

$route['registros/personal-activo'] = 'Registros/PersonalController/personalActivo';
$route['registros/personal-activo/dataTable'] = 'Registros/PersonalController/dataTable';
$route['registros/personal-activo/agregar'] = 'Registros/Registro/Agregar';
$route['registros/personal-activo/editar/(:num)'] = 'Registros/Registro/Editar/$1';
$route['registros/personal-activo/wsNomina'] = 'Registros/Registro/wsNomina';
$route['registros/personal-activo/getMunicipio'] = 'Registros/PersonalController/getMunicipio';
$route['registros/personal-activo/getArea'] = 'Registros/PersonalController/getArea';

$route['registros/registros/personal/ficha/(:any)'] = 'Registros/Registro/fichaPersonal/$1';
$route['registros/registros/personal/ficha_publica/(:any)'] = 'Inicio/datosPersonal/$1';
$route['empleados/ficha_publica/(:any)'] = 'Inicio/ficha_publica/$1';
$route['personal/ficha_publica/(:any)'] = 'Inicio/ficha_publica/$1';
$route['registros/registros/personal/gafete/(:any)'] = 'Registros/Registro/gafetePersonal/$1';
$route['registros/registros/personal/gafeteB/(:any)'] = 'Registros/Registro/gafetePersonalTrasera/$1';


# Rutas para listas de catalogos
$route['catalogos/areas/get-area'] = 'Catalogos/Departamento/listaAreas';


#Rutas para autocomplete de CT
$route['catalogos/centros-trabajo/buscar'] = 'Registros/PersonalController/autoCompleteCT';


// Credencialización
$route['credencializacion'] = 'Administracion/CredencializacionController';
$route['credencializacion/cantidad-personal-area'] = 'Administracion/CredencializacionController/contarPersonal';
$route['credencializacion/crear-lote'] = 'Administracion/CredencializacionController/store';
$route['credencializacion/data-table'] = 'Administracion/CredencializacionController/dataTable';
$route['credencializacion/ver-lote/(:num)'] = 'Administracion/CredencializacionController/verLote/$1';
$route['credencializacion/generar-archivos/(:num)/(:num)'] = 'Administracion/CredencializacionController/generarArchivos/$1/$2';
$route['credencializacion/descargar-archivos/(:num)/(:num)/(:num)'] = 'Administracion/CredencializacionController/descargasArchivos/$1/$2/$3';
$route['credencializacion/descargar-lote/(:num)'] = 'Administracion/CredencializacionController/descargasLote/$1';
$route['credencializacion/buscar-empleado'] = 'Administracion/CredencializacionController/buscarEmpleado';

# Rutas para apis
$route['api/buscarpersonal/email'] = 'api/Consultas/buscar_por_email';
$route['api/buscarpersonal/id'] = 'api/Consultas/buscarPersonalPorId';