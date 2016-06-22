<?php 
	session_start();
	require_once 'conf/zmienne.php';
	require_once "inc/$lang/teksty.php";
	
	if(!$_SESSION['login'])
		header("Location: myindex.php?wybrano=0&zaloguj_sie=1");
	
	require_once "inc/baza.php";
	require_once "classes/class.user.php";
	require_once "inc/naglowek.php";
    require_once "inc/menu.php"; 
    
    $user = new User($baza);

if($_GET['wybrano']==1){?>

	<div class="jumbotron">
		<h2><?php echo $usersTitleAdd ?></h2>
	</div>
	
	<?php
	if(isset($_POST['username']) && isset($_POST['independent']) && isset($_POST['haslo'])) {
		if(($_POST['haslo']!="" && $_POST['independent']==1)||($_POST['independent']==0)) {
			$added=$user->add_user($_SESSION['mk_id'], $_POST['username'], $_POST['independent'], $_POST['haslo']);
			if($added)
				echo "Dodano nowego użytkownika do bazy";
			else
				echo "Coś poszło nie tak! Użytkownik nie może być dodany.";
		} else 
			echo "Musisz wprowadzić hasło jeśli użytkownik jest niezależny.";
	}

	$mk_id=$_SESSION['mk_id'];
	$query = "SELECT nazwa_uzytkownika, samodzielny FROM uzytkownicy WHERE id_apteczki=$mk_id";
	$result = $baza->query($query);
	?>

	<div class="container">
  	<h3>Lista użytkowników apteczki</h3>
  	<table class="table table-striped">
    	<thead>
      		<tr>
        	<th>Nazwa użytkownika</th>
        	<th>Samodzielny</th>
      		</tr>
    	</thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
    	<td><?php echo $row["nazwa_uzytkownika"]?></td>
    	<td><?php echo $row["samodzielny"]?></td>
    </tr>
    <?php }?>
    </tbody>
    </table><br><br>
	
	<h3>Podaj dane nowego użytkownika:</h3>
	<form role="form" action = "" method="POST">
	<div class="row">
  	<div class="col-md-4">
			<?php echo $lbUsername ?> <br> <input type = "text" class="form-control" name="username" placeholder = " <?php echo $logUsernamepch?>" required>
	</div>
	<div class="col-md-2">
			<?php echo "Użytkownik samodzielny?" ?> <br>
			<label class="radio-inline"><input type="radio" name="independent" value="1" checked>Tak</label>
			<label class="radio-inline"><input type="radio" name="independent" value="0">Nie</label>
	</div>
	<div class="col-md-4">
			<?php echo $lbHaslo ?> <br> <input type = "password" class="form-control" name="haslo" placeholder=" <?php echo $logHaslopch?>">
	</div>
	</div><br>
	<button id="submit" type="submit" value="OK" class="btn btn-default">Zarejestruj</button>
	</form>
	<?php
} else {
?>

<div class="jumbotron">
	<h2><?php echo $usersTitleDelete ?></h2>
</div>

<?php
	if(isset($_POST['user_id'])){
		if($_POST['user_id']==$_SESSION['userid'])
			echo "Nie możesz usunąć zalogowanego użytkownika!";
		else {
			$user_id=$_POST['user_id'];
			$query = "DELETE FROM uzytkownicy WHERE id=$user_id";
			$baza->query($query);
			echo "Użytkownik został usunięty z bazy";
		}
	}
	$mk_id=$_SESSION['mk_id'];
	$query = "SELECT id, nazwa_uzytkownika, samodzielny FROM uzytkownicy WHERE id_apteczki=$mk_id";
	$result = $baza->query($query);
	?>

	<div class="container">
  	<h3>Lista użytkowników apteczki</h3>
  	<table class="table table-striped">
    	<thead>
      		<tr>
        	<th>Nazwa użytkownika</th>
        	<th>Samodzielny</th>
        	<th>Usuń</th>
      		</tr>
    	</thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
    	<td><?php echo $row["nazwa_uzytkownika"]; ?></td>
    	<td><?php echo $row["samodzielny"]; ?></td>
    	<td><form action = "" method = "post">
    	<button type="submit" name="user_id" value="<?php echo $row["id"]; ?>" class="btn btn-primary">Usuń</button>
    	</form></td>
    </tr>
    <?php }?>
    </tbody>
    </table><br><br>
  
<?php
}

require_once 'inc/stopka.php';
?>