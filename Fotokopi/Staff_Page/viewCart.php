<?php include('partials/menu.php'); ?>

<?php 
    // get the id
    $id = $_GET['id'];
    // create sql query
    $sql = "SELECT * FROM cart WHERE orderID=$id";

    // execute query
    $res = mysqli_query($conn, $sql);

    // check if the query executed successfully
    if ($res == false) {
        header('location: ' . SITEURL . 'Staff_Page/manageOrder.php');
        exit(); // terminate the script
    }
?>

<div class="container mt-3">
    <div class="mt-4 p-5 bg-light text-bg-light rounded">
        <h1>
            <img src="../pic/Logo.png" alt="Company Logo" width="200px">
            View Cart
        </h1>
    </div>
</div>
<br>
<div class="container bg-light rounded">
    <br>
    <!-- cart from the order -->
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-dark me-2" onclick="sortTable(true)">Sort Ascending</button>
            <button class="btn btn-dark" onclick="sortTable(false)">Sort Descending</button>
        </div>
    </div>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">orderID</th>
                <th class="text-center">Food Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // query to get the specific order
            $sql = "SELECT * FROM cart WHERE orderID=$id";
            // execute query
            $res = mysqli_query($conn,$sql);

            if($res==TRUE){
                // count the rows
                $sn=1;
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        // get the data
                        $cartID = $row['cartID'];
                        $orderID = $row['orderID'];
                        $foodname = $row['foodName'];
                        $quantity = $row['quantity'];
                        $price = $row['totalPrice'];
                        // Display the data
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $sn++; ?></td>
                            <td class="text-center"><?php echo $orderID; ?></td>
                            <td><?php echo $foodname; ?></td>
                            <td class="text-center"><?php echo $quantity; ?></td>
                            <td class="text-center"><?php echo $price; ?></td>
                        </tr>
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
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
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
