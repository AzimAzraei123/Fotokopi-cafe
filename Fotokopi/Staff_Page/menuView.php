<?php include('partials/menu.php'); ?>
<div class="container mt-3">
    <div class="mt-4 p-5 bg-light text-bg-light rounded">
        <h1>
            <img src="../pic/Logo.png" alt="Company Logo" width="200px">
            View Menu
        </h1>
    </div>
</div>
<br>
<div class="container bg-light rounded">
    <br>
    <div class="container">
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // display session message
            unset($_SESSION['add']); // remove session message
        }

        ?>
    </div>
    <div class="container">
        <!-- Search -->
        <form action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="foodID" class="form-control" placeholder="Search MenuID">
                        <button class="btn btn-dark" name="search" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="addMenu.php" class="btn btn-dark text-light me-2">Add Menu</a>
                <a href="updatePrice.php" class="btn btn-dark">Reload Table</a>
            </div>

            <div>
                <button class="btn btn-dark me-2" onclick="sortTable(false)">Sort Descending</button>
                <button class="btn btn-dark" onclick="sortTable(true)">Sort Ascending</button>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">MenuID</th>
                <th class="text-center w-25">Menu Name</th>
                <th class="text-center">Description</th>
                <th class="text-center">Price Per Item</th>
                <th class="text-center">Update Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all menu items or search based on foodID
            if (isset($_POST['search'])) {
                $searchFoodID = $_POST['foodID'];
                $sql = "SELECT * FROM menu WHERE foodID = '$searchFoodID'";
            } else {
                $sql = "SELECT * FROM menu";
            }

            // Execute query
            $res = mysqli_query($conn, $sql);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    // Retrieve data from the database
                    $foodID = $row['foodID'];
                    $foodName = $row['foodName'];
                    $description = $row['foodDetails'];
                    $pricePerItem = $row['foodPrice'];
                    $updateDate = $row['updateDate'];
                    $menuPic = $row['menuPic'];
                    $typeName = $row['typeName']
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $foodID; ?></td>
                        <td><?php echo $foodName; ?></td>
                        <td><?php echo $description; ?></td>
                        <td class="text-center"><?php echo $pricePerItem; ?></td>
                        <td class="text-center"><?php echo $updateDate; ?></td>
                        <td class="text-center">
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePriceModal<?php echo $foodID; ?>">
                                Update Menu
                            </button>
                        </td>
                    </tr>

                    <!-- Modal for updating the price, food name, and description -->
                    <div class="modal fade" id="updatePriceModal<?php echo $foodID; ?>" tabindex="-1" role="dialog" aria-labelledby="updatePriceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updatePriceModalLabel">Update Details for <?php echo $foodName; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form to update the price, food name, and description -->
                                    <form action="updatePrice.php" method="post">
                                        <input type="hidden" name="foodID" value="<?php echo $foodID; ?>">
                                        <div class="mb-3">
                                            <label for="newFoodName<?php echo $foodID; ?>" class="form-label">Menu Name</label>
                                            <input type="text" class="form-control" id="newFoodName<?php echo $foodID; ?>" name="newFoodName" value="<?php echo $foodName; ?>" placeholder="Enter new food name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPrice<?php echo $foodID; ?>" class="form-label">New Price Per Item</label>
                                            <input type="text" class="form-control" id="newPrice<?php echo $foodID; ?>" name="newPrice" value="<?php echo $pricePerItem; ?>" placeholder="Enter new price" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newDescription<?php echo $foodID; ?>" class="form-label">Description</label>
                                            <textarea class="form-control" id="newDescription<?php echo $foodID; ?>" name="newDescription" placeholder="Enter new description" required><?php echo $description; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newTypeName<?php echo $foodID; ?>" class="form-label">Category</label>
                                            <select name="newTypeName" id="newTypeName" class="form-control" required>
                                                <option value="Promotion" <?php if ($typeName == 'Promotion') echo 'selected'; ?>>Promotion</option>
                                                <option value="Coffee" <?php if ($typeName == 'Coffee') echo 'selected'; ?>>Coffee</option>
                                                <option value="Pastry" <?php if ($typeName == 'Pastry') echo 'selected'; ?>>Pastry</option>
                                                <option value="Cakes" <?php if ($typeName == 'Cakes') echo 'selected'; ?>>Cakes</option>
                                                <option value="Hidden Items" <?php if ($typeName == 'Hidden Items') echo 'selected'; ?>>Hidden Items</option>
                                              
                                                
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newImage<?php echo $foodID; ?>" class="form-label">Image Link</label>
                                            <input type="text" class="form-control" id="newImage<?php echo $foodID; ?>" name="newImage" value="<?php echo $menuPic; ?>" placeholder="Enter new image link">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center">No menu items found</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <br>
</div>
<br>

<?php include('partials/footer.php'); ?>

<script>
    // JavaScript function to sort the table based on foodID
    function sortTable(ascending) {
        let table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector("table");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[0]; // Column index 0 for foodID
                y = rows[i + 1].getElementsByTagName("TD")[0]; // Column index 0 for foodID
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