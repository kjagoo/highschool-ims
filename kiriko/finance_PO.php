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
<script src="js/jquery-2.1.0.js"></script>
<script language="javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="js/scriptadd.js"></script> 
<script src="jsvalidators/save_receive_invoices.js"></script>
<script>

function getSupplierDetails(str) {
    if (str == "") {
        document.getElementById("txtHints").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHints").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","fetch_supplier.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
    <li><a  class="active" href="finance_PO.php">Receive Invoice</a></li>
    <li><a  href="finance_polist.php">Received Invoices</a></li>
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
    <form name="frmRegistration" id="registration-form" class="form-horizontal row-border" method="post">
      <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Receive Supplier Invoice</td>
        </tr>
        <tr>
		
          <td width="50%" valign="top"><fieldset>
            <legend>Invoice Details</legend>
            <table>
              
              <tr>
                <td>Invoice Ref #:</td>
                <td><input type="text" name="ino" id='ino'  style="background-color:#FFFFCC" class="inputFields" required="required"/></td>
              </tr>
             
              <tr>
                <td>Invoice Date:</td>
                <td>
				<div class='inputFields'>
				<?php
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
					?>
					</div>
					</td>
              </tr>
			  
            </table>
            </fieldset></td>
			
          <td width="50%" valign="top"><fieldset>
            <legend>Supplier Information</legend>
			  <div id="txtHints">
            <table width="100%">
			<tr>
			  <td>Supplier:</td>
			  <td><select name="sname" id="sname"  class="select" required onchange="getSupplierDetails(this.value)">
				  <option value="" >-- Select Supplier -- </option>
				  <option value="New" >New Supplier</option>
				  <?php
					 $qry="select * from suppliers";
					$result=mysql_query($qry) ;
					while($row=mysql_fetch_array($result)){
					$supplier=str_replace(" ","_",$row['supplier']); 
					
					?>
				  <option value="<?php echo $supplier?>" ><?php echo str_replace("_"," ",$supplier)?></option>
				  <?php
					}
				?>
				</select>
			  </td>
			</tr>
             <tr>
			  <td>Tax Pin:</td>
			  <td><input type="text" name="pin" class="inputFields" required="required" /></td>
			</tr>
			<tr>
			  <td>Address:</td>
			  <td><input type="text" name="saddress" class="inputFields" required="required" /></td>
			</tr>
			<tr>
			  <td>Telephone #:</td>
			  <td><input type="text" name="stel" class="inputFields" required="required" /></td>
			</tr>
			<tr>
			  <td>Email Address:</td>
			  <td><input type="text" name="semail" class="inputFields" required="required" /></td>
			</tr>
            </table>
			 </div>
            </fieldset></td>
        </tr>
		<tr>
		<td colspan="2">
		<fieldset>
		<legend>Invoice Items/ Particulars</legend>
					<input type="button" value="Add Item" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Selected Item" onClick="deleteRow('dataTable')"  /> 
					(All actions apply only to entries with check marked check boxes only.)
		
		 <table id="dataTable" border="0" width="100%">
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							Qty
							<input type="text" required="required" class="input-short"  name="QTY[]" style="background-color:#FFFFCC" />
					     </td>
						<td>
							Item Description
							<input type="text" required="required" name="item_ref[]"  style="width:70%; padding:4px; background-color:#FFFFCC" />
						 </td>
						 <td>Amount <input type="text" required="required"  name="price[]" style="padding:4px; background-color:#FFFFCC; text-align:right; " placeholder="0.00"  />
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
	   <textarea name="items"  rows="5" cols="60" required="required">Notes attached to this Invoice</textarea>
	   </td>
	   </tr>
        <tr>
         
          <td><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
	

  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
