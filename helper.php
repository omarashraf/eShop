<?php
	include('selectDB.php');


	// 'users' table's data.
	
	//$users_email_arr = array();
	//$users_password_arr = array();
	

	// 
	function loginEmail() {

	}

	function loginPassword() {

	}

	function login($g_email, $g_password) {
		$select_users_sql = "SELECT * FROM users";
		$res = mysql_query($select_users_sql);
		if (mysql_num_rows($res) > 0) {
			while ($temp = mysql_fetch_assoc($res)) {
				if ($g_email == $temp['email'] && $g_password == $temp['password']) {
					return true;
				}
			}
			return false;
		}
	}

	function fetchUserData($id) {
		$fetch_sql = "SELECT * FROM users WHERE id = '" . $id . "'";
		$res = mysql_query($fetch_sql);
		$data_array = array();
		if (mysql_num_rows($res) > 0) {
			while ($temp = mysql_fetch_assoc($res)) {
				array_push($data_array, $temp['email']);
				if ($temp['last_name'] == 'Anonymous') {
					array_push($data_array, "*" . $temp['last_name'] . "*");	
				}
				else {
					array_push($data_array, $temp['last_name']);
				}
				if ($temp['first_name'] == 'Anonymous') {
					array_push($data_array, "*" . $temp['first_name'] . "*");					
				}
				else {
					array_push($data_array, $temp['first_name']);				
				}
				
			}
		}
		return $data_array;
	}

	function validFname($fname) {
		if (strlen($fname) == 0 || (!strpos($fname, ' ') && trim($fname))) {
			return true;
		}
		return false;
	}

	function validLname($lname) {
		if (strlen($lname) == 0 || (!strpos($lname, ' ') && trim($lname))) {
			return true;
		}
		return false;
	}

	function validEmail($email) {
		if (strpos($email, '@') && !strpos($email, ' ') && trim($email)) {
			return true;
		}
		else {
			return false;
		}
	}

	function dupEmail($email) {
		$select_users_sql = "SELECT * FROM users";
		$res = mysql_query($select_users_sql);
		if (mysql_num_rows($res) > 0) {
			while ($temp = mysql_fetch_assoc($res)) {
				if ($email == $temp['email']) {
					return true;
				}
			}
			return false;
		}
	}

	/*function validOldPassword($password) {
		session_start();
		if ($_SESSION['loggedin_password'] == $password) {
			return true;
		}
		else {
			return false;
		}
	}*/

	function validNewPassword($password, $confirmed) {
		if  ($password == $confirmed && strlen($password) > 7 && 
			(strpos($password, '1') || strpos($password, '2') || strpos($password, '3') || strpos($password, '4') || strpos($password, '5') ||
			 strpos($password, '6') || strpos($password, '7') || strpos($password, '8') || strpos($password, '9') || strpos($password, '0'))
			) {
			return true;
		}
		else {
			return false;
		}
	}

	/*function validatePasswords($old, $new, $confirmed) {
		if (strlen($old) == 0 && strlen($new) == 0 && strlen($confirmed) == 0) {
			return true;
		}
		session_start();
		if ($_SESSION['loggedin_password'] == $old && 
			((strlen($new) == 0 && $new = $confirmed)|| ($new == $confirmed && strlen($new) > 7 && 
			(strpos($new, '1') || strpos($new, '2') || strpos($new, '3') || strpos($new, '4') || strpos($new, '5') ||
			 strpos($new, '6') || strpos($new, '7') || strpos($new, '8') || strpos($new, '9') || strpos($new, '0'))
			))) {
			return true;
		}
		else {
			return false;
		}
	}*/

?>