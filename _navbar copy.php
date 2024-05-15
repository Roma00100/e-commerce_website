<!-- --------------------------------------------------------------- -->
<!-- ------------------SHOPPING BASKET PHP START--------------------- -->

<?php

// session_start();

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';


$html_basket_icon = "";
$html_content_nav = "";
$html_content_empty_cart_nav = "";
$total_nav = 0;

if (isset($_SESSION["user"])) {


  $user_id = $_SESSION['user'];
  $html_basket_icon = "<i class='fs-4 bi bi-cart tab myBasketBtn myBasketBtnJS'></i>";


  $sql_cart_nav = "SELECT 
b.amount,
p.name,
p.price

FROM `basket` as b
JOIN product as p on b.fk_product = p.id
WHERE fk_user = $user_id AND b.order_date is NULL";

  $result_sql_cart_nav = mysqli_query($connect, $sql_cart_nav);



  if (mysqli_num_rows($result_sql_cart_nav) == 0) {
    $html_content_empty_cart_nav = "
    <div class='p-5 text-center d-flex align-items-center'><h3> Your shopping cart is empty </h3></div> ";
  } else {

    $cart_rows_nav = mysqli_fetch_all($result_sql_cart_nav, MYSQLI_ASSOC);
    foreach ($cart_rows_nav as $val_nav) {

      $total_nav += $val_nav["amount"] * $val_nav["price"];
      $product_total_nav = $val_nav["amount"] * $val_nav["price"];
      $html_content_nav .= "
            <h6>{$val_nav['name']}</h6>
            <span class='fw-light'>
            Quantity: {$val_nav['amount']} | Price: &euro; $product_total_nav
            </span>
            <hr>
         ";
    }
  }
};

// <!-- ------------------SHOPPING BASKET PHP END----------------------- -->
// <!-- --------------------------------------------------------------- -->


if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {

  $nav_logic = "<a class='et-hero-tab' href='./user_register.php' id='register'>Register</a>";
} else {
  $nav_logic = "<a class='et-hero-tab' href='./user_logout.php' id='register'>Logout</a>";
}

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

  <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
  <!-- ---------------------------------------------------------- -->

</head>

<body>

  <div class="nav-container">

    <div class="nav" id="navbar">

      <div id="header">
        <a href="./index.php"> <img src="images/brand/transpBig1.png" width="110"></a>
      </div>
      <div class="navigation-card">

        <i class="fs-5 bi bi-search tab mySearchIconJS"></i>
        <form class="d-flex mySearchField" role="search" action="product_search.php" method="GET" target="">
          <input class="form-control me-2" id="search" name="search" type="search" placeholder="Search by name or category" aria-label="Search">
        </form>


        <a href="/user_details.php" class="tab">
          <svg width="100" height="100" viewBox="0 0 104 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="21.5" y="3.5" width="60" height="60" rx="30" stroke="black" stroke-width="7"></rect>
            <g clip-path="url(#clip0_41_27)">
              <mask id="mask0_41_27" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="61" width="104" height="52">
                <path d="M0 113C0 84.2812 23.4071 61 52.1259 61C80.706 61 104 84.4199 104 113H0Z" fill="white"></path>
              </mask>
              <g mask="url(#mask0_41_27)">
                <path d="M-7 113C-7 80.4152 19.4152 54 52 54H52.2512C84.6973 54 111 80.3027 111 112.749H97C97 88.0347 76.9653 68 52.2512 68H52C27.1472 68 7 88.1472 7 113H-7ZM-7 113C-7 80.4152 19.4152 54 52 54V68C27.1472 68 7 88.1472 7 113H-7ZM52.2512 54C84.6973 54 111 80.3027 111 112.749V113H97V112.749C97 88.0347 76.9653 68 52.2512 68V54Z" fill="black"></path>
              </g>
            </g>
            <defs>
              <clipPath id="clip0_41_27">
                <rect width="104" height="39" fill="white" transform="translate(0 61)"></rect>
              </clipPath>
            </defs>
          </svg>
        </a>

        <!-- ----------------------------------------------------------- -->
        <!-- ------------------SHOPPING BASKET START--------------------- -->

        <?= $html_basket_icon ?>

        <div class="myBasket d-flex align-items-start flex-column">
          <div class="mb-auto">
            <h5>Shopping Cart</h5>
            <br>

            <div class="myBasketContent">
              <?= $html_content_empty_cart_nav ?>
              <?= $html_content_nav ?>

            </div>
          </div>

          <div class="myBasketBtnNav">
            <h6 class="text-white">Total: &euro; <?= $total_nav ?></h6>
            <a class="myBtnCart btn btn-success" href="./cart.php">Shopping Cart</a>
            <a class="myBtnCart btn btn-dark myBasketBtnJS" href="./product_all.php">Back to Shop</a>
          </div>
        </div>
      </div>

      <!-- ------------------SHOPPING BASKET END----------------------- -->
      <!-- ----------------------------------------------------------- -->

    </div>


    <section class="et-hero-tabs">
      <div class="et-hero-tabs-container">
        <span class="et-wrapper"><a class="et-hero-tab" href="./index.php" id="home">Home</a></span>
        <span class="et-wrapper"><a class="et-hero-tab" href="./product_all.php" id="shop">Shop</a></span>
        <span class="et-wrapper"><a class="et-hero-tab" href="./about.php" id="about">About</a></span>
        <span class="et-wrapper"><a class="et-hero-tab" href="./contact.php" id="contact">Contact</a></span>
        <span class="et-wrapper"><?= $nav_logic ?></span>
      </div>
    </section>

  </div>
  </div>

  <script>
    window.addEventListener('scroll', function() {
      var navContainer = document.querySelector('.nav-container');
      var navbar = document.getElementById('navbar');
      var etHeroTabsContainer = document.querySelector('.et-hero-tabs-container');
      var sticky = navbar.offsetTop;

      if (window.pageYOffset >= sticky) {
        navContainer.classList.add('sticky');
        etHeroTabsContainer.classList.add('sticky');
      } else {
        navContainer.classList.remove('sticky');
        etHeroTabsContainer.classList.remove('sticky');
      }
    });
  </script>
</body>

</html>