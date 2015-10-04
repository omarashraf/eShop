<?php
	include('helper.php');
	session_start();
	//if (!isset($_POST['editted'])) {
		$data_arr = fetchUserData($_SESSION['loggedin']);
	//}
	
?>
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

	<form name="editForm" method="post" action="editProfile.php" style="margin-top: 100px;">
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