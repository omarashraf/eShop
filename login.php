
<html>
<head>
	<script>
		function checkEmpty() {
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
	<form action="login.php" method="post" name="loginForm">
		<input type='hidden' name='submitted' id='submitted' value='1'></input>
		Email: <input type="text" name="email" id="email"></input> <br><br>
		Password: <input type="password" name="password" id="password"></input> <br><br>
		<button type="submit" onclick="checkEmpty()">Login</button>
	</form>
</body>
</html>

<?php
	include('helper.php');
	if (isset($_POST['submitted'])) {
		if (login($_POST['email'], $_POST['password'])) {
			session_start();
			$_SESSION['loggedin'] = $_POST['email'];
			$_SESSION['loggedin_password'] = $_POST['password'];
			header('Location: homepage.php');
		}
		else {
			echo "Wrong email/password combination.";
		}
	}
?>