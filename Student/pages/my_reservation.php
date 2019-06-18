<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['student'])) {
    header('location: ../../Admin/pages/login.php');
}

$total = getStudentReservationTotal($connection, $_SESSION['student']);


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
$my_reservations =  getStudentReservation($connection, $_SESSION['student'], $rows, $offset);

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

    <title>Student - My Reservation</title>

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
                            <h3 class="panel-title">My Reservations</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Hostel Name</th>
                                            <th>Location</th>
                                            <th>My Note</th>
                                            <th>Admin Notice</th>
                                            <th>Notification</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($my_reservations as $item) : ?>
                                            <tr>
                                                <td><?php echo $item['hostel']; ?></td>
                                                <td><?php echo $item['location']; ?></td>
                                                <td><?php echo $item['short_note']; ?></td>
                                                <td><?php echo $item['admin_short_note']; ?></td>
                                                <td>
                                                    <?php if ($item['notification'] == 2) { ?>
                                                        <i class="label label-info"><?php echo $item['note']; ?> <i class="fa fa-thumbs-up"> </i> &nbsp;</i>
                                                    <?php } else if ($item['notification'] == 4) { ?>
                                                        <i class="label label-danger"><?php echo $item['note']; ?> <i class="fa fa-times-circle"> </i> &nbsp;</i>
                                                    <?php } else if ($item['notification'] == 3) { ?>
                                                        <i class="label label-danger"><?php echo $item['note']; ?> <i class="fa fa-thumbs-down"> </i> &nbsp;</i>
                                                    <?php } else { ?>
                                                        <i class="label label-warning"><?php echo $item['note']; ?> <i class="fa fa-thumbs-down"> </i> &nbsp;</i>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($item['stat'] == 1) { ?>
                                                        <i class="label label-success"><?php echo $item['status']; ?></i>
                                                    <?php } else { ?>
                                                        <i class="label label-danger"><?php echo $item['status']; ?></i>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo getDateFormat($item['created_at']); ?></td>
                                                <td>
                                                    <?php if ($item['notification'] == 1) { ?>
                                                        <a href="#modelId_<?php echo $item['id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm">Cancel Reservation</a>
                                                    <?php } ?>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modelId_<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirmation</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Do you really wanna cancel the reservation? <strong class="text-warning">NB: Action cannot undone!</strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <a href="../../Submits/cancel_reservation.php?cancel=<?php echo $item['id']; ?>" class="btn btn-danger">Continue to cancel reservation</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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