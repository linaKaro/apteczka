<?php 
	$baza = new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);
	if($baza->connect_error > 0) {
		die('Nie można połączyć się z bazą');
	}
	$baza->set_charset("utf8");
?>

