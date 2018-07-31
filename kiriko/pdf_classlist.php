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
	 
	$form=$_GET['forms'];
	$stream=$_GET['stream'];
	$genders=$_GET["genders"];
		
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
 		// $barcode="images/barcode.PNG";
		 
	$this->SetFont('times', '', 9);
	$this->Image($logo,20,10,20,20);
	//$this->Image($barcode,160,10,0,0);
	//$this->Text(161, 25, $hcode);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.O.BOX  '.$address);
	$this->Text(65, 27,'TEL:  '.$tele);
	$this->Text(60, 35, 'CLASS LIST:-'.$form." ".$stream);
	
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
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black

 
 
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(20, 40);
$pdf->Cell(10, 5, "No.", 1, 0, "L", 1);
$pdf->Cell(20, 5, "Adm. No.", 1, 0, "L", 1);
$pdf->Cell(15, 5, "KCPE", 1, 0, "L", 1);
$pdf->Cell(60, 5, "Student Name", 1, 0, "L", 1);

		$pdf->Cell(60, 5, "", 1, 0, "L", 1);
		

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 

	$form=$_GET['forms'];
	$stream=$_GET['stream'];
	$genders=$_GET["genders"];
	
	if($genders=="Entire"){
$sql = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream'  order by sd.admno asc";
}
if($genders=="Boys"){
$sql = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Male'  order by sd.admno asc";
}
if($genders=="Girls"){
$sql = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Female'  order by sd.admno asc";
}
	
$result = mysql_query($sql);
$num=0;
$fill=0;
while($row = mysql_fetch_array($result)){
$num++;
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(20, 5, $row['admno'],  1, 0, "L", $fill);
	$pdf->Cell(15, 5, $row['marks'], 1, 0, "L", $fill);
	$pdf->Cell(60, 5, str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['lname'])." ".str_replace("&","'",$row['sname']), 1, 0, "L", $fill);
     
	$pdf->Cell(60, 5, "", 1, 0, "L", $fill);

	
	$y += 5;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 5, "No.", 1, 0, "L", 1);
		$pdf->Cell(20, 5, "Adm. No.", 1, 0, "L", 1);
		$pdf->Cell(15, 5, "", 1, 0, "L", $fill);
		$pdf->Cell(60, 5, "Student Name", 1, 0, "L", 1);

		$pdf->Cell(60, 5, "", 1, 0, "L", 1);
		
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}

$pdf->Output();

?>