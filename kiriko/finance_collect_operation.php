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
$year = date("Y");


$serial = 0;
$sqlquly1 = "SELECT Max(receipt_no) as receipt_no FROM finance_feestructures";
$sql4 = mysql_query($sqlquly1);
 while ($rowstudenc= mysql_fetch_array($sql4 )) {
		$serial=$rowstudenc['receipt_no'] + 1 ;
		}
	
	$year=$finance->getFiscalYear();	
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
<script>

$(document).ready(function () {

     //iterate through each textboxes and add keyup
     //handler to trigger sum event
     $(".term1").each(function () {

         $(this).keyup(function () {
             calculateSum();
         });
     });

 });

 function calculateSum() {

     var sum = 0;
     //iterate through each textboxes and add the values
     $(".term1").each(function () {

         //add only if the value is number
         if (!isNaN(this.value) && this.value.length != 0) {
             sum += parseFloat(this.value);
         }

     });
     //.toFixed() method will roundoff the final sum to 2 decimal places
     $("#payable").val(sum.toFixed(2));
 }

function disableTextBox(obj){
	 
        var selected=document.topay.mode.options[obj.selectedIndex].value;
		   
		   if(selected=="Direct Deposit"){
		   document.topay.bank.value="Bank Name";  
		   document.topay.bank.disabled=false; 
		   document.topay.bankreceipt.disabled=false;
		   }
		   if(selected=="Cheque"){
			document.topay.bank.value="Bank Name"; 
		   document.topay.bank.disabled=false; 
		   document.topay.bankreceipt.disabled=false;
		   }
		   if(selected=="Money Order"){
		   document.topay.bank.value="Bank Name"; 
		   document.topay.bank.disabled=false; 
		   document.topay.bankreceipt.disabled=false;
		   }
		   if(selected=="Bursary Cheque"){
		    document.topay.bank.value="Bank Name"; 
		   document.topay.bank.disabled=false;
		   document.topay.bankreceipt.disabled=false;
		   }
		    if(selected=="Cash"){
			document.topay.bank.value=""; 
		    document.topay.bank.disabled=true; 
			document.topay.bankreceipt.disabled=true;
		   }
      }
//isNaN(name)
      var integerOnly = /[0-9\.]/g;
function restrictCharacters(myfield, e, restrictionType) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
		alert("Only Numbers are Allowed (0-9)");
			return false;
		}
		
	}
}


</SCRIPT>







</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a href="finance_collect_fees.php">Collect Fees</a></li>
	 <li><a  href="finance_collect_income.php">Collect Other Incomes</a></li>
	 <li><a class="active"   href="finance_collect_operation.php">Operation Distribution</a></li>
	  <li><a  href="finance_collect_tution.php">Tution Distribution</a></li>
    <li><a href="finance_collect_bursaries.php">Collect Bursaries</a></li>
	
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
   
  <fieldset>
  <legend> Operation Monies Distribution </legend>
  <i style="float:right;  font-weight:bold">Processing Receipt #&nbsp; <?php echo $serial?></i>
    <form name="pays" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <table width="70%">
        <tr>
          <td class="alterCell3">Select Term</td>
          <td><select name="term" class="select">
              <option value="TERM 1" >TERM 1 </option>
              <option value="TERM 2" >TERM 2 </option>
              <option value="TERM 3" >TERM 3 </option>
            </select>
          </td>
         <td class="alterCell3">Select Year:</td>
          <td><select name="year" class="select">
              <?php
			  $curryr=date("Y");
			   for($i = $curryr; $i >= 2000; $i--) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
       <td align="center"><input type="submit" name="Record" value="Continue" class="button_ black" onclick="return validateForm();"/></td>
        </tr>
      </table>
	  </form>
	   
	 </fieldset>   
	   <?php
	include('includes/dbconnector.php');

if (isset ($_POST['term']) && isset ($_POST['year']) ){ 
	   
	   $year=$_POST['year'];
	   $term=$_POST['term'];
	   ?>
	   <fieldset>
	    <form name="topay" action="finance_SaveAndPrintReceipt_Operations.php" method="post">
		<table>
		<tr><td>RECEIVABLE AMOUNT</td></tr>
		<tr><td><input type="text" readonly="readonly" id="payable" name="payable" class="AmountField" style="background-color:#FFFFCC" placeholder='0.00' /></td>
		</tr>
	 <?php
			  $tabno=0;
			 		 $sqlquly = "select * from finance_operationalvoteheads where fiscal_year='$year' and term='$term' order by votehead asc ";
						$getStd1 = mysql_query($sqlquly);
						  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
							$votehead1=$rowstudenc['votehead'];
							$tabno++;
							?>
							
                  <tr>
				  <td><input type="checkbox"  name="chk[]" checked="checked" /><?php echo str_replace("_"," ",$votehead1)  ?> </td>
				  
                  <td colspan="2"> <input type="text"   name="amounts[]" id="rate<?php echo $tabno; ?>" class="term1" tabindex="<?php echo $tabno?>" style="background-color:#FFFFCC; padding:4px; width:50%; padding:4px; margin-bottom:3px; font-weight:bold; font-size:14px;" onkeypress="return restrictCharacters(this, event, integerOnly);" placeholder='0.00'/></td>
                  </tr>
                <?php 
				} 
				
				?>
		 <tr>
                <td>Mode of Payment</td>
                <td><select name="mode" class="select" onchange="disableTextBox(this)">
                    <option value="Direct Deposit" >Direct Deposit</option>
                    <option value="Cheque" >Cheque </option>
                    <option value="Money Order" >Money Order </option>
                    <option value="Bursary Cheque" >Bursary Cheque </option>
                    <option value="Cash" >Cash </option>
                    <option value="In Kind" >In Kind </option>
                  </select>
                </td>
                <td>
				<table width="100%">
			<tr>
			<td>
		<select name="bank" class="select" required>
		  <option value="" selected="selected">-- Select Bank Debited--</option>
		 <?php
		 $resultb=mysql_query("select * from bank_accounts") ;
			if (!$resultb) {
			die('Invalid query: ' . mysql_error());
   			}else{
				while($rowb=mysql_fetch_array($resultb)){
				echo "<OPTION VALUE=".str_replace(" ","_",$rowb['account_number']).">".$rowb['bank_name']."</OPTION>"; 
				}
			}
			?>
		 </select>
			</td>
			<td>
			<input type="text" id="bankreceipt" name="bankreceipt" class="bankreceipt" class="inputFields" placeholder="Cheque #" />
			</td>
			</tr>
			</table>
				
				</td>
		 <tr><td></td></tr>
	   <tr>
          <td align="center" colspan="3"><input type="submit" name="Record" value="Receive & Receipt" class="btn btn-success" onclick="return validateForm();"/></td>
        </tr>
      </table>
	    <input type="hidden" name="serial" value="<?php echo $serial ?>"/>
		<input type="hidden" name="year" value="<?php echo $year ?>"/>
		<input type="hidden" name="term" value="<?php echo $term ?>"/>
    </form>
	</fieldset>
   <?php
   
   }
   
   ?>
	
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
