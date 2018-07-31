<?php
	if($_POST){
	include('includes/dbconnector.php');
	$admno = $_POST['payee']; 
	$p_type = $_POST['p_type'];
	$t_date=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$amount = $_POST['amount'];
	
	
	if($p_type=="Deposit"){
		$damount=$amount;
		$camount=0;
		
		mysql_query("insert into pocket_money (admno, bal)values ('$admno', '$damount') on duplicate key update bal=bal+$damount");
	}else{
		$damount=0;
		$camount=$amount;
		
		mysql_query("update pocket_money set bal=(bal-$camount) where admno='$admno'");
	}
	$query="insert into pocket_money_transactions
	( admno, transaction, t_date, deposit_amount, withdraw_amount)
	values
	('$admno', '$p_type', '$t_date', '$damount', '$camount')";
	 $result = mysql_query($query);

		if (!$result) {
		echo 'Invalid query: ' . mysql_error();
   		 }
	
	
	echo "Transaction Successful";
	}
	?>