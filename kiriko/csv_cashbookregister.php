<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=CASHBOOKREGISTER-export.xls");

$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
	$votehead=$_GET['votehead'];?>
<table border="1">
<thead>
<th colspan="4">Cash Book Register  <?php echo $votehead."  ".$from." to ".$to?></th>
</thead>
    <tr>
    	<th>#</th>
		  <th>Receipt</th>
		  <th>Date Paid</th>
           <th>Bank Deposited</th>
		<th>Mode of Payment</th>
		<th>Amount</th>
	</tr>
	<?php
	//connection to mysql
	  include('includes/dbconnector.php');
	$totalsum=0;
	//query get data
	$sql = mysql_query("select * from finance_feestructures where votehead='$votehead' and votehead_amt>0 and dateofpay between '$from' and '$to' order by receipt_no asc");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['receipt_no'].'</td>
			<td>'.$data['dateofpay'].'</td>
			<td>'.$data['bank_account'].'</td>
			<td>'.$data['modeofpay'].'</td>
			<td>'.number_format($data['votehead_amt'],2).'</td>
		</tr>
		';
		$no++;
		$totalsum+=$data['votehead_amt'];
	}
	?>
	 <tfoot>
          <tr>
		  <td colspan="5" align="right"><?php echo $votehead?> Total Paid:</td>
            
            <td align="right" style="font-weight:bold;"><?php echo number_format($totalsum,2)?></td>
            
          </tr>
		  <?php
		$result = mysql_query("SELECT * FROM bank_accounts order by bank_name asc");
		while($row = mysql_fetch_array($result)){
		
		$tot=0;
		$bank=str_replace(" ","_",$row['bank_name']);
		$results = mysql_query("select sum(votehead_amt) as total from finance_feestructures where dateofpay between '$from' and '$to' and bank_account='$bank' and statusis='OK' and votehead='$votehead'");
		while($rows = mysql_fetch_array($results)){
		$tot=$rows['total'];
		}
		?>
		
		<tr>
          <th colspan="5" align="right" style="font-weight:bold; margin-right:20px;"><?php echo $row['bank_name'] ?>:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($tot,2)?></th>
		 
        </tr>
		<?php
		}
		
		?>
		
		<?php
		$ctot=0;
		$resultsc = mysql_query("select sum(votehead_amt) as total from finance_feestructures where dateofpay between '$from' and '$to' and modeofpay='CASH' and statusis='OK' and votehead='$votehead'");
		while($rowsc = mysql_fetch_array($resultsc)){
		$ctot=$rowsc['total'];
		}
		?>
		<tr>
          <th colspan="5" align="right" style="font-weight:bold; margin-right:20px;">Cash:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($ctot,2)?></th>
		
        </tr>
        </tfoot>
</table>