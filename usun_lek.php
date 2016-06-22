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

<?php 
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	}
	
?>
	
<div class="row">
  <div class="col-md-6 col-md-offset-3">
<h3>
<?php
	echo "Usuń lek: <br><br>";
?>
</h3>
<form role="form" action="" method="POST">
<?php echo "Nazwa leku: \t"; ?><input id="text" type="text" class="form-control" name="nazwa_leku">
<?php echo "EAN: \t"; ?><input id="text" type="text" class="form-control" name="ean" value=""><br>
<button id="submit" type="submit" value="Usuń">Usuń</button>
</form>
</div>
</div>

<?php

$nazwa_leku=$_POST['nazwa_leku'];
$ean=$_POST['ean'];

$query = "DELETE FROM leki WHERE nazwa_leku='$nazwa_leku' OR EAN='$ean'";
$query1 = "select * from leki";
if ($_POST['nazwa_leku'] || $_POST['ean']) {
	$baza->query($query);
}

$wynik=$baza->query($query1);
	
	echo "<br><br>REKORDY W BAZIE<br><br>";
?>
<table id="tabela">
<tr id="tabela">
<td id="tabela">
	<?php echo "ID leku"; ?> </td>
	<td id="tabela">
	<?php echo "Nazwa";?> </td>
	<td id="tabela">
	<?php echo "EAN";?> </td>
	<td id="tabela">
	<?php echo "Ilość w opakowaniu";?> </td>
	<td id="tabela">
	<?php echo "Jednostka";?> </td>
	<td id="tabela">
	<?php echo "Substancja czynna";?> </td>
	</tr>

<?php
	while ($row = $wynik->fetch_assoc()) {
?>
<tr id="tabela">
<td id="tabela">
	<?php echo $row["id"] . "\t"; ?> </td>
	<td id="tabela">
	<?php echo $row["nazwa_leku"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["EAN"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["ilosc"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["jednostka"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["substancja_czynna"]. "<br>";?> </td>
	</tr>
<?php
}
?>
</table>

<?php
require_once 'inc/stopka.php';
?>

