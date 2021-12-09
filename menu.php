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
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
                <style>
                    * {box-sizing: border-box;}
                    body {font-family: Verdana, sans-serif;}
                    img {vertical-align: middle;}


                    body { 
                        font-family: Arial, Helvetica, sans-serif;
                        background-color: white;
                    }

                    .header {
                        overflow: hidden;
                        background-color: white;
                        padding: 0px 5px;
                    }

                    .header a {
                        float: left;
                        color: black;
                        text-align: center;
                        padding: 12px;
                        text-decoration: none;
                        font-size: 18px; 
                        line-height: 25px;
                        border-radius: 4px;
                    }

                    .header a.logo {
                        font-size: 15px;
                        font-weight: bold;
                    }

                    .header a:hover {
                        background-color: #ddd;
                        color: black;
                    }

                    .header a.active {
                        background-color:green;
                        color: white;
                    }

                    .header-right {
                        float: right;
                    }


                    .footer {
                        position: absolute;
                        width: 100%;
                        background-color: lightgoldenrodyellow;
                        color: black;
                        text-align: center;
                    }
                    .gallery-box{
                        padding: 30px 0px;
                    }
                    .tz-gallery{
                        margin-top: 30px;
                    }
                    .tz-gallery .lightbox img {
                        width: 100%;
                        margin-bottom: 30px;
                        transition: 0.3s ease-in-out;
                        box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                    }
                    .tz-gallery .lightbox img:hover {
                        transform: scale(1.15);
                        box-shadow: 0 8px 15px rgba(0,0,0,1);
                    }

                    .container {
                        position: relative;
                        width: 320px;

                    }

                    .image {
                        display: block;
                        width: 100%;
                        height: auto;
                    }

                    .overlay {
                        position: absolute;
                        bottom: 17%;
                        left: 0;
                        right: 0;
                        background-color: black;
                        opacity: 80%;
                        overflow: hidden;
                        width: 80%;
                        height: 0;
                        transition: .9s ease;
                        text-align: left;   
                    }

                    .container:hover .overlay {
                        height: 80%;

                    }

                    .text {
                        color: white;
                        font-size: 18px;
                        position: absolute;
                        top: 50%;
                        left:50%; 
                        -webkit-transform: translate(-50%, -50%);
                        -ms-transform: translate(-50%, -50%);
                        transform: translate(-50%, -50%);
                        text-align: left;
                    }
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
                <script type="text/javascript">
                    function d()
                    {
                        var GivenDate = document.getElementById("start_date").value;
                        var CurrentDate = new Date();
                        GivenDate = new Date(GivenDate);

                        if (GivenDate > CurrentDate) {
                            return true;
                        } else {
                            alert('Given date is not greater than today.');
                            return false;
                        }
                    }

                </script>

            </head>
            <body style="margin:0%; background-color: seagreen;">
                <form method="post">
                    <div class="header" >
                        <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                        <div class="header-right">
                            <a href="index.php">Home</a>
                            <a href="Logout.php">Logout</a>
                            <a  href="menu.php">Menu</a>
                            <a  href="mypackage.php">My Package</a>

                            <a href="selectpackage.php">Hello,<?php echo $_SESSION['username'] ?></a>

                        </div>
                    </div>

                    <div class="tz-gallery" style="background-color: seagreen; margin-top: 15px; margin-right: 30%;">
                        <table style="padding-left:80px; ">

                            <?php
                            require './dbconnection.php';

                            if (mysqli_connect_errno()) {

                                echo'Error';
                            } else {

                                $_SESSION['count'] = 0;

                                if (isset($_POST['submit'])) {

                                    $sql2 = "select * from tbl_packagemaster where active=1";

                                    $result2 = $connect->query($sql2);

                                    if ($result2->num_rows > 0) {

                                        $n = 0;
                                        while ($row2 = $result2->fetch_assoc()) {
                                            if (isset($_SESSION[$row2['Package_Name']])) {
                                                unset($_SESSION[$row2['Package_Name']]);
                                            }
                                        }
                                    }
                                    $c = 0;
                                    if (isset($_POST['package'])) {
                                        foreach ($_POST['package'] as $check) {
                                            $c++;

                                            $_SESSION['count'] += 1;
                                            $_SESSION[$check] = 1;
                                        }
                                    }
                                } else if (isset($_POST['confirm'])) {


                                    if (isset($_POST['package'])) {
                                        foreach ($_POST['package'] as $check) {
                                            $c++;

                                            $_SESSION['count'] += 1;
                                            //$_SESSION[$check] = 1;
                                        }
                                    }
                                    $_SESSION['Date']=$_POST['start_date'];
                                    $_SESSION['suggestion']=$_POST['Text1'];
                                    
                                    header("Location:confirm_p.php");
                                } else {
                                    $sql2 = "select * from tbl_packagemaster where active=1";

                                    $result2 = $connect->query($sql2);

                                    if ($result2->num_rows > 0) {

                                        $n = 0;
                                        while ($row2 = $result2->fetch_assoc()) {
                                            if (isset($_SESSION[$row2['Package_Name']])) {
                                                unset($_SESSION[$row2['Package_Name']]);
                                            }
                                        }
                                    }
                                }


                                $query1 = "select * from tbl_ingredientmaster";


                                $sql = "select * from tbl_packagemaster where active=1";

                                $result = $connect->query($sql);

                                if ($result->num_rows > 0) {

                                    $n = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        if (isset($_SESSION[$row['Package_Name']])) {
                                            if ($_SESSION[$row['Package_Name']] == 1) {
                                                $_SESSION[$row['Package_Name']] = 1;
                                            } else {
                                                $_SESSION[$row['Package_Name']] = 0;
                                            }
                                        } else {
                                            $_SESSION[$row['Package_Name']] = 0;
                                        }
                                        if ($n == 0) {
                                            echo "<tr>";
                                        }
                                        $n = $n + 1;
                                        ?>

                                        <td><div class="col-sm-12 col-md-4 col-lg-4">
                                                <h2 style="padding-left: 26%; font-family: cursive; color: white; font-style: italic;"><input type="checkbox" <?php echo($_SESSION[$row['Package_Name']] == 1) ? 'checked="checked"' : '' ?> name="package[]" value="<?php echo $row['Package_Name']; ?>" ><?php echo $row['Package_Name']; ?></h2> 

                                                <a class="lightbox" onclick="document.getElementById('<?php echo $row['Package_Name']; ?>').style.display = 'block'"">
                                                    <div class="container">

                                                        <?php echo '  <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" style="width:80%;"/>';
                                                        ?>

                                                        <div class="overlay">
                                                            <div class="text" style="color:white;opacity: 100%;">
                                                                <p style="font-size: small;">Click for more details</p>
                                                                <strong>Price : <?php echo $row['Price']; ?></strong>
                                                                <hr>
                                                                <p style="font-size: small;">

                                                                    <?php
                                                                    $sql1 = "select Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row['PackageMaster_ID'] . " )";

                                                                    $result1 = $connect->query($sql1);
                                                                    if ($result1->num_rows > 0) {
                                                                        $i = 0;
                                                                        while ($row1 = $result1->fetch_assoc()) {
                                                                            $i++;
                                                                            if ($i == $result1->num_rows) {
                                                                                echo $row1['Name'];
                                                                            } else {
                                                                                echo $row1['Name'] . ",";
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div id="<?php echo $row['Package_Name']; ?>" class="modal">
                                                    <span onclick="document.getElementById('<?php echo $row['Package_Name']; ?>').style.display = 'none'" class="close" title="Close">&times;</span>

                                                    <div style="background-color: white; margin-left:20%;  width: 60%;">
                                                        <?php echo '  <img src="images/LOGO_1.jpg"" style="width:100px; hieght:100px;"/>';
                                                        ?>
                                                        <h2 style="float: right; margin-right: 5%;">Salad & Shake</h2>
                                                        <hr>
                                                        <?php echo '  <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" style="width:300px; hieght:300px;"/>';
                                                        ?>
                                                        <div style="float:right; margin-right:20%;">
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
                                                        <p style=" margin-right: 10%;">

                                                            ingredients:
                                                            <?php
                                                            $sql5 = "select Name from tbl_ingredientmaster where IngredientMaster_ID in(select IngredientMaster_ID from tbl_fooddetails where Food_ID in(select FOOD_id from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row['PackageMaster_ID'] . " )))";

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
                                                            <br>
                                                            Description:
                                                            <?php
                                                            echo $row['Description'];
                                                            ?>
                                                            <br>
                                                            <br>
                                                        </p>



                                                    </div>
                                                </div>



                                            </div></td>
                                        <?php
                                        if ($n == 3) {

                                            $n = 0;
                                            echo " </tr>";
                                        }
                                        ?>

                                    <?php } ?>

                                    <?php
                                    // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                                }
                            }
                        }
                        ?>


                    </table>
                </div>
                <div class="div1"style="background-color:white; top:12%; margin-left: 75%;position: absolute;" >

                    <center style="padding-top: 0%;"> <input type="submit" name="submit" value="Check Total Price" style="background-color: green;
                                                             color: white;
                                                             padding: 8px 10px;
                                                             margin: 0px 0px;
                                                             border: none;
                                                             cursor: pointer;
                                                             width: 100%;"> </center>
                                                             <?php
                                                             $tprice = 0;
                                                             if (isset($_POST['submit'])) {
                                                                 echo '<table style="width:100%">';
                                                                 $c = 0;
                                                                 if (isset($_POST['package'])) {
                                                                     foreach ($_POST['package'] as $check2) {
                                                                         $sql3 = "select * from tbl_packagemaster where Package_Name='" . $check2 . "' and active=1";

                                                                         $result3 = $connect->query($sql3);

                                                                         if ($result3->num_rows > 0) {

                                                                             while ($row2 = $result3->fetch_assoc()) {
                                                                                 echo '<tr>';
                                                                                 echo '<td>';
                                                                                 echo $row2['Package_Name'];
                                                                                 echo '</td>';
                                                                                 echo '<td style="left=0;">';
                                                                                 echo "" . $row2['Price'] . "";
                                                                                 $tprice += $row2['Price'];
                                                                                 echo '</td>';
                                                                                 echo '</tr>';
                                                                             }
                                                                         }
                                                                     }
                                                                 } else {
                                                                     echo "no product Added in list";
                                                                 }


                                                                 echo '<tr>';
                                                                 echo '<td colspan="2">';
                                                                 echo '<hr>';
                                                                 echo '</td>';
                                                                 echo '</tr>';
                                                                 echo '<tr>';
                                                                 // echo '==============================';

                                                                 echo '<td>';

                                                                 echo "Total";
                                                                 echo '</td>';
                                                                 echo '<td style="left=0;">';
                                                                 echo "" . $tprice . "";
                                                                 echo '</td>';
                                                                 echo '</tr>';
                                                                 echo '</table>';
                                                             } else {
                                                                 echo "no product Added in list";
                                                                 echo '<tr>';
                                                                 echo '<td colspan="2">';
                                                                 echo '<hr>';
                                                                 echo '</td>';
                                                                 echo '</tr>';
                                                                 echo '<tr>';
                                                                 // echo '==============================';

                                                                 echo '<td>';

                                                                 echo "Total";
                                                                 echo '</td>';
                                                                 echo '<td style="left=0;">';
                                                                 echo "" . $tprice . "";
                                                                 echo '</td>';
                                                                 echo '</tr>';
                                                                 echo '</table>';
                                                             }
                                                             ?>
                    <center style="margin-top: 100%; ;" >
                        Suggestion:<textarea name="Text1" cols="22" rows="4"></textarea>
                        <hr>
                        package start-date:<input id="start_date" type="date" name="start_date" >
                        <hr>
                        <input type="submit" onclick="return d();" name="confirm" value="Confirm" style="background-color: green;
                               color: white;

                               padding: 8px 50px;
                               margin: 0px 0;
                               border: none;
                               cursor: pointer;
                               width: 100%;"> 
                    <hr>
                        <p>Note:listed items will be added in subscription </p></center>
                </div>

            </form>
            <div class="footer" style="margin-top: auto; background-color:black; color:white;">
                <hr>
                <footer>
                    <table style="color: white; text-align: center;">
                        <tr>
                            <td style="width: 33%;">
                                <h3>About Us</h3>
                                <p>We are happy to be providing healthy meals to our valued customers.</p>
                            </td>
                            <td style="width: 33%;">
                                <h3>Opening hours</h3>
                                <p><span class="text-color">Monday: </span>Closed</p>
                                <p><span class="text-color">Tue-Wed :</span> 9:Am - 10PM</p>
                                <p><span class="text-color">Thu-Fri :</span> 9:Am - 10PM</p>
                                <p><span class="text-color">Sat-Sun :</span> 5:PM - 10PM</p>
                            </td>
                            <td style="width: 33%;">
                                <h3>Contact information</h3>
                                <p>Somewhere in Surat</p>
                                <p >Mobile :+91-9724180300</p>
                                <p>Email : <a href="mailto:SaladAndShake@gmail.com"> SaladAndShake@gmail.com</a></p>
                            </td>



                        </tr>
                    </table>
                    <hr>
                    <div class="copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="company-name">&COPY;All Rights Reserved,Design By : Shailesh and Khyati</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </footer>
            </div>
        </body>
    </html>

    <?php
} else {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title></title>
            <style>
                * {box-sizing: border-box;}
                body {font-family: Verdana, sans-serif;}
                img {vertical-align: middle;}


                body { 
                    font-family: Arial, Helvetica, sans-serif;
                    background-color: white;
                }

                .header {
                    overflow: hidden;
                    background-color: white;
                    padding: 0px 5px;
                }

                .header a {
                    float: left;
                    color: black;
                    text-align: center;
                    padding: 12px;
                    text-decoration: none;
                    font-size: 18px; 
                    line-height: 25px;
                    border-radius: 4px;
                }

                .header a.logo {
                    font-size: 15px;
                    font-weight: bold;
                }

                .header a:hover {
                    background-color: #ddd;
                    color: black;
                }

                .header a.active {
                    background-color:green;
                    color: white;
                }

                .header-right {
                    float: right;
                }


                .footer {
                    position: absolute;
                    width: 100%;
                    background-color: lightgoldenrodyellow;
                    color: white;
                    text-align: center;
                }
                .gallery-box{
                    padding: 30px 0px;
                }
                .tz-gallery{
                    margin-top: 30px;
                }
                .tz-gallery .lightbox img {
                    width: 100%;
                    margin-bottom: 30px;
                    transition: 0.2s ease-in-out;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                }
                .tz-gallery .lightbox img:hover {
                    transform: scale(1.10);
                    box-shadow: 0 18px 15px rgba(0,0,0,0.3);
                }

            </style>

        </head>
        <body style="margin:0%; background-color: seagreen;">
            <div class="header" >
                <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                <div class="header-right">
                    <a href="index.php">Home</a>
                    <a href="login.php">Login</a>
                    <a class="active" href="menu.php">Menu</a>

                </div>
            </div>


    <div class="footer" style="margin-top: auto; background-color:black; color: white; ">
        <hr>
        <footer>
            <table style="color: white; text-align: center;">
                <tr>
                    <td style="width: 33%;">
                        <h3>About Us</h3>
                        <p>We are happy to be providing healthy meals to our valued customers.</p>
                    </td>
                    <td style="width: 33%;">
                        <h3>Opening hours</h3>
                        <p><span class="text-color">Monday: </span>Closed</p>
                        <p><span class="text-color">Tue-Wed :</span> 9:Am - 10PM</p>
                        <p><span class="text-color">Thu-Fri :</span> 9:Am - 10PM</p>
                        <p><span class="text-color">Sat-Sun :</span> 5:PM - 10PM</p>
                    </td>
                    <td style="width: 33%;">
                        <h3>Contact information</h3>
                        <p>Somewhere in Surat</p>
                        <p >Mobile :+91-9724180300</p>
                        <p>Email : <a href="mailto:SaladAndShake@gmail.com"> SaladAndShake@gmail.com</a></p>
                    </td>



                </tr>
            </table>
            <hr>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="company-name">&COPY;All Rights Reserved,Design By : Shailesh and Khyati</p>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
    </div>

    </body>
    </html>
    <?PHP
}
?>
