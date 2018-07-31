<?php
require_once('auth.php');

	
	include 'includes/mssql.class.php';
	include 'includes/functions.php';
	$func = new Functions();
	$userid=$_SESSION['SESS_MEMBER_ID_'];
	
	
include 'includes/Accounting.php';
$acc = new Accounting();

	
if($_POST){
    
   $select=$_POST['select'];
    $invoice_ref = $_POST['ino'];
   
if($select=="Add"){
    $QTY=$_POST['QTY'];
	$item_ref=$_POST['item_ref'];
	$price=$_POST['price'];
      
		
		$fill=0;
		$totalitems=0;
		$totalcost=0;
		foreach($QTY as $a => $b){ 
                    
                  
		
		$acc->save_Received_Invoice_Items($invoice_ref,$QTY[$a], $item_ref[$a], $price[$a]);
		
		$totalitems+=$QTY[$a];
		$totalcost+=$price[$a];
		}
		
		
		echo "Item Added"; 
                
    }elseif($select=="Edit"){
       $QTY=$_POST['QTY'];
	$item_ref=$_POST['item_ref'];
	$price=$_POST['price'];
      
		
		$fill=0;
		$totalitems=0;
		$totalcost=0;
		foreach($QTY as $a => $b){ 
                    
                   
		
		$acc->save_Received_Invoice_Items($invoice_ref,$QTY[$a], $item_ref[$a], $price[$a]);
		
		$totalitems+=$QTY[$a];
		$totalcost+=$price[$a];
		}
		
		
		echo "Invoice Updated"; 
    }else{
    
    
	$receiveddate = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	
	$supplier = $_POST['sname'];
	$pin = $_POST['pin'];
	$saddress = $_POST['saddress'];
	$stel = $_POST['stel'];
	$semail = $_POST['semail'];
	
	
	
	$activity = "Received Invoice Ref # $invoice_ref  from $supplier  ";
    $func->addAuditTrail($activity,$userid);
	
	if($select=="New"){
	$acc->save_New_Supplier(str_replace(" ","_",$supplier), $pin, $saddress, $stel, $semail);
	}
	
	$acc->save_Received_Invoice_Details($invoice_ref,$receiveddate,$supplier,$pin,$saddress,$stel,$semail,$userid);
	
	
	$QTY=$_POST['QTY'];
	$item_ref=$_POST['item_ref'];
	$price=$_POST['price'];
		
		$fill=0;
		$totalitems=0;
		$totalcost=0;
		foreach($QTY as $a => $b){ 
                    
        /*      if($tax_ref[$a]==116){
			$tax+=($price[$a]/$tax_ref[$a])*16;
		}
		elseif($tax_ref[$a]==16){
			$tax=$price[$a]*($tax_ref[$a]/100);
		}elseif($tax_ref[$a]==0){
			$tax=0;
		}*/
		
		$acc->save_Received_Invoice_Items($invoice_ref,$QTY[$a], $item_ref[$a], $price[$a]);
		
		$totalitems+=$QTY[$a];
		$totalcost+=$price[$a];
		//$total_Tax=0;
		}
		
		
		echo "Invoice Received";
		
    }		
} 
		
				


  