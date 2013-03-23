<?php
session_start();

if (!defined('ROOT_PATH'))
	define('ROOT_PATH', realpath(dirname(__FILE__) . '/../') . '/');

/* Configuraciones de la base de datos: */
include_once ROOT_PATH . 'include/config_mysql.php';

/* Configuraciones del sitio: */
include_once ROOT_PATH . 'include/config_site.php';

/* Constantes definidas */
include_once ROOT_PATH . 'include/constants.php';

/* Mensajes */
include_once ROOT_PATH . 'include/messages.php';

/* Librerias: */
//TemplatePower
include_once ROOT_PATH . 'include/lib/TemplatePower/class.TemplatePower.inc.php';
// Mail
include_once ROOT_PATH . 'logic/b3/EmailFunctionsB3.php';

/* Clases generales */
include_once ROOT_PATH . 'logic/b3/ConexionB3.php';
include_once ROOT_PATH . 'logic/b3/CookieFunctionsB3.php';
include_once ROOT_PATH . 'logic/b3/DateFunctionsB3.php';
include_once ROOT_PATH . 'logic/b3/FunctionsB3.php';
include_once ROOT_PATH . 'logic/b3/ImgFunctionsB3.php';
include_once ROOT_PATH . 'logic/b3/TemplateB3.php';
include_once ROOT_PATH . 'logic/b3/TextFunctionsB3.php';
include_once ROOT_PATH . 'logic/b3/ExceptionsB3.php';

/* Clases padre */
include_once ROOT_PATH . 'logic/generadas/Usuarios_admin_padre.php';

/* Clases particulares */
include_once ROOT_PATH . 'logic/Usuario_admin.php';