<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
}


require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';

$error = false;

$email = "";
$emailError = $passError = "";


if (isset($_POST["login"])) {
    $email = clearData($_POST["email"]);
    $password = clearData($_POST["password"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please, enter a valid email!";
    }

    if (empty($password)) {
        $error = true;
        $passError = "Please, enter your password!";
    }

    if (!$error) {
        $password = hash("sha256", $password);

        $sql_login = "SELECT * FROM `user` WHERE `password` = '$password' and `email` = '$email'";

        $result_login = mysqli_query($connect, $sql_login);

        $row_login = mysqli_fetch_assoc($result_login);


        if (mysqli_num_rows($result_login) == 1) {
            if ($row_login["fk_role"] == '1') {
                $_SESSION["user"] = $row_login["id"];
                header("Location: index.php");
            } else if ($row_login["fk_role"] == '2') {
                $_SESSION["admin"] = $row_login["id"];
                header("Location: admin_dashboard.php");
            } else {
                // $_SESSION["banned"] = $row_login["id"];
                header("Refresh: 4; user_logout.php");
                echo "<div class='alert alert-danger'>
                <p>You are temporarily suspended from login, try again after $row_login[ban_expiry]</p>
              </div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>
    <p>Something went wrong, please try again later ...</p>
  </div>";
    }
}




?>

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


    <?php
    include '_navbar.php';

    ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->



    <div id="c" class="card shadow p-3 container bg-body-custom mt-5">

        <div class="container text-center mt-4">
            <h3>LOGIN</h3>
        </div>
        <div id="register" class="container p-4">

            <form method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Type your email" value="<?= $email ?>">
                    <span class="text-danger"><?= $emailError ?></span>
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

        <div class="d-flex justify-content-evenly align-items-center p-2">
            <button type="submit" name="login" class="btn btn-dark">Login</button>
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