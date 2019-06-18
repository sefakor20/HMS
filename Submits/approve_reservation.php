<?php
require_once '../Connection/config.php';
require_once '../Methods/Hostel.php';

if (isset($_POST['submit'])) {
    $id = (int)$_POST['id'];
    $status = (int)$_POST['status'];
    $student_id = (int)$_POST['student_id'];
    $short_note = mysqli_real_escape_string($connection, $_POST['short_note']);


    //update based on status
    if ($status == 2) {
        //update table when status = 2
        $query = "UPDATE reservation a INNER JOIN hostel b ON (a.hostel_id = b.id) SET a.notification = '$status', a.admin_short_note = '$short_note', b.available_room = (b.available_room - 1) WHERE a.id = '$id' AND student_id = '$student_id'";
        mysqli_query($connection, $query) or die(mysqli_error($connection));
        $_SESSION['success'] = 'Action successfull, student has been notified.';
        header('location: ../Admin/pages/reservations.php');
    } else if ($status == 3) {
        //update table when status = 3
        $query = "UPDATE reservation a INNER JOIN hostel b ON (a.hostel_id = b.id) SET a.notification = '$status', a.admin_short_note = '$short_note', b.available_room = (b.available_room + 0) WHERE a.id = '$id' AND student_id = '$student_id'";
        mysqli_query($connection, $query) or die(mysqli_error($connection));
        $_SESSION['success'] = 'Action successfull, student has been notified.';
        header('location: ../Admin/pages/reservations.php');
    }
} else {
    die('Requested Page not found');
}
