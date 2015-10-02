<html>
<head>
	<script>
		function check() {
			var email = document.getElementById('email').value;
			var password = document.getElementById('password').value;
			if (email.length == 0 || !email.trim()) {
				alert('Email shouldn\'t be blank.');
			}
			if (password.length == 0) {
				alert('Password shouldn\'t be empty.' );
			}
		}
	</script>
</head>
<body>
	<form name="registerForm" method="post">
		<input type='hidden' name='registered' id='registered' value='1'></input>
		<b>First name: </b><input type="text" name="fname" id="fname"></input><br><br>
		<b>Last name: </b><input type="text" name="lname" id="lname"></input><br><br>
		<b>Email*: </b><input type="text" name="email" id="email"></input><br><br>
		<b>Browse: </b> *browse button* <br><br>
		<b>Password*: </b><input type="password" name="password" id="password"></input><br><br>
		<b>Confirm Password*: </b><input type="password" name="confirm_password" id="confirm_password"></input><br><br>
		<button type="submit" onclick="check()">Register</button>
	</form>
</body>
</html>
	<?php
		include('helper.php');
		if (isset($_POST['registered'])) {
			if (validEmail($_POST['email']) && validNewPassword($_POST['password'], $_POST['confirm_password'])) {
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
				mysql_query($insert_user_sql);
				header('Location: homepage.php');
			}
		}
	?>