<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "lifestyle_lab";

$connect = new mysqli($hostName, $userName, $password, $dbName);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
