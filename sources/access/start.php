<?php

require_once ("../include/include.php");

//path del archivo temporal
$filename = ROOT_PATH."temp/".microtime().".tmp";

//peticion curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL, "http://es.pokerstrategy.com/home/");
curl_setopt($ch, CURLOPT_COOKIEFILE, $filename);
curl_setopt($ch, CURLOPT_COOKIEJAR, $filename);

$page = curl_exec($ch);
curl_close($ch);

//obtengo ssoid de dentro del archivo de las cookies
$arr_file = file($filename);
$ssoid = trim(substr($arr_file[4],strpos($arr_file[4],"SSOID")+5));

//guardo el archivo de las cookies con su nombre correspondiente
$newname = ROOT_PATH."store/".$ssoid.".cki";
rename($filename,$newname);

//retorno el ssoid
$arr_json["ssoid"] = $ssoid;
/*echo "<pre><br>";
print_r ($ssoid);
echo "</pre><br>";*/

echo json_encode($arr_json);
?>
