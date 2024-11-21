<div class="outerbox">
    <div class="container-fluid dark-container bg-dark">
        <form  action="" method="post">
            <fieldset>
                <img src="../pic/Logo.png" alt="Company Logo" width="200px" class="d-block w-50 mx-auto">
                <legend class="text-center">Add New <?php echo $user ?></legend>
                <div class="mb-3">
                    <label for="newFoodName<?php echo $foodID; ?>" class="form-label">Menu Name</label>
                    <input type="text" class="form-control" id="newFoodName<?php echo $foodID; ?>" name="newFoodName" value="" placeholder="Enter new food name" required>
                </div>
                <div class="mb-3">
                    <label for="newDescription<?php echo $foodID; ?>" class="form-label">Description</label>
                    <textarea class="form-control" id="newDescription<?php echo $foodID; ?>" name="newDescription" placeholder="Enter new description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="newPrice<?php echo $foodID; ?>" class="form-label">New Price Per Item</label>
                    <input type="text" class="form-control" id="newPrice<?php echo $foodID; ?>" name="newPrice" value="" placeholder="Enter new price" required>
                </div>
                <div class="mb-3">
                <label for="newTypeName<?php echo $foodID; ?>" class="form-label">Category</label>
                    <select name="newTypeName" id="newTypeName" class="form-control" required>
                        <option value="Hidden Item">Select Category</option>
                        <option value="Promotion" >Promotion</option>
                        <option value="Coffee" >Coffee</option>
                        <option value="Pastry" >Pastry</option>
                        <option value="Cakes" >Cakes</option>    
                    </select>
                </div>
                <div class="mb-3">
                    <label for="newImage<?php echo $foodID; ?>" class="form-label">Image Link</label>
                    <input type="text" class="form-control" id="newImage<?php echo $foodID; ?>" name="newImage" value="" placeholder="Enter new image link">
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <button type="submit" name="submit" class="btn btn-warning">Confirm Add Menu</button><br><br>
            </div>
        </form>
    </div>
</div>
<br>