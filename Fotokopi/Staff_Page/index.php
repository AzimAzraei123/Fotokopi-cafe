<?php include('partials/menu.php');?>

<div class="container mt-3">
    <div class="mt-4 p-5 bg-light text-bg-light rounded">
        <h1>
            <img src="../pic/Logo.png" alt="Company Logo" width="200px">
            Staff Homepage
        </h1>
    </div>
</div>

<br><br>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="bg-light text-center rounded">
                <br>
                <button id="manageStaffBtn" class="btn btn-dark">
                    <span class="fa fa-user-circle fa-3x">
                        <span class="titulo">
                            <br>Manage<br>Staff
                        </span>
                    </span>
                </button>
                <br><br>
                Add, Update and Remove Staff
                <br><br>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-light text-center rounded">
                <br>
                <button id="manageOrderBtn" class="btn btn-dark">
                    <span class="fa fa-shopping-basket fa-3x">
                        <span class="titulo">
                            <br>Manage<br>Order
                        </span>
                    </span>
                </button>
                <br><br>
                Update and View Order
                <br><br>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-light text-center rounded">
                <br>
                <button id="manageCustBtn" class="btn btn-dark">
                    <span class="fa fa-users fa-3x">
                        <span class="titulo">
                            <br>Manage<br>Customer
                        </span>
                    </span>
                </button>
                <br><br>
                Add, Update and Remove Customers
                <br><br>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-light text-center rounded">
                <br>
                <button id="updateMenuBtn" class="btn btn-dark">
                    <span class="fa fa-book fa-3x">
                        <span class="titulo">
                            <br>View<br>Menu
                        </span>
                    </span>
                </button>
                <br><br>
                View and Update Price Of The Menu
                <br><br>
            </div>
        </div>
    </div>
</div>

<br><br>

<?php include('partials/footer.php');?>

<script>
    var manageStaffBtn = document.getElementById('manageStaffBtn');
    var manageOrderBtn = document.getElementById('manageOrderBtn');
    var manageCustBtn = document.getElementById('manageCustBtn');
    var updateMenuBtn = document.getElementById('updateMenuBtn');
    manageStaffBtn.addEventListener('click', function() {
        window.location.href = 'manageStaff.php';
    });
    manageOrderBtn.addEventListener('click', function() {
        window.location.href = 'manageOrder.php';
    });
    manageCustBtn.addEventListener('click', function() {
        window.location.href = 'manageCustomer.php';
    });
    updateMenuBtn.addEventListener('click',function(){
        window.location.href = 'menuView.php';
    });
</script>
