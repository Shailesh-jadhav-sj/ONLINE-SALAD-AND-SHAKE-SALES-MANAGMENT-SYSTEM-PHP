<?php
ob_start();
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION["username"] == "Admin") {
        header("location:Admin.php");
    } else if ($_SESSION["username"] == "Cook") {
        header("location:Cook.php");
    } else if ($_SESSION["username"] == "Deliverypersoan") {
        header("location:Deliverypersoan.php");
    } else if ($_SESSION["username"] != Null) {
        header("location:index.php");
    }
    //echo $_SESSION['username'];   
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
        <title>login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            * {box-sizing: border-box;}
            body {font-family: Verdana, sans-serif;}
            .mySlides {display: none;}
            img {vertical-align: middle;}

            /* Slideshow container */
            .slideshow-container {
                max-width: 100%;
                position: relative;
                margin: auto;
            }

            /* The dots/bullets/indicators */
            .dot {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: black;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 2s ease;
            }

            .active {
                background-color: #717171;
            }

            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
            }

            @keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
                .text {font-size: 11px}
            }

            * {box-sizing: border-box;}

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
                background-color: green;
                color: white;
            }

            .header-right {
                float: right;
            }

            @media screen and (max-width: 500px) {
                .header a {
                    float: none;
                    display: block;
                    text-align: left;
                }

                .header-right {
                    float: none;
                }
            }
            .footer {
                position: absolute;
                width: 100% 50%;
                background-color: lightgoldenrodyellow;
                color: black;
                text-align: center;
            }

            body {font-family: Arial, Helvetica, sans-serif;
                  background-image: url(images/slider-1.jpg);
                  background-repeat: no-repeat;
                  background-size: 100%;


            }

            /* Full-width input fields */
            input[type=email], input[type=password] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            .imgcontainer {
                text-align: center;
                margin: 24px 0 12px 0;
                position: relative;
            }

            img.avatar {
                width: 30%;
                border-radius: 10%;
            }

            .container {
                padding: 16px;
                padding-bottom:5.3%;
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
                border: 1px solid black;
                width: 30%; /* Could be more or less, depending on screen size */
            }

        </style>
        <script>
            function validateForm()
            {
                var email = myform.emailid.value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (email == "" || atpos < 1 || (dotpos - atpos < 2))
                {
                    alert("Enter Your Correct Email ID")
                    return;
                }
                var secondpassword = document.myform.password.value;
                if (secondpassword === "")
                {
                    alert("Fill password");
                    return false;
                }
            }
        </script>
    </head>

    <body style="height: 100px;">
        <div class="header">
            <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
            <div class="header-right">
                <a href="index.php">Home</a>
                <a class="active" href="login.php">Login</a>
                

            </div>
        </div>

        <form name="myform" class="modal-content animate" action="#" method="post">
            <div class="container" >
                <div class="imgcontainer">
                    <img src="images/LOGO_19.png" class="avatar">
                </div>
                <label>EmailID:</label><br>
                <input type="email" name="email" id="emailid" placeholder="Enter Your EmailID"><br><br>
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Enter Your Password"><br><br>

                <input type="submit" name="submit" value="LOGIN" onclick="return validateForm();"style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px 0;
                       border: none;
                       cursor: pointer;
                       width: 100%;
                       "/>
                <div style="float: right;">
                    <a href="registration.php">Register Here?</a><br>
                    <a href="forgotpassword.php">Forgot Password?</a>
                </div></div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            if ($_POST['email'] == "Admin@gmail.com") {
                if ($_POST['password'] == "Admin") {
                    $_SESSION["username"] = "Admin";
                    header("Location:Admin.php");
                } else {
                    echo "<script>alert('wrong password')</script>";
                }
            } elseif ($_POST['email'] == "Cook@gmail.com") {
                if ($_POST['password'] == "Cook") {
                    $_SESSION["username"] = "Cook";
                    header("location:Cook.php");
                } else {
                    echo "<script>alert(' wrong password')</script>";
                }
            } elseif ($_POST['email'] == "Deliverypersoan@gmail.com") {
                if ($_POST['password'] == "Deliverypersoan") {
                    $_SESSION["username"] = "Deliverypersoan";

                    header("location:Deliverypersoan.php");
                } else {
                    echo "<script>alert('wrog password')</script>";
                }
            }
            require './dbconnection.php';
            if (mysqli_connect_errno()) {

                echo "error";
            } else {
                $pass = md5($_POST['password']);
                $sql = "select * from tbl_customer_master where Emailid='" . $_POST['email'] . "'and Password='" . $pass . "' and status=1";

                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    $_SESSION["username"] = $_POST['email'];
                    header("Location:index.php");
                } else {
                    echo "<script>alert('wrong id or pass')</script>";
                }
            }
        }
        ?>
    </body>
</html>
<?php
ob_end_flush();
?>