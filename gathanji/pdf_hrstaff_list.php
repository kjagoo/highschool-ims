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
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(75, 35, 'Staff List Report ');
  
    //Logo
   // $this->Image('images/KIWASCO_logo.PNG',10,8,33);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
   // $this->Cell(80);
    //Title
   // $this->Cell(30,10,'Title',1,0,'C');
    //Line break
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
$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(20, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(65, 7, "Staff Name", 1, 0, "C", 1);
$pdf->Cell(25, 7, "ID/Passport #", 1, 0, "C", 1);
$pdf->Cell(35, 7, "Category", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Staff No", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Telephone", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 
$sql ="SELECT * FROM staff  order by category asc";

$result = mysql_query($sql);
$num=0;
while($row = mysql_fetch_array($result)){
$num++;

	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num, 1);
    $pdf->Cell(65, 7, $row['fname']." ".$row['mname']." ".$row['lname'], 1);
	$pdf->Cell(25, 7, $row['idpass'], 1);
	$pdf->Cell(35, 7, $row['category'], 1);
	$pdf->Cell(20, 7, $row['staffno'],1);
	$pdf->Cell(20, 7, $row['telephone'], 1, 0, "C", 0);
	
	$y += 7;
	
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(65, 7, "Staff Name", 1, 0, "C", 1);
		$pdf->Cell(25, 7, "ID/Passport #", 1, 0, "C", 1);
		$pdf->Cell(35, 7, "Category", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Staff No", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Telephone", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output();