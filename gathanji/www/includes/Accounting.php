<?php
include('dbconnector.php');
class Accounting{

function Accounting() {
}

function savePODetails($po_number,$po_date,$d_date,$supplier,$address,$email,$telephone,$po_notes,$authorized_by){
 
 $query="insert into purchase_orders
            (po_number,
             po_date,
             d_date,
             supplier,
             address,
             email,
             telephone,
             po_notes,
             authorized_by)
values ('$po_number',
        '$po_date',
        '$d_date',
        '$supplier',
        '$address',
        '$email',
        '$telephone',
        '$po_notes',
        '$authorized_by')
		on duplicate key update po_date='$po_date'";
		
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
 }
 
 
 function savePOItems($po_number,$item,$qty){
 
 $query="insert into purchase_orderitems
            (po_number,
             item,
             qty)
values ('$po_number',
        '$item',
        '$qty') on duplicate key update item='$item', qty='$qty'";
		
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
 }
 
 function savePOReceived($po_number,$delivery,$d_date,$d_notes,$received_by){
 
 $query="INSERT INTO purchase_orders_received
            (po_number,
             delivery,
             d_date,
             d_notes,
			 received_by)
VALUES ('$po_number',
        '$delivery',
        '$d_date',
        '$d_notes',
		'$received_by') on duplicate key update d_date='$d_date', d_notes='$d_notes' ";
		
		$result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}else{
	//update that LPO AS CLOSED
	$qury="update purchase_orders set po_status='CLOSED' where po_number='$po_number'";
	$resultq = mysql_query($qury);
	}
 
 }
 
 
  function savePOReceivedItems($po_number,$item,$qty,$unit_price,$total_price){
 
 $query="INSERT INTO purchase_orderitems_received
            (po_number,
             item,
             qty,
             unit_price,
             total_price)
VALUES ('$po_number',
        '$item',
        '$qty',
        '$unit_price',
        '$total_price') on duplicate key update item='$item', qty='$qty',unit_price='$unit_price', total_price='$total_price'";
		
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
 }
 
 function saveInvoice($invoice_no,$payee_ref,$amount_due,$acc_payable){
 
 $query="INSERT INTO tbl_invoices
            (invoice_no,
			payee_ref,
			amount_due,
             acc_payable)
VALUES ('invoice_no',
		'$payee_ref',
        '$amount_due',
        '$acc_payable') on duplicate key update payee_ref='$payee_ref', amount_due='$amount_due', acc_payable='$acc_payable' ";
 
  $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
 }
 
 
   
}// end of class Accounting

?>
