<?php
ob_start();
session_start();
   require './dbconnection.php';

if(isset($_SESSION['insert']))
{
if($_SESSION['insert']==1)
{
     echo "<script>alert('Added Succesfully')</script>";
           
        $_SESSION['insert']=0;
}
else
{
    $_SESSION['insert']=0;
}
}

else
{
    $_POST['insert']=0;
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
        <title>AddPackage</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .container {
                padding-bottom:5.3%;

            }
            .modal {
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                padding-top: 0px;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 0% auto auto; /* 5% from the top, 15% from the bottom and centered */
                border: 5px solid seagreen;
                width: 50%; /* Could be more or less, depending on screen size */
            }

            .modal-content label{
                font-weight: bold;
                color: #000000;
            }

            body {font-family: Verdana, sans-serif;}
            img {vertical-align: middle;}

        </style>
        <script type="text/javascript">
            function validateform()
            {
            var fileName = document.forms["myform"]["image"].value;
                var idxDot = fileName.lastIndexOf(".") +1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if(extFile == "jpg" || extFile == "jpeg" || extFile == "png")
                {
                    //To Do
                }
                else
                {
                    alert("Only jpg/jpeg and png Files Are Allowed!!!");
                    return false;
                }
                //Package Name
                var x = document.forms["myform"]["packagename"].value;
                if(x === "")
                {
                    alert("Package Name Must Be Filled Out!!!");
                    myform.packagename.focus();
                    return false;
                }
                //Package Days
                if(myform.packagedays.value=="-1")
                {
                    alert("Select Your Package Days!!!");
                    myform.packagedays.focus();
                    return false;
                }
                
                //Image
                if(myform.image.value == "")
                {
                    alert("Image File Must Be Filled Out!!!");
                    return false;
                }
                
                //Food Items
                
                
                //Discount
                var y = document.forms["myform"]["discount"].value;
                if(y === "")
                {
                    alert("Discount Must Be Filled Out!!!");
                    myform.discount.focus();
                    return false;
                }
                
                //Description
                var z =  document.forms["myform"]["desc"].value;
                if(z === "")
                {
                    alert("Description Must Be Filled Out!!!");
                    myform.desc.focus();
                    return false;
                }}


        </script>
    </head>
    <?php
    include 'header-footer.php';
    ?>
    <body style="width: 100%">
        <div style=" background-image:url('images/s2.jpg'); background-repeat: no-repeat; background-size:100% 100%;">
            <form name="myform" class="modal-content" action="#" onsubmit="return validateform()" method="post"enctype="multipart/form-data">
                <div class="container">
                    
                    <center><h1>ADD PACKAGE</h1></center>
                    <hr style="border: 1px solid seagreen;">
                    <label>Package Name:</label>
                    <input type="text" name="packagename" placeholder="Enter Package Name"><br><br>
                    <label>Package Days:</label>
                    <select name="packagedays" >
                        <option value="0">---Select---</option>    
                        <option value="1">7 Days</option>
                        <option value="2">10 Days</option>
                        <option value="3">15 Days</option>
                        <option value="4">30 Days</option>
                    </select>
                    <br><br>
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*"><br><br>
                    <label>Food Items:</label>
                    <select name="fooditems[]" multiple>                           
                        <?php                 if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               
               $query1 = "select * from tbl_foodproductmaster  where active=1";


            $sql = "select * from tbl_foodproductmaster  where active=1";

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                     echo '<option value="'.$row['Food_id'].'">'.$row['Name']."(P-".$row['Price'].")".'</option>';
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
            }
            }?>
                    </select>
                    <br><br>
                    <label>Discount:</label>
                    <input type="text" name="discount" placeholder="Foood Price"><br><br>
                    <br><br>
                    <label>Description:</label>
                    <textarea id="desc" name="desc"  rows="5" cols="50" placeholder="Enter Your Description"></textarea><br><br>
                    <label>Remark:</label>
                    <textarea id="remark" name="remark" rows="5" cols="50" placeholder="Enter Your Remark"></textarea><br>
                    <br><br>

                    <input type="submit" name="Add" value="ADD" onsubmit="return validateform()" style="  background-color: seagreen;
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
        </div>
        <?php
        if(isset($_POST['Add']))
        {
                        require './dbconnection.php';
            if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               $sql = "select * from tbl_packagemaster where Package_Name='".$_POST['packagename']."'";

        $result = $connect->query($sql);
echo $result->num_rows;
$_SESSION['nr']=$result->num_rows;
        if ($result->num_rows > 0) {

            echo "<script>alert('FOOD ITEM ALREADY AVALIBLE')</script>";
            echo "drop";
            
        }
 else {  
              
            
               $image1=addslashes(file_get_contents($_FILES['image']['tmp_name']));
               $price=0;
                foreach ($_POST['fooditems']as $select)
                {
                    $sql="select * from tbl_foodproductmaster where Food_id=".$select or die("Error in Query: ");
                  
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {
                        
                while ($row = $result->fetch_assoc()) {
                   
                       $price=$price + $row['Price'];
                   }
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
            echo "<script>alert('".$price."')</script>";
                        
            $dprice=($price*$_POST['discount'])/100;
            $aprice=$price-$dprice;
            
            
 
                
                
                $query="insert into tbl_packagemaster(Package_Name,Days,Discount,Price,Description,Image,Remark)values('" . $_POST['packagename'] . "','" . $_POST['packagedays'] . "','" . $_POST['discount'] ."','".$aprice. "','" . $_POST['desc'] . "','" . $image1 . "','" . $_POST['remark'] . "')"or die("Error in Query: ");
                
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
                $sql="select * from tbl_packagemaster where Package_Name='".$_POST['packagename']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die(mysqli_error($connect));
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $pid=$row['PackageMaster_ID'];
                   echo $pid;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
                
                foreach ($_POST['fooditems']as $select)
                {
                    $query="insert into tbl_packagedetails(Tbl_PackageMaster_ID,Food_ID)values('" . $pid . "','" . $select. "')"or die("Error in Query: ");
                    
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
                }
            $_SESSION['insert']=1;
            
            header("Location:addfoodproduct.php");
         
        }}}
        
    ?>
    </body>
</html>