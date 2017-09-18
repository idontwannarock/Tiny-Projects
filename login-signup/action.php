<?php
include("function.php");

//Logout section
if($_GET['action'] == "logout") {
    setcookie("id", "", time()-3600);
    echo "loggedout";
}

//login signup section
//info checking section
if ($_GET['action'] == "loginSignup") {
    //set up a variable for displaying error message later
    $error = "";
    //checking if info needed has been filled and format is correct
    if (!$_POST['username']) {
        $error = "An username is required.";
    } else if (strlen($_POST['username']) > 12) {
        $error = "Please enter an username within 12 English characters and/or digits.";
    } else if ($_POST['loginActive'] == 0) {
        if (!$_POST['email']) {
            $error = "An email address is required.";
        } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error = "Please enter a valid email address.";
        } else if (!$_POST['password']) {
            $error = "A password is required.";
        }
    } else if (!$_POST['password']) {
        $error = "A password is required.";
    }
    if ($error != "") {
        echo $error;
        exit();
    }
    
    //signup login function section
    if ($_POST['loginActive'] == 0) {
        //signup section
        //set variables to perform mysql SELECT function
        $queryUsername = "SELECT * FROM userData WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";
        $queryEmail = "SELECT * FROM userData WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
        //set variables to perform query with mysql SELECT function
        $resultUsername = mysqli_query($link, $queryUsername);
        $resultEmail = mysqli_query($link, $queryEmail);
        //checking duplicate username or email
        if (mysqli_num_rows($resultUsername) > 0) {
            $error = "This username has already been taken.";
        } else if (mysqli_num_rows($resultEmail) > 0) {
            $error = "That email has been taken.";
        } else {
            //signup the username, email, and password
            $querySignup = "INSERT INTO userData (`username`, `email`) VALUES ('".mysqli_real_escape_string($link, $_POST['username'])."', '".mysqli_real_escape_string($link, $_POST['email'])."')";            
            if (mysqli_query($link, $querySignup)) {
                setcookie("id", mysqli_insert_id($link), time()+60*60*24*30);
                $queryHashPassword = "UPDATE userData SET password = '".password_hash($_POST['password'], PASSWORD_DEFAULT)."' WHERE id = '".mysqli_insert_id($link)."' LIMIT 1";
                mysqli_query($link, $queryHashPassword);
                echo "1";
            } else {
                $error = "Couln't create user - please try again later.";
            }
        }
    } else {
        //login section
        //set variables to perform mysql SELECT function
        $queryUsername = "SELECT * FROM userData WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";
        //set variables to perform query with mysql SELECT function to find the username
        $resultUsername = mysqli_query($link, $queryUsername);
        //after finded username, fetch all other data in the same set of the username
        $row = mysqli_fetch_assoc($resultUsername);
        //compare the password
        if (password_verify($_POST['password'], $row['password'])) {
            setcookie("id", $row['id'], time()+60*60*24*30);
            echo "1";
        } else {
            $error = "Could not find that username/password combination. Please try again.";
        }
    }
    if($error != "") {
        echo $error;
        exit();
    }
}

?>