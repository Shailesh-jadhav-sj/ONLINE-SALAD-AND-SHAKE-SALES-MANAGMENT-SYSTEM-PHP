<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] == "Admin" || $_SESSION["username"] == "Cook" || $_SESSION["username"] == "Deliverypersoan") {
        header("location:login.php");
    }
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
        <title>Registeration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            
            function validateForm()
            {
                //Name
               
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
                
                
                //contact
                if (document.forms["myform"]["contact"].value === "")
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
        <?php
        require 'header-footer.php';
        require './dbconnection.php';
        if (mysqli_connect_errno()) {

            echo "error";
        } else {
            $sql = "select * from tbl_customer_master where Emailid='" . $_SESSION['username'] . "'";

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                //header("Location:index.php");
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <form name="myform" class="modal-content animate" action="#" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <center><h1>Update Information</h1></center>
                            <hr style="border: 1px solid seagreen;">
                            <p><span class="error">* required field</span></p>
                            <label>Full Name:</label>
                            <input type="text" name="name"value="<?php echo $row['Name'] ?>" >
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']) ?>" style="width: 100px;"/>
                            <br><br>
                            <label>Address:</label>
                            <input type="text" name="add" rows="5" cols="50" value="<?php echo $row['Address'] ?>" ></textarea>
                            <br>
                            <br>
                            <label>EmailID:</label>
                            <input type="email" name="email" id="emailid" value="<?php echo $row['EmailId'] ?>" readonly>
                            <br><br>
                            <label>Contact No.:</label>
                            <input type="tel" name="contact" maxlength="10" pattern="[6-9][0-9]{9}" value="<?php echo $row['Contact_number'] ?>" >
                            <br><br>
                            <label>Gender:</label>
                <input type="radio" name="gender" value="1"><strong>Male</strong>
                <input type="radio" name="gender" value="2"><strong>Female</strong>
                <input type="radio" name="gender" value="0"><strong>Other</strong>
                            <br><br>
                            <label>Hight:</label>
                            <input type="number" name="hight" id="numloc" value="<?php echo $row['Hight'] ?>" >
                            <label>Weight:</label>
                            <input type="text" name="weight" id="numloc" value="<?php echo $row['Weight'] ?>" >
                            <br><br>
                            <label>Date Of Birth:</label>
                            <input type="date" name="dob" value="<?php echo $row['Birthdate'] ?>" >
                            <br><br>
                            <label>Remark:</label>
                            <input type="text" name="remark" rows="5" cols="50" value="<?php echo $row['Remark'] ?>" ></textarea><br><br>


                            <input type="submit" name="update" value="Update Account" onclick="return validateForm();" style="  background-color: yellowgreen;
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

                   
            <?php
        }
    }
        }
        if(isset($_POST['update']))
        {
            
                echo "<script>alert('called ')</script>";
            $query = "update tbl_customer_master set Name='" . $_POST['name'] ."', Address='" . $_POST['add'] . "',Contact_number='" . $_POST['contact'] . "',Gender='" . $_POST['gender'] . "',Hight='" . $_POST['hight'] . "',Weight='" .$_POST['weight'] . "' ,Birthdate='" . $_POST['dob'] . "' where EmailId = '" . $_SESSION['username'] ."'"or die("Error in Query: ");
            mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
            echo "done";
            header("Location:selectpackage.php");
        }
        
?>
    </body>
</html>
<?php
ob_flush();
?>
