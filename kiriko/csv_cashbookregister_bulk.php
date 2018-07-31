<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=CASHBOOKREGISTER-export.xls");

$from=isset($_REQUEST["val1"]) ? $_REQUEST["val1"] : "";
	$to=isset($_REQUEST["val2"]) ? $_REQUEST["val2"] : "";
	//$votehead=$_GET['votehead'];?>
<table border="1">
<thead>
<th colspan="3">Cash Book Register  <?php echo $from." to ".$to?></th>
</thead>
    <tr>
    	<th>#</th>
		  <th>Votehead</th>
		<th>Amount</th>
	</tr>
	<?php
	//connection to mysql
	  include('includes/dbconnector.php');
	$totalsum=0;
	//query get data
	$sql = mysql_query("select distinct(sum(votehead_amt))  as votehead_amt,votehead from finance_feestructures 
where  receipt_no between $from and $to group by votehead asc;");
	$no = 1;
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['votehead'].'</td>
			<td>'.number_format($data['votehead_amt'],2).'</td>
		</tr>
		';
		$no++;
		$totalsum+=$data['votehead_amt'];
	}
	?>
	 <tfoot>
          <tr>
		  <td colspan="2" align="right"><?php echo $from." to ".$to;?> Total Paid:</td>
            
            <td align="right" style="font-weight:bold;"><?php echo number_format($totalsum,2)?></td>
            
          </tr>
		   <?php
		$result = mysql_query("SELECT * FROM bank_accounts order by bank_name asc");
		while($row = mysql_fetch_array($result)){
		
		$tot=0;
		$bank=str_replace(" ","_",$row['bank_name']);
		$results = mysql_query("select sum(votehead_amt)   as votehead_amt from finance_feestructures 
where  receipt_no between $from and $to and bank_account='$bank' and statusis='OK'");
		while($rows = mysql_fetch_array($results)){
		$tot=$rows['votehead_amt'];
		}
		?>
		
		<tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;"><?php echo $row['bank_name'] ?>:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($tot,2)?></th>
		  <th></th>
        </tr>
		<?php
		}
		
		?>
		
		<?php
		$ctot=0;
		$resultsc = mysql_query("select sum(votehead_amt) as total from finance_feestructures where receipt_no between '$from' and '$to' and modeofpay='CASH' and statusis='OK'");
		while($rowsc = mysql_fetch_array($resultsc)){
		$ctot=$rowsc['total'];
		}
		?>
		<tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;">Cash:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($ctot,2)?></th>
		  <th></th>
        </tr>
        </tfoot>
</table>