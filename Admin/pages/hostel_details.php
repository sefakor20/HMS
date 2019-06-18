<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

if (empty($_GET['hid'])) {
    header('location: all_hostel.php');
}

$hostel_det = getSelectedHostel($connection, $_GET['hid']);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include '../includes/meta.php'; ?>

    <title>Admin - <?php echo $hostel_det->hostel; ?></title>

    <?php include '../includes/links.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/nav.php'; ?>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="top" style="margin-top:45px;"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $hostel_det->hostel; ?></h3>
                        </div>
                        <div class="panel-body">
                            <img src="../../images/hotels/<?php echo $hostel_det->photo; ?>" alt="hotel image" style="width:100%; height:300px;">
                            <br><br>
                            <p>
                                <i class="fa fa-map-marker"> <?php echo $hostel_det->location; ?></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-clock-o"> <?php echo getDateFormat($hostel_det->created_at); ?></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-money"> <?php echo "GHC " . number_format($hostel_det->price_per_room, 2) . " per room"; ?></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-home"> <?php echo $hostel_det->room . " Rooms available"; ?></i>
                            </p>
                            <h3>Description</h3>
                            <p>
                                <?php echo $hostel_det->description; ?>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <div class="pull-right">
                                <a href="update_hostel.php?hid=<?php echo $hostel_det->id; ?>" class="btn btn-warning">Update Info</a>
                            </div>
                        </div>
                        <br><br>
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