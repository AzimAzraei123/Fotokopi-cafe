<?php
// Process the form values and save them in the database
if(isset($_POST['submit'])){
    $price = $_POST['newPrice'];
    $foodName = $_POST['newFoodName'];
    $description = $_POST['newDescription'];
    $menuPic = $_POST['newImage'];
    $typeName = isset($_POST['newTypeName']) ? $_POST['newTypeName'] : null; // newTypeName is optional

    // SQL query to save the data into the database
    $sql = "INSERT INTO menu SET
        foodName='$foodName',
        foodDetails='$description',
        foodPrice='$price',
        menuPic='$$menuPic',
        updateDate= CURRENT_DATE,
        typeName= '$typeName'
    ";

    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); // Database connection
    $db_select = mysqli_select_db($conn, 'fotokopi') or die(mysqli_error()); 

    // Execute query and save the data into the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

    // Check whether the data is inserted or not and display a message
    if($res==TRUE){
        // echo "Data inserted";
        $_SESSION['add'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Menu added successfully</div>";
        
        // Redirect page to manage staff
        header("location: " . SITEURL . 'Staff_Page/menuView.php');
        exit(); // Terminate the script after redirecting
    } else {
        echo "Failed to insert data";
    }
}
?>
