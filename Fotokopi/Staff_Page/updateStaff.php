<?php include('partials/menu.php'); ?>

<?php 
    // get the id
    $id = $_GET['id'];
    // create sql query
    $sql = "SELECT * FROM staff WHERE staffID=$id";

    // execute query
    $res = mysqli_query($conn, $sql);

    // check if the query executed successfully
    if ($res == true) {
        // check if the staff exists
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);

            $staffName = $row['staffName'];
            $gender = $row['staffGender'];
            $phoneNum = $row['staffPhoneNum'];
            $email = $row['staffEmail'];
        } else {
            header('location: ' . SITEURL . 'Staff_Page/manageStaff.php');
            exit(); // terminate the script
        }
    }
?>

<div class="outerbox">
    <div class="container-fluid dark-container bg-dark">
        <form action="" method="post">
            <fieldset>
                <img src="../pic/Logo.png" alt="Company Logo" width="200px" class="d-block w-50 mx-auto">
                <legend class="text-center">Update Staff</legend>
                <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Add hidden input field for the ID -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="staffEmail" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" placeholder="Enter full name" name="staffName" value="<?php echo $staffName; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-control" id="gender" name="staffGender" required>
                        <option value=""></option>
                        <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
                        <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="staffPhoneNumber" value="<?php echo $phoneNum; ?>" required>
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
        $staffName = $_POST['staffName'];
        $gender = $_POST['staffGender'];
        $phoneNum = $_POST['staffPhoneNumber'];
        $email = $_POST['staffEmail'];

        // Create SQL query for updating the admin
        $sql = "UPDATE staff SET 
            staffName = '$staffName',
            staffGender = '$gender',
            staffPhoneNum = '$phoneNum',
            staffEmail = '$email'
            WHERE staffID = $id";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {   
            $_SESSION['update'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Staff Updated Successfully</div>";
            header('location: ' . SITEURL . 'Staff_Page/manageStaff.php');
            exit(); // terminate the script
        } else {
            $_SESSION['update'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to update Staff. Try again later.</div>";
            header('location: ' . SITEURL . 'Staff_Page/manageStaff.php');
            exit(); // terminate the script
        }
    }
?>

<?php include('partials/footer.php'); ?>