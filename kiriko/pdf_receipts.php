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
	 
	$from=$_GET['date4'];
	$to=$_GET['date5'];
		
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
	$this->Text(60, 35, 'Receipts Analysis Report:- From '.$from." To ".$to);
  	
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
$pdf->Cell(40, 7, "Receipt No", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Admno", 1, 0, "L", 1);
$pdf->Cell(30, 7, "Date of Pay", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Mode of Pay", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Amount", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);
 
	$from=$_GET['date4'];
	$to=$_GET['date5'];
	
	$sql="select distinct(receipt_no), admno,dateofpay,modeofpay,total_amount from finance_feestructures where dateofpay between '$from' and '$to' and statusis='OK'  order by receipt_no asc";
	
	
	
$result = mysql_query($sql);
$num=0;
$fill=0;
$total=0;
while($row = mysql_fetch_array($result)){
$num++;
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num,    1, 0, "L", $fill);
	$pdf->Cell(40, 7, $row['receipt_no'],    1, 0, "L", $fill);
	$pdf->Cell(25, 7, $row['admno'],   1, 0, "L", $fill);
	$pdf->Cell(30, 7, $row['dateofpay'],   1, 0, "C", $fill);
	$pdf->Cell(30, 7, $row['modeofpay'],  1, 0, "C", $fill);
	$pdf->Cell(30, 7, number_format(($row['total_amount']),2), 1, 0, "R", $fill);
	
	$total+=$row['total_amount'];
	$y += 7;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(40, 7, "Receipt No", 1, 0, "C", 1);
		$pdf->Cell(25, 7, "Admno", 1, 0, "L", 1);
		$pdf->Cell(30, 7, "Date of Pay", 1, 0, "C", 1);
		$pdf->Cell(30, 7, "Mode of Pay", 1, 0, "C", 1);
		$pdf->Cell(30, 7, "Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}

/*$resulttb = mysql_query("select sum(votehead_amt) as total from finance_feestructures where dateofpay between '$from' and '$to'  and statusis='OK'");
		while($rowtb = mysql_fetch_array($resulttb)){ 
		$total=$rowtb['total'];
		}*/
		
  $pdf->Cell(135, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(30, 7, number_format($total,2), 1, 0, "R", 0);
  $pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;

$pdf->setXY($x, $y);
  $result = mysql_query("select distinct(bank_account) as bank_name from finance_feestructures where dateofpay between '$from' and '$to'  and statusis='OK' order by bank_account asc");
		while($row = mysql_fetch_array($result)){
		
		$tot=0;
		$bank=str_replace(" ","_",$row['bank_name']);
		$results = mysql_query("select distinct(receipt_no), total_amount from finance_feestructures where dateofpay between '$from' and '$to'  and statusis='OK'  and bank_account='$bank' order by receipt_no asc");
		while($rows = mysql_fetch_array($results)){
		$tot+=$rows['total_amount'];
		}
		
		$pdf->Cell(135, 7, $row['bank_name'], 1, 0, "R", 0);
  		$pdf->Cell(30, 7, number_format($tot,2), 1, 0, "R", 0);
		
		$y += 7;
		$pdf->Ln();
		//gegevens van database
		$y = $pdf->GetY();
		$x = 25;
		$pdf->setXY($x, $y);
		}
		
  		$pdf->Ln();
		//gegevens van database
		$y = $pdf->GetY();
		$x = 25;
		$pdf->setXY($x, $y);

  
  
  $pdf->Output();

?>