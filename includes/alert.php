<?php if (isset($_SESSION['error'])) {
    ?>
    <strong style="color:red;"><?php echo $_SESSION['error']; ?></strong>
<?php
}
$_SESSION['error'] = null;
?>
<?php if (isset($_SESSION['success'])) {
    ?>
    <strong style="color:green;"><?php echo $_SESSION['success']; ?></strong>
<?php
}
$_SESSION['success'] = null;
?>