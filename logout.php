<?php
	session_start();
	if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
		// /$temp = $_SESSION['cart'];
		session_destroy();	
	}

	header('Location: productshome.php');
?>