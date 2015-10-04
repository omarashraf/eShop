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
		      strings: ["Register now"],
		      typeSpeed: 0
		    });
		});
	</script>
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
	<div class="icon-bar six-up">
	  <a class="item">
	    <i class="fi-home"></i>
	  </a>
	  <a class="item">
	    <i class="fi-bookmark"></i>
	  </a>
	  <a class="item">
	    <i class="fi-info"></i>
	  </a>
	  <a class="item">
	    <i class="fi-mail"></i>
	  </a>
	  <a class="item">
	    <i class="fi-like"></i>
	  </a>
	  <a class="item">
	    <i class="fi-address-book"></i>
	  </a>
	</div>
	 
	<div class="element" style="margin-left: 865px; margin-top: 75px; font-size: 30px;"></div>

	<form name="registerForm" method="post" style="margin-top: 30px;">
		<input type='hidden' name='registered' id='registered' value='1'></input>
		<div class="row">
			<div class="row">
				<div class="small-5 small-centered columns"><input type="text" name="fname" id="fname" class="error" placeholder="First Name" style="font-size: 20px;"
					value="<?php if(isset($_POST['registered'])) { echo $_POST['fname']; } ?>"></input>
					<?php
						include('helper.php');
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
				<div class="small-5 small-centered columns"><input type="file" class="button secondary"></input></div>
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
				<button type="submit" onclick="check()" class="button success">Register</button>
			</div>
		</div>
	</form>

	
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
					header('Location: homepage.php');
				}
				else {
					//die (mysql_error());
					header('Location: register.php');
				}
				
			}
		}
	?>