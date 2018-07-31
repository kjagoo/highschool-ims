<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed received LPO page";
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
<script language="javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="js/scriptadd.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<SCRIPT type="text/javascript">

pic1 = new Image(16, 16); 
pic1.src = "images/loader.gif";

$(document).ready(function(){

$("#ponumber").change(function() { 

var usr =$("#ponumber").val();


$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check.php",  
    data: "ponumber="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#ponumber").removeClass('object_error'); // if necessary
		$("#ponumber").addClass("object_ok");
		$(this).html('&nbsp;<img src="images/tick.gif" align="absmiddle">');
		$("#deliverlyno").val($("#ponumber").val());
	}  
	else  
	{  
		$("#ponumber").removeClass('object_ok'); // if necessary
		$("#ponumber").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 



});

});

</SCRIPT>

</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active" href="finance_inventory.php">Receive Purchase Order</a></li>
    <li><a  href="finance_inventory_received.php">Received Purchase Orders</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
   $date=date("Y-m-d H:i:s");
		 $y=date("Y");
		 $m=date("m");
		 $d=date("d");
		 $hr=date("H");
		 $min=date("i");
		$sec=date("s");
		$hcodes=$y.$m.$d.$hr;
			$mins=$min.$sec;
	
			$hcode=$hcodes.$mins;
	?>
    <form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post">
      <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Receive Purchase Order</td>
        </tr>
        <tr>
          <td valign="top" width="50%"><fieldset>
            <legend>Order Initiation Details</legend>
            <table width="100%">
              <tr>
                <td>PO #:</td>
                <td><input type="text" name="ponumber" id="ponumber"  style="background-color:#FFFFCC" class="inputFields" required="required"/></td>
                <td align="right"><div id="status"></div></td>
              </tr>
              <tr>
                <td>Delivery #:</td>
                <td><input type="text" name="deliverlyno" id="deliverlyno"  style="background-color:#FFFFCC" class="inputFields" required="required"/></td>
              </tr>
              <tr>
                <td>Delivery Date:</td>
                <td><?php
					require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("date4", true, false);
					  $myCalendar->setIcon("images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(2050, 2010);
					//  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
					  $myCalendar->setDateFormat('j F Y');
					  $myCalendar->setAlignment('right', 'bottom');
					  $myCalendar->getDate();
					  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
					  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
					  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
					  $myCalendar->writeScript();
					?></td>
              </tr>
            </table>
            </fieldset></td>
			<td valign="top" width="50%"><fieldset>
            <legend>Invoice Details</legend>
			 <table width="100%">
              <tr>
                <td>Invoice #:</td>
                <td><input type="text" name="invoice" id="invoice"   class="inputFields" required="required"/></td>
              </tr>
			  <tr>
                <td>Invoiced Amount:</td>
                <td><input type="text" name="amt" id="amt"  class="inputFields" required="required"/></td>
				<tr>
                <td>Payable A/C:</td>
                <td><input type="text" name="acc" id="acc"  class="inputFields" required="required"/></td>
              </tr>
              </tr>
			  </table>
			</fieldset>
			</td>
        </tr>
        <tr>
          <td colspan="2"><fieldset>
            <legend>Items Received</legend>
            <input type="button" value="Add Item" onClick="addRow('dataTable')" />
            <input type="button" value="Remove Selected Item" onClick="deleteRow('dataTable')"  />(All acions apply only to entries with check marked check boxes only.)
            <table id="dataTable" border="0" width="100%">
              <tbody>
                <tr>
                  <p>
                  <td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
                  <td> Item Description<br/>
                    <input type="text" required="required" name="BX_ITEM[]"  style="width:70%; padding:4px; background-color:#FFFFCC" />
                  </td>
                  <td> Qty<br/>
                    <input type="text" required="required" class="input"  name="BX_QTY[]" style="background-color:#FFFFCC" />
                  </td>
				  <td> Unit Price<br/>
                    <input type="text" required="required" class="input"  name="BX_UNIT[]" style="background-color:#FFFFCC" />
                  </td>
				  <td> Total<br/>
                    <input type="text" required="required" class="input"  name="BX_TOTAL[]" style="background-color:#FFFFCC" />
                  </td>
                  </p>
                </tr>
              </tbody>
            </table>
            </fieldset></td>
        </tr>
        <tr>
          <td colspan="2">Aditional Notes:<br />
            <textarea name="items"  rows="5" cols="60" required="required"></textarea>
          </td>
        </tr>
        <tr>
          <td><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
	<?php
	include 'includes/Accounting.php';
	$acc = new Accounting();
	if(isset($_POST)==true && empty($_POST)==false){
	$received_by=$_SESSION['SESS_NAME_'];
	
	$ponumber = $_POST['ponumber'];
	$deliverlyno = $_POST['deliverlyno'];
	$deliverydate = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$notes=$_POST['items'];
	
	$invoice = $_POST['invoice'];
	$amt = $_POST['amt'];
	$acc = $_POST['acc'];
	
	
	$BX_ITEM=$_POST['BX_ITEM'];
	$BX_QTY=$_POST['BX_QTY'];
	$BX_UNIT=$_POST['BX_UNIT'];
	$BX_TOTAL=$_POST['BX_TOTAL'];
	
	
	$acc->savePOReceived($ponumber,$deliverlyno,$deliverydate,$notes,$received_by);
	$acc->saveInvoice($invoice,$ponumber,$amt,$acc);
	
	foreach($BX_ITEM as $a => $b){ 
	
	$acc->savePOReceivedItems($ponumber,$BX_ITEM[$a],$BX_QTY[$a],$BX_UNIT[$a],$BX_TOTAL[$a]);
	
	
	}
	
	?>
	
	<script language=javascript>alert('Record Successfull') </script>
	
	
	<?php
	
	} 
	
	
	?>
	
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
