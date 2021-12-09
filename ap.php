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
if (isset($_GET['dt'])) {
    $sql5 = "update tbl_subscriptionmaster set Payment_status=1 , Start_Date=if(Start_Date>CURRENT_DATE,Start_Date,CURRENT_DATE+1) where SubscriptionMaster_ID=" . $_GET['dt'];
    echo $sql5."accept</br>";
                    $result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
                    header("location:Admin.php");
}
?>


