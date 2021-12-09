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
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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
    <body>
        <?php
        require './header-footer.php';
        require './dbconnection.php';
        ?>
        <div class="main-body" style="background-color: seagreen;">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <!-- Project statustic start -->
                        <div class="col-xl-12">
                            <div class="card proj-progress-card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Total Subscription</h6>
                                            <h5 class="m-b-30 f-w-700 text-c-green">

                                                <?php
                                                $q = "select count(*) as 'count' from `tbl_subscriptionmaster`";


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $total_sub1 = $row['count'];
                                                        echo $row['count'];
                                                    }
                                                }
                                                ?>

                                            </h5>

                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <h6>Subscription(Payment done)</h6>
                                            <h5 class="m-b-30 f-w-700">

                                                <?php
                                                $q = "select count(*) as 'count' from `tbl_subscriptionmaster`where `tbl_subscriptionmaster`.`Payment_status`=1";


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $total_sub = $row['count'];
                                                        echo $row['count'];
                                                    }
                                                }
                                                ?>


                                                <span class="text-c-green m-l-10"><?php echo number_format((100 * $total_sub) / $total_sub1, 2); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-green" style="width:<?php echo number_format((100 * $total_sub) / $total_sub1, 2); ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-md-6" style="padding-left: 8%;">
                                            <h6>Subscription(Payment left)</h6>
                                            <h5 class="m-b-30 f-w-700">

                                                <?php
                                                $q = "select count(*) as 'count' from `tbl_subscriptionmaster`where `tbl_subscriptionmaster`.`Payment_status`=0";


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $left_sub = $row['count'];
                                                        echo $row['count'];
                                                    }
                                                }
                                                ?>


                                                <span class="text-c-red m-l-10"><?php echo number_format((100 * $left_sub) / $total_sub1, 2); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-red" style="width:<?php echo number_format((100 * $left_sub) / $total_sub1, 2); ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card proj-progress-card">
                                <div class="card-block">
                                    <br>


                                    <div class="row">
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Started Last month </h6>
                                            <h5 class="m-b-30 f-w-700">
                                                <?php
                                                $q = "SELECT count(*) as 'count' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and  DATEDIFF(CURDATE(), `tbl_subscriptionmaster`.`Start_Date`)<=30 AND `tbl_subscriptionmaster`.`Start_Date` <CURDATE() ORDER BY `Start_Date` DESC";


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $month_sub = $row['count'];
                                                        echo $row['count'];
                                                    }
                                                }
                                                ?>
                                                <span class="text-c-blue m-l-10"><?php echo round((100 * $month_sub) / $total_sub); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-green" style="width:<?php echo number_format((100 * $month_sub) / $total_sub, 2); ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <h6>Ongoing Subscriptions </h6>
                                            <h5 class="m-b-30 f-w-700">
                                                <?php
                                                $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,`tbl_subscriptionmaster`.`Start_Date`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_subscriptiondetails`.`Total_Days` from tbl_subscriptiondetails,tbl_subscriptionmaster where `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID`";
                                                $active = 0;


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $currentDate = new DateTime();
                                                        $cd = date_format($currentDate, "Y/m/d");
                                                        $ref = new DateTime($row['Start_Date']);

                                                        $rd = date_format($ref, "Y/m/d");
                                                        $diff = $currentDate->diff($ref);
                                                        if ($row['Payment_status'] == 0) {
                                                            //echo "Not yet Started";
                                                        } else if ($cd < $rd) {
                                                            // echo "will be Start on :";
                                                            //print_r($rd);
                                                        } else if ($diff->days < $row['Total_Days']) {

                                                            $active = $active + 1;
                                                        } else {
                                                            
                                                        }
                                                    }
                                                }
                                                echo $ongoing_sub = $active;
                                                ?>
                                                <span class="text-c-yellow m-l-10"><?php echo number_format((100 * $ongoing_sub) / $total_sub, 2); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-yellow" style="width:<?php echo number_format((100 * $ongoing_sub) / $total_sub, 2); ?>%"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6">
                                            <h6>Completed Subscriptions</h6>
                                            <h5 class="m-b-30 f-w-700">
                                                <?php
                                                $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,`tbl_subscriptionmaster`.`Start_Date`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_subscriptiondetails`.`Total_Days` from tbl_subscriptiondetails,tbl_subscriptionmaster where `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID`";
                                                $active = 0;


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $currentDate = new DateTime();
                                                        $cd = date_format($currentDate, "Y/m/d");
                                                        $ref = new DateTime($row['Start_Date']);

                                                        $rd = date_format($ref, "Y/m/d");
                                                        $diff = $currentDate->diff($ref);
                                                        if ($row['Payment_status'] == 0) {
                                                            //echo "Not yet Started";
                                                        } else if ($cd < $rd) {
                                                            // echo "will be Start on :";
                                                            //print_r($rd);
                                                        } else if ($diff->days < $row['Total_Days']) {
                                                            
                                                        } else {
                                                            $active = $active + 1;
                                                            ;
                                                        }
                                                    }
                                                }
                                                echo $com_sub = $active;
                                                ?> 
                                                <span class="text-c-blue m-l-10"><?php echo number_format((100 * $com_sub) / $total_sub, 2); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-green" style="width:<?php echo number_format((100 * $com_sub) / $total_sub, 2); ?>%"></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-md-6">
                                            <h6>Upcoming Subscriptions</h6>
                                            <h5 class="m-b-30 f-w-700">
                                                <?php
                                                $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,`tbl_subscriptionmaster`.`Start_Date`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_subscriptiondetails`.`Total_Days` from tbl_subscriptiondetails,tbl_subscriptionmaster where `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptionmaster`.`Payment_status`=1 group by `tbl_subscriptiondetails`.`Subscriptionmaster_ID`";
                                                $active = 0;


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $currentDate = new DateTime();
                                                        $cd = date_format($currentDate, "Y/m/d");
                                                        $ref = new DateTime($row['Start_Date']);

                                                        $rd = date_format($ref, "Y/m/d");
                                                        $diff = $currentDate->diff($ref);
                                                        if ($row['Payment_status'] == 0) {
                                                            //echo "Not yet Started";
                                                        } else if ($cd < $rd&&$row['Payment_status'] == 1) {
                                                           // echo $row['SubscriptionMaster_ID'];
                                                            $active = $active + 1;
                                                        } else if ($diff->days < $row['Total_Days']) {
                                                            
                                                        } else {
                                                            
                                                        }
                                                    }
                                                }
                                                echo $upcom_sub = $active;
                                                ?>
                                                <span class="text-c-blue m-l-10"><?php echo number_format((100 * $upcom_sub) / $total_sub, 2); ?>%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-green" style="width:<?php echo number_format((100 * $upcom_sub) / $total_sub, 2); ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Project statustic end -->
                        <!-- Material statustic card start -->
                        <div class="col-xl-4 col-md-12">
                            <div class="card mat-stat-card">
                                <div class="card-block">
                                    <div class="row align-items-center b-b-default">
                                        <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                        <a href="report_3.php">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-user text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>
                                                        <?php
                                                        $q = "select count(*) as 'count' from tbl_customer_master";


                                                        $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                        if ($result1->num_rows > 0) {

                                                            while ($row = $result1->fetch_assoc()) {
                                                                echo $row['count'];
                                                            }
                                                        }
                                                        ?> 
                                                    </h5>
                                                    <p class="text-muted m-b-0">Customers</p>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                        
                                        <div class="col-sm-6 p-b-20 p-t-20">
                                            <a href="RD1.php">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="fas fa-inbox text-c-green f-24"></i>

                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>
                                                        <?php
                                                        $q = "select count(*) as 'count' from tbl_packagemaster where active=1";


                                                        $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                        if ($result1->num_rows > 0) {

                                                            while ($row = $result1->fetch_assoc()) {
                                                                echo $row['count'];
                                                            }
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted m-b-0">Packages(REPORT)</p>
                                                </div>
                                           
                                            </div>
                                                </a>
                                        </div>
                                        
                                    </div>
                                    </a>
                                <a href="update.php" >
                                    <div class="row align-items-center b-b-success">
                                        <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-file-alt text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>
                                                        <?php
                                                        $q = "select count(*) as 'count' from `tbl_ingredientmaster`";


                                                        $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                        if ($result1->num_rows > 0) {

                                                            while ($row = $result1->fetch_assoc()) {
                                                                echo $row['count'];
                                                            }
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted m-b-0">Ingredients(List)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 p-b-20 p-t-20 ">
                                            <div class="row align-items-center text-center">
                                                <div class="col-4 p-r-0">
                                                    <i class="far fa-envelope-open text-c-green f-24"></i>
                                                </div>
                                                <div class="col-8 p-l-0">
                                                    <h5>
                                                        <?php
                                                        $q = "select count(*) as 'count' from `tbl_foodproductmaster`";


                                                        $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                        if ($result1->num_rows > 0) {

                                                            while ($row = $result1->fetch_assoc()) {
                                                                echo $row['count'];
                                                            }
                                                        }
                                                        ?>
                                                    </h5>
                                                    <p class="text-muted m-b-0">Food Items(List)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <a href="allSubscription.php">
                            <div class="card mat-clr-stat-card text-amazon white">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-green">
                                            <i class="fas fa-newspaper mat-icon f-24"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h5>
                                                <?php
                                                $q = "select count(*) as 'count' from `tbl_subscriptionmaster`";


                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        echo $row['count'];
                                                    }
                                                }
                                                ?>
                                            </h5>
                                            <p class="m-b-0">Subscriptions till date</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            <a href="RD2.php">
                            <div class="card mat-clr-stat-card text-amazon white">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-green">
                                            <i class="fas fa-trophy mat-icon f-24"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h5>
                                                <?php
                                                $q = "SELECT SUM(Price) as 'count' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and  DATEDIFF(CURDATE(), `tbl_subscriptionmaster`.`Start_Date`)<=30 AND `tbl_subscriptionmaster`.`Start_Date` <CURDATE() ORDER BY `Start_Date` DESC";

                                                    
                                                $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                if ($result1->num_rows > 0) {

                                                    while ($row = $result1->fetch_assoc()) {
                                                        $q2 = "SELECT SUM(Price) as 'count2' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and   `tbl_subscriptionmaster`.`Start_Date` <=CURDATE()";


                                                        $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


                                                        if ($result2->num_rows > 0) {

                                                            while ($row2 = $result2->fetch_assoc()) {
                                                                $total_m = $row2['count2'];
                                                            }
                                                        }
                                                        $month_m = $row['count'];
                                                        if($month_m=="")
                                                        {
                                                            $month_m=0;
                                                        }
                                                        echo "&#8377 " . $month_m;
                                                    }
                                                }
                                                ?>
                                            </h5>
                                            <p class="m-b-0">
                                            Erned from last Month
                                            <span class="text-c-green m-l-10"><?php if ($total_m==0){echo "00";} else{echo number_format((100 * $month_m) / $total_m, 2); }?>% of total revenue</span></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <a href="C_paymentleft.php">
                                <div class="card mat-clr-stat-card text-amazon white">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-3 text-center bg-c-red">
                                                <i class="fas fa-money-bill-alt mat-icon f-24"></i>
                                            </div>
                                            <div class="col-9 cst-cont">
                                                <h5>
                                                    <?php
                                                    $q = "select count(*) as 'count' from `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=0";


                                                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                                                    if ($result1->num_rows > 0) {

                                                        while ($row = $result1->fetch_assoc()) {
                                                            echo $row['count'];
                                                        }
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="m-b-0">Pending Payments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="pending_orders.php">    
                            <div class="card mat-clr-stat-card text-amazon white">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-3 text-center bg-c-red">
                                            <i class="fas fa-warning mat-icon f-24"></i>
                                        </div>
                                        <div class="col-9 cst-cont">
                                            <h5>
                                                <?php
                                                $sql8 = "select `tbl_subscriptionmaster`.`SubscriptionMaster_ID`,`tbl_subscriptiondetails`.`Total_Days`,`tbl_subscriptionmaster`.`Start_Date`,DATEDIFF(CURRENT_DATE,`tbl_subscriptionmaster`.`Start_Date` ) as 'days' from tbl_subscriptionmaster,tbl_subscriptiondetails where `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptionmaster`.`Payment_status`=1 and DATEDIFF(CURRENT_DATE,`tbl_subscriptionmaster`.`Start_Date` ) >=0";
                                                $result8 = $connect->query($sql8) or die("error in query" . mysqli_error($connect));
                                                $pending_order = 0;
                                                if ($result8->num_rows > 0) {
                                                    while ($row8 = $result8->fetch_assoc()) {

                                                        $sql9 = "select count(*) as 'count' from `tbl_deliverymaster` where  SubscriptionMaster_ID=" . $row8['SubscriptionMaster_ID'] . " and Delivery_Status in (1,3)";
                                                        $result9 = $connect->query($sql9) or die("error in query" . mysqli_error($connect));
                                                        if ($result9->num_rows > 0) {
                                                            while ($row9 = $result9->fetch_assoc()) {
                                                                $days = $row8['days'] + 1;

                                                                if ($days < $row8['Total_Days']) {
                                                                    $pending_order = $pending_order + $days - $row9['count'];
                                                                } else {
                                                                    $pending_order = $pending_order + $row8['Total_Days'] - $row9['count'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                echo $pending_order;
                                                ?>
                                            </h5>
                                            <p class="m-b-0">Pending Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>


                    </div>
                </div>
                <!-- Page-body end -->

            </div>

        </div>
<?php
include './footer.php';
?>

    </body>
</html>
