<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
 
$func = new Functions();
$activity = "Viewed Chart of Accounts page";
$func->addAuditTrail($activity,$username);


$finance = new Financials(); 
$yr=$finance->getFiscalYear();
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
<div id="page_tabs">
  <ul>
    <li><a  class="active"  href="finance_chartofaccounts.php">Chart of Accounts</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
      <tr style='height:30px;'>
        <td class='dataListHeader' colspan='4'>Chart of Accounts: <?php echo $yr?>
          <div style="float:right; margin-right:20px">
            <table width="200px;">
              <tr>
                <td align="center"><a href="finance_chartofaccounts.php"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
                <td align="right"><a href="pdf_chartofaccounts.php" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
              </tr>
            </table>
          </div></td>
      </tr>
      <td><table width="100%" class="table table-bordered">
            <tbody>
			<tr>
			<td colspan="2"><strong>Current Assets</strong></td>
			</tr>
			<tr>
			<td colspan="2">Accounts Receivables</td>
			<td>Debit</td>
			<td>Credit</td>
			<td>Balance</td>
			</tr>
			<?php
			$sql="select * from finance_estimates where fiscal_yr='$yr' order by votehead asc";
			 $result = mysql_query($sql);
			 $num=0;
			  while($row = mysql_fetch_array($result)){
			  $num++;
			   ?>
			 <tr>
			  <td class="alterCell" width="25%" align="center"><?php echo $row['votehead']?></td>
			  <td align="right"><?php echo number_format($row['amount'],2)?> </td>
			</tr>
			<?php
			}
			?>
			<tr>
			<td colspan="2"><strong>Current Liabilities</strong></td>
			</tr>
			<tr>
			<td colspan="2">Accounts Payable</td>
			</tr>
			
            </tbody>
          </table></td>
    </table>
  </div>
</div>
</body>
</html>
