<?php
include("function.php");

//set up a global variable for displaying error message later
$error = "";

//login signup function
if ($_GET['action'] == "loginSignup") {
    if (!$_POST['username']) {
        $error = "An username is required.";
    } else if ($_POST['username'].length > 12) {
        $error = "Please enter an username with 12 characters and/or digits top.";
    } else if ($_POST['loginActive'] = "0") {
        if (!$_POST['email']) {
            $error = "An email address is required.";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error = "Please enter a valid email address.";
        }
    } else if (!$_POST['password']) {
        $error = "A password is required.";
    }
    if ($error != "") {
        echo $error;
        exit();
    }
}

?>