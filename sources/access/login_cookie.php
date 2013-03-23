<?php

require_once ("../include/include.php");

//obtengo datos
$username = $_GET["usr"];
$ssoid = $_GET["ssoid"];

//path del archivo temporal "6fceb24b4eb7efaef7b781496d3259d0"
$filename = ROOT_PATH . "store/" . $ssoid . ".cki";

//peticion curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
/* curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); */
curl_setopt($ch, CURLOPT_URL, "http://es.pokerstrategy.com/home/");
curl_setopt($ch, CURLOPT_COOKIEFILE, $filename);
curl_setopt($ch, CURLOPT_COOKIEJAR, $filename);

$_page = curl_exec($ch);
curl_close($ch);

//verifico el login correcto del usuario
if (login_ok($_page, $username)) {

    //login ok
    //check status
    preg_match_all("/\/front\/images\/ranks\/mini\/([^.]+)/", $_page, $page_matches);
    $status = $page_matches[1][0];

    $arr_json["ssoid"] = $ssoid;
    $arr_json["status"] = $status;
    $arr_json["username"] = $username;
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
