<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Printed Estimates page";
$func->addAuditTrail($activity,$username);
?>
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
if(isset($_GET['year'])){
 require_once("includes/dbconnector.php"); 
 include 'includes/Finance.php';
	$finacial= new Financials();

	$finance = $_GET['year']; 
	$form = $_GET['form']; 
	$term = $_GET['term']; 
	
	

?>
 
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Available Set Fees for the Year: <?php echo $finance?>
      <div style="float:right; margin-right:20px">
        <table width="150px;">
          <tr>
            <td align="center"><a href="finance_view_fees.php?year=<?php echo $finance?>&form=<?php echo $form?>&term=<?php echo $term?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            <td align="right"><a href="finance_viewalreadyset_fees.php" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			  <th width="5%"></th>
			   <th>Votehead</th>
               <th>Payable Amount</th>
			   <th>Budget Estimates</th>
			   <th>Projection</th>
			</tr>
			</thead>
			<tbody>
        <?php
		if($term=='ALL'){
	 $result = mysql_query("select * from finance_fees where fiscal_yr='$finance' and form='$form' order by votehead asc");
	}else{
	 $result = mysql_query("select * from finance_fees where fiscal_yr='$finance' and term='$term' and form='$form' order by votehead asc");
	}
		 
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  
		  $num=0;
		  $totalb=0;
		  $totalbs=0;
		  $totalp=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
        <tr>
		 <td><a href="#openModal<?php echo $row['votehead']?>"><span class="icon icon-orange icon-edit"></span></a>
		 
	<div id="openModal<?php echo $row['votehead']?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateFees.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Edit Votehead Settings</font></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Term:</b></td>
              <td class="alterCell2"><input type="text" name="term" readonly="readonly" class="inputFields" value="<?php echo $term?>" style="background-color:#FFFFCC;"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Year:</b></td>
              <td class="alterCell2"><input type="text" name="year" readonly="readonly" class="inputFields" value="<?php echo $finance?>" style="background-color:#FFFFCC;"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Form:</b></td>
              <td class="alterCell2"><input type="text" name="form" readonly="readonly" class="inputFields" value="<?php echo $form?>" style="background-color:#FFFFCC;"/></td>
            </tr>
            <tr>
              <td class="alterCell" width="25%"><b><?php echo $row['votehead']?>:</b></td>
              <td class="alterCell2"><input type="number" name="amount" class="inputFields" autofocus required  tabindex="1" value="<?php echo $row['amount']?>"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="vote" value="<?php echo  $row['votehead']?>" />
        </form>
      </div>
    </div>
	
	
		 
		 </td>
          <td class="alterCell" width="25%"><?php echo $row['votehead']?></td>
          <td align="right"><?php echo number_format($row['amount'],2)?> </td>
		  <td align="right"><?php echo number_format(($finacial->getBudget($row['votehead'],$finance)),2)?></td>
		  <td align="right"><?php echo number_format(($finacial->getEstimateProjection($row['votehead'],$finance,$form,$row['amount'])),2)?></td>
        </tr>
		
        <?php 
		  $totalb+=$row['amount'];
		  $totalbs+=($finacial->getBudget($row['votehead'],$finance));
		  $totalp+=($finacial->getEstimateProjection($row['votehead'],$finance,$form,$row['amount']));
		 }
			?>
		</tbody>
		<tfoot>
        <tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalb,2)?></th>
		 <th align="right" style="font-weight:bold;"><?php echo number_format($totalbs,2)?></th>
		  <th align="right" style="font-weight:bold;"><?php echo number_format($totalp,2)?></th>
        </tr>
		</tfoot>
        <?php  }
		  ?>
      </table></td>
</table>
<?php

}else{ ?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Set Fees for the Year: </td>
  </tr>
  <tr>
  <td>
<table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr>
			   <th width="5%">Votehead</th>
               <th>Payable Amount</th>
			   <th>Budget Estimates</th>
			   <th>Annual Projection</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
</td>
</tr>
</table>
<?php 
}

?>
</body>
</html>
