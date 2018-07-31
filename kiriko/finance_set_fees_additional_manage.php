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
 function WarningDelete(){

 if(confirm("WARNING !!\n\nYou are about to delete this Added Votehead\n\nDo you want to continue?")){
	return true;
 }else{
	return false;
	}
}

 </script>
</head>
    <?php
  $subje="";
  
 if(isset($_GET['admno']) && isset($_GET['yr']) && isset($_GET['term'])){
	 $admno=$_GET['admno'];
	$term=$_GET['term'];
	$year=$_GET['yr'];



	$num=0;
	$sub=0;
	
	$ads = "SELECT * from studentdetails where admno='$admno'";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$form=$rowad['form'];
	
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
	}
	
	
 }


include('includes/dbconnector.php');


//if ($result) {
  // create a new form and then put the results
  // in to a table.
  ?>
      <div class="clear"></div>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>Editing Additional Fees <?php echo $year." ".$admno?>
		  <div style="float:right; margin-right:5px;">
		  <table width="200px">
		  	<tr><td align="left"><a href="finance_set_fees_additional_manage.php?admno=<?php echo $admno;?>&term=<?php echo $term;?>&yr=<?php echo $year;?>">Refresh<i class="icon icon-green icon-refresh"></i></a></td>
			<td align="left"><a href="pdf_fees_invoice.php?form=<?php echo $form;?>&term=<?php echo $term;?>&yr=<?php echo $year;?>&admno=<?php echo $admno?>"><i class="icon icon-green icon-document"></i>Invoice</a></td>
		 	 <td align="right"><a href="finance_additional_Fees_manage.php">close<i class="icon icon-red icon-close"></i></a></td>
			 </tr>
			</table>
		</div>
		  </td>
        </tr>
        <tr>
          <td>
		  

		  <table>
		  <tr>
		  <td rowspan="5"><img src="Image/<?php echo $admno?>.jpg" width="150px" height="150px" /></td>
		  </tr>
		  <tr>
		  <td>Name</td><td><?php echo str_replace("&","'",$rowad['fname'])." ".str_replace("&","'",$rowad['sname'])." ".str_replace("&","'",$rowad['lname'])?></td>
		  </tr>
		  <tr>
		  <td>School Fees</td>
		   <td align="right" ><?php echo number_format($sub,2) ?></td>
		  </tr>
		  <tr>
		  <td>Added Fees</td>
		   <td align="right"><?php echo  number_format($added,2)?></td>
		  </tr>
		  <tr>
		  <td>Payable</td>
		  <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo number_format(($sub+$added),2)?></font></td>
		  </tr>
		  </table>
		  </td>
		 </tr>
		<tr>
		<td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
                <th >Votehead</th>
                <th align='right'>Added Amount</th>
				 <th align='right'></th>
				  <th align='right'></th>
              </tr>
			</thead>
             <tbody>
             <?php
			 $numss=0;
	$addedss = "select * from finance_added_fees where fiscal_year='$year' and term='$term' and admno='$admno'";//cat 1 query
	$resultss = mysql_query($addedss);
	while ($rowss = mysql_fetch_array($resultss)) {// get cat1 marks
	$numss++;
	?>
              <tr class="record">
                <td><?php echo $numss?></td>
                <td><?php echo $rowss['votehead']?></td>
                <td align="right" ><?php echo $rowss['amount']?></td>
				<td align="right" width="15%"><a href="delete_added_fees.php?id=<?php echo $rowss['votehead']?>&admno=<?php echo $admno?>&year=<?php echo $year?>&term=<?php echo $term?>" title="Click to Delete" onclick="return WarningDelete()"><i class="icon icon-blue icon-trash"></i></a></td>
                <td align="right" width="15%"><a href="#openModal<?php echo $numss?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i></a>
				
				<div id="openModal<?php echo $numss?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="finance_updateFees_added.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Update Added Fees <?php echo $admno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="30%"><b>Votehead Name:</b></td>
              <td><input type="text"  readonly="readonly" name="votehead"  value="<?php echo $rowss['votehead']?>"></td>
            </tr>
			<tr>
              <td class="alterCell" width="30%"><b>Amount:</b></td>
              <td><input type="text" name="c2" id="c2" class="inputFields" autofocus required  tabindex="1" value="<?php echo $rowss['amount']?>" />
			  <input type="hidden" name="pa" id="pa" class="inputFields" autofocus required  value="<?php echo $sub ?>"/>
			  </td>
            </tr>
			
            <tr>
              <td class="alterCell" width="30%">&nbsp;</td>
              <td><input type="submit" name="submit" value="Update Fees" class="btn btn-primary"/></td>
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
	 }// end of geting cat 1 marks
?>

            </tbody>
			</table></td>
        </tr>
      </table>


</body>
</html>
