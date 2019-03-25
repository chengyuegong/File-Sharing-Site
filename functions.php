<?php
	function gotoFilePage() {
		header("Location: file.php");
		exit;
	}

	function gotoIndexPage() {
		header("Location: index.php");
		exit;
	}

	function checkUserName($username) {
		return preg_match('/^[\w\-]+$/', $username);
	}

	function checkFileName($filename) {
		return preg_match('/^[\w\.\-]+$/', $filename);
	}

	function checkFolderName($foldername) {
		return preg_match('/^[\w\-]+$/', $foldername);
	}

	function getUsersList() {
		$file = fopen("/home/gcy1996/users.txt", "r");
		$list = array();
		while (!feof($file)) {
			array_push($list, trim(fgets($file)));
		}
		array_pop($list); // remove the empty line
		fclose($file);
		return $list;
	}

	function list_files($path) {
		$directory = opendir($path);
		$files = array();
		while (($file = readdir($directory)) !== false) {
			$full_path = $path . "/" . $file;
			if ($file == '.' || $file == '..') {
				continue;
			} else if (is_dir($full_path)) { // folder
				printf("<div class=\"form-row\"><p><i class=\"fas fa-folder\"></i>%s</p>\n", $file);
				printf("<form action=\"enter.php\" method=\"POST\">\n");
				printf("<input type=\"hidden\" value=\"%s\" name=\"dir\" />\n", $file);
				printf("<button type=\"submit\" class=\"btn btn-dark enter-btn\"/>Enter</button>\n");
				printf("</form>\n");
				printf("<form action=\"delete.php\" method=\"POST\" >\n");
				printf("<input type=\"hidden\" value=\"%s\" name=\"deletedfile\" />\n", $file);
				printf("<button type=\"submit\" class=\"btn btn-dark delete-btn\"/>Delete</button>\n");
				printf("</form>\n");
				printf("</div>\n");
			} else { // file
				array_push($files, $file);
			}
		}
		// display files
		for ($i = 0; $i < count($files); $i++) {
			printf("<div class=\"form-row\"><p><i class=\"fas fa-file\"></i>%s</p>\n", $files[$i]);
			printf("<form action=\"view.php\" method=\"POST\" target=\"_blank\">\n");
			printf("<input type=\"hidden\" value=\"%s\" name=\"filename\" />\n", $files[$i]);
			printf("<button type=\"submit\" class=\"btn btn-dark view-btn\">View</button>\n");
			printf("</form>\n");
			printf("<form action=\"delete.php\" method=\"POST\">\n");
			printf("<input type=\"hidden\" value=\"%s\" name=\"deletedfile\" />\n", $files[$i]);
			printf("<button type=\"submit\" class=\"btn btn-dark delete-btn\">Delete</button>\n");
			printf("</form>\n");
			printf("<form action=\"sender.php\" method=\"POST\">\n");
			printf("<label for=\"username%d\">Send to:</label>\n", $i);
			printf("<input type=\"text\" name=\"receiver\" placeholder=\"Username\" id=\"username%d\" />\n", $i);
			printf("<input type=\"hidden\" value=\"%s\" name=\"filename\" />\n", $files[$i]);
			printf("<button type=\"submit\" class=\"btn btn-dark send-btn\">Send</button>\n");
			printf("</form>\n");
			printf("</div>\n");
		}
		closedir($directory);
	}

	function delete($path, $counter = 0) {
		if (!is_dir($path)) {
			if (!unlink($path)) {
				$_SESSION["msg"] = "Failed to delete";
				gotoFilePage();
			}
		} else {
			$directory = opendir($path);
			while (($file = readdir($directory)) !== false) {
				$full_path = $path . '/'. $file;
				if ($file == '.' || $file == '..') {
					continue;
				} else {
					delete($full_path, counter+1);
				}
			}
			closedir($directory);
			if (!rmdir($path)) {
				$_SESSION["msg"] = "Failed to delete";
				gotoFilePage();
			} 
		}
		if ($counter == 0) {
			$_SESSION["msg"] = "Deleted successfully";
			gotoFilePage();
		}
	}
?>
