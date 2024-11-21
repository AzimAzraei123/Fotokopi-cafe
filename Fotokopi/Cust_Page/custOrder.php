<?php
include ('partials/navbar.php');

// Check if custID is provided in the URL
// get the id
$id = $_GET['id'];
// create sql query
$sql = "SELECT * FROM customer WHERE custID=$id";

// execute query
$res = mysqli_query($conn, $sql);

// check if the query executed successfully
if ($res == true) {
    // check if the customer exists
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $custName = $row['custName'];
        $phoneNum = $row['custPhoneNumber'];
        $email = $row['custEmail'];
    } else {
        header('location: ' . SITEURL . 'Cust_Page/order.php?id=' . $id);
        exit(); // terminate the script
    }
}

// Display the customer information
?>

<div class="container bg-light p-5 my-5 jumbotron rounded">
    <h1>
        <center>Order History</center>
    </h1>
</div>

<div class="container bg-light rounded">
    <div class="container">
        <br>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <br>
            <div>
                <button class="btn btn-dark me-2" onclick="sortTable(true)">Sort Oldest Order</button>
                <button class="btn btn-dark" onclick="sortTable(false)">Sort Latest Order</button>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <th class="text-center">orderID</th>
            <th class="text-center">Address</th>
            <th class="text-center">Date</th>
            <th class="text-center">Eat Option</th>
            <th class="text-center">Payment Method</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th> <!-- Updated here -->
        </thead>
        <tbody>
            <?php
            //query to get order based on custID
            $sql = "SELECT * FROM ordermenu WHERE custID = $id ORDER BY orderID DESC";

            // execute query
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //get data from database
                        $orderID = $rows['orderID'];
                        $orderAddress = $rows['orderAddress'];
                        $orderDate = $rows['orderDate'];
                        $eatOption = $rows['eatOption'];
                        $paymentMethod = $rows['paymentMethod'];
                        $orderStatus = $rows['orderStatus'];
                        $grandTotal = $rows['grandTotal'];

                        // Determine if action buttons should be hidden
                        $hideActions = false;

                        if ($orderStatus == "Order Received" || $orderStatus == "Order Cancelled") {
                            $hideActions = true;
                        }
                        // Display
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $orderID; ?></td>
                            <td><?php echo !empty($orderAddress) ? $orderAddress : "none"; ?></td>
                            <td class="text-center"><?php echo $orderDate; ?></td>
                            <td class="text-center"><?php echo $eatOption; ?></td>
                            <td><?php echo $paymentMethod; ?></td>
                            <td class="text-center">
                                <?php
                                $statusClass = ""; // Variable to store the Bootstrap class for status button color
                    
                                // Determine the Bootstrap class based on the order status
                                switch ($orderStatus) {
                                    case "In Process":
                                        $statusClass = "btn btn-primary"; // Blue color for "In Process"
                                        break;
                                    case "Delivering":
                                        $statusClass = "btn btn-info text-white"; // Light blue color for "Delivering"
                                        break;
                                    case "Order Received":
                                        $statusClass = "btn btn-success"; // Green color for "Order Received"
                                        break;
                                    case "Order Cancelled":
                                        $statusClass = "btn btn-danger"; // Red color for "Order Cancelled"
                                        break;
                                    default:
                                        $statusClass = "btn btn-secondary"; // Default color for other statuses
                                        break;
                                }
                                ?>
                                <button class="<?php echo $statusClass; ?>"><?php echo $orderStatus; ?></button>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="<?php echo SITEURL; ?>Cust_Page/viewCart.php?id=<?php echo $id; ?>&orderID=<?php echo $orderID ?>"
                                        class="btn btn-warning me-2">View<br>Cart</a>
                                    <?php if (!$hideActions) { ?>
                                        <!-- Button to Open the Modal -->
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#orderReceivedModal<?php echo $orderID; ?>">Order<br>Received</button>
                                        <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                            data-bs-target="#cancelOrderModal<?php echo $orderID; ?>">Cancel<br>Order</button>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>

                        <!-- Order Received Modal -->
                        <div class="modal fade" id="orderReceivedModal<?php echo $orderID; ?>" tabindex="-1"
                            aria-labelledby="orderReceivedModalLabel<?php echo $orderID; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderReceivedModalLabel<?php echo $orderID; ?>">Order Received?
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to mark this order as received?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="<?php echo SITEURL; ?>Cust_Page/updateOrder.php?id=<?php echo $id; ?>&orderID=<?php echo $orderID ?>"
                                            class="btn btn-primary">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancel Order Modal -->
                        <div class="modal fade" id="cancelOrderModal<?php echo $orderID; ?>" tabindex="-1"
                            aria-labelledby="cancelOrderModalLabel<?php echo $orderID; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelOrderModalLabel<?php echo $orderID; ?>">Cancel Order?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to cancel this order?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <a href="<?php echo SITEURL; ?>Cust_Page/cancelOrder.php?id=<?php echo $id; ?>&orderID=<?php echo $orderID ?>"
                                            class="btn btn-danger">Yes, Cancel Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <br>
</div>
<br>
<?php

include ('partials/footer.php');
?>

<script>
    // JavaScript function to sort the table
    function sortTable(ascending) {
        let table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector("table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = parseInt(rows[i].getElementsByTagName("TD")[0].innerText);
                y = parseInt(rows[i + 1].getElementsByTagName("TD")[0].innerText);
                if (ascending ? x > y : x < y) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>