<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
  include 'includes/BalanceSheet.php';
$func = new Functions();
$balancesheet = new BalanceSheet();

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
if(isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : ""){
$asat = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
$str =str_replace("-","",$asat);
 $dated= date('F j Y', strtotime($str));
 $year=date('Y', strtotime($str));
 $month=date('m', strtotime($asat));

?>
 <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Balance Sheet as at:  <?php echo $dated?>
      <div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
            <td align="center"><a href="finance_report_view_balancesheet.php?date4=<?php echo $asat?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_balancesheet.php?asat=<?php echo $asat?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
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
			   <th><strong>Assets</strong></th>
			   <th colspan="2" align="center"><strong>Amount</strong></th>
			</tr>
			</thead>
			<tbody>
			 <tr>
			   <td>Cash</td>
			   <td align="right"><?php echo number_format($balancesheet->getCash($year),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getCash($year-1),2);?></td>
			</tr>
			<tr>
			   <td>Inventory</td>
			   <td align="right"><?php echo number_format($balancesheet->getInventory($year),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getInventory($year-1),2);?></td>
			</tr>
			<tr>
			   <td>Receivables</td>
			    <td align="right"><?php echo number_format($balancesheet->getReceivables($year),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getReceivables($year-1),2);?></td>
			</tr>
			<tr>
			   <td align="right"><strong>Total Assets</strong></td>
			   <td align="right"><strong><?php echo $balancesheet->getTotalAssets($year);?></strong></td>
			    <td align="right"><strong><?php echo $balancesheet->getTotalAssets($year-1);?></strong></td>
			</tr>
			<thead>
              <tr>
			   <th><strong>Liabilities</strong></th>
			   <th colspan="2" align="center"><strong>Amount</strong></th>
			  </tr>
			 </thead>
			
			 <tr>
			   <td>Accounts Payable</td>
			   <td align="right"><?php echo number_format($balancesheet->getAccountsPayables(),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getAccountsPayables(),2);?></td>
			</tr>
			 <tr>
			   <td>Salaries Payable</td>
			   <td align="right"><?php echo number_format($balancesheet->getSalariesPayables($year,$month),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getSalariesPayables($year-1,$month),2);?></td>
			</tr>
			 <tr>
			   <td>Interests Payable</td>
			  <td align="right"><?php echo number_format($balancesheet->getInterestsPayables($year,$month),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getInterestsPayables($year-1,$month),2);?></td>
			</tr>
			 <tr>
			   <td>Taxes Payable</td>
			 <td align="right"><?php echo number_format($balancesheet->getTaxesPayables($year,$month),2);?></td>
			    <td align="right"><?php echo number_format($balancesheet->getTaxesPayables($year-1,$month),2);?></td>
			</tr>
			<tr>
			   <td align="right"><strong>Total Liabilities</strong></td>
			  <td align="right"><strong><?php echo $balancesheet->getTotalLiabilities($year,$month);?></strong></td>
			    <td align="right"><strong><?php echo $balancesheet->getTotalLiabilities($year-1,$month);?></strong></td>
			</tr>
			</thead>
			</tbody>
			</table>
			
  </td>
 </tr>
 </table>	
 <?php
 
 }
 
 ?>
</html>
