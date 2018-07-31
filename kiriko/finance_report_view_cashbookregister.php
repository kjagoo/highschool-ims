<?php
require_once('auth.php');
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';
include 'includes/Finance.php';

$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$finance = new Financials();

$activity = "Viewed fees register";
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
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>
<?php
if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "")  ){

$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
$votehead=str_replace("_"," ",$_GET['votehead']);

//$result = mysql_query("select * from finance_feestructures where votehead='$votehead' and votehead_amt!=0 and dateofpay between '$from' and '$to' and statusis='OK'  order by receipt_no asc");
$result = mysql_query("select dateofpay,votehead,sum(votehead_amt) as sum,votehead_amt from finance_feestructures where dateofpay between '$from' and '$to' and statusis='OK' and votehead_amt!=0 group by votehead;");

$rowscounts=mysql_num_rows($result);
  

?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Cash Book Register: From  <?php echo $from." - ".$to?>
	
	<div style="float:right; margin-right:20px">
        <table width="300px;">
          <tr>
		   <td align="center"><a href="finance_report_view_cashbookregister.php?date4=<?php echo $from?>&date5=<?php echo $to?>&votehead=<?php echo $votehead?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_cashbookregister.php?date4=<?php echo $from?>&date5=<?php echo $to?> &votehead=<?php echo $votehead?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
			<td align="right"><a href="csv_cashbookregister.php?date4=<?php echo $from?>&date5=<?php echo $to?> &votehead=<?php echo $votehead?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-pdf"></i>Export CSV</a></td>
            <td align="right"><a href="finance_report_cashbookregister.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div>
	</td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>#</th>
		  <th>Date Paid</th>
          <th>Votehead</th>
			<th>Amount</th>
          </tr>
        </thead>
        <tbody>
		<?php
			$num=0;
			$totalsum=0;
			while($rowreg = mysql_fetch_array($result)){ 
			$num++;
			?>
			<tr>
			 <td><?php echo $num?></td>
			<td><?php echo $rowreg['dateofpay']?></td>
			<td><?php echo $rowreg['votehead']?></td>
			<td align="right"><?php echo number_format($rowreg['sum'],2)?></td>
			 
			</tr>
            <?php
			$totalsum+=$rowreg['sum'];
			}//end of while loop
			
		?> 
        
        </tbody>
        <tfoot>
         <tr>
          <th colspan="3" align="right" style="font-weight:bold; margin-right:20px;">Summary of Total Collection:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalsum,2)?></th>
		
        </tr>
		
		<?php
		$result = mysql_query("select distinct(bank_account) as bank_name from finance_feestructures where  statusis='OK' and dateofpay between '$from' and '$to'");
		while($row = mysql_fetch_array($result)){
		
		$tot=0;
		$bank=str_replace(" ","_",$row['bank_name']);
		$results = mysql_query("select sum(votehead_amt) as total from finance_feestructures where dateofpay between '$from' and '$to' and bank_account='$bank' and statusis='OK'");
		while($rows = mysql_fetch_array($results)){
		$tot=$rows['total'];
		}
		?>
		
		<tr>
          <th colspan="3" align="right" style="font-weight:bold; margin-right:20px;"><?php echo $row['bank_name'] ?>:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($tot,2)?></th>
		
        </tr>
		<?php
		}
		
		?>
		
		
		
        </tfoot>
      </table></td>
  </tr>
</table>

<?php
}else{ 

?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Cash Book Register:<?php echo $finance->getFiscalYear()?></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>Receipt</th>
		  <th>Date Paid</th>
            <th>Bank Deposited</th>
			 <th>Mode of Payment</th>
			  <th>Amount</th>
          </tr>
        </thead>
        <tbody>
		
        </tbody>
        <tfoot>
          <tr>
		  <td colspan="4">Summary:</td>
          <td></td> 
          </tr>
        </tfoot>
      </table></td>
  </tr>
</table>
<?php
}
?>
</body>
</html>
