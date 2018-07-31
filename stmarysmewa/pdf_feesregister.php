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
	$votehead=$_GET['votehead'];
		
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
		 
	$this->SetFont('arial', '', 10);
	$this->Image($logo,20,10,20,20);
	$this->Image($barcode,150,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(151, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 9);
	$this->Text(60, 35, 'Fees Register Report:- Year '.$year."  ".$term. "  VOTEHEAD:- ".$votehead);
  	
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
include 'includes/Finance.php';
	$finance= new Financials();

$year=$_GET['year'];
	$term=$_GET['term'];
	$votehead=$_GET['votehead'];


$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","9");
$pdf->setXY(25, 40);
$pdf->Cell(8, 5, "#", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Admno", 1, 0, "C", 1);
		$pdf->Cell(50, 5, "Receipt No", 1, 0, "C", 1);
		$pdf->Cell(50, 5, "Amount", 1, 0, "C", 1);
	
	


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);
 
	
	
	$resultreg = mysql_query("select * from feeregisterreport_".$year."_".str_replace(" ","_",$term)." where year='$year' and term='$term' order by receipt_no asc");

$num=0;
$fill=0;
$totalsum=0;
	while($rowreg = mysql_fetch_array($resultreg)){ 
			$num++;
		$pdf->SetFillColor(224,235,255);	
	$pdf->setFont("times","","8");
	$pdf->Cell(8, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(30, 5, $rowreg['admno'], 1, 0, "L", $fill);
	$pdf->Cell(50, 5, $rowreg['receipt_no'], 1, 0, "L", $fill);
 	$pdf->Cell(50, 5, number_format($rowreg[$votehead],2), 1, 0, "R", $fill);
	
	
	$y += 5;
	$totalsum+=$rowreg[$votehead];
	$fill=!$fill;
	if ($y > 265)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(25, 40);
		$pdf->Cell(8, 5, "#", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Admno", 1, 0, "C", 1);
		$pdf->Cell(50, 5, "Receipt No", 1, 0, "C", 1);
		$pdf->Cell(50, 5, "Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}


  $pdf->Cell(88, 7, "Votehead Summary:", 1, 0, "R", 0);
  $pdf->Cell(50, 7, number_format($finance->getVoteheadTotals($year,$term,$votehead),2), 1, 0, "R", 0);
	$pdf->Ln();
  $pdf->Output();

?>