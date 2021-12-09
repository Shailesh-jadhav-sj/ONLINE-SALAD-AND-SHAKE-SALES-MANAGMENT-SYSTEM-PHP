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
<?php

require('./fpdf/fpdf/fpdf.php');

class PDF_MC_Table extends FPDF {

    var $widths;
    var $aligns;

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

}

class VariableStream {

    private $varname;
    private $position;

    function stream_open($path, $mode, $options, &$opened_path) {
        $url = parse_url($path);
        $this->varname = $url['host'];
        if (!isset($GLOBALS[$this->varname])) {
            trigger_error('Global variable ' . $this->varname . ' does not exist', E_USER_WARNING);
            return false;
        }
        $this->position = 0;
        return true;
    }

    function stream_read($count) {
        $ret = substr($GLOBALS[$this->varname], $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }

    function stream_eof() {
        return $this->position >= strlen($GLOBALS[$this->varname]);
    }

    function stream_tell() {
        return $this->position;
    }

    function stream_seek($offset, $whence) {
        if ($whence == SEEK_SET) {
            $this->position = $offset;
            return true;
        }
        return false;
    }

    function stream_stat() {
        return array();
    }

}

class PDF extends FPDF {

    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
        // Register var stream protocol
        stream_wrapper_register('var', 'VariableStream');
    }

    function MemImage($data, $x = null, $y = null, $w = 0, $h = 0, $link = '') {
        // Display the image contained in $data
        $v = 'img' . md5($data);
        $GLOBALS[$v] = $data;
        $a = getimagesize('var://' . $v);
        if (!$a)
            $this->Error('Invalid image data');
        $type = substr(strstr($a['mime'], '/'), 1);
        $this->Image('var://' . $v, $x, $y, $w, $h, $type, $link);
        unset($GLOBALS[$v]);
    }

    function GDImage($im, $x = null, $y = null, $w = 0, $h = 0, $link = '') {
        // Display the GD image associated with $im
        ob_start();
        imagepng($im);
        $data = ob_get_clean();
        $this->MemImage($data, $x, $y, $w, $h, $link);
    }

    function SetDash($black = null, $white = null) {
        if ($black !== null)
            $s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        else
            $s = '[] 0 d';
        $this->_out($s);
    }

// Page header
    function Header() {
        // Logo
        $this->Image('images/LOGO_19.png', 10, 6, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Move to the right
        $this->Cell(130);
        // Title
        $this->SetTextColor(46, 139, 87);
        $this->Cell(40, 10, 'Salad & Shake');
        $this->SetFont('Arial', '', 10);
        $this->Ln(1);
        $this->Cell(130);
        $this->Cell(40, 20, 'we guaranteed,your satisfaction');
        // Line break
        $this->Ln(15);
        // Arial 12
        $this->SetFont('Arial', '', 10);
        // Background color
        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(250, 250, 250);
        // Title
        $x = $this->GetX();
        $y = $this->Gety();

        $this->Cell(0, 5, "", 5, 5, 'R', true);
        $this->SetXY($x, $y);
        //$this->Cell(0, 5, $_GET['start_date']."-".$_GET['end_date'], 5, 5, 'L', true);
        // Line break
        $this->Ln(4);
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Instanciation of inherited class
$pdf = new PDF();



require './dbconnection.php';



$pdf->SetTextColor(0, 0, 0);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(46, 139, 87);
$pdf->SetTextColor(46, 139, 87);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(.5);
$pdf->SetFont('', 'B');

$l1 = 55;
$l11 = 55;
$l2 = 55;
$l22 = 55;
$pdf->SetXY(20, 57);
$q = "select * from tbl_packagemaster";
$pdf->SetFont('Arial', 'B', 20);
// Move to the right
$pdf->Cell(130);
// Title
$pdf->SetTextColor(225, 0, 0);
$x = $pdf->GetX();
$pdf->SetXY(140, 20);
$pdf->Cell(5, 40, 'Customer Report ');


$y = $pdf->GetY();
$pdf->SetFont('Arial', 'B', 8);
// Move to the right
// Title
$pdf->SetX($x);
$pdf->SetTextColor(46, 139, 87);
$pdf->SetX(170);
$pdf->SetX(18);
// $pdf->Cell(0, 40 ,"most sell package is ID =".$row19['Packagemaster_ID']);



$q = "SELECT count(*) as 'count' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1  ";



$result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


if ($result1->num_rows > 0) {

    while ($row = $result1->fetch_assoc()) {
        $q2 = "SELECT SUM(Price) as 'count2' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 ";


        $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


        if ($result2->num_rows > 0) {

            while ($row2 = $result2->fetch_assoc()) {
                $total_m = $row2['count2'];
            }
        }
        $month_m = $row['count'];
        if ($month_m == "") {
            $month_m = 0;
        }
        $pdf->SetFont('Arial', 'B', 25);
// Move to the right
// Title
        $pdf->SetTextColor(0, 0, 225);
        $x = $pdf->GetX();
        $pdf->SetXY(18, 30);
        $pdf->Cell(5, 30, $month_m);
        $pdf->SetFont('', 'B', 10);
        $pdf->SetXY(30, 28);
        $pdf->Cell(5, 30, "New subscription started");
        $pdf->SetXY(30, 28);
        $pdf->Cell(10, 40, "By the customers");
    }
    $q2 = "SELECT count(*) as 'count',Customer_id FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1  group by Customer_id order by count desc limit 1 ";



    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {
            $high = $row2['count'];
            $cid = $row2['Customer_id'];
        }
    }
    $q2 = "SELECT Name,Customer_Id FROM tbl_customer_master  where  Customer_Id=" . $cid;



    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {
            $highn = $row2['Name'];
        }
    }
    $q2 = "SELECT count(*) as 'count',Customer_id FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1  group by Customer_id order by count  limit 1 ";



    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {
            $low = $row2['count'];
            $cidl = $row2['Customer_id'];
        }
    }
    $q2 = "SELECT Name,Customer_Id FROM tbl_customer_master  where  Customer_Id=" . $cidl;



    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {
            $lown = $row2['Name'];
        }
    }
    $q3 = "SELECT start_date,Customer_id FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1  group by Customer_id order by start_date limit 1 ";



    $result3 = $connect->query($q3) or die("Error:" . mysqli_error($connect));


    if ($result3->num_rows > 0) {

        while ($row3 = $result3->fetch_assoc()) {
            $dateo = $row3['start_date'];
            $cid3 = $row3['Customer_id'];
        }
    }
    $q2 = "SELECT Name,Customer_Id FROM tbl_customer_master  where  Customer_Id=" . $cid3;



    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


    if ($result2->num_rows > 0) {

        while ($row2 = $result2->fetch_assoc()) {

            $dateon = $row2['Name'];
        }
    }
    $pdf->AliasNbPages();

    $pdf->SetFillColor(46, 139, 87);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(.5);
    $pdf->SetFont('', 'B', 10);

    $pdf->SetXY(20, 57);
    $pdf->Write(20, "~ Customer who purchesd Highest subcription : count ");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(20, " " . $high);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(20, " By");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(20, " " . $highn);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(20, " having customer id =");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(20, " " . $cid);
    $pdf->SetTextColor(0, 0, 0);


    $pdf->SetXY(20, 57);
    $pdf->Write(60, "~ Customer who purchesd lowest subcription : count");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(60, " " . $low);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(60, " By");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(60, " " . $lown);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(60, " having customer id =");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(60, " " . $cidl);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetXY(20, 57);
    $pdf->Write(100, "~ Customer who purchesd first subcription on");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(100, " " . $dateo);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(100, " By");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(100, " " . $dateon);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Write(100, " having customer id =");
    $pdf->SetTextColor(0, 0, 225);
    $pdf->Write(100, " " . $cid);
    $pdf->SetTextColor(0, 0, 0);


    $pdf->SetX(20);

    $s1 = "select * from tbl_customer_master where Customer_Id in (select Customer_id  from tbl_subscriptionmaster where tbl_subscriptionmaster.Payment_status=1 ) group by Customer_id ";


    $result19 = $connect->query($s1)or die(mysqli_error($connect));
    if ($result19->num_rows > 0) {
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        // Move to the right
        // Title

        while ($row19 = $result19->fetch_assoc()) {
            $s20 = "select sum(Price) as 's' from tbl_subscriptionmaster where Customer_Id in (select Customer_id  from tbl_subscriptionmaster where tbl_subscriptionmaster.Payment_status=1  and Customer_id=" . $row19['Customer_Id'] . " ) group by Customer_id ";


            $result20 = $connect->query($s20)or die(mysqli_error($connect));
            if ($result20->num_rows > 0) {

                while ($row20 = $result20->fetch_assoc()) {
                    $sumc = $row20['s'];
                }
            }
                       $query1 = " select * from tbl_subscriptionmaster where Customer_id =".$row19['Customer_Id']."and Payment_status=1";

            $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,tbl_packagemaster.Image,tbl_packagemaster.PackageMaster_ID,tbl_packagemaster.Discount,tbl_packagemaster.Package_Name,`tbl_subscriptionmaster`.`Start_Date`,`tbl_packagemaster`.`Price`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_packagemaster`.`Days` from tbl_subscriptiondetails,tbl_subscriptionmaster,tbl_packagemaster,tbl_customer_master where `tbl_customer_master`.`Customer_Id` =".$row19['Customer_Id']." and `tbl_subscriptionmaster`.`Payment_status`=1 and `tbl_subscriptionmaster`.`Customer_id`=`tbl_customer_master`.`Customer_Id` and `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptiondetails`.`Packagemaster_ID`=`tbl_packagemaster`.`PackageMaster_ID`";



            $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


            if ($result1->num_rows > 0) {
                $up = 0;
                $cmp = 0;
                $on=0;
                while ($row = $result1->fetch_assoc()) {
                    
         

                 

                    

                    $currentDate = new DateTime();
                    $cd = date_format($currentDate, "Y/m/d");
                    $ref = new DateTime($row['Start_Date']);

                    $rd = date_format($ref, "Y/m/d");
                    $diff = $currentDate->diff($ref);
                    if ($row['Payment_status'] == 0) {
                       // echo "Not yet Started";
                    } else if ($cd < $rd) {
                       // echo "will be Start on :";
                      //  print_r($rd);
                        $up=$up+1;
                    } else if ($diff->days < $row['Days']) {
                        $on=$on+1;
                       // echo $diff->days . "on going";
                    } else {
                       // echo "Completed";
                        $cmp=$cmp+1;
                    }

                   // echo $row['Package_Name'];
                    $pdf->SetX(18);
                }
            }
 
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFillColor(46, 139, 87);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(.5);
            $pdf->SetFont('', 'B');

            $pdf->Line(20, 60, 190, 60);
            $l1 = 55;
            $l11 = 55;
            $l2 = 55;
            $l22 = 55;
            $pdf->SetXY(20, 30);

            $pdf->SetFont('', 'B', 18);
            $pdf->Cell(4, 10, $row19['Customer_Id']);

            $image_data = $row19['Photo'];
            $pdf->SetFont('', 'B', 10);
            $pdf->SetXY(30, 32);
            $pdf->Cell(60, -20, $pdf->MemImage($image_data, $pdf->GetX(), $pdf->GetY(), 25, 25));
            $x = $pdf->GetX();
            $y = $pdf->Gety();
            $pdf->SetXY(55, $y - 12);

            $pdf->Cell(20, 30, "Name : " . $row19['Name']);

            $pdf->SetXY(55, 25 );
            $pdf->MultiCell($x + 30, 30, "Mobile : " . $row19['Contact_number']);
            $pdf->SetXY(55, $y);
            $pdf->Cell(10, 25, "Email : " . $row19['EmailId']);
            $pdf->SetXY(125, $y);
            $pdf->MultiCell(60, 5, "Address: " . $row19['Address']);
            $pdf->SetXY(125, $y + 20);
            $pdf->SetTextColor(225,0,0);
            $pdf->MultiCell(60, 0, "Total Purches: " . $sumc);
            $pdf->SetXY(55, $y + 18);
            $pdf->SetTextColor(0, 0, 225);
            $pdf->MultiCell(60, 0, "Upcoming sub: " . $up);
            $pdf->SetXY(55, $y + 24);
            $pdf->SetTextColor(0, 0, 225);
            $pdf->MultiCell(60, 0, "On going sub: " . $on);
            $pdf->SetXY(125, $y + 13);
            $pdf->SetTextColor(0, 0, 225);
            $pdf->MultiCell(60, 0, "Completed sub: " . $cmp);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('', 'B');
            $pdf->SetXY(18, 62);
            $pdf->Cell(10, 6, 'SID', 1, 0, 'C');
            $pdf->Cell(40, 6, 'Package Name', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Start', 1, 0, 'C');
            $pdf->Cell(25, 6, 'price', 1, 0, 'C');
            $pdf->Cell(25, 6, 'Total days', 1, 0, 'C');
            $pdf->Cell(50, 6, 'Transaction ID', 1, 1, 'C');
            $pdf->SetX(18);
            $pdf->SetTextColor(0, 0, 0);


            $query1 = " select * from tbl_subscriptionmaster where Customer_id =".$row19['Customer_Id']."and Payment_status=1";

            $q = "select tbl_subscriptionmaster.SubscriptionMaster_ID,tbl_packagemaster.Image,tbl_packagemaster.PackageMaster_ID,tbl_packagemaster.Discount,tbl_packagemaster.Package_Name,`tbl_subscriptionmaster`.`Start_Date`,`tbl_packagemaster`.`Price`,`tbl_subscriptionmaster`.`Payment_status`,`tbl_subscriptionmaster`.`t_id`,`tbl_subscriptionmaster`.`Suggestion`,`tbl_packagemaster`.`Days` from tbl_subscriptiondetails,tbl_subscriptionmaster,tbl_packagemaster,tbl_customer_master where `tbl_customer_master`.`Customer_Id` =".$row19['Customer_Id']." and `tbl_subscriptionmaster`.`Payment_status`=1 and `tbl_subscriptionmaster`.`Customer_id`=`tbl_customer_master`.`Customer_Id` and `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptiondetails`.`Packagemaster_ID`=`tbl_packagemaster`.`PackageMaster_ID`";



            $result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


            if ($result1->num_rows > 0) {
                $r = 0;
                $r1 = 0;
                while ($row = $result1->fetch_assoc()) {
                    
         

                    if ($r != $row['SubscriptionMaster_ID']) {
                        $pdf->Cell(10, 6, $row['SubscriptionMaster_ID'], 1, 0, 'C');
                        $r = $row['SubscriptionMaster_ID'];
                    } else {
                         $pdf->Cell(10, 6, " ", 1, 0, 'C');
                       
                        $r = $row['SubscriptionMaster_ID'];
                    }
                   
                    
        $pdf->Cell(40, 6, $row['Package_Name'], 1, 0, 'C');
        $pdf->Cell(25, 6, $row['Start_Date'], 1, 0, 'C');
        $pdf->Cell(25, 6, $row['Price'], 1, 0, 'C'); 
        $pdf->Cell(25, 6, $row['Days'], 1, 0, 'C');
        if($row['t_id']=="")
        {
            $pdf->Cell(50, 6,"Ofline payment", 1, 1, 'C');
        }
        else
        {
         $pdf->Cell(50, 6, $row['t_id'], 1, 1, 'C');
        }       
        

                    $q2 = "select Price from tbl_subscriptionmaster where SubscriptionMaster_ID = " . $row['SubscriptionMaster_ID'];
                    


                    $result2 = $connect->query($q2) or die("Error:" . mysqli_error($connect));


                   


                   

                    

                    $currentDate = new DateTime();
                    $cd = date_format($currentDate, "Y/m/d");
                    $ref = new DateTime($row['Start_Date']);

                    $rd = date_format($ref, "Y/m/d");
                    $diff = $currentDate->diff($ref);
                    if ($row['Payment_status'] == 0) {
                       // echo "Not yet Started";
                    } else if ($cd < $rd) {
                       // echo "will be Start on :";
                      //  print_r($rd);
                    } else if ($diff->days < $row['Days']) {

                       // echo $diff->days . "on going";
                    } else {
                       // echo "Completed";
                    }

                   // echo $row['Package_Name'];
                    $pdf->SetX(18);
                }
            }
        }
    }
}
$pdf->SetX(140);

$pdf->SetFont('Times', '', 12);

$pdf->Output();
$pdf->Output();
?>