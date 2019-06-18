<?php
require_once '../../Methods/User.php';
require_once '../../Methods/functions.php';

$profile = getUserInfo($connection, $_SESSION['admin']);
$reservation_notice_total = getTotalForSpecificItem($connection);

?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Administrator Panel</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-file-text fa-fw"></i> View Items <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="all_hostel.php"><i class="fa fa-bank fa-fw"></i>View all Hotels</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
            <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php echo $profile->first_name; ?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> Profile</a>
                </li>
                <li><a href="../../Submits/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="index.php"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="hostel.php"><i class="fa fa-bank fa-fw"></i> Hostel Management</a>
                </li>
                <li>
                    <a href="reservations.php"><i class="fa fa-stack-overflow fa-fw"></i> Reservations <i class="label label-danger"><?php echo $reservation_notice_total->total . ' unread msg'; ?></i></a>
                </li>
                <li>
                    <a href="account.php"><i class="fa fa-users fa-fw"></i> Accounts</a>
                </li>
                <li>
                    <a href="../../Submits/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>