<?php
ob_start();
session_start();
   require './dbconnection.php';

if(isset($_SESSION['insert']))
{
if($_SESSION['insert']==1)
{
            
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
        <title>AddFoodProduct</title>
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
                margin: 0% auto   auto; /* 5% from the top, 15% from the bottom and centered */
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


        </style>
        <script type="text/javascript">
            function validateform()
            {
                 var x = document.forms["myform"]["productname"].value;
                if (x === "")
                {
                    alert("Package Name Must Be Filled Out!!!");
                    myform.productname.focus();
                    return false;
                }
                
                //Product Type
                if(myform.producttype.value == "0")
                {
                    alert("Select Your Product Type!!!");
                    myform.producttype.focus();
                    return false;
                }
                
                //Image
                var fileName = document.forms["myform"]["image"].value;
                var idxDot = fileName.lastIndexOf(".") +1;
                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                if(extFile === "jpg" || extFile === "jpeg" || extFile === "png")
                {
                    //To Do
                }
                else
                {
                    alert("Only jpg/jpeg and png Files Are Allowed!!!");
                    myform.image.focus();
                    return false;
                }
                if(myform.image.value == "")
                {
                    alert("Image File Must Be Filled Out!!!");
                    return false;
                }
                
                //Ingredient
                
                //Price
                var y = document.forms["myform"]["price"].value;
                if(y === "")
                {
                    alert("Price Must Be Filled Out!!!");
                    myform.price.focus();
                    return false;
                }
                
                //Description
                var z =  document.forms["myform"]["desc"].value;
                if(z === "")
                {
                    alert("Description Must Be Filled Out!!!");
                    myform.desc.focus();
                    return false;
                }
            }
            
</script>
    </head>
    <?php
    require 'header-footer.php';
    require './dbconnection.php';
    ?>
    <body style="width: 100%;">
        <div style=" background-image:url('images/s2.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
            <form class="modal-content animate" name="myform" action="#" method="post" enctype="multipart/form-data">
                <div class="container">
                    <center><h1>ADD FOOD PRODUCT</h1></center>
                    <hr style="border: 1px solid seagreen;">
                    <label>Product Name:</label>
                    <input type="text" name="productname" placeholder="Enter Product Name"><br><br>
                    <label>Product Type:</label>
                    <select name="producttype">
                        <option value="0">---Select---</option>    
                        <option value="Salad">Salad</option>
                        <option value="Fresh Juice">Fresh Juice</option>
                        <option value="Shake">Shake</option>
                        <option value="Infused Water">Infused Water</option>
                        <option value="Detox Water">Detox Water</option>
                    </select><br><br>
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*"><br><br>
                    
                    <label>Ingredient:</label>
                    <select name="ingrident[]" multiple>
               <?php                 if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               
               $query1 = "select * from tbl_ingredientmaster where active=1";


            $sql = "select * from tbl_ingredientmaster where active=1";

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                     echo '<option value="'.$row['IngredientMaster_ID'].'">'.$row['Name'].'</option>';
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
            }
            }?>
                       
                    </select><br><br>
                    <label>Price:</label>
                    <input type="text" name="price" pattern="[0-9]+(\\.[0-9][0-9]?)?" placeholder="Foood Price"><br><br>
                   
                    <label>Description:</label>
                    <textarea id="desc" name="desc" rows="5" cols="50" placeholder="Enter Your Description"></textarea><br><br>
                    <label>Remark:</label>
                    <textarea id="remark" name="remark" rows="3" cols="30" placeholder="Enter Your Remark"></textarea>
                </div>
                <input type="submit" name="submit" value="ADD" onclick="return validateform();" style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin-left: 2%;
                       border: none;
                       cursor: pointer;
                       width: 96%;"/>
                <input type="reset" name="reset" value="RESET" style=" background-color: seagreen;
                       color: white;
                       padding: 14px 20px;
                       margin: 8px;
                       margin-left: 2%;
                       border: none;
                       cursor: pointer;
                       width: 96%;"/>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
                        require './dbconnection.php';
            if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               
                 $sql = "select * from tbl_foodproductmaster where Name='".$_POST['productname']."'";

        $result = $connect->query($sql);
echo $result->num_rows;
$_SESSION['nr']=$result->num_rows;
        if ($result->num_rows > 0) {

            echo "<script>alert('FOOD ITEM ALREADY AVALIBLE')</script>";
            
        }
 else {                $image1=addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $day=365;
                foreach ($_POST['ingrident']as $select)
                {
                    $sql="select * from tbl_ingredientmaster where IngredientMaster_ID=".$select or die("Error in Query: ");
                  
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {
                        
                while ($row = $result->fetch_assoc()) {
                   
                   if($day>$row['Self_life'])
                   {
                       $day=$row['Self_life'];
                   }
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
 
                }
                
                $query="insert into tbl_foodproductmaster(Name,Type,Price,Decrepitation,Image,Self_life_days,Remark)values('" . $_POST['productname'] . "','" . $_POST['producttype'] . "','" . $_POST['price'] . "','" . $_POST['desc'] . "','" . $image1 . "','" . $day . "','" . $_POST['remark'] . "')"or die("Error in Query: ");
                $q1="insert into tbl_packagemaster(Package_Name,Days,Discount,Price,Description,Image,Remark)values('" . $_POST['productname'] . "',7,0,'".$_POST['price']. "','" . $_POST['desc'] . "','" . $image1 . "','" . $_POST['remark'] . "')"or die("Error in Query: ");
                 mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              mysqli_query($connect, $q1)or die("error in query:" . mysqli_error($connect));
              
                $sql="select * from tbl_packagemaster where Package_Name='".$_POST['productname']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die(mysqli_error($connect));
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $pid=$row['PackageMaster_ID'];
                   echo $pid;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
            $sql="select * from tbl_foodproductmaster where Name='".$_POST['productname']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die(mysqli_error($connect));
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $pid2=$row['Food_id'];
                   echo $pid2;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
                $q2="insert into tbl_packagedetails(Tbl_PackageMaster_ID,Food_ID)values('" . $pid . "','" . $pid2. "')"or die("Error in Query: ");
                    
                
               mysqli_query($connect, $q2)or die("error in query:" . mysqli_error($connect));
              
              
                $sql="select * from tbl_foodproductmaster where Name='".$_POST['productname']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die("error in query:");
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $foodid=$row['Food_id'];
                   echo $foodid;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
            }
                
                foreach ($_POST['ingrident']as $select)
                {
                    $query="insert into tbl_fooddetails(Food_ID,IngredientMaster_ID)values('" . $foodid . "','" . $select. "')"or die("Error in Query: ");
                    
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
                }
            $_SESSION['insert']=1;
            
            header("Location:addfoodproduct.php");
         
            }}
        }
    ?>
</body>
</html>
