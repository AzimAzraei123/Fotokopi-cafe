<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotokopi Admin Page</title>

    <link rel="stylesheet" href="staff.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- for icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body class="bg-gradient bg-warning">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <img class="navbar-brand logo-size logo-animation" src="../pic/Logo.png" alt="Logo" style="width: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageStaff.php">Manage Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageCustomer.php">Manage Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageOrder.php">Manage Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menuView.php">View Menu</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <img class="logo-icon orange-logo" src="../pic/user.png" alt="Login" style="width: 30px;"> Logout
                        </a>
                    </li>
                </ul>         
            </div>
        </div>
    </nav>
    <br><br><br><br><br>