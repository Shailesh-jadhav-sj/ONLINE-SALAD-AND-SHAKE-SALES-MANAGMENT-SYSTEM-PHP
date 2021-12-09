<?php
ob_start();
session_start();
require './PHPMailer.php';
require './Exception.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['username'])) {

    header("Location:forgotpassword.php");
} else {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "18bmiit053@gmail.com";
    $mail->Password = "kspatel12";
    $mail->Subject = "OTP FOR REGISTRATION";
    $mail->setFrom("18bmiit053@gmail.com");

    function generateNumericOTP($n) {

        // Take a generator string which consist of 
        // all numeric digits 
        $generator = "1357902468";

        // Iterate for n-times and pick a single character 
        // from generator and append it to $result 
        // Login for generating a random character from generator 
        //     ---generate a random number 
        //     ---take modulus of same with length of generator (say i) 
        //     ---append the character at place (i) from generator to result 

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result 
        return $result;
    }

// Main program 
    $n = 6;

    $otp = generateNumericOTP($n);
    $mail->Body = $otp;
    $_post['otp'] = $otp;
    $mail->addAddress($_SESSION['username']);

    if ($mail->send()) {
        echo"mail sent" . $mail->ErrorInfo;
    } else {
        echo"Not sent";
    }
    $mail->smtpClose();
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
        <title>change Password</title>
        <script type="text/javascript">
            function validateForm()
            {
              
                var otp = document.myform.otp.value;
                var otp1 = document.myform.otp1.value;
                if (otp1 === "")
                {
                    alert("Fill otp");
                    return false;
                } else
                {
                    if (otp !== otp1)
                    {

                        alert("wrong otp!!!");
                        return false;
                    }
                }
                var firstpassword = document.myform.newpassword.value;
                var secondpassword = document.myform.reenterpassword.value;
                if (firstpassword === "" || secondpassword === "")
                {
                    alert("Fill password");
                    return false;
                } else
                {
                    if (firstpassword !== secondpassword)
                    {

                        alert("Passsword Must Be Same!!!");
                        return false;
                    }
                }
            }
        </script>
        <style>
            body {font-family: Arial, Helvetica, sans-serif;
                  background-image:url(images/slider-1.jpg);}

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
                width: 20%;
                border-radius: 50%;
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
    </head>
    <body style="height: 100px;">
        <form name="myform" action="#" method="post" class="modal-content animate" onsubmit="return validateForm();">
            <div class="container" >

                <label>OTP</label>
                <input type="text" name="otp" placeholder="Enter The OTP"><br><br>
                <label>New Password</label>
                <input type="password" name="newpassword" placeholder="Enter Your New Password"><br><br>
                <label>Re-Enter New Password</label>
                <input type="password" name="reenterpassword" placeholder="Re-Enter Your New Password"><br><br>
                <input type="hidden" name="otp1" value="<?php echo $otp ?>"/>

                <input type="submit" name="submit" value="SUBMIT" style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px 0;
                       border: none;
                       cursor: pointer;
                       width: 100%;
                       ">
            </div>
        </form>
<?php
 if (isset($_POST['submit'])) {
            require './dbconnection.php';
            if (mysqli_connect_errno()) {

                echo "error";
            } else {
                $pass= md5($_POST['newpassword']);
                echo "<script>alert(".$pass.")</script>";
                $sql = "update tbl_customer_master set Password='".$pass."' where Emailid='".$_SESSION['username']."'";

                 mysqli_query($connect, $sql)or die("error in query:" . mysqli_error($connect));
                 $_SESSION['username']=null;
                header("Location:login.php");
           
        }}
?>
    </body>
</html>
