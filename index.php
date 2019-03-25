<?php
	include "functions.php";
	session_start();
	$_SESSION["base_dir"] = "/home/gcy1996/file_sharing_site/"; // base directory of storing files
	// direct to the user's file page if the user didn't leave the session
	if (isset($_SESSION["file-sharing-site-username"])) {
		gotoFilePage();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to File Sharing Site</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script>
		$(function() {
			$('#top-signup-btn').click(function(event){
				$('#signup-box').dialog();
			});
		});
	</script>
</head>

<body>
	<!-- Signup button -->
	<button type="submit" class="btn btn-outline-dark" id="top-signup-btn">Sign up</button>
	<h1 id="welcome-title">Welcome to File Sharing Site</h1>
	<!-- Signin box -->
	<div id="signin-box">
		<form action="login.php" method="POST">
			<div class="form-group">
				<label for="signin-username">Username</label>
				<input type="text" class="form-control" name="username" id="signin-username" placeholder="Enter username" />
			</div>
			<button type="submit" class="btn btn-dark" id="signin-btn">Sign in</button>
		</form>
	</div>
	<!-- Signup popout box -->
	<div id="signup-box" title="Sign up">
		<form action="register.php" method="POST">
			<div class="form-group">
				<label for="signup-username">Username</label>
				<input type="text" class="form-control" name="username" id="signup-username" placeholder="Enter username" />
			</div>
			<button type="submit" class="btn btn-dark" id="signup-btn">Sign up</button>
		</form>
	</div>
	<?php
	// display message
	if (isset($_SESSION['msg'])) {
		$msg = htmlentities($_SESSION['msg']);
		echo "<script>alert('$msg');</script>";
		unset($_SESSION['msg']);
	}
	?>
</body>
</html>
