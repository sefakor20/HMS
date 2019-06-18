<?php
require_once '../Connection/config.php';
require_once '../Methods/User.php';

//activate user account
if (isset($_GET['activate'])) {
    getActivateStudentAccount($connection, $_GET['activate']);
    $_SESSION['success'] = 'Account successfully activated';
    header('location: ../Admin/pages/account.php');
}

//activate user account
if (isset($_GET['deactivate'])) {
    getDeactivateStudentAccount($connection, $_GET['deactivate']);
    $_SESSION['success'] = 'Account successfully deactivated';
    header('location: ../Admin/pages/account.php');
}
