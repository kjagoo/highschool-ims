<?php

//require('fpdf.php');
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
//include 'includes/Accounting.php';
require('rotation.php');


class PeoplePDF  extends PDF_Rotate{



function RotatedText($x, $y, $txt, $angle){
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
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
	
	if(isset($_GET['id'])){
	
	$ponumber = $_GET['id'];
	
	 $result = mysql_query("SELECT p.* FROM purchase_orders p WHERE po_number='$ponumber'");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		  
		  	$reqref = $row['po_number'];
			$deliverydate = $row['d_date'];
			$PaymentTerms = "-";
			$supplier = $row['supplier'];
			$saddress = $row['address'];
			$stel = $row['telephone'];
			$semail = $row['email'];
			$po_date=$row['po_date'];
		$po_notes=$row['po_notes'];
		$authorized_by=$row['authorized_by'];
		  }
	
	
	
	} 
	
		
	
	//if(!file_exists("images/".$logref)){
 		 $logo="images/logo.JPG";
  		//}else{
 			//$logo = "images/".$logref;
 	// }
	 $this->SetFont('times','B',30);
	$this->SetTextColor(204,255,204);
	$this->RotatedText(80,30,"COPY",10);
	$this->RotatedText(30,30,"COPY",10);
	$this->RotatedText(120,30,"COPY",10);
	 
		//$hcode=$_GET['hbar'];
 		 $barcode="images/barcode.PNG";
	$this->SetTextColor(0,0,0);	 
	$this->SetFont('arial', '', 10);
	$this->Image($barcode,130,10,30,0);
	$this->SetFont('arial', '', 7);
	$this->Text(131, 10, $ponumber);
	$this->SetFont('arial', '', 9);
	$this->Text(20, 17, $schoolname);
	$this->Text(20, 22,'P.o.Box  '.$address);
	$this->Text(20, 27,'Telephone:  '.$tele);
	$this->Text(20, 32,'Email:  '.$email);
	$this->SetFont('arial', 'B', 12);
	$this->Text(130, 25, 'Local Purchase Order [LPO]');
	$this->SetFont('arial', '', 9);
	$this->Text(130, 30, 'Dated  ');
	$this->SetFont('arial', 'U', 9);
	$this->Text(140, 30,  $po_date);
	$this->SetFont('arial', '', 9);
	$this->Text(130, 35, 'Purchase Order #  ');
	$this->Text(130, 39, 'Deliverly Date  ');
	$this->SetFont('arial', 'U', 9);
	$this->Text(160, 35,  $ponumber);
	$this->Text(160, 39,  $deliverydate);
	
	
	
	$this->SetDrawColor(0, 0, 0);
	$this->SetFillColor(0, 0, 0);
	$this->Rect(20, 41, 170, 0);// the rectangle left,top,width, height
	$this->SetFont('arial', 'B', 12);
	$this->Text(20, 45, 'Vender Information');
	$this->SetFont('arial', '', 9);
	$this->Text(20, 50, 'Supplier');
	$this->Text(20, 55, 'Address');
	$this->Text(20, 60, 'Email');
	$this->Text(20, 65, 'Telephone');
	
	//$this->SetFont('arial', 'U', 9);
	$this->Text(40, 50,  $supplier);
	$this->Text(40, 55,  $saddress);
  	$this->Text(40, 60,  $semail);
	$this->Text(40, 65,  $stel);
	
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
//$acc = new Accounting();
if(isset($_GET['id'])){
	
	$ponumber = $_GET['id'];
	
}
//$acc->savePODetails($ponumber,$podate,$deliverydate,$supplier,$saddress,$semail,$stel,$notes,$_SESSION['SESS_NAME_']);


$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(25, 70);
$pdf->Cell(120, 7, "Item Description", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Quantity", 1, 0, "C", 1);
$pdf->Ln();
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);

		//$BX_NAME=$_POST['BX_NAME'];
		//$BX_age=$_POST['BX_age'];
		
		$fill=0;
		$totalitems=0;
		$resulti = mysql_query("SELECT p.* FROM purchase_orderitems p WHERE po_number='$ponumber'");
		$numi=0;
		  while($rowi = mysql_fetch_array($resulti)){ 
		  
		$pdf->SetFillColor(224,235,255);
		$pdf->Cell(120, 7,  $rowi['item'],  1, 0, "L", $fill);
		$pdf->Cell(40, 7,  $rowi['qty'],  1, 0, "R", $fill);
		
		//$acc->savePOItems($ponumber,$BX_NAME[$a],$BX_age[$a]);
		
		$totalitems+=$rowi['qty'];
		$y += 7;
	   	$fill=!$fill;
		if ($y > 275){
		$pdf->addPage();
		$pdf->SetAutoPageBreak(false);
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 70);
		$pdf->Cell(120, 7, "Item Description", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Quantity", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 70;
		}
		
	$pdf->setXY($x, $y);
		}
				

 $result = mysql_query("SELECT p.* FROM purchase_orders p WHERE po_number='$ponumber'");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		$po_notes=$row['po_notes'];
		$authorized_by=$row['authorized_by'];
		  }
	
	
  
   $pdf->setX(115);
 $pdf->Cell(30, 7, "Total:", 1, 0, "R", 0);
 $pdf->Cell(40, 7, $totalitems, 1, 0, "R", 0);
 $pdf->Ln(10);

 $y = $pdf->GetY();
  $pdf->setXY(25, $y);
  $pdf->Text(25, $y-1, "Additional Notes");
  $pdf->SetFont('arial', '', 8);
  $pdf->MultiCell(90, 5, $po_notes, 1, "L", 0);
 $pdf->Ln();
 $pdf->setX(115);
 $y = $pdf->GetY()+20;
$pdf->SetFont('arial', '', 8);
	$pdf->Text(130, $y, 'P.O Authorized By:  ');
	$pdf->Text(130, $y+5,  "[ ".$authorized_by." ]");
 
$pdf->Output();

