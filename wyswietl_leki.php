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



<div class="page-header">Wyszukaj wybrany lek w bazie</div>
<form action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <label for="search_by">Wyszukaj po:</label>
            <select class="form-control" id="search_by" name="metoda_szukania">
                <option value="EAN">EAN</option>
                <option value="nazwa_leku">Nazwa leku</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="enter_string">Szukaj leku:</label>
            <input class="form-control" type="text" id="enter_string" name="wyrazenie">
        </div>
        <div class="col-md-4">
            <br>
            <button type="submit" class="btn btn-primary">Wyszukaj</button>
        </div>
    </div>
    </br></br>
</form>

<?php 
	if (!isset($_GET['wybrano'])) {
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	}
	
?>

<?php

	$metoda_szukania=$_POST['metoda_szukania'];
	$wyrazenie = $_POST['wyrazenie']; 

	
	$zapytanie = "select * from leki where " .$metoda_szukania. " like'%".$wyrazenie."%' ";
	$rezultat = $baza->query($zapytanie);
	
?>

<div class="table-responsive">
<table class="table" id="tabela1">
	<thead>
	<tr>
		<td>
		<?php echo "ID leku"; ?> </td>
		<td id="tabela1">
		<?php echo "Nazwa";?> </td>
		<td id="tabela1">
		<?php echo "EAN";?> </td>
		<td id="tabela1">
		<?php echo "Ilość w opakowaniu";?> </td>
		<td id="tabela1">
		<?php echo "Jednostka";?> </td>
		<td id="tabela1">
		<?php echo "Substancja czynna";?> </td>
	</tr>
	</thead>

<?php
	$nr_rows = $rezultat->num_rows;
	for($i=0;$i<$nr_rows;$i++){
	$row=$rezultat->fetch_assoc();	
	
?>
	<tr id="tabela1">
		<td id="tabela1">
		<?php echo $row["id"] . "\t"; ?> </td>
		<td id="tabela1">
		<?php echo $row["nazwa_leku"] . "\t";?> </td>
		<td id="tabela1">
		<?php echo $row["EAN"] . "\t";?> </td>
		<td id="tabela1">
		<?php echo $row["ilosc"] . "\t";?> </td>
		<td id="tabela1">
		<?php echo $row["jednostka"] . "\t";?> </td>
		<td id="tabela1">
		<?php echo $row["substancja_czynna"]. "<br>";?> </td>
	</tr>
<?php
}
?>
</table>
</div>

<?php
	
	$query = "select * from leki";
	
	$wynik = $baza->query($query);
	
	echo "<br><br>REKORDY W BAZIE<br><br>";
?>
<div class="table-responsive">
<table class="table">
	<thead>
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
	</thead>

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
</div>

<?php
require_once 'inc/stopka.php';
?>
