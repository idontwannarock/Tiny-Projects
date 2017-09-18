<?php
$link = mysqli_connect(host, username, password, dbname);
if(mysqli_connect_errno()) {
    print_r(mysqli_connect_error());
    exit();
}
?>