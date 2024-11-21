<?php include('partials/navbar.php'); ?>

<div class="container bg-light p-5 my-5 jumbotron rounded">
    <h1><center>Cart</center></h1>
</div>

<?php    
    // Check if the "Reset" button is clicked
    if (isset($_POST['resetButton'])) {
        // Clear all food items data from the session
        unset($_SESSION['foodItems']);
        // Redirect to the form page
        header('Location: order.php?id='.$id);
        exit();
    }

    // Check if the "Delete" button is clicked for a specific row
    if (isset($_POST['deleteButton']) && isset($_POST['deleteIndex'])) {
        $deleteIndex = (int)$_POST['deleteIndex'];
        // Remove the food item from the session array
        if (isset($_SESSION['foodItems'][$deleteIndex])) {
            unset($_SESSION['foodItems'][$deleteIndex]);
            // Reset the array keys
            $_SESSION['foodItems'] = array_values($_SESSION['foodItems']);
        }
    }
?>

<!-- Display the food items in a table -->
<div class="container mt-5 bg-light rounded">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Quantity</th>
                <th>Price per Item</th>
                <th>Total Price (RM)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])): ?>
                <?php foreach ($_SESSION['foodItems'] as $index => $foodItem): ?>
                    <tr>
                        <td><?php echo $foodItem['foodName']; ?></td>
                        <td><?php echo $foodItem['quantity']; ?></td>
                        <td><?php echo $foodItem['pricePerItem']; ?></td>
                        <td><?php echo $foodItem['totalPrice']; ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="deleteIndex" value="<?php echo $index; ?>">
                                <button type="submit" name="deleteButton" class="btn btn-danger btn-sm">Remove Order</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No food items in the cart</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
</div>
<div class="container">
    <br>
    <div>
        <!-- Add button to reset all data -->
        <form method="post" action="" class="text-center">
            <?php if (isset($_SESSION['foodItems']) && !empty($_SESSION['foodItems'])): ?>
                <div class="container">    
                <button type="submit" name="resetButton" class="btn btn-danger ">Remove All</button><br><br>
                    <a href="orderSetup.php?id=<?php echo $id?>" class="btn btn-dark">Confirm Order</a>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<br><br>
<?php include('partials/footer.php'); ?>
