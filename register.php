<?php
require_once 'Connection/config.php';
require_once 'Methods/User.php';

$gender = getGender($connection);

$title = 'Registration Page';

?>
<?php include 'includes/header.php'; ?>
<!-- banner -->
<div class="inside-banner">
  <div class="container">
    <span class="pull-right"><a href="#">Home</a> / Register</span>
    <h2>Register / Login</h2>
  </div>
</div>
<!-- banner -->


<div class="container">
  <div class="spacer">
    <div class="row register">
      <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Registration Form</h3>
          </div>
          <div class="panel-body">
            <form method="post" action="Submits/register_student.php">
              <div class="row">
                <div class="col-md-6">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                </div>
                <div class="col-md-6">
                  <label for="middle_name">Middle Name</label>
                  <input type="text" class="form-control" placeholder="Middle Name" name="middle_name">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                </div>
                <div class="col-md-6">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" placeholder="example@you.com" name="email" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="dob">Date of birth</label>
                  <input type="date" class="form-control" placeholder="Date of birth" name="dob" required>
                </div>
                <div class="col-md-6">
                  <label for="sex">Gender</label>
                  <select name="sex" class="form-control">
                    <option class="selected">--Choose your gender</option>
                    <?php foreach ($gender as $sex) : ?>
                      <option value="<?php echo $sex['id']; ?>"><?php echo $sex['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <?php include 'includes/alert.php'; ?>
              <div class="row">
                <div class="col-md-6">
                  <label for="phone">Mobile No.</label>
                  <input type="text" class="form-control" placeholder="Mobile No" name="phone" required>
                </div>
                <div class="col-md-6">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="col-md-6">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required>
                </div>
              </div>
              <button type="submit" class="btn btn-success" name="submit">Register</button>
              <br><br>
              <center style="font-size:17px;">Already have an account! <a href="Admin/pages/login.php" target="_blank">Login Now</a></center>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>