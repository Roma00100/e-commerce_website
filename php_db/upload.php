<?php


// ----------USER UPLOAD -----------------

function fileUpload($picture)
{

    if ($picture["error"] == 4) {
        $pictureName = "no_user.jpg";
        $message = "No picture uploaded";
    } else {

        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "OK" : "Not an image";
    }

    if ($message == "OK") {
        $ext = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION));
        $pictureName = uniqid("") . "." . $ext;
        move_uploaded_file($picture["tmp_name"], "./images/user/{$pictureName}");
    }

    return [$pictureName, $message];
}




// ----------PRODUCT UPLOAD -----------------



function fileUploadProduct($picture)
{

    if ($picture["error"] == 4) {
        $pictureName = "no_product.jpg";
        $message = "No picture uploaded";
    } else {

        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "OK" : "Not an image";
    }

    if ($message == "OK") {
        // $ext = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION));
        // $pictureName = uniqid("") . "." . $ext;
        move_uploaded_file($picture["tmp_name"], "./images/product/{$pictureName}");
    }

    return [$pictureName, $message];
}
