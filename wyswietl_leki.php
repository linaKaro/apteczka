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
	
	
	$query = "select * from leki";
	
	$wynik = $baza->query($query);
	
	echo "<br><br>REKORDY W BAZIE<br><br>";
?>
<table>
<tr>
<td>
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
