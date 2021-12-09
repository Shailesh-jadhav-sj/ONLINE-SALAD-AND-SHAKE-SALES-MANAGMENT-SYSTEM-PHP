<?php
ob_start();
require './dbconnection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] != "Admin") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
if (isset($_GET['dt'])&&isset($_GET['dt1'])) {
    $sql5 = "update tbl_subscriptionmaster set  Start_Date = DATE_ADD(Start_Date,INTERVAL ".$_GET['dt1']." DAY) where SubscriptionMaster_ID=" . $_GET['dt'];
    echo $sql5;
                    $result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
                    header("location:pending_orders.php");
}
?>


