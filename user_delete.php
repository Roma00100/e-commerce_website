<?php


session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
}


require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';


$id = $_GET['id'];

$sql_delete = "SELECT * FROM `user` WHERE id = $id";

$result_delete = mysqli_query($connect, $sql_delete);
$row_delete = mysqli_fetch_assoc($result_delete);



if ($row_delete["user_img"] != "no_user.jpg") {
    unlink("./images/user/$row_delete[user_img]");
}


$delete = "DELETE FROM `user` WHERE id = $id";


if (mysqli_query($connect, $delete)) {

    unset($_SESSION['user']);
    unset($_SESSION['admin']);
    session_unset();
    session_destroy();

    header('Refresh: 2; url=./index.php');
    echo "<div class='alert alert-info' role='alert'>
    User was succesfully deleted.
      </div>";
} else {
    echo "Error";
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








    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>