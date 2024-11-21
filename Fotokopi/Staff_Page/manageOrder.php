<?php include('partials/menu.php'); ?>

<div class="container mt-3">
    <div class="mt-4 p-5 bg-light text-bg-light rounded">
        <h1>
            <img src="../pic/Logo.png" alt="Company Logo" width="200px">
            Manage Order
        </h1>
    </div>
</div>

<br>

<div class="container bg-light rounded">
    <br>

    <div class="container">
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // display session message
            unset($_SESSION['add']); // remove session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
    </div>

    <div class="container">
            <!-- Search form -->
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="orderID" placeholder="Search Order ID" class="form-control">
                        <button type="submit" name="search" class="btn btn-dark">Search</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <a href="manageOrder.php" class="btn btn-dark">Reload Table</a>
                </div>
                <div>
                    <button class="btn btn-dark me-2" onclick="sortTable(true)">Sort Oldest Order</button>
                    <button class="btn btn-dark" onclick="sortTable(false)">Sort Latest Order</button>
                </div>
            </div>
        </div>
    <br>

    
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">orderID</th>
                <th class="text-center">custID</th>
                <th class="text-center">Address</th>
                <th class="text-center">Date</th>
                <th class="text-center">Eat Option</th>
                <th class="text-center">Payment Method</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if the search form is submitted
            if (isset($_POST['search'])) {
                // Get the input value from the textbox
                $searchOrderID = $_POST['orderID'];
                
                // Query to get the specific order based on the orderID
                $sql = "SELECT * FROM orderMenu WHERE orderID = '$searchOrderID'";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if the query is executed or not
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // Count the rows to check if the order exists
                    $sn = 1;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Get data from the database
                            $id = $rows['orderID'];
                            $custID = $rows['custID']; 
                            $orderAddress = $rows['orderAddress'];
                            $orderDate = $rows['orderDate'];
                            $eatOption = $rows['eatOption'];
                            $paymentMethod = $rows['paymentMethod'];
                            $orderStatus = $rows['orderStatus'];

                            // Display the values in our table
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $id; ?></td>
                                <td class="text-center"><?php echo $custID; ?></td>
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
                                    <button class="btn <?php echo $statusClass; ?>"><?php echo $orderStatus; ?></button>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="<?php echo SITEURL; ?>Staff_Page/viewCart.php?id=<?php echo $id; ?>" class="btn btn-warning me-2">View <br>Cart</a>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle me-2" data-bs-toggle="dropdown">Update <br>Status</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="updateStatus1.php?id=<?php echo $id?>">In Process</a></li>
                                                <li><a class="dropdown-item" href="updateStatus3.php?id=<?php echo $id?>">Order Received</a></li>
                                            </ul>
                                        </div>
                                        <a href="<?php echo SITEURL; ?>Staff_Page/cancelOrder.php?id=<?php echo $id; ?>" class="btn btn-danger">Cancel <br> Order</a>
                                    </div>
                                </td>
                            </tr>
                <?php
                        }
                    } else {
                        // No order found
                        echo "<tr><td colspan='8' class='text-center'>No order found</td></tr>";
                    }
                }
            } else {
                // Query to get all orders
                $sql = "SELECT * FROM orderMenu";
                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check whether the query is executed or not
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // Count rows to check whether we have data in the database or not
                    $sn = 1; // Create a variable and assign the value
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Get data from the database
                            $id = $rows['orderID'];
                            $custID = $rows['custID']; 
                            $orderAddress = $rows['orderAddress'];
                            $orderDate = $rows['orderDate'];
                            $eatOption = $rows['eatOption'];
                            $paymentMethod = $rows['paymentMethod'];
                            $orderStatus = $rows['orderStatus'];

                            // Display the values in our table
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $id; ?></td>
                                <td class="text-center"><?php echo $custID; ?></td>
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
                                    <button class="btn <?php echo $statusClass; ?>"><?php echo $orderStatus; ?></button>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="<?php echo SITEURL; ?>Staff_Page/viewCart.php?id=<?php echo $id; ?>" class="btn btn-warning me-2">View <br>Cart</a>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle me-2" data-bs-toggle="dropdown">Update <br>Status</button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="updateStatus1.php?id=<?php echo $id?>">In Process</a></li>
                                                <li><a class="dropdown-item" href="updateStatus2.php?id=<?php echo $id?>">Delivering</a></li>
                                                <li><a class="dropdown-item" href="updateStatus3.php?id=<?php echo $id?>">Order Received</a></li>
                                            </ul>
                                        </div>
                                        <a href="<?php echo SITEURL; ?>Staff_Page/cancelOrder.php?id=<?php echo $id; ?>" class="btn btn-danger">Cancel <br> Order</a>
                                    </div>
                                </td>
                            </tr>
            <?php
                        }
                    } else {
                        // No orders found
                        echo "<tr><td colspan='8' class='text-center'>No orders found</td></tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>

    <br>
</div>

<br><br>

<?php include('partials/footer.php'); ?>

<script>
    // JavaScript function to sort the table based on orderID
    function sortTable(ascending) {
        let table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector("table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = parseInt(rows[i].getElementsByTagName("TD")[0].textContent); // Get orderID as a number
                y = parseInt(rows[i + 1].getElementsByTagName("TD")[0].textContent); // Get orderID as a number
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
