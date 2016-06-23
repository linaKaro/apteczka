<?php

session_start();
require_once 'conf/zmienne.php';
require_once "inc/$lang/teksty.php";
require_once "inc/baza.php";
require_once "inc/naglowek.php";
require_once "inc/menu.php";


if(!$_SESSION['login'])
	header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
?>

<div class="jumbotron">
	<h2><?php echo $showTitle; ?></h2>
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
$id_mk = $_SESSION['mk_id'];
$query = "select * from opakowania tab1 JOIN leki tab2 ON tab1.id_leki=tab2.id WHERE tab1.id_apteczka='$id_mk'";
if(isset($_POST['enter_string']) && $_POST['enter_string'] != "") {
	$search_by=$_POST['search_by'];
	$input=$_POST['enter_string'];
	$query = "select * from opakowania tab1 JOIN leki tab2 ON tab1.id_leki=tab2.id WHERE tab1.id_apteczka='$id_mk' AND ".$search_by." like '%$input%')";
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
        	<th>pozostało</th>
        	<th>jednostka</th>
        	<th>substancja czynna</th>
        	<th>data ważności</th>
        	<th>cena</th>
        	<th>wybierz</th>
      		</tr>
    	</thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
    	<td><?php echo $row["nazwa_leku"]; ?></td>
    	<td><?php echo $row["EAN"]; ?></td>
    	<td><?php echo $row["pozostalo"]; ?></td>
    	<td><?php echo $row["jednostka"]; ?></td>
    	<td><?php echo $row["substancja_czynna"]; ?></td>
    	<td><?php echo $row["data_waznosci"]; ?></td>
    	<td><?php echo $row["cena"]; ?></td>
    	<td><form action = "take_medicine.php?wybrano=2" method = "post">
    	<button type="submit" id="opakowanie_id" name="opakowanie_id" value="<?php echo $row["id_opk"]; ?>" class="btn btn-primary">Wybierz</button>
    	</form>
    	</td>
    </tr>
    <?php }?>
    </tbody>
    </table>
</div>

<?php
require_once 'inc/stopka.php';
?>