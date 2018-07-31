<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
$user_id=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();

function getLoggedUser($user_id){
$user=0;
 $sql="select * from staff where idpass='$user_id'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $user=str_replace("&","'",$row['fname'])."  ".str_replace("&","'",$row['lname']);

	return $user;
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
<link href="css/printable.css" type="text/css" rel="stylesheet">
<!-- Initiate tablesorter script -->
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script>
printDivCSS = new String ('<link rel="stylesheet" href="css/printable.css" type="text/css" media="print" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
 

</script>
</head>
<body>
<div class="clear"></div>
<?php
if( isset($_GET["id"]) ){
 require_once("includes/dbconnector.php"); 

	$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
	
	$serial=$_GET['id'];
	

$activity = "Viewed Receipt Copy ".$_GET['id'];
$func->addAuditTrail($activity,$username);


$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$dates = date("Y/m/d");
	$stname="";
	$admno="";
	$form="";
	$stream="";
	$balance=0;
	$datepaid="";
	$totalPaid=0;
	$year="";
	$modeofpay="";
	$words="";
	$paymentfor="";
	$bankname="";
	$servedby="";
	
	$sql="select ff.*, sd.fname,sd.lname,sd.sname,sd.form,sd.class from finance_feestructures as ff inner join studentdetails sd on ff.admno=sd.admno and ff.receipt_no ='$serial'";
	$getStd1s = mysql_query($sql);
	while ($rowstudencs= mysql_fetch_array($getStd1s )) {
	$stname=str_replace("&","'",$rowstudencs['fname'])." ".str_replace("&","'",$rowstudencs['sname'])." ".str_replace("&","'",$rowstudencs['lname']);
	$admno=$rowstudencs['admno'];	
	$form=$rowstudencs['form'];	
	$stream=$rowstudencs['class']; 
	
	}
	
	$sqld="select * from finance_feestructures where receipt_no ='$serial'";
	$getStd1d = mysql_query($sqld);
	while ($rowd= mysql_fetch_array($getStd1d )) {
	
	$modeofpay=$rowd['modeofpay'];   
	$year=$rowd['year']; 
	$term=$rowd['term']; 
	$bankname=$rowd['bank_account'];   
	$servedby=$rowd['servedby']; 
	$words=$rowd['words']; 
	$datepaid=$rowd['dateofpay']; 
	$balance=$rowd['balance']; 
	$totalPaid=$rowd['total_amount']; 
	$paymentfor=$rowd['payment_for'];
	$bankreceipt =$rowd['bankreceipt'];
	}
	
	
	
	
?>
  <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
	  <form name="subjectform" action="delete_receipt.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;Cancel Receipt: <?php echo $serial?></td>
            </tr>
	  <tr><td align="center"><h1>Warning you are about to cancel this receipt</h1><h3><?php echo $serial?></h3></td></tr>
	   <tr>
	   <td class="alterCell3">
	   <table width="100%">
	   <tr>
	   <td width="50%"><input type="submit" name="submit" value="Continue" class="btn btn-primary"/></td>
	    <td align="right"><a href="#close" title="Close" class="btn btn-primary noline">  Ignore  </a></td>
	   </tr>
	   </table>
	   
	   </td>
      </tr>
	  </table>
	  <input type="hidden" name="serial_no" value="<?php echo $serial?>" />
	    <input type="hidden" name="from" value="<?php echo $from?>" />
		  <input type="hidden" name="to" value="<?php echo $to?>" />
	  </form>
	  </div>
    </div>
	
	
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>COPY OF Receipts: <?php echo $serial?>
      <div style="float:right; margin-right:20px; width:40%;">
        <table width="100%;">
          <tr>
            <td align="center"><a href="finance_receipt_copy.php?id=<?php echo $serial?>&date4=<?php echo $from?>&date5=<?php echo $to?>"  class="noline" title="Refresh Page"><i class="icon icon-orange icon-refresh"></i>Refresh</a></td>
			 <td align="center"><a href="#openModal" class="noline" title="Cancel Receipt"><i class="icon icon-orange icon-cancel"></i>Cancel Receipt</a></td>
            <td align="right"><a href="javascript:printDiv('tableReceipt')" class="noline" title="Click to Re-Print Receipt"><i class="icon icon-orange icon-print"></i>RE-Print</a></td>
            <td align="right"><a href="finance_report_view_receipts.php?date4=<?php echo $from?>&date5=<?php echo $to?>"  class="noline" title="Previous Page" target="reportView"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><div id=tableReceipt>
        <table class="table_printable" align="center" border="0" width="100%">
          <tr>
            <td><table width="100%" border="0">
                <tr>
                  <td colspan="4" align="center"><span id="receiptText"><strong><?php echo $schoolname;?></strong></span><br/>
                    <span id="receiptText">P.o. Box &nbsp;<?php echo $po.',&nbsp;'.$plac;?></span><br/>
                    <span id="receiptText">Tel:&nbsp;&nbsp;<?php echo $tele;?></span></td>
                  <td>COPY OF RECEIPT<br/>Ref No.<span id="receiptText"><strong>#<?php echo $serial;?></strong></span><br/>
				  
                    Date Paid:&nbsp;&nbsp;<span id="receiptText"><u> <?php echo $datepaid;?></u></span></td>
                </tr>
                <tr>
                  <td>Received From </td>
                  <td colspan="3"><span id="receiptText"><?php echo $stname;?></span></td>
                  <td>Admno: .. <span id="receiptText"><?php echo $admno;?></span></td>
                </tr>
                <tr>
                  <td><strike>Class/</strike> Form: </td>
                  <td><span id="receiptText"><?php echo $form;?>&nbsp;<?php  echo  $stream?></span> </td>
                  <td>Year:&nbsp;&nbsp; <span id="receiptText"><?php echo $year;?></span></td>
                  <td>Term:&nbsp;&nbsp; <span id="receiptText"><?php echo $term?></span></td>
                  <td>Mode: .. <span id="receiptText"><?php echo $modeofpay;?></span></td>
                </tr>
                <tr>
                  <td>Amount (Words) </td>
                  <td colspan="5"><span id="receiptText"><?php echo $words; ?> </span></td>
                </tr>
                <tr>
                  <td>Being Payment for: </td>
                  <td colspan="5"><span id="receiptText"><?php echo ucfirst($paymentfor); ?> Fees</span></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0">
			<tr bgcolor="#D4D4D4" >
                <td><u>Votehead</u></td>
                <td><u>Description</u></td>
                <td align="right" style="padding-right:10px;"><u>Amount</u></td>
              </tr>
			  
			  <?php
			  
			  $sqlquly = "select * from finance_feestructures where receipt_no ='$serial' and votehead_amt>0 group by votehead having votehead_amt>0";
     $getStd1 = mysql_query($sqlquly);
	 while ($rowstudenc= mysql_fetch_array($getStd1 )) {
		$votehead1s=str_replace("_"," ",$rowstudenc['votehead']);
		$amount=str_replace("_"," ",$rowstudenc['votehead_amt']);
		
			 echo "<tr><td><span id=receiptText>$votehead1s &nbsp;</span></td>
				<td><span id=receiptText>$votehead1s</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$amount,2)."</span></td>
				</tr>";
			
		}	//end of while
		
		date_default_timezone_set("Africa/Nairobi");
			?>
			  
			  
			  
                <tr>
                  <td colspan="2" align="right" style="padding-right:10px;">&nbsp;</td>
                  <td align="right">___________________</td>
                </tr>
                <tr>
                  <td colspan="2" align="right">Total Received</td>
                  <td align="right" style="padding-right:10px;"> <span id="receiptText"><?php echo number_format($totalPaid,2);?></span></td>
                </tr>
                <tr>
                  <td colspan="2" align="right"><?php ?> </td>
                  <td align="right" style="padding-right:10px;"><span id="receiptText"><?php echo number_format($balance,2);?></span></td>
                </tr>
                <tr>
                  <td colspan="3">Chq No/ Money Order No<span id="receiptText"><strong> # <?php echo $bankname .":S/N ".$bankreceipt    ;?></strong></span> &nbsp;&nbsp;<i>You were served by: <span id="receiptText"><?php echo $servedby;?></i><br/><i>Reprinted by: <span id="receiptText"><?php echo  getLoggedUser($user_id);?> &nbsp;on&nbsp;<?php echo date("D M j G:i:s T Y");?></i>
                    <!--<I>***Advice not valid unless Transaction Number is shown***</I> -->
                    </span></td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><!--<I>***Advice not valid unless Transaction Number is shown***</I> -->
                    <br/>
                    For Principal__________________________</td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
      <!-- end of div for printing-->
      <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe></td>
  </tr>
</table>
</td>
</table>
<?php

}else{ ?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Receipts: </td>
  </tr>
  <tr>
    <td><table width="100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Receipt Copy#</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ERROR! NO RECEIPT SELECTED</td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
<?php 
}

?>
</body>
</html>
