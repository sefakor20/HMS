<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

$total = getTotalDeclineReservation($connection);


//pagination
$pagination = $total->total;

$page = (int)$_GET['page'];
$rows = 100000000;

if ($page < 1) {
    $page = 1;
}

$pages = ceil($pagination / $rows);

if (($page > $pages) && ($pages > 1)) {
    $page = $pages;
}

$offset = ($page - 1) * $rows;
$all_approved_reservation =  getAdmindDeclineReservation($connection, $rows, $offset);

if (($page - 1) >= 1) {
    $prevPage = $page - 1;
} else {
    $prevPage = 1;
}

//getting next page value
if (($page + 1) <= $pages) {
    $nextPage = $page + 1;
} else {
    $nextPage = $pages;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include '../includes/meta.php'; ?>

    <title>GACA HOSTEL MANAGEMENT SYSTEM</title>

    <?php include '../includes/links.php'; ?>

</head>

<body onload="window.print();">

    <div id="wrapper">


        <!-- /.row -->
        <div class="row">
            <div class="col-lg-9 col-md-offset-1">
                <div class="top" style="margin-top:45px;"></div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="background: #fff; ">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center" style="font-size:18px;">All Approved Reservations</th>
                            </tr>
                            <tr style="font-size:16px;">
                                <th>Student</th>
                                <th>Hostel</th>
                                <th>Quantity</th>
                                <th>Student Note</th>
                                <th>Admin Note</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all_approved_reservation as $new) : ?>
                                <tr>
                                    <td><?php echo $new['student']; ?></td>
                                    <td><?php echo $new['hostel']; ?></td>
                                    <td><?php echo $new['quantity']; ?></td>
                                    <td><?php echo $new['short_note']; ?></td>
                                    <td><?php echo $new['admin_short_note']; ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
    <!-- /#wrapper -->

    <?php include '../includes/scripts.php'; ?>

</body>

</html>