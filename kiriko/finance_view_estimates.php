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

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
</head>
<body>
<div class="clear"></div>
<?php
 require_once("includes/dbconnector.php"); 
include 'includes/Finance.php';

$finance = $_GET['previousyrs']; 

?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Printed Estimates for the Year: <?php echo $finance?>
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
		   <td align="left"><a href="#openModalNew" title="Add New Votehead"><i class="icon icon-green icon-plus"></i>New Votehead</a></td>
			
            <td align="center"><a href="finance_view_estimates.php?previousyrs=<?php echo $finance?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            <td align="right"><a href="finance_estimates.php" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>close</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table width="100%" class="table table-striped table-bordered">
   			<thead>
              <tr> 
			  <th width="10px"></th>
			   <th>Votehead</th>
               <th>Amount</th>
			   <th>Debit</th>
			  <th>Credit</th>
			  <th>Balance</th>
			</tr>
			</thead>
			<tbody>
        <?php
		  $result = mysql_query("select distinct(votehead) from finance_estimates where fiscal_yr='".$finance."' order by votehead asc");
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  
		  $num=0;
		  $totalb=0;
		   $thisamount=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
        <tr>
		  <td><a href="#openModal<?php echo $row['votehead']?>"><span class="icon icon-orange icon-edit"></span></a>
	
	<div id="openModal<?php echo $row['votehead']?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Edit Votehead Settings</font></td>
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
		  <input type="hidden" name="cryr" value="<?php echo $finance?>" />
		  <input type="hidden" name="vote" value="<?php echo  $row['votehead']?>" />
        </form>
      </div>
    </div>
	
		  </td>
          <td class="alterCell" width="25%"><?php echo $row['votehead']?></td>
          <td align="right"><?php echo number_format($row['amount'],2)?> </td>
		  <td></td>
		  <td></td>
		  <td></td>
        </tr>
        <?php 
		$thisamount=$row['amount'];
		  $totalb+=$thisamount;
		  	}
			?>
		</tbody>
		<tfoot>
        <tr>
          <th colspan="2" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
          <th align="right" style="font-weight:bold;"><?php echo number_format($totalb,2)?></th>
		  <th align="right" style="font-weight:bold;"></th>
		  <th align="right" style="font-weight:bold;"></th>
		  <th align="right" style="font-weight:bold;"></th>
        </tr>
		</tfoot>
        <?php  }
		  ?>
      </table></td>
</table>

<div id="openModalNew" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">New Votehead Settings</font></td>
            </tr>
            <tr>
              <td class="alterCell" width="35%">Select Votehead</td>
          		<td>
		  <select name="voteh" class="select" required  tabindex="1" >
		  <option value="">-- Select Votehead--</option>
		  <?php
		  $queryv=("SELECT DISTINCT votehead FROM finance_voteheads WHERE NOT EXISTS (SELECT * FROM finance_estimates
                    WHERE finance_estimates.votehead = finance_voteheads.votehead)  and fiscal_year='$finance'");
			$resultv=mysql_query($queryv) ;
				while($rowv=mysql_fetch_array($resultv)){
				echo "<OPTION VALUE=".$rowv['votehead'].">".$rowv['votehead']."</OPTION>"; }
			?>
			</select>
			</td>
			</tr>
			<tr>
			<td class="alterCell" width="35%">Amount Estimate</td>
			 <td><input type="number" name="eamt" class="inputFields" autofocus required  tabindex="2"  /></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="35%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="curryr" value="<?php echo $finance?>" />
        </form>
      </div>
    </div>
<?php
	if(isset($_POST['eamt']) && isset($_POST['voteh'])){
	require_once("includes/dbconnector.php");
	
	$yr=$_POST['curryr'];
	$voteheadname=$_POST['voteh'];
	$voteheadamount=$_POST['eamt'];
	
	$query="insert into finance_estimates (fiscal_yr,votehead,amount) 
	values('$yr','$voteheadname','$voteheadamount') 
	on duplicate key update fiscal_yr='$yr'";
	 $result = mysql_query($query);
	 if (!$result) {
		die('Invalid query: ' . mysql_error());
   	}else{
	$activity = "Added New Votehead to Estimate ".$voteheadname;
	$func->addAuditTrail($activity,$username);
	
	$previousyrs=$yr;
	
	 ?>
	
	<script language=javascript>alert('Printed Estimates Update Successfull') </script>
	
	<script language=javascript>window.location='finance_view_estimates.php?previousyrs=<?php echo $yr?>' </script>
	
	<?php
	}
	}
	
?>  

<?php
	if(isset($_POST['amount']) ){
	require_once("includes/dbconnector.php");
	
	$yr=$_POST['cryr'];
	$votehead=$_POST['vote'];
	$amount=$_POST['amount'];
	
	$date=date("Y-m-d H:i:s a");
	$qury="update finance_estimates set amount='$amount' where votehead='$votehead' and fiscal_yr='$yr'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Updated Votehead Amount ".$votehead;
	$func->addAuditTrail($activity,$username);
	
	$previousyrs=$yr;
	
	 ?>
	
	<script language=javascript>alert('Votehead Update Successfull') </script>
	
	<script language=javascript>window.location='finance_view_estimates.php?previousyrs=<?php echo $yr?>' </script>
	
	<?php
	}
	}
	
?>  
</body>
</html>
