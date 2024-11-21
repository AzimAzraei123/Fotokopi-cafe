<?php
// Execute query
$res = mysqli_query($conn, $sql);

if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        // Retrieve data from the database
        $foodID = $row['foodID'];
        $foodName = $row['foodName'];
        $description = $row['foodDetails'];
        $pricePerItem = $row['foodPrice'];
        $menuPic = $row['menuPic'];
        ?>
        <div class="col-lg-12">
            <div class="container bg-light rounded">
                <br>
                <div class="row align-items-center">
                    <div class="col">
                        <h4><?php echo htmlspecialchars($foodName); ?></h4>
                    </div>
                    <div class="col-auto">
                        <h5>RM <?php echo $pricePerItem ?></h5>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#moreInfoModal<?php echo $foodID; ?>">+</button>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <div class="modal fade" id="moreInfoModal<?php echo $foodID; ?>" tabindex="-1"
            aria-labelledby="moreInfoModal<?php echo $foodID; ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="myForm<?php echo $foodID; ?>" method="POST" action="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="moreInfoModal<?php echo $foodID; ?>Label">
                                <?php echo htmlspecialchars($foodName); ?> - RM
                                <?php echo htmlspecialchars($pricePerItem); ?> per item
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container d-flex w-75 justify-content-center">
                                <img src="<?php echo $menuPic ?>" alt="<?php echo $foodName ?>" class="d-flex w-75">
                            </div>
                            <p class="text-center"><?php echo htmlspecialchars($description); ?></p>
                            <div class="d-flex justify-content-end">
                                <div class="input-group mb-3 w-50">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Quantity:</span>
                                    </div>
                                    <button class="btn btn-dark" type="button" id="decreaseQtyBtn">-</button>
                                    <input type="hidden" name="index" value="<?php echo $foodID; ?>">
                                    <input type="text" class="form-control text-center" id="orderQtyInput"
                                        name="quantity[<?php echo $foodID; ?>]" value="1" readonly>
                                    <button class="btn btn-dark" type="button" id="increaseQtyBtn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-dark" id="addToCartBtn" data-bs-dismiss="modal"
                                name="foodName[<?php echo $foodID; ?>]" value="<?php echo htmlspecialchars($foodName); ?>">Add
                                to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <?php
    }
}
else{
    echo "No items available for this section";
}
?>