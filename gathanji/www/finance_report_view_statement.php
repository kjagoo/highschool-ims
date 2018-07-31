<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Votehead Balances page";
$func->addAuditTrail($activity,$username);
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
if( (isset($_GET["admno"])) || (isset($_GET["year"])) ){
 require_once("includes/dbconnector.php"); 

	$admno=$_GET["admno"];
	$year=$_GET["year"];
	$payable=0;
	
	$getPayable="SELECT SUM(f.amount) AS payable, s.form,s.fname,s.sname,s.lname FROM finance_fees AS f JOIN studentdetails s ON f.form=s.form 
WHERE s.admno='$admno' AND  f.fiscal_yr='$year' GROUP BY s.form";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];
	
	$name=str_replace("&","'",$roe['fname'])." ".str_replace("&","'",$roe['lname'])." ".str_replace("&","'",$roe['sname']);

	
	function getBalance($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='$year'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}	
	
 
?>
 
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Fees Statement : <?php echo $admno."  ".$name. ": Year - ".$year?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
		   <td align="center"><a href="finance_report_view_statement.php?admno=<?php echo $admno?>&year=<?php echo $year?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_statement.php?admno=<?php echo $admno?>&year=<?php echo $year?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
            <td align="right"><a href="finance_report_statements.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-bordered table-striped">
   			<thead>
              <th width="10px">#</th>
			   <th>Receipt #</th>
			   <th>Date Paid</th>
			   <th>Mode of Pay</th>
			   <th align="right">Payable</th>
			   <th align="right">Paid</th>
			   <th align="right">Balance</th>
			</tr>
			</thead>
			<tbody>
			<?php
			 $lyear=($year-1);
			 
			 ?>
			<tr>
			   <td width="5%">1</td>
                <td><?php if(getBalance($admno,$lyear)<0){ echo "OVERPAYMENT ";}else{ echo "ARREARS ";}?> <?php echo  $lyear?></td>
				 <td>-</td>
				  <td>-</td>
                <td align="right"><strong><?php echo getBalance($admno,$lyear)?></strong></td>
				 <td align="right"><strong>0.00</strong></td>
				  <td align="right"><strong>0.00</strong></td>
              </tr>
			
		
			<tr>
			   <td width="5%">1</td>
                <td>B/BF INVOICE <?php echo " ".$year?></td>
				 <td>-</td>
				  <td>-</td>
                <td align="right"><strong><?php echo number_format(($payable+getBalance($admno,$lyear)),2)?></strong></td>
				 <td align="right"><strong>0.00</strong></td>
				  <td align="right"><strong>0.00</strong></td>
              </tr>
       <?php
	   
	   $sql="SELECT  distinct(receipt_no), dateofpay, modeofpay,total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year' ORDER BY f.dateofpay asc";
	
          $result = mysql_query($sql);
		  $num=1;
		  $totalb=0;
		  $rowscounts=mysql_num_rows($result);
		 if($rowscounts==1 ||$rowscounts>1){
		
		  
		 
  			while($row = mysql_fetch_array($result)){
			$num++;
			?>
  			<tr>
			   <td width="5%"><?php echo $num?></td>
                <td><?php echo $row['receipt_no']?></td>
				 <td><?php echo $row['dateofpay']?></td>
				  <td><?php echo $row['modeofpay']?></td>
                <td align="right"><strong><?php echo number_format(($payable+getBalance($admno,$lyear)),2)?></strong></td>
				 <td align="right"><strong><?php echo number_format($row['total_amount'],2)?></strong></td>
				  <td align="right"><strong><?php echo number_format((($payable+getBalance($admno,$lyear))-$row['total_amount']),2)?></strong></td>
              </tr>
			<?php
			$totalb+=$row['total_amount'];
			
			$payable=($payable+getBalance($admno,$lyear))-$row['total_amount'];
			
			
  			}
			 }else{
			 
			$payable=($payable+getBalance($admno,$lyear));
			 } 
			 
			 ?>
		</tbody>
		<tfoot>
        <tr>
          <th colspan="4" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($payable,2)?></th>
		   <th align="right" style="font-weight:bold;"><?php echo number_format($totalb,2)?></th>
		    <th align="right" style="font-weight:bold;"><?php echo number_format($payable,2)?></th>
        </tr>
		</tfoot>
       
      </table></td>
</table>
<?php

}else{ ?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Receipts Analysis: </td>
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
