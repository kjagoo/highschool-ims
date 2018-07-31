<?php

if(isset($_POST['admno'])){
$admno = $_POST['admno'];
$year  = $_POST['year'];
$term  = $_POST['term'];
$form  = $_POST['form'];

require_once("includes/dbconnector.php");

$paidamnt = 0;
$payable = 0;
$balance = 0;

$frm = substr($form, -1); 
$trm = substr($term, -1); 

$sqlq2 = mysql_query("SELECT balance  FROM finance_balances WHERE admno = '".$admno ."'  AND  form = '".$frm."'  AND  term = '".$trm."' AND  YEAR =  '".$year ."'") 
or die(mysql_error());	
			if(mysql_num_rows($sqlq2)){
						while($row2 = mysql_fetch_array($sqlq2)){
					$balance =$row2['balance'];
				}
			}

$sql_check = mysql_query("SELECT SUM(amount) AS payable FROM finance_fees WHERE form=\"". $form."\" AND Term = \"".$term."\" AND fiscal_yr ='".$year."'") or die(mysql_error());
if(mysql_num_rows($sql_check)){
	while($row1 = mysql_fetch_array($sql_check)){
			$payable =$row1['payable'];
		}
	}
		
	$sqlq3 = mysql_query("SELECT SUM(votehead_amt) as paid FROM finance_feestructures WHERE  admno = '".$admno ."' AND  term = '".$trm."'   AND  YEAR =  '".$year ."'") or die(	    mysql_error());
			if(mysql_num_rows($sqlq3)){
				
				while($row3 = mysql_fetch_array($sqlq3)){
					$paidamnt =$row3['paid'];
				}
		}
		

echo $balance.",".$payable.",".$paidamnt;

		

}

?>
