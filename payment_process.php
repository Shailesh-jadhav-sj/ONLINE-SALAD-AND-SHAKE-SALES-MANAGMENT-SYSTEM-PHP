<?php
session_start();
include('./dbconnection.php');
if(isset($_POST['amt']) && isset($_POST['name'])){
    $amt=$_POST['amt'];
    echo $amt;
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    mysqli_query($connect,"update tbl_subscriptionmaster set Payment_status=0 where SubscriptionMaster_ID=$name");
    $_SESSION['OID']=$name;
  
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    $_SESSION['h']=$payment_id;
    mysqli_query($connect,"update tbl_subscriptionmaster set Payment_status=1,Start_Date=if(Start_Date>CURRENT_DATE,Start_Date,CURRENT_DATE+1),t_id='$payment_id' where SubscriptionMaster_ID='".$_SESSION['OID']."'");
}
?>