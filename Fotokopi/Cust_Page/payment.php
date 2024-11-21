<?php
include ('partials/navbar.php');

// Retrieve the data from the previous file
$eatOption = $_SESSION['eatOption'] ?? '';
$paymentMethod = $_SESSION['paymentMethod'] ?? '';
$address = 'LCK Restaurant';

// Retrieve the address if the user chose the delivery option
if ($eatOption === 'Delivery') {
    $address = $_SESSION['address'] ?? '';

    // Add extra charges for delivery
    $extraCharges = 8;
} else {
    // No extra charges
    $extraCharges = 0;
}
?>

<div class="container bg-light p-5 my-5 jumbotron rounded">
    <h1>
        <center>Payment</center>
    </h1>
</div>

<!-- order details -->
<div class="container bg-light w-50 rounded<?php if (empty($_SESSION['foodItems']))
    echo ' d-none'; ?>">
    <!-- Calculate order -->
    <?php
    // Calculate Sub Total
    $subTotal = 0;
    if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])) {
        foreach ($_SESSION['foodItems'] as $foodItem) {
            $subTotal += $foodItem['totalPrice'];
        }
    }

    // Calculate Tax
    $tax = 0.06 * $subTotal;

    // Get the current order date in the specified format
    
    $orderDate = date('d-m-Y');

    // Calculate Grand Total including extra charges
    $grandTotal = $subTotal + $tax + $extraCharges;
    $roundedGrandTotal = number_format(round($grandTotal * 10) / 10, 1);
    $roundUp = $roundedGrandTotal - $grandTotal;
    ?>

    <!-- Receipt Display -->
    <div class="container bg-light w-75 rounded<?php if (empty($_SESSION['foodItems']))
        echo ' d-none'; ?>">
        <br>
        <div class="text-start">
            <p>Order Date: <strong><?php echo $orderDate; ?></strong></p>
            <p>Eat Option: <strong><?php echo $eatOption; ?></strong></p>
            <p>Payment Method: <strong><?php echo $paymentMethod; ?></strong></p>

            <?php if ($eatOption === 'Delivery' && !empty($address)): ?>
                <p>Address: <b><?php echo $address; ?></b></p>
            <?php endif; ?>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Food Name</th>
                    <th>Quantity</th>
                    <th>Price per Item (RM)</th>
                    <th>Total Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])): ?>
                    <?php foreach ($_SESSION['foodItems'] as $foodItem): ?>
                        <tr>
                            <td><?php echo $foodItem['foodName']; ?></td>
                            <td><?php echo $foodItem['quantity']; ?></td>
                            <td><?php echo $foodItem['pricePerItem']; ?></td>
                            <td><?php echo $foodItem['totalPrice']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-end">
            <p>Sub Total: RM <?php echo number_format($subTotal, 2); ?></p>
            <p>Tax (6%): RM <?php echo number_format($tax, 2); ?></p>
            <?php if ($eatOption === 'Delivery' && !empty($address)): ?>
                <p>Delivery Charges: RM <?php echo number_format($extraCharges, 2); ?></p>
            <?php endif; ?>
            <p>Total: RM <?php echo number_format($grandTotal, 2); ?></p>
            <p>Round Up: RM <?php echo number_format($roundUp, 2); ?></p>
            <hr>
            <h4 class="text-end">Rounded Grand Total: RM <?php echo number_format($roundedGrandTotal, 2); ?></h4>
        </div>
    </div>

    <br>
</div>

<br>

<?php if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])): ?>
    <div class="container text-center">
        <form action="" method="post">
            <button type="submit" name="submit" class="btn btn-dark">Confirm Payment</button>
        </form>
    </div>
<?php endif; ?>
<br>
<div class="container text-center">
    <a class="btn btn-dark text-center" href="orderSetup.php?id=<?php echo $id ?>">Back to Order Setup</a>
</div>
<br><br>
<?php include ('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    // Get the current order date
    $orderDate = date('d-m-Y');
    $roundedGrandTotal = number_format($roundedGrandTotal, 2);
    $sql1 = "INSERT INTO ordermenu SET
        custID = '$id',
        orderAddress = '$address',
        orderDate ='$orderDate',
        eatOption = '$eatOption',
        paymentMethod = '$paymentMethod',
        orderStatus = 'In Process',  
        grandTotal = '$roundedGrandTotal'
    ";

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); // Database connection
    $db_select = mysqli_select_db($conn, 'fotokopi') or die(mysqli_error());

    // Execute query and save the data into the database
    $res1 = mysqli_query($conn, $sql1) or die(mysqli_error());

    // Get the last inserted order ID
    $orderID = mysqli_insert_id($conn);

    if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])) {
        foreach ($_SESSION['foodItems'] as $foodItem) {
            $foodID = $foodItem['foodID'];
            $foodname = $foodItem['foodName'];
            $quantity = $foodItem['quantity'];
            $price = $foodItem['totalPrice'];

            $sql2 = "INSERT INTO cart SET 
                    orderID = '$orderID',
                    foodID = '$foodID',
                    foodName = '$foodname',
                    quantity = '$quantity',
                    totalPrice = '$price'
                ";

            // Execute query and save the data into the database
            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
        }

        // Redirect page to receipt
        header("location: " . SITEURL . 'Cust_Page/orderSuccess.php?id=' . $id);
        exit(); // Terminate the script after redirecting
    }
}
?>