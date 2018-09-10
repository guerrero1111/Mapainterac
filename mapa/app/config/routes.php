<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*
$route['default_controller'] = "aspirantes/index";
$route['404_override'] 		 = '';
*/


$route['default_controller']   = 'main/dashboard_principal'; 


$route['404_override'] 		   = '';


$route['recopilar_datos']   	= 'main/recopilar_datos'; 
$route['cargar_dependencia']   	= 'main/cargar_dependencia'; 



//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Administracion//////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

$route['admin']							= 'admin/index';
$route['login']							= 'admin/login';


$route['usuarios']						= 'admin/listado_usuarios'; 
$route['procesando_usuarios']			= 'admin/procesando_usuarios';

$route['en']   = 'main/dashboard_principalen';

	/* necesita server de correo, para que notifique quien se da de alta*/
$route['nuevo_usuario']                 = 'admin/nuevo_usuario';
$route['validar_nuevo_usuario']         = 'admin/validar_nuevo_usuario';

$route['actualizar_perfil']		        = 'admin/actualizar_perfil';
$route['editar_usuario/(:any)']			= 'admin/actualizar_perfil/$1';
$route['validacion_edicion_usuario']    = 'admin/validacion_edicion_usuario';

$route['eliminar_usuario/(:any)']		= 'admin/eliminar_usuario/$1';
$route['validar_eliminar_usuario']   	= 'admin/validar_eliminar_usuario';


$route['salir']							= 'admin/logout';

$route['validar_login']					= 'admin/validar_login';


//recuperar contraseña /* necesita server de correo*/
$route['recuperar_contrasena']			= 'admin/recuperar_contrasena';
$route['validar_recuperar_password']	= 'admin/validar_recuperar_password';

//historicos de accesos
$route['historico_accesos']             = 'admin/historico_accesos';
$route['procesando_historico_accesos']  = 'admin/procesando_historico_accesos';

///////////////////////////Catalogos//////////////////////////////////////////////////
$route['catalogos']     			 	= 'admin/listado_catalogos';
$route['procesando_catalogos']       	= 'admin/procesando_catalogos';
$route['nuevo_catalogo']      		 	= 'admin/nuevo_catalogo';

$route['nuevo_catalogo']                = 'admin/nuevo_catalogo';
$route['validar_nuevo_catalogo']        = 'admin/validar_nuevo_catalogo';

$route['editar_catalogo/(:any)/(:any)']		= 'admin/editar_catalogo/$1/$2';
$route['validacion_edicion_catalogo']   = 'admin/validacion_edicion_catalogo';

$route['eliminar_catalogo/(:any)']		= 'admin/eliminar_catalogo/$1';
$route['validar_eliminar_catalogo']    	= 'admin/validar_eliminar_catalogo';


///////////////////////////Catalogos//////////////////////////////////////////////////
$route['buscador']     			 	= 'admin/listado_buscador';


/* End of file routes.php */
/* Location: ./application/config/routes.php */