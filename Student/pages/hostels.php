<?php
require_once '../../Connection/config.php';
require_once '../../Methods/Hostel.php';
require_once '../../Methods/functions.php';

if (empty($_SESSION['student'])) {
    header('location: ../../Admin/pages/login.php');
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
$student_hostel =  getAllHostel($connection, $rows, $offset);

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

    <title>Student - All hostels</title>

    <?php include '../includes/links.php'; ?>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include '../includes/nav.php'; ?>

        <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="top" style="margin-top:45px;"></div>
                <?php foreach ($student_hostel as $hostel) : ?>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $hostel['hostel']; ?></h3>
                            </div>
                            <div class="panel-body">
                                <img src="../../images/hotels/<?php echo $hostel['photo']; ?>" style="width: 100%; height: 150px;" alt="<?php echo $hostel['hostel']; ?>">
                                <br>
                                <p>
                                    <?php echo readMore($hostel['description'], 100); ?>
                                </p>
                                <p>
                                    <a href="hostel_details.php?hid=<?php echo $hostel['id']; ?>" class="btn btn-block btn-success">View details / Reserve a room</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include '../includes/scripts.php'; ?>

</body>

</html>