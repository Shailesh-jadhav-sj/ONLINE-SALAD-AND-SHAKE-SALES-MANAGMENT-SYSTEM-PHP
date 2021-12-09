<?php
ob_start();
session_start();
require './dbconnection.php';

if (isset($_SESSION['insert'])) {
    if ($_SESSION['insert'] == 1) {

        $_SESSION['insert'] = 0;
    } else {
        $_SESSION['insert'] = 0;
    }
} else {
    $_POST['insert'] = 0;
}
if (isset($_GET['dt'])) {
    ?>
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
    require './dbconnection.php';
    if (mysqli_connect_errno()) {

        echo "error";
    } else {
        $sql = "select * from `tbl_ingredientmaster` where IngredientMaster_ID='" . $_GET['dt'] . "'";

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            //header("Location:index.php");
            while ($row = $result->fetch_assoc()) {
                ?>
    <body>
        <div style=" background-image:url('images/s2.jpg'); background-repeat: no-repeat; background-size:100% 100%;">
            <form name="myform" class="modal-content" action="#" onsubmit="return validateForm()" method="post">
                <div class="container">
                    <center><h1>Update INGREDIENT</h1></center>
                    <hr style="border: 1px solid seagreen;">
                    <label>Ingredient Name:</label>
                    <input type="text" name="ingredientname" value="<?php echo $row['Name'] ?>"><br><br>
                    <input type="hidden" name="IngredientMaster_ID" value="<?php echo $_GET['dt'];?>"
                    <label>Life Of Food(Days):</label>
                    <input type="number" name="lifeoffood" value="<?php echo $row['Self_life'] ?>"><br><br>
                    <label>Remark:</label>
                    <textarea id="remark" name="remark" rows="3" cols="30" placeholder="Enter Your Remark"><?php echo $row['Remark'] ?></textarea><br><br>

                    <input type="submit" name="update" value="update" onsubmit="return validateForm();" style="  background-color: seagreen;
                           color: white;
                           padding: 14px 20px;
                           margin: 8px 0;
                           border: none;
                           cursor: pointer;
                           width: 100%;"/>

                    <input type="reset" name="reset" value="RESET" onsubmit="return validateForm()" style="  background-color: seagreen;
                           color: white;
                           padding: 14px 20px;
                           margin: 8px 0;
                           border: none;
                           cursor: pointer;
                           width: 100%;"/>
                </div>
                    </form>

        </div>
    </body>
    <?php
    }}}
    ?>
</html>
<?php

}
 if(isset($_POST['update']))
        {
                        require './dbconnection.php';
            if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               
                $query="update tbl_ingredientmaster set Name='" . $_POST['ingredientname'] . "',Self_life='" . $_POST['lifeoffood'] . "',Remark='" . $_POST['remark'] . "' where IngredientMaster_ID='" . $_POST['IngredientMaster_ID'] . "'"or die("Error in Query: ");
                
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
          
            
        header("Location:update.php");}}
?>