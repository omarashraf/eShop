<?php
	include('helper.php');
	session_start();
	$data_arr = fetchUserData($_SESSION['loggedin']);
?>
<html>

<head></head>

<body>
	<form name="editForm" method="post" action="editProfile.php">
		<input type='hidden' name='editted' id='editted' value='1'></input>
		<b>First name: </b><input type="text" name="fname_edit" id="fname_edit" value="<?php echo array_pop($data_arr) ?>"></input><br><br>
		<b>Last name: </b><input type="text" name="lname_edit" id="lname_edit" value="<?php echo array_pop($data_arr) ?>"></input><br><br>
		<b>Email: </b><input type="text" name="email_edit" id="email_edit" value="<?php echo array_pop($data_arr) ?>"></input><br><br>
		<b>Browse: </b> *browse button* <br><br>
		<h2>Change Password</h2>
		<b>Old Password: </b><input type="password" name="password_old" id="password_old"></input><br><br>
		<b>New Password: </b><input type="password" name="password_new" id="password_new"></input><br><br>
		<b>Confirm Password: </b><input type="password" name="confirm_new_password" id="confirm_new_password"></input><br><br>
		<button type="submit">Edit</button>
	</form>
</body>
</html>

<?php
	if (isset($_POST['editted'])) {
		if (validEmail($_POST['email_edit']) && validatePasswords($_POST['password_old'], $_POST['password_new'], $_POST['confirm_new_password'])) {
			session_start();
			if (strlen($_POST['password_old']) == 0) {
				$pass = $_SESSION['loggedin_password'];
			}
			else {
				$pass = $_POST['password_new'];
			}
			$update_editted_user = "UPDATE users SET first_name = '" . $_POST['fname_edit'] ."', last_name = '" . $_POST['lname_edit'] . 
			"', email = '" . $_POST['email_edit'] . "', password = '" . $pass . "' WHERE email = '" . $_SESSION['loggedin'] . "'";
			mysql_query($update_editted_user);
			header('Location: homepage.php');
		}
		else {
			header('Location: editProfile.php');
		}
	}
?>