<?php

    //include constant.php
    include('../config/constants.php');

    // get the ID of order to be update
    $id = $_GET['id'];

    $sql = "UPDATE ordermenu SET orderStatus = 'Order Cancelled' WHERE orderID = '$id'";

    //redirect to manage order with messsage
    $res = mysqli_query($conn,$sql);

    if ($res) {
        //Create Session variable to display message
        $_SESSION['update']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Order Cancelled Successfully</div>";
        header('location:'.SITEURL.'Staff_Page/manageOrder.php');
    } else {
        // echo "Failed to update order";
        $_SESSION['update']= "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to cancel order. Try again Later</div>";
            
        header('location:'.SITEURL.'Staff_Page/manageOrder.php');
    }
?>
