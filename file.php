<?php
    include "functions.php";
    session_start();
    // make sure the user signs in from the login page
    if (!isset($_SESSION["file-sharing-site-username"])) {
        $_SESSION["msg"] = "Sorry, no Access to this page";
        gotoIndexPage();
    } else {
        $username = $_SESSION["file-sharing-site-username"];
    }
    if (!isset($_SESSION["user_dir"])) {
        $_SESSION["user_dir"] = $username; 
    }
    $current_dir = $_SESSION["base_dir"].$_SESSION["user_dir"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init()
        });
    </script>
</head>
<body>
    <!-- Logout button -->
    <form action="logout.php" method="POST">
        <button type="submit" class="btn btn-dark" id="signout-btn">Sign out</button>
    </form>
    <div id="file-list">
        <h1 id="hello-msg">Hello, <?php echo htmlentities($username);?>!</h1>
        <form action="back.php" method="POST">
            <button type="submit" class="btn btn-dark" id="back-btn">Back</button>
        </form>
        <p id="current-dir">Current Directory: /<?php echo $_SESSION["user_dir"];?></p>
        <hr>
        <div id="files">
        <?php list_files($current_dir); ?>
        </div>
        <hr>
        <!-- create folder button -->
        <form action="createfolder.php" method="POST">
            <div class="form-group">
                <label for="folderName">Create a new folder: </label>
                <input type="text" class="form-control" name="foldername" id="folderName" placeholder="Folder Name" />
            </div>
            <button type="submit" class="btn btn-dark mb-2">Create</button>
        </form>
        <!-- upload button -->
        <form enctype="multipart/form-data" action="upload.php" method="POST">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="uploadedfile" id="uploadFile" />
                <label class="custom-file-label" for="uploadFile">Choose file</label>
            </div>
            <button type="submit" class="btn btn-dark mb-2">Upload</button>
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