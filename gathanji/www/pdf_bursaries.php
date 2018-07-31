<?php

require('fpdf.php');
include('includes/dbconnector.php');

class PeoplePDF extends FPDF {

//Page header
function Header(){
		$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
		$schoolname=$de['schname'];
		$address=$de['box']." , ".$de['place'];
		//$logref=$de['logref'];
		$tele=$de['telphone'];
		$email=$de['email'];
		$web=$de['website'];
	}
	
	//if(!file_exists("images/".$logref)){
 		 $logo="images/logo.JPG";
  		//}else{
 			//$logo = "images/".$logref;
 	// }
	 
	$year=$_GET['year'];
	$term=$_GET['term'];
		
	  $date=date("Y-m-d H:i:s");
		 $y=date("Y");
		 $m=date("m");
		 $d=date("d");
		 $hr=date("H");
		 $min=date("i");
		$sec=date("s");
		$hcodes=$y.$m.$d.$hr;
			$mins=$min.$sec;
	
			$hcode=$hcodes.$mins;
		//$hcode=$_GET['hbar'];
 		 $barcode="images/barcode.PNG";
		 
	$this->SetFont('times', '', 9);
	$this->Image($logo,20,10,20,20);
	$this->Image($barcode,160,10,0,0);
	$this->Text(161, 25, $hcode);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->Text(60, 35, 'Bursaries Report:- Term'.$term."  Year ".$year);
	
    $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
}
	
}

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black

 
 
//table header
		$pdf->SetFillColor(205,201,201);
		$pdf->setFont("times","","10");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
		$pdf->Cell(30, 5, "Cheque #", 1, 0, "L", 1);
		$pdf->Cell(50, 5, "From", 1, 0, "L", 1);
		$pdf->Cell(30, 5, "Bank Deposited", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Covered Students", 1, 0, "C", 1);
		$pdf->Cell(25, 5, "Amount", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 

	$term=$_GET['term'];
	$year=$_GET['year'];
	
$sql = "SELECT b.*, 
(SELECT COUNT(ba.admno) FROM bursaries_allocations ba WHERE ba.cheque_no = b.cheque_no AND b.term='$term' AND b.year='$year') AS totalcovered 
FROM bursaries b  WHERE b.term='$term' AND b.year='$year' GROUP BY b.cheque_no";

	
$result = mysql_query($sql);
$num=0;
$fill=0;
$totalitems=0;
$studs=0;
while($row = mysql_fetch_array($result)){
$num++;
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(30, 5, $row['cheque_no'],  1, 0, "L", $fill);
	$pdf->Cell(50, 5, str_replace("&","'",$row['cheque_from']), 1, 0, "L", $fill);
	$pdf->Cell(30, 5, $row['account_no'], 1, 0, "L", $fill);
	$pdf->Cell(30, 5, $row['totalcovered'], 1, 0, "R", $fill);
	$pdf->Cell(25, 5, number_format($row['amount'],2), 1, 0, "R", $fill);
	
	$totalitems+=$row['amount'];
	$studs+=$row['totalcovered'];
	$y += 5;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(205,201,201);
		$pdf->setFont("times","","11");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
		$pdf->Cell(30, 5, "Cheque #", 1, 0, "L", 1);
		$pdf->Cell(50, 5, "From", 1, 0, "L", 1);
		$pdf->Cell(30, 5, "Bank Deposited", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Covered Students", 1, 0, "C", 1);
		$pdf->Cell(25, 5, "Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
 $pdf->setX(110);
 $pdf->Cell(30, 5, "Summary:", 1, 0, "R", 0);
 $pdf->Cell(30, 5,$studs, 1, 0, "R", 0);
 $pdf->Cell(25, 5, number_format($totalitems,2), 1, 0, "R", 0);
 $pdf->Ln(10);
 
$pdf->Output();

?>