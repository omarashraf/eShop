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
		$data_arr = fetchUserData($_SESSION['loggedin']);
    if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
      $user_id = $_SESSION['loggedin'];
    }
    else {
      $user_id = 0;
			header('Location: login.php');
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

	<form name="editForm" enctype='multipart/form-data' method="post" action="editProfile.php" style="margin-top: 100px;">
		<input type='hidden' name='editted' id='editted' value='1'></input>

		<div class="row">
			<div class="small-5 small-centered columns">
				<?php
					$select_users_sql = "SELECT * FROM users WHERE id = '" . $_SESSION['loggedin'] . "'";
					$res = mysql_query($select_users_sql);
					if (mysql_num_rows($res) > 0) {
						while ($temp = mysql_fetch_assoc($res)) {
							$current_email = $temp['email']	;
						}
					}
					if (isset($_POST['editted'])) {
						if (validEmail($_POST['email_edit']) && validLname($_POST['lname_edit']) && validFname($_POST['fname_edit']) && (!dupEmail($_POST['email_edit']) || $current_email == $_POST['email_edit'])) {
							$update_editted_user = "UPDATE users SET first_name = '" . $_POST['fname_edit'] ."', last_name = '" . $_POST['lname_edit'] .
							"', email = '" . $_POST['email_edit'] . "' WHERE id = '" . $_SESSION['loggedin'] . "'";
							mysql_query($update_editted_user);

							if ($_FILES["image"]["error"] > 0) 
						      {
						         echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
						         echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
						       }
						       else
						       {
						         move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $_FILES["image"]["name"]);
						         echo"<font size = '5'><font color=\"#0CF44A\">SAVED<br>";

						         $file="images/".$_FILES["image"]["name"];
						         $sql="UPDATE users SET avatar = '$file' WHERE id = '" . $_SESSION['loggedin'] . "'";

						         if (!mysql_query($sql))
						         {
						            die('Error: ' . mysql_error());
						         }
						       }

							header('Location: productshome.php');
						}
						elseif (!validFname($_POST['fname_edit'])) {
							echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>First name shouldn't contain spaces.</span>
									</div>";
						}
						elseif (!validLname($_POST['lname_edit'])) {
							echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>Last name shouldn't contain spaces.</span>
									</div>";
						}
						elseif (!validEmail($_POST['email_edit'])) {
							echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>Email is not valid.</span>
									</div>";
						}
						else {
							echo "<div data-alert class='alert-box alert'>
									  <a href='login.php'' class='close'><b>&times;</b></a>
									  <span>Email already exists.</span>
									</div>";
						}
					}
				?>
			</div>
		</div>

		<div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-4 columns">
	          <span class="prefix">First name</span>
	        </div>
	        <div class="small-8 columns">
	          <input type="text" name="fname_edit" id="fname_edit" value="<?php echo array_pop($data_arr) ?>" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
	    <br>
	    <div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-4 columns">
	          <span class="prefix">Last name</span>
	        </div>
	        <div class="small-8 columns">
	          <input type="text" name="lname_edit" id="lname_edit" value="<?php echo array_pop($data_arr) ?>" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
		<br>
		<div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-4 columns">
	          <span class="prefix">Email</span>
	        </div>
	        <div class="small-8 columns">
	          <input type="text" name="email_edit" id="email_edit" value="<?php echo array_pop($data_arr) ?>" style="font-size: 20px;"></input>
	        </div>
	      </div>
	    </div>
	    <br>
		<div class="large-3 large-centered columns">
	      <div class="row collapse prefix-radius">
	        <div class="small-4 columns">
	          <span class="prefix">Browse</span>
	        </div>
	        <div class="small-8 columns">
	        	<input name="image" accept="image/jpeg" type="file">
	        </div>
	      </div>
	    </div>

		<!--<h2>Change Password</h2>
		<b>Old Password: </b><input type="password" name="password_old" id="password_old"></input><br><br>
		<b>New Password: </b><input type="password" name="password_new" id="password_new"></input><br><br>
		<b>Confirm Password: </b><input type="password" name="confirm_new_password" id="confirm_new_password"></input><br><br>-->
		<br>
		<div class="row" style="margin-left: 925px;">
			<button type="submit" class="button success">Edit</button>
		</div>
	</form>

	<script>
    $(document).foundation();
  </script>

</body>
</html>

<?php
	/*if (isset($_POST['editted'])) {
		//if (validEmail($_POST['email_edit']) /*&& validatePasswords($_POST['password_old'], $_POST['password_new'], $_POST['confirm_new_password'])) {
			/*if (strlen($_POST['password_old']) == 0) {
				$pass = $_SESSION['loggedin_password'];
			}
			else {
				$pass = $_POST['password_new'];
			}*/
			//$_SESSION['loggedin'] = $_POST['email'];
			//$_SESSION['loggedin_password'] = $pass;

			//$_SESSION['loggedin'] = $_POST['email_edit'];

		/*	$update_editted_user = "UPDATE users SET first_name = '" . $_POST['fname_edit'] ."', last_name = '" . $_POST['lname_edit'] .
			"', email = '" . $_POST['email_edit'] . "' WHERE id = '" . $_SESSION['loggedin'] . "'";
			mysql_query($update_editted_user);
			header('Location: homepage.php');
		}
		else {
			header('Location: editProfile.php');
		}*/
	//}
?>
