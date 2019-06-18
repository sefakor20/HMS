<?php
require_once '../Connection/config.php';

if (isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($connection, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $old_password = mysqli_real_escape_string($connection, $_POST['old_password']);
    $old_password = md5(sha1(md5($old_password)));
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    //query to view the old password
    $old_password_query = "SELECT password FROM user WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($connection, $old_password_query) or die(mysqli_error($connection));
    $content = mysqli_fetch_object($result);

    $password_to_compare = $content->password;

    //check to see if old password matches the provided one
    if ($old_password === $password_to_compare) {
        //user has provided an accurate old password
        if ($password === $confirm_password) {
            $password = md5(sha1(md5($password)));
            //update the table based on the information provided by the user
            $query = "UPDATE user SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', email = '$email', username = '$username', password = '$password', updated_at = NOW() WHERE user.id = '$id' ";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            $_SESSION['success'] = 'Account update successful. Login with your new credential.';
            header('location: ../Admin/pages/login.php');
        } else {
            //new password do not match
            $_SESSION['error'] = 'New password do not match';
            header('location: ../Admin/pages/profile.php');
        }
    } else {
        //invalid old password
        $_SESSION['error'] = 'Invalid old password';
        header('location: ../Admin/pages/profile.php');
    }
} else {
    die('Requested page not found');
}
