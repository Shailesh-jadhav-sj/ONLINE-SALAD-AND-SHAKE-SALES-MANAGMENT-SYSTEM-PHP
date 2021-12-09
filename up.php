<?php
ob_start();
require './dbconnection.php';
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
if (isset($_GET['dt'])) {?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>update product</title>
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

    <body  style=" background-image:url('images/regb.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
        <?php
        require 'header-footer.php';
        require './dbconnection.php';
        if (mysqli_connect_errno()) {

            echo "error";
        } else {
            $sql = "select * from tbl_packagemaster where PackageMaster_ID='" . $_GET['dt'] . "'";

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
                            <label>Package Name:</label>
                            <input type="text" name="name" value="<?php echo $row['Package_Name'] ?>" ><br><br>
                            <input type="hidden" name="name1" value="<?php echo $row['Package_Name'] ?>" ><br><br>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']) ?>" style="width: 100px;"/>
                <input type="file" name="image" accept="image/*">
                            <br><br>
                            <label>Package Days:</label>
                        <select name="packagedays" >   
                        <option value="7" <?php if($row['Days']=="7") echo 'selected="selected"'; ?>>7 Days</option>
                        <option value="10" <?php if($row['Days']=="10") echo 'selected="selected"'; ?>>10 Days</option>
                        <option value="15" <?php if($row['Days']=="15") echo 'selected="selected"'; ?>>15 Days</option>
                        <option value="30" <?php if($row['Days']=="30") echo 'selected="selected"'; ?>>30 Days</option>
                        </select>
                            
                            <br>
                            <br>
                            <label>Food Item:</label>
                            <select name="fooditems[]" multiple>                           
                        <?php                 if (mysqli_connect_errno())
            {
                echo'Error';
            }
            else
            {
               
               $query1 = "select * from tbl_packagedetails where Tbl_PackageMaster_ID =".$row['PackageMaster_ID'];

              $sql = "select * from tbl_foodproductmaster where active=1";

            $result5 = $connect->query($sql);
            

            if ($result5->num_rows > 0) {

                while ($row1 = $result5->fetch_assoc()) {
?>
                      <option value="<?php echo $row1['Food_id']?>"
                              
                          <?php  $result6=$connect->query($query1) or die('<script>alert("error'. mysqli_error($connect).'")</script>');
            if($result6->num_rows > 0) {

                      while ($row3 = $result6->fetch_assoc()) {
                          if($row1['Food_id']==$row3['Food_ID']){
                              
                         echo 'selected="selected"';  
                              
                          }
                              
                              
                          }
                          
                          }
                          ?>
                         >
                          <?php echo $row1['Name']."(P-".$row1['Price']?></option>
                   
              <?php     // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
            }
            }?>
                    </select>
                    <br><br>
                            <label>Discount:</label>
                            
                            <input type="text" name="discount" placeholder="Foood Price" value="<?php echo $row['Discount']?>">
                    %<br><br>
                    <label>Description:</label>
                    <textarea id="desc" name="desc"  rows="5" cols="50" placeholder="Enter Your Description" ><?php echo $row['Description']?></textarea><br><br>
                    <label>Remark:</label>
                    <textarea id="remark" name="remark" rows="5" cols="50" placeholder="Enter Your Remark"><?php echo $row['Remark']?></textarea><br>
                    <br><br>

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
                $x=0;
                if ($_FILES['image']['size'] != 0)
                {
                   $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
                   $x=1;
                }
                
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
            
            
 
                
                if($x==1)
                {
                $query = "update tbl_packagemaster set Package_Name='" . $_POST['name'] ."', Days='" . $_POST['packagedays'] . "',Discount='" . $_POST['discount'] . "',Price='" . $aprice . "',Description='" . $_POST['desc'] . "',Remark='" .$_POST['remark'] . "' , Image ='".$image."'  where Package_Name = '" . $_POST['name1'] ."'"or die("Error in Query: ");
                }
 else {
     $query = "update tbl_packagemaster set Package_Name='" . $_POST['name'] ."', Days='" . $_POST['packagedays'] . "',Discount='" . $_POST['discount'] . "',Price='" . $aprice . "',Description='" . $_POST['desc'] . "',Remark='" .$_POST['remark'] . "'  where Package_Name = '" . $_POST['name1'] ."'"or die("Error in Query: ");
                
 }
                mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
            
                $sql="select * from tbl_packagemaster where Package_Name='".$_POST['name']."'";
                  echo $sql;
                    $result1 = $connect->query($sql)or die(mysqli_error($connect));
                    if ($result1->num_rows > 0) {
                        
                while ($row = $result1->fetch_assoc()) {
                   
                   $pid=$row['PackageMaster_ID'];
                   echo $pid;
                   
                    
                   // echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
               
           }
                 $query1="DELETE FROM `tbl_packagedetails` WHERE Tbl_PackageMaster_ID=".$pid;
                   mysqli_query($connect, $query1)or die("error in query:" . mysqli_error($connect));
               
                foreach ($_POST['fooditems']as $select)
                {
                    echo $select."<br>";
                    $query="insert into tbl_packagedetails(Tbl_PackageMaster_ID,Food_ID)values('" . $pid . "','" . $select. "')"or die("Error in Query: ");
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


}
else
{
    header("location:update.php");
}
?>