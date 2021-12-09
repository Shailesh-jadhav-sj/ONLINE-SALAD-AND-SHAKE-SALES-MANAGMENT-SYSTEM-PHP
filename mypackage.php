<?php
ob_start();

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
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'header-footer.php';
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
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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

        <script>
            function pay_now(x,y) {
                var name = x;
                var amt1 = y;
                var amt = parseInt(amt1);

                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "amt=" + amt + "&name=" + name,
                    success: function (result) {
                        var options = {
                            "key": "rzp_test_9e5AI2uXYf5RPo",
                            "amount": amt,
                            "currency": "INR",
                            "name": name,
                            "description": "SALAD AND SHAKE",
                            "image": "",
                            "theme.color": "#2e8b57",
                            "handler": function (response) {
                                jQuery.ajax({
                                    type: 'post',
                                    url: 'payment_process.php',
                                    data: "payment_id=" + response.razorpay_payment_id,
                                    success: function (result) {
                                        window.location.href = "mypackage.php";
                                    }
                                });
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                });


            }
        </script>

    </head>
    <body>

    <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >Your Package</h2></center>

    <marquee width = "100%">Cick on package name or image for viewing package details</marquee>
    <div class="w3-container" style="overflow: scroll; max-height: 400px;" >

        <div class="w3-responsive">
            <form method="post">
                <table class="w3-table-all">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Package Name</th>
                        <th>Start-Date</th>
                        <th>Price</th>
                        <th>Payment_status</th>
                        <th>transaction ID</th>
                        <th>Your Suggestion</th>
                        <th>Total-Days</th>
                        <th>Package-Status</th>
                    </tr>
                    <?php
                    $query1 = " select * from tbl_subscriptionmaster where Customer_id =(select Customer_id from tbl_customer_master where EmailId ='" . $_SESSION['username'] . "' )";

                    $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,tbl_packagemaster.Image,tbl_packagemaster.PackageMaster_ID,tbl_packagemaster.Discount,tbl_packagemaster.Package_Name,`tbl_subscriptionmaster`.`Start_Date`,`tbl_packagemaster`.`Price`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_packagemaster`.`Days` from tbl_subscriptiondetails,tbl_subscriptionmaster,tbl_packagemaster,tbl_customer_master where `tbl_customer_master`.`Customer_Id` =(select Customer_id from tbl_customer_master where EmailId ='" . $_SESSION['username'] . "') and `tbl_subscriptionmaster`.`Customer_id`=`tbl_customer_master`.`Customer_Id` and `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptiondetails`.`Packagemaster_ID`=`tbl_packagemaster`.`PackageMaster_ID`";



                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                    if ($result1->num_rows > 0) {
                        $r = 0;
                        $r1 = 0;
                        while ($row = $result1->fetch_assoc()) {
                            ?>    
                            <tr>
                                <td><?php
                                    if ($r != $row['SubscriptionMaster_ID']) {
                                        echo $row['SubscriptionMaster_ID'];
                                        $r = $row['SubscriptionMaster_ID'];
                                    } else {
                                        $r = $row['SubscriptionMaster_ID'];
                                    }
                                    ?></td>

                                <td><a style="color: blue;" onclick="document.getElementById('<?php echo $row['Package_Name']; ?>').style.display = 'block'">

                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" style="width: 100px;"/>
                                    </a> </td>
                                <td><a style="color: blue;" onclick="document.getElementById('<?php echo $row['Package_Name']; ?>').style.display = 'block'">
            <?php echo $row['Package_Name'] ?></a></td>
                                <td><?php echo $row['Start_Date'] ?></td>
                                <td><?php echo $row['Price']; ?></td>
            <?php
            $q2 = "select Price from tbl_subscriptionmaster where SubscriptionMaster_ID = " . $row['SubscriptionMaster_ID'];
            echo $row['SubscriptionMaster_ID'];


            $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


            if ($result2->num_rows > 0) {

                while ($row2 = $result2->fetch_assoc()) {
                    $p1 = $row2['Price'];
                    echo $p1;
                }
            }
            ?>
                                <td><?php
                    if ($row['Payment_status'] == 0) {
                        echo "Pending";
                        echo "<td>";
                ?>

                                         <?php
                                        if ($r1 != $row['SubscriptionMaster_ID']) {
                                            ?>
                                            <input type="button" onclick="pay_now(<?php echo $row['SubscriptionMaster_ID'] ?>,<?php echo $p1 * 100 ?>);" value="Pay"  style="background-color: yellow; color: black;"/></td>
                                        <?php
                                        $r1 = $row['SubscriptionMaster_ID'];
                                    } else {
                                        $r1 = $row['SubscriptionMaster_ID'];
                                    }
                                    ?>
                                    <?PHP
                                } else {
                                    ?>
                            <a  href="bill.php?id=<?php echo $row['SubscriptionMaster_ID']; ?> "><input type="button" value="View Bill " style="background-color: yellow; color: black;"/></a>
                                                  
                                        <?php
                                    echo "<td>" . $row['t_id'] . "</td>";
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
                                    echo "Not yet Started";
                                } else if ($cd < $rd) {
                                    echo "will be Start on :";
                                    print_r($rd);
                                } else if ($diff->days < $row['Days']) {

                                    echo $diff->days . "on going";
                                } else {
                                    echo "Completed";
                                }
                                ?></td>
                            <div id="<?php echo $row['Package_Name']; ?>" class="modal">
                                <span onclick="document.getElementById('<?php echo $row['Package_Name']; ?>').style.display = 'none'" class="close" title="Close">&times;</span>

                                <div style="background-color: white; margin-left:20%;  width: 60%; height: 60%;">
                                    <?php echo '  <img src="images/LOGO_1.jpg"" style="width:100px; hieght:100px;"/>';
                                    ?>
                                    <h2 style="float: right; margin-right: 5%;">Salad & Shake</h2>
                                    <hr>
                                    <?php echo '  <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" style="width:300px; hieght:300px;"/>';
                                    ?>
                                    <div style="float:right; margin-right:15%;">
                                        <h3>Package Name : <?php echo $row['Package_Name']; ?>
                                            <br>
                                        </h3>
                                        <h5>
                                            Total Price: <?php echo (100 * $row['Price']) / (100 - $row['Discount']); ?>
                                            <br>
                                            Discount:&nbsp;&nbsp;&nbsp;-<?php echo $row['Discount']; ?>%
                                            <br>=============
                                        </h5>
                                        <h4>
                                            Special Price:<?php echo $row['Price']; ?>
                                            <br>
                                            Package For <?php echo $row['Days']; ?> Days
                                            <br>
                                            Food Product:
            <?php
            $sql5 = "select Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row['PackageMaster_ID'] . " )";

            $result5 = $connect->query($sql5);
            if ($result5->num_rows > 0) {
                $i = 0;
                while ($row5 = $result5->fetch_assoc()) {
                    $i++;
                    if ($i == $result5->num_rows) {
                        echo $row5['Name'];
                    } else {
                        echo $row5['Name'] . ",";
                    }
                }
            }
            ?>

                                        </h4>
                                        <br>

                                    </div>

                                    </tr>
                                            <?php
                                        }
                                    }
                                    ?>


    <?php ?>

                            </table>
                            </form>
                        </div>


                    </div>
                    <hr>
                    <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >Delivery</h2></center>

                    <div class="w3-container" style="overflow: scroll; max-height:500px;" >


                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr>
                                    <th>Id</th>
                                    <th>Packages</th>
                                    <th>Delivery date-time</th>
                                    <th>status</th>
                                    <th></th>

                                </tr>
    <?php
    $sql8 = "select `tbl_subscriptionmaster`.SubscriptionMaster_ID from  tbl_subscriptiondetails,
        tbl_subscriptionmaster
         where `tbl_subscriptionmaster`.Customer_id =(select Customer_id from tbl_customer_master where EmailId ='" . $_SESSION['username'] . "' ) AND  `tbl_subscriptiondetails`.`Total_Days` >= DATEDIFF(
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
            $sql5 = "select * from tbl_deliverymaster  where SubscriptionMaster_ID =" . $row8['SubscriptionMaster_ID'] . " AND p_date=CURDATE() Group By SubscriptionMaster_ID";
            $ing = "";
            $result5 = $connect->query($sql5) or die("error in query" . mysqli_error($connect));
            ;
            if ($result5->num_rows > 0) {
                $i = 0;
                while ($row5 = $result5->fetch_assoc()) {
                    echo $row5['Delivery_DateTime'];


                    echo "</td>";


                    echo "<td>";
                    if ($row5['Delivery_Status'] == 0) {
                        echo "Pending";
                        echo "</td>";
                        echo "<td>";
                        echo "</td>";
                    } else if ($row5['Delivery_Status'] == 1) {
                        echo "Delivery done by delivery persoan";
                        echo "</td>";
                        echo "<td>";
                        ?>
                                                    <a  href="pp.php?dt=<?php echo $row5['Delivery_DateTime'] ?> &sid=<?php echo $row8['SubscriptionMaster_ID'] ?>&d=1"><input type="button" value="confirm" style="background-color: green; color: white;"/></a>
                                                    <a style="color:red;" href="pp.php?dt=<?php echo $row5['Delivery_DateTime'] ?>&sid=<?php echo $row8['SubscriptionMaster_ID'] ?> &d=0"><input type="button" value="NOT DELIVERD" style="background-color: red; color: white;"/></a>

                                                    <?php
                                                    echo "</td>";
                                                } else if ($row5['Delivery_Status'] == 2) {
                                                    echo "Delivery confirmation rejected";
                                                    echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                    <a  href="pp.php?dt=<?php echo $row5['Delivery_DateTime'] ?> &sid=<?php echo $row8['SubscriptionMaster_ID'] ?>&d=1"><input type="button" value="NOW CONFIRM DELIVER " style="background-color: yellow; color: black;"/></a>
                                                    <a style="color:red;" href="pp.php?dt=<?php echo $row5['Delivery_DateTime'] ?>&sid=<?php echo $row8['SubscriptionMaster_ID'] ?> &d=0"><input type="button" value="NOT DELIVERD YET" style="background-color: red; color: white;"/></a>

                                                    <?php
                                                    echo "</td>";
                                                } else {
                                                    echo ("Delivery Confirmed");
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo "</td>";
                                                }
                                                echo "</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    }
                                }
                                ?>
                                </tr>
                                <?php ?>


                                <?php ?>

                            </table>
                        </div>


                    </div>            



                    </body>
                    </html> 
                            <?php }
                            ?>
