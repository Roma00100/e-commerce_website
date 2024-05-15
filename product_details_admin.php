<?php
require_once './php_db/db_connect.php';

$product_id = $_GET['id'] ?? null;
$product = null;
$reviews = [];

if ($product_id) {

    $stmt = $connect->prepare("SELECT p.*, t.type as typeName, s.status as statusName FROM product p
                               LEFT JOIN product_type t ON p.fk_type = t.id
                               LEFT JOIN product_status s ON p.fk_status = s.id
                               WHERE p.id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>No product found for this ID.</p>";
    }
    $stmt->close();

    // Fetch reviews for the product
    $reviewStmt = $connect->prepare("SELECT product_review.id, product_review.review, product_review.rating, product_review.created, user.fname, user.lname 
                                     FROM product_review 
                                     JOIN user ON product_review.fk_user = user.id 
                                     WHERE product_review.fk_product = ? 
                                     ORDER BY product_review.created DESC");
    $reviewStmt->bind_param("i", $product_id);
    $reviewStmt->execute();
    $reviewResult = $reviewStmt->get_result();
    while ($row = $reviewResult->fetch_assoc()) {
        $reviews[] = $row;
    }
    $reviewStmt->close();

}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>

    <?php include './components/header.html' ?>

</head>

<body>

    <?php include '_navbar.php' ?>
    <?php include '_navbardash.php' ?>


    <div class="container mt-1 mb-1">
        <h3 class="text-center p-5 mb-2 ">PRODUCT DETAILS</h3>
    </div>

    <div class="card container bg-body-custom">
        <div class="container mb-4">
            <?php if ($product) : ?>
                <div class='card mb-5 mt-5 mx-auto' style='max-width: 1080px;'>
                    <div class='row g-0'>
                        <div class='col-md-4 p-4'>
                            <img class='w-100' src='./images/product/<?= $product['img'] ?>' alt='Product Image'>
                        </div>
                        <div class='col-md-8 p-4'>
                            <div class='card-body d-flex flex-column justify-content-start'>
                                <p class='card-title'><strong>Name: </strong><?= htmlspecialchars($product['name']) ?></p>
                                <p class='card-text'><strong>Description: </strong><?= htmlspecialchars($product['description']) ?></p>
                                <p class='card-text'><strong>Price: </strong>$<?= htmlspecialchars(number_format($product['price'], 2)) ?></p>
                                <p class='card-text'><strong>Type: </strong><?= htmlspecialchars($product['typeName']) ?></p>
                                <p class='card-text'><strong>Status: </strong><?= htmlspecialchars($product['statusName']) ?></p>

                                <div class='btn-group mt-3'>
                                    <a href='product_delete.php?id=<?= $product["id"] ?>' class='btn btn-sm btn-info' onclick='return confirm("Are you sure you want to delete this product?");'>Delete</a>
                                    <a href='product_update.php?id=<?= $product["id"] ?>' class='btn btn-sm btn-dark'>Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Display Reviews -->
                <h4>Reviews:</h4>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= htmlspecialchars($review['fname']) . " " . htmlspecialchars($review['lname']) ?></td>
                            <td><?= htmlspecialchars($review['review']) ?></td>
                            <td><?= $review['rating'] ?></td>
                            <td><?= $review['created'] ?></td>
                            <td>
                                <a href="delete_review.php?id=<?= $review['id'] ?>&redirect_id=<?= $product_id ?>" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Product details not found.</p>
            <?php endif; ?>
        </div>
    </div>


    <?php include './components/footer.html' ?>

</body>

</html>
