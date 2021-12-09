<?php
ob_start();
session_start();
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
        <title>AddIngredient</title>
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
        <script>
            function validateForm()
            {
                
                //Ingredient Name
                var x = document.forms["myform"]["ingredientname"].value;
                if(x === "")
                {
                    alert("Ingredient Name Must Be Filled Out!!!");
                    myform.ingredientname.focus();
                    return false;
                }
                
                //Life Of Food(Days)
                var y = document.forms["myform"]["lifeoffood"].value;
                if(y === "")
                {
                    alert("Life Of Food(Days) Must Be Filled Out!!!");
                    myform.lifeoffood.focus();
                    return false;
                }
            }
        </script>
    </head>
    <?php
    require 'header-footer.php';
    ?>
    <body>
        <div style=" background-image:url('images/s2.jpg'); background-repeat: no-repeat; background-size:100% 100%;">
            <form name="myform" class="modal-content" action="#" onsubmit="return validateForm()" method="post">
                <div class="container">
                    <center><h1>ADD INGREDIENT</h1></center>
                    <hr style="border: 1px solid seagreen;">
                    <label>Ingredient Name:</label>
                    <input type="text" name="ingredientname" placeholder="Enter Ingredient Name"><br><br>
                    <label>Life Of Food(Days):</label>
                    <input type="number" name="lifeoffood" placeholder="Foood Life"><br><br>
                    <label>Remark:</label>
                    <textarea id="remark" name="remark" rows="3" cols="30" placeholder="Enter Your Remark"></textarea><br><br>

                    <input type="submit" name="submit" value="ADD" onsubmit="return validateForm();" style="  background-color: seagreen;
                           color: white;
                           padding: 14px 20px;
                           margin: 8px 0;
                           border: none;
                           cursor: pointer;
                           width: 100%;"/>

                    <input type="reset" name="reset" value="RESET"  style="  background-color: seagreen;
                           color: white;
                           padding: 14px 20px;
                           margin: 8px 0;
                           border: none;
                           cursor: pointer;
                           width: 100%;"/>
                </div>
        </div>
    </form>
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
                 $sql = "select * from tbl_ingredientmaster where Name='".$_POST['ingredientname']."'";

        $result = $connect->query($sql);
echo $result->num_rows;
$_SESSION['nr']=$result->num_rows;
        if ($result->num_rows > 0) {

            echo "<script>alert('ITEM ALREADY AVALIBLE')</script>";
            
        }
 else {  
               
                $query="insert into tbl_ingredientmaster(Name,Self_life,Remark)values('" . $_POST['ingredientname'] . "','" . $_POST['lifeoffood'] . "','" . $_POST['remark'] . "')"or die("Error in Query: ");
                
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
            $_SESSION['insert']=1;
            
            header("Location:addingredient.php");
            $query1 = "select * from tbl_customer_master where Name='khyati'";


            $sql = "select * from tbl_customer_master where Name='khyati'";

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
            }
            }}
        }
    ?>
</body>
</html>
