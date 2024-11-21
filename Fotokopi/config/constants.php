<?php
//set date follows the timezone 
date_default_timezone_set('Asia/Kuala_Lumpur');
ob_start();
session_start();
// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create constants to store non-repeating values
define('SITEURL', 'http://localhost/Fotokopi/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fotokopi');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Selecting the database
?>