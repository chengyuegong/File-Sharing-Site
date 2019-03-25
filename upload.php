<?php
	include "functions.php";
	session_start();

	// Get the filename and make sure it is valid
	$filename = basename($_FILES['uploadedfile']['name']);
	if ($filename == "") {
		$_SESSION["msg"] = "Please choose a file";
		gotoFilePage();
	}
	if( !checkFileName($filename) ){
		$_SESSION["msg"] = "Invalid filename (valid characters: 0-9, a-z, A-Z, -, _, .)";
		gotoFilePage();
	}

	$full_path = sprintf("%s%s/%s", $_SESSION["base_dir"], $_SESSION["user_dir"], $filename);
	if (file_exists($full_path)) {
		$_SESSION["msg"] = "File already exists";
		gotoFilePage();
	} 
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path);	
	$_SESSION["msg"] = "File uploaded successfully";
	gotoFilePage();
?>