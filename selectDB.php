<?php
	
	function selectDB() {
		$conn = mysql_connect('localhost', 'root', '');
		/*if ($conn) {
			echo "Connection established" . "<br>";
		}
		else {
			die("Connection not established: " . mysql_error() . "<br>");
		}*/

		$db_selected = mysql_select_db('eShop');
		/*if($db_selected) {
			echo "Selection succeeded" . "<br>";
		}
		else {
			die("Selection didn't succeed " . mysql_error() . "<br>");
		}*/
	}
	selectDB();

	/*$query = "SELECT * FROM books";
	$res = mysql_query($query);
	if (mysql_num_rows($res) > 0) {
		while ($temp = mysql_fetch_assoc($res)) {
			echo "id: " . $temp['ID'] . ", title: " . $temp['Title'] . ", price: " . $temp['Price'] . "<br>";
		}
	}
	else {
		echo "No data!";
	}*/

?>