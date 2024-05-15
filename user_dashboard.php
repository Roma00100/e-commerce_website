<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

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


    <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
    <!-- ---------------------------------------------------------- -->

</head>


<body>


    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include '_navbar.php' ?>
    <?php include '_navbardash.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->




    <h3 class="text-center p-4 mb-3 ">MANAGE USERS</h3>

    <div class='card container bg-body-custom mt-3'>
        <div class='row'>
            <?php
            foreach ($row_all_users as $val) {
                echo "<div class='col-md-4'>
                        <div class='card shadow-lg p-3 mb-5 mt-5 mx-auto' style='max-width: 300px;'>
                            <img class='w-75 p-4' src='./images/user/{$val['user_img']}' alt='...'>
                            <div class='card-body d-flex flex-column p-4'>
                                <h5 class='card-title'>First name: {$val['fname']}</h5>
                                <h5 class='card-title'>Last name: {$val['lname']}</h5>
                                <h6 class='card-title'>Email: {$val['email']}</h6>
                                <p class='card-text'>Address: {$val['adress']}</p>
                                <p class='card-text'>Role: {$val['role']}</p>
                                <p class='card-text'>Ban expiry: {$val['ban_expiry']}</p>
                                <div class='btn-group'>
                                    <a href='user_edit_admin.php?id={$val['id']}' class='mybtn btn btn-info'>Edit user</a>
                                    <a href='user_delete.php?id={$val['id']}' class='mybtn btn btn-dark'>Delete user</a>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>



    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>