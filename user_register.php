<?php

session_start();

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
}

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';


$error = false;

$fname = $lname = $email = $adress = $img = "";
$fnameError = $lnameError = $emailError = $adressError = $imgError = $passError = "";


if (isset($_POST["submit"])) {

    $fname = clearData($_POST["fname"]);
    $lname = clearData($_POST["lname"]);
    $email = clearData($_POST["email"]);
    $adress = clearData($_POST["adress"]);
    $img = fileUpload($_FILES["img"]);
    $password = clearData($_POST["password"]);

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


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        // if email is already exists in the database, error will be true
        $query_email = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query_email);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    };

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql_register = "INSERT INTO `user` (`fname`, `lname`, `email`, `adress`, `user_img`, `password`) VALUES ('{$fname}', '{$lname}', '{$email}', '{$adress}','{$img[0]}', '{$password}')";

        if (mysqli_query($connect, $sql_register)) {
            header('Refresh: 2; url=user_login.php');
            echo "<div class='alert alert-info' role='alert'>
            You have succesfully registered. {$img[1]};
              </div>";
            $fname = $lname = $email = $adress = $img = "";
        } else {
            echo "<div class='alert alert-info' role='alert'>
            Error, try again later!
            </div>";
        }
    }
}

?>


<!-- ------------------------------------------ -->
<!-- ----------------HTML---------------------- -->
<!-- ------------------------------------------ -->


<!DOCTYPE html>
<html lang="en">

<!-- ---------------------------------------------------------- -->
<!-- -------------INCLUDES COMMON HEAD . START----------------- -->


<head>
    <?php include './components/header.html' ?>
</head>


<!-- -------------INCLUDES COMMON HEAD . END------------------- -->
<!-- ---------------------------------------------------------- -->



<body>

    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include './_navbar.php' ?>


    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->

    <div class="card shadow p-3 container bg-body-custom mt-5">

        <div class="container text-center mt-4">
            <h3>REGISTER ACCOUNT</h3>
        </div>
        <div class="container p-4">

            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Type your first Name" value="<?= $fname ?>">
                    <span class="text-danger"><?= $fnameError ?></span>
                </div>


                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Type your last Name" value="<?= $lname ?>">
                    <span class="text-danger"><?= $lnameError ?></span>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Type your email" value="<?= $email ?>">
                    <span class="text-danger"><?= $emailError ?></span>
                </div>


                <div class="mb-3">
                    <label for="adress" class="form-label">Your adress</label>
                    <input type="text" class="form-control" id="adress" name="adress" placeholder="Enter your adress" value="<?= $adress ?>">
                    <span class="text-danger"><?= $adressError ?></span>
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image</label>
                    <input type="file" class="form-control" id="img" name="img">
                    <span class="text-danger"><?= $imgError ?></span>
                </div>



                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Type your password" value="">
                        <span class="input-group-text" id="basic-addon3">Show password</span>
                    </div>
                    <span class="text-danger"><?= $passError ?></span>

                </div>
        </div>

        <div class="d-flex justify-content-evenly align-items-center p-2 mb-4">
            <button type="submit" name="submit" class="btn btn-success">Register</button>
            <a class="btn btn-dark" href="./index.php">Home</a>
        </div>
        </form>
    </div>


    <!-- ---------------------------------------------------------- -->
    <!-- -------------INCLUDES COMMON FOOTER . START--------------- -->


    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END----------------- -->
    <!-- ---------------------------------------------------------- -->
</body>

</html>