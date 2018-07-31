<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
include 'includes/fees.php';
$func = new Functions();
$fee = new fees();
$activity = "Viewed Votehead Balances page";
$func->addAuditTrail($activity,$username);

function insertIntoRunningBalances($admno,$yr,$amt){
	
	$sql="insert into running_balances(admno, yr, amount)values('$admno', '$yr', '$amt') on duplicate key update amount='$amt'";
	$resultsa = mysql_query($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<!-- Initiate tablesorter script -->
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );
 


	</script>
</head>
<body>
<div class="clear"></div>

<?php
if( (isset($_GET["form"])) || (isset($_GET["year"])) ){
 require_once("includes/dbconnector.php"); 

	$form=$_GET["form"];
	$year=$_GET["year"];
	$payable=0;

function getPayable($admno, $year){	
	$getPayable="SELECT SUM(f.amount) AS payable FROM finance_fees AS f inner join students_log sl on f.form=sl.form and f.fiscal_yr=sl.year inner JOIN studentdetails s ON sl.admno=s.admno and sl.admno='$admno' AND  f.fiscal_yr='$year' GROUP BY sl.admno";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];
return $payable;	
}

	
	
	function getBalance($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='$year'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}	
function getPreviousYRPayable($year,$admno){
	$total_payable=0;
	
	//acount from 2015 since the system was installed
	$bal2015=0;
	$yr2015=($year-1);
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='2015'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal2015=$rowpai['amount'];
 	}

	$getPayable="SELECT SUM(f.amount) AS payable FROM finance_fees AS f inner join students_log sl on f.form=sl.form and f.fiscal_yr=sl.year inner JOIN studentdetails s ON sl.admno=s.admno and sl.admno='$admno' AND  f.fiscal_yr='$year'  GROUP BY sl.admno";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];
	

$added=0;
	$addedq = "SELECT COALESCE(sum(fa.amount),0) AS added FROM finance_added_fees AS fa 
inner join students_log sl on fa.fiscal_year=sl.year and sl.admno=fa.admno
inner JOIN studentdetails s ON sl.admno=s.admno
and sl.admno='$admno' AND  fa.fiscal_year='$year' GROUP BY sl.form";//cat 1 query
	$resultq = mysql_query($addedq);
	while ($rowq = mysql_fetch_array($resultq)) {// get cat1 marks
	$added=$rowq['added'];
	
	}

	$total_payable=$payable+$added+$bal2015;
	
	
	return $total_payable;
}
function checkArrearsPaid($admno,$year){
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Arrears'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	
	function checkOverpaymentsUsed($admno,$year){
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
function getPreviousYrBal($admno,$year){
	
	$bal=0;
 $sql="SELECT  distinct(receipt_no), f.dateofpay, f.modeofpay,f.total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year'  and f.statusis='OK' ORDER BY f.dateofpay asc";
   $result = mysql_query($sql);
   $rowscounts=mysql_num_rows($result);
   $totalb=0;
   $AMT=0;
 if($rowscounts==1 ||$rowscounts>1){
  			while($row = mysql_fetch_array($result)){
			$totalb+=$row['total_amount'];
			
			$bal=($bal-$row['total_amount']);
			
			$AMT=$row['total_amount'];
			
  			}
	}else{
			 
		$bal=($bal-$AMT);
	} 	
				
return $bal;
}	
 
function getPaidAmounts($admno,$year){
	
	$paidAmount=0;
	$paid = mysql_query("SELECT COALESCE(sum(votehead_amt),0) as amount from finance_feestructures  where admno='$admno' and  year='$year'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($paid)) {
	$paidAmount=$rowpai['amount'];
 	}
	return $paidAmount;
	}
 
	
	
?>
 
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Fees Statement : <?php echo $form." Year - ".$year?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
		   <td align="center"><a href="finance_report_view_statement_all.php?form=<?php echo $form?>&year=<?php echo $year?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_statement_all.php?form=<?php echo $form?>&year=<?php echo $year?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print All</a></td>
            <td align="right"><a href="finance_report_statements.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-bordered table-striped">
   			<thead>
              <th width="10px">#</th>
			  <th> Admno</th>
			  <th>Student Name</th>
			  <th align="right">B/F <?php echo $year-1?></th>
			  <th align="right">Added Fees</th>
			   <th align="right">Payable</th>
			   <th align="right">Paid</th>
			   <th align="right">Balance</th>
			   <th></th>
			</tr>
			</thead>
			<tbody>
			<?php
			 $lyear=($year-1);
			 $num=0;
			 $res = mysql_query("SELECT * from studentdetails  where form='$form'");
				while ($rows = mysql_fetch_array($res)) {
				$fname=$rows['fname'];
				$mname=$rows['sname'];
				$lname=$rows['lname'];
				$formin=$rows['form'];
				$admno=$rows['admno'];
				$streamin=$rows['class'];
		//$bal=(getPreviousYRPayable(($year-1),$admno)+getPreviousYrBal($admno,($year-1)));
		$num++;
		$bf=getPreviousYRPayable(($year-1),$admno)+getPreviousYrBal($admno,($year-1))+$fee->getBF($year,$admno,'TERM 1');;

		//$added=getAdded($admno,$year);
		$added=$fee->getAddedAmt($year,$admno,'TERM 1')+$fee->getAddedAmt($year,$admno,'TERM 2')+$fee->getAddedAmt($year,$admno,'TERM 3');
		//$payable=getPayable($admno, $year);
		$payable=$fee->getInvoiceAmt(($year),'TERM 1',$admno)+$fee->getInvoiceAmt(($year),'TERM 2',$admno)+$fee->getInvoiceAmt(($year),'TERM 3',$admno)+$added+$bf;
		$paids=getPaidAmounts($admno,$year);
		$lyearpayable=$added+$payable-$paids+$bf;
		
			?>
  			<tr>
			   <td width="5%"><?php echo $num?></td>
			    <td><?php echo $admno?></td>
                <td><?php echo $fname." ".$mname." ".$lname?></td>
				<td align="right"><strong><?php echo number_format($bf,2)?></strong></td>
	             <td align="right"><strong><?php echo number_format($added,2)?></strong></td>
				 <td align="right"><strong><?php echo number_format($payable,2)?></strong></td>
				 <td align="right"><strong><?php echo number_format($paids,2)?></strong></td>
				  <td align="right"><strong><?php echo number_format(($lyearpayable),2)?></strong></td>
				<td><a href="pdf_statement.php?admno=<?php echo $admno?>&year=<?php echo $year?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i></a></td>
              </tr>
			<?php
			
			insertIntoRunningBalances($admno,$year,$lyearpayable);
  			}
			 
			 ?>
		</tbody>
		
       
      </table></td>
</table>
<?php

}else{ ?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>STATEMENT Analysis: </td>
  </tr>
  <tr>
  <td>
<table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			  <th width="10px">#</th>
			   <th>Receipt #</th>
               <th>Admno</th>
			   <th>Date Paid</th>
			   <th>Mode of Pay</th>
			   <th>Amount</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
</td>
</tr>
</table>
<?php 
}

?>
</body>
</html>
