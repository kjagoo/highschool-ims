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
	$this->Text(201, 25, "Report Ref ".$hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(80, 17, $schoolname);
	$this->Text(80, 22,'P.o.Box  '.$address);
	$this->Text(80, 27,'  Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(75, 35, 'Lost Books Report');
  
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
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	
	

}
$pdf = new FPDF();
$pdf = new PeoplePDF();
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
$pdf->Cell(60, 7, "Title", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Book No", 1, 0, "C", 1);
$pdf->Cell(55, 7, "Subject", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Book Type", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Yr of Edn", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Issued By", 1, 0, "C", 1);
$pdf->Cell(25, 7, "Issued To", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);
 $dao = new DAO();
$sql ="select b.title,b.publisher, b.category, b.bookid,b.btype,b.yrofedition, l.bookid, l.bookno, l.comments, l.userid, l.issuer_ref 
from books_invemtory as b inner join lib_lost_books l on l.bookid=b.bookid order by b.title desc";
$result = mysql_query($sql);
$num=0;
while($row = mysql_fetch_array($result)){
$num++;
	$issuedBooks=$dao->getBooksIssued($row['bookid']);
	$pdf->setFont("times","","10");
	$pdf->Cell(10, 7, $num, 1);
    $pdf->Cell(60, 7, $row['title'], 1);
	$pdf->Cell(20, 7, $row['bookno'], 1, 0, "C", 0);
	$pdf->Cell(55, 7, $row['category'], 1);
	$pdf->Cell(40, 7, $row['btype'],1);
	$pdf->Cell(20, 7, $row['yrofedition'], 1);
	$pdf->Cell(30, 7, $row['issuer_ref'], 1);
	$pdf->Cell(25, 7, $row['userid'], 1, 0, "C", 0);
	
	$y += 7;
	
	if ($y > 180)
	{
		$pdf->addPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(60, 7, "Title", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Book No", 1, 0, "C", 1);
		$pdf->Cell(55, 7, "Subject", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Book Type", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Yr of Edn", 1, 0, "C", 1);
		$pdf->Cell(30, 7, "Issued By", 1, 0, "C", 1);
		$pdf->Cell(25, 7, "Issued To", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output();