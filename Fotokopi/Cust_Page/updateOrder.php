<?php
//include constant.php
include('../config/constants.php');
// Check if custID is provided in the URL
// get the id
$id = $_GET['id'];
$orderID = $_GET['orderID'];
// create sql query
$sql = "UPDATE ordermenu SET orderStatus = 'Order Received' WHERE orderID = '$orderID'";

// execute query
$res = mysqli_query($conn, $sql);

if ($res) {
    header('location: ' . SITEURL . 'Cust_Page/custOrder.php?id=' . $id);
    exit();
} else {
    header('location: ' . SITEURL . 'Cust_Page/custOrder.php?id=' . $id);
    exit();
}


?>
