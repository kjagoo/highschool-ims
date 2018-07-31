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
if( (isset($_REQUEST["val1"]) ? $_REQUEST["val1"] : "") || (isset($_REQUEST["val2"]) ? $_REQUEST["val2"] : "")  ){

$from=isset($_REQUEST["val1"]) ? $_REQUEST["val1"] : "";
	$to=isset($_REQUEST["val2"]) ? $_REQUEST["val2"] : "";


$result = mysql_query("select distinct(votehead),sum(votehead_amt)  as votehead_amt from finance_feestructures 
where  receipt_no between $from and $to and statusis='OK' and votehead_amt>0 group by votehead asc;");
$rowscounts=mysql_num_rows($result);
  

?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Cash Book Register: From  <?php echo $from." - ".$to?>
	
	<div style="float:right; margin-right:20px">
        <table width="300px;">
          <tr>
		   <td align="center"><a href="finance_report_view_cashbookregister_bulk.php?val1=<?php echo $from?>&val2=<?php echo $to?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_cashbookregister_bulk.php?val1=<?php echo $from?>&val2=<?php echo $to?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
			<td align="right"><a href="csv_cashbookregister_bulk.php?val1=<?php echo $from?>&val2=<?php echo $to?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-pdf"></i>Export CSV</a></td>
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
		  <th>Votehead</th>
		<th>Amount</th>
          </tr>
        </thead>
        <tbody>
		<?php
			$num=0;
			$totalsum=0;
			$totovers=0;
			while($rowreg = mysql_fetch_array($result)){ 
			$num++;
			?>
			<tr>
			 <td><?php echo $num?></td>
			 <td><?php echo $rowreg['votehead']?></td>
			<td align="right"><?php echo number_format($rowreg['votehead_amt'],2)?></td>
			 
			</tr>
            <?php
			$totalsum+=$rowreg['votehead_amt'];
			}//end of while loop
			
			$result = mysql_query("select votehead_amt  ,votehead from finance_feestructures 
where  receipt_no between $from and $to and statusis='OK' and votehead_amt<0 group by votehead asc;");
			while($rowreg = mysql_fetch_array($result)){ 
			$num++;
			
			$totovers+=$rowreg['votehead_amt'];
			}//end of while loop
		?> 
        <tr>
			 <td><?php echo $num?></td>
			 <td>Overpayments last year</td>
			<td align="right"><?php echo number_format($totovers,2)?></td>
			 
			</tr>
		
        </tbody>
		
        <tfoot>
          <tr>
		  <td colspan="2">Total Paid:</td>
            
            <td align="right" style="font-weight:bold;"><?php echo number_format($totalsum+$totovers,2)?></td>
            
          </tr>
		  <?php
		$result = mysql_query("select distinct(bank_account) as bank_name from finance_feestructures where  statusis='OK' and receipt_no between $from and $to");
		while($rowB = mysql_fetch_array($result)){
		
		$tot=0;
		$bank=str_replace(" ","_",$rowB['bank_name']);
		$results = mysql_query("select sum(votehead_amt) as total from finance_feestructures where receipt_no between $from and $to and bank_account='$bank' and statusis='OK'");
		while($rowsB = mysql_fetch_array($results)){
		$tot=$rowsB['total'];
		}
		?>
		
		<tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;"><?php echo $rowB['bank_name'] ?>:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($tot,2)?></th>
		  <th></th>
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
