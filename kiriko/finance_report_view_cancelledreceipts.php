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
if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){
 require_once("includes/dbconnector.php"); 

	$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
	
	$sql="select distinct(receipt_no), admno,dateofpay,modeofpay,bank_account,total_amount from finance_feestructures where dateofpay between '$from' and '$to' and statusis='CANCELLED' order by receipt_no asc";
	

?>
 
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Receipts Analysis for the Period: <?php echo $from." to - ".$to?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
		   <td align="center"><a href="finance_report_view_cancelledreceipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_cancelledreceipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
			<td align="right"><a href="csv_cancelledreceipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>" class="noline" title="Click to Export to CSV"><i class="icon icon-orange icon-xls"></i>Export CSV</a></td>
            <td align="right"><a href="finance_report_cancelledreceipts.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-bordered table-striped">
   			<thead>
              <th width="10px">#</th>
			   <th>Receipt #</th>
               <th>Admno</th>
			   <th>Date Paid</th>
			   <th>Bank Deposited</th>
			   <th>Mode of Pay</th>
			   <th>Amount</th>
			   <th></th>
			</tr>
			</thead>
			<tbody>
       <?php
          $result = mysql_query($sql);
		  $num=0;
		  $totalb=0;
  			while($row = mysql_fetch_array($result)){
			$num++;
			?>
  			<tr>
			   <td width="5%"><?php echo $num?></td>
                <td><?php echo $row['receipt_no']?></td>
				<td><?php echo $row['admno']?></td>
				 <td><?php echo $row['dateofpay']?></td>
				  <td><?php echo $row['bank_account']?></td>
				  <td><?php echo $row['modeofpay']?></td>
                <td align="right"><?php echo number_format($row['total_amount'],2)?></td>
				<td><a href="finance_receipt_copy.php?id=<?php echo $row['receipt_no']?>&date4=<?php echo $from?>&date5=<?php echo $to?>"><i class="icon icon-red icon-edit"></i></a></td>
              </tr>
			<?php
			$totalb+=$row['total_amount'];
  			}
			 
			 
			 ?>
		</tbody>
		<tfoot>
        <tr>
          <th colspan="6" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalb,2)?></th>
		  <th></th>
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
			   <th>Bank Deposited</th>
			   <th>Mode of Pay</th>
			   <th>Amount</th>
			   <th></th>
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
