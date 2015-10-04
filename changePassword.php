<html>

<head>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation-icons.css" />
	<script src="js/foundation.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
	<!-- This is how you would link your custom stylesheet -->
	<!--<link rel="stylesheet" href="css/app.css">-->
	<script src="js/vendor/modernizr.js"></script>
	<script>
		$(document).ready(function(){
			$(document).foundation();
		});
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

	<form name="passwordForm" method="post" action="changePassword.php" style="margin-top: 100px;">
		<input type='hidden' name='changed' id='changed' value='1'></input>

		<div class="row">
			<div class="small-5 small-centered columns">
				<?php
					include('helper.php');
					session_start();	
					if (isset($_POST['changed'])) {
						if (validNewPassword($_POST['password_new'], $_POST['confirm_new_password']) && $_POST['password_old'] == $_SESSION['loggedin_password']) {
							
							/*if (strlen($_POST['password_old']) == 0) {
								$pass = $_SESSION['loggedin_password'];
							}
							else {
								$pass = $_POST['password_new'];
							}*/
							//$_SESSION['loggedin'] = $_POST['email'];
							//$_SESSION['loggedin_password'] = $pass;

							//$_SESSION['loggedin'] = $_POST['email_edit'];

							$update_editted_user = "UPDATE users SET password = '" . $_POST['password_new'] . "' WHERE id = '" . $_SESSION['loggedin'] . "'";
							mysql_query($update_editted_user);
							header('Location: homepage.php');
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
</body>
</html>

<?php
	
	if (isset($_POST['editted'])) {
		if (validNewPassword($_POST['password_new'], $_POST['confirm_new_password']) && $_POST['password_old'] == $_SESSION['loggedin_password']) {
			
			/*if (strlen($_POST['password_old']) == 0) {
				$pass = $_SESSION['loggedin_password'];
			}
			else {
				$pass = $_POST['password_new'];
			}*/
			//$_SESSION['loggedin'] = $_POST['email'];
			//$_SESSION['loggedin_password'] = $pass;

			//$_SESSION['loggedin'] = $_POST['email_edit'];

			$update_editted_user = "UPDATE users SET first_name = '" . $_POST['fname_edit'] ."', last_name = '" . $_POST['lname_edit'] . 
			"', email = '" . $_POST['email_edit'] . "' WHERE id = '" . $_SESSION['loggedin'] . "'";
			mysql_query($update_editted_user);
			header('Location: homepage.php');
		}
		else {
			header('Location: editProfile.php');
		}
	}
?>