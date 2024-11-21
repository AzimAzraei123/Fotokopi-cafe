<?php

include ('../config/constants.php');

session_unset();

session_destroy();

?>

<!DOCTYPE html>
<html>

<head>
  <title>Redirect</title>
  <script>
    window.onload = function () {
      window.location.href = '../loginStaff.php';
    }
  </script>
</head>

<body>
</body>

</html>