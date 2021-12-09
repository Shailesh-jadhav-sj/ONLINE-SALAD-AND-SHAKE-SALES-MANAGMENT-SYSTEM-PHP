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
        <title>Admin</title>
<script type="text/javascript">
 function d()
                    {
                        
                        var GivenDatest = document.getElementById("start_date").value;
                        var GivenDateed = document.getElementById("end_date").value;
                        
                       var GivenDatest = new Date(GivenDatest);
                        
                       var GivenDateed = new Date(GivenDateed);

                        if (GivenDateed > GivenDatest ) {
                            return true;
                        } else {
                            alert('end date is not greater than start date.');
                            return false;
                        }
                    }

</script>

    </head>
    <body style="background-color: seagreen;">
        <?php
        require './header-footer.php';
        require './dbconnection.php';
        ?>
        <form action="report_1.php" method="get">       
<table border="0" cellpadding="0" cellspacing="0">
    <br>
    <br>
    <br>
    <br>
    
<tr>
    <td>
        From:
    </td>
    <td>
        <input type="date" name="start_date" id="start_date" id="txtFrom" required="true" />
    </td>
    <td>
        &nbsp;
    </td>
    <td>
        To:
    </td>
    <td>
        <input type="date" name="end_date" id="end_date" id="txtTo" required="true"/>
    </td>
</tr>
</table>
            <input type="submit" value="view report" onclick="return d();">
            </form>

    </body>
</html>
