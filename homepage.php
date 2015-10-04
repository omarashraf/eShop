
<html>

<head>
	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/foundation-icons.css" />
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
	<!-- This is how you would link your custom stylesheet -->
	<!--<link rel="stylesheet" href="css/app.css">-->
	<script src="js/vendor/modernizr.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
		$(document).ready(function(){
			$(document).foundation();
		});
	</script>
</head>

<body>
	<h1>*Homepage/index*</h1>
	<?php
		include('helper.php');
		session_start();
		if (isset($_SESSION['loggedin'])) {
			echo "<a href='editProfile.php'>Edit Profile</a><br>
			<a href='logout.php'>Logout</a><br>
			<a href='changePassword.php' >Change Password</a>
			<div id='myModal' class='reveal-modal' data-reveal aria-labelledby='modalTitle' style='width: 550px;' aria-hidden='true' role='dialog'>
			  <h2 id='modalTitle' style='text-align: center;'>Change Password</h2>
			<form style='margin-top: 35px;'>
			  <div class='row'>
				<div class='small-9 small-centered columns'><input type='password' name='password_old' id='password_old' class='error' placeholder='Old Password' style='font-size: 20px;'></input>
				</div>
			  </div>
			  <br>
			  <div class='row'>
				<div class='small-9 small-centered columns'><input type='password' name='password_new' id='password_new' class='error' placeholder='New Password' style='font-size: 20px;'></input>
				</div>
			  </div>
			  <br>
			  <div class='row'>
				<div class='small-9 small-centered columns'><input type='password' name='confirm_new_password' id='confirm_new_password' class='error' placeholder='Confirm New Password' style='font-size: 20px;'></input>
				</div>
			  </div>
			  <br>
			  <div class='row' style='text-align: center; margin-top: 20px;'>
				<button type='submit' class='button success'>Change</button>
			</div>
			</form>
			  <a class='close-reveal-modal' aria-label='Close'>&#215;</a>
			</div>" . "<br>";
			echo $_SESSION['loggedin'];
		}
	?>
</body>
</html>