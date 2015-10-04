
<html>

<head></head>

<body>
	<h1>*Homepage/index*</h1>
	<?php
		include('helper.php');
		session_start();
		if (isset($_SESSION['loggedin'])) {
			echo "<a href='editProfile.php'>Edit Profile</a>
			<a href='logout.php'>Logout</a>";
		}
	?>
</body>
</html>