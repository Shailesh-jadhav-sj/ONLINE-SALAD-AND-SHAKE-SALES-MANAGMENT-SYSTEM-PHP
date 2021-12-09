<?php

ob_start();
session_start();

if (isset($_POST['send'])) {
    $otp = $_POST['otp'];
    $otp1 = $_POST['otp1'];
    if ($otp == $otp1) {
        print_r($_POST['name'] . $_POST['add'] . $_POST['email'] . $_POST['contact'] . $_POST['gender'] . $_POST['hight'] . $_POST['weight'] . $_POST['dob'] . $_POST['remark'] . $_POST['password']);

        $image = $_SESSION['photo'];
        unset($_SESSION['photo']);
        session_destroy();
        echo $_POST['gender'];
        $pass=md5($_POST['password']);

        require './dbconnection.php';
        if (mysqli_connect_errno()) {

            echo "error";
        } else {
            //VALUES ('".$_POST['name']."','".$_POST['add']."','".$image."','".$_POST['email']."','".$_POST['contact']."','".$_POST['gender']."','".$_POST['hight']."','".$_POST['weight']."','".$_POST['dob']."','".$_POST['remark']."','".$_POST['password']."')")or die("Error in Query: ");;

            $query = "insert into tbl_customer_master(Name,Address,Photo,EmailId,Contact_number,Gender,Hight,Weight,Birthdate,Password,Remark,status)values('" . $_POST['name'] . "','" . $_POST['add'] . "','" . $image . "','" . $_POST['email'] . "','" . $_POST['contact'] . "','" . $_POST['gender'] . "','" . $_POST['hight'] . "','" . $_POST['weight'] . "','" . $_POST['dob'] . "','" . $pass . "','" . $_POST['remark'] . "',1)"or die("Error in Query: ");
            mysqli_query($connect, $query)or die("error in query:" . mysqli_error($connect));
            echo "done";
            echo "done";
            header("Location:login.php");
            $query1 = "select * from tbl_customer_master where Name='khyati'";


            $sql = "select * from tbl_customer_master where Name='khyati'";

            $result = $connect->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Photo']) . '" />';
                }
            }
        }
    }
    else
    {
         echo "<script>alert('wrong otp new otp will be sent soon')</script>";
         header("location:index_1.php");
         
    }
}
else
{
   echo "<script>alert('new otp will be send to your phone if you registerd')</script>";
   header("location:index_1.php");
}
?>
