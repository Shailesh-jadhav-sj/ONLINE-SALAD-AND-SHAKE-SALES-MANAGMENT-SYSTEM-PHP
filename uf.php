<?php
ob_start();
session_start();
require './dbconnection.php';

if (isset($_SESSION['insert'])) {
    if ($_SESSION['insert'] == 1) {
        echo "<script>alert('Added Succesfully')</script>";

        $_SESSION['insert'] = 0;
    } else {
        $_SESSION['insert'] = 0;
    }
} else {
    $_POST['insert'] = 0;
}
if (isset($_GET['dt'])) {
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
                 var x = document.forms["myform"]["name"].value;
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
    if (mysqli_connect_errno()) {

        echo "error";
    } else {
        $sql = "select * from tbl_foodproductmaster where Food_id='" . $_GET['dt'] . "'";

        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            //header("Location:index.php");
            while ($row = $result->fetch_assoc()) {
                ?>

                    <body style="width: 100%;">
                        <div style=" background-image:url('images/s2.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
                            <form class="modal-content animate" action="#" method="post" enctype="multipart/form-data">
                                <div class="container">
                                    <center><h1>Update FOOD PRODUCT</h1></center>
                                    <hr style="border: 1px solid seagreen;">
                                    <label>Product Name:</label>
                                    <input type="text" name="name" value="<?php echo $row['Name'] ?>"><br><br>
                                     <input type="hidden" name="name1" value="<?php echo $row['Name'] ?>"><br><br>
                                   
                                    <label>Product Type:</label>
                                    <select name="producttype">
                                        <option value="0">---Select---</option>    
                                        <option value="Salad" <?php if($row['Type']=="Salad") echo 'selected="selected"'; ?>>Salad</option>
                                        <option value="Fresh Juice" <?php if($row['Type']=="Fresh Juice") echo 'selected="selected"'; ?>>Fresh Juice</option>
                                        <option value="Shake" <?php if($row['Type']=="Shake") echo 'selected="selected"'; ?>>Shake</option>
                                        <option value="Infused Water" <?php if($row['Type']=="Infused Water") echo 'selected="selected"'; ?>>Infused Water</option>
                                        <option value="Detox Water" <?php if($row['Type']=="Detox Water") echo 'selected="selected"'; ?>>Detox Water</option>
                                    </select><br><br>
                                    <label>Image:</label>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" style="width: 100px;"/>
                                    <input type="file" name="image" accept="image/*"><br><br>

                                    <label>Ingredient:</label>
                                    <select name="ingrident[]" multiple>
                <?php
                if (mysqli_connect_errno()) {
                    echo'Error';
                } else {

                    $query1 = "select * from tbl_fooddetails WHERE Food_ID=".$row['Food_id'];


                    $sql = "select * from tbl_ingredientmaster";

                    $result = $connect->query($sql);
                    

                    if ($result->num_rows > 0) {

                        while ($row1 = $result->fetch_assoc()) {?>
                            <option value="<?php echo $row1['IngredientMaster_ID']?>"
                              
                          <?php  $result6=$connect->query($query1) or die('<script>alert("error'. mysqli_error($connect).'")</script>');
            if($result6->num_rows > 0) {

                      while ($row3 = $result6->fetch_assoc()) {
                          if($row1['IngredientMaster_ID']==$row3['IngredientMaster_ID']){
                              
                         echo 'selected="selected"';  
                              
                          }
                              
                              
                          }
                          
                          }
                          ?>
                         >
                          <?php echo $row1['Name']?></option>
                            <?php
                        }
                }}
                
                ?>

                                    </select><br><br>
                                    <label>Price:</label>
                                    <input type="text" name="price" value="<?php echo $row['Price']?>"><br><br>

                                    <label>Description:</label>
                                    <textarea id="desc" name="desc" rows="5" cols="50" placeholder="Enter Your Description"><?php echo $row['Decrepitation']?></textarea><br><br>
                                    <label>Remark:</label>
                                    <textarea id="remark" name="remark" rows="3" cols="30" placeholder="Enter Your Remark"><?php echo $row['Remark']?></textarea>
                                </div>
                                <input type="submit" name="update" value="Update"onclick="return validateform();" style=" background-color: seagreen;
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
                <?php }} ?>
                        </div>
                    </div>
                <?php
                        if(isset($_POST['update']))
        {
            
                echo "<script>alert('called ')</script>";
                $x=0;
                if ($_FILES['image']['size'] != 0)
                {
                   $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
                   $x=1;
                }
                if($x==1)
                {
                $query = "update tbl_foodproductmaster set Name='" . $_POST['name'] ."', Type='" . $_POST['producttype'] .  "',Price='" . $_POST['price'] . "',Decrepitation='" . $_POST['desc'] . "',Remark='" .$_POST['remark'] . "' , Image ='".$image."'  where Name = '" . $_POST['name1'] ."'"or die("Error in Query: ");
                }
 else {
                $query = "update tbl_foodproductmaster set Name='" . $_POST['name'] ."', Type='" . $_POST['producttype'] .  "',Price='" . $_POST['price'] . "',Decrepitation='" . $_POST['desc'] . "',Remark='" .$_POST['remark'] . "'  where Name = '" . $_POST['name1'] ."'"or die("Error in Query: ");         
 }
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
            
                $sql="select * from tbl_foodproductmaster where Name='".$_POST['name']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die(mysqli_error($connect));
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $pid=$row['Food_id'];
                   echo $pid;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
           }
                 $query1="DELETE FROM tbl_fooddetails WHERE IngredientMaster_ID=".$pid;
                   mysqli_query($connect, $query1)or die("error in query:" . mysqli_error($connect));
               
                foreach ($_POST['ingrident']as $select)
                {
                    echo $select."<br>";
                    $query="insert into tbl_fooddetails(Food_ID,IngredientMaster_ID)values('" . $pid . "','" . $select. "')"or die("Error in Query: ");
                    mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
              
                }
                
            echo "done";
            echo $x;
           header("Location:update.php");
        }
        
?>
    </body>
</html>
<?php
ob_flush();


}}
else
{
    header("location:update.php");
}