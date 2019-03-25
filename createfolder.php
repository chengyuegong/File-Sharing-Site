<?php
	include "functions.php";
	session_start();

	// Get the foldername and make sure it is valid
	$foldername = $_POST["foldername"];
	if ($foldername == "") {
		$_SESSION["msg"] = "Please enter a folder name";
		gotoFilePage();
	}	
	if( !checkFolderName($foldername) ){
		$_SESSION["msg"] = "Invalid foldername (valid characters: 0-9, a-z, A-Z, -, _)";
		gotoFilePage();
	}

	$full_path = sprintf("%s%s/%s", $_SESSION["base_dir"], $_SESSION["user_dir"], $foldername);
	if (file_exists($full_path)) {
		$_SESSION["msg"] = "Folder exists";
		gotoFilePage();
	} 
	mkdir($full_path);
	$_SESSION["msg"] = "Folder created successfully";
	gotoFilePage();
?>