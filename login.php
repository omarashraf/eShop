
<html>
<head>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation-icons.css" />
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
	<!-- This is how you would link your custom stylesheet -->
	<!--<link rel="stylesheet" href="css/app.css">-->
	<script src="js/vendor/modernizr.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="typed.js-master/js/typed.js"></script>
	<script>
		$(document).ready(function(){
			$(document).foundation();
		});
		$(function(){
		    $(".element").typed({
		      strings: ["You can buy any of the listed products."+ "<br>" +"Login now."],
		      typeSpeed: 0
		    });
		});
	</script>
</head>
<body>
	<!-- Nav bar -->
  <div class="contain-to-grid sticky">
    <nav style="color: white;" class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
      <ul class="inline-list" style="margin-top: 10px;">
        <li style="padding-right: 60px;"><a style="color: white;" href="productshome.php">eShop</a></li>
        <li style="padding-right: 20px;"><a href="productshome.php
          ">Home</a></li>
        <li style="padding-right: 20px;"><a href="productshome.php">Products</a></li>
        <li style="padding-right: 20px;"><a href="#">Profile</a></li>
        <li style="margin-top: -10px; float: right;">
        <!--<li style="padding-right: 20px;"><a href="#">Profile</a></li>-->
        <li style="margin-top: -7.5px; font-size: 26px;"><a href="cart.php"><i class="fi-shopping-cart"></i></a></li>
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

	<div class="element" style="margin-top: 175px; font-size: 30px; text-align: center;"></div>
	<form action="login.php" method="post" name="loginForm" style="margin-top: 30px;">
		<input type='hidden' name='submitted' id='submitted' value='1'></input>
		<div class="row">
			<div class="small-5 small-centered columns">
				<?php
					include('helper.php');
					if (isset($_POST['submitted'])) {
						if (login($_POST['email'], $_POST['password'])) {
							session_start();
							$select_users_sql = "SELECT * FROM users";
							$res = mysql_query($select_users_sql);
							if (mysql_num_rows($res) > 0) {
								while ($temp = mysql_fetch_assoc($res)) {
									if ($temp['email'] == $_POST['email']) {
										$_SESSION['loggedin'] = $temp['id'];
									}
								}
							}
							$_SESSION['loggedin_password'] = $_POST['password'];
							header('Location: productshome.php');
						}
						else {
							//echo "<small class='error'>Invalid entry</small>";
							echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>Wrong email/password combination</span>
									</div>";
						}
					}
				?>
			</div>
		</div>
		
		<div class="row">
			<div class="small-5 small-centered columns"><input type="text" name="email" id="email" class="error" placeholder="Email" style="font-size: 20px;"></input></div>
		</div>
		<br>
		<div class="row">
			<div class="small-5 small-centered columns"><input type="password" name="password" id="password" placeholder="Password" style="font-size: 20px;"></input></div>
		</div>
		<br>
		<div class="row" style="margin-left: 905px;">
			<button type="submit" class="button success">Login</button>
		</div>
	</form>
</body>
</html>

<?php

?>