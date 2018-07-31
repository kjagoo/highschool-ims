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
<script>
function getBanks(str) {
    if (str == "") {
        document.getElementById("txtBanks").innerHTML = "";
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
                document.getElementById("txtBanks").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","fetch_banks.php?q="+str,true);
        xmlhttp.send();
    }
}
function getLedgers(str) {
    if (str == "") {
        document.getElementById("accounts").innerHTML = "";
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
                document.getElementById("accounts").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","fetch_account_voteheads.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active" href="finance_payables.php">Expenses</a></li>
	<li><a  href="finance_payable_list.php">Expenses Report </a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Expenses
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="finance_payables.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh Page</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  
</table>

<form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
           <tr>
              <td class="alterCell" width="20%"><b>Main Account :</b></td>
              <td class="alterCell2">
			  <select name="mainaccount" id="mainaccount" class="select" tabindex="1" required autofocus onchange="getLedgers(this.value)"/>
                          
               <option value="" selected="selected"> --Select Main Account--</option>
			    <option value="Parents">Parents Cashbook</option>
				 <option value="Operations">Operations Account</option>
				  <option value="Tution">Tution Account</option>
                          
               </select>
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Debited Votehead :</b></td>
              <td class="alterCell2">
			  <div id='accounts'>
			  <select name="t_type" id="t_type" class="select" tabindex="1" required autofocus />
                          
                <option value="" selected="selected"> --Select Debited Votehead--</option>
                          
               </select>
			   </div>
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Expense Mode:</b></td>
              <td class="alterCell2">
			  <select name="p_type" id="p_type" class="select" tabindex="1" required onchange="getBanks(this.value)"/>
                    <option value="" selected="selected"> --Select Mode of Expense--</option>
                    <option value="Direct_Deposit">Direct Deposit</option>
                    <option value="Cheque">Cheque </option>
                    <option value="Money_Order">Money Order </option>
                    <option value="Cash">Cash </option>
					 <option value="Mpesa">Mpesa</option>
                    </select>
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Select Bank Account:</b></td>
              <td class="alterCell2">
			  <div  id="txtBanks"> 
				<select name="bank" id="bank" class="select" tabindex="1" required />
				<option value="" selected="selected"> --Select Bank--</option>
				</select>
					 
			</div>
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Transaction Date:</b></td>
              <td class="alterCell2">
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
			  
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Being Expense On :</b></td>
              <td class="alterCell2"><input type="text"  name="expenseon" class="inputFields" tabindex="1" required placeholder="E.g. printing or transport "/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Amount:</b></td>
              <td class="alterCell2"><input type="number" step='any'  name="amount" class="inputFields" tabindex="1" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Ref:</b></td>
              <td class="alterCell2"><input type="text"  name="ref" class="inputFields" tabindex="1" placeholder='E.g. Cheque No' required/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Transaction" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
	
	 <?php
	if( isset($_POST['t_type']) && isset($_POST['p_type']) && isset($_POST['expenseon']) && isset($_POST['amount'])){
	require_once("includes/dbconnector.php");
	
	$mainaccount=$_POST['mainaccount'];
	$account=$_POST['t_type'];
	$e_mode=$_POST['p_type'];
	$expenseon=$_POST['expenseon'];
	$amount=$_POST['amount'];
	$ref=$_POST['ref'];
	$bank=$_POST['bank'];
	$t_date = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	
	
	$qury="insert into expenses
	(t_date,mainaccount, account, e_mode, bank, expense_on, amount, refno)
	values
	('$t_date', '$mainaccount','$account', '$e_mode', '$bank', '$expenseon', '$amount', '$ref')";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "made an expese on $account on $expenseon for  ".$amount;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Transaction Recorded Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_payables.php' </script>";
	}
	}
	
?>
	
  </div>
</div>

<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
