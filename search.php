<?php
require_once 'Connection/config.php';
require_once 'Methods/Hostel.php';
require_once 'Methods/functions.php';

if (empty($_GET['keyword'])) {
    header('location: ./index.php');
}

$search = searchHostel($connection, $_GET['keyword']);




?>
<?php
$title = 'Search Result';
include 'includes/header.php';


?>
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="index.php">Home</a> / Search</span>
        <h2>Search Result</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">

            <div class="col-lg-9 col-sm-8">
                <div class="sortby clearfix">
                    <div class="pull-left result">You've searched for: <?php echo $_GET['keyword']; ?></div>

                </div>
                <div class="row">
                    <?php foreach ($search as $new) : ?>
                        <!-- properties -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="properties">
                                <div class="image-holder"><img src="images/hotels/<?php echo $new['photo']; ?>" class="img-responsive" alt="properties">
                                    <div class="status sold"><?php echo $new['available_room'] . ' Rooms'; ?></div>
                                </div>
                                <h4><a href="property-detail.php"><?php echo $new['name']; ?></a></h4>
                                <p class="price">Price per room: <?php echo 'GHC ' . number_format($new['price'], 2); ?></p>
                                <div class="listing-detail">

                                </div>
                                <a class="btn btn-primary" href="hostel_details.php?id=<?php echo $new['id']; ?>">View Details</a>
                            </div>
                        </div>
                        <!-- properties -->
                    <?php endforeach; ?>



                    <!-- empty search -->
                    <div class="center">
                        <?php if (empty($search)) { ?>
                            <h1 style="color:red;">No record found!</h1>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>

<?php include 'includes/footer.php'; ?>