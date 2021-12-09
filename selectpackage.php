<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] == "Admin" || $_SESSION["username"] == "Cook" || $_SESSION["username"] == "Deliverypersoan") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
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
        <title>Update Profile</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script type="text/javascript">
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
                background-image:url(images/regb.jpg);
                padding-bottom:100px;
                background-size:100% 100%;
            }

        </style>

    </head>
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
                <body  >     
                    <form name="myform" class="modal-content animate" action="#" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <center><h1>Your Profile</h1></center>
                            <hr style="border: 1px solid seagreen;">
                            <label>Full Name:</label>
                            <input type="text" name="name"value="<?php echo $row['Name'] ?>" readonly>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']) ?>" style="width: 100px;"/>
                            <br><br>
                            <label>Address:</label>
                            <input type="text" name="add" rows="5" cols="50" value="<?php echo $row['Address'] ?>" readonly/>
                            <br>
                            <br>
                            <label>EmailID:</label>
                            <input type="email" name="email" id="emailid" value="<?php echo $row['EmailId'] ?>" readonly>
                            <br><br>
                            <label>Contact No.:</label>
                            <input type="tel" name="contact" maxlength="10" pattern="[6-9][0-9]{9}" value="<?php echo $row['Contact_number'] ?>" readonly>
                            <br><br>
                            <label>Gender:</label>
                            <input type="text" name="gender" value="<?php if ($row['Gender'] == '1') {
                echo "Male";
            } if ($row['Gender'] == '2') {
                echo "Female";
            } if ($row['Gender'] == '0') {
                echo "Others";
            } ?>" readonly>

                            <br><br>
                            <label>Hight:</label>
                            <input type="number" name="hight" id="numloc" value="<?php echo $row['Hight'] ?>" readonly>
                            <label>Weight:</label>
                            <input type="text" name="weight" id="numloc" value="<?php echo $row['Weight'] ?>" readonly>
                            <br><br>
                            <label>Date Of Birth:</label>
                            <input type="date" name="dob" value="<?php echo $row['Birthdate'] ?>" readonly />
                            <br><br>
                            <label>Remark:</label>
                            <input type="text" name="remark" value="<?php echo $row['Remark'] ?>" readonly><br><br>


                            <input type="submit" name="update" value="Update Account" onclick="return validateForm();" style="  background-color: yellowgreen;
                                   color: white;
                                   padding: 14px 20px;
                                   margin: 8px 0;
                                   border: none;
                                   cursor: pointer;
                                   width: 100%;"/>

                            <input type="submit" name="delete" value="Delete my account" style=" background-color: red;
                                   color: white;
                                   padding: 14px 20px;
                                   margin: 8px 0;
                                   border: none;
                                   cursor: pointer;
                                   width: 100%;"/>

                        </div>
                    </form>


                    <?php
                    if (isset($_POST['delete'])) {
                        $query = "update tbl_customer_master set status = 0 where EmailId = '" . $_SESSION['username'] . "'"or die("Error in Query: ");
                        mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
                        unset($_SESSION['username']);
                        session_destroy();
                        echo "done";
                        header("Location:login.php");

                        echo "<script>alert('Your account is deleted ')</script>";
                    } elseif (isset($_POST['update'])) {
                        header("Location:update_profile.php");
                    }
                }
            } else {
                echo "<script>alert('somthing is wrong')</script>";
            }
        }
        ?>
    </body>
</html>
<?php
ob_flush();
?>
