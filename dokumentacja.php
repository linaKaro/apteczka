<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/naglowek.php";
?>

<header>
	<H1><?php echo $tytul ?></H1>
	<H4><?php echo $podtytul ?></H4>
</header>

<?php require_once "inc/menu.php"; ?>
<?php 
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	} else
		$opcja = ($_GET['wybrano']);
		
	echo $wybranoOpcje . $opcja . " " . $wybrane[$opcja] . "<br><br>";
?>
<h4>1.<a href="<?php echo "$dokumentacja/DomowaApteczka.pdf"; ?>" target="_blank">Plan Apteczki</a></h4>

<?php 
	require_once 'inc/stopka.php';
?>