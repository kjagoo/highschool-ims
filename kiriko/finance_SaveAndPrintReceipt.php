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


function checkArrearsPaid($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Arrears'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
function checkOverpaymentUsed($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	function checkOverpaymentUsedNow($admno,$year,$serial){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments' and receipt_no='$serial'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
function checkOverpaymentNextYear($admno,$year,$term,$updated){
	
	$bal=0;
	$balance = mysql_query("SELECT balance from finance_balances where admno='$admno' and  year='$year' and updated='$updated'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['balance'];
 	}
	return $bal;
	}
	
	function checkArrearsPaidNow($admno,$year,$serial){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Arrears' and receipt_no='$serial'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
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
   <li><a class="active"  href="finance_collect_fees.php">Collect Fees</a></li>
	 <li><a href="finance_collect_income.php">Collect Other Incomes</a></li>
	 <li><a  href="finance_collect_operation.php">Operation Distribution</a></li>
	  <li><a  href="finance_collect_tution.php">Tution Distribution</a></li>
    <li><a href="finance_collect_bursaries.php">Collect Bursaries</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
	$year=$_POST['year'];
	$form = $_POST['form'];
	$term=$_POST['term'];
	$admnu=$_POST['admno'];
	$stname=$_POST['stname'];
	$stream=$_POST['streamin'];
	$paymentfor=$_POST['paymentfor'];
	$serial=$_POST['serial'];
	$over_payment_term=$_POST['overpayment'];
	/***************************************************/
	$paidamount=$_POST['amount'];
	$fullamount=$_POST['fullamt'];
	$arrears=$_POST['arrears'];
	$modeofpay=$_POST['mode'];
	$balancebeforethispay=$_POST['balancebeforethispay'];
	
	if(!isset($_POST['bank']) ) {
	$bankname="N/A";
	$bankreceipt="N/A";
	
	}else{
	$bankname=$_POST['bank'];
	$bankreceipt=$_POST['bankreceipt'];
	
	}
	
	$cashes=$_POST['amounts'];
	
	$totalv=0;
		foreach($cashes as $a => $b){ 
		$totalv+=$cashes[$a];
		}
		
		/*if($paidamount==0 && $fullamount>0 ){
		$paidamount=$fullamount;
		}*/
		
	
$checkedbal=0;	
$checkedbal=checkArrearsPaid($admnu,$year);	
		
if($totalv>$fullamount){ ?>
    <script language=javascript>alert('Error!\n\nVote head distribution Exceeds total amount paid '+<?php echo $totalv?>) </script>
    <script language=javascript>window.location='finance_collect_fees.php' </script>
    <?php	
}else if($fullamount < $totalv){

?>

<script language=javascript>alert('Error!\n\nVote head distribution is less than the total amount') </script>
<script language=javascript>window.location='finance_collect_fees.php' </script>
<?php	

}else{

	//$date = date("Y-m-d");
	$date=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
	
	if($term=="TERM 1" && $arrears>0){
	
		$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
		$qurya = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
		VALUES ('$serial','$admnu','$date','$modeofpay','Parents','Arrears','$arrears','$term','$year','OK','$username','$paidamount','$words','$bankname','-','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";
		$resultsa = mysql_query($qurya);
	
	
	}
	
	if($term=="TERM 2" && $arrears>0){
	
		$ArrearsLastYear=((getPreviousYRPayable(($year-1),$form,$admnu)+getPreviousYrBal($admnu,($year-1)))-(checkArrearsPaid($admnu,$year))-checkOverpaymentsUsed($admnu,$year));
	
		$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
		
		if($ArrearsLastYear>0){
		 
		 $todistribute=$arrears-$ArrearsLastYear;
	
	
			
		$qurya = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
VALUES('$serial','$admnu','$date','$modeofpay','Parents','Arrears','$ArrearsLastYear','$term','$year','OK','$username','$paidamount','$words','$bankname','-','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";
		$resultsa = mysql_query($qurya);
		
			distributeTermFees('TERM 1',$year,$form,$admnu,$todistribute,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
			
		}else{
			distributeTermFees('TERM 1',$year,$form,$admnu,$arrears,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
		}
		
	
	}
	if($term=="TERM 3" && $arrears>0){
	$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
	$ArrearsLastYear=((getPreviousYRPayable(($year-1),$form,$admnu)+getPreviousYrBal($admnu,($year-1)))-(checkArrearsPaid($admnu,$year))-checkOverpaymentsUsed($admnu,$year));//7075
	// check term 1 payment
		if(ArrearsLastYear>0){
			 
			 $todistribute=$arrears-$ArrearsLastYear;//11418-7075
		
		
				$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
			$qurya = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
	VALUES('$serial','$admnu','$date','$modeofpay','Parents','Arrears','$ArrearsLastYear','$term','$year','OK','$username','$paidamount','$words','$bankname','-','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";
			$resultsa = mysql_query($qurya);
			
			
			//get payable fees term1
			$payableterm1=getPayableFeesTerm("TERM 1",$year,$form)+getAddedFeesTerm("TERM 1",$year,$admnu);//7343
				
				if($todistribute>$payableterm1){
				
					$balarrears=$todistribute-$payableterm1;
					
					distributeTermFees('TERM 1',$year,$form,$admnu,$payableterm1,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					
					distributeTermFees('TERM 2',$year,$form,$admnu,$balarrears,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					
				
				}else{
					distributeTermFees('TERM 1',$year,$form,$admnu,$todistribute,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
				}
			
					
		}else{// there is no last year balance
		
		//check term 1 and term 2 balances
			$payableterm1=getPayableFeesTerm("TERM 1",$year,$form)+getAddedFeesTerm("TERM 1",$year,$admnu);//7343
			$paidTerm1=getPaidAmounts($admnu,$year,'TERM 1');
			$balterm1=$payableterm1-$paidTerm1;
			
			if($balterm1>0){//there is unpaid fees term1
			
				if($arrears>$balterm1){
				
					distributeTermFees('TERM 1',$year,$form,$admnu,$balterm1,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					
					$exarrears=$arrears-$balterm1;
					
					distributeTermFees('TERM 2',$year,$form,$admnu,$exarrears,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
				}
			
			
			}else{//there is no balance term 1
			//distribute term 2 fees
			
			distributeTermFees('TERM 2',$year,$form,$admnu,$arrears,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
			
			}
				
				
		}
	
	}
	
	
	
	
	
	
	
	$overpused=0;
	if($fullamount>$paidamount){
	//last year arrears has been used
	$overpused="-".($fullamount-$paidamount);
	$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
$quryo = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
VALUES ('$serial','$admnu','$date','$modeofpay','Parents','Overpayments','$overpused','$term','$year','OK','$username','$paidamount','$words','$bankname','-','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";
$resultso = mysql_query($quryo);
	}
	
	

     $sqlquly = "select fv.votehead,fv.code,ff.amount from finance_voteheads as fv inner join finance_fees ff
on fv.votehead=ff.votehead  and ff.term=fv.term  and fv.fiscal_year=ff.fiscal_yr and fv.fiscal_year ='$year' and fv.term='$term' and ff.form='$form' order by fv.code asc ";
     $getStd1 = mysql_query($sqlquly);
	 $counter =0;
	 while ($rowstudenc= mysql_fetch_array($getStd1 )) {
		$votehead1=$rowstudenc['votehead'];
		
		
		$words=ucfirst(convert_number_to_words($paidamount))."  Shillings only";
$qury = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
VALUES ('$serial','$admnu','$date','$modeofpay','Parents','$votehead1','$cashes[$counter]','$term','$year','OK','$username','$paidamount','$words','$bankname','-','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";

		$counter++;
		$results = mysql_query($qury);
		
		
	 if (!$results) {
		die('Invalid query: ' . mysql_error());
   	}else{
	
	
	}					
 }							

	}
	
	
function distributeTermFees($term,$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,$balances,$paymentfor,$bankreceipt){
	
$tabno=0;
  $sqlquly = "select fv.votehead,fv.code,ff.amount from finance_voteheads as fv inner join finance_fees ff on fv.votehead=ff.votehead  and ff.term=fv.term and
 ff.form='$form' and fv.fiscal_year=ff.fiscal_yr  and fv.fiscal_year ='$year' and fv.term='$term' order by fv.code asc";
  $getStd1 = mysql_query($sqlquly);
  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
  	$amounts =$rowstudenc['amount'];
	$votehead=$rowstudenc['votehead'];
	$tabno++;
	
	$balas=0;
	$getvbals = mysql_query("select COALESCE(SUM(votehead_amt),0) as bal from finance_feestructures where admno='$admnu' and  year='$year' and term='$term' and votehead='$votehead'  and statusis='OK'");
	while ($rowbal= mysql_fetch_array($getvbals )) {
  	$balas =$rowbal['bal'];
	}
	
	
	$vals=($amounts-$balas);
	if($over_payment_term <= $vals){
	$qury = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
VALUES ('$serial','$admnu','$date','$modeofpay','Parents','$votehead','$over_payment_term','$term','$year','OK','$username','$paidamount','$words','$bankname','$balances','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";

		$results = mysql_query($qury);
		
		 $over_payment_term= 0;
		
	}else{
	
	 //if($over_payment_term > ($amounts-$balas) ){	
	
	
	 $val=$amounts-$balas;
	
	 $qury = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
VALUES ('$serial','$admnu','$date','$modeofpay','Parents','$votehead','$val','$term','$year','OK','$username','$paidamount','$words','$bankname','$balances','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";

		$results = mysql_query($qury);
	if(!$results){
	echo mysql_error();
	}
	  $over_payment_term= $over_payment_term- $val ;
	 
	 }

  	
	}//end of while getting available voteheads
	
	}
	
	function getPaidAmounts($admno,$year,$term){
	
	$paidAmount=0;
	$paid = mysql_query("SELECT sum(votehead_amt) as amount from finance_feestructures  where admno='$admno' and  year='$year' and term='$term' and votehead !='Overpayments'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($paid)) {
	$paidAmount=$rowpai['amount'];
 	}
	return $paidAmount;
	}
	
	function getLastYrBalance($admno,$year,$term,$updated){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term' and updated='$updated'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
	function getBalance($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}
//Generate and display Receipt
	
	
	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	$web=$de['website'];
	$email=$de['email'];
	}
	$date = date("Y/m/d");
$term1 = substr($term, -1);

function checkOverpaymentsUsed($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments'  and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
	}

		$payableterm1=getPayableFeesTerm("TERM 1",$year,$form)+getAddedFeesTerm("TERM 1",$year,$admnu);
		$payableterm2=getPayableFeesTerm("TERM 2",$year,$form)+getAddedFeesTerm("TERM 2",$year,$admnu);
		$payableterm3=getPayableFeesTerm("TERM 3",$year,$form)+getAddedFeesTerm("TERM 3",$year,$admnu);

		$bal_last_term1=(getPreviousYRPayable(($year-1),$form,$admnu)+getPreviousYrBal($admnu,($year-1)))-(checkArrearsPaid($admnu,$year))-checkOverpaymentsUsed($admnu,$year);
		$bal_last_term2=$bal_last_term1+$payableterm1;
		$bal_last_term3=$bal_last_term2+$payableterm2;
		
	
	
			if($term=="TERM 1"){
			   $lbal=$bal_last_term1;
			   $lastyear=($year-1);
			   $lastyearbal=$bal_last_term1;
			  }
			   if($term=="TERM 2"){
			   $lbal=$bal_last_term2;
			   $lastyear=($year-1);
			   $lastyearbal=$bal_last_term2;
			  }
			   if($term=="TERM 3"){
			   $lbal=$bal_last_term3;
			   $lastyear=($year-1);
			   $lastyearbal=$bal_last_term3;
			  }
			  $nextterm_one="";
			  $nextterm="";
			  
			  if($term == 'TERM 1') {
			 	 $nextterm = "TERM 2";
				 $nextterm_one = "TERM 3";
			  }
			  if($term == 'TERM 2') {
			 	 $nextterm = "TERM 3";
			  }
			 
			
	
?>
    <div id=tableReceipt>
      <table class="table_printable" align="center" border="0" width="100%">
        <tr>
          <td>
			<?php 
			$forTerm=$term;
			//echo $over_payment_term;
			$overpayment=0;
			$excess=0;
			$balancetitle="";
			$termBal="";
			$yearBal="";
			//$date = date("Y-m-d");
			$date=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
			$additionalmessage="";
			$alreadyPaidOvers=checkOverpaymentNextYear($admnu,($year+1),"TERM 1",$year);
			
			
			if($over_payment_term<=0){// no overpayments made
					$forTerm=$term;
					
					//get balance this term
					
					//if($lbal>0){
					//$balance= ((getPayableFeesTerm($term,$year,$form)+getAddedFeesTerm($term,$year,$admnu))-getPaidAmounts($admnu,$year,$term))+;
					//}else{
					//$balance= (getPayableFeesTerm($term,$year,$form)+getAddedFeesTerm($term,$year,$admnu))-getPaidAmounts($admnu,$year,$term);
					//}	
					$balance=$balancebeforethispay-	$paidamount;
					$balanceafterpayment=$balancebeforethispay-	$paidamount;	
					$balancetitle="Balance ".$term;
					$termBal=$term;
					$yearBal=$year;
					
					$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
				
			}else{//there is some overpaid amounts
			
				if($term=='TERM 1'){
					//we distribute to term2 since term one has been distributed
				$term2Payable=(getPayableFeesTerm("TERM 2",$year,$form)+getAddedFeesTerm("TERM 2",$year,$admnu))-getPaidAmounts($admnu,$year,'TERM 2');
					
					if($over_payment_term<=$term2Payable){// check if the over_payment_term covers term 2 payable fees
						//distribute term2 fees
						distributeTermFees('TERM 2',$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
						
						$balance= ($term2Payable)-getPaidAmounts($admnu,$year,'TERM 2');
						
						$forTerm=$term .' &  2';
						$balancetitle="Balance TERM 2";
						$termBal="TERM 2";
						$yearBal=$year;
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						
					}else{
					//distribute term2 fees
					distributeTermFees('TERM 2',$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					//get excess amount as next term fees
					$excess=$over_payment_term-$term2Payable;
					
					$term3Payable=(getPayableFeesTerm("TERM 3",$year,$form)+getAddedFeesTerm("TERM 3",$year,$admnu))-getPaidAmounts($admnu,$year,'TERM 3');
					
					    if($excess<=$term3Payable){
						
						//distributeTermFees('TERM 2',$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					
						//distribute term 3
						distributeTermFees('TERM 3',$year,$form,$admnu,$excess,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
						
						$forTerm=$term .' ,  2 &  3';
						$balance= ($term3Payable)-($excess);
						
						$balancetitle="Balance TERM 3";
						$termBal="TERM 3";
						$yearBal=$year;
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						
						}else{
						//distribute term 3
						
						distributeTermFees('TERM 3',$year,$form,$admnu,$excess,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
						//get excess amount as overpayment
						$overpayment=$term3Payable-$excess;
						$overpaymentR=$excess-$term3Payable;
						$forTerm=$term .' & 2 &  3';
						
						//$balance= ($term3Payable)-getPaidAmounts($admnu,$year,'TERM 3');
						
						if($overpayment<0){ //means there is overpayment
						
						//echo "alreadyPaidOvers ". $alreadyPaidOvers." overpayment".$overpayment;
						$balancetitle="Overpayment ". ($year +1);
						if($alreadyPaidOvers<0){
						$balance=($overpayment);
						}else{
						$balance=($overpayment+$alreadyPaidOvers);
						}
						$termBal="TERM 1";
						$yearBal=($year +1);
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						
			 
			
						}else{ //means there is no overpayment
						$balance=($overpayment);
						$termBal="TERM 1";
						$yearBal=($year +1);
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
							
							
						}
						
						if($excess==$paidamount){
							 $quryb = "INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
							VALUES ('$serial','$admnu','$date','$modeofpay','Parents','Overpayments $yearBal','$overpaymentR','$term','$yearBal','OK','$username','$paidamount','$words','$bankname','$balance','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'";

		$resultsb = mysql_query($quryb);
		if (!$resultsb) {
			die('Invalid query: ' . mysql_error());
   			}else{}
						$additionalmessage="<tr><td><span id=receiptText>OVERPAYMENT&nbsp; $yearBal</span></td>
				<td><span id=receiptText>OVERPAYMENT&nbsp; $yearBal</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$overpaymentR,2)."</span></td>
				</tr>"; 
						}
						}//END OF ELSE
					
					}
				}
				
				if($term=='TERM 2'){
				$term3Payable=getPayableFeesTerm("TERM 3",$year,$form)+getAddedFeesTerm("TERM 3",$year,$admnu)-getPaidAmounts($admnu,$year,'TERM 3');
				
					if($over_payment_term<=$term3Payable){
						
						//distribute term3 fees
						distributeTermFees('TERM 3',$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
						$forTerm=$term .' &  3';
						
						$balance= ($term3Payable)-$over_payment_term;
						
						$balancetitle="Balance TERM 3";
						$termBal="TERM 3";
						$yearBal=$year;
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						
						
					}else{
					//distribute term3 fees
					
					//$date = date("Y-m-d");
					$date=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
						distributeTermFees('TERM 3',$year,$form,$admnu,$over_payment_term,$serial,$date,$modeofpay,$username,$paidamount,$words,$bankname,0,$paymentfor,$bankreceipt);
					//get excess amount as overpayment
					$overpayment=$term3Payable-$over_payment_term;
						$forTerm=$term .' &  3';
						
						
						
						if($alreadyPaidOvers<0){
						$balance=($overpayment);
						}else{
						$balance=($overpayment+$alreadyPaidOvers);
						}
						/*if($overpayment<0){
						$balance=$overpayment;
						}else{
						$balance= ($term3Payable)-getPaidAmounts($admnu,$year,'TERM 3');
						}*/
						//if($balance<0){
						$balancetitle="Overpayment ". ($year +1);
						$termBal="TERM 1";
						$yearBal=($year +1);
						//$balance=$overpayment;
						
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						//} 
						
					}
				}
				
				
				if($term=='TERM 3'){
					//get excess amount as overpayment
					$term3Payable=getPayableFeesTerm("TERM 3",$year,$form)+getAddedFeesTerm("TERM 3",$year,$admnu)-getPaidAmounts($admnu,$year,'TERM 3');
					$overpayment=$over_payment_term;
						$forTerm=$term;
						
						//$balance= ($term3Payable)-getPaidAmounts($admnu,$year,'TERM 3');
						$balance=$overpayment;
					if($balance<0){
					
						$balancetitle="Overpayment ". ($year +1);
						$termBal="TERM 1";
						$yearBal=($year +1);
						$balance="-".$overpayment;
						$resultsupdate = mysql_query("insert into finance_balances (admno,term,year,balance,updated) values('$admnu','$termBal','$yearBal','$balance','$year') on duplicate key update  balance='$balance'");
						mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
						
						$balance=$overpayment;
						}
				}
				
				
			
			}
			
			
			?>
			
            <table width="100%" border="0">
             <tr>
                <td colspan="4" align="center"><span id="receiptText"><strong><?php echo $schoolname;?></strong></span><br/>
				 <span id="receiptText">P.o. Box &nbsp;<?php echo $po?></span><br/>
				 <span id="receiptText">Tel:&nbsp;&nbsp;<?php echo $tele;?></span></td>
				 <td>Receipt Ref No.<span id="receiptText"><strong>#<?php echo $serial;?></strong></span><br/>
				 Date:&nbsp;&nbsp;<span id="receiptText"><u> <?php echo $date;?></u></span></td>
              </tr>
              <tr>
                <td>Received From </td>
                <td colspan="3"><span id="receiptText"><?php echo str_replace("&","'",$stname);?></span></td>
                <td>Admno: .. <span id="receiptText"><?php echo $admnu;?></span></td>
              </tr>
              <tr>
                <td>Form: </td>
                <td><span id="receiptText"><?php echo $form;?>&nbsp;<?php echo  $stream?></span> </td>
                <td>Year:&nbsp;&nbsp; <span id="receiptText"><?php echo $year;?></span></td>
				
                <td>Term:&nbsp;&nbsp; <span id="receiptText"><?php echo $forTerm;?></span></td>
				
                <td>Mode: .. <span id="receiptText"><?php echo $modeofpay;?></span></td>
              </tr>
              <tr>
                <td>Amount (Words) </td>
                <td colspan="5"><span id="receiptText"><?php echo ucfirst(convert_number_to_words($paidamount)); ?>&nbsp; Shillings only</span></td>
              </tr>
			  <tr>
                <td>Being Payment for: </td>
                <td colspan="5"><span id="receiptText"><?php echo ucfirst($paymentfor); ?> Fees</span></td>
              </tr>
            </table>
			</td>
			
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
			  
			 
			  if($lbal<0){
			 //IF TRUE THER WAS OVERPAYMENT
			//check how much overpayment has been used
			 if(checkOverpaymentUsedNow($admnu,$year,$serial)!=0){
			 echo "<tr><td><span id=receiptText>OVERPAYMENT&nbsp; $lastyear</span></td>
				<td><span id=receiptText>OVERPAYMENT&nbsp; $lastyear</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)(checkOverpaymentUsedNow($admnu,$year,$serial)),2)."</span></td>
				</tr>";
				}
			 }
			 
			 if($lastyearbal>0){
			 //IF TRUE THER WAS arrears
			 $currentbal=$lastyearbal+checkArrearsPaidNow($admnu,$year,$serial)-checkArrearsPaid($admnu,$year);
			
			  if(checkArrearsPaidNow($admnu,$year,$serial)>0){
			 echo "<tr><td><span id=receiptText>Arrears&nbsp; $lastyear</span></td>
				<td><span id=receiptText>Arrears&nbsp; $lastyear </span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)((checkArrearsPaidNow($admnu,$year,$serial))),2)."</span></td>
				</tr>";
				}
				
			 }
			  $rowscount1=0;
		  $rowscount2=0;
		   $rowscount3=0;
		   
		   $sqlquly1 = "select * from finance_feestructures where receipt_no ='$serial' and term='TERM 1' and votehead_amt!=0    ORDER by  votehead ASC ";
		    $getStd11 = mysql_query($sqlquly1);
		 $rowscount1=mysql_num_rows($getStd11);
		 if($rowscount1==1 ||$rowscount1>1){
		 ?>
		 <tr><td colspan="3">*****************   Distribution for TERM 1   ***************** </td></tr>
		 <?php
	 while ($rowstudenc= mysql_fetch_array($getStd11 )) {
		$votehead1s=str_replace("_"," ",$rowstudenc['votehead']);
		$amount=str_replace("_"," ",$rowstudenc['votehead_amt']);
			 echo "<tr><td><span id=receiptText>$votehead1s &nbsp;</span></td>
				<td><span id=receiptText>$votehead1s</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$amount,2)."</span></td>
				</tr>";
			}//end of while
		 }	//end of while
		 
		 
		  $sqlquly2 = "select * from finance_feestructures where receipt_no ='$serial' and term='TERM 2' and votehead_amt>0 having votehead_amt>0 and votehead!='Arrears' ORDER by  votehead ASC ";
		  $getStd12 = mysql_query($sqlquly2);
		 $rowscount2=mysql_num_rows($getStd12);
		 if($rowscount2==1 ||$rowscount2>1){
		 ?>
		 <tr><td colspan="3">*****************   Distribution for TERM 2   ***************** </td></tr>
		 <?php
	 while ($rowstudenc= mysql_fetch_array($getStd12 )) {
		$votehead1s=str_replace("_"," ",$rowstudenc['votehead']);
		$amount=str_replace("_"," ",$rowstudenc['votehead_amt']);
		
			 echo "<tr><td><span id=receiptText>$votehead1s &nbsp;</span></td>
				<td><span id=receiptText>$votehead1s</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$amount,2)."</span></td>
				</tr>";
			}//end of while
		 }//end of while
		
		
		 $sqlquly3 = "select * from finance_feestructures where receipt_no ='$serial' and term='TERM 3' and votehead_amt>0 having votehead_amt>0 and votehead!='Arrears' ORDER by  votehead ASC";
		 $getStd13 = mysql_query($sqlquly3);
		 $rowscount3=mysql_num_rows($getStd13);
		 if($rowscount3==1 ||$rowscount3>1){
		 ?>
		
		 <tr><td colspan="3">*****************   Distribution for TERM 3   ***************** </td></tr>
		 <?php
	 while ($rowstudenc= mysql_fetch_array($getStd13 )) {
		$votehead1s=str_replace("_"," ",$rowstudenc['votehead']);
		$amount=str_replace("_"," ",$rowstudenc['votehead_amt']);
		
			 echo "<tr><td><span id=receiptText>$votehead1s &nbsp;</span></td>
				<td><span id=receiptText>$votehead1s</span></td>
				<td align=right style=padding-right:10px;><span id=receiptText>".number_format((float)$amount,2)."</span></td>
				</tr>";
			}//end of while
		 }	//end of while
		 
		
		date_default_timezone_set("Africa/Nairobi");
			 
			
			 
	mysql_query("update finance_feestructures set balance='$balance' where receipt_no='$serial'");
	
	if($balance<0){
	$yearBal1=$year+1;
	$overpaymentnextyear1=-1*$balance;
		mysql_query("INSERT INTO finance_feestructures(receipt_no, admno,dateofpay,modeofpay,mainaccount,votehead,votehead_amt,term,YEAR,statusis,servedby,total_amount,words,bank_account,balance,payment_for,bankreceipt)
							VALUES ('$serial','$admnu','$date','$modeofpay','Parents','Overpayments $yearBal1','$overpaymentnextyear1','$term','$year','OK','$username','$paidamount','$words','$bankname','$balance','$paymentfor','$bankreceipt') on duplicate key update receipt_no='$serial'");
	
	}
	
	
			?>
			
			
			
              <tr>
                <td colspan="2" align="right" style="padding-right:10px;">&nbsp;</td>
                <td><hr /></td>
              </tr>
              <tr>
			  
                <td colspan="2" align="right">Total</td>
                <td align="right" style="padding-right:10px;"><span id="receiptText"><?php echo number_format($paidamount,2);?></span></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><?php echo $balancetitle?> </td>
                <td align="right" style="padding-right:10px;"><span id="receiptText"><?php echo number_format($balance,2);?></span></td>
              </tr>
              <!--<tr>
                <td colspan="3" align="left">Chq No/ Money Order No<span id="receiptText"><strong> # <?php //echo $bankreceipt;?></strong></span></td>
              </tr>-->
              <tr>
                <td colspan="3">Chq No/ Money Order No<span id="receiptText"><strong> # <?php echo $bankname .":- ".$bankreceipt    ;?></strong></span> &nbsp;&nbsp;<i>You were served by: <span id="receiptText"><?php echo getLoggedUser($user_id);?></i> <!--<I>***Advice not valid unless Transaction Number is shown***</I> --></span></td>
              </tr>
			  
            </table>
			
			</td>
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
