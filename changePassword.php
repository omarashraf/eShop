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
          <li style="margin-top: 0px; font-size: 26px;"><a href="cart.php"><i class="fi-shopping-cart"></i></a></li>
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

	<form name="passwordForm" method="post" action="changePassword.php" style="margin-top: 100px;">
		<input type='hidden' name='changed' id='changed' value='1'></input>

		<div class="row">
			<div class="small-5 small-centered columns">
				<?php

					if (isset($_POST['changed'])) {
						if (validNewPassword($_POST['password_new'], $_POST['confirm_new_password']) && $_POST['password_old'] == $_SESSION['loggedin_password']) {

							/*if (strlen($_POST['password_old']) == 0) {
								$pass = $_SESSION['loggedin_password'];
							}
							else {
								$pass = $_POST['password_new'];
							}*/
							//$_SESSION['loggedin'] = $_POST['email'];
							$_SESSION['loggedin_password'] = $_POST['password_new'];

							//$_SESSION['loggedin'] = $_POST['email_edit'];

							$update_editted_user = "UPDATE users SET password = '" . $_POST['password_new'] . "' WHERE id = '" . $_SESSION['loggedin'] . "'";
							mysql_query($update_editted_user);
							header('Location: productshome.php');
						}
						else {
							if ($_POST['password_old'] != $_SESSION['loggedin_password']) {
								echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>Old password is incorrect.</span>
									</div>";
							}
							else {
								echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>New password and confirmation should match, contain at least a number and be at least 8 characters.</span>
									</div>";
							}
						}
					}

				?>
			</div>
		</div>

		<div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-5 columns">
	          <span class="prefix">Old Password</span>
	        </div>
	        <div class="small-7 columns">
	          <input type="password" name="password_old" id="password_old" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
	    <br>
	    <div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-5 columns">
	          <span class="prefix">New Password</span>
	        </div>
	        <div class="small-7 columns">
	          <input type="password" name="password_new" id="password_new" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
		<br>
		<div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-5 columns">
	          <span class="prefix">Confirm New Password</span>
	        </div>
	        <div class="small-7 columns">
	          <input type="password" name="confirm_new_password" id="confirm_new_password" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
	    <br>

		<!--<h2>Change Password</h2>
		<b>Old Password: </b><input type="password" name="password_old" id="password_old"></input><br><br>
		<b>New Password: </b><input type="password" name="password_new" id="password_new"></input><br><br>
		<b>Confirm Password: </b><input type="password" name="confirm_new_password" id="confirm_new_password"></input><br><br>-->
		<br>
		<div class="row" style="margin-left: 925px;">
			<button type="submit" class="button success">Change</button>
		</div>
	</form>

	<script>
		$(document).foundation();
	</script>
</body>
</html>

<?php


?>
