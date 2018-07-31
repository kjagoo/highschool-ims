<?php
require_once('auth.php');
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';
include 'includes/fees.php';

$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$fee = new fees();

$activity = "Viewed fees balances";
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
if( isset($_GET['year']) && isset($_GET['form']) && isset($_GET['term'])){

$year=$_GET['year'];
$form=$_GET['form'];
$stream=$_GET['stream'];
$term=$_GET['term'];

$val1=$_GET['val1'];
$val2=$_GET['val2'];

	$nextterm="";
	$nextterm1="";
	$nextyear1="";
	$nextyear="";
	
	$lastyr="";
	$lastrm="";
	
	if($term=='TERM 1'){
	$nextterm="TERM 2";
	$nextterm1="TERM 3";
	$nextyear=$year;
	$nextyear1=($year);
	
	$lastyr=$year-1;
	$lastrm="TERM 3";
	
	}
	if($term=='TERM 2'){
	$nextterm="TERM 3";
	$nextterm1="TERM 1";
	$nextyear1=($year+1);
	$nextyear=($year);
	
	$lastyr=$year;
	$lastrm="TERM 1";
	}
	if($term=='TERM 3'){
	$nextterm="TERM 1";
	$nextterm1="TERM 1";
	$nextyear1=($year+1);
	$nextyear=($year+1);
	
	$lastyr=$year;
	$lastrm="TERM 2";
	}
?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Fees Balances: <?php echo $form." ".$stream." ".$term." Year ".$year?>
      <div style="float:right; margin-right:20px">
        <table width="300px;">
          <tr>
            <td align="center"><a href="finance_report_view_feesbalances.php?year=<?php echo $year?>&form=<?php echo $form?>&stream=<?php echo $stream?>&term=<?php echo $term?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>" class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            <td align="right"><a href="pdf_feesbalances.php?year=<?php echo $year?>&form=<?php echo $form?>&stream=<?php echo $stream?>&term=<?php echo $term?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
            <td align="right"><a href="send_sms_notifyall_feesbalances.php?year=<?php echo $year?>&form=<?php echo $form?>&stream=<?php echo $stream?>&term=<?php echo $term?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>" class="noline" title="Send a Common Notification to All"><i class="icon icon-orange icon-mail-closed"></i>Notify All</a></td>
            <td align="right"><a href="finance_report_fees.php" class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>close</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10px"> #</th>
            <th>Adm No</th>
            <th>Student Name</th>
			<th align="right">B/F</th>
            <th align="right">Fees <?php echo $term?> </th>
			<th align="right">Paid</th>
			<th align="right">Balance</th>
			
            <th> </th>
          </tr>
        </thead>
        <tbody>
		<?php
		
		
		$num=0;
		$totals=0;
		$bal=0;
		$over=0;
		$paids=0;
		$payables=0;
		$sql="select distinct(fsi.admno),sd.*   from finance_student_invoices  as fsi inner join studentdetails as sd on fsi.admno=sd.admno and sd.form='$form' and sd.class='$stream' ";
		 $result = mysql_query($sql);
		 while($row=mysql_fetch_array($result)){ 
		 $num++;
		 $admno=$row['admno'];

	$lastyearfees=$fee->getInvoiceAmt(($year-1),'TERM 1',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 2',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 3',$admno);
	$totalpaidamountlastyear=$fee->getPaidAmt(($year-1),$admno,'TERM 1')+$fee->getPaidAmt(($year-1),$admno,'TERM 2')+$fee->getPaidAmt(($year-1),$admno,'TERM 3');
	
	
	$bal=$lastyearfees-$totalpaidamountlastyear+$fee->getBF($year,$admno,'TERM 1');
	
	$payable=$fee->getInvoiceAmt(($year),$term,$admno);
	$added=$fee->getAddedAmt($year,$admno,$term);
	
	$paid=$fee->getPaidAmt(($year),$admno,$term);

	
	$T1balan=($fee->getInvoiceAmt(($year),"TERM 1",$admno)+$fee->getAddedAmt($year,$admno,'TERM 1')+$bal)-$fee->getPaidAmt(($year),$admno,"TERM 1");
	$T2balan=($fee->getInvoiceAmt(($year),"TERM 2",$admno)+$fee->getAddedAmt($year,$admno,'TERM 2')+$T1balan)-$fee->getPaidAmt(($year),$admno,"TERM 2");
	$T3balan=($fee->getInvoiceAmt(($year),"TERM 3",$admno)+$fee->getAddedAmt($year,$admno,'TERM 3')+$T2balan)-$fee->getPaidAmt(($year),$admno,"TERM 3");
	if($term=='TERM 1'){
		$balanc=$T1balan;
		$balBF=$bal;
	}
	if($term=='TERM 2'){
		$balanc=$T2balan;
		$balBF=$T1balan;
	}
	if($term=='TERM 3'){
		$balanc=$T3balan;
		$balBF=$T2balan;
	}
		 ?>
 		<tr>
		<td><?php echo $num?></td>
		<td><?php echo $admno?></td>
		<td><?php echo $row['fname']." ".$row['sname']." ".$row['lname']?></td>
		<td align="right" style="font-weight:bold;">
		<?php echo $balBF; ?>
		
		</td>
		<td align="right" style="font-weight:bold;"><?php echo number_format($payable+$added,2)?></td>
		<td align="right" style="font-weight:bold;"><?php echo number_format($paid,2)?></td>
		<td align="right" style="font-weight:bold;"><?php echo number_format(/*($payable+$added+$bal)-$paid*/$balanc,2)?></td>
		
		
		<td align="center"><a href='send_sms_feesbalance.php?ref=<?php echo $admno?>&bal=<?php echo ($balanc)?>&term=<?php echo $term?>&year=<?php echo $year?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>'><i class="icon icon-green icon-mail-closed"></i></a></td>
		 </tr>
 		<?php
		$payables+=$payable+$added+$bal;
		$paids+=$paid;
		$totals+=($payable+$added+$bal)-$paid;
		}
	
		?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" align="right" style="font-weight:bold; margin-right:20px;">Total Balances:</th>
			<th align="right" style="font-weight:bold;"><?php echo number_format($payables,2)?></th>
			<th align="right" style="font-weight:bold;"><?php echo number_format($paids,2)?></th>
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
    <td class="dataListHeader">Fees Balances</td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="10px"> #</th>
            <th>Adm No</th>
            <th>Student Name</th>
            <th>Balance</th>
            <th> </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3" align="right" style="font-weight:bold; margin-right:20px;">Total Balances:</th>
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
