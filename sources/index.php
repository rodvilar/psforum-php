
<?php

/*   curl_setopt($ch, CURLOPT_COOKIEFILE, "ruta al txt");
  curl_setopt($ch, CURLOPT_COOKIEJAR, "ruta al txt");
 */

//require_once('curl_cls.php');

$post_data['Login'] = 'Entrar';
$post_data['loginname'] = 'rodrigopel';
$post_data['password'] = '123456';

$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_URL, "http://es.pokerstrategy.com/login/");
curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/cookie.txt");
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/cookie.txt");

$page = curl_exec($ch);
curl_close($ch);

echo strip_($page);

preg_match("/hellotext/", $page, $matches);

ECHO "<PRE>";
var_dump($matches);
ECHO "</PRE>";

?>
    