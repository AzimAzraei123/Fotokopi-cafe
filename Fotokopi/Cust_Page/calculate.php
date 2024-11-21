<?php

function calculateTotalPrice($quantity, $pricePerItem)
{
    // Check if the quantity is numeric
    if (!is_numeric($quantity)) {
        return 0;
    }

    // Calculate the total price
    $totalPrice = $quantity * $pricePerItem;

    return $totalPrice;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the clicked button's index
    $index = isset($_POST['index']) ? (int)$_POST['index'] : 0;

    // Get the values from the form
    $foodName = isset($_POST['foodName'][$index]) ? $_POST['foodName'][$index] : '';
    $quantity = isset($_POST['quantity'][$index]) ? $_POST['quantity'][$index] : '';

    // Retrieve the price per item from the database using an SQL query
    $sql = "SELECT foodID, foodPrice FROM menu WHERE foodName = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $foodName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        // Fetch the data from the result set
        $row = mysqli_fetch_assoc($result);
        $foodID = $row['foodID'];
        $pricePerItem = number_format($row['foodPrice'], 2);

        // Calculate the total price
        $totalPrice = calculateTotalPrice($quantity, $pricePerItem);

        // Create an array with the information
        $foodItem = [
            'foodID' => $foodID,
            'foodName' => $foodName,
            'quantity' => $quantity,
            'pricePerItem' => $pricePerItem,
            'totalPrice' => number_format($totalPrice, 2)
        ];

        // Add the food item to the session array
        $_SESSION['foodItems'][] = $foodItem;
    } else {
        // Handle the case when the food item is not found in the database
        // You can show an error message or take appropriate action here
    }

    // Close the prepared statement and free up the result set
    mysqli_stmt_close($stmt);

    // Redirect to the same page after form submission
    header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $id);
    exit();
}

?>
