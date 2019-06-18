<?php
require_once 'Connection/config.php';
require_once 'Methods/Hostel.php';
require_once 'Methods/functions.php';


$total = getItemTotal($connection, "hostel");


//pagination
$pagination = $total->total;

$page = (int)$_GET['page'];
$rows = 9;

if ($page < 1) {
  $page = 1;
}

$pages = ceil($pagination / $rows);

if (($page > $pages) && ($pages > 1)) {
  $page = $pages;
}

$offset = ($page - 1) * $rows;
$main_hostel =  getAllHostel($connection, $rows, $offset);

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


$hotcake =  getAllHostel($connection, 5, 0);



?>
<?php
$title = 'Home - GACA Hostel Management Sytem';
include 'includes/header.php';


?>
<!-- banner -->
<div class="inside-banner">
  <div class="container">
    <span class="pull-right"><a href="index.php">Home</a> / Services / Hostel</span>
    <h2>Hostel</h2>
  </div>
</div>
<!-- banner -->


<div class="container">
  <div class="properties-listing spacer">

    <div class="row">
      <div class="col-lg-3 col-sm-4 ">

        <div class="search-form">
          <h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
          <form method="GET" action="search.php">
            <input type="text" class="form-control" name="keyword" placeholder="Search by hostel name, price..." autocomplete="off">
            <button type="submit" class="btn btn-primary">Find Now</button>
          </form>

        </div>



        <div class="hot-properties hidden-xs">
          <h4>Hot Cake</h4>
          <?php foreach ($hotcake as $cake) : ?>
            <?php if ($cake['category'] == 1) { ?>
              <div class="row">
                <div class="col-lg-4 col-sm-5"><img src="images/hotels/<?php echo $cake['photo']; ?>" class="img-responsive img-circle" alt="properties"></div>
                <div class="col-lg-8 col-sm-7">
                  <h5><a href="hostel_details.php?id=<?php echo $cake['id']; ?>"><?php echo $cake['hostel']; ?></a></h5>
                  <p class="price"><?php echo 'GHC ' . number_format($cake['price_per_room'], 2); ?></p>
                </div>
              </div>
            <?php } ?>
          <?php endforeach; ?>

        </div>


      </div>

      <div class="col-lg-9 col-sm-8">
        <div class="sortby clearfix">
          <div class="pull-left result">Showing: <?php echo $page; ?> of <?php echo $pages ?> </div>

        </div>
        <div class="row">
          <?php foreach ($main_hostel as $new) : ?>
            <!-- properties -->
            <div class="col-lg-4 col-sm-6">
              <div class="properties">
                <div class="image-holder"><img src="images/hotels/<?php echo $new['photo']; ?>" class="img-responsive" alt="properties">
                  <div class="status sold"><?php echo $new['room'] . ' Rooms Available'; ?></div>
                </div>
                <h4><a href="property-detail.php"><?php echo $new['hostel']; ?></a></h4>
                <p class="price">Price per room: <?php echo 'GHC ' . number_format($new['price_per_room'], 2); ?></p>
                <div class="listing-detail">
                  <?php if ($new['category'] == 1) { ?>
                    <i class="label label-danger"><?php echo $new['cat']; ?></i>
                  <?php } else { ?>
                    <i class="label label-info"><?php echo $new['cat']; ?></i>
                  <?php } ?>
                </div>
                <a class="btn btn-primary" href="hostel_details.php?id=<?php echo $new['id']; ?>">View Details</a>
              </div>
            </div>
            <!-- properties -->
          <?php endforeach; ?>


          <!-- pagination -->
          <div class="center">
            <ul class="pagination">
              <?php if (($page - 1) >= 1) : ?>
                <li><a href="index.php?page=<?php echo $prevPage; ?>">« Previous</a></li>
              <?php endif; ?>
              <?php if (($page + 1) <= $pages) : ?>
                <li><a href="index.php?page=<?php echo $nextPage; ?>">Next »</a></li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>