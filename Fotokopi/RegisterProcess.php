<?php

include ('config/constants.php');
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $dbname = "lck_database";

// $connect = mysqli_connect($hostname, $username, $password, $dbname) OR DIE("Connection Failed");

$custName = $_POST["custName"];
$custPhoneNumber = $_POST["custPhoneNumber"];
$custEmail = $_POST["custEmail"];
$custPassword = md5($_POST["custPassword"]);

$sql = "INSERT INTO customer (custName, custPhoneNumber, custEmail, custPassword) VALUES ('$custName', '$custPhoneNumber', '$custEmail', '$custPassword')";

$sendsql = mysqli_query($conn, $sql);

if ($sendsql) {
    echo "<script>alert('Registration Success');</script>";
    $_SESSION['register'] = "<div class='alert alert-success alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Registration Success</div>";
    header('Location: login.php');
    exit();
} else {
    echo "<script>alert('Registration failed. Try again');</script>";
}
?>