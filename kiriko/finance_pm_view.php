<?php
include("includes/fees.php");
	$fees = new Fees();
$curr_year=date('Y');
include('includes/dbconnector.php');
	
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
<script src="jsvalidators/save_pm_transaction.js"></script>
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
</script>
<body class="centonomy_theme" style="background-color:white;">

<?php



if (isset ($_GET['ref'])){
	
	$admno=$_GET["ref"];

$query = "select * from received_invoices where supplier='$admno'";

// run the query and store the results in the $result variable.
$result =mysql_query($query);
	
            ?>
	<div class="panel">
       <header class='dataListHeader'>Pocket Money Management</header>
	 <div class="panel-body">	
<table width="100%">
	 <tr>
	 <td rowspan='6'>
	 <div style="height:180px; padding:10px;">
	 <?php 
				   if (file_exists("Image/".$admno.".jpg")) {
			
			 echo "<img src=Image/$adm.jpg width=150 class='bordered_table' height=150  align=middle  border=0/>"; 
			 }else{
			  echo "<img src=Image/blur.PNG width=150 class='bordered_table' height=150  align=middle  border=0/>"; 
			 }
			 ?>
            
          </div>
	 </td>
	 </tr>
	 <tr>
	 <td><strong>Student Name:</strong></td><td><?php echo $fees->getStudentDetail("fname",$admno)." ".$fees->getStudentDetail("lname",$admno)." ".$fees->getStudentDetail("sname",$admno)?></td>
	 </tr>
	 <tr>
	 <td><strong>Admission #:</strong></td><td><?php echo $admno?></td>
	 </tr>
	 <tr>
	 <td><strong>Form:</strong></td><td><?php echo $fees->getStudentDetail("form",$admno)?></td>
	 </tr>
	 <tr>
	 <td><strong>Availale Balance:</strong></td><td><?php echo $fees->pocketMoneyBal($admno)?></td>
     </tr>
	</table>
  <form name="frmRegistration" id="registration-form"  class="form-horizontal row-border" method="post">
       <table width='100%'>
	   
	   <tr>
        <td class="alterCell" width="25%">Transaction Type :</td>
        <td><select name="p_type" id="p_type" class="select" required> 
		<option value="" >-- Select Transaction-- </option>
        <option value="Deposit">Deposit </option>
		<?php
		if($fees->pocketMoneyBal($admno)<=0){}else{?>
		<option value="Withdraw">Withdraw </option>
		<?php
		}
		?>
		</select>
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
	   <td class="alterCell" width="25%">Amount:</td>
	   <td> <input type="number" step='any'  name="amount" id="amount" class="inputFields" tabindex="1" required  /></td>
	   </tr>
	   
	   
	   <tfoot>
		<th colspan="3"><div style="float:right; margin-right:5px;"><button type="submit" name="delete" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Process Transaction</button></div></th>
		</tfoot>
	   </table>
		<input type="hidden" name="payee" tabindex="1" required value="<?php echo $admno ?>"/>			
  </form>
 </div> 
 </div>           
       <?php     

}else{
	?>
	<div class="panel">
       <header class='dataListHeader'>Pocket Money Management</header>
	 <div class="panel-body">
			
	 <table>
	 <tr>
	 <td rowspan='6'>
	 <div style="height:200px; padding:10px;">
             <img src="Image/blur.PNG" width="170" class='bordered_table' height="180"  align='middle'  border='0'/> 
          </div>
	 </td>
	 </tr>
	 <tr>
	 <td><strong>Student Name:</strong></td>
	 </tr>
	 <tr>
	 <td><strong>Admission #:</strong></td>
	 </tr>
	 <tr>
	 <td><strong>Form:</strong></td>
	 </tr>
	 <tr>
	 <td><strong>Availale Balance:</strong></td>
     </tr>
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