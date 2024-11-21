<?php
// Include the necessary file for database connectivity
include ('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style/loginStyle.css">

    <style>
        .outerbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
        }

        .light-container {
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #333;
            border-radius: 8px;
        }

        .btn-custom {
            background-color: #975E33;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #7a4b28; /* Darker shade for hover effect */
            color: white;
        }

        .bg-login{
            background-color: rgba(217, 130, 0, 1);
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>

<body class="bg1">
    <?php include ('partials/navbar.php'); ?>
    <!-- Log in form -->
    <div class="outerbox">
        <div class="container-fluid light-container">
            <form action="" method="post">
                <fieldset>
                    <legend>
                        <center>Login Admin Page</center>
                    </legend>
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                    if (isset($_SESSION['register'])) {
                        echo $_SESSION['register'];
                        unset($_SESSION['register']);
                    }
                    ?>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                            name="password" required>
                    </div>
                    <div class="form-check mb-5">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="showPasswordCheckbox"
                                onchange="togglePasswordVisibility()">Show password
                        </label>
                    </div>
                </fieldset>
                <center><button name="loginBtn" type="submit" value="submit" class="btn btn-custom">Login</button></center><br>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['loginBtn'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Note: Using md5($_POST['password']); for demonstration purposes only, not recommended for real-world applications
    
        // Prepare the SQL query to check customer credentials
        $sql = "SELECT * FROM staff WHERE staffEmail = '$email' AND staffPassword = '$password'";
        $res = mysqli_query($conn, $sql); // Execute the query
    
        if ($res) {
            // Check if a matching user is found
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $custID = $row['staffID'];
                $_SESSION['login'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Login Successful</div>";
                header('Location:' . SITEURL . 'Staff_Page/index.php');
                exit();
            } else {
                $_SESSION['login'] = "<div class='alert alert-danger alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Login Failed</div>";
                header('Location:' . SITEURL . 'loginStaff.php');
                exit();
            }
        } else {
            echo "Query Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>

</html>