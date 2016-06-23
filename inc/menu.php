<nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php"><?php echo $menuStart; ?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuUsers; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="users.php?wybrano=1"><?php echo $menuUsersAdd; ?></a></li>
                  <li><a href="users.php?wybrano=2"><?php echo $menuUsersDelete; ?></a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuBase; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="wyswietl_leki.php?wybrano=3"><?php echo $menuBaseSearch; ?></a></li>	
                  <li><a href="z_bazy.php?wybrano=4"><?php echo $menuBaseAdd; ?></a></li>
                  <li><a href="usun_lek.php?wybrano=5"><?php echo $menuBaseDelete; ?></a></li>
                  </ul>
              </li>
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menuMyMK; ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="mk_show.php"><?php echo $menuInMK; ?></a></li>
                  <li><a href="add_medicine.php?wybrano=1"><?php echo $menuMyMKAdd; ?></a></li>	
                  <li><a href="delete_medicine.php"><?php echo $menuMyMKDelete; ?></a></li>
                  <li><a href="take_medicine.php?wybrano=1"><?php echo $menuMyMKTake; ?></a></li>
                  <li><a href="taken_medicines.php"><?php echo $menuMyMKTaken; ?></a></li>
                  </ul>
              </li>
              <li><a href=""><?php echo $menuStatistics; ?></a></li>
			  <li><a href="myindex.php?wybrano=0&wyloguj=1"><?php echo $menuLogOut; ?></a></li>
			
			</ul>
		</div>
	</div>
</nav>
<div class="container theme-showcase" role="main">