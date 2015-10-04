<?php
	session_start();
	if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
		session_destroy();	
	}
	header('Location: productshome.php');
?>