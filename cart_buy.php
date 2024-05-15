<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
}

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';


$user_id = $_SESSION['user'];


$sql_buy = "UPDATE `basket` SET 
`order_date`= NOW() 
WHERE fk_user = $user_id AND order_date is NULL";

$result_sql_buy = mysqli_query($connect, $sql_buy);

if ($result_sql_buy) {
    $html_content = "<div class='p-5 text-center'><h2>Congratulations!</h2><br><h2> You have succesfully completed your purchase.</h2></div>";
} else {
    $html_content = "Something went wrong, try again later.";
};




// --------------MAILER-----------------

$sql_user = "SELECT
`fname`,
`lname`,
`email`,
`adress`
 FROM `user` WHERE id = $user_id";


$result_user = mysqli_query($connect, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);



if (isset($_SESSION["user"])) {


    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server

    // $mail->Host = 'smtp.gmail.com';
    $mail->Host = 'smtp.easyname.com';

    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;


    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = '8213mail97';
    //Password to use for SMTP authentication
    $mail->Password = 'lifestylelab';

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom('office@lifestylelab.at', 'LifestyleLab');

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    // $mail->addReplyTo('noreply@noreply.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress('office@lifestylelab.at', "$row_user[fname] $row_user[lname]");

    //Set the subject line
    $mail->Subject = "Thank you for your purchase, $row_user[fname]";

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents('cart_mail.html'), __DIR__);

    // $mail->Body = "We thought you would like to know that your purchase was successfully completed. Below, you can find the overview of your purchase <br> $html_content";

    //Replace the plain text body with one created manually
    $mail->AltBody = "We thought you would like to know that your purchase was successfully completed. Below, you can find the overview of your purchase";

    //Attach an image file
    // $mail->addAttachment('images/brand/logo1.jpg');

    $mail->send();
    // header('location: ./cart_buy.php');
    // header('location: ./stripe_checkout.php');

    // exit();

    // send the message, check for errors
    // if (!$mail->send()) {
    //     echo 'Mailer Error: ' . $mail->ErrorInfo;
    // } else {
    //     echo 'Message sent!';
    //     header('location: ./cart_buy.php');

    //     exit();
    // }
};



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


    <div class="p-6 text-center">

        <h2> <?= $html_content ?> </h2>

    </div>

    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>