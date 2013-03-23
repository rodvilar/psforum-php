<?php

//peticion curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL, "http://es.pokerstrategy.com/forum/");


$_page = curl_exec($ch);
curl_close($ch);

//preg_match_all("/tablecat[^b]+boardid=([^\"]+)\">/", $_page, $page_matches);
preg_match_all("/hidecat=([^\"]+)\">/", $_page, $page_matches);


echo "<PRE>";
print_r($page_matches);
echo "</PRE>";


/*<a href="board.php?boardid=1497">
<b>Foros de PokerStrategy.com</b>
</a>*/

?>