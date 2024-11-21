<?php
// Process the form values and save them in the database
if(isset($_POST['submit'])){
    $staffName = $_POST['name'];
    $gender = $_POST['gender'];
    $phoneNum = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);//password with encryption(remove md5 if not working)

    // SQL query to save the data into the database
    $sql = "INSERT INTO staff SET
        staffName='$staffName',
        staffGender='$gender',
        staffPhoneNum='$phoneNum',
        staffEmail='$email',
        staffPassword='$password'
    ";

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); // Database connection
    $db_select = mysqli_select_db($conn, 'fotokopi') or die(mysqli_error()); 

    // Execute query and save the data into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

    // Check whether the data is inserted or not and display a message
    if($res==TRUE){
        // echo "Data inserted";
        $_SESSION['add'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Staff added successfully</div>";
        
        // Redirect page to manage staff
        header("location: " . SITEURL . 'Staff_Page/manageStaff.php');
        exit(); // Terminate the script after redirecting
    } else {
        echo "Failed to insert data";
    }
}
?>
