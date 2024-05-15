<?php

session_start();

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';

require_once './vendor/autoload.php';
require_once './secrets.php';

$user_id = $_SESSION['user'];

$sql_cart = "SELECT 
b.fk_user,
b.fk_product,
b.amount,
p.name,
p.price,
p.img,
p.stripe_id

FROM `basket` as b
JOIN product as p on b.fk_product = p.id
WHERE fk_user = $user_id AND b.order_date is NULL";

$result_sql_cart = mysqli_query($connect, $sql_cart);
$cart_rows = mysqli_fetch_all($result_sql_cart, MYSQLI_ASSOC);

$cart_array = [];
foreach ($cart_rows as $val) {
    $cart_array[] = [
        'price' => $val['stripe_id'],
        'quantity' => $val['amount'],
    ];
};

// var_dump($cart_array);
// print_r($cart_array);
// exit();

header('Content-Type: application/json');

$stripe = new \Stripe\StripeClient($stripeSecretKey);

$YOUR_DOMAIN = 'http://localhost:3000';

//Domain for online version
// $YOUR_DOMAIN = 'https://lifestylelab.at';

$checkout_session = $stripe->checkout->sessions->create([
    'line_items' => [
        $cart_array,
    ],
    'mode' => 'payment',
    // 'success_url' => $YOUR_DOMAIN . '/cart_buy.php?session_id=' . $checkout_session->id,
    'success_url' => $YOUR_DOMAIN . '/cart_buy.php',
    'cancel_url' => $YOUR_DOMAIN . '/cart.php',
]);
// var_dump($checkout_session->id);
// exit();
// header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
