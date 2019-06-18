<?php
require_once '../Connection/config.php';
require_once '../Methods/Hostel.php';

if(isset($_GET['cancel'])){
    getCancelReservation($connection, $_GET['cancel']);
    $_SESSION['success'] = 'Reservation has cancelled successfully';
    header('location: ../Student/pages/my_reservation.php');
}