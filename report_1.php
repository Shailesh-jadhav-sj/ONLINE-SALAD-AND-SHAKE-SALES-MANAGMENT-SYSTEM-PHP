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
if(!(isset($_GET['start_date'])&&isset($_GET['end_date'])))
{
   header("location:RD1.php"); 
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
        $x=$this->GetX();
        $y=$this->Gety();
        
        $this->Cell(0, 5, "PACKAGE REPORT =".$_GET['start_date']."/".$_GET['end_date'] , 5, 5, 'R', true);
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

$l1=55;
$l11=55;
$l2=55;
$l22=55;
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
 $s1="select count(*) as 'Max',Packagemaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID in( select Subscriptionmaster_ID from `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and Start_Date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."')group by Packagemaster_ID order by Max desc limit 1";
     
 $result19 = $connect->query($s1)or die(mysqli_error($connect));
        if ($result19->num_rows > 0) {
            
        while ($row19 = $result19->fetch_assoc()) {
        $y=$pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        // Move to the right
        
        // Title
        $pdf->SetX($x);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(165);
        $pdf->Cell(45,53 ,"From :".$_GET['start_date'].",");
        $pdf->SetX(170);
        $pdf->Cell(180, 62 ,"To:".$_GET['end_date']);
        $pdf->SetX(18);
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 225);
        $pdf->Cell(0, 120 ,"~most sell package's  ID number =".$row19['Packagemaster_ID']);
        
        }}
        $s1="select PackageMaster_ID from tbl_packagemaster where PackageMaster_ID not in (select Packagemaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID in( select Subscriptionmaster_ID from tbl_subscriptionmaster where tbl_subscriptionmaster.Payment_status=1 and Start_Date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."')group by Packagemaster_ID )";
      
     
 $result19 = $connect->query($s1)or die(mysqli_error($connect));
        if ($result19->num_rows > 0) {
        $y=$pdf->GetY();
        $pdf->SetFont('Arial', 'B', 12);
        // Move to the right
        
        // Title
        $pdf->SetX($x);
        $pdf->SetTextColor(0, 0, 225);
        $pdf->SetX(18);    
        $pdf->Cell(0, 160 ,"~Zero sell packages is ID number =");
        $t=0;
        $pdf->SetX(90);
        while ($row19 = $result19->fetch_assoc()) {
        $t=$t+1;
        $pdf->Cell(10, 160 ,$row19['PackageMaster_ID'].",");
        
        }}
       
        
$result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


$c=1;
if ($result1->num_rows > 0) {
    
    while ($row = $result1->fetch_assoc()) {
        
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(46, 139, 87);
$pdf->SetTextColor(46, 139, 87);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(.5);
$pdf->SetFont('', 'b',12);

$pdf->Line(20, 90, 190, 90);
$l1=55;
$l11=55;
$l2=55;
$l22=55;
$pdf->SetXY(20, 57);
        $c=$c+1;
        $s="select count(*) as 'count' from tbl_subscriptiondetails where Packagemaster_ID=".$row['PackageMaster_ID']." and Subscriptionmaster_ID in( select Subscriptionmaster_ID from `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and Start_Date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."')";
        $result9 = $connect->query($s);
        if ($result9->num_rows > 0) {
            
        while ($row9 = $result9->fetch_assoc()) {
            $co=$row9['count'];
        }}
        $sq25 = "select Name from tbl_foodproductmaster where Food_id IN (select Food_ID from tbl_packagedetails where Tbl_PackageMaster_ID=" . $row['PackageMaster_ID'] . " )";

        $result8 = $connect->query($sq25);
        if ($result8->num_rows > 0) {
            $i = 0;
            $p = "";
            while ($row8 = $result8->fetch_assoc()) {
                $i++;
                if ($i == $result8->num_rows) {
                    $p = $p . $row8['Name'];
                } else {
                    $p = $p . $row8['Name'] . ",";
                }
            }
        }
        


        $image_data = $row['Image'];
       
        $y=$pdf->GetY();
        $pdf->Cell(65, -40 ,$row['PackageMaster_ID']);
        $pdf->SetXY(25,35);
        $pdf->Cell(50, -40, $pdf->MemImage($image_data, $pdf->GetX(), $pdf->GetY(), 50, 50));
        $x=$pdf->GetX();
        $y=$pdf->Gety();
        $pdf->SetXY(75, $y-10);
        $pdf->Cell(30, 30, "Name : " .$row['Package_Name']);
        
        $pdf->SetXY(75, $y);
        $pdf->MultiCell($x+30, 30, "Food : " . $p);
        
        $pdf->SetXY(75, $y+10);
        $pdf->Cell(10, 30,"Days : ". $row['Days']);
        
        $pdf->SetXY(75, $y+20);
        $pdf->Cell(20, 30,"Discount : ". $row['Discount']."%");
        
        $pdf->SetXY(75, $y+30);
        $pdf->Cell(20, 30, "Price: ".$row['Price']);
        
        $pdf->SetXY(130, $y);
        $pdf->MultiCell(70,5, "Description: ".$row['Description']);
        
        $pdf->SetXY(130, $y+30);
        $pdf->MultiCell(40,5, "Total Purchesd: ".$co);
        $pdf->SetTextColor(225,0,0);
        
        $pdf->SetXY(130, $y+40);
        $pdf->MultiCell(60,5, "Total Revenue: ".$co*$row['Price']." /-");
        $pdf->Ln(5);
        $pdf->SetXY(18, $y+60);
        $pdf->SetXY(18, $y+60);
        $pdf->SetTextColor(46, 139, 87);
      $q1=" select tbl_subscriptionmaster.SubscriptionMaster_ID,`tbl_subscriptionmaster`.`Start_Date`,`tbl_customer_master`.Name,`tbl_subscriptionmaster`.`Payment_status` from tbl_subscriptiondetails,tbl_subscriptionmaster,tbl_packagemaster,tbl_customer_master where `tbl_subscriptionmaster`.`Payment_status`=1 and  `tbl_subscriptiondetails`.`Packagemaster_ID`=". $row['PackageMaster_ID']." and `tbl_subscriptionmaster`.`Customer_id`=`tbl_customer_master`.`Customer_Id` and `tbl_subscriptionmaster`.`SubscriptionMaster_ID`=`tbl_subscriptiondetails`.`Subscriptionmaster_ID` and `tbl_subscriptiondetails`.`Packagemaster_ID`=`tbl_packagemaster`.`PackageMaster_ID` and `tbl_subscriptionmaster`.`Start_Date` BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."'";
      $result11 = $connect->query($q1) or die (mysqli_error($connect));
        if ($result11->num_rows > 0) {
       $pdf->SetFont('Arial', 'B', 12);
        /* Heading Of the table */
        $pdf->Cell(60, 6, 'Subscription_ID', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Customer_Name', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Start_Date', 1, 1, 'C');
        $pdf->SetX(18);
$pdf->SetTextColor(0,0,0);
        while ($row11= $result11->fetch_assoc()) {
            $pdf->Cell(60, 6, $row11['SubscriptionMaster_ID'], 1, 0, 'C');
        $pdf->Cell(60, 6, $row11['Name'], 1, 0, 'C');
        $pdf->Cell(60, 6, $row11['Start_Date'], 1, 1, 'C');
        $pdf->SetX(18);
        }} 
        else
        {
             $pdf->Cell(180, 6, 'No DATA to Show', 1, 0, 'C');
        }
      $y=0;
$pdf->SetXY($l1-35,$y);

    }
}



$pdf->Output();
$pdf->Output();
?>