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

	if($subject=='English'){
	$subje='english';
	}
	if($subject=='Kiswahili'){
	$subje='kiswahili';
	}
	if($subject=='Maths'){
	$subje='math';
	}
	if($subject=='Biology'){
	$subje='biology';
	}
	if($subject=='Physics'){
	$subje='physics';
	}
	if($subject=='Chemistry'){
	$subje='chemistry';
	}
	if($subject=='History'){
	$subje='history';
	}
	if($subject=='Geography'){
	$subje='geography';
	}
	if($subject=='CRE'){
	$subje='cre';
	}
	if($subject=='Agriculture'){
	$subje='agriculture';
	}
	if($subject=='B/Studies'){
	$subje='bstudies';
	}
	if($subject=='total_points'){
	$subje='total_points';
	}
	if($subject=='mean_grade'){
	$subje='mean_grade';
	}
	  
	 $query = "select m.".$subje.", k.admno, k.index_numbers,k.year_finished, s.admno, s.fname,s.sname,s.lname from kcseanalysis as k inner join studentdetails s on k.admno=s.admno inner join kcsemarks m on m.index_numbers=k.index_numbers and k.year_finished='$year' order by k.index_numbers";
	  $result = mysql_query($query);
	  $rowscount=mysql_num_rows($result);
	 if($rowscount==1 ||$rowscount>1){?>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'><u> Managing <font color='#FF0000'>KCSE <?php echo $subject?> Marks &nbsp;&nbsp;</font>&nbsp;&nbsp;FOR THE CLASS OF &nbsp;<font color='#FF0000'><?php echo $year?></font></u>
            <div style="float:right; margin-right:5px;">
              <table width="150px">
                <tr>
                  <td align="left"></td>
                  <td align="right"><a href="KCSE_Manage.php" target="content">close<i class="icon icon-red icon-close"></i></a></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>&nbsp;&nbsp;&nbsp;</th>
                  <th ><span id=freetext>ADM NO.</span></th>
                  <th ><span id=freetext>Index Number</span></th>
                  <th ><span id=freetext>Full Name</span></th>
                  <th align=left><span id=freetext>Marks</span></th>
                  <th></th>
                </tr>
              </thead>
              <?php
		  $num=0;
		 $index=0;
		 while ($row = mysql_fetch_array($result)) {
		$num++;
		$index++;
		$adm=$row['admno'];
		$fname=$row['fname'];
		$mname=$row['sname'];
		$lname=$row['lname'];
		$indexno=$row['index_numbers'];
		$sub=$row[$subje];
		
		 ?>
              <tr>
                <td><span id=freetext><?php echo $num?></span></td>
                <td><?php echo $adm?>
                  <input type="hidden" value="<?php echo $adm?>" name="adms" id="ad" readonly="readonly" size="5" >
                 </td>
                <td><?php echo $indexno?>
                  <input type="hidden" value="<?php echo $indexno?>" name="adms" id="idn" readonly="readonly" size="8" >
                  </td>
                <td><?php echo $fname." ".$mname." ".$lname?></td>
                <td ><?php echo $sub?></td>
                <td align=right><a href="#openModal<?php echo $num?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i>&nbsp; Edit</a>
				
				<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateKCSEEntry.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing KCSE ENTRY <?php echo $indexno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%" valign="middle"><b><?php echo $subject?>:</b></td>
              <td class="alterCell2"><input type="text" name="c1" class="inputFields" autofocus required  tabindex="1" value="<?php echo $sub ?>" style="background-color:#FFFF00;"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $admno; ?>">
		  <input type="hidden" name="indexn" value="<?php echo $indexno; ?>">
		  <input type="hidden" name="yr" value="<?php echo $year; ?>">
		  <input type="hidden" name="subjectis" value="<?php echo $subject; ?>">
        </form>
      </div>
    </div>
				
				
				</td>
              </tr>
              <?php
		}
		?>
            </table></td>
        </tr>
      </table>
      <?php 
	
	}else{
  ?>
      <div class="clear"></div>
      <table class="tablesorter_ordinary">
        <tr>
          <td align="center"><img src='images/exclamation.png' align='absmiddle'>&nbsp;&nbsp;There are No Students for the selected year</td>
        </tr>
      </table>
      <?php
  }
  
  }
  ?>
    </div>
  </div>
  <!-- end of login form-->
</div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
