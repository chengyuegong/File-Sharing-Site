<?php
	include "functions.php";
	session_start();

	// check username
	$username = $_POST["username"];
	if ($username == "") {
		$_SESSION["msg"] = "Please enter a username";
		gotoIndexPage();
	}	
	if (!checkUserName($username)) {
		$_SESSION["msg"] = "Invalid username (valid characters: 0-9, a-z, A-Z, -, _)";
		gotoIndexPage();
	}

	// validate username
	$users_list = getUsersList();
	if (!in_array($username, $users_list)) {
		$_SESSION["msg"] = "Username doesn\'t exist, please register first";
		gotoIndexPage();
	}
	$_SESSION["file-sharing-site-username"] = $username;
	gotoFilePage();
?>