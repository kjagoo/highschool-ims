<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script>

$(document).ready(function () {

     //iterate through each textboxes and add keyup
     //handler to trigger sum event
     $(".inputFields1").each(function () {

         $(this).keyup(function () {
             calculateSum();
         });
     });

 });

 function calculateSum() {

     var sum = 0;
     //iterate through each textboxes and add the values
     $(".inputFields1").each(function () {

         //add only if the value is number
         if (!isNaN(this.value) && this.value.length != 0) {
             sum += parseFloat(this.value);
         }

     });
     //.toFixed() method will roundoff the final sum to 2 decimal places
     $("#payable").val(sum.toFixed(2));
 }
 
/*function doMath(id) {
 var total_payable = Number(document.getElementById('payable').value);
 
 var txtbox = document.getElementById(id);
 var value = Number(txtbox.value);

 var total=total_payable+value;
 
 document.getElementById('payable').value = Number(total).toFixed(2);


}*/

</script>
</head>
<body>
<div class="clear"></div>
<?php
 require_once("includes/dbconnector.php"); 
include 'includes/Finance.php';
$finance = new Financials(); 

?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Setting Fees Current Open Year: <?php echo $finance->getFiscalYear()?>
	<div style="float:right; margin-right:20px">
		  <table width="150px;"><tr><td align="center"><a href="finance_set_fees.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td><td align="right"><a href="finance_setfees.php" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td></tr></table></div>
	</td>
  </tr>
  <td>
  <?php
  $terms=$_GET['term'];
  $forms = $_GET['form'];
		  $result = mysql_query("select * from finance_voteheads where fiscal_year='".$finance->getFiscalYear()."' and term='$terms' order by votehead asc");
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){ ?>
		  
		  
  
  <form name="form" action="save_fees_settings.php"  method="post">
        <table width="100%" class="borders">
		
		<table align="right">
		<tr><td>Payable Amount</td></tr>
		<tr><td><input type="text" readonly="readonly" id="payable" name="payable" class="AmountField" style="background-color:#FFFFCC" placeholder='0.00' /></td>
		</tr>
		</table>
	 
		  <?php
		  $num=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
		  	<tr>
			<td class="alterCell" width="20%"><?php echo $row['votehead']?></td>
		  	<td>
			<input type="hidden" name="votehead[]" value="<?php echo $row['votehead']?>" />
			<input type="number" name="payableamount[]" id="<?php echo $num?>" class="inputFields1"  required  tabindex="<?php echo $num?>" placeholder='0.00' /></td>
        	</tr>
		  
		  <?php 
		  	}
		  ?>
		 
          <tr>
            <td class="alterCell"></td>
            <td><input type="submit" name="submit" value="Save Setting" class="btn btn-primary"/></td>
          </tr>
        </table>
     <input type="hidden" name="term" value="<?php echo $terms?>" />
	 <input type="hidden" name="form" value="<?php echo $forms?>" />
	 <input type="hidden" name="year" value=" <?php echo $finance->getFiscalYear()?>" />
      </form>
	  <?php
	  }else{ ?>
	 <table width="60%"><tr><td> <h1>Please set Operational Voteheads</h1></td><td align="center"><a href="finance_voteheads.php" target="content">here</a></td></tr></table>
	  
	 <?php
	  }
	  ?>
	  </td>
</table>

</body>
</html>
