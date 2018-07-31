<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
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
    <td class='dataListHeader' colspan='4'>Printed Estimates for the Year: <?php echo $finance->getFiscalYear()?>
	<div style="float:right; margin-right:20px">
		  <table width="150px;"><tr><td align="center"><a href="finance_set_estimates.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td><td align="right"><a href="finance_estimates.php" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td></tr></table></div>
	</td>
  </tr>
  <td><form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post">
        <table width="100%" class="borders">
		  <?php
		  $result = mysql_query("select distinct(votehead) from finance_voteheads where fiscal_year='".$finance->getFiscalYear()."' order by votehead asc");
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  $num=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
		  	<tr>
			<td class="alterCell" width="25%"><?php echo $row['votehead']?></td>
		  	<td>
			<input type="hidden" name="votehead[]" value="<?php echo $row['votehead']?>" />
			<input type="number" name="voteheadamount[]" class="inputFields"  required  tabindex="<?php echo $num?>" placeholder='0.00' /></td>
        	</tr>
		  
		  <?php 
		  	}
		  }
		  ?>
		 
          <tr>
            <td class="alterCell"></td>
            <td><input type="submit" name="submit" value="Save Estimates" class="btn btn-primary"/></td>
          </tr>
        </table>
      <input type="hidden" name="yr" value="<?php echo $finance->getFiscalYear()?>" />
      </form></td>
</table>
<?php
if(isset($_POST['votehead'])){
 require_once("includes/dbconnector.php"); 
$votehead = $_POST['votehead'];
$yr= $_POST['yr'];
$numded = count($votehead);

for ($i=0; $i < $numded; $i++){
$voteheadname=$_POST['votehead'][$i];
$voteheadamount=$_POST['voteheadamount'][$i];

 $query="insert into finance_estimates (fiscal_yr,votehead,amount) 
	values('$yr','$voteheadname','$voteheadamount') 
	on duplicate key update fiscal_yr='$yr'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}

}?>

 <script language=javascript> alert('Printed Estimates Have been recorded Successfuly');</script>
 <script type='text/javascript'>window.open('finance_estimates.php','content');</script>
<?php 
	}
 ?>
</body>
</html>
