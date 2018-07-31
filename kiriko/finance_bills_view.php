<?php
include("includes/Accounting.php");
	$accounting = new Accounting();
$curr_year=date('Y');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<link href="css/fonts.google.css" rel="stylesheet" type="text/css" />
<link href="css/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script src="js/jquery-2.1.0.js"></script>
<script language="javascript" src="scripts/calendar.js"></script>
<script src="jsvalidators/save_paybill.js"></script>
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
        xmlhttp.open("GET","fetch_banks_topay.php?q="+str,true);
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
<body class="centonomy_theme" style="background-color:white;">

<?php
include('includes/dbconnector.php');


if (isset ($_GET['ref'])){
	
	$supplier=$_GET["ref"];

$query = "select * from received_invoices where supplier='$supplier'";

// run the query and store the results in the $result variable.
$result =mysql_query($query);
if (!$result) {
echo "Error!-".mysql_error();
}else{	
            ?>
	<div class="panel">
       <header class='dataListHeader'>Bills / Suppliers Payment</header>
	 <div class="panel-body">	

  <form name="frmRegistration" id="registration-form"  class="form-horizontal row-border" method="post">
       <table width='100%'>
	   
	   <tr>
        <td class="alterCell" width="25%">Mode of Payment :</td>
        <td><select name="p_type" id="p_type" class="select" required onchange="getBanks(this.value)"> 
		<option value="" >-- Select Mode of Payment-- </option>
        <option value="Direct Deposit" >Direct Bank Deposit </option>
		<option value="Cheque" >Cheque </option>
		<option value="EFT" >Money Order </option>
		<option value="Cash" >Cash </option>
		<option value="Mobile_Money_Mpesa" >Paybill</option>
		</select>
		</tr>
		<tr>
		<td class="alterCell" width="25%"></td>
		<td> <div  id="txtBanks"></div></td>
       </tr>
	   <tr>
		<td class="alterCell" width="25%">Transaction Date:</td>
		<td>
		<div class="inputFields">
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
	   <td class="alterCell" width="25%">Credited Account:</td>
	   <td> 
	   <div id='accounts'>
			  <select name="t_type" id="t_type" class="select" tabindex="1" required autofocus />
                          
                <option value="" selected="selected"> --Select Debited Votehead--</option>
                          
               </select>
			   </div>
	   </td>
	   </tr>
	   <tr>
	   <td class="alterCell" width="25%">Ref #:</td>
	   <td> <input type="text"  name="memo" id="memo" class="inputFields" tabindex="1" required  placeholder="E.g. Transaction #, Cheque # etc"  /></td>
	   </tr>
	   
	   <tr>
	   <td colspan='2'>
	   
	   <table  class="display table table-bordered table-striped">
                       <thead>
                      <tr>
                        <th>Invoice ref.</th>
                        <th> Amount </th>
						<th>Paying Amount</th>
                      </tr>
                    </thead>
                        <tbody>
                          <?php	
				 $num=0;
				 $amt=0;
				 $paid=0;
				while ($row = mysql_fetch_array($result)) {
				$num++;
				$inref=$row['invoice_ref'];
				
				$amt=$accounting->getinvoiceAmt($inref);
				$paid=$accounting->getinvoicePaidAmt($inref);
				
				if(($amt-$paid)>0){
					
				?>
                      <tr>
					  <td><input type="checkbox"  name="invoice[]" checked="checked"  value="<?php echo $row['invoice_ref']?>"/> <?php echo str_replace("_"," ",$row['invoice_ref'])  ?> 
					  
					  </td>
					  <td align='right'><b><?php echo number_format(($amt-$paid),2)?></b></td>
					  <td colspan="2"> 
					  <input type="text"   name="amounts[]" id="rate<?php echo $num; ?>" class="term1" tabindex="<?php echo $num?>" style="background-color:#FFFFCC; padding:4px; width:70%; padding:4px; margin-bottom:3px; font-weight:bold; font-size:14px;" onkeypress="return restrictCharacters(this, event, integerOnly);"/></td>
					  </tr>
                            <?php
				}
				}
				?>
                        </tbody>
						<tfoot>
						<th colspan="7"><div style="float:right; margin-right:5px;"><button type="submit" name="delete" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Process Payment</button></div></th>
						</tfoot>
						
                      </table>
       </td>
	   </tr>
	   </table>
		<input type="hidden" name="payee" tabindex="1" required value="<?php echo $supplier ?>"/>			
  </form>
 </div> 
 </div>           
       <?php     
  }
}else{
	?>
	<div class="panel">
       <header class='dataListHeader'>Bills / Suppliers Payment</header>
	 <div class="panel-body">
	 <table  class="display table table-bordered table-striped" id="dynamic-table">
             <thead>
                <tr>
                 <th>Invoice ref.</th>
                 <th> Amount </th>
				<th>Paying Amount</th>
                </tr>
              </thead>
              <tbody>
			  </tbody>
			  </table>
	</div>
	</div>
	<?php
		}
	?>
	
	 
<!--\\\\\\\ wrapper end\\\\\\-->
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/jPushMenu.js"></script>
<script src="plugins/data-tables/jquery.dataTables.js"></script>
<script src="plugins/data-tables/DT_bootstrap.js"></script>
<script src="plugins/data-tables/dynamic_table_init.js"></script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    
    
     });
    

   </script>
</body>
</html>