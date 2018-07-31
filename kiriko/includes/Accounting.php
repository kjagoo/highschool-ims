<?php
include('dbconnector.php');
class Accounting{

function Accounting() {
}
function getPBDoneAccount($from, $to,$account,$mainaccount){

$revenue=0;
$qry="select COALESCE(sum(amount),0) as total from finance_paybills where t_date between  '$from' and '$to' and group_category='$account' and mainaccount='$mainaccount'";
 $result = mysql_query($qry);
	while ($row = mysql_fetch_array($result)) {
		$revenue=	$row['total'];			
	}
return $revenue;

}
function getPaidFeeByVotehead($from,$to,$votehead,$mainaccount){
 
 $paid=0;
	
	$sql="select COALESCE(sum(votehead_amt),0) as total from finance_feestructures where dateofpay between '$from' and '$to' and votehead='$votehead' and statusis='OK' and mainaccount='$mainaccount'";
$result = mysql_query($sql);
 while($row=mysql_fetch_array($result)){
    $paid=$row['total'];
 }
	return $paid;
	
 } 
 function getExpensesDonePerVotehead($from,$to,$votehead,$mainaccount){
	 
	$expensed=0;
	
	$sql="select COALESCE(sum(amount),0) as total from expenses where t_date between '$from' and '$to' and account='$votehead' and mainaccount='$mainaccount'";
$result = mysql_query($sql);
 while($row=mysql_fetch_array($result)){ 
    $expensed=$row['total'];
 }
	return $expensed; 
 }
 function getRevenueReceivedBank($from, $to,$bank,$mainaccount){
	 
	$revenue=0;

$qry="select COALESCE(sum(votehead_amt),0) as total from finance_feestructures where dateofpay between  '$from' and '$to' and bank_account='$bank' and statusis='OK' and mainaccount='$mainaccount'";
 $result = mysql_query($qry);
	while ($row = mysql_fetch_array($result)) {
		$revenue=	$row['total'];			
	} 
	return $revenue;
 }
 
 function getExpensesDoneBank($from, $to,$bank,$mainaccount){
	 
	 $expense=0;
	 $expense2=0;
$qry="select COALESCE(sum(amount),0) as total from expenses where t_date between '$from' and '$to' and bank='$bank' and mainaccount='$mainaccount'";
 $result = mysql_query($qry);
	while ($row = mysql_fetch_array($result)) {
		$expense=	$row['total'];			
	}
	
	$qry2="select COALESCE(sum(amount),0) as total from finance_paybills where t_date <='$to' and bank='$bank' and mainaccount='$mainaccount'";
 $result2 = mysql_query($qry2);
	while ($row2 = mysql_fetch_array($result2)) {
		$expense2=	$row2['total'];			
	}
	
	return $expense+$expense2;
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


/*============================================================================================================*/
function saveInvoiceDetails($po_number,$po_date,$supplier,$address,$email,$telephone,$po_notes,$authorized_by,$i_total,$i_tax){

    $query="insert into invoices
    (in_number,
        in_date,
        supplier,
        address,
        email,
        telephone,
        in_notes,
        authorized_by,
        i_total,
        i_tax)
values ('$po_number',
    '$po_date',
    '$supplier',
    '$address',
    '$email',
    '$telephone',
    '$po_notes',
    '$authorized_by','$i_total','$i_tax')on duplicate key update i_total='$i_total',i_tax='$i_tax'";

$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
}


function saveInvoiceItems($po_number,$item,$qty,$price,$tax){

    $query="insert into invoice_items
    (in_number,
        item,
        qty,
        price,tax)
values ('$po_number',
    '$item',
    '$qty',
    '$price','$tax') on duplicate key update  item='$item',qty='$qty', price='$price',tax='$tax'";

$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
}
/*=======================================================================================================*/
function editInvoiceDetails($po_number,$po_date,$supplier,$address,$email,$telephone,$po_notes,$authorized_by,$i_total,$i_tax,$item,$qty,$price){

    $query="UPDATE `invoices` SET `in_date`='$po_date',`supplier`='$supplier',`address`='$address',`email`='$email',`telephone`='$telephone',`in_notes`='$po_notes',`authorized_by`='$authorized_by',`i_total`='$i_total',`i_tax`='$i_tax' WHERE in_number='$po_number'";
    $query="UPDATE `assets` SET `item`='$item',`qty`='$qty',`i_total`='$i_total',`ref_date`='$po_date' WHERE `tag_ref`='$po_number'";
    $result = mysql_query($query);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
}
/*********** Chris Works*******/

function save_Received_Invoice_Details($invoice_ref,$receiveddate,$supplier,$pin,$saddress,$stel,$semail,$userid){

    $query="insert into received_invoices 
	(invoice_ref, received_date, supplier, supplier_pin, address, telephone, email, received_by, invoice_payment_status)
	values
	('$invoice_ref', '$receiveddate', '$supplier', '$pin', '$saddress', '$stel', '$semail', '$userid', 'OPEN') on duplicate key update invoice_ref=invoice_ref";

$result = mysql_query($query);
if (!$result) {
    echo 'Invalid query: Cannot Save Received Invoice Details. ' . mysql_error();
}
}


function save_Received_Invoice_Items($invoice_ref,$qty, $item_ref, $price){

    $query="insert into received_invoice_items 
	(invoice_ref, qty,  item_ref, price)
	values
	('$invoice_ref', '$qty', '$item_ref', '$price') on duplicate key update qty='$qty', item_ref='$item_ref', price='$price'";

$result = mysql_query($query);
if (!$result) {
    echo 'Invalid query: Cannot Save Received Invoice Items. ' . mysql_error();
}
}


function save_New_Supplier($supplier, $pin, $address, $telephone, $email){

$query="insert into suppliers 
	(supplier, pin, address, telephone, email)
	values
	('$supplier', '$pin', '$address', '$telephone', '$email')";
	
	$result = mysql_query($query);
if (!$result) {
    echo 'Invalid query: Cannot Save Supplier Details. ' . mysql_error();
}

}

 
 function getinvoiceAmt($inref){

	$amt=0;
	$qryi="select sum(price) as i_total from received_invoice_items where invoice_ref='$inref'";
		$resulti=mysql_query($qryi) ;
		while($rowi=mysql_fetch_array($resulti)){
		$amt=$rowi['i_total'];
		}
			
	return $amt;
}
function getinvoicePaidAmt($inref){
	$amt=0;
	$qryi="select sum(amount) as i_total from finance_paybills where invoice='$inref'";
		$resulti=mysql_query($qryi) ;
		while($rowi=mysql_fetch_array($resulti)){
		$amt=$rowi['i_total'];
		}
	return $amt;
}  
   
   
}// end of class Accounting

?>
