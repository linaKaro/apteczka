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
		$user->logout();
	
	if(isset($_POST['email']) && isset($_POST['haslo']) && isset($_POST['username']))
		$status = $user->check_login($_POST['email'], $_POST['username'], $_POST['haslo']);
	else
		$user->logout();	

		
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	}?>

<div class="container theme-showcase" role="main">	
<div class="jumbotron">
	<h1><?php echo $tytul ?></h1>
	<p><?php echo $podtytul ?></p>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3">

<?php
		
	if(isset($status) && !$status) { ?>
	<p><?php echo $login_error; ?></p>
	<?php }
	if($_GET['wyloguj']==1) {
		echo $logoutSuccessful;
		unset($_GET['wyloguj']);
	}
	if ($status==true) {
		header("Location: main.php?wybrano=0");
	}
	else {
?>	
	<form role="form" action = "" method="POST">
		<h3>Masz już swoją apteczkę? Zaloguj się!</h3>
		<?php echo $lbEmail ?> <br> <input type = "email" class="form-control" name="email" placeholder=" <?php echo $logEmailpch?>" required>
		<?php echo $lbUsername ?> <br> <input type = "text" class="form-control" name="username" placeholder = " <?php echo $logUsernamepch?>" required>
		<?php echo $lbHaslo ?> <br> <input type = "password" class="form-control" name="haslo" placeholder=" <?php echo $logHaslopch?>" required><br>
		<button id="submit" type="submit" value="OK" class="btn btn-default">Zaloguj</button> <br>
	</form>
	<br>
	<h3>Jesteś tu po raz pierwszy? <a href="register.php?wybrano=6"><?php echo "ZAŁÓŻ SWOJĄ APTECZKĘ!"; ?></a></h3>
  </div>
</div>
<?php

	require_once 'inc/stopka.php';
	}
?>
