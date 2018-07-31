<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<script language="javascript" src="scripts/calendar.js"></script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="hr_createpayslips.php">Create Payslips</a></li>
  </ul>
</div>
<?php
require_once("includes/dbconnector.php"); 
if(isset($_GET['id'])){

$id=$_GET['id'];
$salary=$_GET['sal'];
?>
<table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'><?php echo $id?>: Payslip Details
	<div style="float:right; margin-right:20px">
		  <table width="150px;"><tr><td align="center"><a href="hr_viewcreatepayslips.php?id=<?php echo $id?>&sal=<?php echo $salary?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td><td align="right"><a href="hr_createpayslips.php" title="Previous Page"><i class="icon icon-red icon-undo"></i>Back</a></td></tr></table></div>
	</td>
  </tr>
  <td><form name="subjectform" action="hr_save_createpayslip.php" method="post">
        <table width="100%" class="borders">
          <tr>
            <td class="alterCell" width="20%">Select Month of Payment:</td>
            <td>
			<?php
				require_once('classes/tc_calendar.php');
			  $myCalendar = new tc_calendar("date4", true, false);
			  $myCalendar->setIcon("images/iconCalendar.gif");
			  $myCalendar->setDate(date('d'), date('m'), date('Y'));
			  $myCalendar->setPath("calendar/");
			  $myCalendar->setYearInterval(2050, 2010);
			  $myCalendar->setDateFormat('j F Y');
			  $myCalendar->setAlignment('right', 'bottom');
			  $myCalendar->getDate();
			  $myCalendar->writeScript();
				?></td>
				<td rowspan="3" align="right"><img src="Staff/blur.png" height="120" width="104" border="1" /></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%">Basic Pay:</td>
            <td>
			<?php
			if($salary==0){?>
			<input type="number" name="basic" class="inputFields"  required  tabindex="2" style="background-color:#FFFF00;" placeholder='0.00' />
			<?php }else{?>
			<input type="number" name="basic" class="inputFields"  required  tabindex="2" value="<?php echo $salary?>" style="background-color:#FFFF00;" readonly="readonly" /> <?php }?></td>
			
			
          </tr>
          <tr>
            <td class="alterCell"></td>
            <td><table>
                <tr>
                  <td><input type="checkbox" name="nhif" id="nhif" value="1" onclick="updateTotals()"></td>
                  <td>Include NHIF</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="nssf" id="nssf" value="1" onclick="updateTotals()"></td>
                  <td>Include NSSF</td>
                </tr>
				<tr>
                  <td><input type="checkbox" name="ptr" id="ptr" value="1" onclick="updateTotals()"></td>
                  <td>Include Personal Tax Relief</td>
                </tr>
              </table></td>
          </tr>
          <tr style='height:30px;'>
            <td class='dataListHeader'>Allowances</td>
			<td class="alterCell2" colspan="3"></td>
          </tr>
		  <?php
		  $result = mysql_query("select * from tbl_hrallowances order by name asc");
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  $num=0;
		  while($row = mysql_fetch_array($result)){ $num++;?>
		  	<tr>
			<td class="alterCell"><?php echo $row['name']?></td>
		  	<td>
			<input type="hidden" name="allowancename[]" value="<?php echo $row['name']?>" />
			<input type="number" name="allowance[]" class="inputFields"  required  tabindex="<?php echo $num?>" placeholder='0.00' /></td>
        	</tr>
		  
		  <?php 
		  	}
		  }
		  ?>
		  <tr style='height:30px;'>
            <td class='dataListHeader'>Deductions</td>
			<td class="alterCell2" colspan="3"></td>
          </tr>
		   <?php
		  $result = mysql_query("select * from tbl_hrdeductions order by name asc");
		  $rowscounts=mysql_num_rows($result);
		  if($rowscounts==1 ||$rowscounts>1){
		  $num2=$num;
		  while($row = mysql_fetch_array($result)){ $num2++;?>
		  	<tr>
			<td class="alterCell"><?php echo $row['name']?></td>
		  	<td>
			<input type="hidden" name="deductionsname[]" value="<?php echo $row['name']?>" />
			<input type="number" name="deductions[]" class="inputFields"  required  tabindex="<?php echo $num2?>" placeholder='0.00'  /></td>
        	</tr>
		  
		  <?php 
		  	}
		  }
		  ?>
		 
          <tr>
            <td class="alterCell"></td>
            <td><input type="submit" name="submit" value="Save and Generate Payslip" class="btn btn-primary"/></td>
          </tr>
        </table>
       <input type="hidden" name="staffref" value="<?php echo $id?>" />
      </form></td>
</table>




<?php
}else{
echo "<br/><H1 align='center'>PLEASE SELECT AN EMPLOYEE FROM THE TABLE ABOVE</h1>";
}
?>
</body>
</html>
