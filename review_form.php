<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
    exit;
}

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
    exit;
}

require_once './php_db/db_connect.php';

$product_id = $_GET["id"] ?? null;
$user_id = $_SESSION["user"];

if (isset($_POST["submit"], $_POST["review"], $_POST["rating"])) {
    $review = $_POST["review"];
    $rating = $_POST["rating"];
    echo "Rating: " . $rating; // Debugging

    $sql_review = "INSERT INTO `product_review` (`review`, `rating`, `fk_user`, `fk_product`, `created`) VALUES (?, ?, ?, ?, NOW())";


    $stmt = $connect->prepare($sql_review);
    if ($stmt) {
        $stmt->bind_param("siis", $review, $rating, $user_id, $product_id);
        if ($stmt->execute()) {
            //  Set a session variable for a success message
            $_SESSION['review_success'] = 'Your review has been successfully submitted.';
        } else {

            $_SESSION['review_error'] = 'Error submitting your review.';
        }
        $stmt->close();
    } else {
        $_SESSION['review_error'] = 'Error preparing the statement.';
    }
    $connect->close();

    header("Location: product_details.php?id={$product_id}");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- ---------------------------------------------------------- -->
    <!-- -------------INCLUDES COMMON HEAD . START----------------- -->

    <head>
        <?php include './components/header.html' ?>

        <style>
            .rating {
                direction: rtl;
                unicode-bidi: bidi-override;
                font-size: 30px;
                cursor: pointer;
            }

            .rating>input {
                display: none;
            }

            .rating>label {
                color: #bfb5b2;
                margin: 0;
            }

            .rating>label:hover,
            .rating>label:hover~label,
            .rating>input:checked~label {
                color: #5e3C58;
            }

            textarea {
                width: 100%;
                min-height: 100px;
                margin-bottom: 10px;
            }

            button {
                cursor: pointer;
            }
        </style>
    </head>

<body>

    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->

    <?php include '_navbar.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->

    <div class="container">
        <div class="card shadow p-4 mt-5 mb-5">
            <form method="post" name="review_form">
                <textarea name="review" placeholder="Write your review here..." required></textarea>
                <div class="rating">

                <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
        <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
        <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
        <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
        <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>



                </div>
                <input type="submit" class="btn btn-success" name="submit" value="Submit Review">

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