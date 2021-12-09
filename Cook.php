<?php
ob_start();
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
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

        <?php
        require './header-footer.php';
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

                <center> <h2 style=" color: white;font-size: 50px;font-family: monospace" >Todays Order</h2></center>
                <marquee width = "100%">Customer are waiting for a tasty salad which made by you </marquee>
                <div class="w3-responsive">
                    <table class="w3-table-all">
                        <tr>
                            <th>Id</th>
                            <th>Food Name</th>
                            <th>Quantity</th>
                            <th>Ingrident</th>
                            <th>Preapration status</th>
                            <th></th>



                        </tr>
        <?php
        require './dbconnection.php';
      if (mysqli_connect_errno()) {

            echo "error";
        } else {
            ?>
                        <?php
                          $result2 = $connect->query("select * from tbl_cookingmaster where Date=CURDATE()") or die("Error:" . mysqli_error($connect));

                        $c = 0;
                       if ($result2->num_rows <= 0) {
 
                            $q = "SELECT
    COUNT(*) AS 'total',
    `tbl_foodproductmaster`.`Name`,
    `tbl_foodproductmaster`.`Food_id`,
    `tbl_packagemaster`.`Days`,
    DATEDIFF(
        CURDATE(), `tbl_subscriptionmaster`.`Start_Date`)
    FROM
        tbl_subscriptiondetails,
        tbl_subscriptionmaster,
        tbl_packagemaster,
        tbl_packagedetails,
        tbl_foodproductmaster,
        tbl_customer_master
    WHERE
    `tbl_subscriptionmaster`.`Payment_status`=1 and
        `tbl_subscriptiondetails`.`Total_Days` >= DATEDIFF(
            CURDATE(), `tbl_subscriptionmaster`.`Start_Date`) AND CURDATE() >= `tbl_subscriptionmaster`.`Start_Date` AND `tbl_subscriptionmaster`.`Customer_id` = `tbl_customer_master`.`Customer_Id` AND `tbl_subscriptionmaster`.`SubscriptionMaster_ID` = `tbl_subscriptiondetails`.`Subscriptionmaster_ID` AND `tbl_subscriptiondetails`.`Packagemaster_ID` = `tbl_packagemaster`.`PackageMaster_ID`and `tbl_packagedetails`.`Tbl_PackageMaster_ID`=`tbl_packagemaster`.`PackageMaster_ID`and `tbl_packagedetails`.`Food_ID`=`tbl_foodproductmaster`.`Food_id`
        GROUP BY
            `tbl_foodproductmaster`.`Name`
        ORDER BY
            `tbl_packagemaster`.`PackageMaster_ID` ASC";



                            $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));

                            $c = 0;
                            if ($result1->num_rows > 0) {
                                

                               while ($row = $result1->fetch_assoc()) {
                                     $c++;
                                    ?>    

                                    <tr>
                                        <td><?php echo $c ?></td>

                                        <td><?php echo $row['Name'] ?> </td>
                                        <td>        <?php echo $row['total'] ?></td>
                                        <td><?php
                                           $sql5 = "select Name from tbl_ingredientmaster where IngredientMaster_ID IN (select IngredientMaster_ID from tbl_fooddetails where Food_ID=" . $row['Food_id'] . " )";
                                            $ing = "";
                                            $result5 = $connect->query($sql5);
                                            if ($result5->num_rows > 0) {
                                                $i = 0;
                                                while ($row5 = $result5->fetch_assoc()) {
                                                    $i++;
                                                    if ($i == $result5->num_rows) {
                                                        echo $row5['Name'];
                                                        $ing = $ing . $row5['Name'];
                                                    } else {
                                                        echo $row5['Name'] . ",";
                                                        $ing = $ing . $row5['Name'] . ",";
                                                    }
                                                }
                                            }
                                            ?></td>
                                        <td><?php
                                            
                                            echo "preparig";
                                            ?></td>
                                        <?php
                                        $in = "INSERT INTO tbl_cookingmaster(Food_ID,Prepared_quantity,Date,Prepared_Status,Ingrident)VALUES (" . $row['Food_id'] . "," . $row['total'] . ",CURDATE(),0,'" . $ing . "')";
                                        $result10 = $connect->query($in) or die("Error:" . mysqli_error($connect));
                                        ?>
                                    </tr>
                                    <?php
                                }
                                header("Location:Cook.php");
                            }
 else {echo "no food to make";}
                            //
                            ?>


                            <?php
                        } else {
                            while ($row2 = $result2->fetch_assoc()) {
                                $c++;
                                ?>    

                                <tr>
                                    <td><?php echo $c ?></td>

                                    <td><?php
                                        $sql5 = "select Name from tbl_foodproductmaster where  Food_ID=" . $row2['Food_ID'] . " ";

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
                                        ?> </td>
                                    <td>        <?php echo $row2['Prepared_quantity'] ?></td>
                                    <td><?php
                                        echo $row2['Ingrident'];
                                        ?></td>
                                    <td><?php
                                        if ($row2['Prepared_Status'] == 0) {
                                            echo "preparig";
                                        } else {
                                            echo "prepared";
                                            
                                        }
                                        ?></td>
                                    <td>
                                        <?php if ($row2['Prepared_Status'] == 0) { ?>
                                            <a href="cp.php?id=<?php echo $row2['Cooking_Id'] ?>">prepared?</a>
                                            <?php
                                        } else {
                                            echo "completed";
                                            
                                         }
                                        ?>
                                    </td>


                                </tr>
                                <?php
                           }
                            ?>
                        </table>
                    </div>


                </div>



            </body>
        </html> 
        <?php
    }
        }
        ?>
