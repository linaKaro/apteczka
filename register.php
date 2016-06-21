<?php

require_once 'conf/zmienne.php';
require_once "inc/$lang/error_msg.php";
require_once "inc/$lang/teksty.php";
require_once "inc/baza.php";
require_once "classes/class.user.php";

require_once "inc/naglowek.php";

$user = new User($baza);
?>

<?php require_once "inc/menu.php"; ?>
<div class="jumbotron">
	<h1><?php echo $tytul ?></h1>
	<p><?php echo $podtytul ?></p>
</div>

<?php
if(isset($_POST['email']) && isset($_POST['haslo']) && isset($_POST['username'])) {
	$database_id=$user->set_database($_POST['email']);
	$independent = 1;
	$added=$user->add_user($database_id, $_POST['username'], $independent, $_POST['haslo']);
	if($added) {
		?> <h3> <?php 
		echo "Udało się utworzyć konto :) Przejdź do logowania."; ?> </h3> <?php 
	} else {?> <h3> <?php
		echo "Konto nie zostało utworzone. <br>"; ?><a href="register.php?wybrano=6"><?php echo "SPRÓBUJ PONOWNIE"; ?></a>
		</h3>
		<?php
			
	}
} else {

?>


<div class="row">
  <div class="col-md-6 col-md-offset-3">	
	<form role="form" action = "" method="POST">
		<h3>Podaj swoje dane aby móc korzystać z apteczki:</h3>
		<?php echo $lbEmail ?> <br> <input type = "email" class="form-control" name="email" placeholder=" <?php echo $logEmailpch?>" required>
		<?php echo $lbUsername ?> <br> <input type = "text" class="form-control" name="username" placeholder = " <?php echo $logUsernamepch?>" required>
		<?php echo $lbHaslo ?> <br> <input type = "password" class="form-control" name="haslo" placeholder=" <?php echo $logHaslopch?>" required><br>
		<button id="submit" type="submit" value="OK" class="btn btn-default">Zarejestruj</button> <br>
	</form>
	<br>
  </div>
</div>
<?php }
require_once 'inc/stopka.php';
?>
