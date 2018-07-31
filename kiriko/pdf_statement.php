<?php

require('fpdf.php');
include('includes/dbconnector.php');
 include 'includes/fees.php';


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
	
	$admno=$_GET['admno'];
	$year=$_GET['year'];
	
	$getPayable="SELECT SUM(f.amount) AS payable, s.form ,s.fname,s.sname,s.lname FROM finance_fees AS f JOIN studentdetails s ON f.form=s.form 
WHERE s.admno='$admno' AND  f.fiscal_yr='$year' GROUP BY s.form";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $name=str_replace("&","'",$roe['fname'])." ".str_replace("&","'",$roe['lname'])." ".str_replace("&","'",$roe['sname']);

	

	
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
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 9);
	$this->Text(45, 35, 'Fees Statement');
	$this->SetFont('arial', '', 9);
	$this->Text(45, 38, 'Name: '.$name);
	$this->Text(45, 42, 'Admno: '.$admno." Year ".$year);
	
  
    //Logo
   // $this->Image('images/KIWASCO_logo.PNG',10,8,33);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
   // $this->Cell(80);
    //Title
   // $this->Cell(30,10,'Title',1,0,'C');
    //Line break
    $this->Ln(25);
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

$fee = new fees();	
$admno=$_GET['admno'];
	$year=$_GET['year'];
	
	
	 $lyear=($year-1);
	$payable=0;
	
	$getPayable="SELECT SUM(f.amount) AS payable, s.form FROM finance_fees AS f JOIN studentdetails s ON f.form=s.form 
WHERE s.admno='$admno' AND  f.fiscal_yr='$year' GROUP BY s.form";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];

	$added=0;
	$addedq = "select COALESCE(sum(amount),0) as total from finance_added_fees where fiscal_year='$year'  and admno='$admno' and votehead not like '%BF%'";//cat 1 query
	$resultq = mysql_query($addedq);
	while ($rowq = mysql_fetch_array($resultq)) {// get cat1 marks
	$added=$rowq['total'];
	
	}
	
	$sql="SELECT  distinct(receipt_no), dateofpay, modeofpay,total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year' and f.statusis='OK' ORDER BY f.dateofpay asc";

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","10");
$pdf->setXY(25, 46);
$pdf->Cell(30, 5, "Receipt #", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Date of Pay", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Mode of Pay", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Payable", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(25, 5, "Balance", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database

$x = 25;


$result = mysql_query($sql);

$totals=0;
$pdf->setX(25);
$pdf->setFont("times","","8");
if($fee->getBF($year,$admno,'TERM 1')<0){
   $pdf->Cell(30,5, "OVERPAYMENT ".$lyear,  1);
  }else{
   $pdf->Cell(30,5, "ARREARS ".$lyear,  1);
  }
	$pdf->Cell(25,5, "-", 1);
	$pdf->Cell(25,5, "-", 1);
	$pdf->Cell(25,5, number_format($fee->getBF($year,$admno,'TERM 1'),2), 1, 0, "R", 0);
	$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
	$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
	
	
$pdf->Ln();
$pdf->setX(25);
$y = $pdf->GetY();
$pdf->setXY($x, $y);
$pdf->setX(25);
$pdf->setFont("times","","8");
   $pdf->Cell(30,5, "B/BF",  1);
	$pdf->Cell(25,5, "-", 1);
	$pdf->Cell(25,5, "-", 1);
	$pdf->Cell(25,5, number_format($fee->getBF($year,$admno,'TERM 1')+$added+$payable,2), 1, 0, "R", 0);
	$pdf->Cell(25,5, "0.00", 1, 0, "R", 0);
	$pdf->Cell(25,5, number_format($fee->getBF($year,$admno,'TERM 1')+$added+$payable,2), 1, 0, "R", 0);
$pdf->Ln();
$pdf->setX(25);
$y = $pdf->GetY();
$pdf->setXY($x, $y);
$num=1;
$fill=0;
 $bal=$added+$payable+$fee->getBF($year,$admno,'TERM 1');
while($row = mysql_fetch_array($result)){
$num++;

$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
   $pdf->Cell(30,5, $row['receipt_no'],  1, 0, "L", $fill);
	$pdf->Cell(25,5, $row['dateofpay'], 1, 0, "L", $fill);
	$pdf->Cell(25,5, $row['modeofpay'], 1, 0, "L", $fill);
	$pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", $fill);
	$pdf->Cell(25,5, number_format($row['total_amount'],2), 1, 0, "R", $fill);
	$pdf->Cell(25,5, number_format(($bal-$row['total_amount']),2), 1, 0, "R",$fill);
	
	$y +=5;
	$fill=!$fill;
	$bal=($bal-$row['total_amount']);
	//$payable=$added+$payable-$row['total_amount'];
	$totals+=$row['total_amount'];
	if ($y > 180)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","10");
		$pdf->setXY(25, 40);
		$pdf->Cell(30,5, "Receipt #", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Date of Pay", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Mode of Pay", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Payable", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Paid", 1, 0, "C", 1);
		$pdf->Cell(25,5, "Balance", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(80,5, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", 0);
   $pdf->Cell(25,5, number_format($totals,2), 1, 0, "R", 0);
    $pdf->Cell(25,5, number_format($bal,2), 1, 0, "R", 0);
  $pdf->Output();

?>
