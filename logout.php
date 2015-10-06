<?php
	session_start();
	if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
<<<<<<< HEAD
		$temp = $_SESSION['cart'];
		session_destroy();
	}
	session_start();
	//$_SESSION['cart'] = $temp;
	header('Location: productshome.php');
?>
