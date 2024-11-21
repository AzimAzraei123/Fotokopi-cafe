<?php include('partials/menu.php'); ?>
<div class="container mt-3">
    <div class="mt-4 p-5 bg-light text-bg-light rounded">
        <h1>
            <img src="../pic/Logo.png" alt="Company Logo" width="200px">
            Manage Customer
        </h1>
    </div>
</div>
<br>
<!-- Main content section -->
<div class="container bg-light rounded">
    <br>
    <div class="container">
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add']; // Display session message
                unset($_SESSION['add']); // Remove session message
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
    <!-- Search form -->
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Customer ID" name="custID">
                        <button class="btn btn-dark" type="submit" name="search">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="addCustomer.php" class="btn btn-dark text-light me-2">Add Customer</a>
                <a href="manageCustomer.php" class="btn btn-dark">Reload Table</a>
            </div>
            <div>
            <button class="btn btn-dark" onclick="sortTable(false)">Sort Descending</button>
                <button class="btn btn-dark me-2" onclick="sortTable(true)">Sort Ascending</button>
            </div>
        </div>
        <br>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center" style="width:5%">No.</th>
                <th class="text-center" style="width:5%">CustID</th>
                <th class="text-first">Customer Name</th>
                <th class="text-first">Phone Number</th>
                <th class="text-first">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if the search form is submitted
            if (isset($_POST['search'])) {
                // Get the input value from the textbox
                $searchCustID = $_POST['custID'];

                // Query to get the specific customer based on the custID
                $sql = "SELECT * FROM customer WHERE custID = '$searchCustID'";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if the query is executed or not
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // Count the rows to check if the customer exists
                    $sn = 1;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Get data from the database
                            $id = $rows['custID'];
                            $custName = $rows['custName'];
                            $phoneNum = $rows['custPhoneNumber'];
                            $email = $rows['custEmail'];

                            // Display the values in our table
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $sn++; ?></td>
                                <td class="text-center"><?php echo $id; ?></td>
                                <td><?php echo $custName; ?></td>
                                <td><?php echo $phoneNum; ?></td>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No customer found
                        echo "<tr><td colspan='7' class='text-center'>No customer found</td></tr>";
                    }
                }
            } else {
                // Query to get all customers
                $sql = "SELECT * FROM customer";
                // Execute query
                $res = mysqli_query($conn, $sql);

                // Check whether the query is executed or not
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // Count rows to check whether we have data in the database or not
                    $sn = 1; // Create a variable and assign the value
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Get data from the database
                            $id = $rows['custID'];
                            $custName = $rows['custName'];
                            $phoneNum = $rows['custPhoneNumber'];
                            $email = $rows['custEmail'];

                            // Display the values in our table
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $sn++; ?></td>
                                <td class="text-center"><?php echo $id; ?></td>
                                <td><?php echo $custName; ?></td>
                                <td><?php echo $phoneNum; ?></td>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No customers found
                        echo "<tr><td colspan='7' class='text-center'>No customers found</td></tr>";
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
                x = rows[i].getElementsByTagName("TD")[1]; // Column index 1 for Customer ID
                y = rows[i + 1].getElementsByTagName("TD")[1]; // Column index 1 for Customer ID
                if (ascending ? parseInt(x.innerHTML) > parseInt(y.innerHTML) : parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
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