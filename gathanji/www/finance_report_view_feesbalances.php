<?php
require_once('auth.php');
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';
include 'includes/Finance.php';

$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$finance = new Financials();

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
$term=$_GET['term'];

$val1=$_GET['val1'];
$val2=$_GET['val2'];

/*if($term=="TERM 1"){
$myterm=1;
}
if($term=="TERM 2"){
$myterm=2;
}
if($term=="TERM 3"){
$myterm=3;
}*/


if($val1=="" || $val2==""){
$sql="select s.admno,s.fname,s.sname,s.lname, 
(select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form') as payable,
(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno) as paid,
   ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno)) as bal
	 from studentdetails as s 
 inner join finance_fees  as ff on ff.form=s.form 
	where s.form='$form' and ff.fiscal_yr='$year' group by s.admno";

}else{
 $sql="select s.admno,s.fname,s.sname,s.lname, 
(select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form') as payable,
(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno) as paid,
   
   ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno)) as bal
	 from studentdetails as s 
 inner join finance_fees  as ff on ff.form=s.form 
	where s.form='$form' and ff.fiscal_yr='$year'  group by admno
	having 
	((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno))>=$val1
    and ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno))
	 <=$val2";
}

function getBalance($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='$year' and term='$term'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}
	function getPaidAmountNextTerm($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT sum(votehead_amt) as amount from finance_feestructures where admno='$admno' and  year='$year' and term='$term' and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}	
	
	$nextterm="";
	$nextterm1="";
	$nextyear1="";
		$nextyear="";
		if($term=='TERM 1'){
		$nextterm="TERM 2";
		$nextterm1="TERM 3";
		$nextyear=$year;
		$nextyear1=($year);
		}
		if($term=='TERM 2'){
		$nextterm="TERM 3";
		$nextterm1="TERM 1";
		$nextyear1=($year+1);
		$nextyear=($year);
		}
		if($term=='TERM 3'){
		$nextterm="TERM 1";
		$nextterm1="TERM 1";
		$nextyear1=($year+1);
		$nextyear=($year+1);
		}
?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Fees Balances: <?php echo $form." ".$term." Year ".$year?>
      <div style="float:right; margin-right:20px">
        <table width="300px;">
          <tr>
            <td align="center"><a href="finance_report_view_feesbalances.php?year=<?php echo $year?>&form=<?php echo $form?>&term=<?php echo $term?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>" class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            <td align="right"><a href="pdf_feesbalances.php?year=<?php echo $year?>&form=<?php echo $form?>&term=<?php echo $term?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
            <td align="right"><a href="pdf_finance_feesbalances.php" class="noline" title="Send a Common Notification to All"><i class="icon icon-orange icon-mail-closed"></i>Notify All</a></td>
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
			<th align="right"><?php echo $nextterm." ".$nextyear?> Paid</th>
			<th align="right"><?php echo $nextterm1." ".$nextyear1?> Paid</th>
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
		 $result = mysql_query($sql);
		 while($row=mysql_fetch_array($result)){ 
		 $num++;
		 
		 ?>
 		<tr>
		<td><?php echo $num?></td>
		<td><?php echo $row['admno']?></td>
		<td><?php echo $row['fname']." ".$row['sname']." ".$row['lname']?></td>
		<td align="right" style="font-weight:bold;"><?php echo getBalance( $row['admno'],($year-1),$term)?></td>
		<td align="right" style="font-weight:bold;"><?php echo number_format($row['payable'],2)?></td>
		<td align="right" style="font-weight:bold;"><?php echo number_format($row['paid'],2)?></td>
		
		<?php
		$bal=((getBalance($row['admno'],($year-1),$term))+$row['payable'])-$row['paid'];
		if($bal>$row['payable']){ ?>
		<td align="right" style="font-weight:bold;"><?php echo number_format($bal,2)?></td>
		<?php
		$over+=$bal;
		}else{ ?>
		<td align="right" style="font-weight:bold;"><?php echo number_format($bal,2)?></td>
		<?php
		$totals+=$bal;
		}
	
		?>
		<td align="right" style="font-weight:bold;"><?php echo number_format( (getPaidAmountNextTerm($row['admno'],$nextyear,$nextterm)),2)?></td>
		<td align="right" style="font-weight:bold;"><?php echo number_format( (getPaidAmountNextTerm($row['admno'],$nextyear1,$nextterm1)),2)?></td>
		
		<td align="center"><i class="icon icon-green icon-mail-closed"></i></td>
		 </tr>
 		<?php
		$paids+=$row['paid'];
		}
		
		?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" align="right" style="font-weight:bold; margin-right:20px;">Total Balances:</th>
			 <th align="right" style="font-weight:bold;"><?php echo number_format($paids,2)?></th>
            <th align="right" style="font-weight:bold;"><?php echo number_format($totals,2)?></th>
			<th></th>
            <th></th>
			 <th></th>
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
