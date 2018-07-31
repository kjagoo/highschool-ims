<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
include("includes/Accounting.php");
  include 'includes/Finance.php';
  
  $finacial= new Financials();
  
$func = new Functions();
$accounting = new Accounting();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>

<style type="text/css">
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<!-- Initiate tablesorter script -->

<script type="text/javascript">
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};
	</script>
	
<script language="javascript" src="scripts/calendar.js"></script>
</head>
<?php
 $opbal=0;

   if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){
	
		$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
		$today=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
		$mainaccount=$_GET['mainaccount'];
		
		$str =str_replace("-","",$from);
		$year1=date('Y', strtotime($str));
	 
		$str2 =str_replace("-","",$today);
		$year2=date('Y', strtotime($str2));
	 
		$at= "Trial Balance From $from to   ".$today;
		$pdf='pdf_tb.php?date4='.$from.'&date5='.$today;
		$csv='csv_tb.php?date4='.$from.'&date5='.$today;
		
		if($mainaccount=='Parents'){
		$voteheadacct='finance_voteheads';	
		}
		if($mainaccount=='Operations'){
		$voteheadacct='finance_operationalvoteheads';	
		}
		if($mainaccount=='Tution'){
		$voteheadacct='finance_tuitionvoteheads';	
		}
		
	
?>
 <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='5'><?php echo $at?>
      <div style="float:right; margin-right:20px">
        <table width="100%">
          <tr>
            <td align="center"><a href="finance_report_view_trialbalance.php?date4=<?php echo $from?>&date5=<?php echo $today?>&mainaccount=<?php echo $mainaccount?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_trialbalance.php?from=<?php echo $from?>&to=<?php echo $today?>&mainaccount=<?php echo $mainaccount?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
			<td align="right"><a href="csv_tb.php?from=<?php echo $from?>&to=<?php echo $today?>&mainaccount=<?php echo $mainaccount?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-xls"></i> Export CSV</a></td>
            <td align="right"><a href="finance_report_analysis.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
  <td>
  		<table width="80%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			   <th align="center"><strong>Votehead</strong></th>
			   <th align="center"><strong>LF</strong></th>
			   <th align="center"><strong>Debit</strong></th>
			   <th align="center"><strong>Credit</strong></th>
			   <th align="center"><strong>Balance</strong></th>
			</tr>
			</thead>
			<tbody>
			 
			<!--select operating Banks-->
					<?php
					$totdebit=0;
					$totcredit=0;
					$bankin=0;
					$bankout=0;
					$result = mysql_query("select * from bank_accounts order by bank_name desc");
					while($rowreg = mysql_fetch_array($result)){ 
					
					$bankin=$accounting->getRevenueReceivedBank($from, $today,$rowreg['account_number'],$mainaccount);
					$bankout=$accounting->getExpensesDoneBank($from, $today,$rowreg['account_number'],$mainaccount);
					
					?>
					<tr>
					 <td><?php echo str_replace("_"," ",$rowreg['bank_name'])?></td>
                      <td></td>
						<td align="right"><?php echo number_format($bankin,2)?></td>
						<td align="right"><?php echo number_format($bankout,2)?></td>
						<td align="right"><?php echo number_format($bankin-$bankout,2)?></td>
					</tr>
						<?php
						$totdebit+=$bankin;
						$totcredit+=$bankout;
						//$debitgrandTotals+=($bankin+$bankedfee)-$bankout;
					}
					?>
				   <!--end of banks-->
			<?php
			//get all the available voteheads
			 $num=000;
			
			$result = mysql_query("select distinct(votehead) from $voteheadacct where fiscal_year between '$year1' and '$year2' order by votehead asc");
			 while($row = mysql_fetch_array($result)){
			 $num++;
			?>
			<tr>
			  <td class="alterCell" width="25%"><?php echo str_replace("_"," ",$row['votehead'])?></td>
			   <td align="center"><?php echo sprintf('%02d',$num)?></td>
			   
				<td align="right"><?php echo number_format($accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount),2);?></td>
				<td class="alterCell" align="right"><?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount),2);?></td>
				
				<td align="right"> <?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount)-($accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount)) ,2) ?></td>
			</tr>
			<?php
			
			
			$totcredit+=$accounting->getPaidFeeByVotehead($from,$today,$row['votehead'],$mainaccount);
			$totdebit+=$accounting->getExpensesDonePerVotehead($from,$today,$row['votehead'],$mainaccount)+$accounting->getPBDoneAccount($from, $today,$row['votehead'],$mainaccount);
			
			}
			?>
			<?php
			//get all the available voteheads
			
			
			?>
			<?php
			//get all the available voteheads
			
			?>
			
		<tr>
          <td class="alterCell" width="25%">Other Incomes</td>
		   <td align="center"><?php echo sprintf('%02d',($num+6))?></td>
          <td align="right"></td>
		  <td class="alterCell" align="right"><?php echo number_format($accounting->getPaidFeeByVotehead($from,$today,'Income',$mainaccount),2);?></td>
		   <td align="right"></td>
        </tr>
			</thead>
		<tr>
          <td class="alterCell" width="20%" align='right'>TOTALS</td>
		  <td class="alterCell" align="right"></td>
		  <td class="alterCell" align="right"><?php echo number_format(($totdebit),2)?></td>
		  <td class="alterCell" align="right"><?php echo number_format(($totcredit+$accounting->getPaidFeeByVotehead($from,$today,'Income',$mainaccount)),2)?></td>
		   <td align="right"></td>
        </tr>
			</tbody>
			</table>
			
  </td>
 </tr>
 </table>	
 <?php
 }else{
?>

<table width="80%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			   <th align="center"><strong>Votehead</strong></th>
			   <th align="center"><strong>LF</strong></th>
			   <th align="center"><strong>Debit</strong></th>
			   <th align="center"><strong>Credit</strong></th>
			   <th align="center"><strong>Balance</strong></th>
			</tr>
			</thead>
			<tbody>
</tbody>
</table>
<?php
			
	 
 }
 ?>
</html>
