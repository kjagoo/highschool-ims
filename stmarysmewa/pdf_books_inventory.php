<?php

require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/DAO.php';

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
	$this->Image($barcode,200,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(201, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address.'  Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(75, 35, 'Books Inventory Report');
  
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
$pdf->open();
$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(25, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(50, 7, "Title", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Subject", 1, 0, "C", 1);
$pdf->Cell(55, 7, "Publisher", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Category", 1, 0, "C", 1);
$pdf->Cell(23, 7, "Yr of Edtn", 1, 0, "C", 1);
$pdf->Cell(15, 7, "Copies", 1, 0, "C", 1);
$pdf->Cell(15, 7, "Issued", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);
 $dao = new DAO();
$sql ="SELECT * FROM books_invemtory order by title desc";
$result = mysql_query($sql);
$num=0;
while($row = mysql_fetch_array($result)){
$num++;
	$issuedBooks=$dao->getBooksIssued($row['bookid']);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num, 1);
    $pdf->Cell(50, 7, $row['title'], 1);
	$pdf->Cell(40, 7, $row['category'], 1);
	$pdf->Cell(55, 7, $row['publisher'], 1);
	$pdf->Cell(40, 7, $row['btype'],1);
	$pdf->Cell(23, 7, $row['yrofedition'], 1);
	$pdf->Cell(15, 7, $row['noofpcs'], 1, 0, "R", 0);
	$pdf->Cell(15, 7, $issuedBooks, 1, 0, "R", 0);
	
	$y += 7;
	
	if ($y > 180)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(50, 7, "Title", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Subject", 1, 0, "C", 1);
		$pdf->Cell(55, 7, "Publisher", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Category", 1, 0, "C", 1);
		$pdf->Cell(23, 7, "Yr of Edtn", 1, 0, "C", 1);
		$pdf->Cell(15, 7, "Copies", 1, 0, "C", 1);
		$pdf->Cell(15, 7, "Issued", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output();

?>