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


						$getvoteheadsarray = mysql_query("SELECT votehead FROM finance_voteheads WHERE fiscal_year ='$year'");
						  while ($rowvoteheadsarray= mysql_fetch_array($getvoteheadsarray )) {
							$votehead1=$rowvoteheadsarray['votehead'];
							
							}

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
		   if(selected=="Mpesa"){
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
			 document.topay.bank.value="Bank Name"; 
		   document.topay.bank.disabled=false;
		   document.topay.bankreceipt.disabled=false;
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
    <li><a  class="active" href="finance_collect_fees.php">Collect Fees</a></li>
	 <li><a  href="finance_collect_income.php">Collect Other Incomes</a></li>
	  <li><a  href="finance_collect_operation.php">Operation Distribution</a></li>
	   <li><a  href="finance_collect_tution.php">Tution Distribution</a></li>
    <li><a href="finance_collect_bursaries.php">Collect Bursaries</a></li>
	
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
   
  <fieldset>
  <legend> Collect School Fees</legend>
    <form name="pays" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <table width="100%">
        <tr>
		<td>Student Adm No:</td>
          <td colspan="2"><input type="text" name="adm" class="inputFields" required /></td>
          <!--<td>Select Form:</td>
          <td><select name="form" class="select">
              <option value="FORM 1">FORM 1 </option>
              <option value="FORM 2">FORM 2 </option>
              <option value="FORM 3">FORM 3 </option>
              <option value="FORM 4">FORM 4 </option>
			   <option value="FORM 5">FORM 5 </option>
            </select></td>-->
          <td>Select Term</td>
          <td><select name="term" class="select">
              <option value="TERM 1" >TERM 1 </option>
              <option value="TERM 2" >TERM 2 </option>
              <option value="TERM 3" >TERM 3 </option>
            </select>
          </td>
          <td>Select Year:</td>
          <td><select name="year" class="select" required>
		  <option value=""> -Select Year-- </option>
              <?php
			  $curryr=date("Y");
			   for($i = 2016; $i <= 2050; $i++) 
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

if ( isset ($_POST['term']) && isset ($_POST['year']) && isset ($_POST['adm'])){

$year=$_REQUEST['year'];
$term=$_REQUEST['term'];
$adm=$_REQUEST['adm'];

$res = mysql_query("SELECT * from studentdetails  where admno='$adm'");
	
	$fname="";
	while ($rows = mysql_fetch_array($res)) {
	$fname=$rows['fname'];
	$mname=$rows['sname'];
	$lname=$rows['lname'];
	$formin=$rows['form'];
	$streamin=$rows['class'];
 	}
	
	$form = $formin;
	
if($fname==""){
 	echo "<script language=javascript>alert ('No Student With Such Admission No');</script>";
 	echo "<script language=javascript>window.location='finance_collect_fees.php';</script>";
 	}
	if($formin!=$form){
 	echo "<script language=javascript>alert ('That Student Is not In The Selected Form. Please Select the Correct Form');</script> ";
 	echo "<script language=javascript>window.location='finance_collect_fees.php';</script>";
 	}
	else{
	$payable=0;
	$paya = mysql_query("SELECT sum(amount) as payable from finance_fees  where fiscal_yr='$year' and form='$form' and term='$term'");
	while ($rowpaya = mysql_fetch_array($paya)) {
	$payable=$rowpaya['payable'];
 	}

	$paidAmount=0;
	$paid = mysql_query("SELECT sum(votehead_amt) as amount from finance_feestructures  where admno='$adm' and  year='$year' and term='$term'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($paid)) {
	$paidAmount=$rowpai['amount'];
 	}
	$balance=0;
	
	}
	$updatedBal=0;
	$updatedBalance = mysql_query("SELECT balance from finance_balances  where admno='$adm'");
	while ($rowupbal = mysql_fetch_array($updatedBalance)) {
	$updatedBal=$rowupbal['balance'];
 	}
	
	
	$payable=$payable+$updatedBal;
	
	$balance=$payable-$paidAmount;
	
	$serial = 0;
$sqlquly1 = "SELECT Max(receipt_no) as receipt_no FROM finance_feestructures";
$sql4 = mysql_query($sqlquly1);
 while ($rowstudenc= mysql_fetch_array($sql4 )) {
		$serial=$rowstudenc['receipt_no'] + 1 ;
		}

function getPreviousYRPayable($year,$pform,$admno){
	$total_payable=0;
	if($pform=="Form 2"){
		$form="Form 1";
	}
	elseif($pform=="Form 3"){
		$form="Form 2";
	}
	elseif($pform=="Form 4"){
		$form="Form 3";
	}
	else{
		$form="Form 0";
	}
	//acount from 2015 since the system was installed
	$bal2015=0;
	$yr2015=($year-1);
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='2015'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal2015=$rowpai['amount'];
 	}

	$getPayable="SELECT SUM(f.amount) AS payable FROM finance_fees AS f inner join students_log sl on f.form=sl.form and f.fiscal_yr=sl.year inner JOIN studentdetails s ON sl.admno=s.admno and sl.admno='$admno' AND  f.fiscal_yr='$year'  and s.yrofadmn<='$year' GROUP BY sl.admno";
$results = mysql_query($getPayable);
$roe= mysql_fetch_array($results);
    $payable=$roe['payable'];
	

$added=0;
	$addedq = "SELECT COALESCE(sum(fa.amount),0) AS added FROM finance_added_fees AS fa 
inner join students_log sl on fa.fiscal_year=sl.year and sl.admno=fa.admno
inner JOIN studentdetails s ON sl.admno=s.admno
and sl.admno='$admno' AND  fa.fiscal_year='$year' GROUP BY sl.form";//cat 1 query
	$resultq = mysql_query($addedq);
	while ($rowq = mysql_fetch_array($resultq)) {// get cat1 marks
	$added=$rowq['added'];
	
	}

	$total_payable=$payable+$added+$bal2015;
	
	return $total_payable;
}

function getPreviousYrBal($admno,$year){
	
	$bal=0;
 $sql="SELECT  distinct(receipt_no), f.dateofpay, f.modeofpay,f.total_amount  from finance_feestructures f where f.admno='$admno' AND  f.year='$year'  and f.statusis='OK' ORDER BY f.dateofpay asc";
   $result = mysql_query($sql);
   $rowscounts=mysql_num_rows($result);
   $totalb=0;
   $AMT=0;
 if($rowscounts==1 ||$rowscounts>1){
  			while($row = mysql_fetch_array($result)){
			$totalb+=$row['total_amount'];
			
			$bal=($bal-$row['total_amount']);
			
			$AMT=$row['total_amount'];
  			}
	}else{
			 
		$bal=($bal-$AMT);
	} 	
				
return $bal;
}

function getPayableFeesTerm($term,$year,$form){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}

function getAddedFeesTerm($term,$year,$admno){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_added_fees where fiscal_year='$year' and term='$term' and admno='$admno'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}


function getPaidAmounts($admno,$year,$term){
	
	$paidAmount=0;
	$paid = mysql_query("SELECT COALESCE(sum(votehead_amt),0) as amount from finance_feestructures  where admno='$admno' and  year='$year' and term='$term'   and statusis='OK'");
	while ($rowpai = mysql_fetch_array($paid)) {
	$paidAmount=$rowpai['amount'];
 	}
	return $paidAmount;
	}
function getBalance($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	
	function getLastYrBalance($admno,$year,$term,$updated){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term' and updated='$updated'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	
	function checkArrearsPaid($admno,$year){
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Arrears'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	
	function checkOverpaymentsUsed($admno,$year){
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	//echo checkOverpaymentsUsed($adm,$year);
	//$T1arrear=(getLastYrBalance($adm,$year,"TERM 1",($year-1)))-(checkArrearsPaid($adm,$year))-checkOverpaymentsUsed($adm,$year);
	$T1arrear=(getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1)))-(checkArrearsPaid($adm,$year))-checkOverpaymentsUsed($adm,$year);
	
	$T2arrear=$T1arrear+(getPayableFeesTerm("TERM 1",$year,$form))-(getPaidAmounts($adm,$year,"TERM 1"))+getAddedFeesTerm("TERM 1",$year,$adm);
	
	$T3arrear=$T2arrear+(getPayableFeesTerm("TERM 2",$year,$form))-(getPaidAmounts($adm,$year,"TERM 2"))+getAddedFeesTerm("TERM 2",$year,$adm);
	
	//echo checkArrearsPaid($adm,$year);
	if($term=="TERM 1"){

	$arr=	$T1arrear;
	}
	
	if($term=="TERM 2"){
		$arr=$T2arrear;
	}
	
	if($term=="TERM 3"){
		$arr=	$T3arrear;
	}
	//echo $arr;
	
	?>
	<fieldset>
	
<script type="text/javascript">

 function distributeAmount(){
 var payingamount=parseFloat($('#amountpaid').val());
 var bal=parseFloat(<?php  echo $arr?>);
 var payable=parseFloat(<?php  echo (  (getPayableFeesTerm($term,$year,$form)) +(getAddedFeesTerm($term,$year,$adm))-(getPaidAmounts($adm,$year,$term)) )?>);
 

 var zero=0;

if(bal<0){
payingamount=payingamount-bal;
 $('#fullamt').val(payingamount);
}else{
payingamount=payingamount-bal;
//alert(payingamount);

	if(payingamount<0){
	payingamount=0;
	 $('#arrears').val(parseFloat($('#amountpaid').val()));
	 $('#fullamt').val(zero);
	}else{
	$('#fullamt').val(payingamount);
	$('#arrears').val(bal);
 
 }

}

	<?php
	
  $tabno=0;
  $totalpayables=0;
  $sqlquly = "select fv.votehead,fv.code,ff.amount from finance_voteheads as fv inner join finance_fees ff on fv.votehead=ff.votehead  and ff.term=fv.term and
 fv.fiscal_year=ff.fiscal_yr and fv.term='$term' and ff.form='$form'  and fv.fiscal_year ='$year'  order by fv.code asc";
  $getStd1 = mysql_query($sqlquly);
  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
  	$amounts =$rowstudenc['amount'];
	$votehead=$rowstudenc['votehead'];
	$tabno++;
	
	
	$addedf=0;
	$getadded = mysql_query("select COALESCE(SUM(amount),0) as amount from finance_added_fees where admno='$adm' and  fiscal_year='$year' and term='$term' and votehead='$votehead'");
	while ($rowf= mysql_fetch_array($getadded )) {
  	$addedf =$rowf['amount'];
	}
	if($amounts==0){
	$amounts=$addedf;
	}else{
	$amounts=($amounts+$addedf);
	}
	
	$balas=0;
	$getvbals = mysql_query("select COALESCE(SUM(votehead_amt),0) as bal from finance_feestructures where admno='$adm' and  year='$year' and term='$term' and votehead='$votehead'  and statusis='OK'");
	while ($rowbal= mysql_fetch_array($getvbals )) {
  	$balas =$rowbal['bal'];
	}
	
	?>
	
	
	if(payingamount<=<?php echo $amounts-$balas?>){
		$('#rate'+<?php echo $tabno?>).val(payingamount);
		 payingamount= 0;
	}
	 if(payingamount><?php echo $amounts-$balas?>){	
	 $('#rate'+<?php echo $tabno?>).val(<?php echo $amounts-$balas?>);
	  payingamount= parseFloat(payingamount)-parseFloat(<?php echo $amounts-$balas?>);
	 }
  <?php
  $totalpayables+=$amounts;
  	
	}//end of while getting available voteheads
  ?>
 
 //distribute the remaining to the other terms
 //if it is third term, consider the remaining as overpayment
 
  if(parseFloat($('#fullamt').val())> payable ){
   
   $('#overpayment').val(parseFloat($('#fullamt').val()) - parseFloat(payable));
  }
  
 
 }
 
 
 </script>	
	
    <form name="topay" action="finance_SaveAndPrintReceipt.php" method="post">
      <table align="left" width="100%">
        <tr>
          <td align="left" valign="top" width="10%">
		  <table class="tablesorter_ordinary" width="100%">
              <tr>
                <td align="center" ><div style="height:200px;">
                  <?php 
				   if (file_exists("Image/".$adm.".jpg")) {
			
			 echo "<img src=Image/$adm.jpg width=170 class='bordered_table' height=180  align=middle  border=0/>"; 
			 }else{
			  echo "<img src=Image/blur.PNG width=170 class='bordered_table' height=180  align=middle  border=0/>"; 
			 }
			 ?>
                  </div></td>
              </tr>
              <tr>
                <td colspan="2">Name:&nbsp;<strong><?php echo $fname.' '.$mname.'  '.$lname?></strong></td>
              </tr>
			   <tr>
                <td colspan="2">Adm:&nbsp;<strong><?php echo $adm?></strong> Form: <?php echo  $form. " ".$streamin?></td>
              </tr>
			 
			 <tr>
			 <td>
			 <table width="350px;" border="1">
			 <thead>
			 <th></th><th>B/F</th><th>Payable</th><th>Paid</th> <th>Bal</th>
			 </thead>
              <tr>
                <td>TERM 1:</td>
				
				 <td align="right">
				 <?php
				 if((getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1)))<0){?>
				 <font color="#009933"  size="-1"><strong><?php echo number_format((getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1))),2)?></strong></font> 
				 <?php
				 }else{?>
				  <font color="#FF0000"  size="-1"><strong><?php echo number_format((getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1))),2)?></strong></font> 
				 <?php
				 }
				 ?>
				 </td>
				  <td align="right"> <font color="#FF0000"  size="-1"><strong><?php echo number_format( (getPayableFeesTerm("TERM 1",$year,$form)+(getAddedFeesTerm("TERM 1",$year,$adm))) ,2)?></strong></font></td>
				<td align="right"><font color="#009933"  size="-1"><strong><?php echo number_format(getPaidAmounts($adm,$year,"TERM 1"),2)?></strong></font> </td>
				<td align="right"><font color="#000099"  size="-1"><strong>
				<?php 
				echo number_format( ((getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1))))+(getPayableFeesTerm("TERM 1",$year,$form) +getAddedFeesTerm("TERM 1",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 1")),2);
				
				?>
				</strong></font> </td>
				
              </tr>
              <tr>
                <td>TERM 2:</td>
				<?php
				$t1bal=( ((getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1))))+(getPayableFeesTerm("TERM 1",$year,$form) +getAddedFeesTerm("TERM 1",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 1")));
				?>
				<td align="right"><?php  echo number_format( $t1bal,2)?></td>
                <td align="right"> <font color="#FF0000"  size="-1"><strong><?php echo number_format( (getPayableFeesTerm("TERM 2",$year,$form)+getAddedFeesTerm("TERM 2",$year,$adm)),2)?></strong></font></td>
				<td align="right"><font color="#009933"  size="-1"><strong><?php echo number_format(getPaidAmounts($adm,$year,"TERM 2"),2)?></strong></font> </td>
				<td align="right"><font color="#000099"  size="-1"><strong>
				<?php 
				
				echo number_format( ($t1bal)+(getPayableFeesTerm("TERM 2",$year,$form) +getAddedFeesTerm("TERM 2",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 2")),2);
				
				?>
				</strong></font> </td>
              </tr>
              <tr>
                <td>TERM 3:</td>
				<?php
				$t2bal=( ($t1bal)+(getPayableFeesTerm("TERM 2",$year,$form) +getAddedFeesTerm("TERM 2",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 2")));
				?>
				<td align="right"><?php  echo number_format($t2bal,2)?></td>
                <td align="right"><font color="#FF0000" size="-1"><strong><?php echo number_format( (getPayableFeesTerm("TERM 3",$year,$form)+getAddedFeesTerm("TERM 3",$year,$adm)),2)?></strong></font></td>
				<td align="right"><font color="#009933"  size="-1"><strong><?php echo number_format(getPaidAmounts($adm,$year,"TERM 3"),2)?></strong></font> </td>
				<td align="right"><font color="#000099"  size="-1"><strong>
				<?php
				echo number_format(($t2bal)+(getPayableFeesTerm("TERM 3",$year,$form) +getAddedFeesTerm("TERM 3",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 3")),2);
				
				
				?>
				</strong></font> </td>
              </tr>
			  </table>
			 <?php
			 
			 if($term=="TERM 1"){
			 $pya=(getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1)))+(getPayableFeesTerm($term,$year,$form) +getAddedFeesTerm($term,$year,$adm))-(getPaidAmounts($adm,$year,$term));
			 }
			 if($term=="TERM 2"){
			 $pya=$t1bal+getPayableFeesTerm("TERM 2",$year,$form) +getAddedFeesTerm("TERM 2",$year,$adm)-(getPaidAmounts($adm,$year,"TERM 2"));
			 }
			 if($term=="TERM 3"){
			 $pya=$t2bal+(getPayableFeesTerm($term,$year,$form) +getAddedFeesTerm($term,$year,$adm))-(getPaidAmounts($adm,$year,$term));
			 }
			 echo "Payable ".$pya ;
			 ?>
			  </td>
			  </tr>
			  
			  
            </table></td>
          <td align="left" width="80%"><i style="float:right; font-weight:bold">Processing Receipt #&nbsp; <?php echo $serial?></i>
		  <table class="tablesorter_ordinary bordered_table" width="100%">
              <tr>
                <td>Paying Amount</td>
                <td><input type="text" id="amountpaid" name="amount" class="AmountField" onkeyup="distributeAmount();" onkeypress="return restrictCharacters(this, event, integerOnly);" AUTOCOMPLETE = 'off'  /> </td>
				<td><input type="text" id="fullamt" name="fullamt" class="fullamt" style="padding:5px; background-color:#FFFFFF; border:none" /></td>
              </tr>
			   <tr>
                <td>Being Payment For</td>
                <td><select name="paymentfor" class="select">
                    <option value="School" >School Fees</option>
                    <option value="Admission" >Admission Fees </option>
                  </select>
                </td>
				<td>
				<?php
					require_once('classes/tc_calendar.php');
				  $myCalendar = new tc_calendar("date5", true, false);
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
                <td>Mode of Payment</td>
                <td><select name="mode" class="select" onchange="disableTextBox(this)">
                    <option value="Direct Deposit" >Direct Deposit</option>
                    <option value="Cheque" >Cheque </option>
                    <option value="Money Order" >Money Order </option>
                    <option value="Bursary Cheque" >Bursary Cheque </option>
                    <option value="Cash" >Cash </option>
					  <option value="Mpesa" >Mpesa Lipa Karo </option>
                    <option value="In Kind" >In Kind </option>
                  </select>
                </td>
                <td>
			<table width="100%">
			<tr>
			<td>
			<?php
			$T1arrear=(getPreviousYRPayable(($year-1),$form,$adm)+getPreviousYrBal($adm,($year-1)));
			if($term=="TERM 1"){ 
			$balancebeforethispay=($T1arrear)+(getPayableFeesTerm("TERM 1",$year,$form) +getAddedFeesTerm("TERM 1",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 1"));
			}
			if($term=="TERM 2"){ 
			$balancebeforethispay=($T2arrear)+(getPayableFeesTerm("TERM 2",$year,$form) +getAddedFeesTerm("TERM 2",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 2"));
			}
			if($term=="TERM 3"){ 
			$balancebeforethispay=($T3arrear)+(getPayableFeesTerm("TERM 3",$year,$form) +getAddedFeesTerm("TERM 3",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 3"));
			}
			
			
			?>
			<input type="hidden" name="balancebeforethispay" value="<?php echo $balancebeforethispay?>" />
		<select name="bank" class="select" required>
		  <option value="" selected="selected">-- Select Bank Debited--</option>
		  <option value="CASH">CASH</option>
		 <?php
		 $resultb=mysql_query("select * from bank_accounts") ;
			if (!$resultb) {
			die('Invalid query: ' . mysql_error());
   			}else{
				while($rowb=mysql_fetch_array($resultb)){
				echo "<OPTION VALUE=".str_replace(" ","_",$rowb['bank_name']).">".$rowb['bank_name']."</OPTION>"; 
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
					
                
              </tr>
			  <tr>
			  <td>Arrears <?php 
			   if($term=="TERM 1"){
			   $AYEAR=($year-1);
			   }
			   if($term=="TERM 2"){
			   $AYEAR="TERM 1";
			   }
			   if($term=="TERM 3"){
			   $AYEAR="TERM 2";
			   }
			   echo $AYEAR;
			   ?></td>
			  <td><input type="text"  id="arrears" name="arrears" class="arrears" style="background-color:#FFFFCC; padding:4px; width:50%; padding:4px; margin-bottom:3px; font-weight:bold; font-size:14px;" /></td>
			  <?php
			  $tabno=0;
			 		 $sqlquly = "select fv.votehead,fv.code,ff.amount from finance_voteheads as fv inner join finance_fees ff
on fv.votehead=ff.votehead  and ff.term=fv.term and fv.fiscal_year=ff.fiscal_yr and fv.fiscal_year ='$year' and fv.term='$term' and ff.form='$form' order by fv.code asc ";
						$getStd1 = mysql_query($sqlquly);
						  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
							$votehead1=$rowstudenc['votehead'];
							$tabno++;
							?>
                  <tr>
				  <td><input type="checkbox"  name="chk[]" checked="checked" /><?php echo str_replace("_"," ",$votehead1)  ?> </td>
				  
                  <td colspan="2"> <input type="text"   name="amounts[]" id="rate<?php echo $tabno; ?>" class="term1" tabindex="<?php echo $tabno?>" style="background-color:#FFFFCC; padding:4px; width:50%; padding:4px; margin-bottom:3px; font-weight:bold; font-size:14px;" onkeypress="return restrictCharacters(this, event, integerOnly);"/></td>
                  </tr>
                <?php 
				} 
				
				?>
              <tr>
			  <td colspan="2">
			  <table width="100%">
			  <tr>
                <td align="right"><input type="submit" class="button_ black" value="Save & Print Receipt" onclick="return validateForm();" /> </td>
				 <td align="right"><input type="reset" class="button_ black" value="Cancel" onclick="window.location='finance_collect_fees.php'" /></td>
				</tr>
				</table>
				</td>
              </tr>
            </table></td>
          <!--<td align="right" valign="middle">
		
		</td>-->
        </tr>
      </table>
	   <input type="hidden" name="term" value="<?php echo $term ?>"/>
                  <input type="hidden" name="year" value="<?php echo $year ?>"/>
                  <input type="hidden" name="form" value="<?php echo $form ?>"/>
                  <input type="hidden" name="admno" value="<?php echo $adm ?>"/>
                  <input type="hidden" name="stname" value="<?php echo $fname.' '.$mname.'  '.$lname?>"/>
                  <input type="hidden" name="streamin" value="<?php echo $streamin ?>"/>
				  <input type="hidden" name="serial" value="<?php echo $serial ?>"/>
				  <input type="text" name="overpayment" id="overpayment" />
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
