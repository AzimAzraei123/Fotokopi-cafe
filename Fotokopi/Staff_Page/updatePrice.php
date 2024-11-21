<?php
// Include constant.php
include('../config/constants.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required fields are set
    if (isset($_POST['foodID'], $_POST['newPrice'], $_POST['newFoodName'], $_POST['newDescription'], $_POST['newImage'])) {
        // Get the foodID, newPrice, newFoodName, newDescription, newImage, and optionally newTypeName from the POST data
        $id = $_POST['foodID'];
        $price = $_POST['newPrice'];
        $foodName = $_POST['newFoodName'];
        $description = $_POST['newDescription'];
        $menuPic = $_POST['newImage'];
        $typeName = isset($_POST['newTypeName']) ? $_POST['newTypeName'] : null; // newTypeName is optional

        // Ensure numeric value for price (optional, depending on your requirements)
        $price = is_numeric($price) ? $price : 0;

        // Prepare the SQL update query with updateTime
        if ($typeName) {
            // Include newTypeName if it's provided
            $stmt = $conn->prepare("UPDATE menu SET foodPrice = ?, foodName = ?, foodDetails = ?, menuPic = ?, typeName = ?, updateDate = CURRENT_DATE WHERE foodID = ?");
            $stmt->bind_param("dssssi", $price, $foodName, $description, $menuPic, $typeName, $id); // "d" = double, "s" = string, "i" = integer
        } else {
            // Exclude newTypeName if not provided
            $stmt = $conn->prepare("UPDATE menu SET foodPrice = ?, foodName = ?, foodDetails = ?, menuPic = ?, updateDate = CURRENT_DATE WHERE foodID = ?");
            $stmt->bind_param("dsssi", $price, $foodName, $description, $menuPic, $id); // "d" = double, "s" = string, "i" = integer
        }

        $res = $stmt->execute();

        // Check if the query was successful
        if ($res) {
            // Update successful, set a success message in the session variable
            $_SESSION['update'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Menu Updated Successfully</div>";
        } else {
            // Update failed, set an error message in the session variable
            $_SESSION['update'] = "<div class='alert alert-danger alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Failed to update menu. Try again later.</div>";
        }
    } else {
        // Invalid or missing data, set an error message in the session variable
        $_SESSION['update'] = "<div class='alert alert-danger alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Invalid data. Please try again.</div>";
    }
} else {
    // If the form is not submitted directly, redirect back to the viewMenu.php page
    header('location:' . SITEURL . 'Staff_Page/menuView.php');
    exit;
}

// Redirect back to the viewMenu.php page after processing the update
header('location:' . SITEURL . 'Staff_Page/menuView.php');
exit;
?>