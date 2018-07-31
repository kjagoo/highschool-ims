<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>SMS:: Chrimoska School System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../webicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="../webicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<link href='css/opa-icons.css' rel='stylesheet' />

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>
<table id="main" cellpadding="0" cellspacing="0">
  <tr>
    <td id="sidepan" valign="top">
	<div class='subMenuHeader'>Library</div>
	<a class='subMenuItem' href="library_main.php" target="content"><i class="icon icon-blue icon-home"></i>&nbsp;Library</a>
	<div class='subMenuHeader'>Books</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="library_subjects.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Subjects</a></li>
	<li><a class='subMenuItem' href="library_addbook.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Add Books</a></li>
	<li><a class='subMenuItem' href="library_inventory.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Books Inventory</a></li>
	
	</ul>
	
	
	<div class='subMenuHeader'>Transactions</div>
	<ul style="list-style:none; margin:0 0 0 10px; padding:0;">
	<li><a class='subMenuItem' href="library_recordissued_book.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Record Issued Books</a></li>
	<li><a class='subMenuItem' href="library_issuebook.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Issue Out Book</a></li>
	<li><a class='subMenuItem' href="library_returnbooks.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Issued Books List</a></li>
	<li><a class='subMenuItem' href="library_lostbooks.php" target="content"><i class="icon icon-blue icon-triangle-e"></i>&nbsp;Lost Books List</a></li>
	
	</ul>
	  <br />
    </td>
    <td valign="top"><a name="top"></a>
	

     <div id="loader"><i class="icon icon-blue icon-user"></i>&nbsp;<strong><?php echo $_SESSION['SESS_NAME_']?></strong></div>
      
		
		<iframe name="content" src="library_main.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
     
	  
	  </td>
  </tr>
</table>

</body>
</html>