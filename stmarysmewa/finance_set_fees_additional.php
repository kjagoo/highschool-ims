<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

include 'includes/Finance.php';
$finance = new Financials(); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="fieldclone.txt"></script>
<script type="text/javascript" src="entertotab.txt"></script>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script>

$(document).ready(function () {

     //iterate through each textboxes and add keyup
     //handler to trigger sum event
     $("#c2").each(function () {

         $(this).keyup(function () {
             calculateSum();
         });
     });

 });

 function calculateSum() {

     var sum = 0;
     //iterate through each textboxes and add the values
    
         //add only if the value is number
         if (!isNaN($("#c2").val()) && $("#c2").val().length != 0) {
             sum += parseFloat($("#pa").val())+( parseFloat($("#c2").val()) );
			 
			  $("#ex").val(sum.toFixed(2));
         }

     
     //.toFixed() method will roundoff the final sum to 2 decimal places
    
 }
 </script>
</head>
    <?php
  $subje="";
  
 if(isset($_GET['form']) && isset($_GET['yr'])){
	 $form=$_GET['form'];
	$term=$_GET['term'];
	$year=$_GET['yr'];

	
 }


include('includes/dbconnector.php');


//if ($result) {
  // create a new form and then put the results
  // in to a table.
  ?>
      <div class="clear"></div>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Setting Additional Fees <?php echo $year." ".$form?>
		  <div style="float:right; margin-right:5px;">
		  <table width="150px"><tr><td align="left"><a href="finance_set_fees_additional.php?form=<?php echo $form;?>&term=<?php echo $term;?>&yr=<?php echo $year;?>">Refresh<i class="icon icon-green icon-refresh"></i></a></td><td align="right"><a href="finance_additional_Fees.php">close<i class="icon icon-red icon-close"></i></a></td></tr></table></div>
		  </td>
        </tr>
        <tr>
          <td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
                <th >Admno</th>
                <th >Full Name</th>
                <th align='righ't>Payable</th>
                <th align='right'>Aditional Fees</th>
                <th align='right'>Total Payable</th>
              </tr>
			</thead>
             <tbody>
              <?php	
	$num=0;
	$sub=0;
	
	$ads = "SELECT * from studentdetails where form='$form'";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	
	$sub=0;
	$cat1 = "select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form='$form'";//cat 1 query
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get cat1 marks
	$sub=$row['total'];
	
	}
	$added=0;
	$addedq = "select COALESCE(sum(amount),0) as total from finance_added_fees where fiscal_year='$year' and term='$term' and admno='$admno'";//cat 1 query
	$resultq = mysql_query($addedq);
	while ($rowq = mysql_fetch_array($resultq)) {// get cat1 marks
	$added=$rowq['total'];
	
	}
	
?>
              <tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo  $admno?></td>
                <td><?php echo str_replace("&","'",$rowad['fname'])." ".str_replace("&","'",$rowad['sname'])." ".str_replace("&","'",$rowad['lname'])?></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo number_format($sub,2) ?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo  number_format($added,2)?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo number_format(($sub+$added),2)?></font></td>
                <td align="right" width="15%">
				<a href="#openModal<?php echo $num?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i>&nbsp; Edit</a>
				
				
	<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="finance_updateFees.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Marks Record <?php echo $admno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="30%"><b>Votehead Name:</b></td>
              <td class="alterCell2"><select name="votehead" id="select" class="select">
            <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (votehead) from finance_voteheads where term='$term' and fiscal_year='$year' ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['votehead'].">".$row['votehead']."</OPTION>"; }?>
          </select></td>
            </tr>
			<tr>
              <td class="alterCell" width="30%"><b>Amount:</b></td>
              <td class="alterCell2"><input type="text" name="c2" id="c2" class="inputFields" autofocus required  tabindex="1" />
			  <input type="hidden" name="pa" id="pa" class="inputFields" autofocus required  value="<?php echo $sub ?>"/>
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="30%"><b>Total Payable:</b></td>
              <td class="alterCell2"><input type="text" name="ex" id="ex" class="inputFields" autofocus required  tabindex="1" /></td>
            </tr>
            <tr>
              <td class="alterCell" width="30%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Fees" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $admno; ?>">
		  <input type="hidden" name="frm" value="<?php echo $form; ?>">
		  <input type="hidden" name="trm" value="<?php echo $term; ?>">
		  <input type="hidden" name="yr" value="<?php echo $year; ?>">'
        </form>
      </div>
    </div>
	 	
				
				</td>
              </tr>
              
              <?php
	  	 // }// end of exam marks
	  	//}//end of getting cat2 marks
	 // }// end of geting  names
	 }// end of geting cat 1 marks
?>

            </tbody>
			</table></td>
        </tr>
      </table>


</body>
</html>
