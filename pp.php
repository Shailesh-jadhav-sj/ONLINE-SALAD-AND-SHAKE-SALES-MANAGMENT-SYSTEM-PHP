<?php
ob_start();

require './dbconnection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] == "Admin" || $_SESSION["username"] == "Cook" || $_SESSION["username"] == "Deliverypersoan") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
if (isset($_GET['sid'])&&isset($_GET['dt'])) {
    if($_GET['d']==1)
    {
    $sql5 = "update tbl_deliverymaster set Delivery_Status=3 where SubscriptionMaster_ID=" . $_GET['sid']." and Delivery_DateTime='". $_GET['dt']."'";
    echo $sql5."accept</br>";
                    $result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
                    header("location:mypackage.php");
}
 else {
    $sql5 = "update tbl_deliverymaster set Delivery_Status=2 where SubscriptionMaster_ID=" . $_GET['sid']." and Delivery_DateTime='". $_GET['dt']."'";
                echo $sql5."reject</br>";
                    $result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
                    header("location:mypackage.php");
}
    }
?>