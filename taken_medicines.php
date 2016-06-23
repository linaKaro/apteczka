<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
	require_once "classes/class.user.php";
	require_once "inc/naglowek.php";
    require_once "inc/menu.php"; ?>

	<div class="jumbotron">
		<h2><?php echo $takenTitle; ?></h2>
	</div>
	<div class="page-header">Wybierz użytkownika</div>

<?php
	$mk_id = $_SESSION['mk_id'];
	$user = $_SESSION['userid'];
	$query = "SELECT * FROM uzytkownicy WHERE id_apteczki='$mk_id' AND (id='$user' OR samodzielny=0)";
	$users_data = $baza->query($query);
?>

	<div class="container">
  	<h3>Lista użytkowników apteczki</h3>
  	<table class="table table-striped">
    	<thead>
      		<tr>
        	<th>Nazwa użytkownika</th>
        	<th>Wybierz</th>
      		</tr>
    	</thead>
    <tbody>
    <?php while ($row = $users_data->fetch_assoc()) { ?>
    <tr>
    	<td><?php echo $row["nazwa_uzytkownika"]?></td>
    	<td><form action = "" method = "post">
    	<button type="submit" name="user_id" value="<?php echo $row["id"]; ?>" class="btn btn-primary">Wybierz</button>
    	</form>
    	</td>
    </tr>
    <?php }?>
    </tbody>
    </table>
<?php
	if(isset($_POST['user_id'])) {
		$user_id=$_POST['user_id'];
		$query="SELECT * FROM leki_pobrane tab1 JOIN leki tab2 ON tab1.id_leki=tab2.id 
			WHERE tab1.id_uzytkownicy='$user_id' ORDER BY tab1.data_przyjecia DESC";
		$users_medicine=$baza->query($query); ?>
		<br>
		<h3>Leki przyjmowane przez tego użytkownika</h3>
		<table class="table table-striped">
    	<thead>
      		<tr>
        	<th>Nazwa leku</th>
        	<th>Data</th>
        	<th>Ilość</th>
        	<th>Substancja czynna</th>
      		</tr>
	    	</thead>
	    <tbody>
	    <?php while ($row=$users_medicine->fetch_assoc()) { ?>
	    <tr>
	    	<td><?php echo $row["nazwa_leku"]?></td>
	    	<td><?php echo $row["data_przyjecia"]?></td>
	    	<td><?php echo $row["ilosc"]?></td>
			<td><?php echo $row["substancja_czynna"]?></td>
	    </tr>
	    <?php }?>
	    </tbody>
	    </table> <?php 
	}


	require_once 'inc/stopka.php';
?>