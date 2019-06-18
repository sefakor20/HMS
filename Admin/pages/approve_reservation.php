<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

if (empty($_GET['rid'])) {
    header('location: reservations.php');
}

if (isset($_GET['rid'])) {
    getChangeReservationStatus($connection, $_GET['rid']);
}

$reservation_notice_status = getReservationNotice($connection);
$selected_reservation = getAdminSelectedReservation($connection, $_GET['rid']);




?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include '../includes/meta.php'; ?>

    <title>Admin - Approve Reservation</title>

    <?php include '../includes/links.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/nav.php'; ?>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <?php if ($selected_reservation->room <= 0) { ?>
                    <marquee direction="left" behavior="alternate">
                        <h1 style="color:red;"><i class="fa fa-exclamation-triangle"></i> Rooms Exhausted for <strong style="color:#000;"><?php echo $selected_reservation->hostel; ?></strong> . You cannot approve.</h1>
                    </marquee>
                <?php } ?>
                <div class="col-lg-8">
                    <div class="top" style="margin-top:45px;"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Approve Reservation</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="../../Submits/approve_reservation.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student">Student</label>
                                            <input type="text" name="student" value="<?php echo $selected_reservation->student; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" name="student_id" value="<?php echo $selected_reservation->student_id; ?>" required>
                                        <input type="hidden" name="id" value="<?php echo $_GET['rid']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student">Hostel</label>
                                            <input type="text" name="hostel" value="<?php echo $selected_reservation->hostel; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="student">Quantity</label>
                                            <input type="text" name="quantity" value="<?php echo $selected_reservation->quantity; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="student">Available Rooms</label>
                                            <input type="text" name="room" value="<?php echo $selected_reservation->room; ?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option class="selected">--Choose status--</option>
                                                <?php foreach ($reservation_notice_status as $new) : ?>
                                                    <?php if ($new['id'] != 1 && $new['id'] != 4) { ?>
                                                        <option value="<?php echo $new['id']; ?>"><?php echo $new['name']; ?>
                                                        <option>
                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message">Student Message</label>
                                            <textarea class="form-control" name="student_short_note" rows="4" disabled><?php echo $selected_reservation->short_note; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" placeholder="Room reservation not successfull. Thank you very much for your understanding" name="short_note" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php if (($selected_reservation->approval_status) == 0 && ($selected_reservation->room) > 0) { ?>
                                    <div class="pull-right">
                                        <button type="submit" name="submit" class="btn btn-success">Approve Now</button>
                                    </div>
                                <?php } ?>
                            </form>
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