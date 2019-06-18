<?php
require_once '../Connection/config.php';
require_once '../Methods/functions.php';

//delete hostel
if (isset($_GET['hid'])) {
    getDeleteItem($connection, "hostel", $_GET['hid']);
    $_SESSION['success'] = 'Item deleted successfully';
    header('location: ../Admin/pages/all_hostel.php');
}
