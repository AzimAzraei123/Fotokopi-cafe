<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="style/loginStyle.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .outerbox {
            display: flex;
            justify-content: center;
            align-items: center;
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
            background-color: #7a4b28;
            /* Darker shade for hover effect */
            color: white;
        }

        .bg-login {
            background-color: rgba(217, 130, 0, 1);
        }
    </style>
</head>

<body class="bg1">
    <!-- Navbar -->
    <?php include ('partials/navbar.php'); ?>

    <br><br><br><br>
    <!-- Registration form -->
    <div class="outerbox">
        <div class="container-fluid light-container">
            <form id="registrationForm" action="RegisterProcess.php" method="post">
                <fieldset>
                    <legend>
                        <center>Customer Registration Page</center><br>
                    </legend>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="custName" placeholder="Insert username"
                            name="custName" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Insert email" name="custEmail"
                            required>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" id="phone" placeholder="Insert Phone Number" name="custPhoneNumber"
                            required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Insert password"
                            name="custPassword" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" id="confirmPassword"
                            placeholder="Confirm your password" name="confirmPassword" required>
                    </div>
                </fieldset>
                <div class="text-center mt-4">
                    <center><button id="registerButton" type="submit" value="submit"
                            class="btn btn-custom">Sign Up</button></center><br>
                    <center><button type="button" class="btn btn-custom" onclick="window.location.href='login.php'">Login</button></center>
                </div>
            </form>
        </div>
    </div>

    <br>

    <script>
        function validateForm(event) {
            event.preventDefault(); // Prevent the form from submitting by default

            // Get the values of the email and password fields
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Check if the email contains the "@" symbol
            if (!email.includes("@")) {
                alert("Please enter a valid email address.");
                return;
            }

            // Check if the password has a minimum length of 8 characters
            if (password.length < 8) {
                alert("Password must have a minimum length of 8 characters.");
                return;
            }

            // Check if the passwords match
            var confirmPassword = document.getElementById("confirmPassword").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return;
            }

            // Check if all fields are filled
            var inputs = document.querySelectorAll("#registrationForm input, #registrationForm select");
            for (var i = 0; i < inputs.length; i++) {
                if (!inputs[i].value) {
                    alert("Please fill in all fields.");
                    return;
                }
            }

            // Check if phone number is numeric
            var phoneNumber = document.getElementById("phone").value;
            if (!/^\d+$/.test(phoneNumber)) {
                alert("Phone number should be numeric only.");
                return;
            }

            // If all validations pass, submit the form
            document.getElementById("registrationForm").submit();
        }

        // Attach the form submission handler to the submit button
        var submitButton = document.getElementById("registerButton");
        submitButton.addEventListener("click", validateForm);

    </script>


    <?php include ('partials/footer.php'); ?>