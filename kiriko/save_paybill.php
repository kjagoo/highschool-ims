<?php
	if($_POST){
	include('includes/dbconnector.php');
	$payee = $_POST['payee']; 
	$p_type = $_POST['p_type'];
	$bank = $_POST['bank']; 
	$t_date=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$mainaccount=$_POST['mainaccount'];
	$group_category=$_POST['t_type'];
	$memo = $_POST['memo']; 
	
	$invoicespaid = $_POST['invoice']; 
	$count=count($_POST['invoice']);
	$amountpaids = $_POST['amounts'];
	
	for ($i=0; $i < $count; $i++){
	$invoice=$_POST['invoice'][$i];
	$amount=$_POST['amounts'][$i];
	
	if($amount<=0){}else{
	
	$query="insert into finance_paybills (payee, invoice, p_type, bank, t_date, amount,mainaccount, group_category, memo) values('$payee', '$invoice', '$p_type', '$bank', '$t_date', '$amount','$mainaccount', '$group_category','$memo')";
	 $result = mysql_query($query);

		if (!$result) {
		echo 'Invalid query: ' . mysql_error();
   		 }
	 }
	}
	echo "Transaction Successful";
	}
	?>