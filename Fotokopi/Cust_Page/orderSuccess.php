<?php
include('partials/navbar.php');

$id = $_GET['id'] ?? '';

// Store the value of $id in a separate variable
$orderId = $id;

?>

<div class="container w-50 bg-light rounded text-center">
    <br>
    <img src="../pic/successLogo.png" alt="">
    <br>
    <h3>Order Success</h3>
    <br>
    <a href="order.php?id=<?php echo $orderId; ?>" class="btn btn-dark">Return to Order Page</a>
    <br><br>
</div>

<?php
// Clear all session data
session_unset();
?>

<br><br>
<?php include('partials/footer.php'); ?>
