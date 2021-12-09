<?php 
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["username"]))
{
    
if($_SESSION["username"] !="Deliverypersoan")
{
    header("location:login.php");   
}}
 else {
    header("location:login.php");
    
}
 require './dbconnection.php';
        if (mysqli_connect_errno()) {

            echo "error";
        } else {
if (isset($_GET['id'])) {
    $sql5 = "update tbl_deliverymaster set Delivery_Status=1,Delivery_DateTime=CURRENT_TIMESTAMP where SubscriptionMaster_ID=" . $_GET['id'];
                
$result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
 header("Location:Deliverypersoan.php");
}
        }

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
