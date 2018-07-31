<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
require_once("includes/dbconnector.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>

<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );

</script>
</head>
<body>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="clear"></div>
    
      <?php  
	  if(isset($_GET['year']) ){
	  $year=$_GET['year'];
	  $subject = $_GET['subjects'];
	  $subje="";

	if($subject=='ENGLISH'){
	$subje='english';
	}
	if($subject=='KISWAHILI'){
	$subje='kiswahili';
	}
	if($subject=='MATH'){
	$subje='math';
	}
	if($subject=='BIOLOGY'){
	$subje='biology';
	}
	if($subject=='PHYSICS'){
	$subje='physics';
	}
	if($subject=='CHEMISTRY'){
	$subje='chemistry';
	}
	if($subject=='HISTORY'){
	$subje='history';
	}
	if($subject=='GEOGRAPHY'){
	$subje='geography';
	}
	if($subject=='CRE'){
	$subje='cre';
	}
	if($subject=='AGRICULTURE'){
	$subje='agriculture';
	}
	if($subject=='B/STUDIES'){
	$subje='bstudies';
	}
	if($subject=='COMPUTER'){
	$subje='computer';
	}
	if($subject=='FRENCH'){
	$subje='french';
	}
	if($subject=='HOME'){
	$subje='home';
	}
	if($subject=='total_points'){
	$subje='total_points';
	}
	if($subject=='mean_grade'){
	$subje='mean_grade';
	}
	 
	 ?> 
	  <div class="clear"></div>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'><u>Managing <font style="color:#FF0000;"><?php echo $subject?></font> GRADES &nbsp;&nbsp;Year <?php echo $year?>&nbsp;&nbsp;</u>
		  <div style="float:right; margin-right:5px;">
		  <table width="150px"><tr><td align="left"><a href="KCSE_Manage_View.php?year=<?php echo $year;?>&subjects=<?php echo $subject;?>">refresh<i class="icon icon-green icon-refresh"></i></a></td><td align="right"><a href="marks_manage.php">close<i class="icon icon-red icon-close"></i></a></td></tr></table></div>
		  </td>
        </tr>
        <tr>
          <td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
				 <th>INDEX No</th>
                <th >Admno</th>
                <th >Full Name</th>
                <th align='right'>GRADE</th>
              </tr>
			</thead>
             <tbody>
              <?php	
	$num=0;
	$sub=0;
	
	$ads = "SELECT distinct(admno),index_numbers FROM kcseanalysis where year_finished='$year' order by index_numbers asc";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	$index=$rowad['index_numbers'];
	
	$sub=0;
	$cat1 = "SELECT * FROM kcsemarks where year_finished='$year' and index_numbers='$index'";//cat 1 query
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get cat1 marks
	$sub=$row[$subje];
	
	}
	$getnames = "SELECT fname,sname,lname from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	
	}
	
?>
              <tr class="record">
                <td><?php echo $num?></td>
				 <td><?php echo  $index?></td>
                <td><?php echo  $admno?></td>
                <td><?php echo str_replace("&","'",$fname)." ".str_replace("&","'",$mname)." ".str_replace("&","'",$lasname)?></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $sub ?></font></td>
                <td align="right" width="15%">
				<a href="#openModal<?php echo $num?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i>&nbsp; Edit</a>
				
				
	<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateKCSEEntry.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing GRADES Record <?php echo $admno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>GRADE:</b></td>
              <td class="alterCell2"><input type="text" name="c1" class="inputFields" autofocus required  tabindex="1" value="<?php echo $sub ?>"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $index; ?>">
		  <input type="hidden" name="yr" value="<?php echo $year; ?>">
		  <input type="hidden" name="subjectis" value="<?php echo $subject; ?>">
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
	 }
?>

            </tbody>
			</table></td>
        </tr>
      </table>

  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
