<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!isset($_SESSION['login']))
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
	require_once "inc/naglowek.php";
?>

<?php require_once "inc/menu.php"; ?>
<div class="jumbotron">
	<h1><?php echo $tytul ?></h1>
	<p><?php echo $podtytul ?></p>
</div>

<?php 
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	}
	
?>
	
<div class="row">
  <div class="col-md-6 col-md-offset-3">	
	<div class="page-header">Dodaj lek:</div>
	<form class="form" role="form" action="" method="POST">
		<label for="nazwa_leku">Nazwa leku:</label>
		<input id="text" type="text" class="form-control" name="nazwa_leku" required>
		<label for="ean">EAN:</label>
		<input id="text" type="text" class="form-control" name="ean" value="" required>
		<label for="ilosc">Ilość w opakowaniu:</label>
		<input id="text" type="number" class="form-control" name="ilosc" required>
		<label for="jednostka">Jednostka:</label>
		<input id="text" type="text" class="form-control" name="jednostka" required>
		<label for="substancja">Substancja czynna:</label>
		<input id="text" type="text" class="form-control" name="substancja" required><br>
		<button id="submit" type="submit" value="Dodaj" class="btn btn-primary">Dodaj</button><br>
	</form>
	</div>
</div>

<?php

$nazwa_leku=$_POST['nazwa_leku'];
$ean=$_POST['ean'];
$ilosc=$_POST['ilosc'];
$jednostka=$_POST['jednostka'];
$substancja_czynna=$_POST['substancja'];

$query = "INSERT INTO leki(nazwa_leku, EAN, ilosc, jednostka, substancja_czynna) VALUES('$nazwa_leku', '$ean', '$ilosc', '$jednostka', '$substancja_czynna')";
$query1 = "select * from leki";
if ($_POST['nazwa_leku'] && $_POST['ean'] && $_POST['ilosc'] && $_POST['jednostka'] && $_POST['substancja']) {
	$baza->query($query);
}




require_once 'inc/stopka.php';
?>

