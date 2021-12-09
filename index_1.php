<?php
ob_start();
session_start();
require './PHPMailer.php';
require './Exception.php';
require './SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register'])) {
    require './dbconnection.php';
    if (mysqli_connect_errno()) {

        echo "error";
    } else {

        $sql = "select * from tbl_customer_master where Emailid='" . $_POST['email'] . "'";

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {

            echo "<script>
alert('you are already registerd');
window.location.href='./login.php';
</script>";
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
            $mail->addAddress($_POST['email']);

            if ($mail->send()) {
                echo"mail sent" . $mail->ErrorInfo;
            } else {
                echo"Not sent";
            }
            $mail->smtpClose();
        } 
            }
}
else {
            header("Location:registration.php");
        }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registeration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            function validateForm()
            {
                var firstpassword = document.myform.otp.value;
                var secondpassword = document.myform.otp1.value;
                if (secondpassword === "")
                {
                    alert("Fill otp");
                    return false;
                } else
                {
                    if (firstpassword !== secondpassword)
                    {

                        alert("wrong otp!!!");
                        return false;
                    }
                }
            }
        </script>

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
                width: 100%;
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
                margin: px 0;
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

            body {font-family: Arial, Helvetica, sans-serif;
                  background-color: seagreen;}

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

    <body style="height: 1200px;">
        <form name="myform" class="modal-content animate" action="reg.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
            <label>OTP</label>
            <input type="text" name="otp1" placeholder="Enter Your OTP">
            <input type="hidden" name="otp" value="<?php echo $otp ?>"/>
            <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>">

            <input type="hidden" name="add" value="<?php echo $_POST['add'] ?>">
<?php $_SESSION['photo'] = addslashes(file_get_contents($_FILES['image']['tmp_name'])); ?>

<!--<input type="text" name="image" value="<?php //echo addslashes(file_get_contents($_FILES['image']['tmp_name']))  ?>">
            -->

            <input type="hidden" name="email" id="emailid" value="<?php echo $_POST['email'] ?>" >
            <input type="hidden" name="contact" value="<?php echo $_POST['contact'] ?>">
            <input type="hidden" name="gender" value="<?php echo $_POST['gender'] ?>">
            <input type="hidden" name="hight" value="<?php echo $_POST['hight'] ?>">
            <input type="hidden" name="weight" value="<?php echo $_POST['weight'] ?>">

            <input type="hidden" name="dob" value="<?php echo $_POST['dob'] ?>">
            <input type="hidden" name="remark" value="<?php echo $_POST['remark'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>" >
            <input type="submit" name="send" value="submit">

        </form>
    </body>
</html>
<?php
ob_flush();
?>
