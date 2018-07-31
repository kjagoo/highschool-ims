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
<script language="javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="js/scriptadd.js"></script> 
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active" href="finance_PO.php">New Purchase Order</a></li>
    <li><a  href="finance_polist.php">Purchase Orders</a></li>
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
    <form name="form" action="pdf_po.php"  method="post" target="_blank">
      <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>New Purchase Order</td>
        </tr>
        <tr>
		
          <td width="50%" valign="top"><fieldset>
            <legend>Order Initiation Details</legend>
            <table>
              <tr>
                <td>PO Date:</td>
                <td><?php echo date('Y-m-d');?></td>
              </tr>
			   <tr>
                <td>Initiated By:</td>
                <td><?php echo $_SESSION['SESS_NAME_']?></td>
              </tr>
              <tr>
                <td>PO #:</td>
                <td><input type="text" name="ponumber"  style="background-color:#FFFFCC" class="inputFields" value="<?php echo $hcode?>"  required="required"/></td>
              </tr>
             
              <tr>
                <td>Requisition Ref:</td>
                <td><input type="text"name="reqref" class="inputFields" value="<?php echo $hcode?>" required="required" /></td>
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
			
          <td width="50%" valign="top"><fieldset>
            <legend>Supplier Info</legend>
            <table width="100%">
              <tr>
                <td>Supplier Name:</td>
                <td><input type="text"name="sname" class="inputFields"  required="required"/></td>
              </tr>
              <tr>
                <td>Address:</td>
                <td><input type="text" name="saddress" class="inputFields" required="required" /></td>
              </tr>
              <tr>
                <td>Telephone #:</td>
                <td><input type="text"name="stel" class="inputFields" required="required" /></td>
              </tr>
			  <tr>
                <td>Email Address:</td>
                <td><input type="text"name="semail" class="inputFields" required="required" /></td>
              </tr>
            </table>
            </fieldset></td>
        </tr>
		<tr>
		<td colspan="2">
		<fieldset>
		<legend>Purchase Order Details</legend>
					<input type="button" value="Add Item" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Selected Item" onClick="deleteRow('dataTable')"  /> 
					(All acions apply only to entries with check marked check boxes only.)
		
		 <table id="dataTable" border="0" width="100%">
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							Item Description
							<input type="text" required="required" name="BX_NAME[]"  style="width:70%; padding:4px; background-color:#FFFFCC" />
						 </td>
						 <td>
							Qty
							<input type="text" required="required" class="input-short"  name="BX_age[]" style="background-color:#FFFFCC" />
					     </td>
						
							</p>
                    </tr>
                    </tbody>
                </table>
		</fieldset>
		</td>
		</tr>
       <tr>
	   <td colspan="2">Aditional Notes:<br />
	   <textarea name="items"  rows="5" cols="60" required="required">
This LPO is valid for 21 days only
Include LPO # on your Delivery</textarea>
	   </td>
	   </tr>
        <tr>
         
          <td><input type="submit" name="submit" value="Create & Print PO" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
	

  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
