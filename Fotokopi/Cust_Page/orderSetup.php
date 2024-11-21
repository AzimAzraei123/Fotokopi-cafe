<?php
include ('partials/navbar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $eatOption = $_POST['eatOption'];
    $paymentMethod = $_POST['paymentMethod'];

    // Store form data in session
    $_SESSION['eatOption'] = $eatOption;
    $_SESSION['paymentMethod'] = $paymentMethod;

    // Store address only if "Delivery" option is selected
    if ($eatOption === "Delivery") {
        $address = $_POST['address'];
        $_SESSION['address'] = $address;
    }

    // Redirect to payment.php
    header("Location: payment.php?id=$id");
    exit();
}
?>

<div class="container bg-light p-5 my-5 jumbotron rounded">
    <h1 class="text-center">Order Setup</h1>
</div>
<div class="container bg-dark text-light rounded">
    <form action="" method="post" id="orderForm">
        <br>
        <p>Eat Option:</p>
        <select name="eatOption" id="eatOption" class="form-select" required>
            <option value="Dine in">Dine in</option>
            <option value="Takeaway">Takeaway</option>
        </select>
        <br>
        <!-- 
        <h6 style="color:red;"><i>Pay at the counter </i></h6> -->
        <p>Payment Method:</p>
        <select name="paymentMethod" id="paymentMethod" class="form-select" required>
            <option value="Cash">Cash</option>
            <option value="Debit/Credit Card">Debit/Credit Card</option>
            <option value="Online Transaction (FPX)">Online Transaction (FPX)</option>
        </select>
        <br>
        <div class="row justify-content-between">
            <div class="col text-start">
                <br>
                <a href="cart.php?id=<?php echo $id ?>" class="btn btn-warning">Back to Cart</a>
            </div>
            <div class="col text-end">
                <br>
                <button type="submit" class="btn btn-warning">Go to Payment</button>
            </div>
        </div>

        <br><br>
    </form>
</div>

<br><br>

<script>
    // Validate address field dynamically based on eat option selection
    document.getElementById('orderForm').addEventListener('submit', function (event) {
        var eatOption = document.getElementById('eatOption').value;
        var addressField = document.getElementById('address');

        if (eatOption === 'Delivery' && addressField.value.trim() === '') {
            addressField.setCustomValidity('Please enter your address for delivery.'); // Show validation message
            event.preventDefault(); // Prevent form submission
            alert('Please enter your address for delivery.');
            window.location.reload(); // Reload the page
        } else {
            addressField.setCustomValidity(''); // Clear validation message
        }
    });
</script>


<br><br>
<?php include ('partials/footer.php'); ?>