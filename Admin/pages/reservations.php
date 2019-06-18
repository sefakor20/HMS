<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

$total = getItemTotal($connection, "reservation");


//pagination
$pagination = $total->total;

$page = (int)$_GET['page'];
$rows = 20;

if ($page < 1) {
    $page = 1;
}

$pages = ceil($pagination / $rows);

if (($page > $pages) && ($pages > 1)) {
    $page = $pages;
}

$offset = ($page - 1) * $rows;
$all_reservation =  getAdminReservation($connection, $rows, $offset);

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

    <title>Admin - Student Reservations</title>

    <?php include '../includes/links.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/nav.php'; ?>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="top" style="margin-top:45px;"></div>
                    <?php include '../includes/alert.php'; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">All Reservations</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Hostel</th>
                                            <th>Quantity</th>
                                            <th>Short Note</th>
                                            <th>Notification</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_reservation as $new) : ?>
                                            <?php if ($new['stat'] == 2) { ?>
                                                <tr style="font-weight: bolder;">
                                                    <td><?php echo $new['student']; ?></td>
                                                    <td><?php echo $new['hostel']; ?></td>
                                                    <td><?php echo $new['quantity']; ?></td>
                                                    <td><?php echo $new['short_note']; ?></td>
                                                    <td>
                                                        <?php if ($new['notification'] == 2) { ?>
                                                            <i class="label label-success"><?php echo $new['note']; ?></i>
                                                        <?php } else { ?>
                                                            <i class="label label-danger"><?php echo $new['note']; ?></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $new['status']; ?></td>
                                                    <td>
                                                        <?php if (($new['notification']) == 1) { ?>
                                                            <a href="approve_reservation.php?rid=<?php echo $new['id']; ?>">View / Approve</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td><?php echo $new['student']; ?></td>
                                                    <td><?php echo $new['hostel']; ?></td>
                                                    <td><?php echo $new['quantity']; ?></td>
                                                    <td><?php echo $new['short_note']; ?></td>
                                                    <td>
                                                        <?php if ($new['notification'] == 2) { ?>
                                                            <i class="label label-success"><?php echo $new['note']; ?></i>
                                                        <?php } else { ?>
                                                            <i class="label label-danger"><?php echo $new['note']; ?></i>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $new['status']; ?></td>
                                                    <td>
                                                        <?php if (($new['notification']) == 1) { ?>
                                                            <a href="approve_reservation.php?rid=<?php echo $new['id']; ?>">View / Approve</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include '../includes/scripts.php'; ?>

</body>

</html>