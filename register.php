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

	<script>
		/*function check() {
			var email = document.getElementById('email').value;
			var password = document.getElementById('password').value;
			if (email.length == 0 || !email.trim()) {
				alert('Email shouldn\'t be blank.');
			}
			else {
				if (password.length == 0) {
					alert('Password shouldn\'t be empty.' );
				}
			}
		}*/
	</script>
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

	<div class="element" style="margin-left: 865px; margin-top: 75px; font-size: 30px;"></div>

	<form enctype='multipart/form-data' method="post" style="margin-top: 30px;">
		<input type='hidden' name='registered' id='registered' value='1'></input>
		<div class="row">
			<div class="row">
				<div class="small-5 small-centered columns"><input type="text" name="fname" id="fname" class="error" placeholder="First Name" style="font-size: 20px;"
					value="<?php if(isset($_POST['registered'])) { echo $_POST['fname']; } ?>"></input>
					<?php
						//include('helper.php');
						if (isset($_POST['registered'])) {
							if (!validFname($_POST['fname'])) {
								echo "<small class='error'>Name shouldn't contain spaces</small>";
							}
						}
					?>
				</div>
		</div>
			<br>
			<div class="row">
				<div class="small-5 small-centered columns"><input type="text" name="lname" id="lname" class="error" placeholder="Last Name" style="font-size: 20px;"
					value="<?php if(isset($_POST['registered'])) { echo $_POST['lname']; } ?>"></input>
					<?php
						if (isset($_POST['registered'])) {
							if (!validFname($_POST['lname'])) {
								echo "<small class='error'>Name shouldn't contain spaces</small>";
							}
						}
					?>
				</div>
			</div>
			<br>

			<div class="row">
				<div class="small-5 small-centered columns"><input type="text" name="email" id="email" class="error" placeholder="Email*" style="font-size: 20px;"
					value="<?php if(isset($_POST['registered'])) { echo $_POST['email']; } ?>"></input>
					<?php
						if (isset($_POST['registered'])) {
							if (strlen($_POST['email']) == 0) {
								echo "<small class='error'>Required entry</small>";
							}
							else {
								if (!validEmail($_POST['email'])) {
									echo "<small class='error'>Invalid entry</small>";
								}
								else {
									if (dupEmail($_POST['email'])) {
										echo "<small class='error'>Email already does exist</small>";
									}
								}
							}
						}
					?>
				</div>
			</div>

			<br>
			<div class="row">
				<div class="small-5 small-centered columns"><input name="image" accept="image/jpeg" type="file" class="button secondary"></div>
			</div>
			<br>
			<div class="row">
				<div class="small-5 small-centered columns"><input type="password" name="password" id="password" class="error" placeholder="Password*" style="font-size: 20px;"></input>
					<?php
						if (isset($_POST['registered'])) {
							if (!validNewPassword($_POST['password'], $_POST['confirm_password'])) {
								echo "<small class='error'>Invalid entry</small>";
							}
						}
					?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="small-5 small-centered columns"><input type="password" name="confirm_password" id="confirm_password" class="error" placeholder="Confirm Password*" style="font-size: 20px;"></input>
					<?php
						if (isset($_POST['registered'])) {
							if (!validNewPassword($_POST['password'], $_POST['confirm_password'])) {
								echo "<small class='error'>Invalid entry</small>";
							}
						}
					?>
				</div>
			</div>
			<br>
			<div class="row" style="margin-left: 435px;">
				<input type="submit" onclick="check()" class="button success" value="Register">
			</div>
		</div>
	</form>

	<script>
		$(document).foundation();
		$(function(){
		    $(".element").typed({
		      strings: ["Register now"],
		      typeSpeed: 0
		    });
		});
	</script>
</body>
</html>
	<?php
		//include('helper.php');
		if (isset($_POST['registered'])) {
			if (validEmail($_POST['email']) && validNewPassword($_POST['password'], $_POST['confirm_password']) && validFname($_POST['fname'])
				&& validLname($_POST['lname'])) {
				if ($_POST['fname'] == '') {
					$f_name = 'Anonymous';
				}
				else {
					$f_name = ucfirst(strtolower($_POST['fname']));
				}

				if ($_POST['lname'] == '') {
					$l_name = 'Anonymous';
				}
				else {
					$l_name = ucfirst(strtolower($_POST['lname']));
				}

				$insert_user_sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('" . $f_name . "', '" . $l_name .
								   "', '" . strtolower($_POST['email']) . "', '" . $_POST['password'] . "')";
				if (mysql_query($insert_user_sql)) {
					//echo "Insertion is done";
					session_start();
					if (isset($_SESSION['loggedin']) && isset($_SESSION['loggedin_password'])) {
						session_destroy();
					}
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
				else {
					//die (mysql_error());
					header('Location: register.php');
				}

			}
		}
	?>
