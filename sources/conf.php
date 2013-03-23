<?php 
defined('COOKIEFILE')? null : define("COOKIEFILE", "c:/wamp/www/spirateFlooding/cookiefile.txt");
defined('URL_LOGIN')? null : define("URL_LOGIN", "index.php?action=login2"); 
defined('URL_POST')? null : define("URL_POST", "index.php?action=post;board=4");
defined('URL_SEND_POST')? null : define("URL_SEND_POST", "index.php?action=post2;start=0;board=4");
defined('PREVIEW')? null : define("PREVIEW", "vprevia.php");


// constantes para la conexion de la base de datos
defined('DB_HOST')? null : define("DB_HOST", "localhost"); 
defined('DB_USER')? null : define("DB_USER", "root"); 
defined('DB_PASS')? null : define("DB_PASS", "");
defined('DB_NAME')? null : define("DB_NAME", "spflood"); 

//require_once('db.php');
require_once('curl_cls.php');