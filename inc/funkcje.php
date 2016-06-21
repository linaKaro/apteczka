<?php 

function sprawdz_login_haslo($login, $pwd) {
	if ($pwd == 'biomedyczna')
		return true;
	else 
		return false;
}

?>