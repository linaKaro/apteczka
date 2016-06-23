<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
	require_once "inc/naglowek.php";
?>

<?php require_once "inc/menu.php"; ?>
<div class="jumbotron">
	<h1><?php echo $tytul ?></h1>
	<p><?php echo $podtytul ?></p>
</div>

	
	<h3><?php echo $welcome.$_SESSION['username']."!"?></h3>
<?php 
	require_once 'inc/stopka.php';
?>
		