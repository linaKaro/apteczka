<?php

session_start();
require_once 'conf/zmienne.php';
require_once "inc/$lang/teksty.php";
require_once "inc/baza.php";
require_once "inc/naglowek.php";
require_once "inc/menu.php";

if(!$_SESSION['login'])
	header("Location: myindex.php?wybrano=0&zaloguj_sie=1");

if($_GET['wybrano']==1) {
	?>
	
	<div class="jumbotron">
		<h2><?php echo $addTitle1; ?></h2>
	</div>

	
	<div class="page-header">Wyszukaj lek w bazie</div>
	<form action="" method="post">
	    <div class="row">
	        <div class="col-md-4">
	            <label for="search_by">Wyszukaj po:</label>
	            <select class="form-control" id="search_by" name="search_by">
	                <option value="nazwa_leku">nazwa</option>
	                <option value="EAN">EAN</option>
	            </select>
	        </div>
	        <div class="col-md-4">
	            <label for="enter_string">Wpisz wyszukiwaną frazę:</label>
	            <input class="form-control" type="text" id="enter_string" name="enter_string">
	        </div>
	        <div class="col-md-4">
	            <br>
	            <button type="submit" class="btn btn-primary">Wyszukaj</button>
	        </div>
	    </div>
	</form>
	<?php
	$query = "select * from leki";
	if(isset($_POST['enter_string']) && $_POST['enter_string'] != "") {
		$input=$_POST['enter_string'];
		$query = "select * from leki where nazwa_leku like '%$input%' or EAN like '%$input%'";
	}
	$result = $baza->query($query);
	?>
	
	<div class="container">
	  	<h3>Lista leków</h3>
	  	<table class="table table-striped">
	    	<thead>
	      		<tr>
	        	<th>nazwa</th>
	        	<th>EAN</th>
	        	<th>ilość</th>
	        	<th>jednostka</th>
	        	<th>substancja czynna</th>
	        	<th>wybierz</th>
	      		</tr>
	    	</thead>
	    <tbody>
	    <?php while ($row = $result->fetch_assoc()) { ?>
	    <tr>
	    	<td><?php echo $row["nazwa_leku"]; ?></td>
	    	<td><?php echo $row["EAN"]; ?></td>
	    	<td><?php echo $row["ilosc"]; ?></td>
	    	<td><?php echo $row["jednostka"]; ?></td>
	    	<td><?php echo $row["substancja_czynna"]; ?></td>
	    	<td><form action = "add_medicine.php?wybrano=2" method = "post">
	    	<button type="submit" name="medicine_id" value="<?php echo $row["id"]; ?>" class="btn btn-primary">Wybierz</button>
	    	</form></td>
	    </tr>
	    <?php }?>
	    </tbody>
	    </table><br>
	</div>
<?php } elseif ($_GET['wybrano']==2) {
	$string = "brak wyboru";
	$chosen = 0;
	if(isset($_POST['medicine_id'])) {
		$input=$_POST['medicine_id'];
		$query = "select * from leki where id='$input'";
		$result = $baza->query($query);
		$row = $result->fetch_assoc();
		$string = $row["nazwa_leku"].", EAN ".$row["EAN"].", ilość ".$row["ilosc"]." ".$row["jednostka"];
		$chosen = $row["id"];
	}
	?>
	
	<div class="jumbotron">
		<h2><?php echo $addTitle2; ?></h2>
	</div>
	
	<div class="page-header">Wybrany lek</div>
	<p><b><?php echo "Wybrano: ".$string ?></b></p><br>
	<div class="page-header">Wpisz pozostałe dane dotyczące zakupionego leku</div>
	
	<div class="row">
	  <div class="col-md-6 col-md-offset-3">	
		<form role="form" action="add_medicine.php?wybrano=3" method="POST">
			<label for="cena">Cena:</label>
			<input id="cena" type="number" step="0.01" class="form-control" name="cena" required>
			<label for="data_waznosci">Data ważności:</label>
			<input id="data_waznosci" type="date" step="0.01" class="form-control" name="data_waznosci" required>
			<label for="ilosc_opakowan">Ilość opakowań:</label>
			<input id="ilosc_opakowan" type="number" class="form-control" name="ilosc_opakowan" required>
			<label for="pozostalo">Pozostało:</label>
			<input id="pozostalo" type="number" class="form-control" name="pozostalo" required>
			<button name="medicine_id" type="submit" value="<?php echo $chosen; ?>" class="btn btn-primary">Dodaj</button><br>
		</form>
	   </div>
	</div>

<?php } elseif ($_GET['wybrano']==3) {
	
	?>
	<div class="jumbotron">
		<h2><?php echo $addTitle3; ?></h2>
	</div>
	
	<?php	
	if(isset($_POST['cena']) && isset($_POST['data_waznosci']) && isset($_POST['ilosc_opakowan']) && isset($_POST['pozostalo']) && isset($_POST['medicine_id'])) {
		$price = $_POST['cena'];
		$date = $_POST['data_waznosci'];
		$quantity = $_POST['ilosc_opakowan'];
		$quantity2 = $_POST['pozostalo'];
		$medicine_id = $_POST['medicine_id'];
		$mk = $_SESSION['mk_id'];
		$query2 = "INSERT INTO opakowania(cena, data_waznosci, ilosc_opakowan, pozostalo, id_apteczka, id_leki) VALUES('$price', '$date', '$quantity', '$quantity2','$mk', '$medicine_id')";
		$baza->query($query2);
		echo "Lek dodany do apteczki<br>";
	}
	
	
}

require_once 'inc/stopka.php';
?>