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
	$users_list = getUsersList();
    if (in_array($username, $users_list)) {
        $_SESSION["msg"] = "Username exists";
        gotoIndexPage();
    }

    // store the new username into the file
    $file = fopen("/home/gcy1996/users.txt", "a");
    // add the username to users.txt and make a new directory
    fwrite($file, $username."\n");
    $full_path = sprintf("%s%s", $_SESSION["base_dir"], $username);
    mkdir($full_path);
    $_SESSION["msg"] = "Registered successfully";
    fclose($file);
    gotoIndexPage();
?>