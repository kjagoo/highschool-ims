<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

include 'includes/functions.php';
 include 'includes/Finance.php';
 $finance = new Financials(); 

$func = new Functions();
$activity = "Save Expenses";
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
<script language="javascript" src="../scripts/calendar.js"></script>
<script type="text/javascript">

function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}
function download(){
	window.location='files.xls';
}

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getFileDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
   window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
	window.location='expenses.php';
}

function disableTextBox(obj){
	 
        var selected=document.pays.expensetype.options[obj.selectedIndex].value;
		 if(selected=="Cash" || selected=="select"){
			document.pays.bank.value=""; 
		   document.pays.chqno.value=""; 
		    document.pays.bank.disabled=true; 
		   document.pays.chqno.disabled=true; 
		   }
		   if(selected=="Cheque"){
		   document.pays.bank.value="Bank Name"; 
		   document.pays.chqno.value="Cheque No."; 
		    document.pays.bank.disabled=false; 
		   document.pays.chqno.disabled=false; 
		   }
	}

	</script>
</head>
<body>
<div class="upper_area">
  <table width="100%" id="tire-specs">
    <tr>
      <td width="50%"><h2>Inventory/ Expenses</h2></td>
      <td width="10%">&nbsp;</td>
      <td width="40%" align="right"></td>
    </tr>
    <tr>
      <td colspan="3"><table width="100%">
          <tr>
            <td align="left"></td>
            <td align="left"></td>
            <td align="center"></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a  href="finance_inventory.php">Receive Purchase Order</a></li>
    <li><a  href="finance_inventory_received.php">Received Purchase Orders</a></li>
    <li><a  class="active" href="expenses.php">Expenses</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
   <?php
require_once('auth.php');
if(isset($_POST['amount'])){  // Check if selections were made
$year = $_POST['year'];  // Retrieve POST data
$term = $_POST['term'];
$date = isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
$mode=$_POST['expensetype'];

if($mode=="Cash"){
$bank="-";
$cheqno="-";
}else{
$bank=$_POST['bank'];
$cheqno=$_POST['chqno'];
}

$amount=$_POST['amount'];
$words=$_POST['words'];
$account=$_POST['voteheads'];
$desc=$_POST['description'];
$rname=$_POST['rname'];
$rid=$_POST['rid'];





	$query="insert into expenses (year,term,dateofExpense,mode,bank,chequeno,amount,words,account,description,rname,rid) values('$year','$term','$date','$mode','$bank','$cheqno','$amount','$words','$account','$desc','$rname','$rid')";
	 $result = mysql_query($query);

		if (!$result) {
	echo "<script language=javascript>alert('A certain Payee has already been paid on this Date.\nDouble paymemnts are not Allowed');</script>";
	echo "<script language=javascript>window.location='expenses.php';</script>";
        //die('Invalid query: ' . mysql_error());
   		 }else{
		 
		// header("Location:streams.html");
		
		 }
}else{
echo "Form Error";
 header("Location:expenses.php");
}

	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	
?>
<div id=tableReceipt>
	<table align="center" border="1">
	
	<tr>
	<td>
	 <table>
		<tr>
		<td>
			<table width="250" border="0">
			<tr><td><span id="receiptText"><?php echo strtoupper($schoolname);?></span></td></tr>
			<tr><td><span id="receiptText">P.o. Box &nbsp;<?php echo $po.',&nbsp;'.$plac;?></span></td></tr>
			<tr><td><span id="receiptText">Tel:&nbsp;&nbsp;<?php echo $tele;?></span></td></tr>
			</table>
		</td>
		<td>
			<table width="250"> 
			<tr><td></td></tr>
			</table>
		</td>
		<td>
			<table>
			<tr><td>Reference No.<span id="receiptText"><strong>#___________</strong></span></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Date:&nbsp;&nbsp;<span id="receiptText"><u> <?php echo $date;?></u></span></td></tr>
			</table>
		</td>
	 	</tr>
	  </table>
	  <table width="700">
	  <tr><td colspan="5" align="center"><u>Expenses Voucher</u>&nbsp;&nbsp;&nbsp;</td></tr>
	  	<tr>
		<td>Receiver's Name </td><td colspan="3"><span id="receiptText"><?php echo $rname;?></span></td>
		</tr>
		<tr>
		<td>ID/Passport No: .. <span id="receiptText"><?php echo $rid;?></span></td>
		</tr>
		<tr>
		<td>Receiver's Sign </td><td colspan="3">_______________________________________________</td>
		</tr>
		<tr>
		<td>Year:</td><td><span id="receiptText"><?php echo $year;?></span></td>
		<td>Term:</td><td><span id="receiptText"><?php echo $term;?></span></td>
		<td>Mode: .. <span id="receiptText"><?php echo $mode;?></span></td>
		</tr>
		<tr>
		<td>Amount (Words) </td><td colspan="4"><span id="receiptText"><?php echo $words;?></span></td>
		</tr>
	  </table>
	</td>
	</tr>
	<tr>
		<td>
			<table width="700">
			<tr bgcolor="#D4D4D4"><td>Votehead</td><td>Description</td><td align="right" style="padding-right:10px;">Amount</td></tr>
			<?php
			if($amount!=0){
			echo "<tr><td><span id=receiptText>$account</span></td>
			<td><span id=receiptText>$desc</span></td>
			<td align=right style=padding-right:10px;><span id=receiptText>".number_format($amount)."</span></td>
			</tr>";
			}
			?>
			
			<tr><td colspan="2" align="right" style="padding-right:10px;">&nbsp;</td><td><hr /></td></tr>
			<tr><td colspan="2" align="right">Total</td><td align="right" style="padding-right:10px;"><span id="receiptText"><?php echo number_format($amount);?></span></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
			<td colspan="3" align="left">Chq No/ Money Order No<span id="receiptText"><strong> # <?php echo $cheqno;?></strong></span></td></tr>
			<tr><td colspan="3" align="right">Served By: <span id="receiptText">&nbsp;&nbsp;<?php echo $username;?></span></td></tr>
			
			</table>
		</td>
	</tr>
	
	</table>
	</div><!-- end of div for printing-->
	<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
	
	<table border=0 align=center>
	<tr>
	<td><a href="javascript:printDiv('tableReceipt')"><input class='button_ black' type='button' value='Print Voucher' /></a>
	</td>
	</tr></table>

</fieldset>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
