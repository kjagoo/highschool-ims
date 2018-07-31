<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$userid=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
$username=$_SESSION['SESS_NAME_'];

$query="SELECT * FROM staff where idpass='$userid'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
	$fname=$row['fname'];
	$mname=$row['mname'];
	$lname=$row['lname'];
	$tele=$row['telephone'];
	$krapin=$row['kra_pin'];
	$dated=$row['dateJoined'];
	$oldpas=$row['passwrd'];
	$employement_type=$row['employement_type'];
	$image=$row['imgref'];
	$address=$row['address'];
			
	}
	if($image==""){
		$imageref="blur.png";
	}else{
		$imageref=$image;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="css/styles.css" />
<!--<link href="css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>-->
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

<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
</head>
<body>

<div id="content" class="clearfix">
  <div id="userphoto"><img src="Staff/<?php echo $imageref?>" alt="Staff Photo" class="circular" /></div>
  <nav id="profiletabs">
    <ul class="clearfix">
      <li><a href="#bio" class="sel"><i class="icon icon-darkgrey icon-info"></i>User Information</a></li>
      <li><a href="#activity"><i class="icon icon-darkgrey icon-document"></i>Recent Activity</a></li>
      <li><a href="#settings"><i class="icon icon-darkgrey icon-gear"></i>Settings</a></li>
    </ul>
  </nav>
  <section id="bio">
    <p class="setting"><span>User Full Name:</span> <?php echo $fname." ".$mname." ".$lname?></p>
    <p class="setting"><span>ID/ Passport #:</span> <?php echo $userid?></p>
    <p class="setting"><span>Access Category:</span> <?php echo $usercat?></p>
	<p class="setting"><span>KRA PIN:</span> <?php echo $krapin?></p>
	<p class="setting"><span>Dated Joined:</span> <?php echo $dated?></p>
    <p class="setting"><span>Employement type:</span> <?php echo $employement_type?></p>
	
	<p class="setting"><span>CV :</span>-</p>
	<p class="setting"><span>Telephone #:</span> <?php echo $tele?></p>
	<p class="setting"><span>Address:</span> <?php echo $address?></p>
	
	
	
  </section>
  <section id="activity" class="hidden">
    <?php
	
 $statement = "tblaudittrail where uname='$userid' order by auditDate desc";
	$resulta = mysql_query("SELECT * FROM {$statement}");
	$rowscounts=mysql_num_rows($resulta);
	 $recordcount=mysql_num_rows( mysql_query("select * from tblaudittrail where uname='$userid'"));
	 if($rowscounts==1 ||$rowscounts>1){?>
    <p>Most recent Activities: <?php echo $rowscounts."  record(s) found";?></p>

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Row #</th>
          <th>Date &amp; Time</th>
          <th>Activity</th>
          <th>Access Location</th>
        </tr>
      </thead>
      <tbody>
        <?php
		$num=0;
		while($row = mysql_fetch_array($resulta)){
		$num++;
		?>
        <tr>
          <td><?php echo $num;?></td>
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
  </section>
  <section id="settings" class="hidden">
    <p>Change User Password</p>
    <form id="contact-form" action="changepass.php" name="chgpass" method="post">
      <table class="borders">
        <tr>
          <td class="alterCell" width="20%">Username</td>
          <td><input readonly="readonly" size="30" name="usname" class="readOnly" value="<?php echo $userid; ?>"></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Old Password</td>
          <td><input type="text" size="30" name="oldpass" class="inputFields" tabindex="1" required autofocus/></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">New Password</td>
          <td><input type="password" size="30" name="newpass" class="inputFields" tabindex="2" required autofocus/></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Confirm New Password</td>
          <td><input type="password" size="30" name="connewpass" class="inputFields" tabindex="3" required autofocus/></td>
        </tr>
        <tr>
		<td class="alterCell" width="20%"></td>
          <td  class="alterCell2"><div style="float:left;"><input class="btn btn-success" type="submit" value="Update Password"/></div></td>
        </tr>
      </table>
    </form>
  </section>
</div>
<script type="text/javascript">
$(function(){
  $('#profiletabs ul li a').on('click', function(e){
    e.preventDefault();
    var newcontent = $(this).attr('href');
    
    $('#profiletabs ul li a').removeClass('sel');
    $(this).addClass('sel');
    
    $('#content section').each(function(){
      if(!$(this).hasClass('hidden')) { $(this).addClass('hidden'); }
    });
    
    $(newcontent).removeClass('hidden');
  });
});
</script>

</body>
</html>
