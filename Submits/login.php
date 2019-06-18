<?php
//include connection file
require_once '../Connection/config.php';
require_once '../Methods/User.php';

//accept users input
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //hash password
    $password = md5(sha1(md5($password)));

    //login
    $login = Login($connection, $username, $password);
} else {
    die('Requested page not found');
}
