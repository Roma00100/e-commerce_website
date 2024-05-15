<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['admin']);
// unset($_SESSION['banned']);
session_unset();
session_destroy();

header("Location: index.php");
