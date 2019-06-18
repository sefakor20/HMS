<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['student'])) {
    header('location: ../../Admin/pages/login.php');
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

    <title>Student - <?php echo $hostel_det->hostel; ?></title>

    <?php include '../includes/links.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/nav.php'; ?>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
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
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="top" style="margin-top:45px;"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Reserve a Room</h3>
                        </div>
                        <div class="panel-body">
                            <?php if (($hostel_det->room) > 0) { ?>
                                <form method="post" action="../../Submits/hostel_reservation.php">
                                    <div>
                                        <input type="hidden" name="student_id" value="<?php echo $_SESSION['student']; ?>" required>
                                        <input type="hidden" name="hostel_id" value="<?php echo $_GET['hid']; ?>" required>
                                    </div>
                                    <h4><?php include '../includes/alert.php'; ?></h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="room">Available Room (s)</label>
                                                <input type="text" name="available_room" value="<?php echo $hostel_det->room; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="room">Price Per Room (GHC)</label>
                                                <input type="text" name="price" value="<?php echo number_format($hostel_det->price_per_room, 2); ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="room">Location</label>
                                                <input type="text" name="location" value="<?php echo $hostel_det->location; ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="room">Short Note</label>
                                                <textarea name="short_note" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" name="submit" class="btn btn-success">Reserve Now</button>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <marquee direction="left">
                                    <h1 style="color:red;"><i class="fa fa-exclamation-triangle"></i> No Room available to reserve!!!</h1>
                                </marquee>
                            <?php } ?>
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