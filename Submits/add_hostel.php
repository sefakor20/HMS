<?php
require_once '../Connection/config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $available_rooms = (int)$_POST['available_rooms'];
    $hostel_category = (int)$_POST['hostel_category'];
    $status = (int)$_POST['status'];
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);

    if (isset($_FILES['photo'])) {
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $photo_name_type = $_FILES['photo']['type'];
        $photo_name_size = $_FILES['photo']['size'];
        $error = $_FILES['photo']['error'];

        //check if image selection is sucessfull
        if (!$photo_tmp_name) {
            $_SESSION['error'] = 'No image selected';
            header('Location: ../Admin/pages/hostel.php');
            exit();
        }

        //destination of images
        $destination = move_uploaded_file($photo_tmp_name, '../images/hotels/' . $photo_name);

        if (!$destination) {
            $_SESSION['error'] = 'Image not successfull';
            header('Location: ../Admin/pages/hostel.php');
            exit();
        }
    }

    //insert values into the database
    $query = "INSERT INTO hostel (id, name, location, photo, available_room, price, description, category, status, created_at) VALUES(NULL, '$name', '$location', '$photo_name', '$available_rooms', '$price', '$description', '$hostel_category', '$status', NOW())";
    mysqli_query($connection, $query) or die(mysqli_error($connection));
    $_SESSION['success'] = 'hostel added successfully';
    header('location: ../Admin/pages/hostel.php');
} else {
    die('Requested Page not found');
}
