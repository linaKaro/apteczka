<?php

require_once 'conf/zmienne.php';
require_once "inc/$lang/error_msg.php";
require_once "inc/$lang/teksty.php";
require_once "inc/baza.php";
require_once "classes/class.user.php";

require_once "inc/naglowek.php";

$user = new User($baza);
?>

<div class="container theme-showcase" role="main">
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
		?> <h4> <?php 
		echo $registerSuccessful; ?></h4><br>
		<a class="btn btn-primary" href="myindex.php?wybrano=0" role="button"><?php echo $backToLogin; ?></a>
		<?php 
	} else {?> <h4> <?php
		echo $registration_error; ?>
		</h4><br>
		<a class="btn btn-primary" href="register.php?wybrano=6" role="button"><?php $tryAgain; ?></a>
		<?php
			
	}
} else {

?>


<div class="row">
  <div class="col-md-6 col-md-offset-3">	
	<form role="form" action = "" method="POST">
		<h3><?php echo $yourData; ?></h3>
		<?php echo $lbEmail ?> <br> <input type = "email" class="form-control" name="email" placeholder=" <?php echo $logEmailpch?>" required>
		<?php echo $lbUsername ?> <br> <input type = "text" class="form-control" name="username" placeholder = " <?php echo $logUsernamepch?>" required>
		<?php echo $lbHaslo ?> <br> <input type = "password" class="form-control" name="haslo" placeholder=" <?php echo $logHaslopch?>" required><br>
		<button id="submit" type="submit" value="OK" class="btn btn-default"><?php echo $commitRegister; ?></button>
	</form>
	<br>
	<a class="btn btn-primary" href="myindex.php?wybrano=0" role="button"><?php echo $backToLogin; ?></a>
	<br>
  </div>
</div>
<?php }
require_once 'inc/stopka.php';
?>
