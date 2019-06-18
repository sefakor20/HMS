<?php
require_once '../Connection/config.php';

if (isset($_POST['submit'])) {
    $student_id = (int)$_POST['student_id'];
    $hostel_id = (int)$_POST['hostel_id'];
    $quantity = 1;
    $available_room = (int)$_POST['available_room'];
    $short_note = mysqli_real_escape_string($connection, $_POST['short_note']);
    $status = 2;
    $notification = 1;


    //check if quantity of room requested is more than available
    if ($quantity > 1) {
        //requested room exceed available
        $_SESSION['error'] = "You cannot reserve more than one room";
        header('location: ../Student/pages/hostel_details.php?hid=' . $hostel_id);
        exit();
    }

    //request matches available
    //populate the database
    $query = "INSERT INTO reservation (id, student_id, hostel_id, quantity, short_note, status, notification, created_at) VALUES(NULL, '$student_id', '$hostel_id', '$quantity', '$short_note', '$status', '$notification', NOw())";
    mysqli_query($connection, $query) or die(mysqli_error($connection));
    $_SESSION['success'] = 'Reservation request successful, you will be notified';
    header('location: ../Student/pages/hostel_details.php?hid=' . $hostel_id);
} else {
    die('Requested page not found');
}
