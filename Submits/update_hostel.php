<?php
require_once '../Connection/config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $available_rooms = (int)$_POST['available_rooms'];
    $hostel_category = (int)$_POST['hostel_category'];
    $status = (int)$_POST['status'];
    $id = (int)$_POST['id'];
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    $query = "UPDATE hostel SET name = '$name', location = '$location', available_room = '$available_rooms', category = '$hostel_category', status = '$status', price = '$price', description = '$description', updated_at = NOW() WHERE id = '$id' ";
    mysqli_query($connection, $query) or die(mysqli_error($connection));
    $_SESSION['success'] = 'update successfully';
    header('location: ../Admin/pages/update_hostel.php?hid=' . $id);
} else {
    die('Requested Page not found');
}
