<?php
include ('partials/navbar.php');
include ('calculate.php');
?>


<div class="container bg-light p-5 my-5 jumbotron rounded">
    <h1>
        <center>Order Menu</center>
    </h1>
</div>
<!-- 2nd navigation bar -->
<nav class="navbar navbar-expand-sm wholeNav fixed">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto me-auto">
            <li class="nav-item ">
                <a class="btn btn-warning mx-2 " href="#section1">Promotion</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-warning mx-2" href="#section2">Coffee</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-warning mx-2" href="#section3">Pastry</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-warning mx-2" href="#section4">Cakes</a>
            </li>
        </ul>
    </div>
</nav>


<div id="section1" class="container-fluid bg-promo" style="padding:50px 20px;">
    <h1>Promotion</h1><br>
    <div>
        <?php
        $sql = "SELECT * FROM menu WHERE typeName = 'Promotion' ";
        ?>
        <?php include ('partials/orderContainer.php'); ?>
    </div>
</div>

<div id="section2" class="container-fluid bg-coffee" style="padding:50px 20px;">
    <h1>Coffee</h1><br>
    <div>
        <?php
        $sql = "SELECT * FROM menu WHERE typeName = 'coffee' ";
        ?>
        <?php include ('partials/orderContainer.php'); ?>
    </div>
</div>

<div id="section3" class="container-fluid bg-pastry" style="padding:50px 20px;">
    <h1>Pastry</h1><br>
    <div>
        <?php
        $sql = "SELECT * FROM menu WHERE typeName = 'pastry' ";
        ?>
        <?php include ('partials/orderContainer.php'); ?>
    </div>
</div>
<div id="section4" class="container-fluid bg-pink" style="padding:50px 20px;">
    <h1>Cakes</h1><br>
    <div>
        <?php
        $sql = "SELECT * FROM menu WHERE typeName = 'cakes' ";
        ?>
        <?php include ('partials/orderContainer.php'); ?>
    </div>
</div>

<br>
<br>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var decreaseQtyBtns = document.querySelectorAll('#decreaseQtyBtn');
        var increaseQtyBtns = document.querySelectorAll('#increaseQtyBtn');
        var orderQtyInputs = document.querySelectorAll('#orderQtyInput');

        // Add event listeners to decrease quantity buttons
        decreaseQtyBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = this.parentNode.querySelector('input[type="text"]');
                var value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            });
        });

        // Add event listeners to increase quantity buttons
        increaseQtyBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = this.parentNode.querySelector('input[type="text"]');
                var value = parseInt(input.value);
                input.value = value + 1;
            });
        });
    });
</script>

<?php include ('partials/footer.php'); ?>