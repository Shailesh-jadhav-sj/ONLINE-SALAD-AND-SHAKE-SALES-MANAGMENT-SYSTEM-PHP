<?php 
ob_start();
require './dbconnection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] != "Cook") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}

if (isset($_GET['id'])) {
    $sql5 = "update tbl_cookingmaster set Prepared_Status=1 where Cooking_Id=" . $_GET['id'];
                
                    $result5 = $connect->query($sql5) or die("error in query".mysqli_error($connect));
                    
    $sql6 = "select * from tbl_cookingmaster where Prepared_Status=0 and Date=CURDATE()";
                
                    $result6 = $connect->query($sql6) or die("error in query".mysqli_error($connect));
                    if ($result6->num_rows <= 0) {
                    
                        $sql8="select `tbl_subscriptionmaster`.SubscriptionMaster_ID from  tbl_subscriptiondetails,
        tbl_subscriptionmaster
         where `tbl_subscriptionmaster`.`Payment_status`=1 AND `tbl_subscriptiondetails`.`Total_Days` >= DATEDIFF(
            CURDATE(), `tbl_subscriptionmaster`.`Start_Date`) AND CURDATE() >= `tbl_subscriptionmaster`.`Start_Date` AND `tbl_subscriptionmaster`.`SubscriptionMaster_ID` = `tbl_subscriptiondetails`.`Subscriptionmaster_ID`";
                       
                       $result8 = $connect->query($sql8) or die("error in query".mysqli_error($connect));
                    if ($result8->num_rows >0) {
                        while ($row8 = $result8->fetch_assoc()){ 
                           $sql7 = "insert into tbl_deliverymaster (SubscriptionMaster_ID,Delivery_Status,p_date) VALUES ('".$row8['SubscriptionMaster_ID']."',0,CURDATE())";
                           $result9 = $connect->query($sql7) or die("error in query".mysqli_error($connect));
                    
                    
                        }
                                
                    } 
                        
                        
                        
                    }
                    
                    
                    
                    header("Location:Cook.php");
                    
}
?>
