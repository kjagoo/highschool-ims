<?php
require_once("includes/Theme.php"); 
$theme = new Theme();
 // Initialize the session.
   session_start();
    
   // Unset all of the session variables.
    $_SESSION = array();
    
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (isset($_COOKIE[session_name()])) {
       setcookie(session_name(), '', time()-42000, '/');
    }
    
    // Finally, destroy the session.
    session_destroy();

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>CL :: School Management System</title>
<link href="css/<?php echo $theme->getActiveTheme();?>.css" type="text/css" rel="stylesheet">
<link href="images/log.png" rel="shortcut icon" type="image/x-icon" />
<link href='css/opa-icons.css' rel='stylesheet' />

</head>
<body>
<?php 
 require_once("index_header.php"); 
 ?>
<!-- end of header bar -->
<section id="secondary_bar"> </section>
<!-- end of secondary bar -->
<section id="main" class="column">
  <div class="module_content">
    <!--***********************************************-->
  
    <center>
	
      <div id="tooltip_full_backup" class="tooltip login_box">
        <div class="tooltip_header clearfix">
          <h4 align="left"><i class="icon icon-orange icon-key"></i>&nbsp;Authentication&nbsp;</h4>
          <div style="clear: both;"></div>
        </div>
        <div class="lb_content">
          <div class="l_pane">
		
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return validateForm();">
              <table width="100%">
			  
                <tr>
                  <td>Username:</td>
                  <td><input id="use_name" name="use_name" class="oversize  input-text" type="text" required></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input id="passw_rd"  name="passw_rd" class="oversize  input-text" type="password" required></td>
                </tr>
                <tr>
                  <td>User Type:</td>
                  <td><select name="utype"  class="select input-text" required>
                      <option value="Administrator" >Administrator/ Principal </option>
					  <option value="Deputy">Deputy Principal </option>
						<option value="ICT">ICT Administrator </option>
                      <option value="Teacher">Teacher</option>
                      <option value="Dean" >Dean</option>
					  <option value="Guidance"> Guidance and Councelling</option>
                      <option value="Accountant" >Accountant</option>
                      <option value="Secretary" >Secretary</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="clear"></td>
                </tr>
                <tr>
				<td></td>
                  <td><input class="btn btn-large btn-success" value="Login" type="submit"></td>
                </tr>
              </table>
            </form>
          </div>
        </div>
		<!--<div style="margin:0; font-size:10px; float:right; padding:0 10px 2px 0;">Powered by Crystal Technologies Limited</div>-->
      </div>
	   
	 <?php
	include('includes/dbconnector.php');
	
	 ?>
    </center>
    <!--***********************************************-->
    <?php
	session_start();
	include 'includes/mssql.class.php';
	include 'includes/functions.php';
$func = new Functions();
	if(isset($_POST['passw_rd']) && isset($_POST['use_name']) && isset($_POST['utype']) ){
		
	$usename=$_POST['use_name'];
	$usepass=$_POST['passw_rd'];
	$ucategory=$_POST['utype'];
	
	

	$usname = stripslashes($usename);
	$uspass = stripslashes($usepass);
	
	if($_POST['utype']=="Teacher"){
	$qry="select * from staff where idpass='$usname' and passwrd='$uspass' and (category='Government Teacher' or category='Board Teacher')";
	}else{
	$qry="select * from staff where idpass='$usname' and passwrd='$uspass' and category='$ucategory'";
	}
	

		
	
	 $result = mysql_query($qry);
	 $count=mysql_num_rows($result);
	 
	 if($count==1 || $count>1){
	 	while ($row = mysql_fetch_array($result)) {
	    $staffcat=$row['category'];
		$staffname=$row['fname']."  ".$row['mname']."  ".$row['lname'];
		 }// end of while
		session_regenerate_id();
		$sessionname=$_POST['use_name'];
		//$sessionname=$usename;
		$_SESSION['SESS_MEMBER_ID_'] = $sessionname;
		$_SESSION['SESS_NAME_']=$staffname;
		$_SESSION['SESS_CATEGORY_']=$staffcat;
		$_SESSION['lastactivity'] = time();
		$_SESSION['THEME']=$theme->getActiveTheme();
		$_SESSION['THEMEs']=$theme->getActiveThemeSmall();
		session_write_close();
		$activity = "Successful Login";
        $func->addAuditTrail($activity,$sessionname);
		header("location: MainWindow.php");
		
	 }
	 else{// if nothing is found
	 $activity = "Un-Successful Login";
	 $usename=$_POST['use_name'];
        $func->addAuditTrail($activity,$usename);
		echo '<script language=javascript>alert("WRONG USERNAME OR PASSWORD COMBINATIONS")</script>';
		echo '<script language=javascript>window.location="index.php"</script>';
		}
	
	}


?>
    <div class="clear"></div>
  </div>
  <div class="spacer"></div>
</section>
<!-- end of contents area section -->
<div class="clear"></div>
<table width="100%">
<tr>
<td align="center"><img src="images/chrimoska.png" alt="Chrimoska Systems" align="absmiddle" /></td>


</tr>
</table>
<!-- Footer Content -->
<div class="footer">
 <div class="designer"> Designed and Developed By: <a  href="http://www.crystaltech.co.ke" target="main">Crystal Technologies</a> P.O. Box 14423-00100 Nairobi. Email:&nbsp;&nbsp;<a href="mailto:info@crystaltech.co.ke">info@crystaltech.co.ke </a> </div>

 <div class="version">Mod: 1:02:2015</div>
</div>
<!-- End Footer Content -->
</body>
</html>
