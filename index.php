<?php

session_start();

require_once "./php_db/db_connect.php";
require_once './php_db/query.php';

$sql = "SELECT p.*, pt.type AS product_type_name 
        FROM product p 
        LEFT JOIN product_type pt ON p.fk_type = pt.id
        ORDER BY RAND()
        LIMIT 3";

$result = mysqli_query($connect, $sql);

$layout = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout .= "<div class='col-lg-4 col-md-6 col-sm-12'>
                <div class='card shadow p-2 mb-4' style='width: 100%;'>
                    <a href='product_details.php?id={$row["id"]}' class='card-link'>
                        <img src='/images/product/{$row["img"]}' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h3 class='card-title'>{$row["name"]}</h3>
                            <h5 class='card-text'>{$row["product_type_name"]}</h5>
                            <h4 class='card-text'>{$row["price"]}</h4>
                            <br>
                            <a href='product_details.php?id={$row["id"]}' class='btn btn-info'>Details</a>
                        </div>
                    </a>
                </div>
            </div>";
    }
} else {
    $layout = "<p>No results found</p>";
}

// mysqli_close($connect);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './components/header.html' ?>
</head>

<?php include '_navbar.php' ?>

<body>

    <section id="home" class="bg-cover hero-section" style="background-image: url(/images/brand/header.png);">
        <div class="overlay"></div>
        <div class="container text-white text-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-4 fw-bold" data-aos="zoom-in">Stay Ahead of Trends</h1>
                    <p class="my-4" data-aos="fade-up">Explore Our Latest Arrivals and Best Sellers</p>
                    <a href="./product_all.php" data-aos="fade-up" class="btn btn-info">See the Shop</a>
                </div>
            </div>
        </div>
    </section>



    <div class="container px-4 py-5" id="category-cards">
        <h1 class="pb-2 text-center border-bottom">Choose from Top Categorys</h1>

        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('/images/bw3.png');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Fashion Styles</h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <a href="product_search.php?search=fashion"><button class="btn btn-info ps-5 pe-5">MORE
                                    </button></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('/images/bw1.png');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Lifestyle Shoes</h2>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <a href="product_search.php?search=shoes"><button class="btn btn-info ps-5 pe-5">MORE
                                    </button></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('/images/bw2.png');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Around Eyewear</h2>

                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <a href="product_search.php?search=accessories"><button class="btn btn-info ps-5 pe-5">MORE
                                    </button></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid contFull coba mt-4 text-center p-5">
        <h2>Lifestyle Lab - From Wardrobe to Wanderlust</h2>
        <br>
        <div class="container p-10">
            <h3>Shop the Best in Fashion, Travel, and More</h3>
        </div>
        <br>
        <a href="./about.php" data-aos="fade-up" class="btn btn-info animation">More about us</a>
    </div>


    <div class="container text-center p-5 mb-4">
        <h1 class="mt-2 mb-5">New Items just arrived!</h1>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1 g-5">
            <?= $layout ?>
        </div>
    </div>



    <div class="container-fluid contFull coba mt-4 mb-4 text-center p-5">
        <h2>Lifestyle Lab - Explore, Play, Train, Create</h2>
        <br>
        <div class="container p-10">
            <h3>Elevate Every Aspect of Your Lifestyle with Our Diverse Product Range</h3>
        </div>
    </div>



    <div id="carouselExampleIndicators" class="carousel slide mt-5">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/brand/35.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/brand/36.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/brand/37.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    </div>
    <?php include './components/footer.html' ?>
</body>

</html>