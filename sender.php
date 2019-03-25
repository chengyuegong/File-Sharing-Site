<?php
	include "functions.php";
	session_start();

	$filename = $_POST["filename"];
	$sender = $_SESSION["file-sharing-site-username"];
	$receiver = $_POST["receiver"];

	// check receiver username
	if ($receiver == "") {
		$_SESSION["msg"] = "Please enter a username";
		gotoFilePage();
	}
	if( !checkUserName($receiver) ){
		$_SESSION["msg"] = "Invalid username for the receiver (valid characters: 0-9, a-z, A-Z, -, _)";
		gotoFilePage();
	}
	// users cannot send file to themselves
	if ($receiver == $sender) {
		$_SESSION["msg"] = "You cannot send the file to yourself";
		gotoFilePage();
	}
	// check if the receiver is a registered user
	$users_list = getUsersList();
	if (!in_array($receiver, $users_list)) {
		$_SESSION["msg"] = "Please send your file to a registered user";
		gotoFilePage();
	} 

	$src_path = sprintf("%s%s/%s", $_SESSION["base_dir"], $_SESSION["user_dir"], $filename);
	$dest_folder = sprintf("%s%s/from_%s/", $_SESSION["base_dir"], $receiver, $sender);
	if (file_exists($dest_folder.$filename)) {
		$_SESSION["msg"] = "File exists in the receiver\'s folder";
		gotoFilePage();
	}

	if (!is_dir($dest_folder)) {
		mkdir($dest_folder);
	}
	copy($src_path, $dest_folder.$filename);
	$_SESSION["msg"] = "File sent successfully";
	gotoFilePage();
?>