<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
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
	
<div id = "dodaj_do_bazy">
<?php
	echo "Usuń lek: <br><br>";
?>
<form action="" method="POST">
<?php echo "Nazwa leku: \t"; ?><input id="text" type="text" name="nazwa_leku"><br>
<?php echo "EAN: \t"; ?><input id="text" type="text" name="ean" value=""><br><br>
<input id="submit" type="submit" value="Usuń"><br>
</form>
</div>

<?php

$nazwa_leku=$_POST['nazwa_leku'];
$ean=$_POST['ean'];

$query = "DELETE FROM leki_specyfikacja WHERE nazwa='$nazwa_leku' OR ean='$ean'";
$query1 = "select * from leki_specyfikacja";
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
	<?php echo $row["id_leki_specyfikacja"] . "\t"; ?> </td>
	<td id="tabela">
	<?php echo $row["nazwa"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["ean"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["ilosc_w_opakowaniu"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["jednostka"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["subst_czynna"]. "<br>";?> </td>
	</tr>
<?php
}
?>
</table>

<?php
require_once 'inc/stopka.php';
?>

