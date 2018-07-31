<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=Receipts-export.xls");

$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
	?>
<table border="1">
<thead>
<th colspan="4">Receipts Received From  <?php echo $from." to ".$to?></th>
</thead>
    <tr>
    	<th>#</th>
		 <th>Receipt #</th>
               <th>Admno</th>
			   <th>Date Paid</th>
			   <th>Bank Deposited</th>
			   <th>Mode of Pay</th>
			   <th>Amount</th>
	</tr>
	<?php
	//connection to mysql
	  include('includes/dbconnector.php');
	$totalsum=0;
	//query get data
	$sql = mysql_query("select distinct(receipt_no), admno,dateofpay,modeofpay,bank_account,total_amount from finance_feestructures where dateofpay between '$from' and '$to' and statusis= 'CANCELLED' order by receipt_no asc");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['receipt_no'].'</td>
			<td>'.$data['admno'].'</td>
			<td>'.$data['dateofpay'].'</td>
			<td>'.$data['bank_account'].'</td>
			<td>'.$data['modeofpay'].'</td>
			<td>'.number_format($data['total_amount'],2).'</td>
		</tr>
		';
		$no++;
		$totalsum+=$data['total_amount'];
	}
	?>
	 <tfoot>
          <tr>
		  <td colspan="6" align="right"> Total Paid:</td>
            
            <td align="right" style="font-weight:bold;"><?php echo number_format($totalsum,2)?></td>
            
          </tr>
        </tfoot>
</table>