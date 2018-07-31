<?php

require('fpdf.php');
include('includes/dbconnector.php');
include("includes/fees.php");
	$fees = new Fees();

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
	
	$admno=$_GET['ref'];
	
	$getPayable="SELECT s.form ,s.fname,s.sname,s.lname FROM studentdetails s
WHERE s.admno='$admno' ";
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
	$this->SetFont('arial', '', 9);
	$this->Text(45, 35, 'Pocket Money Statement');
	$this->SetFont('arial', '', 9);
	$this->Text(45, 38, 'Name: '.$name);
	$this->Text(45, 42, 'Admno: '.$admno);
	
  
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

	$admno=$_GET['ref'];
	$sql="SELECT  * from pocket_money_transactions where admno='$admno' ORDER BY t_date asc";

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
$pdf->setXY(30, 46);
$pdf->Cell(10, 5, " #", 1, 0, "C", 1);
		$pdf->Cell(40, 5, "Transaction", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Date", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Deposit", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Withdraw", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database

$x = 30;


$result = mysql_query($sql);

$pdf->setX(30);
$y = $pdf->GetY();
$pdf->setXY($x, $y);
$num=0;
$fill=0;
 
while($row = mysql_fetch_array($result)){
$num++;

$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
   $pdf->Cell(10,5, $num,  1, 0, "L", $fill);
	$pdf->Cell(40,5, $row['transaction'], 1, 0, "L", $fill);
	$pdf->Cell(30,5, $row['t_date'], 1, 0, "L", $fill);
	$pdf->Cell(30,5, number_format($row['deposit_amount'],2), 1, 0, "R", $fill);
	$pdf->Cell(30,5, number_format(($row['withdraw_amount']),2), 1, 0, "R",$fill);
	
	$y +=5;
	$fill=!$fill;
	if ($y > 180)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","10");
		$pdf->setXY(30, 40);
		$pdf->Cell(10, 5, " #", 1, 0, "C", 1);
		$pdf->Cell(40, 5, "Transaction", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Date", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Deposit", 1, 0, "C", 1);
		$pdf->Cell(30, 5, "Withdraw", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(80,5, "Available Balance:", 1, 0, "R", 0);
  $pdf->Cell(30,5, number_format($fees->pocketMoneyBal($admno),2), 1, 0, "R", 0);
   
  $pdf->Output();

?>
