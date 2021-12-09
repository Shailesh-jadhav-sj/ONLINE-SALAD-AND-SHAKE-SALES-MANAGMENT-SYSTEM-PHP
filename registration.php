<?php
ob_start();
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
        <title>Registeration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            function get_age(born, now) {
                    var birthday = new Date(now.getFullYear(), born.getMonth(), born.getDate());
                    if (now >= birthday)
                        return now.getFullYear() - born.getFullYear();
                    else
                        return now.getFullYear() - born.getFullYear() - 1;
            }
            function validateForm()
            {
                //Name
                var fileName = document.forms["myform"]["image"].value;
                var idxDot = fileName.lastIndexOf(".") + 1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                    //TO DO
                } else {
                    alert("Only jpg/jpeg and png files are allowed!");
                    return false;
                }
                var x = document.forms["myform"]["name"].value;
                if (x === "")
                {
                    alert("Name Must Be Filled Out!!!");
                    myform.name.focus();
                    return false;
                }
                var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
                if (!regName.test(x)) {
                    alert("enter valid name");
                    return false;
                }
                //Address
                var y = document.forms["myform"]["add"].value;
                if (y === "")
                {
                    alert("Address Must Be Filled Out!!!");
                    return false;
                }
                //image
                if (document.forms["myform"]["image"].value == "")
                {
                    alert("File Must Be Filled Out!!!");
                    return false;
                }
                //Email ID
                var email = myform.emailid.value;
                atpos = email.indexOf("@");
                dotpos = email.lastIndexOf(".");
                if (email == "" || atpos < 1 || (dotpos - atpos < 2))
                {
                    alert("Enter Your Correct Email ID");
                    return false;
                }
                //contact
                if (document.forms["myform"]["contact"].value == "")
                {
                    alert("Contact Number Must Be Filled Out!!!");
                    return false;
                }

                //Gender
                if ((myform.gender[0].checked == false) && (myform.gender[1].checked == false) && (myform.gender[2].checked == false))
                {
                    alert("Select Your Gender!!!");
                    return false;
                }
            
                var valueDate = document.forms["myform"]["dob"].value;
                
                if (!Date.parse(valueDate)) {
                    alert('date is invalid');
                    return false;
                }
                

                var hight = document.myform.hight.value;
                var weight = document.myform.weight.value;
                if (hight === "" || weight === "")
                {
                    alert("Fill hight and weight");
                    return false;
                }
                //Password-Re_password
                var firstpassword = document.myform.password.value;
                var secondpassword = document.myform.re_password.value;
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
            .error {color: #FF0000}

            body {font-family: Arial, Helvetica, sans-serif;
                  background-image: linear-gradient( to right,#4560ad, #00bad3,#00a9b6);}

            .container {
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
                background: transparent;

                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 5px solid seagreen;
                width: 50%; /* Could be more or less, depending on screen size */
            }
            .modal-content label{
                font-weight: bold;
                color: #000000;
            }
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
                color: white;
                text-align: center;
                margin-bottom: 0px;
                padding-bottom: 0px;
            }

        </style>

    </head>

    <body  style=" background-image:url('images/regb.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="header" >
            <img src="images/LOGO_19.png" alt="logo" style="width:90px"/>
            <div class="header-right">
                <a href="index.php">Home</a>
                <a href="login.php">Login</a>
                <a  href="menu.php">Menu</a>

            </div>
        </div>
        <form name="myform" class="modal-content animate" action="index_1.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
            <div class="container">
                <center><h1>REGISTER</h1></center>
                <hr style="border: 1px solid seagreen;">
                <p><span class="error">* required field</span></p>
                <label>Full Name:</label>
                <input type="text" name="name" placeholder="Enter Your Full Name">
                <span class="error">* </span><br><br>
                <label>Address:</label>
                <textarea id="add" name="add" rows="5" cols="50" placeholder="Enter Your Address"></textarea>
                <span class="error">* </span><br><br>
                <label>Image:</label>
                <input type="file" name="image" accept="image/*"><br><br>
                <label>EmailID:</label>
                <input type="email" name="email" id="emailid" placeholder="Enter Your EmailID">
                <br><br>
                <label>Contact No.:</label>
                <input type="tel" name="contact" maxlength="10" pattern="[6-9][0-9]{9}" placeholder="Enter Your Contact No">
                <br><br>
                <label>Gender:</label>
                <input type="radio" name="gender" value="1"><strong>Male</strong>
                <input type="radio" name="gender" value="2"><strong>Female</strong>
                <input type="radio" name="gender" value="0"><strong>Other</strong>
                <br><br>
                <label>Hight:</label>
                <input type="number" name="hight" id="numloc" placeholder="Enter Your Hight">
                <label>Weight:</label>
                <input type="text" name="weight" id="numloc" placeholder="Enter Your Weight">
                <br><br>
                <label>Date Of Birth:</label>
                <input type="date" name="dob" max="2014-02-22">
                <br><br>
                <label>Remark:</label>
                <textarea id="remark" name="remark" rows="5" cols="50" placeholder="Enter Your Remark"></textarea><br><br>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter Your Password">
                <br><br>
                <label>Re-Enter Password:</label>
                <input type="password" name="re_password" placeholder="Re-Enter Your Password">
                <br><br>

                <input type="submit" name="register" value="REGISTER" onclick="return validateForm();" style="  background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px 0;
                       border: none;
                       cursor: pointer;
                       width: 100%;"/>

                <input type="reset" name="reset" value="RESET" style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px 0;
                       border: none;
                       cursor: pointer;
                       width: 100%;"/>

            </div>
        </form>

        <div class="footer" style="margin-top: auto; margin-bottom:0%; background-color:black; color: white; ">
            <hr style="border-color:white;">
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
                <hr style="border-color:white;">
                <div class="copyright">
                    <div class="container" >
                        <div class="row" >
                            <div class="col-lg-12">
                                <p class="company-name">&COPY;All Rights Reserved,Design By : Shailesh and Khyati</p>
                            </div>
                        </div>
                    </div>
                </div>

            </footer>
        </div>

        <?php
        ?>
    </body>
</html>
<?php
ob_flush();
?>
