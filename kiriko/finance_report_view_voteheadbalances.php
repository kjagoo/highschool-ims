<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
  include 'includes/Finance.php';
  $finacial= new Financials();
  
$func = new Functions();
$activity = "Viewed Votehead Balances page";
$func->addAuditTrail($activity,$username);
	
$thisyear=$finacial->getFiscalYear();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
</head>
<body>
<div class="clear"></div>

<?php
if(isset($_GET['year'])){
 require_once("includes/dbconnector.php"); 



	$finance = $_GET['year']; 
	$form = $_GET['form'];
	//$votehead = $_GET['votehead'];
	
function getArrearsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(fb.balance),0) as arrears from finance_balances as fb 
inner join studentdetails sd on fb.admno=sd.admno and fb.updated='$yr' and sd.form='$form' and fb.balance>0");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['arrears'];
 	}

return $arrears;
}

function getPaidArrearsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(ff.votehead_amt),0) as arrears from finance_feestructures as ff 
inner join studentdetails sd on ff.admno=sd.admno and ff.year='$yr' and sd.form='$form' and votehead='Arrears'");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['arrears'];
 	}

return $arrears;
}	


function getOverpaymentsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(fb.balance),0) as overs from finance_balances as fb 
inner join studentdetails sd on fb.admno=sd.admno and fb.updated='$yr' and sd.form='$form' and fb.balance<0");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['overs'];
 	}

return $arrears;
}
function getPaidOverpaymentsPerForm($yr,$form){
$arrears=0;
$arr = mysql_query("select COALESCE(SUM(ff.votehead_amt),0) as overs from finance_feestructures as ff 
inner join studentdetails sd on ff.admno=sd.admno and ff.year='$yr' and sd.form='$form' and votehead='Overpayments'");
	while ($rowpai = mysql_fetch_array($arr)) {
	$arrears=$rowpai['overs'];
 	}

return $arrears;
}	

?>
 
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Votehead Balances for the Year: <?php echo $finance?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
            <td align="center"><a href="finance_report_view_voteheadbalances.php?year=<?php echo $finance?>&form=<?php echo $form?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_voteheadbalances.php?year=<?php echo $finance?>&form=<?php echo $form?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
            <td align="right"><a href="finance_report_voteheadbalances.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			  <th width="10px">Ref</th>
			   <th>Votehead</th>
               <th>Expected</th>
			   <th>Paid</th>
			   <th>Balance</th>
			</tr>
			</thead>
			<tbody>
        <?php
		$sql="select DISTINCT(fv.votehead) from finance_voteheads as fv
inner join finance_fees ff on fv.fiscal_year=ff.fiscal_yr and
fv.fiscal_year='$finance' and ff.form='$form' order by fv.votehead asc";//"select * from finance_estimates where fiscal_yr='$finance' order by votehead asc";
		  $result = mysql_query($sql);
		 
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  
		  $num=0;
		  $totalb=0;
		  $totalbs=0;
		  $totalp=0;
		  $debit=0;
		  while($row = mysql_fetch_array($result)){ 
		  
		  $num++;
		  $debit=$finacial->getPaidFeeByVotehead($finance,$row['votehead'],$form);
		  
		  $vote=$row['votehead'];
		  $val=0;
		   $resulta = mysql_query("select sum(amount) as amount from finance_fees where votehead='$vote' and form='$form' and fiscal_yr='$finance'");
		    while($rowa = mysql_fetch_array($resulta)){ 
			$val=$rowa['amount'];
			}
		  ?>
        <tr>
		 <td><?php echo $num?></td>
          <td class="alterCell" width="25%"><?php echo $row['votehead']?></td>
          <td align="right"><?php echo number_format(($finacial->getEstimateProjection($row['votehead'],$finance,$form,$val)),2)?><?php //echo number_format($val,2)?> </td>
		  <td align="right"><?php echo number_format($debit,2)?></td>
		  <td align="right"><?php echo number_format((($finacial->getEstimateProjection($row['votehead'],$finance,$form,$val))-$debit),2)?></td>
        </tr>
		
        <?php 
		  $totalb+=($finacial->getEstimateProjection($row['votehead'],$finance,$form,$val));
		  $totalbs+=$debit;
		  $totalp+=(($finacial->getEstimateProjection($row['votehead'],$finance,$form,$val))-$debit);
		 }
			?>
		<tr>
		 <td><?php echo $num+1?></td>
          <td class="alterCell" width="25%">Arrears</td>
          <td align="right"><?php echo  number_format(getArrearsPerForm(($finance-1),$form),2)?></td>
		  <td align="right"><?php echo number_format(getPaidArrearsPerForm($finance,$form),2)?></td>
		  <td align="right"><?php echo number_format((getArrearsPerForm(($finance-1),$form)-getPaidArrearsPerForm($finance,$form)),2)?></td>
        </tr>
		<tr>
          <td colspan="2">Pre-Paid Fees <?php echo $finance?></td>
          <td align="right"><?php echo  number_format(getOverpaymentsPerForm($finance-1,$form),2)?></td>
		  <td align="right"><?php echo number_format(getPaidOverpaymentsPerForm($finance,$form),2)?></td>
		  <td align="right"></td>
        </tr>
		</tbody>
		<tfoot>
        <tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format(($totalb+getArrearsPerForm(($finance-1),$form)),2)?></th>
		 <th align="right" style="font-weight:bold;"><?php echo number_format(($totalbs+getPaidArrearsPerForm($finance,$form))+getPaidOverpaymentsPerForm($finance,$form),2)?></th>
		  <th align="right" style="font-weight:bold;"><?php echo number_format(($totalp+(getArrearsPerForm(($finance-1),$form)-getPaidArrearsPerForm($finance,$form)))-getPaidOverpaymentsPerForm($finance,$form),2)?></th>
        </tr>
		
		</tfoot>
        <?php  }
		  ?>
      </table></td>
</table>
<?php

}else{ ?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Votehead Balances: <?php echo $thisyear?> </td>
  </tr>
  <tr>
  <td>
<table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			  <th width="10px">Ref</th>
			   <th>Votehead</th>
               <th>Expected</th>
			   <th>Paid</th>
			   <th>Balance</th>
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
