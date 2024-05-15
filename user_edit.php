<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
}


require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';

$error = false;

$fnameError = $lnameError = $adressError = $imgError = "";


$id = $_GET['id'];


$sql_user = "SELECT
`fname`,
`lname`,
`email`,
`adress`,
`user_img` FROM `user` WHERE id = $id";


$result_user = mysqli_query($connect, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);



if (isset($_POST["submit"])) {

    $fname = clearData($_POST["fname"]);
    $lname = clearData($_POST["lname"]);
    $adress = clearData($_POST["adress"]);
    $user_img = fileUpload($_FILES["user_img"]);



    if (empty($fname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    };

    if (empty($lname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $error = true;
        $lnameError = "Name must contain only letters and spaces.";
    };


    if (empty($adress)) {
        $error = true;
        $adressError = "Please, enter your adress";
    };


    if (!$error) {

        if ($_FILES["user_img"]["error"] == 0) {


            if ($row_user["user_img"] != "no_user.jpg") {
                unlink("./images/user/$row_user[user_img]");
            }

            $sql_update = "UPDATE `user` SET `fname`='{$fname}', `lname`='{$lname}', `adress`='{$adress}', `user_img`='{$user_img[0]}' WHERE `id` = {$id}";
        } else {
            $sql_update = "UPDATE `user` SET `fname`='{$fname}', `lname`='{$lname}', `adress`='{$adress}' WHERE `id` = {$id}";
        }

        // var_dump($sql_update);
        // echo ('<br><br>');
        // print_r($sql_update);
        // exit();

        if (mysqli_query($connect, $sql_update)) {
            header("Refresh: 2; url=index.php");
            echo "<div class='alert alert-info' role='alert'>
            User details have been succesfully updated. {$user_img[1]};
              </div>";
            $fname = $lname = $adress = $user_img = "";
        } else {
            echo "<div class='alert alert-info' role='alert'>
            Error, try again later!
            </div>";
        }
    }
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


    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include '_navbar.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->




    <div class="card shadow p-3 container bg-body-custom mt-5">

        <div class="container text-center mt-4">
            <h3>EDIT USER DETAILS</h3>
        </div>
        <div class="container p-4">


            <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="fname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?= $row_user['fname'] ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>


                <div class="mb-3">
                    <label for="lname" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?= $row_user['lname'] ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>

                <div class="mb-3">
                    <label for="adress" class="form-label">Adress</label>
                    <input type="text" class="form-control" id="adress" name="adress" value="<?= $row_user['adress'] ?>">
                    <span class="text-danger"><?= $adressError ?></span>
                </div>

                <div class="mb-3">
                    <label for="user_img" class="form-label">Image</label>
                    <input type="file" class="form-control" id="user_img" name="user_img">
                    <span class="text-danger"><?= $imgError ?></span>
                </div>

                <img class='w-50' src='./images/user/<?= $row_user['user_img'] ?>' alt='User image'>


        </div>


        <div class="d-flex justify-content-evenly align-items-center p-2 mb-4">
            <button type="submit" name="submit" class="btn btn-success">Update your details</button>
            <a class="btn btn-info" href="./user_details.php">Back</a>
        </div>
        </form>
    </div>

    </div>




    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>