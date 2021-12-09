<?php

$connect = mysqli_connect("localhost", "root", "root", "salad_and_shake") or die("Couldnit Connect!!!");
if (mysqli_connect_errno()) {
    echo"Failed to connect to Mysql!!!" . mysqli_connect_error();
    exit();
}
?>
