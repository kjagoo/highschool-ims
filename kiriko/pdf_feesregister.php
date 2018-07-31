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
	$form=$_GET['form'];
		
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
	$this->Text(60, 35, 'Fees Register Report:- Year '.$year."  ".$term. "  ".$form);
  	
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
function getVoteheadTotals($votehead,$admno,$term,$year){
	$total=0;
	$result = mysql_query("select sum(votehead_amt) as total from finance_feestructures where admno='$admno' and term='$term' and year='$year' and votehead='$votehead'");
	while($row=mysql_fetch_array($result)){
	$total=$row['total'];
	}
	return $total;
}

function getVoteheadSummary($votehead,$term,$year){
	$total=0;
	$result = mysql_query("select sum(votehead_amt) as total from finance_feestructures where term='$term' and year='$year' and votehead='$votehead'");
	while($row=mysql_fetch_array($result)){
	$total=$row['total'];
	}
	return $total;
}
include 'includes/Finance.php';
	$finance= new Financials();

$year=$_GET['year'];
	$term=$_GET['term'];
	$form=$_GET['form'];

$result = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='$year' and term='$term' order by votehead asc");


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
$pdf->setFont("times","","7");
$pdf->setXY(10, 40);
$pdf->Cell(8, 5, "#", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Admno", 1, 0, "L", 1);
		$pdf->Cell(40, 5, "Student Name", 1, 0, "C", 1);
		$heads=array();
		while($row = mysql_fetch_array($result)){ 
	   $pdf->Cell(15, 5, $row['votehead'], 1, 0, "L", 1);
		array_push($heads,$row['votehead']);
		}
		
	
	


$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);
 
	
	

$num=0;
$fill=0;
$totalsum=0;
$getstudents=mysql_query("select * from studentdetails where form='$form' order by admno asc");
	$num=0;
	$totalsum=0;
	while($rowst = mysql_fetch_array($getstudents)){ 
	$num++;
	$pdf->SetFillColor(224,235,255);	
	$pdf->setFont("times","","7");
	$pdf->Cell(8, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(10, 5, $rowst['admno'], 1, 0, "L", $fill);
	$pdf->Cell(40, 5, str_replace('&',"'",$rowst['fname'])." ".str_replace('&',"'",$rowst['lname'])." ".str_replace('&',"'",$rowst['sname']), 1, 0, "L", $fill);
	$resultd = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='$year' and term='$term' order by votehead asc");
	while($rowd = mysql_fetch_array($resultd)){
				
 	$pdf->Cell(15, 5, getVoteheadTotals($rowd['votehead'],$rowst['admno'],$term,$year), 1, 0, "R", $fill);
	}
	
	$y += 5;
	$totalsum+=0;
	$fill=!$fill;
	if ($y > 265)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(10, 40);
		$pdf->Cell(8, 5, "#", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Admno", 1, 0, "L", 1);
		$pdf->Cell(40, 5, "Student Name", 1, 0, "C", 1);
		$heads=array();
		$result = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='$year' and term='$term' order by votehead asc");
		while($row = mysql_fetch_array($result)){ 
	   $pdf->Cell(15, 5, $row['votehead'], 1, 0, "L", 1);
		array_push($heads,$row['votehead']);
		}
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}


  $pdf->Cell(58, 7, "Votehead Summary:", 1, 0, "R", 0);
  $resultd = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='$year' and term='$term' order by votehead asc");
while($rowd = mysql_fetch_array($resultd)){
  $pdf->Cell(15, 7, number_format(getVoteheadSummary($rowd['votehead'],$term,$year),2), 1, 0, "R", 0);
}
	$pdf->Ln();
  $pdf->Output();

?>