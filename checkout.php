<?php
	include('helper.php');
	session_start();

	if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
		$user_id = $_SESSION['loggedin'];

		$temp_arr = $_SESSION['cart'];
		for ($i = 0; $i < count($temp_arr); $i++) {
			$products_sql = "SELECT * FROM products WHERE id = '" . $temp_arr[$i] . "'";
			$res = mysql_query($products_sql);
			if (mysql_num_rows($res) > 0) {
				while ($temp = mysql_fetch_assoc($res)) {
					$stock_updated = $temp['stock'] - 1;
					$update_products_sql = "UPDATE products SET stock = '" . $stock_updated . "' WHERE id = '" . $temp_arr[$i] . "'";
					mysql_query($update_products_sql);
					$history_insert_sql = "INSERT INTO history (userId, productId) VALUES ('" . $_SESSION['loggedin'] . "', '" . $temp_arr[$i] . "')";
					mysql_query($history_insert_sql);
				}
			}
		}
		$_SESSION['cart'] = array();
		header("Location: cart.php");
	}
	else {
		header('Location: login.php');
	}
?>
