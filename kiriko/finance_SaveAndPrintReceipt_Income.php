<?php
require_once('auth.php');
include('includes/dbconnector.php');
$user_id=$_SESSION['SESS_MEMBER_ID_'];
$username=$_SESSION['SESS_NAME_'];

function getLoggedUser($user_id){
$user=0;
 $sql="select * from staff where idpass='$user_id'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $user=str_replace("&","'",$row['fname'])."  ".str_replace("&","'",$row['lname']);

	return $user;
}


 function convert_number_to_words($number) {
   
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousands',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href="css/printable.css" type="text/css" rel="stylesheet">
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
printDivCSS = new String ('<link rel="stylesheet" href="css/printable.css" type="text/css" media="print" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
	window.location='finance_collect_fees.php';
}
 function Redirect(){
 window.location='finance_collect_fees.php';
 }

</script>
<!--<script type="text/javascript">
function disableSelection(target){
	if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
	else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
    target.style.MozUserSelect="none"
   else //All other route (ie: Opera)
   target.onmousedown=function(){return false}
   target.style.cursor = "default"
 }
 disableSelection(document.body)
 // 

 </script>-->
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
   <ul>
    <li><a href="finance_collect_fees.php">Collect Fees</a></li>
	 <li><a  class="active"  href="finance_collect_income.php">Collect Other Incomes</a></li>
    <li><a href="finance_collect_bursaries.php">Collect Bursaries</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
	$year=$_POST['year'];
	$term=$_POST['term'];
	/***************************************************/
	$source=$_POST['source'];
	$from=$_POST['from'];
	$amount=$_POST['amount'];
	$modeofpay=$_POST['mode'];
	$serial=$_POST['serial'];
	
	if(!isset($_POST['bank']) ) {
	$bankname="-";
	$bankreceipt="-";
	}else{
	$bankname=$_POST['bank'];
	$bankreceipt=$_POST['bankreceipt'];
	}
	

	$date = date("Y-m-d");
	
	$words=ucfirst(convert_number_to_words($amount))."  Shillings only";
$qurya = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for)
VALUES ('$serial','$from','$date','$modeofpay','Parents','Income','$amount','$term','$year','OK','$username','$amount','$words','$bankname','-','$source') on duplicate key update receipt_no='$serial'";
$resultsa = mysql_query($qurya);
	

	

$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$date = date("Y/m/d");	
?>
    <div id=tableReceipt>
     
            <table width="100%" border="0">
             <tr>
                <td colspan="4" align="center"><span id="receiptText"><strong><?php echo $schoolname;?></strong></span><br/>
				 <span id="receiptText">P.o. Box &nbsp;<?php echo $po.',&nbsp;'.$plac;?></span><br/>
				 <span id="receiptText">Tel:&nbsp;&nbsp;<?php echo $tele;?></span></td>
				 <td>Receipt Ref No.<span id="receiptText"><strong>#<?php echo $serial;?></strong></span><br/>
				 Date:&nbsp;&nbsp;<span id="receiptText"><u> <?php echo $date;?></u></span></td>
              </tr>
              <tr>
                <td>Received From </td>
                <td colspan="3"><span id="receiptText"><?php echo $from;?></span></td>
                <td>Admno: .. <span id="receiptText">N/A</span></td>
              </tr>
              <tr>
                <td><strike>Class/</strike> Form: </td>
                <td><span id="receiptText">N/A</span> </td>
                <td>Year:&nbsp;&nbsp; <span id="receiptText"><?php echo $year;?></span></td>
				
                <td>Term:&nbsp;&nbsp; <span id="receiptText"><?php echo $term;?></span></td>
				
                <td>Mode: .. <span id="receiptText"><?php echo $modeofpay;?></span></td>
              </tr>
              <tr>
                <td>Amount (Words) </td>
                <td colspan="5"><span id="receiptText"><?php echo ucfirst(convert_number_to_words($amount)); ?>&nbsp; Shillings only</span></td>
              </tr>
			  <tr>
                <td>Being Payment for: </td>
                <td colspan="5"><span id="receiptText"><?php echo ucfirst($source); ?></span></td>
              </tr>
            </table></td>
			
        </tr>
        <tr>
          <td>
		  
		  
		  <table width="100%" border="0">
		  
		 
			  <tr bgcolor="#D4D4D4" >
                <td><u>Votehead</u></td>
                <td><u>Description</u></td>
                <td align="right" style="padding-right:10px;"><u>Amount</u></td>
              </tr>
			  <?php
			 echo "<tr><td><span id=receiptText>Income &nbsp;</span></td>
				<td><span id=receiptText>$source</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$amount,2)."</span></td>
				</tr>";
				
			?>
			
              <tr>
                <td colspan="2" align="right" style="padding-right:10px;">&nbsp;</td>
                <td><hr /></td>
              </tr>
              <tr>
			  
                <td colspan="2" align="right">Total</td>
                <td align="right" style="padding-right:10px;"><span id="receiptText"><?php echo number_format($amount,2);?></span></td>
              </tr>
              
              <!--<tr>
                <td colspan="3" align="left">Chq No/ Money Order No<span id="receiptText"><strong> # <?php //echo $bankreceipt;?></strong></span></td>
              </tr>-->
              <tr>
                <td colspan="3">Chq No/ Money Order No<span id="receiptText"><strong> # <?php echo $bankname .":- ".$bankreceipt    ;?></strong></span> &nbsp;&nbsp;<i>You were served by: <span id="receiptText"><?php echo getLoggedUser($user_id);;?></i> <!--<I>***Advice not valid unless Transaction Number is shown***</I> --></span></td>
              </tr>
			  <tr>
                <td colspan="3" align="center"><!--<I>***Advice not valid unless Transaction Number is shown***</I> --><br/>For Principal__________________________</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <!-- end of div for printing-->
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
    <table border=0 align=center>
      <tr>
        <td><a href="javascript:printDiv('tableReceipt')">
          <input class='button_ black' type='button' value='Print Receipt' />
          </a></td>
        <td><a href="javascript:Redirect();">
          <input class='button_ black' type='button' value='Serve More' />
          </a></td>
      </tr>
    </table>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
