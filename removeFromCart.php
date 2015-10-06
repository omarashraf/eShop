<?php
	session_start();
	if (isset($_GET['id'])) {
		$temp_arr = $_SESSION['cart'];
		for ($i = 0; $i < count($temp_arr); $i++) {
			if ($i == $_GET['id']) {
				$temp_arr[$i] = -1;
			}
		}
	}
	$_SESSION['cart'] = array();
	for ($i = 0; $i < count($temp_arr); $i++) {
		if ($temp_arr[$i] != -1) {
			array_push($_SESSION['cart'], $temp_arr[$i]);
		}
	}
	//print_r($_SESSION['cart']);
	header("Location: cart.php");
	
?>