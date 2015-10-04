<?php
	echo 'My cart' . "<br>";
	session_start();
	if (isset($_SESSION['cart'])) {
		$temp_arr = array();
		$temp_arr = $_SESSION['cart'];
		for ($i = 0; $i < count($_SESSION['cart']); $i++) {
			echo $temp_arr[$i] . "<br>";
		}
	}
	
?>