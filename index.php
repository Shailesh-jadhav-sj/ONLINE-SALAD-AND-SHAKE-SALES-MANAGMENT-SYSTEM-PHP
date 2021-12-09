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
        <title>SALAD&SHAKE</title>

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
     
        </style>

    </head>

<?php
if(isset($_SESSION["username"]))
{
    
if($_SESSION["username"] =="Admin")
{
    header("location:Admin.php");   
}
if($_SESSION["username"] =="Cook")
{
    header("location:Cook.php");   
}
if($_SESSION["username"] =="Deliverypersoan")
{
    header("location:Deliverypersoan.php");   
}
if($_SESSION["username"] != NULL)
{?>
  <body style="margin: 0;">
        <div class="header">
            <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
           <div class="header-right">
                <a  href="index.php">Home</a>
                <a href="Logout.php">Logout</a>
                <a href="menu.php">Menu</a>
                <a  href="mypackage.php">My Package/deliverys</a>
                
                <a href="selectpackage.php">Hello,<?php echo $_SESSION['username'] ?></a>
                
            </div>
        </div>
        <div class="slideshow-container">

            <div class="mySlides fade">
                <img src="images/SLIDER2.jpg" alt="Salad-Shake" style="width: 100%; height: 700px"/>
                <h1 style="position: absolute; top: 10%; right: 80%; font-size:30px; color: white;"><strong>Welcome To <br><div style="color: green;">Salad And Shake</div></strong></h1>
                </div>

            <div class="mySlides fade">
                <img src="images/slider-1.jpg" alt="Salad-Shake" style="width: 100%; height: 700px" />
                <h1 style="position: absolute; top: 10%; right: 30%;  color:lightgoldenrodyellow;"><strong>experience our salads and shakes <br>ans see changes in you.</strong></h1>
                 </div>

            <div class="mySlides fade">
                <img src="images/767555.jpg" alt="Salad-Shake" style="width: 100%; height: 700px"  />
                <h1 style="position: absolute; top: 10%; right: 8%;  color: white;"><strong>we guaranteed,<br><div style="color: pink;">your satisfaction</div></strong></h1>
                
            </div>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
        </div>
       
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
        
        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
        </script>
    </body>
    <?php
}
}
 else {
    

?>
    <body style="margin: 0;">
        <div class="header">
            <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
            <div class="header-right">
                <a class="active" href="index.php">Home</a>
                <a href="login.php">Login</a>
                
                
            </div>
        </div>
        <div class="slideshow-container">

            <div class="mySlides fade">
                <img src="images/SLIDER2.jpg" alt="Salad-Shake" style="width: 100%; height: 700px"/>
                <h1 style="position: absolute; top: 10%; right: 80%; font-size:30px; color: white;"><strong>Welcome To <br><div style="color: green;">Salad And Shake</div></strong></h1>
                </div>

            <div class="mySlides fade">
                <img src="images/slider-1.jpg" alt="Salad-Shake" style="width: 100%; height: 700px" />
                <h1 style="position: absolute; top: 10%; right: 30%;  color:lightgoldenrodyellow;"><strong>experience our salads and shakes <br>ans see changes in you.</strong></h1>
                 </div>

            <div class="mySlides fade">
                <img src="images/767555.jpg" alt="Salad-Shake" style="width: 100%; height: 700px"  />
                <h1 style="position: absolute; top: 10%; right: 8%;  color: white;"><strong>we guaranteed,<br><div style="color: pink;">your satisfaction</div></strong></h1>
                
            </div>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
        </div>
       
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
        
        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
        </script>
    </body>
</html>
<?php
 }
?>
