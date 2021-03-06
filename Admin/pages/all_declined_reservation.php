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
$rows = 50;

if ($page < 1) {
    $page = 1;
}

$pages = ceil($pagination / $rows);

if (($page > $pages) && ($pages > 1)) {
    $page = $pages;
}

$offset = ($page - 1) * $rows;
$all_declined_reservation =  getAdmindDeclineReservation($connection, $rows, $offset);

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

    <title>Admin - All Declined Reservations</title>

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
                            <h3 class="panel-title">All Declined Reservations</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Hostel</th>
                                            <th>Quantity</th>
                                            <th>Student Note</th>
                                            <th>Admin Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_declined_reservation as $new) : ?>
                                            <tr>
                                                <td><?php echo $new['student']; ?></td>
                                                <td><?php echo $new['hostel']; ?></td>
                                                <td><?php echo $new['quantity']; ?></td>
                                                <td><?php echo $new['short_note']; ?></td>
                                                <td><?php echo $new['admin_short_note']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if(empty($all_declined_reservation)) { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <h2 class="text-center" style="color:red;">No record found!</h2>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if(!empty($all_declined_reservation)){ ?>
                                <div class="pull-left">
                                    <a href="gen_declined.php" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Report</a>
                                </div>
                                <?php } ?>
                                <div class="pull-right">
                                    <ul class="pagination pagination-sm">
                                        <?php if (($page - 1) >= 1) : ?>
                                            <li class="btn btn-info"><a href="all_declined_reservation.php?page=<?php echo $prevPage; ?>"> &laquo; Previous</a></li>
                                        <?php endif; ?>
                                        <?php if (($page + 1) <= $pages) : ?>
                                            <li class="btn btn-info"><a href="all_declined_reservation.php?page=<?php echo $nextPage; ?>"> &laquo; Previous</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
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