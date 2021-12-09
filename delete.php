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
    
                   
     
      $sql = "update tbl_packagemaster set active=0 where PackageMaster_ID=".$_GET['dt'];
      $result = $connect->query($sql) or die(mysqli_error($connect));
      header("Location:update.php?del=0");
 
}

?>