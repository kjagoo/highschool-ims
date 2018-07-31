<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/functions.php';
require_once("includes/dbconnector.php"); 

$func = new Functions();
$activity = "View ". $usercat."*s Dashboard";
$func->addAuditTrail($activity,$username);

include 'includes/DAO.php';
$dao = new DAO();
$schoolname="-";
	$address=" -";
	//$plac="-";
	$tele="-";
	$email="-";
    $result = mysql_query("SELECT * FROM schoolname");

    while ($row = mysql_fetch_array($result)) {
	$schoolname=$row['schname'];
	$address=$row['box']." ". $row['place'];
	$tele=$row['telphone'];
	$email=$row['email'];
	$web=$row['website'];
	}
	
$f1_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 1'");
	while($row_c = mysql_fetch_array($result_count)){
	$f1_boys_count=$row_c['boys'];
	}
	$f2_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 2'");
	while($row_c = mysql_fetch_array($result_count)){
	$f2_boys_count=$row_c['boys'];
	}
	$f3_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 3'");
	while($row_c = mysql_fetch_array($result_count)){
	$f3_boys_count=$row_c['boys'];
	}
	$f4_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 4'");
	while($row_c = mysql_fetch_array($result_count)){
	$f4_boys_count=$row_c['boys'];
	}
	
	
	$f1_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 1'");
	while($row_c = mysql_fetch_array($result_count)){
	$f1_girls_count=$row_c['girls'];
	}
	$f2_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 2'");
	while($row_c = mysql_fetch_array($result_count)){
	$f2_girls_count=$row_c['girls'];
	}
	$f3_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 3'");
	while($row_c = mysql_fetch_array($result_count)){
	$f3_girls_count=$row_c['girls'];
	}
	$f4_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 4'");
	while($row_c = mysql_fetch_array($result_count)){
	$f4_girls_count=$row_c['girls'];
	}
	$f5_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 5'");
	while($row_c = mysql_fetch_array($result_count)){
	$f5_girls_count=$row_c['girls'];
	}
	$f5_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 5'");
	while($row_c = mysql_fetch_array($result_count)){
	$f5_boys_count=$row_c['boys'];
	}
	
	$f1_total_count=0;
	$f2_total_count=0;
	$f3_total_count=0;
	$f4_total_count=0;
	$f5_total_count=0;
	$total_boys_count=0;
	$total_girls_count=0;
	
	$f1_total_count=($f1_boys_count+$f1_girls_count);
	$f2_total_count=($f2_boys_count+$f2_girls_count);
	$f3_total_count=($f3_boys_count+$f3_girls_count);
	$f4_total_count=($f4_boys_count+$f4_girls_count);
	$f5_total_count=($f5_girls_count+$f5_boys_count);
	$total_boys_count=($f1_boys_count+$f2_boys_count+$f3_boys_count+$f4_boys_count);
	$total_girls_count=($f1_girls_count+$f2_girls_count+$f3_girls_count+$f4_girls_count);
	
	
	$total_counts=($f1_total_count+$f2_total_count+$f3_total_count+$f4_total_count);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Portal</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<style type="text/css">
html {
border: 1px solid #FFFF00; 
	}
body{
margin:0;
padding:0;
}
</style>
<script language="javascript">
printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS +"<table align='center'><tr><td><?php echo $schoolname?></td></tr><tr><td align='center'>School Enrollment</td></tr></table>"+ document.getElementById(divId).innerHTML
	window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}
</script>
<SCRIPT type="text/javascript" LANGUAGE="JavaScript">
  function executeCommands(inputparms){
  // Instantiate the Shell object and invoke its execute method.
    var oShell = new ActiveXObject("Shell.Application");

    var commandtoRun = "C:\\Winnt\\Notepad.exe";
   
      var commandParms ="";
 // Invoke the execute method.  
     oShell.ShellExecute(commandtoRun, commandParms,"", "open", "1");
  }

</script>
</head>
<body>
<div id="display_Area">
  <table class="borders" cellpadding="5" cellspacing="0">
    <tr style="height:30px;">
      <td class="dataListHeader">Quick Links</td>
    </tr>
    <tr>
      <td><!--------------------------------------->
        <div class="sortable row-fluid">
          <?php
  if($usercat=='Administrator' || $usercat=='Secretary'){
 //<fieldset>
  ?>
          <?php
  if($usercat=='Administrator'){
  ?>
          <a data-rel="tooltip" title="Quick link to Staffs" class="well span3 top-block" href="humanresource.php" target="main"> <span><img src="images/staff.png" alt="Staff" /></span>
          <div>&nbsp;</div>
          <div>Human Resource</div>
          </a>
          <?php
	 }?>
          <a data-rel="tooltip" title="Quick link to Staffs" class="well span3 top-block" href="students.php" target="main"> <span><img src="images/students.png" alt="Students" /></span>
          <div>&nbsp;</div>
          <div>Students</div>
          </a> <a data-rel="tooltip" title="Quick link to Staffs" class="well span3 top-block"  href="communication.php" target="main"> <span><img src="images/sms.png" alt="Communication" /></span>
          <div>&nbsp;</div>
          <div>Communication</div>
          </a>
          <?php
  if($usercat=='Administrator'){
  ?>
          <a data-rel="tooltip" title="Quick link to System Setup" class="well span3 top-block"  href="system.php"  target="content"> <span><img src="images/setting.png" alt="Settings" /></span>
          <div>&nbsp;</div>
          <div>System Setup</div>
          </a>
          <?php 
	 }
	 // </fieldset>
	
}
	
 if($usercat=='Administrator' || $usercat=='Government Teacher' || $usercat=='Board Teacher' || $usercat=='Dean'||$usercat=='Guidance'){
  //<fieldset>
  ?>
          <a data-rel="tooltip" title="Quick link to Library" class="well span3 top-block"  href="library.php" target="main"> <span><img src="images/books.png" alt="Library" /></span>
          <div>&nbsp;</div>
          <div>Library</div>
          </a>
          <?php
	 // </fieldset>
	 }
	 // <fieldset>
	 ?>
          <?php
	   if($usercat=='Administrator'){ 
	   ?>
          <a data-rel="tooltip" title="Quick link to Database Archive" class="well span3 top-block"  href="finance.php" target="main"> <span><img src="images/finance.png" alt="Finance" /></span>
          <div>&nbsp;</div>
          <div>Finance</div>
          </a> <a data-rel="tooltip" title="Quick link to Database Archive" class="well span3 top-block"  href="system_back_up.php" target="content"> <span><img src="images/archive.png" alt="Archive Database" /></span>
          <div>&nbsp;</div>
          <div>Archive Database</div>
          </a>
          <?php
	  }
	   if($usercat=='Accountant'){
	   ?>
	   <a data-rel="tooltip" title="Quick link to Staffs" class="well span3 top-block" href="students.php" target="main"> <span><img src="images/students.png" alt="Students" /></span>
          <div>&nbsp;</div>
          <div>Students</div>
          <a data-rel="tooltip" title="Quick link to Database Archive" class="well span3 top-block"  href="finance.php" target="main"> <span><img src="images/finance.png" alt="Finance" /></span>
          <div>&nbsp;</div>
          <div>Finance</div>
          </a> <a data-rel="tooltip" title="Quick link to Database Archive" class="well span3 top-block"  href="system_back_up.php" target="content"> <span class="icon32 icon-orange icon-archive"></span>
          <div>&nbsp;</div>
          <div>Archive Database</div>
          </a>
          <?php
	 }
	  //</fieldset>
	 ?>
          <a data-rel="tooltip" title="Quick link to My Profile" class="well span3 top-block"  href="my_profile.php" target="content"> <span><img src="images/acct.png" alt="My Account" /></span>
          <div>&nbsp;</div>
          <div>My Account</div>
          </a>
		  
		  
		
		  </div>
        <!--------------------------------------->
        <div class="sortable">
          <div class="box span4">
            <div class="box-header well" data-original-title>
              <h2>School Enrollment Sumamry</h2>
           <span style="float:right; padding:5px; cursor:pointer;"><a href=javascript:printDiv('tabledisplay')><i class='icon icon-orange icon-print'></i></a></span> </div>
            <div class="box-content">
              <form  method='get' name='subs'>
                <div id=tabledisplay>
                  <table class="customtable" width="100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th align="right">Girls</th>
						<th align="right">Boys</th>
                        <th align="right">Total</th>
                      </tr>
                    </thead>
                    <tr class="alert alert-info">
                      <td><strong><a>Form 1</a></strong></td>
                      <td align="right"><?php echo $f1_girls_count?></td>
					  <td align="right"><?php echo $f1_boys_count?></td>
                      <td align="right"><?php echo $f1_total_count?></td>
                    </tr>
                    <tr class="alert alert-danger">
                      <td><strong><a>Form 2</a></strong> </td>
                      <td align="right"><?php echo $f2_girls_count?></td>
					  <td align="right"><?php echo $f2_boys_count?></td>
                      <td align="right"><?php echo $f2_total_count?></td>
                    </tr>
                    <tr class="alert alert-success">
                      <td><strong><a>Form 3</a></strong> </td>
                      <td align="right"><?php echo $f3_girls_count?></td>
					  <td align="right"><?php echo $f3_boys_count?></td>
                      <td align="right"><?php echo $f3_total_count?></td>
                    </tr>
                    <tr class="alert alert-block">
                      <td><strong><a>Form 4 </a></strong> </td>
                      <td align="right"><?php echo $f4_girls_count?></td>
					  <td align="right"><?php echo $f4_boys_count?></td>
                      <td align="right"><?php echo $f4_total_count?></td>
                    </tr>
                    <tr>
                      <td><strong>Totals</strong></td>
                      <td align="right"><strong><?php echo $total_girls_count?></strong></td>
					  <td align="right"><strong><?php echo $total_boys_count?></strong></td>
                      <td align="right"><strong><?php echo $total_counts?></strong></td>
                    </tr>
					<tr class="alert alert-danger">
                      <td><strong><a>Alumni </a></strong> </td>
                      <td align="right"><?php echo $f5_girls_count?></td>
					   <td align="right"><?php echo $f5_boys_count?></td>
                      <td align="right"><?php echo $f5_total_count?></td>
                    </tr>
                  </table>
                </div>
              </form>
              <iframe name=print_frame width=0 height=0 frameborder=0 src=about:blank></iframe>
            </div>
          </div>
          <div class="box span7">
            <div class="box-header well" data-original-title>
              <h2>My Recent Activities</h2>
            </div>
            <div class="box-content">
              <?php
	
 $statement = "tblaudittrail where uname='$username' order by auditDate desc limit 0,9";
	$resulta = mysql_query("SELECT * FROM {$statement}");
	$rowscounts=mysql_num_rows($resulta);
	 $recordcount=mysql_num_rows( mysql_query("select * from tblaudittrail where uname='$username'"));
	 if($rowscounts==1 ||$rowscounts>1){?>
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Date &amp; Time</th>
                    <th>Activity</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		$num=0;
		while($row = mysql_fetch_array($resulta)){
		$num++;
		?>
                  <tr>
                    <td><?php echo $row['auditDate'] ?></td>
                    <td><?php echo $row['activity'];?></td>
                    <td><?php echo $row['ipaddress'];?></td>
                  </tr>
                  <?php
			}
		?>
                </tbody>
              </table>
              <?php
	 }else{
	 ?>
              <fieldset>
              <table>
                <thead>
                  <tr>
  <th valign="middle"><h3 align="center"><i class="icon icon-orange icon-alert"></i>There are no recent activities</h3></th>
                  </tr>
                </thead>
              </table>
              </fieldset>
              <?php
	}
	?>
            </div>
          </div>
        </div></td>
    </tr>
  </table>
</div>
</body>
</html>
