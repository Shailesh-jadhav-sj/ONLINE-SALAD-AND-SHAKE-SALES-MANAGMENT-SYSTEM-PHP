<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {

    if ($_SESSION["username"] != "Admin") {
        header("location:login.php");
    }
} else {
    header("location:login.php");
}
if(isset($_GET['del']))
{
    if($_GET['del']==1)
    {
        echo '<script>alert("packages are used by the customer u cant delete it");</script>';
    }
 else {
         echo '<script>alert("soft delete done customer can not add from now onwerds");</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <style>
            .div1 {
                width: 22%;
                height: 100%;
                border: 3px solid black;
            }
            .modal {
                display: none;/* Hidden by default */
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
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button (x) */
            .close {
                position: absolute;
                right: 50%;
                top: 13%;
                color: #000;
                font-size: 35px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: red;
                cursor: pointer;
            }

            /* Add Zoom Animation */
            .animate {
                -webkit-animation: animatezoom 0.6s;
                animation: animatezoom 0.6s
            }

            @-webkit-keyframes animatezoom {
                from {-webkit-transform: scale(0)} 
                to {-webkit-transform: scale(1)}
            }

            @keyframes animatezoom {
                from {transform: scale(0)} 
                to {transform: scale(1)}
            }

            /* Change styles for span and cancel button on extra small screens */
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }
                .cancelbtn {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <?php
        require './header-footer.php';
        require './dbconnection.php';
        ?>
        <div class="w3-container">
            <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >Packages</h2></center>
            <div class="w3-responsive" style="overflow: scroll; max-height:500px;">
                <table class="w3-table-all">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Package Name</th>
                        <th>Ingredient</th>
                        <th>Days</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $q = "select * from tbl_packagemaster";


                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                    if ($result1->num_rows > 0) {

                        while ($row = $result1->fetch_assoc()) {
                            ?>    
                            <tr>
                                <td><?php echo $row['PackageMaster_ID'] ?></td>

                                <td>
                                    
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" style="width: 100px;"/>
                                        
                                    </a> </td>
                                <td>
                                    <?php echo $row['Package_Name'] ?>
                                                
                                </td>
                                <td>
                                    <?php
                                                   $sq25 = "select Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row['PackageMaster_ID'] . " )";

                                                    $result8 = $connect->query($sq25);
                                                    if ($result8->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row8 = $result8->fetch_assoc()) {
                                                            $i++;
                                                            if ($i == $result8->num_rows) {
                                                                echo $row8['Name'];
                                                            } else {
                                                                echo $row8['Name'] . ",";
                                                            }
                                                        } }
                                                        ?>
                                      
                                   

                                            </td>
                                            <td><?php echo $row['Days'] ?></td>
                                            <td><?php echo $row['Discount'] ?></td>
                                            <td><?php echo $row['Price'] ?></td>
                                            <td><?php echo $row['Description'] ?></td>
                                            <td><?php echo $row['Remark'] ?></td>
                                            
                                            
                                            
                                            
                                            <td style="width: 15%;">
                                                <?php if($row['active']==1)
                                                {?>
                                           <a  href="up.php?dt=<?php echo $row['PackageMaster_ID']?>"><input type="button" value="Update" style="background-color: yellow; color: Black;"/></a>
                                           
                                           <a  href="delete.php?dt=<?php echo $row['PackageMaster_ID']?>"><input type="button" value="Delete" style="background-color: Red; color: white;"/></a>
                                                </td><?php }
 else {?>
     <input type="button" value="InActive" style="background-color: grey; color: white;"/><?php
 }?>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    </table>
                                </div>
                            </div>
<div class="w3-container">
            <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >Food Items</h2></center>
            <div class="w3-responsive" style="overflow: scroll; max-height:500px;">
                <table class="w3-table-all">
                    <tr>
                        <th>Food Id</th>
                        <th>Name</th>
                        
                        <th>Ingredient</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Decrepitation</th>
                        <th>Image</th>
                        <th>Self Life</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php
                    $q = "select * from tbl_foodproductmaster";


                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                    if ($result1->num_rows > 0) {

                        while ($row = $result1->fetch_assoc()) {
                            ?>    
                            <tr>
                                <td><?php echo $row['Food_id'] ?></td>

                               
                                <td>
                                    <?php echo $row['Name'] ?>
                                                
                                </td>
                                <td>
                                    <?php
                                                   $sq25 = "select Name from tbl_ingredientmaster where IngredientMaster_ID IN (select IngredientMaster_ID from tbl_fooddetails where Food_ID=" . $row['Food_id'] . " )";

                                                    $result8 = $connect->query($sq25);
                                                    if ($result8->num_rows > 0) {
                                                        $i = 0;
                                                        while ($row8 = $result8->fetch_assoc()) {
                                                            $i++;
                                                            if ($i == $result8->num_rows) {
                                                                echo $row8['Name'];
                                                            } else {
                                                                echo $row8['Name'] . ",";
                                                            }
                                                        } }
                                                        ?>
                                      
                                   

                                            </td>
                                            <td><?php echo $row['Type'] ?></td>
                                            <td><?php echo $row['Price'] ?></td>
                                            <td><?php echo $row['Decrepitation'] ?></td>
                                            <td>  <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" style="width: 100px;"/>
                                      </td>
                                      <td><?php echo $row['Self_life_days']?></td>
                                            <td><?php echo $row['Remark'] ?></td>
                                            
                                            
                                            
                                            
                                            <td style="width: 15%;">
                                                <?php if($row['active']==1)
                                                {?>
                                           <a  href="uf.php?dt=<?php echo $row['Food_id']?>"><input type="button" value="Update" style="background-color: yellow; color: Black;"/></a>
                                           
                                           <a  href="df.php?dt=<?php echo $row['Food_id']?>"><input type="button" value="Delete" style="background-color: Red; color: white;"/></a>
                                                </td><?php }
 else {?>
     <input type="button" value="InActive" style="background-color: grey; color: white;"/><?php
 }?>
                                           
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                    </div>
                                    </table>
                                </div>
                            </div>
<div class="w3-container">
            <center> <h2 style=" color: white;font-size: 50px;font-style: var; font-family: monospace" >Ingredient</h2></center>
            <div class="w3-responsive" style="overflow: scroll; max-height:500px;">
                <table class="w3-table-all">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        
                        <th>Self Life</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php
                    $q = "select * from tbl_ingredientmaster";


                    $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


                    if ($result1->num_rows > 0) {

                        while ($row = $result1->fetch_assoc()) {
                            ?>    
                            <tr>
                                <td><?php echo $row['IngredientMaster_ID'] ?></td>

                               
                                <td>
                                    <?php echo $row['Name'] ?>
                                                
                                </td>
                                           <td><?php echo $row['Self_life'] ?></td>
                                            
                                            <td><?php echo $row['Remark'] ?></td>
                                            
                                            
                                            
                                            
                                            <td style="width: 15%;">
                                                     <?php if($row['active']==1)
                                                {?>
                                           <a  href="ui.php?dt=<?php echo $row['IngredientMaster_ID']?>"><input type="button" value="Update" style="background-color: yellow; color: Black;"/></a>
                                           
                                           <a  href="di.php?dt=<?php echo $row['IngredientMaster_ID']?>"><input type="button" value="Delete" style="background-color: Red; color: white;"/></a>
                                                </td><?php }
 else {?>
     <input type="button" value="InActive" style="background-color: grey; color: white;"/><?php
 }?>
                                           
                                    
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                    </div>
                                    </table>
                                </div>
                            </div>

                            </body>
                            </html>
