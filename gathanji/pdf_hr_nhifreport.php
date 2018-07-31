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
	if($_GET['frm']=="all"){
		$from="*";
		$to="*";
	}else{
	$from=$_GET['frm'];
	$to=$_GET['to'];
	}
		
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
	$this->Image($barcode,160,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(161, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(60, 35, 'NHIF Report:- From '.$from." To ".$to);
  	
    $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
	
}
include 'includes/Finance.php';
	$finacial= new Financials();

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
$pdf->setFont("times","","11");
$pdf->setXY(25, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(70, 7, "Employee", 1, 0, "C", 1);
$pdf->Cell(25, 7, "ID/Passport", 1, 0, "L", 1);
$pdf->Cell(30, 7, "Payrol Ref", 1, 0, "C", 1);
$pdf->Cell(30, 7, "NHIF Amount", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);
 
	if($_GET['frm']=="all"){
		$from="*";
		$to="*";
		$query="select p.nhif, p.date_ref, p.payrollref,p.staff_ref, s.fname,s.mname,s.lname,s.idpass from tbl_hr_payslips as p inner join staff s on p.staff_ref=s.idpass where p.nhif>0";
	}else{
	$from=$_GET['frm'];
	$to=$_GET['to'];
	$query="select p.nhif, p.date_ref, p.payrollref,p.staff_ref, s.fname,s.mname,s.lname,s.idpass from tbl_hr_payslips as p inner join staff s on p.staff_ref=s.idpass where p.date_ref between '$from' and '$to' and p.nhif>0";
	
	}
		
	
	
	
	
	
$result = mysql_query($query);
$num=0;

$total=0;
while($row = mysql_fetch_array($result)){
$num++;
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num, 1);
	$pdf->Cell(70, 7, str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['mname'])." ".str_replace("&","'",$row['lname']),  1);
	$pdf->Cell(25, 7, $row['idpass'],  1);
	$pdf->Cell(30, 7, $row['payrollref'], 1, 0, "C", 0);
	$pdf->Cell(30, 7, number_format(($row['nhif']),2), 1, 0, "R", 0);
	
	$total+=$row['nhif'];
	$y += 7;
	
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(70, 7, "Employee", 1, 0, "C", 1);
		$pdf->Cell(25, 7, "ID/Passport", 1, 0, "L", 1);
		$pdf->Cell(30, 7, "Payrol Ref", 1, 0, "C", 1);
		$pdf->Cell(30, 7, "NHIF Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(135, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(30, 7, number_format($total,2), 1, 0, "R", 0);
  $pdf->Output();

?>