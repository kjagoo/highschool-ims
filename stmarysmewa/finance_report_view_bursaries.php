<?php
require_once('auth.php');
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';
include 'includes/Finance.php';

$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$finance = new Financials();

$activity = "Viewed fees bursaries";
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
<?php
if( isset($_GET['year'])  && isset($_GET['term'])){

$year=$_GET['year'];
$term=$_GET['term'];

 $sql="SELECT b.*, 
(SELECT COUNT(ba.admno) FROM bursaries_allocations ba WHERE ba.cheque_no = b.cheque_no AND b.term='$term' AND b.year='$year') AS totalcovered 
FROM bursaries b  WHERE b.term='$term' AND b.year='$year' GROUP BY b.cheque_no";

?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Bursaries Report: Term: <?php echo $term."  Year: ".$year?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
            <td align="center"><a href="finance_report_view_bursaries.php?year=<?php echo $year?>&term=<?php echo $term?>" class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			 <td align="right"><a href="pdf_bursarieslist.php?year=<?php echo $year?>&term=<?php echo $term?>" class="noline" title="Click to Print A list of all students with bursaries" target="_blank"><i class="icon icon-orange icon-print"></i>Students List</a></td>
            <td align="right"><a href="pdf_bursaries.php?year=<?php echo $year?>&term=<?php echo $term?>" class="noline" title="Click to Print summarised report" target="_blank"><i class="icon icon-orange icon-print"></i>Print Report</a></td>
            
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10px"> #</th>
            <th>Cheque #</th>
            <th>From</th>
			<th>Bank Deposited</th>
            <th>Covered Students</th>
			<th>Amount</th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
		<?php
		$num=0;
		$totals=0;
		 $studs=0;
		 $result = mysql_query($sql);
		 while($row=mysql_fetch_array($result)){ 
		 $num++;
		 
		 ?>
 		<tr>
		<td><?php echo $num?></td>
		<td><?php echo $row['cheque_no']?></td>
		<td><?php echo $row['cheque_from']?></td>
		<td><?php echo $row['account_no']?></td>
		<td align="right"><?php echo $row['totalcovered']?></td>
		
		<td align="right" style="font-weight:bold;"><?php echo number_format($row['amount'],2)?></td>
		<td align="center"></td>
		 </tr>
 		<?php
		$totals+=$row['amount'];
		$studs+=$row['totalcovered'];
		}
		
		?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
			<th align="right" style="font-weight:bold; margin-right:20px;"><?php echo $studs?></th>
            <th align="right" style="font-weight:bold;"><?php echo number_format($totals,2)?></th>
            <th></th>
          </tr>
        </tfoot>
      </table></td>
  </tr>
</table>
<?php

}else{ ?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Bursaries Report</td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10px"> #</th>
            <th>Cheque #</th>
            <th>From</th>
            <th>Covered Students</th>
			<th>Bank Deposited</th>
			<th>Amount</th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="5" align="right" style="font-weight:bold; margin-right:20px;">Total Amount:</th>
            <th align="right" style="font-weight:bold;"></th>
            <th></th>
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
