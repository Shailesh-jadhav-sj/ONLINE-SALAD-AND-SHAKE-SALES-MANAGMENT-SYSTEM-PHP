<?php
ob_start();
session_start();
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
        <title>Forgot Password</title>
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
    <body style="height: 100px; margin: 0;">
         <div class="header">
            <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
            <div class="header-right">
                <a href="index.php">Home</a>
                <a class="active" href="login.php">Login</a>
                <a href="menu.php">Menu</a>
                
            </div>
        </div>
       
        <form action="#" method="post" class="modal-content animate">
            <div class="container" >
                <label>Email ID:</label>
                <input type="email" name="email" placeholder="Enter Your Email ID"><br>
                <input type="submit" name="send" value="Send OTP" style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px 0;
                       border: none;
                       cursor: pointer;
                       width: 100%;
                       "><br><br>

            </div>
        </form>
        <div class="footer" style="margin-top: auto; background-color:black; color: white; ">
            <hr>
            <footer>
                <table>
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
        
        <?php
        if (isset($_POST['send'])) {
            require './dbconnection.php';
            if (mysqli_connect_errno()) {

                echo "error";
            } else {
               
                $sql = "select * from tbl_customer_master where Emailid='" . $_POST['email'] . "'";

                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    $_SESSION["username"] = $_POST['email'];
                    echo "<script>alert('".$_SESSION["username"]."')</script>";
                    header("Location:change_password.php");
                    exit;
                } else {

                   echo "<script>alert('Wrong EmailId')</script>";
                }
            }
        } else {
           // header("Location:forgotpassword.php");
        }
        ?>
    </body>
</html>
