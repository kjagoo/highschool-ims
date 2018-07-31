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

<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<SCRIPT type="text/javascript">

pic1 = new Image(16, 16); 
pic1.src = "images/loader.gif";

$(document).ready(function(){

$("#admno").change(function() { 

var usr = $("#admno").val();


$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "check_admno.php",  
    data: "admno="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#admno").removeClass('object_error'); // if necessary
		$("#admno").addClass("object_ok");
		$(this).html('');
		//$(this).html('&nbsp;<img src="images/tick.gif" align="absmiddle">');
	}  
	else  
	{  
		$("#admno").removeClass('object_ok'); // if necessary
		$("#admno").addClass("object_error");
		$(this).html(msg);
		$("#admno").focus();
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
    <li><a  href="finance_collect_fees.php">Collect Fees</a></li>
	 <li><a  href="finance_collect_income.php">Collect Other Incomes</a></li>
	   <li><a  href="finance_collect_operation.php">Operation Distribution</a></li>
	   <li><a  href="finance_collect_tution.php">Tution Distribution</a></li>
	 <li><a class="active" href="finance_collect_bursaries.php">Collect Bursaries</a></li>
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
          <td class='dataListHeader' colspan='4'>Bursaries</td>
        </tr>
        <tr>
          <td valign="top"><fieldset>
            <legend>Cheque Info</legend>
            <table width="100%" class="borders">
              <tr>
                <td class="alterCell" width="20%">From:</td>
                <td><input type="text"name="from" class="inputFields"  required="required"/></td>
				<td valign="top" rowspan="4">Comments:<br/><textarea name="items"  rows="6" cols="25"></textarea></td>
              </tr>
              <tr>
                <td class="alterCell" width="20%">Cheque No:</td>
                <td><input type="text" name="cheque" class="inputFields" required="required" /></td>
              </tr>
              <tr>
                <td class="alterCell" width="20%">Amount:</td>
                <td><input type="text" name="amount" id="amount" class="inputFields" required="required" /></td>
              </tr>
			  <tr>
                <td class="alterCell" width="20%">Banked At:</td>
                <td><select name="bank" class="select" tabindex="14" required>
               <option value="" >--Select Bank-- </option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select * from bank_accounts ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['account_number'].">".$row['bank_name']." , ".$row['account_name']." A/C</OPTION>"; }?>
              </select></td>
              </tr>
			  <tr>
                 <td class="alterCell" width="20%">Received Term</td>
                <td class="alterCell3"><select name="term" id="inputMarks" class="select" required>
				<option value="" >-- Select Term --</option>
                    <option value="1" >TERM 1 </option>
                    <option value="2" >TERM 2 </option>
                    <option value="3" >TERM 3 </option>
                  </select>
                </td>
				</tr>
				<tr>
                 <td class="alterCell" width="20%">Year</td>
                <td valign="middle"><select name="year" id="inputMarks" class="select" required>
				<option value="" selected="selected">-- Select Year --</option>
                    <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
                  </select>
                </td>
              </tr>
            </table>
            </fieldset></td>
			 
        </tr>
		<tr>
		<td colspan="2">
		<fieldset>
		<legend>Allocated Students</legend>
					<input type="button" value="Add Student" onClick="addRow('dataTable')" /> 
					<input type="button" value="Remove Selected Students" onClick="deleteRow('dataTable')"  /> 
(All actions apply only to entries with check marked check boxes only.)
		
		 <table id="dataTable" border="0" width="100%">
                  <tbody>
                    <tr>
                      <p>
						<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
						<td>
							AdmNo <br/>
							<input type="text" required="required" id="admno" name="BX_NAME[]"  style="width:50%; padding:4px; background-color:#FFFFCC" /><div style="float:right;" id="status"></div>
						 </td>
						 <td>
							Amount<br/>
							<input type="text" required="required"  name="BX_age[]" id="xy" style="background-color:#FFFFCC; padding:4px; width:100px;" />
					     </td>
						
							</p>
                    </tr>
                    </tbody>
                </table>
		</fieldset>
		</td>
		</tr>
       <tr>
	  
	   </tr>
        <tr>
         
          <td><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
	
	<?php
	if(isset($_POST['from'])  && isset($_POST['cheque']) && isset($_POST['amount']) && isset($_POST['bank']) && isset($_POST['term'])&& isset($_POST['year'])){
	require_once("includes/dbconnector.php");
	
	$from=$_POST['from'];
	$cheque=$_POST['cheque'];
	$amount=$_POST['amount'];
	$bank=$_POST['bank'];
	$term=$_POST['term'];
	$year=$_POST['year'];
	$items=$_POST['items'];
	$BX_NAME=$_POST['BX_NAME'];//admno
	$BX_age=$_POST['BX_age'];//amount allocated
	$totalv=0;
		foreach($BX_NAME as $a => $b){ 
		$totalv+=$BX_age[$a];
		}
		
if($totalv>$amount){ ?>
	<script language=javascript>alert('Error!\n\nBursary Records Exceeds The Cheque Allocation') </script>
	<script language=javascript>window.location='finance_collect_bursaries.php' </script>
<?php	
}else{
	$qury="INSERT INTO bursaries
            (cheque_no,
             cheque_from,
             amount,
             account_no,
             comments,
             year,
             term)
VALUES ('$cheque',
        '$from',
        '$amount',
        '$bank',
        '$items',
        '$year',
        '$term')";
		$results = mysql_query($qury);
	 if (!$results) {
		die('Invalid query: ' . mysql_error());
   	}
		
	
	foreach($BX_NAME as $a => $b){ 
	$qry="INSERT INTO bursaries_allocations
            (cheque_no,
             admno,
             amount)
VALUES ('$cheque',
        '$BX_NAME[$a]',
        '$BX_age[$a]')";
	 $result = mysql_query($qry);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}
	
	}//end of foreach
	echo "<script language=javascript>alert('Bursary Record Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_collect_bursaries.php' </script>";
	}
}	
	?>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
