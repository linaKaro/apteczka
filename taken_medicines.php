<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
	require_once "classes/class.user.php";
	require_once "inc/naglowek.php";
    require_once "inc/menu.php"; ?>

	<div class="jumbotron">
		<h2><?php echo $takenTitle; ?></h2>
	</div>

<?php

	require_once 'inc/stopka.php';
?>