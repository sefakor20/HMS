<?php
require_once '../../Connection/config.php';
require_once '../../Methods/User.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

$total = getItemTotal($connection, "user");


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
$all_users =  getAllAdminUsers($connection, $rows, $offset);

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

    <title>Admin - All Accounts</title>

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
                            <h3 class="panel-title">All Accounts</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Date Of Birth</th>
                                            <th>Email</th>
                                            <th>Mobile No.</th>
                                            <th>User Group</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_users as $new) : ?>
                                            <tr>
                                                <td><?php echo $new['user']; ?></td>
                                                <td><?php echo $new['sex']; ?></td>
                                                <td><?php echo $new['dob']; ?></td>
                                                <td><?php echo $new['email']; ?></td>
                                                <td><?php echo $new['phone']; ?></td>
                                                <td><?php echo $new['group_m']; ?></td>
                                                <td>
                                                    <?php if ($new['status_id'] == 1) { ?>
                                                        <i class="label label-success"> <?php echo $new['status']; ?></i>
                                                    <?php } else { ?>
                                                        <i class="label label-danger"> <?php echo $new['status']; ?></i>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($new['user_group'] != 1) { ?>
                                                        <?php if ($new['status_id'] == 1) { ?>
                                                            <a href="../../Submits/monitor.php?deactivate=<?php echo $new['id']; ?>" class="text-danger">Deactivate</a>
                                                        <?php } else { ?>
                                                            <a href="../../Submits/monitor.php?activate=<?php echo $new['id']; ?>">Activate</a>
                                                        <?php } ?>
                                                    <?php } ?>
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