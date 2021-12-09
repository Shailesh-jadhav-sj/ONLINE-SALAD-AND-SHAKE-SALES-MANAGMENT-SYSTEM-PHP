<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION["username"] == NULL) {
    header("location:login.php");
} else if ($_SESSION["username"] == "Admin") {
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Header-Footer</title>
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

                .navbar a {
                    float: left;
                    font-size: 16px;
                    color: white;
                    text-align: center;
                    padding: 14px 16px;
                    text-decoration: none;
                }

                .dropdown {
                    float: left;
                    overflow: hidden;
                }

                .dropdown .dropbtn {
                    font-size: 16px;  
                    border: none;
                    outline: none;
                    color: black;
                    padding: 14px 16px;
                    background-color: inherit;
                    font-family: inherit;
                    margin: 0;
                }

                .navbar a:hover, .dropdown:hover .dropbtn {
                    background-color: #ddd;
                }

                .dropdown-content {
                    display: none;
                    position: absolute;
                    background-color: #f9f9f9;
                    min-width: 160px;
                    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                    z-index: 1;
                }

                .dropdown-content a {
                    float: none;
                    color: black;
                    padding: 12px 16px;
                    text-decoration: none;
                    display: block;
                    text-align: left;
                }

                .dropdown-content a:hover {
                    background-color: #ddd;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
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
                    transition: 0.2s ease-in-out;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                }
                .tz-gallery .lightbox img:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
                }

            </style>
        </head>
        <body style="margin:0%; background-color: seagreen;">
            <div class="header" >
                <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                <div class="header-right">      
                        <a href="Admin.php">Home</a>
                        
                                <a href="addpackage.php">Add Package</a>
                                <a href="addingredient.php">Add Ingredient</a>
                                <a href="addfoodproduct.php">Add FoodProduct</a>
                                <a href="update.php">Update products</a>
                        
                        <a href="Logout.php">Logout</a>
                        <a style="pointer-events:none;" >Hello,Admin</a>                   
                </div>
            </div>



            

            <?php
            // put your code here
            ?>
        </body>
    </html>
    <?php
    // put your code here
} else if ($_SESSION["username"] == "Deliverypersoan") {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Header-Footer</title>
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
                    transition: 0.2s ease-in-out;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                }
                .tz-gallery .lightbox img:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
                }

            </style>
        </head>
        <body style="margin:0%; background-color: seagreen;">
            <div class="header" >
                <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                <div class="header-right">
                    <a href="Deliverypersoan.php">Home</a>
                    <a href="cl.php">Classification</a>
                    <a href="Logout.php">Logout</a>
                    <a style="pointer-events:none;" >Hello,Deliverypersoan</a>

                </div>
            </div>


           

            <?php
            // put your code here
            ?>
        </body>
    </html>
    <?php
    // put your code here
} else if ($_SESSION["username"] == "Cook") {
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>Header-Footer</title>
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
                    transition: 0.2s ease-in-out;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                }
                .tz-gallery .lightbox img:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
                }

            </style>
        </head>
        <body style="margin:0%; background-color: seagreen;">
            <div class="header" >
                <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                <div class="header-right">
                    <a class="active" href="Cook.php">Home</a>
                    <a href="Logout.php">Logout</a>
                    <a style="pointer-events:none;" >Hello,Cook</a>

                </div>
            </div>





            <?php
            // put your code here
            ?>
        </body>
    </html>

    <?php
    // put your code here
} else {
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
                    transition: 0.2s ease-in-out;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.2);
                }
                .tz-gallery .lightbox img:hover {
                    transform: scale(1.05);
                    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
                }

            </style>
        </head>
        <body style="margin:0%; background-color: seagreen;">
            <div class="header" >
                <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
                <div class="header-right">
                    <a href="index.php">Home</a>
                    <a href="Logout.php">Logout</a>
                    <a  href="menu.php">Menu</a>
                    <a  href="mypackage.php">My Package/deliverys</a>

                    <a  href="selectpackage.php">Hello,<?php echo $_SESSION['username'] ?></a>

                </div>
            </div>



            <div class="footer" style="margin-top:1300px;  background-color:black; color:white;">
                <hr style="border-color: white;">
                <footer>
                    <table style="color: white; text-align: center;">
                        <tr>
                            <td style="width: 33%;">
                                <h3>About Us</h3>
                                <p>We are happy to be providing healthy meals to our valued customers.</p>
                            </td>
                            <td style="width: 33%;">
                                <h3>Opening hours</h3>
                                <p><span class="text-color">Sunday: </span>Closed</p>
                                <p><span class="text-color">Mon-Tue :</span> 9:Am - 10PM</p>
                                <p><span class="text-color">Wed-Thu :</span> 9:Am - 10PM</p>
                                <p><span class="text-color">Fri-Sat :</span> 5:PM - 10PM</p>
                            </td>
                            <td style="width: 33%;">
                                <h3>Contact information</h3>
                                <p>Somewhere in Surat</p>
                                <p >Mobile :+91-9724180300</p>
                                <p>Email : <a href="mailto:SaladAndShake@gmail.com"> SaladAndShake@gmail.com</a></p>
                            </td>



                        </tr>
                    </table>
                    <hr style="border-color: white;">
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
            // put your code here
            ?>
        </body>
    </html>
    <?php
}
ob_flush();
?>
