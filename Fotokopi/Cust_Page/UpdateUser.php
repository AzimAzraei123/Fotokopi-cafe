<?php
include ('partials/navbar.php');
?>

<?php
// get the id
$id = $_GET['id'];
// create sql query
$sql = "SELECT * FROM customer WHERE custID=$id";

// execute query
$res = mysqli_query($conn, $sql);

// check if the query executed successfully
if ($res == true) {
    // check if the staff exists
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $custName = $row['custName'];
        $phoneNum = $row['custPhoneNumber'];
        $email = $row['custEmail'];
    } else {
        header('location: ' . SITEURL . 'Staff_Page/manageStaff.php');
        exit(); // terminate the script
    }
}
?>
<div class="outerbox">
    <div class="container-fluid dark-container bg-dark rounded w-50">
        <form action="" method="post">
            <fieldset>
                <img src="../pic/Logo.png" alt="Company Logo" width="200px" class="d-block w-50 mx-auto">
                <legend class="text-center">Update Customer Information</legend>
                <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Add hidden input field for the ID -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="custEmail"
                        value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Enter full name" name="custName"
                        value="<?php echo $custName; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Enter phone number"
                        name="custPhoneNumber" value="<?php echo $phoneNum; ?>" required>
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <button type="submit" name="submit" class="btn btn-warning">Update</button><br><br>
            </div>
        </form>
    </div>
</div>
<br>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $custName = $_POST['custName'];
    $phoneNum = $_POST['custPhoneNumber'];
    $email = $_POST['custEmail'];

    // Create SQL query for updating the admin
    $sql = "UPDATE customer SET 
            custName = '$custName',
            custPhoneNumber = '$phoneNum',
            custEmail = '$email'
            WHERE custID = $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Customer Updated Successfully</div>";
        header('location: ' . SITEURL . 'Cust_Page/custProfile.php?id=' . $id);
        exit(); // terminate the script
    } else {
        $_SESSION['update'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to update Customer. Try again later.</div>";
        header('location: ' . SITEURL . 'Cust_Page/custProfile.php?id=' . $id);
        exit(); // terminate the script
    }
}
?>

<?php include ('partials/footer.php'); ?>