<?php
$link = mysqli_connect("localhost:3306", "root", "", "user");
if(mysqli_connect_errno()) {
    print_r(mysqli_connect_error());
    exit();
}


?>