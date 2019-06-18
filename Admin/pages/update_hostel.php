<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

if (empty($_GET['hid'])) {
    header('location: all_hostel.php');
}

$cat = getHostelCategory($connection);
$hostel_status = getHostelStatus($connection);
$hostel_info = getSelectedHostel($connection, $_GET['hid']);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include '../includes/meta.php'; ?>

    <title>Admin - Update Hostel</title>

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
                    <?php include '../includes/alert.php'; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Update Hostel</h3>
                        </div>
                        <div class="panel-body">
                            <img src="../../images/hotels/<?php echo $hostel_info->photo; ?>" alt="hotel image" style="width:100%; height:300px;">
                            <br><br>
                            <form method="post" action="../../Submits/update_hostel.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="<?php echo $hostel_info->hostel; ?>" class="form-control" required>
                                            <input type="hidden" name="id" value="<?php echo $_GET['hid']; ?>" require>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" name="location" value="<?php echo $hostel_info->location; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Available Rooms</label>
                                            <input type="number" value="<?php echo $hostel_info->room; ?>" name="available_rooms" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" value="<?php echo $hostel_info->price_per_room; ?>" name="price" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="hostel_category" class="form-control">
                                                <option class="selected">-Select category-</option>
                                                <?php foreach ($cat as $item) :
                                                    ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                                <?php
                                            endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option class="selected">-Select status-</option>
                                                <?php foreach ($hostel_status as $item) :
                                                    ?>
                                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                                <?php
                                            endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="8" required><?php echo $hostel_info->description; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
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