<?php
ob_start();
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
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <!-- Favicon icon -->
        <link rel="icon" href="images/LOGO_19.png" type="image/x-icon">
        <!-- Google font-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
        <!-- waves.css -->
        <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
        <!-- waves.css -->
        <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
        <!-- themify icon -->
        <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
        <!-- font-awesome-n -->
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <!-- scrollbar.css -->
        <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
        
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    
  <script source="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
  <script source="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script source="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

       
        <style>
            .div1 {
                width: 22%;
                height: 100%;
                border: 3px solid black;
            }
            .modal {
                display: none;/* Hidden by default */
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
    </head>
    <body style="background-color: seagreen;">
        <?php
        require './header-footer.php';
        require './dbconnection.php';
        ?>
        
        <div class="w3-container">
            <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >All Subscription</h2></center>
            <marquee width = "100%">Customer are waiting for a tasty salad which made by you </marquee>
           <div class="col-xl-12 col-md-12">
                            <div class="card table-card">
                                <div class="card-block">
                                    <div class="table-responsive">
                                       
                                        <table class="table table-hover m-b-0 ">
                        
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>purchesd Package</th>
                        <th>Start-Date</th>
                        <th>Price</th>
                        <th>Payment_status</th>
                        
                        <th>Suggestion</th>
                        <th>Total-Days</th>
                        <th></th>
                    </tr>
                    <?php
                    $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,tbl_subscriptionmaster.t_id,`tbl_customer_master`.Photo,`tbl_subscriptionmaster`.`Start_Date`,`tbl_packagemaster`.`Price`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_packagemaster`.`Days`, `tbl_customer_master`.Customer_Id,`tbl_customer_master`.Name from tbl_subscriptiondetails,tbl_subscriptionmaster,tbl_packagemaster,tbl_customer_master where `tbl_subscriptionmaster`.`Customer_id`=`tbl_customer_master`.`Customer_Id` and `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptiondetails`.`Packagemaster_ID`=`tbl_packagemaster`.`PackageMaster_ID` Group By Subscriptionmaster_ID";



                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                    if ($result1->num_rows > 0) {

                        while ($row = $result1->fetch_assoc()) {
                            ?>    
                            <tr>
                                <td><?php echo $row['SubscriptionMaster_ID'] ?></td>

                                <td>
                                    <a style="color: blue;" onclick="document.getElementById('<?php echo $row['Name']; ?>').style.display = 'block'">

                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']) ?>" style="width: 100px;"/>
                                        <label><?php echo $row['Name'] ?></label>
                                    </a> </td>
                                <td>
                                    
                                    <?php
                                    $sql5 = "select * from tbl_packagemaster where PackageMaster_ID IN (select PackageMaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID=" . $row['SubscriptionMaster_ID'] . "  Group By Subscriptionmaster_ID)";
                                    $ing = "";
                                    $result5 = $connect->query($sql5);
                                    if ($result5->num_rows > 0) {
                                        $i = 0;
                                        while ($row5 = $result5->fetch_assoc()) {
                                            $i++;
                                            if ($i == $result5->num_rows) {
                                                ?>
                                                <a style="color: blue;" onclick="document.getElementById('<?php echo $row5['Package_Name']; ?>').style.display = 'block'">
                                                    <?php echo $row5['Package_Name'] ?>
                                                </a><?php
                                            } else {
                                                ?> <a style="color: blue;" onclick="document.getElementById('<?php echo $row5['Package_Name']; ?>').style.display = 'block'">
                                                    <?php echo $row5['Package_Name'] . ","; ?></a><?php
                                            }
                                            ?>
                                            <div id="<?php echo $row5['Package_Name']; ?>" class="modal">
                                                <span onclick="document.getElementById('<?php echo $row5['Package_Name']; ?>').style.display = 'none'" class="close" title="Close">&times;</span>

                                                <div style="background-color: white; margin-left:20%;  width: 60%; height: 60%;">
                                                    <?php echo '<img src="images/LOGO_1.jpg"" style="width:100px; hieght:100px;"/>';
                                                    ?>
                                                    <h2 style="float: right; margin-right: 5%;">Salad & Shake</h2>
                                                    <hr>
                                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row5['Image']) . '" style="width:300px; hieght:300px;"/>';
                                                    ?>
                                                    <div style="float:right; margin-right:10%;">
                                                        <h3>Package Name : <?php echo $row5['Package_Name']; ?>
                                                            <br>
                                                        </h3>
                                                        <h5>
                                                            Total Price: <?php echo (100 * $row5['Price']) / (100 - $row5['Discount']); ?>
                                                            <br>
                                                            Discount:&nbsp;&nbsp;&nbsp;-<?php echo $row5['Discount']; ?>%
                                                            <br>=============
                                                        </h5>
                                                        <h4>
                                                            Special Price:<?php echo $row5['Price']; ?>
                                                            <br>
                                                            Package For <?php echo $row5['Days']; ?> Days
                                                            <br>
                                                            Food Product:

                                                            <?php
                                                            $sq25 = "select Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row5['PackageMaster_ID'] . " )";

                                                            $result8 = $connect->query($sq25);
                                                            if ($result8->num_rows > 0) {
                                                                $i = 0;
                                                                while ($row8 = $result8->fetch_assoc()) {
                                                                    $i++;
                                                                    if ($i == $result8->num_rows) {
                                                                        echo $row8['Name'];
                                                                    } else {
                                                                        echo $row8['Name'] . ",";
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </h4>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div><?php
                                        }
                                    }
                                                    ?>




                                </td>
                                <td><?php echo $row['Start_Date'] ?></td>
                                <td><?php echo $row['Price'] ?></td>
                                <td><?php
                            if ($row['Payment_status'] == 0) {
                                echo "Pending(Please visit at shop)";
                            } else {
                                echo "Paid";
                            }
                                                    ?></td>
                                <td><?php echo $row['Suggestion'] ?></td>
                                <td><?php echo $row['Days'] ?></td>
                                <td><?php
                            $currentDate = new DateTime();
                            $cd = date_format($currentDate, "Y/m/d");
                            $ref = new DateTime($row['Start_Date']);

                            $rd = date_format($ref, "Y/m/d");
                            $diff = $currentDate->diff($ref);
                            if ($row['Payment_status'] == 0) {
                                                        ?>  <a  href="ap.php?dt=<?php echo $row['SubscriptionMaster_ID'] ?>"><input type="button" value="Paid" style="background-color: green; color: white;"/></a>

                                        <?PHP
                                    }
                                    ?></td>

                            </tr>
                                    <?php
                                }
                            }
                            ?>

                </table>
                                    </div></div></div></div>
            </div>
        </div>

    </body>
</html>
