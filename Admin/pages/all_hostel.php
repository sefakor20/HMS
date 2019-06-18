<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

$total = getItemTotal($connection, "hostel");


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
$all_hostel =  getAllHostel($connection, $rows, $offset);

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

    <title>Admin - All hostel</title>

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
                            <h3 class="panel-title">All Hostels</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Available Rooms</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_hostel as $item) : ?>
                                            <tr>
                                                <td><img src="../../images/hotels/<?php echo $item['photo']; ?>" class="img-circle" width="70px" height="70px"></td>
                                                <td><?php echo $item['hostel']; ?></td>
                                                <td><?php echo $item['location']; ?></td>
                                                <td><?php echo $item['room']; ?></td>
                                                <td><?php echo "GHC " . number_format($item['price_per_room'], 2); ?></td>
                                                <td><i class="label label-warning"><?php echo $item['cat']; ?></i></td>
                                                <td><i class="label label-success"><?php echo $item['status']; ?></i></td>
                                                <td><a href="hostel_details.php?hid=<?php echo $item['id']; ?>">View</a> | <a href="../../Submits/delete.php?hid=<?php echo $item['id']; ?>" class="text-danger">Delete</a></td>
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