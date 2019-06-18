<?php
require_once '../../Connection/config.php';
if (empty($_SESSION['admin'])) {
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include '../includes/meta.php'; ?>

    <title>Admin - Update my Account</title>

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
                            <h3 class="panel-title">Update My Account</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="../../Submits/update_admin_profile.php">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" value="<?php echo $profile->first_name; ?>" class="form-control" required="">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['admin']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" name="middle_name" value="<?php echo $profile->middle_name; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" value="<?php echo $profile->last_name; ?>" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo $profile->email; ?>" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" value="<?php echo $profile->username; ?>" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_password" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="password" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" name="confirm_password" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="submit" class="btn btn-success">Update Profile</button>
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