<?php

session_start();

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';



?>


<!-- ------------------------------------------------ -->
<!-- ----------------HTML START---------------------- -->
<!-- ------------------------------------------------- -->


<!DOCTYPE html>
<html lang="en">

<head>

  <!-- ---------------------------------------------------------- -->
  <!-- -------------INCLUDES COMMON HEAD . START----------------- -->


  <head>
    <?php include './components/header.html' ?>
  </head>

  <link rel="stylesheet" href="/css/contact.css">
  <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
  <!-- ---------------------------------------------------------- -->

</head>


<body>


  <!-- ----------------------------------------------------------------- -->
  <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


  <?php include '_navbar.php' ?>

  <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
  <!-- ----------------------------------------------------------------- -->
  <div class="container">
    <div class="container text-center mt-5">
      <h1>About Us</h1>
    </div>
  </div>

  <div class="container-fluid contFull coba mt-4 text-center p-5">
    <h2>Lifestyle Lab - From Fashion to Fun</h2>
    <br>
    <div class="container p-10">
      <h3>Explore Our Diverse Selection of Products</h3>
    </div>
  </div>

  <div class="container mt-3 text-center p-5">
    <div class="container p-10">
      <p style="font-size: larger;">At The Lifestyle Lab, we curate the latest trends and must-have products for the fashion-forward and style-conscious individual. Our mission is to inspire and empower our customers to express their unique sense of style through high-quality products that make a statement. Shop with us for a curated selection of fashion, accessories, and lifestyle essentials that will elevate your wardrobe and enhance your everyday life.</p>
    </div>
  </div>

  <section id="home" class="bg-cover hero-section" style="background-image: url(/images/brand/lifestyle.png);">
    <div class="overlay"></div>
    <div class="container text-white text-center">
      <div class="row">
        <div class="col-12">
          <h1 class="display-4 fw-bold" data-aos="zoom-in">Step into Style</h1>
          <h5 class="my-4" data-aos="fade-up">Unique Fashion and Lifestyle Products</h5>
          <a href="./product_all.php" data-aos="fade-up" class="btn btn-info">See all Products</a>
        </div>
      </div>
    </div>
  </section>

  <div class="container mt-3 text-center p-5">
    <div class="container p-10">
      <p style="font-size: larger;">Our team at The Lifestyle Lab is made up of fashion enthusiasts and trendsetters who are dedicated to providing our customers with the latest and most stylish products on the market. We are committed to serving as your go-to destination for all things fashion, accessories, and lifestyle essentials. With a keen eye for quality and a passion for curating the best products, we strive to help you elevate your wardrobe and enhance your everyday life with our carefully selected items. Join us in embracing your unique sense of style and making a statement with our handpicked selection of must-have products.</p>
    </div>
  </div>


  <div class="container-fluid contFull coba mt-4 text-center p-5">
    <img src="/images/brand/about.png" class="img-fluid" alt="">
  </div>


  <div class="container-fluid contFull mt-4 text-center p-5">
    <h2>Explore, Play, Train, Create</h2>
    <br>
    <div class="container p-10">
      <h3>Your Complete Lifestyle Experience Starts Here!</h3>
    </div>
  </div>


  <!-- ------------------------------------------------------------ -->
  <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

  <?php include './components/footer.html' ?>


  <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
  <!-- ------------------------------------------------------------ -->

</body>

</html