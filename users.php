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
				echo $addedTxt;
			else
				echo $somethingWrong;
		} else 
			echo $enterPassword;
	}

	$mk_id=$_SESSION['mk_id'];
	$query = "SELECT nazwa_uzytkownika, samodzielny FROM uzytkownicy WHERE id_apteczki=$mk_id";
	$result = $baza->query($query);
	?>

	<div class="container">
  	<h3><?php echo $userList; ?></h3>
  	<table class="table table-striped">
    	<thead>
      		<tr>
        	<th><?php echo $lbUsername; ?></th>
        	<th><?php echo $independentTxt; ?></th>
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
	
	<h3><?php echo $newUserData; ?></h3>
	<form role="form" action = "" method="POST">
	<div class="row">
  	<div class="col-md-4">
			<?php echo $lbUsername ?> <br> <input type = "text" class="form-control" name="username" placeholder = " <?php echo $logUsernamepch?>" required>
	</div>
	<div class="col-md-2">
			<?php echo "Użytkownik samodzielny?" ?> <br>
			<label class="radio-inline"><input type="radio" name="independent" value="1" checked><?php echo $yes; ?></label>
			<label class="radio-inline"><input type="radio" name="independent" value="0"><?php echo $no; ?></label>
	</div>
	<div class="col-md-4">
			<?php echo $lbHaslo ?> <br> <input type = "password" class="form-control" name="haslo" placeholder=" <?php echo $logHaslopch?>">
	</div>
	</div><br>
	<button id="submit" type="submit" value="OK" class="btn btn-default"><?php echo $commitRegister; ?></button>
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
  	<h3><?php echo $userList; ?></h3>
  	<table class="table table-striped">
    	<thead>
      		<tr>
        	<th><?php echo $lbUsername; ?></th>
        	<th><?php echo $independentTxt; ?></th>
        	<th><?php echo $delete; ?></th>
      		</tr>
    	</thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
    	<td><?php echo $row["nazwa_uzytkownika"]; ?></td>
    	<td><?php echo $row["samodzielny"]; ?></td>
    	<td><form action = "" method = "post">
    	<button type="submit" name="user_id" value="<?php echo $row["id"]; ?>" class="btn btn-primary"><?php echo $delete; ?></button>
    	</form></td>
    </tr>
    <?php }?>
    </tbody>
    </table><br><br>
  
<?php
}

require_once 'inc/stopka.php';
?>