<?php
require_once '../Connection/config.php';
require_once '../Methods/functions.php';


if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($connection, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $dob = mysqli_real_escape_string($connection, $_POST['dob']);
    $sex = (int)$_POST['sex'];
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
    $user_group = 2;
    $status = 1;

    //check for duplicate username
    $check_username = checkDuplicateUsername($connection, $username);
    if (!empty($check_username)) {
        //username exist
        $_SESSION['error'] = 'Username already exist';
        header('location: ../register.php');
        exit();
    }

    //check for duplicate email
    $check_duplicate_email = checkDuplicateEmail($connection, $email);
    if (!empty($check_duplicate_email)) {
        //email exist
        $_SESSION['error'] = 'Email already exist';
        header('location: ../register.php');
        exit();
    }

    //check if password matches
    if ($password === $confirm_password) {
        //there is a match
        $password = md5(sha1(md5($password)));

        //insert values into the database
        $query = "INSERT INTO user (id, first_name, middle_name, last_name, email, sex, dob, user_group, status, phone, username, password, created_at) VALUES(NULL, '$first_name', '$middle_name', '$last_name', '$email', '$sex', '$dob', '$user_group', '$status', '$phone', '$username', '$password', NOW())";
        mysqli_query($connection, $query) or die(mysqli_error($connection));
        $_SESSION['success'] = 'Account created successfully. Continue to login';
        header('location: ../Admin/pages/login.php');
    } else {
        //password did not match
        $_SESSION['error'] = 'Password do not match';
        header('location: ../register.php');
    }
} else {
    die('Requested page not found');
}
