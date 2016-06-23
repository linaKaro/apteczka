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
	<h2><?php echo $takeTitle1; ?></h2>
</div>

<div class="page-header">Wyszukaj lek w bazie</div>
<form action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <label for="search_by">Wyszukaj po:</label>
            <select class="form-control" id="search_by" name="search_by">
                <option value="activity">nazwa</option>
                <option value="patient_id">EAN</option>
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
	$input=$_POST['enter_string'];
	$query = "select * from opakowania tab1 JOIN leki tab2 ON tab1.id_leki=tab2.id WHERE tab1.id_apteczka='$id_mk' AND ( tab2.nazwa_leku like '%$input%' or tab2.EAN like '%$input%')";
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

<?php } 
else if($_GET['wybrano']==2) {
	$id_mk = $_SESSION['mk_id'];
	$id_user = $_SESSION['userid'];
	$query1="SELECT * FROM uzytkownicy WHERE id_apteczki='$id_mk' AND (id='$id_user' OR samodzielny=0)";
	$result2 = $baza->query($query1);
?>

<div class="jumbotron">
	<h2><?php echo $takeTitle2; ?></h2>
</div>

	<?php
	$id_mk = $_SESSION['mk_id'];
	$input=$_POST['opakowanie_id'];
	$query = "select * from opakowania tab1 JOIN leki tab2 ON tab1.id_leki=tab2.id WHERE tab1.id_opk='$input'";
	$result = $baza->query($query);
	$row = $result->fetch_assoc();
	$string = $row["nazwa_leku"].", EAN ".$row["EAN"].", ilość ".$row["pozostalo"]." ".$row["jednostka"].", data ważności: ".$row["data_waznosci"];
	?>
	
<div class="page-header">Wybrany lek</div>
<p><b><?php echo "Wybrano: ".$string ?></b></p>
<div class="page-header">Uzupełnij dane</div>

<form action="take_medicine.php?wybrano=3" method="post">
    <div class="row">
        <div class="col-md-3">
        <p><b>Wybierz użytkownika: </b></p>
        <?php while($associated=$result2->fetch_assoc()) {?>
            <div class="radio">
  			<label for="user"><input type="radio" name="user" value="<?php echo $associated["id"]; ?>" checked> <?php echo $associated["nazwa_uzytkownika"]; ?> </label>
			</div>
        <?php }?>
        </div>
        <div class="col-md-3">
            <label for="date">Data wzięcia leku:</label>
            <input class="form-control" type="date" id="date" name="date">
        </div>
        <div class="col-md-3">
            <label for="quantity">Ilość:</label>
            <input class="form-control" type="number" id="quantity" name="quantity">
        </div>
        <div class="col-md-3">
            <br>
            <button type="submit" name="id_medicine" class="btn btn-primary" value="<?php echo $input; ?>">Potwierdź</button>
        </div>
    </div>
</form>
<?php
} else if ($_GET['wybrano']==3) {
	$id_user=$_POST['user'];
	$id_medicine = $_POST['id_medicine'];
	$date = $_POST['date'];
	$quantity = $_POST['quantity'];
	$query2="INSERT INTO leki_pobrane SET data_przyjecia='$date', ilosc='$quantity', id_uzytkownicy='$id_user', id_leki='$id_medicine'";
	$baza->query($query2);
	$query3 = "SELECT pozostalo FROM opakowania WHERE id_opk = '$id_medicine'";
	$prev_quantity=$baza->query($query3)->fetch_assoc();
	$new = $prev_quantity['pozostalo'] - $quantity;
	$query4 = "UPDATE opakowania SET pozostalo='$new' WHERE id_opk = '$id_medicine'";
	$baza->query($query4);
?>

<div class="jumbotron">
	<h2><?php echo $takeTitle3; ?></h2>
</div>

<?php

	echo "DODANO REKORD DO BAZY";
} 
require_once 'inc/stopka.php';
?>