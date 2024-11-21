<?php
include ('partials/navbar.php');

?>

<div>
    <div id="carouselIndex" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselIndex" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselIndex" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselIndex" data-bs-slide-to="2"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../menu_pic/4.jpg" class="d-block w-100 " alt="Slide 1">
                <div class="carousel-caption">
                    <h3>Sip, Savor, Smile</h3>
                    <p>Where Coffee Meets Comfort.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../menu_pic/3.png" class="d-block w-100 " alt="Slide 2">
                <div class="carousel-caption">
                    <h3>Savor The Taste</h3>
                    <p>Pastry Perfection, Coffee Connection.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../menu_pic/7.jpg" class="d-block w-100 " alt="Slide 3">
                <div class="carousel-caption">
                    <h3>Warmth in Every Sip and Bite.</h3>
                    <p>Flavorful Delights at Affordable Prices.</p>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#carouselIndex" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndex" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>
<br><br>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="container promoPic1  rounded">
                    <br><br><br><br><br><br><br><br><br><br><br>
                    <h1 class="text-light">
                        Latest Product
                    </h1> 
                    <br>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="container promoPic2  rounded">
                    <br><br><br><br><br><br><br><br><br><br><br>
                    <h1 class="text-light">
                        Most Popular
                    </h1> 
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="container orderPage rounded text-center">
                    <br><br>
                    <button class="btn1 rounded">
                        <a href="order.php?id=<?php echo $id ?>" class="btn text-light">Start Order</a>
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="container MyProfile rounded text-center">
                <br><br>
                <button class="btn1 rounded">
                    <a href="custProfile.php?id=<?php echo $id ?>" class="btn text-light">My Profile</a>
                </button>
                <br><br>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<?php include ('partials/footer.php'); ?>