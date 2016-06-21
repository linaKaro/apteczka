<?php

	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/error_msg.php";
	require_once "inc/$lang/teksty.php";
	require_once "inc/baza.php";
	require_once "classes/class.user.php";
	require_once "inc/funkcje.php";
	
	require_once "inc/naglowek.php";
	
	$user = new User($baza);
	
	if($_GET['wyloguj']==1)
		session_destroy();
	
	if(isset($_POST['email']) && isset($_POST['haslo']) && isset($_POST['username']))
		if($user->check_login($_POST['email'], $_POST['username'], $_POST['haslo']))
			echo "ZALOGOWANO";
		else $byl_blad_logowania = 2;
	else
		session_destroy();	

?>

<header>
	<H1><?php echo $tytul ?></H1>
	<H1><?php echo $podtytul ?></H1>
</header>
<?php require_once "inc/menu.php"; ?>


<?php 
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	} else
		$opcja = ($_GET['wybrano']);
		
	echo '<p id="blad">';
			if (isset($byl_blad_logowania) && $byl_blad_logowania == 2)
				echo $blad_logowania;
	echo '</p>';
	if(!$_SESSION['login']) {
?>
	
<powitanie>
CZEŚĆ! Witaj na portalu DomowaApteczka.pl - miejscu które pomoże Ci uporządkować Twoje leki.
</powitanie>

<div id = "formularz">
	
<form action = "" method="POST">
<h3>Masz już swoją apteczkę? Zaloguj się!</h3>
<?php echo $lbEmail ?> <br> <input type = "email" name="email" placeholder=" <?php echo $logEmailpch?>" required> <br>
<?php echo $lbUsername ?> <br> <input type = "text" name="username" placeholder = " <?php echo $logUsernamepch?>" required> <br>
<?php echo $lbHaslo ?> <br> <input type = "password" name="haslo" placeholder=" <?php echo $logHaslopch?>" required> <br> <br>
<input id="submit" type="submit" value="OK"> <br>
</form>

<a href="register.php?wybrano=6"><?php echo "ZAŁÓŻ SWOJĄ APTECZKĘ!"; ?>
	
<?php
	} else echo "<br>Witaj ". $_SESSION['username'] . "!";
?>
</div>
<?php 
require_once 'inc/stopka.php';
?>
