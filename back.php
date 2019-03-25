<?php
    include "functions.php";
    session_start();
    $slashpos = strrpos($_SESSION["user_dir"], "/");
    if ($slashpos==false) {
        $_SESSION["msg"] = "You cannot go back from your root directory";
        gotoFilePage();
    }
    $_SESSION["user_dir"] = substr($_SESSION["user_dir"], 0, $slashpos);
    gotoFilePage();
?>