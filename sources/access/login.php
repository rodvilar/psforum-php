<?php

require_once ("../include/include.php");

//obtengo los datos de login
$post_data['Login'] = 'Entrar';
$post_data['loginname'] = $_GET["usr"];
$post_data['password'] = $_GET["pwd"];
/* $post_data['loginname'] = 'rodrigopel';
  $post_data['password'] = '123456' */;
$post_data['cookie_login'] = 'on';

//path del archivo temporal
$filename = ROOT_PATH . "temp/" . microtime() . ".tmp";

//peticion curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_URL, "http://es.pokerstrategy.com/login/");
curl_setopt($ch, CURLOPT_COOKIEFILE, $filename);
curl_setopt($ch, CURLOPT_COOKIEJAR, $filename);

$_page = curl_exec($ch);
curl_close($ch);

//obtengo ssoid de dentro del archivo de las cookies
$arr_file = file($filename);
$ssoid = trim(substr($arr_file[4], strpos($arr_file[4], "SSOID") + 5));

//guardo el archivo de las cookies con su nombre correspondiente
$newname = ROOT_PATH . "store/" . $ssoid . ".cki";
rename($filename, $newname);

//verifico el login correcto del usuario
if (login_ok($_page, $_GET["usr"])) {

    //login ok
    //check status
    preg_match_all("/\/front\/images\/ranks\/mini\/([^.]+)/", $_page, $page_matches);
    $status = $page_matches[1][0];

    $arr_json["ssoid"] = $ssoid;
    $arr_json["status"] = $status;
    $arr_json["username"] = $_GET["usr"];
    
} else {

    $arr_json["ssoid"] = "~";
    $arr_json["status"] = "~";
    $arr_json["username"] = "~";
}


echo json_encode($arr_json);

function login_ok($page, $username) {

    if (strpos($page, $username) === FALSE) {
        return false;
    } else {
        return true;
    }
}

?>
