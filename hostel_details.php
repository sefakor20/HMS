<?php
require_once 'Connection/config.php';
require_once 'Methods/Hostel.php';
require_once 'Methods/functions.php';

if (empty($_GET['id'])) {
  header('location: index.php');
}

$hostel_details = getSelectedHostel($connection, $_GET['id']);
$hotcake_hostel =  getAllHostel($connection, 6, 0);

?>
<?php
$title = 'Hostel Details';
include 'includes/header.php';


?>
<!-- banner -->
<div class="inside-banner">
  <div class="container">
    <span class="pull-right"><a href="#">Home</a> / Services / Hostel</span>
    <h2>Hostel</h2>
  </div>
</div>
<!-- banner -->


<div class="container">
  <div class="properties-listing spacer">

    <div class="row">

      <div class="col-lg-3 col-sm-4 hidden-xs">

        <div class="hot-properties hidden-xs">
          <h4>Hot Cake</h4>
          <?php foreach ($hotcake_hostel as $new) : ?>
            <?php if ($new['category'] == 1) { ?>
              <div class="row">
                <div class="col-lg-4 col-sm-5"><img src="images/hotels/<?php echo $new['photo']; ?>" class="img-responsive img-circle" alt="properties" /></div>
                <div class="col-lg-8 col-sm-7">
                  <h5><a href="hostel_details.php?id=<?php echo $new['id']; ?>"><?php echo $new['hostel']; ?></a></h5>
                  <p class="price"><?php echo 'GHC ' . number_format($new['price_per_room'], 2); ?></p>
                </div>
              </div>
            <?php } ?>
          <?php endforeach; ?>
        </div>
      </div>


      <div class="col-lg-9 col-sm-8 ">

        <h2><?php echo $hostel_details->hostel; ?></h2>
        <div class="row">
          <div class="col-lg-8">
            <div class="property-images">
              <!-- Slider Starts -->
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators hidden-xs">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <!-- Item 1 -->
                  <div class="item active">
                    <img src="images/properties/4.jpg" class="properties" alt="properties" />
                  </div>
                  <!-- #Item 1 -->

                  <!-- Item 2 -->
                  <div class="item">
                    <img src="images/properties/2.jpg" class="properties" alt="properties" />

                  </div>
                  <!-- #Item 2 -->

                  <!-- Item 3 -->
                  <div class="item">
                    <img src="images/properties/1.jpg" class="properties" alt="properties" />
                  </div>
                  <!-- #Item 3 -->

                  <!-- Item 4 -->
                  <div class="item ">
                    <img src="images/properties/3.jpg" class="properties" alt="properties" />

                  </div>
                  <!-- # Item 4 -->
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
              </div>
              <!-- #Slider Ends -->

            </div>




            <div class="spacer">
              <h4><span class="glyphicon glyphicon-th-list"></span> Properties Detail</h4>
              <p><?php echo $hostel_details->description; ?></p>

            </div>

          </div>
          <div class="col-lg-4">
            <div class="col-lg-12  col-sm-6">
              <div class="property-info">
                <p class="price"><?php echo "GHC " . number_format($hostel_details->price_per_room, 2); ?></p>
                <p class="area"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $hostel_details->location; ?></p>

                <div class="profile">
                  <span class="glyphicon glyphicon-user"></span> Contact Details
                  <p>John Parker<br>009 229 2929</p>
                </div>
              </div>

              <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
              <div class="listing-detail">
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room">5</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking">2</span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen">1</span> </div>

            </div>
            <div class="col-lg-12 col-sm-6 ">
              <div class="enquiry">
                <a href="register.php" class="btn btn-primary">Reserve a Room</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>