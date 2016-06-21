<?php

require_once 'conf/zmienne.php';
require_once "inc/$lang/error_msg.php";
require_once "inc/$lang/teksty.php";
require_once "inc/baza.php";
require_once "classes/class.user.php";

require_once "inc/naglowek.php";

$user = new User($baza);
?>
<header>
<H1><?php echo $tytul ?></H1>
	<H1><?php echo $podtytul ?></H1>
</header>
<?php require_once "inc/menu.php"; 

if(isset($_POST['email']) && isset($_POST['haslo']) && isset($_POST['username'])) {
	$database_id=$user->set_database($_POST['email']);
	$independent = 1;
	$added=$user->add_user($database_id, $_POST['username'], $independent, $_POST['haslo']);
	if($added) {
		echo "Udało się utworzyć konto :) Przejdź do logowania.";
	} else {
		echo "Konto nie zostało utworzone.";
			
	}
} else {

?>


<div id = "formularz">
	
<form action = "" method="POST">
<h3>Zarejestruj się aby korzystać z apteczki:</h3>
<?php echo $lbEmail ?> <br> <input type = "email" name="email" placeholder=" <?php echo $logEmailpch?>" required> <br>
<?php echo $lbUsername ?> <br> <input type = "text" name="username" placeholder = " <?php echo $logUsernamepch?>" required> <br>
<?php echo $lbHaslo ?> <br> <input type = "password" name="haslo" placeholder=" <?php echo $logHaslopch?>" required> <br> <br>
<input id="submit" type="submit" value="OK"> <br>
</form>
</div> 
<?php }
require_once 'inc/stopka.php';
?>
