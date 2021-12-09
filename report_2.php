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
if (!(isset($_GET['start_date']) && isset($_GET['end_date']))) {
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

$pdf->Line(10, 55, 200, 55);
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
$pdf->SetTextColor(46, 139, 87);
$x = $pdf->GetX();
$pdf->SetXY(140, 20);
$pdf->Cell(5, 30, 'Revenue Report ');
$pdf->Line(142, 40, 195, 40);

        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', 8);
        // Move to the right
        // Title
        $pdf->SetX($x);
        $pdf->SetTextColor(46, 139, 87);
        $pdf->SetX(170);
        $pdf->Cell(0, 50, "FROM: " . $_GET['start_date']);
        $pdf->SetX(174);
        $pdf->Cell(0, 60, "  TO:" . $_GET['end_date']);
        $pdf->SetX(18);
        // $pdf->Cell(0, 40 ,"most sell package is ID =".$row19['Packagemaster_ID']);
    


$q = "SELECT SUM(Price) as 'count' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and  `tbl_subscriptionmaster`.`Start_Date` BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' ORDER BY `Start_Date` DESC";


$result1 = $connect->query($q) or die("Error:" . mysqli_error($connect));


if ($result1->num_rows > 0) {

    while ($row = $result1->fetch_assoc()) {
        $q2 = "SELECT SUM(Price) as 'count2' FROM `tbl_subscriptionmaster` where `tbl_subscriptionmaster`.`Payment_status`=1 and `tbl_subscriptionmaster`.`Start_Date` BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."'";


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
$pdf->SetTextColor(0,0,225);
$x = $pdf->GetX();
$pdf->SetXY(18, 28);
$pdf->Cell(5, 30,$month_m."/- INR");

      
}
 $pdf->AliasNbPages();
        
        $pdf->SetFillColor(46, 139, 87);
        $pdf->SetTextColor(46, 139, 87);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(.5);
        $pdf->SetFont('', 'B',10);

        $pdf->SetXY(20, 57);
        $pdf->Cell(60, 6, 'Package_ID', 1, 0, 'C');
            $pdf->Cell(60, 6, 'Package_Name', 1, 0, 'C');
            $pdf->Cell(60, 6, 'Revenu', 1, 1, 'C');
           $pdf->SetX(20); 

 $q3="select count(*) 'count',Packagemaster_ID from tbl_subscriptiondetails where Subscriptionmaster_ID in( select Subscriptionmaster_ID from tbl_subscriptionmaster where tbl_subscriptionmaster.Payment_status=1 and Start_Date BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."')group by Packagemaster_ID";  
     
$result3 = $connect->query($q3) or die("Error:" . mysqli_error($connect));

if ($result3->num_rows > 0) {

    while ($row3 = $result3->fetch_assoc()) {

     
                
        $q1 = " select Package_Name,Price  from tbl_packagemaster where PackageMaster_ID = " . $row3['Packagemaster_ID'] ;
       
        
        $result11 = $connect->query($q1) or die(mysqli_error($connect));
        if ($result11->num_rows > 0) {
            
            while ($row12= $result11->fetch_assoc()) {
                $name=$row12['Package_Name'];
                $price=$row12['Price'];
                
            }
        } 
                
                $co = $row3['count'];
                $pdf->Cell(60, 6, $row3['Packagemaster_ID'], 1, 0, 'C');
                
               $pdf->Cell(60, 6, $name, 1, 0, 'C');
                $pdf->Cell(60, 6, $row3['count']*$price."  [".$row3['count']." Items Sold]", 1, 1, 'C');
                $pdf->SetX(20); 
            }
        }
        
    
}


$pdf->SetX(140);
 $pdf->Cell(0, 6,$month_m. "/-     Total", 1, 0, 'C');

$pdf->SetFont('Times', '', 12);

$pdf->Output();
$pdf->Output();

?>