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
	}?>
	
	<h3><?php echo "Witaj ".$_SESSION['username']."!"?></h3>
	</br></br></br>	
<?php
	
$id_mk = $_SESSION['mk_id'];
$date = date('Y-m-d');
$query = $query = "SELECT tab1.data_waznosci, tab1.id_leki, tab2.EAN, tab2.nazwa_leku FROM opakowania tab1 JOIN leki tab2 ON tab1.id_leki = tab2.id WHERE tab1.id_apteczka='$id_mk' AND tab1.data_waznosci<'$date'";
$wynik = $baza->query($query);

?>

<div class="header">Sprawdź czy nie trzeba wyrzucić przeterminowanych leków</div>
<div class="table-responsive">
<table class="table" id="tabela">
	<thead>
	<tr id="tabela">
	<td id="tabela">
		<?php echo "ID leku"; ?> </td>
		<td id="tabela">
		<?php echo "Nazwa";?> </td>
		<td id="tabela">
		<?php echo "EAN";?> </td>
		<td id="tabela">
		<?php echo "Data przydatności";?> </td>
		
	</tr>
	</thead>

<?php
	while ($row = $wynik->fetch_assoc()) {
?>
<tr id="tabela">
<td id="tabela">
	<?php echo $row["id_leki"] . "\t"; ?> </td>
	<td id="tabela">
	<?php echo $row["nazwa_leku"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["EAN"] . "\t";?> </td>
	<td id="tabela">
	<?php echo $row["data_waznosci"] . "</br>";?> </td>
	</tr>
<?php
}
?>
</table>
</div>
	
	
<?php 
	require_once 'inc/stopka.php';
?>

