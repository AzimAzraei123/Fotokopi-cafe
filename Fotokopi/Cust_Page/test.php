<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['team'])) {
        // Get the selected team and quantity
        $team = $_POST['team'];
        $quantity = $_POST['quantity'];

        // Store the order details in the session
        $_SESSION['cart'][$team] = $quantity;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Page</title>
    <!-- Add necessary CSS and Bootstrap 5 CDN links here -->
    <link rel="stylesheet" href="cust.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
</head>
<body>
    <h1>Order Page</h1>

    <div class="container_1">
        <div class="sub-container">
            <div class="teams">
                <img src="team1.jpg" alt="Team 1">
                <div class="name">Team 1</div>
                <div class="desig">Designer</div>
                <div class="about">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <div class="social-links">
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Add to Cart</button>
            </div>

            <!-- Repeat the above container structure for other teams -->
            <!-- Make sure to update the image, name, designation, about, and social links for each team -->
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal1Label">Set Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="order.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="quantity1">Quantity:</label>
                            <input type="number" class="form-control" id="quantity1" name="quantity" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" name="team" value="team1">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Repeat the modal structure for other teams -->

    <a href="cart.php" class="btn btn-primary"><i class="bi bi-cart"></i> Go to Cart</a>

    <!-- Add necessary JavaScript and Bootstrap 5 CDN links here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
