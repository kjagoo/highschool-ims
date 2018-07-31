<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Voteheads Setting page";
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
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>

</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active" href="finance_payables.php">Outstanding GRNs</a></li>
	<li><a  href="finance_payable_list.php">Suppliers List</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Outstanding GRNs
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
		    <td><a href="#openModal"><i class="icon icon-red icon-plus"></i>Add Record</a></td>
            <td align="right"><a href="finance_payables.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="center"><a href="pdf_outstandingGRN.php"><img src="images/printer.png" align="absmiddle" />Print</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
   			<thead>
              <tr> 
			  <th width="10px"></th>
			   <th>Invoice #</th>
			   <th>Payment Ref.</th>
               <th>Supplier</th>
			  <th>Account Payable</th>
			  <th align="right">Amount Due</th>
			</tr>
			</thead>
			<tbody>
        <?php
		  $result = mysql_query("SELECT i.*, p.supplier FROM tbl_invoices as i join purchase_orders p on i.payee_ref=p.po_number and i.i_status='0' order by i.invoice_no desc");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		  $num++;?>
        <tr class='record'>
		  <td><?php echo $num?> </td>
          <td><?php echo $row['invoice_no']?></td>
		  <td><?php echo $row['payee_ref']?> </td>
          <td><?php echo $row['supplier']?> </td>
		   <td><?php echo $row['acc_payable']?> </td>
		  <td align="right"><strong><?php echo $row['amount_due']?> </strong></td>
        </tr>
        <?php 
		
		  	}
			?>
		</tbody>
		
      </table></td>
</table>
	
	
	<div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
		<form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;Outstanding INVOICES</td>
            </tr>
            
			<tr>
              <td class="alterCell" width="25%"><b>Reference #:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="ref" class="inputFields" tabindex="1" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Invoice #:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="ref" class="inputFields" tabindex="1" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Supplier Name:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="code" class="inputFields" tabindex="4" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Supplier Address:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="code" class="inputFields" tabindex="4" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Supplier Telephone:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="code" class="inputFields" tabindex="4" required/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Settings" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
		
		
      </div>
    </div>
	 <?php
	if( isset($_POST['year']) && isset($_POST['term']) && isset($_POST['votehead']) && isset($_POST['code'])){
	require_once("includes/dbconnector.php");
	
	$year=$_POST['year'];
	$term=$_POST['term'];
	$votehead=$_POST['votehead'];
	$code=$_POST['code'];
	
	
	$qury="insert into finance_voteheads (fiscal_year,term,votehead,code) values ('$year','$term','$votehead','$code') on duplicate key update fiscal_year='$year', term='$term', votehead='$votehead', code='$code'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "New Votehead ".$votehead;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Votehead Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_voteheads.php' </script>";
	}
	}
	
?>
	
  </div>
</div>

<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
