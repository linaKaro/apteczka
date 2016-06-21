<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!isset($_SESSION['login']))
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
	echo "Dodaj nowy lek do bazy: <br><br>";
?>
<form action="" method="POST">
<?php echo "Nazwa leku: \t"; ?><input id="text" type="text" name="nazwa_leku" required><br>
<?php echo "EAN: \t"; ?><input id="text" type="text" name="ean" value="" required><br>
<?php echo "Ilość w opakowaniu: \t"; ?><input id="text" type="number" name="ilosc" required><br>
<?php echo "Jednostka: \t"; ?><input id="text" type="text" name="jednostka" required><br>
<?php echo "Substancja czynna: \t"; ?><input id="text" type="text" name="substancja" required><br><br>
<input id="submit" type="submit" value="Dodaj"><br>
</form>
</div>

<?php

$nazwa_leku=$_POST['nazwa_leku'];
$ean=$_POST['ean'];
$ilosc=$_POST['ilosc'];
$jednostka=$_POST['jednostka'];
$substancja_czynna=$_POST['substancja'];

$query = "INSERT INTO leki_specyfikacja(nazwa, ean, ilosc_w_opakowaniu, jednostka, subst_czynna) VALUES('$nazwa_leku', '$ean', '$ilosc', '$jednostka', '$substancja_czynna')";
$query1 = "select * from leki_specyfikacja";
if ($_POST['nazwa_leku'] && $_POST['ean'] && $_POST['ilosc'] && $_POST['jednostka'] && $_POST['substancja']) {
	$baza->query($query);
}
	$wynik=$baza->query($query1);
	
	echo "<br><br>REKORDY W BAZIE<br><br>";
	while ($row = $wynik->fetch_assoc()) {
	echo $row["id_leki_specyfikacja"] . "\t";
	echo $row["nazwa"] . "\t";
	echo $row["ean"] . "\t";
	echo $row["ilosc_w_opakowaniu"] . "\t";
	echo $row["jednostka"] . "\t";
	echo $row["subst_czynna"]. "<br>";
}



require_once 'inc/stopka.php';
?>

