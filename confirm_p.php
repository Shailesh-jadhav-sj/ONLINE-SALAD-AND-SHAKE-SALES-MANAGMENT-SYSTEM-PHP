<?php

ob_start();
session_start();
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] == "Admin") {
        header("location:Admin.php");
    }
    if ($_SESSION["username"] == "Cook") {
        header("location:Cook.php");
    }
    if ($_SESSION["username"] == "Deliverypersoan") {
        header("location:Deliverypersoan.php");
    }
    if ($_SESSION["username"] != NULL) {


        require './dbconnection.php';

        if (mysqli_connect_errno()) {

            echo'Error';
        } else {


            if (isset($_SESSION['count'])) {
                if ($_SESSION['count'] > 0) {


                    $sql2 = "select * from tbl_packagemaster where active=1";

                    $result2 = $connect->query($sql2);

                    if ($result2->num_rows > 0) {

                        $p = 0;

                        while ($row2 = $result2->fetch_assoc()) {
                            if (isset($_SESSION[$row2['Package_Name']])) {
                                if ($_SESSION[$row2['Package_Name']]) {
                                    $p += $row2['Price'];
                                }
                            }
                        }
                    }
                    $d = $_SESSION['Date'];
                    $s = $_SESSION['suggestion'];
                    $query = "INSERT INTO `tbl_subscriptionmaster`( `Customer_id`, `Start_Date`, `Price`, `Suggestion`, `Payment_status`)values((select Customer_Id from tbl_customer_master where EmailId = '" . $_SESSION['username'] . "'),'" . $d . "','" . $p . "','" . $s . "',0)"or die("Error in Query: ");
                    echo $query;
                    mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
                    $sql6 = "select SubscriptionMaster_ID from tbl_subscriptionmaster ORDER BY SubscriptionMaster_ID DESC LIMIT 1";

                    $result6 = $connect->query($sql6);

                    $sid1 = $result6->fetch_assoc();
                    $sid=$sid1['SubscriptionMaster_ID'];
                    echo $sid;
                    $sql2 = "select * from tbl_packagemaster where active=1";

                    $result2 = $connect->query($sql2);

                    if ($result2->num_rows > 0) {

                    while ($row2 = $result2->fetch_assoc()) {
                        if (isset($_SESSION[$row2['Package_Name']])) {
                            if ($_SESSION[$row2['Package_Name']]) {
                                $query2 = "INSERT INTO `tbl_subscriptiondetails`(`Total_Days`, `Packagemaster_ID`, `Subscriptionmaster_ID`) values('" . $row2['Days'] . "','" . $row2['PackageMaster_ID'] . "','" . $sid . "') ";
                                echo $query2;
                                $result6 = $connect->query($query2)or die("error in query:" . mysqli_error($connect));
                                echo $result6;
                            }
                            unset($_SESSION[$row2['Package_Name']]);
                        }
                    }
                    unset($_POST['submit']);
                    $_SESSION['count'] = 0;
                   header("Location:mypackage.php");
                } else {
                    echo $_SESSION['count'];
                  header("Location:menu.php");
                }}
            } else {
                echo $_SESSION['count'];
                header("Location:menu.php");
            }
        }
    }
}
?>