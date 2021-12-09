<?php
ob_start();
session_start();
print_r($_SESSION);

unset($_SESSION["username"]);

session_destroy();

header("location:index.php");

ob_end_flush();
?>