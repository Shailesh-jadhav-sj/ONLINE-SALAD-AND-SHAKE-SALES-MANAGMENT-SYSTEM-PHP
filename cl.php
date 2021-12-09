<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] != "Deliverypersoan") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
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
require './header-footer.php';
require './dbconnection.php';
if (mysqli_connect_errno()) {

    echo "error";
} else {
    ?>
        <html>
            <head>
                <title>My Package</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <style>
                    .div1 {
                        width: 22%;
                        height: 100%;
                        border: 3px solid black;
                    }
                    .modal {
                        display: none; /* Hidden by default */
                        position: fixed; /* Stay in place */
                        z-index: 1; /* Sit on top */
                        left: 0;
                        top: 0;
                        width: 100%; /* Full width */
                        height: 100%; /* Full height */
                        overflow: auto; /* Enable scroll if needed */
                        background-color: rgb(0,0,0); /* Fallback color */
                        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                        padding-top: 60px;
                    }

                    /* Modal Content/Box */
                    .modal-content {
                        background-color: #fefefe;
                        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                        border: 1px solid #888;
                        width: 80%; /* Could be more or less, depending on screen size */
                    }

                    /* The Close Button (x) */
                    .close {
                        position: absolute;
                        right: 50%;
                        top: 13%;
                        color: #000;
                        font-size: 35px;
                        font-weight: bold;
                    }

                    .close:hover,
                    .close:focus {
                        color: red;
                        cursor: pointer;
                    }

                    /* Add Zoom Animation */
                    .animate {
                        -webkit-animation: animatezoom 0.6s;
                        animation: animatezoom 0.6s
                    }

                    @-webkit-keyframes animatezoom {
                        from {-webkit-transform: scale(0)} 
                        to {-webkit-transform: scale(1)}
                    }

                    @keyframes animatezoom {
                        from {transform: scale(0)} 
                        to {transform: scale(1)}
                    }

                    /* Change styles for span and cancel button on extra small screens */
                    @media screen and (max-width: 300px) {
                        span.psw {
                            display: block;
                            float: none;
                        }
                        .cancelbtn {
                            width: 100%;
                        }
                    }
                </style>
            </style>
        </head>
        <body>

            <div class="w3-container">

                <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >PACKAGE CLASSIFICATION</h2></center>
                <marquee width = "100%">Customer are waiting for a tasty salad's Delivery </marquee>
                <div class="w3-responsive">
                    <table class="w3-table-all">
                        <tr>
                            <th>SubscriptionMaster_ID</th>

                            <th>Package Name</th>
                            <th>Food Items</th>
                           


                        </tr>
    <?php
    $sql8 = "select `tbl_subscriptionmaster`.SubscriptionMaster_ID from  tbl_subscriptiondetails,
        tbl_subscriptionmaster
         where `tbl_subscriptionmaster`.`Payment_status`=1 and `tbl_subscriptiondetails`.`Total_Days` >= DATEDIFF(
            CURDATE(), `tbl_subscriptionmaster`.`Start_Date`) AND CURDATE() >= `tbl_subscriptionmaster`.`Start_Date` AND `tbl_subscriptionmaster`.`SubscriptionMaster_ID` = `tbl_subscriptiondetails`.`Subscriptionmaster_ID` Group By `tbl_subscriptionmaster`.SubscriptionMaster_ID";

    $result8 = $connect->query($sql8) or die("error in query" . mysqli_error($connect));
    if ($result8->num_rows > 0) {
        echo "<tr>";
        while ($row8 = $result8->fetch_assoc()) {
            echo "<td>";
            echo $row8['SubscriptionMaster_ID'];
            echo "</td>";
            echo "<td>";
            $sql5 = "select  Package_Name from tbl_packagemaster where PackageMaster_ID IN (select PackageMaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID=" . $row8['SubscriptionMaster_ID'] . "  Group By Subscriptionmaster_ID)";
            $ing = "";
            $result5 = $connect->query($sql5);
            if ($result5->num_rows > 0) {
                $i = 0;
                while ($row5 = $result5->fetch_assoc()) {
                    $i++;
                    if ($i == $result5->num_rows) {
                        echo $row5['Package_Name'];
                        $ing = $ing . $row5['Package_Name'];
                    } else {
                        echo $row5['Package_Name'] . ",";
                        $ing = $ing . $row5['Package_Name'] . ",";
                    }
                }
            }

            echo "</td>";
            echo "<td>";
            $sql15 = "select  Package_Name from tbl_packagemaster where PackageMaster_ID IN (select PackageMaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID=" . $row8['SubscriptionMaster_ID'] . "  Group By Subscriptionmaster_ID)";
            $ing = "";
            $result15 = $connect->query($sql15) or die("erro");
            if ($result15->num_rows > 0) {
                $i = 0;
                while ($row9= $result15->fetch_assoc()) {
                    echo '(';
                  $sq = "select  count(*),Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID in(select PackageMaster_ID from tbl_packagemaster where Package_Name='". $row9['Package_Name'] . "')) group by Name";
                  $re=$connect->query($sq) or die("erroe 2". mysqli_error($connect));
                  
                  if($re->num_rows>0)
                  {
                      
                      while ($r=$re->fetch_assoc()){
                      echo $r['Name']." ";}
                  }
                  echo ")||";
                }

            }
                echo "</td>";


                echo "</tr>";
            }
        }
        ?>
                            </tr>
                            <?php
                            ?>


                            <?php ?>

                        </table>
                    </div>


                </div>            



            </body>
        </html> 
<?php }?>
