<?php

class User {
	private $db;
	
	public function __construct($db) {
		$this->db=$db;
	}
	
	public function set_database($db_name) {
		$query = "SELECT * FROM apteczka WHERE email='$db_name'";
		$check = $this->db->query($query);
		$rows = $check->num_rows;
		
		if($rows>0) {
			return $registration_error;
		} else {
			$query = "INSERT INTO apteczka SET email='$db_name'";
			$result = $this->db->query($query) or die($connection_error);
			$query = "SELECT * FROM apteczka WHERE email='$db_name'";
			$index = $this->db->query($query);
			$index = mysqli_fetch_array($index);
			return $index['id'];				
		}
	}
	
	public function add_user($db_index, $username, $independent, $password=Null) {
		if($db_index==Null) {
			return false;
		} else {
			$query = "SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika = '$username' AND id_apteczki = '$db_index'";
			$check = $this->db->query($query);
			$rows = $check->num_rows;
			
			if ($rows>0) {
				return false;
			} else {
				if ($password != Null) {
					$password=md5($password);
				}
				$query = "INSERT INTO uzytkownicy SET nazwa_uzytkownika='$username',
				haslo='$password', samodzielny='$independent', id_apteczki='$db_index'";
				$result = $this->db->query($query);
				return true;
			}
		}
	}
	
	public function check_login($db_name, $username, $password) {
		$query = "SELECT * FROM apteczka WHERE email='$db_name'";
		$check = $this->db->query($query);
		$rows = $check->num_rows;
		if($rows==0) {
			return false;
		} else {
			$password = md5($password);
			$check = mysqli_fetch_array($check);
			$number = $check['id'];
			$query1 = "SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika='$username' AND haslo='$password' AND id_apteczki=$number";
			$result = $this->db->query($query1);
			$user_data = mysqli_fetch_array($result);
			$rows1 = $result->num_rows;
			
			if($rows1 == 1) {
				$_SESSION['login']=true;
				$_SESSION['userid']=$user_data['id'];
				$_SESSION['mk_id']=$user_data['id_apteczki'];
				$_SESSION['username']=$user_data['nazwa_uzytkownika'];
				return true;
			} else {
				return false;
			}
		}
	}
	
	public function get_session() {
		return $_SESSION['login'];
	}
	
	public function logout() {
		$_SESSION['login']=false;
		session_destroy();
	}
	
}

?>