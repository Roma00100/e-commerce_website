<?php

require './php_db/db_connect.php';

// ----------------------------------
// ---------ALL USERS----------------
// ----------------------------------


$sql_all_users = "SELECT
u.id,
u.fname,
u.lname,
u.email,
u.adress,
u.registered,
u.user_img,
u.password,
u.fk_role,
u.ban_expiry,
ur.role 

FROM `user` as u
JOIN `user_role` ur on u.fk_role = ur.id";

$result_all_users = mysqli_query($connect, $sql_all_users);
$row_all_users = mysqli_fetch_all($result_all_users, MYSQLI_ASSOC);

// ----------------------------------
// ---------ALL PRODUCTS-------------
// ----------------------------------


$sql_all_products = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img

FROM `product` as p
WHERE fk_status = 1";

$result_all_products = mysqli_query($connect, $sql_all_products);
$row_all_products = mysqli_fetch_all($result_all_products, MYSQLI_ASSOC);


// ----------------------------------
// ---------Fashion category-------------
// ----------------------------------


$sql_fashion = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img

FROM `product` as p
JOIN `product_type` pt on p.fk_type = pt.id
WHERE pt.id = 1 AND fk_status = 1";

$result_fashion = mysqli_query($connect, $sql_fashion);
$row_fashion = mysqli_fetch_all($result_fashion, MYSQLI_ASSOC);


// ----------------------------------
// ---------Shoes category-------------
// ----------------------------------


$sql_shoes = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img

FROM `product` as p
JOIN `product_type` pt on p.fk_type = pt.id
WHERE pt.id = 2 AND fk_status = 1";

$result_shoes = mysqli_query($connect, $sql_shoes);
$row_shoes = mysqli_fetch_all($result_shoes, MYSQLI_ASSOC);


// -----------------------------------------
// ---------Accessories category-------------
// ----------------------------------------


$sql_accessories = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img

FROM `product` as p
JOIN `product_type` pt on p.fk_type = pt.id
WHERE pt.id = 3 AND fk_status = 1";

$result_accessories = mysqli_query($connect, $sql_accessories);
$row_accessories = mysqli_fetch_all($result_accessories, MYSQLI_ASSOC);


// -----------------------------------------
// ---------Entertainment category-------------
// ----------------------------------------


$sql_entertainment = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img

FROM `product` as p
JOIN `product_type` pt on p.fk_type = pt.id
WHERE pt.id = 4 AND fk_status = 1";

$result_entertainment = mysqli_query($connect, $sql_entertainment);
$row_entertainment = mysqli_fetch_all($result_entertainment, MYSQLI_ASSOC);
