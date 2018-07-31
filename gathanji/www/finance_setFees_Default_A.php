<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<script>
function doMath(id) {
 var total_payable = Number(document.getElementById('payable').value);
 
 var txtbox = document.getElementById(id);
 var value = Number(txtbox.value);

 var total=total_payable+value;
 
 document.getElementById('payable').value = Number(total).toFixed(2);


}

</script>
</head>
<body>
<div class="clear"></div>
<?php
 require_once("includes/dbconnector.php"); 
include 'includes/Finance.php';
$finance = new Financials(); 

?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Setting Additional Fees 
	<div style="float:right; margin-right:20px">
		  <table width="150px;"><tr><td align="center"><a href="finance_set_fees.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td><td align="right"><a href="finance_setfees.php" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td></tr></table></div>
	</td>
  </tr>
  <td>
 </td>
 </table>
 
</body>
</html>
