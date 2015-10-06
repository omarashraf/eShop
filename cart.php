<html>
<head>
	<link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/foundation-icons.css">

  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/modernizr.js"></script>
  <script src="js/vendor/placeholder.js"></script>
  <script src="js/vendor/fastclick.js"></script>
  <script src="js/foundation.min.js"></script>
  <script src="typed.js-master/js/typed.js"></script>
</head>

<body>

	<?php
    session_start();

    include('helper.php');
    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
      $user_id = $_SESSION['loggedin'];
    }
    else {
      $user_id = 0;
    }
  ?>

	<!-- Nav bar -->
		<div class="contain-to-grid sticky">
			<nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
				<ul class="inline-list" style="margin-top: 10px;">
					<li style="padding-right: 60px;"><a style="color: white;" href="productshome.php">eShop</a></li>
					<li style="padding-right: 20px;"><a href="productshome.php">Products</a></li>
					<li style="padding-right: 20px;"><a href="editProfile.php">Profile</a></li>
					<li style="margin-top: 0; font-size: 26px;"><a href="cart.php"><i class="fi-shopping-cart"></i></a></li>
					<?php
							if (isset($_SESSION['loggedin'])) {
								$select_users_sql = "SELECT * FROM users WHERE id = '" . $_SESSION['loggedin'] . "'";
								$res = mysql_query($select_users_sql);
								if (mysql_num_rows($res)) {
									while ($temp = mysql_fetch_assoc($res)) {
										if ($temp['id'] == $_SESSION['loggedin']) {
											$current_user = $temp['first_name'];
										}
									}
								}
								else {
									die (mysql_error());
								}
								echo "<li style=\"margin-top: -11px; float: right;\">
												<button href=\"#\" data-dropdown=\"drop1\" aria-controls=\"drop1\" aria-expanded=\"false\" class=\"button round dropdown\">" . $current_user . "</button><br>
													<ul id=\"drop1\" data-dropdown-content class=\"f-dropdown\" aria-hidden=\"true\">
														<li><a href=\"editProfile.php\">Edit Profile</a></li>
														<li><a href=\"changePassword.php\">Change Password</a></li>
														<li><a href=\"cart.php\">My Cart</a></li>
														<li><a href=\"history.php?id=" . $user_id . "\">My History</a></li>
														<li><a href=\"logout.php\">Logout</a></li>
													</ul>
											</li>";
							}
					?>
				</ul>
			</nav>
		</div>
		<br>

  <!--<div style="float: right;">
  		<a href="productshome.php" class="button success">Add items</a>
  </div>-->



	<script>
    $(document).foundation();
  </script>



<?php
	//session_start();
	if (isset($_SESSION['cart'])) {
		$temp_arr = array();
		$temp_arr = $_SESSION['cart'];
		if (count($temp_arr) > 0) {
			echo '<div class="row">
				  	<h1 style="text-align: center;">My Cart</h1>
				  	<div class="small-12 small-centered columns">
				  		<table width="100%">
				  			<thead>
				  				<tr>
				  					<th>Name</th>
				  					<th>Description</th>
				  					<th>Price</th>
				  					<th></th>
				  				</tr>
				  			</thead>
				   </div>';
			for ($i = 0; $i < count($_SESSION['cart']); $i++) {
				//echo $temp_arr[$i] . "<br>";
				$products_display_sql = "SELECT * FROM products WHERE id = '" . $temp_arr[$i] . "'";
				$res = mysql_query($products_display_sql);
				echo '';
				if (mysql_num_rows($res) > 0) {
					while($temp = mysql_fetch_assoc($res)) {
						echo '<tr>
					  				<th>' . $temp['pName'] . '</th>
					  				<th>' . $temp['description'] . '</th>
					  				<th>' . $temp['price'] . '</th>
					  				<th><a href=\'removeFromCart.php?id=" . $i . "\'>Remove</a></th>
					  			</tr>';
						break;
					}
				}
			}
			echo '</table>
				</div>';
		}
		else {
			echo '<div class="element" style="text-align: center; font-size: 40px; margin-top: 300px;"></div>' . '<br>';
			echo '<div style="text-align: center;"><a href="productshome.php" class="button alert">Add now</a></div>';
			echo '<script>
					$(document).foundation();
					$(function(){
					    $(".element").typed({
					      strings: ["Your cart is now empty. You can add items through our products page."],
					      typeSpeed: 0
					    });
					});
				</script>';
		}
	}

?>

</body>
</html>
  <!--<form name="checkoutForm" action="checkout.php" method="post">
    <input type='hidden' name='checkedout' id='checkedout' value='1'></input>
    <button type="submit" class="button success">Checkout</button>
  </form>-->


<?php
	$temp_arr = array();

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}

	$temp_arr = $_SESSION['cart'];
	if (count($temp_arr) != 0) {
		if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
			echo "<a href=\"checkout.php\" onclick=\"confirm()\" class=\"button success\" style='float: right; margin-right: 35px;'>Checkout</a>";
			echo "<a href=\"productshome.php\" class=\"button alert\" style='float: right; margin-right: 5px;'>Add items</a>";
			echo "<script>
							function confirm() {
							    alert(\"You have successfully purchased the items!\");
							}
						</script>";
		}
		else {
			echo "<a href=\"checkout.php\" class=\"button success\" style='float: right;'>Checkout</a>";
			echo "<a href=\"productshome.php\" class=\"button alert\" style='float: right; margin-right: 5px;'>Add items</a>";
		}
	}

?>
