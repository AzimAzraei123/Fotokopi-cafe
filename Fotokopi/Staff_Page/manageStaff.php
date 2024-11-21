<?php include('partials/menu.php');?>
    <div class="container mt-3">
        <div class="mt-4 p-5 bg-light text-bg-light rounded">
            <h1>
                <img src="../pic/Logo.png" alt="Company Logo" width="200px">
                Manage Staff
            </h1>
        </div>
    </div>
    <br>
    <!-- Main content section -->
    <div class="container bg-light rounded">
        <br>
        <div class="container">
        <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//display session message
                    unset($_SESSION['add']); //removing session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
            ?>
        </div>
        <div class="container">
            <!-- Search form -->
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Staff ID" name="staffID">
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
                    <a href="addStaff.php" class="btn btn-dark text-light">Add Staff</a>
                    <a href="manageStaff.php" class="btn btn-dark">Reload Table</a>
                </div>
                <div>
                    <!-- Call the sortTable() function with the column index (1 for "Staff Name" column) -->
                    <button class="btn btn-dark me-2" onclick="sortTable(1, true)">Sort Descending</button>
                    <button class="btn btn-dark" onclick="sortTable(1, false)">Sort Ascending</button>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Staff ID.</th>
                    <th class="text-center">Staff Name</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Phone Number</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Check if the search form is submitted
                    if (isset($_POST['search'])) {
                        // Get the input value from the textbox
                        $searchStaffID = $_POST['staffID'];

                        // Query to get the specific staff based on the staffID
                        $sql = "SELECT * FROM staff WHERE staffID = '$searchStaffID'";
                        // Execute the query
                        $res = mysqli_query($conn, $sql);

                        // Check if the query is executed or not
                        if ($res == TRUE) {
                            $count = mysqli_num_rows($res); // Count the rows to check if the staff exists
                            $sn = 1;
                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    // Get data from the database
                                    $id = $rows['staffID'];
                                    $staffName = $rows['staffName'];
                                    $gender = $rows['staffGender'];
                                    $phoneNum = $rows['staffPhoneNum'];
                                    $email = $rows['staffEmail'];

                                    // Display the values in our table
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $sn++; ?></td>
                                        <td class="text-center"><?php echo $id; ?></td>
                                        <td><?php echo $staffName; ?></td>
                                        <td class="text-center"><?php echo $gender; ?></td>
                                        <td class="text-center"><?php echo $phoneNum; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo SITEURL;?>Staff_Page/changePasswordStaff.php?id=<?php echo $id;?>" class="btn btn-primary blueBtn">Change <br> Password</a>
                                            <a href="<?php echo SITEURL;?>Staff_Page/updateStaff.php?id=<?php echo $id;?>" class="btn btn-success greenBtn">Update <br> Staff</a>
                                            <a href="<?php echo SITEURL;?>Staff_Page/deleteStaff.php?id=<?php echo $id;?>" class="btn btn-danger redBtn">Delete <br> Staff</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // No staff found
                                echo "<tr><td colspan='6' class='text-center'>No staff found</td></tr>";
                            }
                        }
                    } else {
                        // Query to get all staff
                        $sql = "SELECT * FROM staff";
                        // Execute query
                        $res = mysqli_query($conn, $sql);

                        // Check whether the query is executed or not
                        if ($res == TRUE) {
                            $count = mysqli_num_rows($res); // Count rows to check whether we have data in the database or not
                            $sn = 1; // Create a variable and assign the value
                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    // Get data from the database
                                    $id = $rows['staffID'];
                                    $staffName = $rows['staffName'];
                                    $gender = $rows['staffGender'];
                                    $phoneNum = $rows['staffPhoneNum'];
                                    $email = $rows['staffEmail'];

                                    // Display the values in our table
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $sn++; ?></td>
                                        <td class="text-center"><?php echo $id; ?></td>
                                        <td><?php echo $staffName; ?></td>
                                        <td class="text-center"><?php echo $gender; ?></td>
                                        <td class="text-center"><?php echo $phoneNum; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo SITEURL;?>Staff_Page/changePasswordStaff.php?id=<?php echo $id;?>" class="btn btn-primary blueBtn">Change <br> Password</a>
                                            <a href="<?php echo SITEURL;?>Staff_Page/updateStaff.php?id=<?php echo $id;?>" class="btn btn-success greenBtn">Update <br> Staff</a>
                                            <a href="<?php echo SITEURL;?>Staff_Page/deleteStaff.php?id=<?php echo $id;?>" class="btn btn-danger redBtn">Delete <br> Staff</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                // No staff found
                                echo "<tr><td colspan='6' class='text-center'>No staff found</td></tr>";
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
        <br>
    </div>

    <br><br>
<?php include('partials/footer.php');?>

<script>
    // JavaScript function to sort the table
    function sortTable(columnIndex, ascending) {
        let table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector("table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
                if (ascending ? x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() : x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
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