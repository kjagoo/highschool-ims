<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Voteheads Setting page";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'/>
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
<!-- Initiate tablesorter script -->
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
 
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a href="finance_fiscalyear.php">Fiscal Year Setting</a></li>
    <li><a   class="active"  href="finance_bankact.php">Bank Accounts Setting</a></li>
    <li><a href="finance_voteheads.php">Votehead Setting</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post">
      <table width="100%" class="borders">
        <tr>
          <td class="alterCell" width="20%">Bank Name: </td>
          <td><input type="text"  name="bankname" class="inputFields" required tabindex="1"  /></td>
        </tr>
		<tr>
          <td  class="alterCell" width="20%">Bank Account Name:</td>
          <td><input type="text"  name="bankaccountname" class="inputFields" required tabindex="2" /></td>
        </tr>
        <tr>
          <td  class="alterCell" width="20%">Bank Account Number:</td>
          <td><input type="text"  name="bankaccount" class="inputFields" required tabindex="3" /></td>
        </tr>
		<tr>
          <td  class="alterCell" width="20%">Bank Branch:</td>
          <td><input type="text"  name="branch" class="inputFields" required tabindex="4" /></td>
        </tr>
		
        <tr>
          <td class="alterCell"></td>
          <td><div style="float:left"><input type="submit" name="submit" value="Save Details" class="btn btn-primary"/></div></td>
        </tr>
      </table>
    </form>
	 <?php
	if(isset($_POST['bankname'])  && isset($_POST['bankaccount']) && isset($_POST['bankaccountname']) && isset($_POST['branch'])){
	require_once("includes/dbconnector.php");
	
	$name=$_POST['bankname'];
	$acctname=$_POST['bankaccountname'];
	$bankaccount=$_POST['bankaccount'];
	$branch=$_POST['branch'];
	
	$qury="insert into bank_accounts (account_number,
             bank_name,account_name, branch) values ('$bankaccount','$name','$acctname','$branch')
			  on duplicate key update bank_name='$name', branch='$branch'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Added a new Bank Account ".$name;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Bank Account Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_bankact.php' </script>";
	}
	}
	
?>
	<?php
    $result = mysql_query("SELECT * FROM bank_accounts order by account_number asc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Bank Accounts
		<div style="float:right;">
		 <a href="finance_bankact.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a>
		</div>
		</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th>Account Number</th>
				<th>Account Name</th>
				<th>Bank Name</th>
				<th>Bank Branch</th>
                <th width="10px"></th>
				 <th width="10px"></th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $num=0;
			while($row = mysql_fetch_array($result)){
			$num++;
			?>
              <tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo $row["account_number"];?></td>
				 <td><?php echo $row["account_name"];?></td>
				  <td><?php echo $row["bank_name"];?></td>
				  <td><?php echo $row["branch"];?></td>
                <td align="center">
				<a href="#openModal<?php echo $num?>" title="Click to Edit Route"><i class="icon icon-blue icon-edit"></i></a>
				<div id="openModal<?php echo $num?>" class="modalDialog">
				  <div> <a href="#close" title="Close" class="close">X</a>
					<form name="subjectform" action="updateBank.php" method="post">
					  <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
						<tr style='height:30px;'>
						  <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Bank Details </font></td>
						</tr>
						<tr>
						  <td class="alterCell" width="30%">Bank Name: </td>
						  <td><input type="text"  name="ebankname" class="inputFields" required tabindex="1" value='<?php echo $row["bank_name"];?>'  /></td>
						</tr>
						<tr>
						  <td  class="alterCell" width="30%">Bank Account Name:</td>
						  <td><input type="text"  name="ebankaccountname" class="inputFields" required tabindex="2" value='<?php echo $row["account_name"];?>' /></td>
						</tr>
						<tr>
						  <td  class="alterCell" width="30%">Bank Account Number:</td>
						  <td><input type="text"  name="ebankaccount" class="inputFields" required tabindex="3" value='<?php echo $row["account_number"];?>' /></td>
						</tr>
						<tr>
						  <td  class="alterCell" width="30%">Bank Branch:</td>
						  <td><input type="text"  name="ebranch" class="inputFields" required tabindex="4" value='<?php echo $row["branch"];?>' /></td>
						</tr>
						<tr>
						  <td class="alterCell3" colspan='2'><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
						</tr>
					  </table>
					<input type="hidden" name="oldbank" value="<?php echo $row["bank_name"]; ?>">
				  <input type="hidden" name="oldaccount" value="<?php echo $row["account_number"]; ?>">
				  <input type="hidden" name="oldaccountname" value="<?php echo $row["account_name"]; ?>">
					</form>
				  </div>
				</div>
				
				</td>
                 <td align="center">
				 <a href="#openModaldelete<?php echo $num?>" title="Click to Delete Class"><span class="icon icon-orange icon-trash"></span></a>
				
				
	<div id="openModaldelete<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="delete_bank.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Delete Bank Account Infor </font></td>
            </tr>
            <tr>
			<td colspan='2' align='center'>
			<h2>Warning!!</h2>
              You are Deleting <?php echo $row["bank_name"] ?>
			</td>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Delete Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="oldbank" value="<?php echo $row["bank_name"]; ?>">
		  <input type="hidden" name="oldaccount" value="<?php echo $row["account_number"]; ?>">
		  <input type="hidden" name="oldaccountname" value="<?php echo $row["account_name"]; ?>">
        </form>
      </div>
    </div>
	
				 
				 </td>
              </tr>
              <?php
			}
		?>
            </tbody>
          </table></td>
      </tr>
    </table>
	 <!--<iframe name="reportView" src="finance_bankact_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>-->
	
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
