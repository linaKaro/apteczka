<nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">DomowaApteczka</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="myindex.php?wybrano=0"><?php echo $menuLog; ?></a></li>
              <li><a href="http://mysql.agh.edu.pl/phpMyAdmin" target="_blank">phpMyAdmin</a></li>
			  <li><a href="wyswietl_leki.php?wybrano=2"><?php echo $menuWyswietl; ?></a></li>
			  <li><a href="z_bazy.php?wybrano=3"><?php echo $menuDodaj; ?></a></li>
			<li><a href="usun_lek.php?wybrano=4"><?php echo $menuUsun; ?></a></li>
			<li><a href="dokumentacja.php?wybrano=5"><?php echo $menuDok; ?></a></li>
			<li><a href="myindex.php?wybrano=0&wyloguj=1"><?php echo $menuWyloguj; ?></a></li>
			
			</ul>
		</div>
	</div>
</nav>